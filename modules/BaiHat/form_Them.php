<h2>Thêm bài hát mới</h2>
<form action="modules/Baihat/upload_BaiHat.php" method="POST" enctype="multipart/form-data">
    <label for="tenBaiHat">Tên bài hát:</label><br>
    <input type="text" id="tenBaiHat" name="request[tenBaiHat]" required><br><br>

    <label for="caSi">Ca sĩ:</label><br>
    <input type="number" id="caSi" name="request[caSi]" required><br><br>

    <label for="theLoai">Thể loại:</label><br>
    <input type="number" id="theLoai" name="request[theLoai]" required><br><br>

    <label for="album">Album:</label><br>
    <input type="number" id="album" name="request[album]" required><br><br>

    <label for="khuVucNhac">Khu vực nhạc:</label><br>
    <input type="number" id="khuVucNhac" name="request[khuVucNhac]" required><br><br>

    <label for="ngayPhatHanh">Ngày phát hành:</label><br>
    <input type="datetime-local" id="ngayPhatHanh" name="request[ngayPhatHanh]" required><br><br>

    <label for="file">Tải lên file nhạc (nếu có):</label><br>
    <input type="file" id="file" name="file" accept=".mp3"><br><br>

    <label for="img">Tải lên hình ảnh (nếu có):</label><br>
    <input type="file" id="img" name="img" accept="image/*"><br><br>

    <button type="submit">Thêm bài hát</button>
</form>

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