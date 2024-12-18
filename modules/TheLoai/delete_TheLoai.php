<?php
if (isset($_GET['id'])) {
    $idTheLoai = $_GET['id'];

    $apiUrl = "http://192.168.83.1:8080/api/theloai/delete/id=" . $idTheLoai;

    $options = [
        "http" => [
            "method" => "DELETE",
            "header" => "Content-Type: application/json\r\n",
        ]
    ];
    $context = stream_context_create($options);
    $response = file_get_contents($apiUrl, false, $context);

    if ($response === FALSE) {
        echo "Lỗi khi xóa thể loại.";
    } else {
        header("Location: ../../index.php?tab=form4");
        exit;
    }
} else {
    echo "ID thể loại không hợp lệ!";
}
?>