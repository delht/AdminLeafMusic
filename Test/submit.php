<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $idTaiKhoan = $_POST['idTaiKhoan'];
    $idBaiHat = $_POST['idBaiHat'];

    // Tạo dữ liệu JSON
    $data = array(
        "idTaiKhoan" => $idTaiKhoan,
        "idBaiHat" => $idBaiHat
    );
    $data_json = json_encode($data);

    // Khởi tạo cURL
    $ch = curl_init();

    // Đặt URL của API Spring Boot
    curl_setopt($ch, CURLOPT_URL, "http://host.docker.internal:8080/api/dsyeuthich/add");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json",
        "Content-Length: " . strlen($data_json)
    ));

    // Thực hiện cURL và nhận kết quả
    $response = curl_exec($ch);

    // Kiểm tra mã lỗi HTTP
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($response === FALSE) {
        // Lỗi kết nối
        echo "Lỗi kết nối API: " . curl_error($ch);
    } else {
        // Kiểm tra mã trạng thái HTTP
        if ($http_code == 200) {
            echo "Yêu thích đã được thêm thành công!";
        } elseif ($http_code == 404) {
            echo "Không tìm thấy API hoặc đường dẫn không chính xác.";
        } else {
            echo "Lỗi xảy ra với mã lỗi HTTP: " . $http_code;
        }
    }

    // Đóng cURL
    curl_close($ch);
}
?>