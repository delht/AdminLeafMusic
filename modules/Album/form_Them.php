<h2>Thêm album mới</h2>
<form action="modules/Album/upload_Album.php" method="POST" enctype="multipart/form-data">
    <label for="tenAlbum">Tên album:</label><br>
    <input type="text" id="tenAlbum" name="request[tenAlbum]" required><br><br>

    <label for="caSi">Ca sĩ:</label><br>
    <select id="caSi" name="request[caSi]" required>
        <option value="" disabled selected>Chọn ca sĩ</option> <!-- Lựa chọn rỗng -->
        <?php
        // URL API lấy danh sách ca sĩ
        $url = 'http://192.168.83.1:8080/api/casi/all';
        
        // Khởi tạo cURL
        $ch = curl_init($url);
        
        // Thiết lập các tùy chọn cURL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        // Thực hiện cURL và lưu kết quả vào biến $response
        $response = curl_exec($ch);
        
        // Đóng kết nối cURL
        curl_close($ch);
        
        // Kiểm tra nếu có lỗi khi tải dữ liệu
        if ($response === false) {
            echo "<option disabled>Có lỗi khi tải dữ liệu ca sĩ</option>";
        } else {
            // Giải mã dữ liệu JSON thành mảng PHP
            $caSisis = json_decode($response, true);
            
            // Kiểm tra nếu mảng ca sĩ tồn tại
            if (is_array($caSisis)) {
                // Lặp qua danh sách ca sĩ và hiển thị trong dropdown
                foreach ($caSisis as $caSi) {
                    echo "<option value='" . $caSi['idCaSi'] . "'>" . $caSi['tenCaSi'] . "</option>";
                }
            } else {
                echo "<option disabled>Không có ca sĩ nào</option>";
            }
        }
        ?>
    </select><br><br>

    <label for="ngayPhatHanh">Ngày phát hành:</label><br>
    <input type="datetime-local" id="ngayPhatHanh" name="request[ngayPhatHanh]" required><br><br>

    <label for="img">Tải lên hình ảnh (nếu có):</label><br>
    <input type="file" id="img" name="img" accept="image/*"><br><br>

    <button type="submit">Thêm album</button>
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