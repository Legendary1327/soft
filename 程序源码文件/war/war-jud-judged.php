<?php

session_start();
$id = $_SESSION['id_s'];

$conn = new mysqli('localhost', 'root', 'root', 'z_cargo');

if ($conn->connect_error){
    echo '数据库连接失败！';
    exit(0);
}


$req_id_g = $_GET['Rid_g'];
$req_result_g  = $_GET['result_g'];

date_default_timezone_set("Asia/Hong_Kong");
$time = date('Y-m-d H:i:s');

$sql = "update cargo_request SET req_result=$req_result_g, req_jud_time='$time' where req_id = '$req_id_g';";
$result = $conn->query($sql);
//$number = mysqli_num_rows($result);
//if ($result) {
//    echo '<script>window.location="war-jud.php";</script>';
//} else {
//    echo "alert('ERROR')";
//}
if ($req_result_g == 1)
{
    $sql_desc = "select req_cargo_num, req_cargo_id,req_total_vol,req_cargo_dest_comp from cargo_request where req_id = '$req_id_g';";
    $result_desc = $conn->query($sql_desc);
    $row_desc = mysqli_fetch_assoc($result_desc);
    $tmp = $row_desc['req_cargo_id'];
//    echo "tmp(row_desc['req_cargo_id'])".$tmp;
    $delt_num = $row_desc['req_cargo_num'];
//    echo "delt_num(row_desc['req_cargo_num'])".$delt_num;
    $sql_orgn = "select car_num from cargo_info where car_id = '$tmp';";
    $result_orgn = $conn->query($sql_orgn);
    $row_orgn = mysqli_fetch_assoc($result_orgn);
//    echo "row_orgn['car_num']".$row_orgn['car_num'];
    $new_data = $row_orgn['car_num'] - $delt_num;
//    echo "new_data".$new_data;
//减少库存
//update cargo_info SET car_num = () where req_id = 'R4';
    $sql_del = "update cargo_info SET car_num = $new_data where car_id = '$tmp';";
    $result_del = $conn->query($sql_del);
//    if($result_del){
//    } else{
//    echo "alert('error')";
//    }
    //生成订单
//    $sql_create = "INSERT INTO freight_info(fre_id, fre_destination, fre_driver_id, fre_truck_id, fre_total_vol, fre_state)
// VALUES ('$req_id_g','".$row_desc['req_cargo_dest_comp']."',-1,'',".$row_desc['req_total_vol'].",0);";
//    echo $sql_create;
//    $result_create =  $conn->query($sql_create);
//    echo $result_create;
    echo '<script>window.location="war-jud.php";</script>';

} else {
    echo '<script>window.location="war-jud.php";</script>';
}
