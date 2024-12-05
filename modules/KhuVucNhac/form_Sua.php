<?php
$id = isset($_GET['id']) ? $_GET['id'] : null;
$khuvuc = null;

if ($id) {
    $apiUrl = "http://192.168.1.13:8080/api/khuvuc/getMot/id=" . $id;
    $response = file_get_contents($apiUrl);

    if ($response !== FALSE) {
        $apiData = json_decode($response, true);

        $khuvuc = [
            'idKhuVuc' => $apiData['idKhuVuc'],
            'tenKhuVuc' => $apiData['tenKhuVuc'],
        ];
    }
}
?>

<?php if ($khuvuc): ?>
<h2>Chỉnh sửa khu vực</h2>
<form action="modules/KhuVucNhac/update_KhuVuc.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $id; ?>">

    <label for="tenkhuvuc">Tên khu vực:</label><br>
    <input type="text" id="tenKhuVuc" name="tenKhuVuc" value="<?php echo htmlspecialchars($khuvuc['tenKhuVuc']); ?>"
        required><br><br>


    <button type="submit">Cập nhật khu vực</button>
</form>
<?php else: ?>
<p>Không tìm thấy khu vực.</p>
<?php endif; ?>