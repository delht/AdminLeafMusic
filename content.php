<?php
switch ($tab) {
    case 'form1':
        echo '<h2>Quản lý Bài hát</h2>';
        echo '<form action="/modules/BaiHat/upload_BaiHat.php" method="POST" enctype="multipart/form-data" target="_blank">
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

                <label for="file">Tải lên file nhạc:</label><br>
                <input type="file" id="file" name="file" accept=".mp3" required><br><br>

                <label for="img">Tải lên hình ảnh:</label><br>
                <input type="file" id="img" name="img" accept="image/*" required><br><br>

                <button type="submit">Gửi bài hát</button>
              </form>';
        break;
    case 'form2':
        echo '<h2>Quản lý Bài hát</h2>';
        echo '<form action="#" method="POST">
                <label for="song">Tên bài hát:</label><br>
                <input type="text" id="song" name="song"><br><br>
                <input type="submit" value="Lưu">
              </form>';
        break;
    case 'form3':
        echo '<h2>Quản lý Album</h2>';
        echo '<form action="#" method="POST">
                <label for="album">Tên Album:</label><br>
                <input type="text" id="album" name="album"><br><br>
                <input type="submit" value="Lưu">
              </form>';
        break;
    default:
        echo '<h2>Chọn một tab để quản lý</h2>';
        break;
}
?>