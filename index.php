<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý</title>
    <link rel="stylesheet" href="css/style.css">

    <style>
    /* Reset margin và padding */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Thiết lập font chữ mặc định */
    /* body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        color: #333;
        padding: 20px;
    } */

    /* Định dạng tiêu đề */
    h2 {
        color: #2c3e50;
        margin-bottom: 20px;
    }

    /* Tạo kiểu cho bảng */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    /* Định dạng các ô trong bảng */
    th,
    td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
    }

    /* Màu nền cho các tiêu đề bảng */
    th {
        background-color: #3498db;
        color: white;
    }

    /* Định dạng các đường liên kết */
    a {
        color: #3498db;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    /* Định dạng các ô có nội dung cảnh báo */
    a:active {
        color: #2980b9;
    }

    /* Định dạng cho thông báo lỗi */
    p {
        color: #e74c3c;
    }

    /* Định dạng cho các trường hợp không có dữ liệu */
    .no-data {
        color: #95a5a6;
        font-style: italic;
    }
    </style>

</head>

<body>
    <div class="container">
        <div class="sidebar">
            <ul>
                <li><a href="?tab=form1">Quản lý bài hát</a></li>
                <li><a href="?tab=form2">Quản lý ca sĩ</a></li>
                <li><a href="?tab=form3">Quản lý Album</a></li>
                <li><a href="?tab=form4">Quản lý Thể loại</a></li>
                <li><a href="?tab=form5">Quản lý khu vực nhạc</a></li>
            </ul>
        </div>

        <div class="content">
            <?php
            
            $tab = isset($_GET['tab']) ? $_GET['tab'] : 'form1';
            $action = isset($_GET['action']) ? $_GET['action'] : null;
            $id = isset($_GET['id']) ? $_GET['id'] : null;
            
            if ($tab == 'form1') {
                if ($action == 'sua' && $id) {
                    include 'modules/Baihat/form_Sua.php';
                } else {
                    include 'modules/Baihat/form_Them.php';
                }
            } elseif ($tab == 'form2') {
                if ($action == 'sua' && $id) {
                    include 'modules/CaSi/form_Sua.php';
                } else {
                    include 'modules/CaSi/form_Them.php';
                }
            } elseif ($tab == 'form3') {
                if ($action == 'sua' && $id) {
                    include 'modules/Album/form_Sua.php';
                } else {
                    include 'modules/Album/form_Them.php';
                }
            } elseif ($tab == 'form4') {
                if ($action == 'sua' && $id) {
                    include 'modules/TheLoai/form_Sua.php';
                } else {
                    include 'modules/TheLoai/form_Them.php';
                }
            } elseif ($tab == 'form5') {
                if ($action == 'sua' && $id) {
                    include 'modules/KhuVucNhac/form_Sua.php';
                } else {
                    include 'modules/KhuVucNhac/form_Them.php';
                }
            }
            ?>
        </div>

        <div class="list">
            <?php
            $tab = isset($_GET['tab']) ? $_GET['tab'] : 'form1';
            include 'list.php';
            ?>
        </div>

    </div>
</body>

</html>