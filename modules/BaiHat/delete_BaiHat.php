<?php
// Kiểm tra xem có tham số 'id' trong URL không
if (isset($_GET['id'])) {
    $idBaiHat = $_GET['id'];

    // URL của API để xóa bài hát
    $apiUrl = "http://192.168.1.13:8080/api/baihat/delete/id=" . $idBaiHat;

    // Sử dụng file_get_contents để gửi yêu cầu DELETE
    $options = [
        "http" => [
            "method" => "DELETE",
            "header" => "Content-Type: application/json\r\n",
        ]
    ];
    $context = stream_context_create($options);
    $response = file_get_contents($apiUrl, false, $context);

    // Kiểm tra xem yêu cầu có thành công không
    if ($response === FALSE) {
        echo "Lỗi khi xóa bài hát.";
    } else {
        // Sau khi xóa, chuyển hướng lại trang danh sách bài hát
        header("Location: ../../index.php?tab=form1");
        exit;
    }
} else {
    echo "ID bài hát không hợp lệ!";
}
?>