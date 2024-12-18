<?php
$id = isset($_GET['id']) ? $_GET['id'] : null;

$baiHat = null;
if ($id) {
    $apiUrl = "http://192.168.83.1:8080/api/baihat/get/id=" . $id;
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
                $selected = ($caSi['idCaSi'] == $baiHat['caSi']['idCaSi']) ? 'selected' : '';
                echo "<option value='" . $caSi['idCaSi'] . "' $selected>" . $caSi['tenCaSi'] . "</option>";
            }
        }
        ?>
    </select><br><br>

    <label for="theLoai">Thể loại:</label><br>
    <select id="theLoai" name="request[theLoai]" required>
        <option value="" disabled>Chọn thể loại</option>
        <?php
        $url = 'http://192.168.83.1:8080/api/theloai/all';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        if ($response !== false) {
            $theLoais = json_decode($response, true);
            foreach ($theLoais as $theLoai) {
                $selected = ($theLoai['idTheLoai'] == $baiHat['theLoai']['idTheLoai']) ? 'selected' : '';
                echo "<option value='" . $theLoai['idTheLoai'] . "' $selected>" . $theLoai['tenTheLoai'] . "</option>";
            }
        }
        ?>
    </select><br><br>

    <label for="album">Album:</label><br>
    <select id="album" name="request[album]" required>
        <option value="" disabled>Chọn album</option>
        <?php
        $url = 'http://192.168.83.1:8080/api/album/all';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        if ($response !== false) {
            $albums = json_decode($response, true);
            foreach ($albums as $album) {
                $selected = ($album['idAlbum'] == $baiHat['album']['idAlbum']) ? 'selected' : '';
                echo "<option value='" . $album['idAlbum'] . "' $selected>" . $album['tenAlbum'] . "</option>";
            }
        }
        ?>
    </select><br><br>

    <label for="khuVucNhac">Khu vực nhạc:</label><br>
    <select id="khuVucNhac" name="request[khuVucNhac]" required>
        <option value="" disabled>Chọn khu vực</option>
        <?php
        $url = 'http://192.168.83.1:8080/api/khuvuc/all';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        if ($response !== false) {
            $khuVucs = json_decode($response, true);
            foreach ($khuVucs as $khuVuc) {
                $selected = ($khuVuc['idKhuVuc'] == $baiHat['khuVuc']['idKhuVuc']) ? 'selected' : '';
                echo "<option value='" . $khuVuc['idKhuVuc'] . "' $selected>" . $khuVuc['tenKhuVuc'] . "</option>";
            }
        }
        ?>
    </select><br><br>

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