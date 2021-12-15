<?php

session_start();
$id = $_SESSION['id_s'];

$conn = new mysqli('localhost', 'root', 'root', 'z_cargo');

if ($conn->connect_error){
    echo '数据库连接失败！';
    exit(0);
}

date_default_timezone_set("Asia/Hong_Kong");
$time = date('Y-m-d H:i:s');

$truck_id_g = $_GET['truck_id'];


//print_r($Quest_id_g);
//print_r($Q_vol_g);
//print_r($Q_dest_g);
//echo $Truck_id;


$sql = "update freight_info SET fre_state = 3,fre_arr_time = '$time' where fre_truck_id = '$truck_id_g';";
$result = $conn->query($sql);

$truck_sql = "update truck_info SET truck_state = 0 where truck_id = '$truck_id_g';";
$result_t = $conn->query($truck_sql);


//$sql = "update freight_info SET fre_driver_id = $id where fre_id = '$Quest_id_g'";
//echo $sql;
//$result = $conn->query($sql);

echo '<script>window.location="fre-ready.php";</script>';
