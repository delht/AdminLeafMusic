<?php
$id = isset($_GET['id']) ? $_GET['id'] : null;

$baiHat = null;
if ($id) {
    $apiUrl = "http://192.168.1.13:8080/api/baihat/get/id=" . $id;
    $response = file_get_contents($apiUrl);

    if ($response !== FALSE) {
        $baiHat = json_decode($response, true);
    }
}
?>

<?php if ($baiHat): ?>
<h2>Chỉnh sửa Bài hát</h2>
<form action="modules/BaiHat/update_BaiHat.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $id; ?>">

    <label for="tenBaiHat">Tên bài hát:</label><br>
    <input type="text" id="tenBaiHat" name="request[tenBaiHat]"
        value="<?php echo htmlspecialchars($baiHat['tenBaiHat']); ?>" required><br><br>

    <label for="caSi">Ca sĩ:</label><br>
    <input type="number" id="caSi" name="request[caSi]"
        value="<?php echo htmlspecialchars($baiHat['caSi']['idCaSi']); ?>" required><br><br>

    <label for="theLoai">Thể loại:</label><br>
    <input type="number" id="theLoai" name="request[theLoai]"
        value="<?php echo htmlspecialchars($baiHat['theLoai']['idTheLoai']); ?>" required><br><br>

    <label for="album">Album:</label><br>
    <input type="number" id="album" name="request[album]"
        value="<?php echo htmlspecialchars($baiHat['album']['idAlbum']); ?>" required><br><br>

    <label for="khuVucNhac">Khu vực nhạc:</label><br>
    <input type="number" id="khuVucNhac" name="request[khuVucNhac]"
        value="<?php echo htmlspecialchars($baiHat['khuVuc']['idKhuVuc']); ?>" required><br><br>

    <?php
            if (isset($baiHat['ngayPhatHanh']) && is_array($baiHat['ngayPhatHanh'])):
                $ngayPhatHanh = sprintf('%04d-%02d-%02dT%02d:%02d', 
                    $baiHat['ngayPhatHanh'][0], // Năm
                    $baiHat['ngayPhatHanh'][1], // Tháng
                    $baiHat['ngayPhatHanh'][2], // Ngày
                    $baiHat['ngayPhatHanh'][3], // Giờ
                    $baiHat['ngayPhatHanh'][4]  // Phút
                );
            ?>
    <label for="ngayPhatHanh">Ngày phát hành:</label><br>
    <input type="datetime-local" id="ngayPhatHanh" name="request[ngayPhatHanh]" value="<?php echo $ngayPhatHanh; ?>"
        required><br><br>
    <?php else: ?>
    <p>Ngày phát hành không hợp lệ.</p>
    <?php endif; ?>

    <label for="file">Tải lên file nhạc (nếu có):</label><br>
    <input type="file" id="file" name="file" accept=".mp3"><br><br>

    <label for="img">Tải lên hình ảnh (nếu có):</label><br>
    <input type="file" id="img" name="img" accept="image/*"><br><br>

    <button type="submit">Cập nhật bài hát</button>
</form>
<?php else: ?>
<p>Không tìm thấy bài hát.</p>
<?php endif; ?>