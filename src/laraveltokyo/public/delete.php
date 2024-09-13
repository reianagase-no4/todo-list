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

    parse_str($_SERVER['QUERY_STRING'], $queryArray);
    $id = $queryArray["id"];
    $sql = "DELETE FROM TodoList WHERE Id=" . $id; 
    if ($db->query($sql) == TRUE) {
        header("Location: list.php");
    } else {
        echo "Error deleting record: " . $db->errorInfo()[0];
    }
    $db = null;
?>