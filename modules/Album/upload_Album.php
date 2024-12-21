<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Kiểm tra dữ liệu đầu vào
    if (!isset($_POST['request']['tenAlbum']) || !isset($_POST['request']['caSi']) || !isset($_POST['request']['ngayPhatHanh']) || !isset($_FILES['img'])) {
        die("Dữ liệu không hợp lệ! Vui lòng kiểm tra lại form.");
    }

    // Lấy dữ liệu album từ form
    $album = [
        "ten_album" => $_POST['request']['tenAlbum'],
        "id_casi" => $_POST['request']['caSi'],
        "ngay_phathanh" => $_POST['request']['ngayPhatHanh']
    ];

    $apiUrl = "http://192.168.83.1:8080/api/album/add";

    // Gửi dữ liệu tới API
    $response = sendDataToApi($apiUrl, $_FILES['img'], $album);
    echo $response;
}

function sendDataToApi($url, $img, $album)
{
    $boundary = uniqid();
    $headers = [
        "Content-Type: multipart/form-data; boundary=$boundary"
    ];

    $body = '';

    // Kiểm tra và gửi ảnh nếu có
    if (isset($img['error']) && $img['error'] === UPLOAD_ERR_OK) {
        $imgContent = file_get_contents($img['tmp_name']);
        $body .= "--$boundary\r\n";
        $body .= "Content-Disposition: form-data; name=\"img\"; filename=\"" . $img['name'] . "\"\r\n";
        $body .= "Content-Type: " . $img['type'] . "\r\n\r\n";
        $body .= $imgContent . "\r\n";
    } else {
        return "Lỗi file ảnh: không hợp lệ hoặc không tải lên được!";
    }

    // Gửi tham số album
    $body .= "--$boundary\r\n";
    $body .= "Content-Disposition: form-data; name=\"album\"\r\n\r\n";
    $body .= json_encode($album) . "\r\n";

    $body .= "--$boundary--";

    // Gửi yêu cầu HTTP POST
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Nhận phản hồi từ API
    $response = curl_exec($ch);

    if ($response === false) {
        $error = curl_error($ch);
        curl_close($ch);
        return "Lỗi cURL: $error";
    }

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode === 200) {
        header("Location: ../../index2.php?tab=form3");
        return "Tải lên thành công: " . $response;
    } else {
        return "Lỗi tải lên: HTTP $httpCode\n$response";
    }
}
?>