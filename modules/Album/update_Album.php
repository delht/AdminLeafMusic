<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy ID album từ form
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    if (!$id) {
        die("ID album không hợp lệ.");
    }

    if (!isset($_POST['request']['tenAlbum']) || !isset($_POST['request']['caSi']) || !isset($_POST['request']['ngayPhatHanh'])) {
        die("Dữ liệu không hợp lệ! Vui lòng kiểm tra lại form.");
    }

    $album = [
        "ten_album" => $_POST['request']['tenAlbum'],
        "id_casi" => $_POST['request']['caSi'],
        "ngay_phathanh" => $_POST['request']['ngayPhatHanh']
    ];

    $apiUrl = "http://192.168.83.1:8080/api/album/update/id=" . $id;

    $response = sendDataToApi($apiUrl, $_FILES['img'], $album);
    echo $response;
}

function sendDataToApi($url, $img, $json)
{
    $boundary = uniqid();
    $headers = [
        "Content-Type: multipart/form-data; boundary=$boundary"
    ];

    $body = '';

    if (isset($img['error']) && $img['error'] === UPLOAD_ERR_OK) {
        $imgContent = file_get_contents($img['tmp_name']);
        $body .= "--$boundary\r\n";
        $body .= "Content-Disposition: form-data; name=\"img\"; filename=\"" . $img['name'] . "\"\r\n";
        $body .= "Content-Type: " . $img['type'] . "\r\n\r\n";
        $body .= $imgContent . "\r\n";
    }

    $body .= "--$boundary\r\n";
    $body .= "Content-Disposition: form-data; name=\"album\"\r\n";
    $body .= "Content-Type: application/json\r\n\r\n";
    $body .= json_encode($json) . "\r\n";


    $body .= "--$boundary--";


    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); // Sử dụng PUT để cập nhật
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


    $response = curl_exec($ch);

    // Kiểm tra lỗi nếu có
    if ($response === false) {
        $error = curl_error($ch);
        curl_close($ch);
        return "Lỗi cURL: $error";
    }

    // Kiểm tra mã HTTP trả về từ API
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode === 200) {
        header("Location: ../../index2.php?tab=form3");
        return "Cập nhật album thành công!";
    } else {
        return "Lỗi cập nhật album: HTTP $httpCode\n$response";
    }
}
?>