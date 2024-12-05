<?php
$tab = isset($_GET['tab']) ? $_GET['tab'] : 'form1';

switch ($tab) {
    case 'form1':
        echo '<h2>Quản lý Bài hát</h2>';
        $apiUrl = "http://192.168.1.13:8080/api/baihat/all";
        $response = file_get_contents($apiUrl);
        
        if ($response === FALSE) {
            echo "<p>Lỗi khi tải dữ liệu từ API.</p>";
        } else {
            $baiHats = json_decode($response, true);
            if (!empty($baiHats)) {
                echo '<table border="1">';
                echo '<tr><th>Tên bài hát</th><th>Chức năng</th></tr>';
                foreach ($baiHats as $baiHat) {
                    echo '<tr>';
                    // echo '<td>' . htmlspecialchars($baiHat['idBaiHat']) . '</td>';
                    echo '<td>' . htmlspecialchars($baiHat['tenBaiHat']) . '</td>';
                    echo '<td>
                     <a href="?tab=form1&action=sua&id=' . htmlspecialchars($baiHat['idBaiHat']) . '">Sửa</a> | 
                    <a href="modules/Baihat/delete_BaiHat.php?id=' . htmlspecialchars($baiHat['idBaiHat']) . '" onclick="return confirm(\'Bạn có chắc chắn muốn xóa?\')">Xóa</a>
                    </td>';
                    echo '</tr>';
                }
                echo '</table>';
            } else {
                echo "<p>Không có dữ liệu để hiển thị.</p>";
            }
        }
        break;

    case 'form2':
        echo '<h2>Quản lý Ca sĩ</h2>';
        // Tạo form cho form2 nếu cần
        break;

    case 'form3':
        echo '<h2>Quản lý Album</h2>';
        // Tạo form cho form3 nếu cần
        break;

    default:
        echo '<h2>Chọn một tab để quản lý</h2>';
        break;
}
?>