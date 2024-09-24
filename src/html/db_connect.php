<?php
define('USERNAME', 'laravel_user');
define('PASSWORD', 'laravel_pass');

$error_message = null;
function db_connect() {
    $db = new PDO('mysql:host=host.docker.internal;dbname=laravel_db;port=3306', USERNAME, PASSWORD);
    return $db;
}
?>