<?php
$id = isset($_GET['id']) ? $_GET['id'] : null;
$theloai = null;

if ($id) {
    $apiUrl = "http://192.168.1.13:8080/api/theloai/getMot/id=" . $id;
    $response = file_get_contents($apiUrl);

    if ($response !== FALSE) {
        $apiData = json_decode($response, true);

        $theloai = [
            'idTheLoai' => $apiData['idTheLoai'],
            'tenTheLoai' => $apiData['tenTheLoai'],
        ];
    }
}
?>

<?php if ($theloai): ?>
<h2>Chỉnh sửa thể loại</h2>
<form action="modules/TheLoai/update_TheLoai.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $id; ?>">

    <label for="tenTheLoai">Tên thể loại:</label><br>
    <input type="text" id="tenTheLoai" name="tenTheLoai" value="<?php echo htmlspecialchars($theloai['tenTheLoai']); ?>"
        required><br><br>


    <button type="submit">Cập nhật thẻ loại</button>
</form>
<?php else: ?>
<p>Không tìm thấy thể loại.</p>
<?php endif; ?>