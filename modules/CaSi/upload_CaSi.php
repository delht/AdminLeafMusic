<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Kiểm tra dữ liệu
    if (!isset($_POST['ten_casi']) || empty($_POST['ten_casi']) || !isset($_FILES['img']) || $_FILES['img']['error'] !== UPLOAD_ERR_OK) {
        die("Dữ liệu không hợp lệ! Vui lòng kiểm tra lại form.");
    }

    // Lấy thông tin từ form
    $tenCaSi = $_POST['ten_casi'];  // thay đổi 'tenCaSi' thành 'ten_casi'

    // Đường dẫn API của ca sĩ
    $apiUrl = "http://192.168.1.13:8080/api/casi/add";

    // Gửi yêu cầu API
    $response = sendDataToApi($apiUrl, $tenCaSi, $_FILES['img']);
    echo $response;
}

function sendDataToApi($url, $tenCaSi, $img)
{
    $boundary = uniqid();

    // Header
    $headers = [
        "Content-Type: multipart/form-data; boundary=$boundary"
    ];

    $body = '';

    // Gửi file hình ảnh
    if (isset($img['error']) && $img['error'] === UPLOAD_ERR_OK) {
        $imgContent = file_get_contents($img['tmp_name']);
        $body .= "--$boundary\r\n";
        $body .= "Content-Disposition: form-data; name=\"img\"; filename=\"" . $img['name'] . "\"\r\n";
        $body .= "Content-Type: " . $img['type'] . "\r\n\r\n";
        $body .= $imgContent . "\r\n";
    } else {
        return "Lỗi file ảnh: không hợp lệ hoặc không tải lên được!";
    }

    // Gửi tên ca sĩ
    $body .= "--$boundary\r\n";
    $body .= "Content-Disposition: form-data; name=\"ten_casi\"\r\n\r\n";  // thay đổi 'tenCaSi' thành 'ten_casi'
    $body .= $tenCaSi . "\r\n";

    $body .= "--$boundary--";

    // Gửi yêu cầu HTTP POST
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