<?php
$id = isset($_GET['id']) ? $_GET['id'] : null;
$theloai = null;

if ($id) {
    $apiUrl = "http://192.168.83.1:8080/api/theloai/getMot/id=" . $id;
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