<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $tenKhuVuc = isset($_POST['tenKhuVuc']) ? $_POST['tenKhuVuc'] : null;

    if (!$tenKhuVuc) {
        die("Tên khu vực không hợp lệ!");
    }

    $data = [
        "ten_khuvuc" => $tenKhuVuc
    ];

    $jsonData = json_encode($data);

    $url = 'http://192.168.83.1:8080/api/khuvuc/add';

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($jsonData)
    ]);

    $response = curl_exec($ch);

    if ($response === false) {
        die('Lỗi cURL: ' . curl_error($ch));
    }

    curl_close($ch);

    echo "Thêm khu vực thành công: " . $response;
}
?>