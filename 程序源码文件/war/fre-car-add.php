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

$Quest_id_g = $_GET['Qid'];
$Q_vol_g = $_GET['Q_vol'];
$Q_dest_g = $_GET['Q_dest'];
$Truck_id = $_GET['Truck_id'];
$Q_comp_name = $_GET['Q_comp'];



$number_add = count($Quest_id_g, 1);

for($i = 0; $i < $number_add; $i++){
    $sql_changeReqToFre = "select * from cargo_request where req_id = '$Quest_id_g[$i]';";
    $result_change = $conn->query($sql_changeReqToFre);
    $row = mysqli_fetch_assoc($result_change);
    $destination_row = $row['req_cargo_dest_comp'];
    $vol_row = $row['req_total_vol'];


    $sql_per = "INSERT INTO freight_info(fre_id, fre_dest_comp, fre_destination, fre_truck_id, 
fre_total_vol, fre_state, fre_start_time) VALUES ('$Quest_id_g[$i]','$Q_comp_name[$i]','$destination_row','$Truck_id',$vol_row,1,'$time');";
//    echo $sql_per;
//            $sql = "update freight_info SET fre_truck_id = '$Truck_id',fre_start_time = '$time',fre_state = 1 where fre_id = '$Quest_id_g[$i]';";
    $result = $conn->query($sql_per);

//    echo $sql;
}
$truck_sql = "update truck_info SET truck_state = 1, truck_dep_time = '$time' where truck_id = '$Truck_id';";
$result_t = $conn->query($truck_sql);
//$sql = "update freight_info SET fre_driver_id = $id where fre_id = '$Quest_id_g'";
//echo $sql;
//$result = $conn->query($sql);

echo '<script>window.location="fre-ready.php";</script>';
