<?php
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id) {
    // Gọi API để lấy dữ liệu chi tiết bài hát
    $apiUrl = "http://192.168.1.13:8080/api/baihat/get/id=" . $id;
    $response = file_get_contents($apiUrl);

    if ($response === FALSE) {
        echo "<p>Lỗi khi tải dữ liệu từ API.</p>";
    } else {
        $baiHat = json_decode($response, true);

        if ($baiHat) {
            // Đổ dữ liệu lên form chỉnh sửa
            echo '<h2>Chỉnh sửa Bài hát</h2>';
            echo '<form action="update_baihat_process.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="' . $id . '">

                    <label for="tenBaiHat">Tên bài hát:</label><br>
                    <input type="text" id="tenBaiHat" name="request[tenBaiHat]" value="' . htmlspecialchars($baiHat['tenBaiHat']) . '" required><br><br>

                    <label for="caSi">Ca sĩ:</label><br>
                    <input type="number" id="caSi" name="request[caSi]" value="' . htmlspecialchars($baiHat['caSi']['idCaSi']) . '" required><br><br>

                    <label for="theLoai">Thể loại:</label><br>
                    <input type="number" id="theLoai" name="request[theLoai]" value="' . htmlspecialchars($baiHat['theLoai']['idTheLoai']) . '" required><br><br>

                    <label for="album">Album:</label><br>
                    <input type="number" id="album" name="request[album]" value="' . htmlspecialchars($baiHat['album']['idAlbum']) . '" required><br><br>

                    <label for="khuVucNhac">Khu vực nhạc:</label><br>
                    <input type="number" id="khuVucNhac" name="request[khuVucNhac]" value="' . htmlspecialchars($baiHat['khuVuc']['idKhuVuc']) . '" required><br><br>';

            // Kiểm tra ngày phát hành và định dạng lại
            if (isset($baiHat['ngayPhatHanh']) && is_array($baiHat['ngayPhatHanh'])) {
                // Kết hợp các giá trị từ mảng thành chuỗi ngày tháng hợp lệ
                $ngayPhatHanh = sprintf('%04d-%02d-%02dT%02d:%02d', 
                    $baiHat['ngayPhatHanh'][0], // Năm
                    $baiHat['ngayPhatHanh'][1], // Tháng
                    $baiHat['ngayPhatHanh'][2], // Ngày
                    $baiHat['ngayPhatHanh'][3], // Giờ
                    $baiHat['ngayPhatHanh'][4]  // Phút
                );
                // Hiển thị input form với giá trị đã định dạng
                echo '<label for="ngayPhatHanh">Ngày phát hành:</label><br>
                      <input type="datetime-local" id="ngayPhatHanh" name="request[ngayPhatHanh]" value="' . $ngayPhatHanh . '" required><br><br>';
            } else {
                echo "<p>Ngày phát hành không hợp lệ.</p>";
            }

            echo '<label for="file">Tải lên file nhạc (nếu có):</label><br>
                  <input type="file" id="file" name="file" accept=".mp3"><br><br>

                  <label for="img">Tải lên hình ảnh (nếu có):</label><br>
                  <input type="file" id="img" name="img" accept="image/*"><br><br>

                  <button type="submit">Cập nhật bài hát</button>
              </form>';
        } else {
            echo "<p>Không tìm thấy bài hát.</p>";
        }
    }
} else {
    echo '<h2>Chọn một bài hát để chỉnh sửa</h2>';
}
?>