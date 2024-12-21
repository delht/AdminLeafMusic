<?php
$id = isset($_GET['id']) ? $_GET['id'] : null;

$album = null;
if ($id) {
    $apiUrl = "http://192.168.83.1:8080/api/album/get/id=" . $id;
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

    <label for="caSi">Ca sĩ:</label><br>
    <select id="caSi" name="request[caSi]" required>
        <option value="" disabled>Chọn ca sĩ</option>
        <?php
        $url = 'http://192.168.83.1:8080/api/casi/all';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        if ($response !== false) {
            $caSisis = json_decode($response, true);
            foreach ($caSisis as $caSi) {
                $selected = ($caSi['idCaSi'] == $album['caSi']['idCaSi']) ? 'selected' : '';
                echo "<option value='" . $caSi['idCaSi'] . "' $selected>" . $caSi['tenCaSi'] . "</option>";
            }
        }
        ?>
    </select><br><br>

    <?php
    if (isset($album['ngayPhatHanh']) && is_array($album['ngayPhatHanh'])):
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

select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    background-color: #f9f9f9;
    font-size: 16px;
    margin-bottom: 10px;
    border-radius: 4px;
    box-sizing: border-box;
    cursor: pointer;
    transition: background-color 0.3s ease, border 0.3s ease;
}

select:focus {
    background-color: #ffffff;
    border-color: #3498db;
    outline: none;
}

select option {
    padding: 10px;
    font-size: 16px;
}
</style>