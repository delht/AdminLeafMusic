<h2>Thêm ca sĩ mới</h2>
<form action="modules/CaSi/upload_CaSi.php" method="POST" enctype="multipart/form-data">
    <label for="tenCaSi">Tên ca sĩ:</label><br>
    <input type="text" id="tenCaSi" name="ten_casi" required><br><br>
    <!-- tên ca sĩ phải trùng tên tham số trong PHP -->

    <label for="img">Tải lên hình ảnh (nếu có):</label><br>
    <input type="file" id="img" name="img" accept="image/*"><br><br>

    <button type="submit">Thêm ca sĩ</button>
</form>