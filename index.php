<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý</title>
    <link rel="stylesheet" href="css/style.css">
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
            
            // Chuyển tiếp tới form quản lý bài hát
            if ($tab == 'form1') {
                if (isset($_GET['id']) && !empty($_GET['id'])) {
                    // Kiểm tra và include form sửa nếu có id
                    include 'modules/Baihat/form_Sua.php';
                } else {
                    // Include form thêm nếu không có id
                    include 'modules/Baihat/form_Them.php';
                }
            } elseif ($tab == 'form2') {
                include 'modules/Casi/form.php';  // Include form quản lý ca sĩ
            } elseif ($tab == 'form3') {
                include 'modules/Album/form.php';  // Include form quản lý album
            } elseif ($tab == 'form4') {
                include 'modules/Theloai/form.php';  // Include form quản lý thể loại
            } elseif ($tab == 'form5') {
                include 'modules/KhuVuc/form.php';  // Include form quản lý khu vực nhạc
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