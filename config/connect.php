<?php

    $host = 'mysql-8.0.40';
    $dbname = 'leafmusic2';
    $username = 'root';
    $password = 'root';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Kết nối MySQL thành công!";
    } catch (PDOException $e) {
        echo "Lỗi kết nối: " . $e->getMessage();
    }

?>