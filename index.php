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