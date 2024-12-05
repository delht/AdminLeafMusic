<?php
$tab = isset($_GET['tab']) ? $_GET['tab'] : 'form1';

switch ($tab) {
    case 'form1':
        echo '<h2>Danh sách bài hát</h2>';
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
        echo '<h2>Danh sách ca sĩ</h2>';
        $apiUrl = "http://192.168.1.13:8080/api/casi/all";
        $response = file_get_contents($apiUrl);
        
        if ($response === FALSE) {
            echo "<p>Lỗi khi tải dữ liệu từ API.</p>";
        } else {
            $caSis = json_decode($response, true);
            if (!empty($caSis)) {
                echo '<table border="1">';
                echo '<tr><th>Tên ca sĩ</th><th>Chức năng</th></tr>';
                foreach ($caSis as $casi) {
                    echo '<tr>';
                    // echo '<td>' . htmlspecialchars($baiHat['idBaiHat']) . '</td>';
                    echo '<td>' . htmlspecialchars($casi['tenCaSi']) . '</td>';
                    echo '<td>
                     <a href="?tab=form2&action=sua&id=' . htmlspecialchars($casi['idCaSi']) . '">Sửa</a> | 
                    <a href="modules/CaSi/delete_CaSi.php?id=' . htmlspecialchars($casi['idCaSi']) . '" onclick="return confirm(\'Bạn có chắc chắn muốn xóa?\')">Xóa</a>
                    </td>';
                    echo '</tr>';
                }
                echo '</table>';
            } else {
                echo "<p>Không có dữ liệu để hiển thị.</p>";
            }
        }
        break;

    case 'form3':
        echo '<h2>Danh sách album</h2>';
        $apiUrl = "http://192.168.1.13:8080/api/album/all";
        $response = file_get_contents($apiUrl);
        
        if ($response === FALSE) {
            echo "<p>Lỗi khi tải dữ liệu từ API.</p>";
        } else {
            $albums = json_decode($response, true);
            if (!empty($albums)) {
                echo '<table border="1">';
                echo '<tr><th>Tên album</th><th>Chức năng</th></tr>';
                foreach ($albums as $album) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($album['tenAlbum']) . '</td>';
                    echo '<td>
                     <a href="?tab=form3&action=sua&id=' . htmlspecialchars($album['idAlbum']) . '">Sửa</a> | 
                    <a href="modules/Album/delete_Album.php?id=' . htmlspecialchars($album['idAlbum']) . '" onclick="return confirm(\'Bạn có chắc chắn muốn xóa?\')">Xóa</a>
                    </td>';
                    echo '</tr>';
                }
                echo '</table>';
            } else {
                echo "<p>Không có dữ liệu để hiển thị.</p>";
            }
        }
        break;
        
    case 'form4':
        echo '<h2>Danh sách thể loại</h2>';
        $apiUrl = "http://192.168.1.13:8080/api/theloai/all";
        $response = file_get_contents($apiUrl);
            
        if ($response === FALSE) {
                echo "<p>Lỗi khi tải dữ liệu từ API.</p>";
        } else {
                $theloais = json_decode($response, true);
                if (!empty($theloais)) {
                    echo '<table border="1">';
                    echo '<tr><th>Tên thể loại</th><th>Chức năng</th></tr>';
                    foreach ($theloais as $theloai) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($theloai['tenTheLoai']) . '</td>';
                        echo '<td>
                         <a href="?tab=form4&action=sua&id=' . htmlspecialchars($theloai['idTheLoai']) . '">Sửa</a> | 
                        <a href="modules/TheLoai/delete_TheLoai.php?id=' . htmlspecialchars($theloai['idTheLoai']) . '" onclick="return confirm(\'Bạn có chắc chắn muốn xóa?\')">Xóa</a>
                        </td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                } else {
                    echo "<p>Không có dữ liệu để hiển thị.</p>";
                }
        }
        break;

    case 'form5':
        echo '<h2>Danh sách khu vực</h2>';
        $apiUrl = "http://192.168.1.13:8080/api/khuvuc/all";
        $response = file_get_contents($apiUrl);
                
        if ($response === FALSE) {
                    echo "<p>Lỗi khi tải dữ liệu từ API.</p>";
        } else {
                    $khuvucs = json_decode($response, true);
                    if (!empty($khuvucs)) {
                        echo '<table border="1">';
                        echo '<tr><th>Tên khu vực</th><th>Chức năng</th></tr>';
                        foreach ($khuvucs as $khuvuc) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($khuvuc['tenKhuVuc']) . '</td>';
                            echo '<td>
                             <a href="?tab=form5&action=sua&id=' . htmlspecialchars($khuvuc['idKhuVuc']) . '">Sửa</a> | 
                            <a href="modules/KhuVucNhac/delete_KhuVuc.php?id=' . htmlspecialchars($khuvuc['idKhuVuc']) . '" onclick="return confirm(\'Bạn có chắc chắn muốn xóa?\')">Xóa</a>
                            </td>';
                            echo '</tr>';
                        }
                        echo '</table>';
                    } else {
                        echo "<p>Không có dữ liệu để hiển thị.</p>";
                    }
        }
        break;
             
    default:
        echo '<h2>Chọn một tab để quản lý</h2>';
        break;
}
?>