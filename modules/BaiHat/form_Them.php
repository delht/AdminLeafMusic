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