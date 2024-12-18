<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : null;

    echo "$id";

    $ten_casi = trim($_POST['ten_casi']);
    $apiUrl = "http://192.168.83.1:8080/api/casi/update/id=$id";  // URL với dấu "="

    $response = sendDataToApi($apiUrl, $_FILES['img'], $ten_casi);
    echo $response;
}

function sendDataToApi($url, $img, $ten_casi)
{
    $boundary = uniqid();
    $headers = [
        "Content-Type: multipart/form-data; boundary=$boundary"
    ];

    $body = '';

    // Kiểm tra và gửi file hình ảnh (nếu có)
    if (isset($img['error']) && $img['error'] === UPLOAD_ERR_OK) {
        $imgContent = file_get_contents($img['tmp_name']);
        $body .= "--$boundary\r\n";
        $body .= "Content-Disposition: form-data; name=\"img\"; filename=\"" . $img['name'] . "\"\r\n";
        $body .= "Content-Type: " . $img['type'] . "\r\n\r\n";
        $body .= $imgContent . "\r\n";
    }

    // Gửi tên ca sĩ
    $body .= "--$boundary\r\n";
    $body .= "Content-Disposition: form-data; name=\"ten_casi\"\r\n\r\n";
    $body .= $ten_casi . "\r\n";
    $body .= "--$boundary--";

    // Gửi yêu cầu HTTP PUT
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if ($response === false) {
        $error = curl_error($ch);
        curl_close($ch);
        return "Lỗi cURL: $error";
    }

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode === 200) {
        return "Cập nhật thành công: " . $response;
    } else {
        return "Lỗi cập nhật: HTTP $httpCode\n$response";
    }
}
?>