<?php
    define('USERNAME', 'laravel_user');
    define('PASSWORD', 'laravel_pass');

    try {
        /// DB接続を試みる
        $db  = new PDO('mysql:host=host.docker.internal;dbname=laravel_db;port=3306', USERNAME, PASSWORD);
        $msg = "MySQL への接続確認が取れました。";
        } catch (PDOException $e) {
        $isConnect = false;
        $msg       = "MySQL への接続に失敗しました。<br>(" . $e->getMessage() . ")";
    }

// レコード更新

    $sql = "UPDATE FROM TodoList SET Text = '" . $Text. "', Title = '" . $Title . "' WHERE Id = " . $Id;
    var_dump($sql);
    exit();
    if ($db->query($sql) == TRUE) {
        header("Location: list.php");
    } else {
        echo "Error updating record: " . $db->errorInfo()[0];
    }
    $db = null;
?>