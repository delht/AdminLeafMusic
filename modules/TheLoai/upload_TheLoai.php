<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $tenTheLoai = isset($_POST['tenTheLoai']) ? $_POST['tenTheLoai'] : null;

    if (!$tenTheLoai) {
        die("Tên thể loại không hợp lệ!");
    }

    $data = [
        "ten_theloai" => $tenTheLoai
    ];

    $jsonData = json_encode($data);

    $url = 'http://192.168.1.13:8080/api/theloai/add';

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

    echo "Thêm thể loại thành công: " . $response;
}
?>