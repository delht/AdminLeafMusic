<h2>Thêm khu vực mới</h2>
<form action="modules/KhuVucNhac/upload_KhuVuc.php" method="POST" enctype="multipart/form-data">
    <label for="tenKhuVuc">Tên khu vực:</label><br>
    <input type="text" id="tenKhuVuc" name="tenKhuVuc" required><br><br>

    <button type="submit">Thêm khu vực</button>
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