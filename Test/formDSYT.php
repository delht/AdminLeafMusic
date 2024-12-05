<?php
    // include ("config/connect.php"); 
?>
<br>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm yêu thích</title>
</head>

<body>
    <h2>Thêm bài hát yêu thích</h2>
    <form action="submit.php" method="POST">
        <label for="idTaiKhoan">ID Tài Khoản:</label>
        <input type="number" id="idTaiKhoan" name="idTaiKhoan" required><br><br>

        <label for="idBaiHat">ID Bài Hát:</label>
        <input type="number" id="idBaiHat" name="idBaiHat" required><br><br>

        <button type="submit">Thêm vào yêu thích</button>
    </form>
</body>

</html>