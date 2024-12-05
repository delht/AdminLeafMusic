<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $apiUrl = "http://192.168.1.13:8080/api/khuvuc/delete/id=" . $id;

    $options = [
        "http" => [
            "method" => "DELETE",
            "header" => "Content-Type: application/json\r\n",
        ]
    ];
    $context = stream_context_create($options);
    $response = file_get_contents($apiUrl, false, $context);

    if ($response === FALSE) {
        echo "Lỗi khi xóa khu vực.";
    } else {
        header("Location: ../../index.php?tab=form5");
        exit;
    }
} else {
    echo "ID khu vực không hợp lệ!";
}
?>