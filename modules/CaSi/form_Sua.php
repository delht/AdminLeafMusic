<?php
$id = isset($_GET['id']) ? $_GET['id'] : null;

$caSi = null; // Dữ liệu ca sĩ
if ($id) {
    $apiUrl = "http://192.168.83.1:8080/api/casi/get/id=baihat" . $id;
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



<style>
h2 {
    color: #2c3e50;
    margin-bottom: 20px;
}

form {
    background-color: white;
    padding: 20px;
    max-width: 600px;
}

label {
    display: block;
    font-weight: bold;
    color: #555;
}

input[type="text"],
input[type="number"],
input[type="datetime-local"],
input[type="file"] {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    background-color: #f9f9f9;
}

button {
    background-color: #3498db;
    color: white;
    padding: 10px 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    width: 100%;
    transition: background-color 0.3s ease;
}

p.error {
    color: #e74c3c;
    font-size: 14px;
}

form>label,
form>input,
form>button {
    margin-bottom: 0px;
}
</style>