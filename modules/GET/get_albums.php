<?php
// get_albums.php

// Gọi API để lấy danh sách album
$url = 'http://192.168.83.1:8080/api/album/all'; // Địa chỉ API
$ch = curl_init($url);

// Cấu hình cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);

// Đóng kết nối cURL
curl_close($ch);

// Kiểm tra nếu có lỗi xảy ra khi gọi API
if ($response === false) {
    echo "<option disabled>Có lỗi khi tải dữ liệu album</option>";
} else {
    // Giải mã dữ liệu JSON
    $albums = json_decode($response, true);

    // Kiểm tra nếu có album
    if (is_array($albums)) {
        foreach ($albums as $album) {
            echo "<option value='" . $album['idAlbum'] . "'>" . $album['tenAlbum'] . "</option>";
        }
    } else {
        echo "<option disabled>Không có album nào</option>";
    }
}
?>