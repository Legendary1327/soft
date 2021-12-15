<?php

session_start();
$id = $_SESSION['id_s'];

$conn = new mysqli('localhost', 'root', 'root', 'z_cargo');

if ($conn->connect_error){
    echo '数据库连接失败！';
    exit(0);
}


$Quest_id_g = $_GET['Qid'];

date_default_timezone_set("Asia/Hong_Kong");
$time = date('Y-m-d H:i:s');

$sql = "update freight_info SET fre_driver_id = $id where fre_id = '$Quest_id_g'";
echo $sql;
$result = $conn->query($sql);

echo '<script>window.location="fre-quest.php";</script>';
