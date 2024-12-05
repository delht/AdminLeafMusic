<?php
$id = isset($_GET['id']) ? $_GET['id'] : null;

$caSi = null; // Dữ liệu ca sĩ
if ($id) {
    $apiUrl = "http://192.168.1.13:8080/api/casi/get/id=baihat" . $id;
    $response = file_get_contents($apiUrl);

    if ($response !== FALSE) {
        $apiData = json_decode($response, true); // Chuyển đổi JSON thành mảng PHP
        // Chỉ lưu lại idCaSi và tenCaSi
        $caSi = [
            'idCaSi' => $apiData['idCaSi'],
            'tenCaSi' => $apiData['tenCaSi']
        ];
    }
}
?>

<?php if ($caSi): ?>
<h2>Chỉnh sửa Ca sĩ</h2>
<form action="modules/CaSi/update_CaSi.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($caSi['idCaSi']); ?>">

    <label for="ten_casi">Tên ca sĩ:</label><br>
    <input type="text" id="ten_casi" name="ten_casi" value="<?php echo htmlspecialchars($caSi['tenCaSi']); ?>"
        required><br><br>

    <label for="img">Tải lên hình ảnh (nếu có):</label><br>
    <input type="file" id="img" name="img" accept="image/*"><br><br>

    <button type="submit">Cập nhật ca sĩ</button>
</form>

<?php else: ?>
<p>Không tìm thấy thông tin Ca sĩ.</p>
<?php endif; ?>