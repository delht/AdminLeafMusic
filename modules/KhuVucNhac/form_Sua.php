<?php
$id = isset($_GET['id']) ? $_GET['id'] : null;
$khuvuc = null;

if ($id) {
    $apiUrl = "http://192.168.83.1:8080/api/khuvuc/getMot/id=" . $id;
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