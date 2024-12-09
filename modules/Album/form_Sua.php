<?php
$id = isset($_GET['id']) ? $_GET['id'] : null;

$album = null;
if ($id) {
    $apiUrl = "http://192.168.1.13:8080/api/album/get/id=" . $id;
    $response = file_get_contents($apiUrl);

    if ($response !== FALSE) {
        $apiData = json_decode($response, true);

        // Cập nhật dữ liệu album với các trường cần thiết từ API
        $album = [
            'idAlbum' => $apiData['idAlbum'],
            'tenAlbum' => $apiData['tenAlbum'],
            // 'tenCaSi' => $apiData['tenCaSi'],
            'idCaSi' => $apiData['idCaSi'],
            'ngayPhatHanh' => $apiData['ngayPhatHanh']
        ];
    }
}
?>

<?php if ($album): ?>
<h2>Chỉnh sửa album</h2>
<form action="modules/Album/update_Album.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $id; ?>">

    <label for="tenAlbum">Tên album:</label><br>
    <input type="text" id="tenAlbum" name="request[tenAlbum]"
        value="<?php echo htmlspecialchars($album['tenAlbum']); ?>" required><br><br>

    <label for="idCaSi">Ca sĩ:</label><br>
    <input type="number" id="idCaSi" name="request[idCaSi]" value="<?php echo htmlspecialchars($album['idCaSi']); ?>"
        required><br><br>

    <?php
        if (isset($album['ngayPhatHanh']) && is_array($album['ngayPhatHanh']) && count($album['ngayPhatHanh']) == 5):
            $ngayPhatHanh = sprintf('%04d-%02d-%02dT%02d:%02d', 
                $album['ngayPhatHanh'][0], // Năm
                $album['ngayPhatHanh'][1], // Tháng
                $album['ngayPhatHanh'][2], // Ngày
                $album['ngayPhatHanh'][3], // Giờ
                $album['ngayPhatHanh'][4]  // Phút
            );
    ?>
    <label for="ngayPhatHanh">Ngày phát hành:</label><br>
    <input type="datetime-local" id="ngayPhatHanh" name="request[ngayPhatHanh]" value="<?php echo $ngayPhatHanh; ?>"
        required><br><br>
    <?php else: ?>
    <p>Ngày phát hành không hợp lệ.</p>
    <?php endif; ?>

    <label for="img">Tải lên hình ảnh (nếu có):</label><br>
    <input type="file" id="img" name="img" accept="image/*"><br><br>

    <button type="submit">Cập nhật album</button>
</form>
<?php else: ?>
<p>Không tìm thấy album.</p>
<?php endif; ?>