<?php
if (isset($_GET['id'])) {
    $idBaiHat = $_GET['id'];

    $apiUrl = "http://192.168.83.1:8080/api/album/delete/id=" . $idBaiHat;

    $options = [
        "http" => [
            "method" => "DELETE",
            "header" => "Content-Type: application/json\r\n",
        ]
    ];
    $context = stream_context_create($options);
    $response = file_get_contents($apiUrl, false, $context);

    if ($response === FALSE) {
        echo "Lỗi khi xóa album.";
    } else {
        header("Location: ../../index2.php?tab=form3");
        exit;
    }
} else {
    echo "ID album không hợp lệ!";
}
?>