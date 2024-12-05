<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    if (!$id) {
        die("ID bài hát không hợp lệ.");
    }

    $request = [
        "tenBaiHat" => $_POST['request']['tenBaiHat'],
        "caSi" => $_POST['request']['caSi'],
        "theLoai" => $_POST['request']['theLoai'],
        "album" => $_POST['request']['album'],
        "khuVucNhac" => $_POST['request']['khuVucNhac'],
        "ngayPhatHanh" => $_POST['request']['ngayPhatHanh']
    ];


    $apiUrl = "http://192.168.1.13:8080/api/baihat/update/id=" . $id;

    $response = sendDataToApi($apiUrl, $_FILES['file'], $_FILES['img'], $request);
    echo $response;
}

function sendDataToApi($url, $file, $img, $json)
{
    $boundary = uniqid();
    $headers = [
        "Content-Type: multipart/form-data; boundary=$boundary"
    ];

    $body = '';

    if (isset($file['error']) && $file['error'] === UPLOAD_ERR_OK) {
        $fileContent = file_get_contents($file['tmp_name']);
        $body .= "--$boundary\r\n";
        $body .= "Content-Disposition: form-data; name=\"file\"; filename=\"" . $file['name'] . "\"\r\n";
        $body .= "Content-Type: " . $file['type'] . "\r\n\r\n";
        $body .= $fileContent . "\r\n";
    }

    if (isset($img['error']) && $img['error'] === UPLOAD_ERR_OK) {
        $imgContent = file_get_contents($img['tmp_name']);
        $body .= "--$boundary\r\n";
        $body .= "Content-Disposition: form-data; name=\"img\"; filename=\"" . $img['name'] . "\"\r\n";
        $body .= "Content-Type: " . $img['type'] . "\r\n\r\n";
        $body .= $imgContent . "\r\n";
    }


    $body .= "--$boundary\r\n";
    $body .= "Content-Disposition: form-data; name=\"request\"\r\n";
    $body .= "Content-Type: application/json\r\n\r\n";
    $body .= json_encode($json) . "\r\n";

    $body .= "--$boundary--";

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
        return "Cập nhật bài hát thành công!";
    } else {
        return "Lỗi cập nhật bài hát: HTTP $httpCode\n$response";
    }
}
?>