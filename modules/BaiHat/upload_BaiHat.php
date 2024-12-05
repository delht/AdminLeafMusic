<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_POST['request']['tenBaiHat']) || !isset($_FILES['file']) || !isset($_FILES['img'])) {
        die("Dữ liệu không hợp lệ! Vui lòng kiểm tra lại form.");
    }

    $request = [
        "tenBaiHat" => $_POST['request']['tenBaiHat'],
        "caSi" => $_POST['request']['caSi'],
        "theLoai" => $_POST['request']['theLoai'],
        "album" => $_POST['request']['album'],
        "khuVucNhac" => $_POST['request']['khuVucNhac'],
        "ngayPhatHanh" => $_POST['request']['ngayPhatHanh']
    ];

    $apiUrl = "http://192.168.1.13:8080/api/baihat/upload";

    $response = sendDataToApi($apiUrl, $request, $_FILES['file'], $_FILES['img']);
    echo $response;
}

function sendDataToApi($url, $json, $file, $img)
{
    $boundary = uniqid();

    // Header
    $headers = [
        "Content-Type: multipart/form-data; boundary=$boundary"
    ];

    $body = '';

    // Gửi file nhạc
    if (isset($file['error']) && $file['error'] === UPLOAD_ERR_OK) {
        $fileContent = file_get_contents($file['tmp_name']);
        $body .= "--$boundary\r\n";
        $body .= "Content-Disposition: form-data; name=\"file\"; filename=\"" . $file['name'] . "\"\r\n";
        $body .= "Content-Type: " . $file['type'] . "\r\n\r\n";
        $body .= $fileContent . "\r\n";
    } else {
        return "Lỗi file nhạc: không hợp lệ hoặc không tải lên được!";
    }

    if (isset($img['error']) && $img['error'] === UPLOAD_ERR_OK) {
        $imgContent = file_get_contents($img['tmp_name']);
        $body .= "--$boundary\r\n";
        $body .= "Content-Disposition: form-data; name=\"img\"; filename=\"" . $img['name'] . "\"\r\n";
        $body .= "Content-Type: " . $img['type'] . "\r\n\r\n";
        $body .= $imgContent . "\r\n";
    } else {
        return "Lỗi file ảnh: không hợp lệ hoặc không tải lên được!";
    }

    $body .= "--$boundary\r\n";
    $body .= "Content-Disposition: form-data; name=\"request\"\r\n\r\n";
    $body .= json_encode($json) . "\r\n";

    $body .= "--$boundary--";

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
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
        return "Tải lên thành công: " . $response;
    } else {
        return "Lỗi tải lên: HTTP $httpCode\n$response";
    }
}
?>