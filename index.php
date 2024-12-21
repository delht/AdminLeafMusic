<?php

session_start();

// Kiểm tra nếu form được gửi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];


    $api_url = "http://192.168.83.1:8080/api/taikhoan/dangnhap2";


    $data = array(
        "username" => $username,
        "password" => $password
    );

    // Cấu hình cURL để gọi API
    $ch = curl_init($api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    // Gửi request và nhận response
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 200) {
        $response_data = json_decode($response, true);

        // Xử lý vai trò và lưu thông tin vào session
        if ($response_data['vaitro'] === 'admin') {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['vaitro'] = 'admin';
            header("Location: index2.php");
            exit;
        } elseif ($response_data['vaitro'] === 'user') {
            $error_message = "Bạn không thể truy cập vào hệ thống!";
        } else {
            $error_message = "Vai trò không xác định!";
        }
    } else {
        $error_message = "Đăng nhập không thành công! Vui lòng kiểm tra lại thông tin.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: rgb(255, 255, 255);
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .login-container {
        background-color: #fff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 300px;
    }

    .login-container h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    /* Form styling */
    form {
        display: flex;
        flex-direction: column;
    }

    label {
        font-weight: bold;
        margin-bottom: 5px;
        color: #555;
    }

    input[type="text"],
    input[type="password"] {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 15px;
        font-size: 14px;
    }

    button {
        padding: 10px;
        background-color: #007BFF;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
    }

    button:hover {
        background-color: #0056b3;
    }

    /* Thông báo lỗi */
    .error-message {
        color: red;
        font-size: 14px;
        margin-bottom: 10px;
        text-align: center;
    }
    </style>
</head>

<body>
    <form method="POST" action="">
        <h2>Đăng nhập</h2>
        <?php if (!empty($error_message)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error_message); ?></p>
        <?php endif; ?>
        <label for="username">Tên đăng nhập:</label><br>
        <input type="text" name="username" id="username" required><br><br>
        <label for="password">Mật khẩu:</label><br>
        <input type="password" name="password" id="password" required><br><br>
        <button type="submit">Đăng nhập</button>
    </form>
</body>

</html>