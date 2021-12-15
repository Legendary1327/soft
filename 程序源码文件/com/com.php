<?php
session_start();
$id = $_SESSION['id_s'];

$conn = new mysqli('localhost', 'root', 'root', 'z_cargo');

if ($conn->connect_error){
    echo '数据库连接失败！';
    exit(0);
}
?>