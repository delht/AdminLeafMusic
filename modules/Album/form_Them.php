<h2>Thêm album mới</h2>
<form action="modules/Album/upload_Album.php" method="POST" enctype="multipart/form-data">
    <label for="tenAlbum">Tên album:</label><br>
    <input type="text" id="tenAlbum" name="request[tenAlbum]" required><br><br>

    <label for="idCaSi">Ca sĩ:</label><br>
    <input type="number" id="idCaSi" name="request[idCaSi]" required><br><br>

    <label for="ngayPhatHanh">Ngày phát hành:</label><br>
    <input type="datetime-local" id="ngayPhatHanh" name="request[ngayPhatHanh]" required><br><br>

    <label for="img">Tải lên hình ảnh (nếu có):</label><br>
    <input type="file" id="img" name="img" accept="image/*"><br><br>

    <button type="submit">Thêm album</button>
</form>