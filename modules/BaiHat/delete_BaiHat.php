<?php
if (isset($_GET['id'])) {
    $idBaiHat = $_GET['id'];

    $apiUrl = "http://192.168.1.13:8080/api/baihat/delete/id=" . $idBaiHat;

    $options = [
        "http" => [
            "method" => "DELETE",
            "header" => "Content-Type: application/json\r\n",
        ]
    ];
    $context = stream_context_create($options);
    $response = file_get_contents($apiUrl, false, $context);

    if ($response === FALSE) {
        echo "Lỗi khi xóa bài hát.";
    } else {
        header("Location: ../../index.php?tab=form1");
        exit;
    }
} else {
    echo "ID bài hát không hợp lệ!";
}
?>