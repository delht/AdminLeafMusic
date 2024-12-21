<?php
if (isset($_GET['id'])) {
    $idCaSi = $_GET['id'];

    $apiUrl = "http://192.168.83.1:8080/api/casi/delete/id=" . $idCaSi;

    $options = [
        "http" => [
            "method" => "DELETE",
            "header" => "Content-Type: application/json\r\n",
        ]
    ];
    $context = stream_context_create($options);
    $response = file_get_contents($apiUrl, false, $context);

    if ($response === FALSE) {
        echo "Lỗi khi xóa ca sĩ.";
    } else {
        header("Location: ../../index2.php?tab=form2");
        exit;
    }
} else {
    echo "ID ca sĩ không hợp lệ!";
}
?>