<?php

header("Content-type: text/html; charset=utf-8");
//$num = $_POST['car_num_p'];
//$id = $_POST['car_id_p'];

session_start();
$id = $_SESSION['id_s'];
$car_id_g  = $_GET['id_g'];
$car_num_g = $_GET['num_g'];
$car_comp_g = $_GET['comp_g'];

print_r($car_id_g);
print_r($car_num_g);

$number_add = count($car_id_g, 1);

$conn = new mysqli('localhost', 'root', 'root', 'z_cargo');
//
if ($conn->connect_error){
    echo '数据库连接失败！';
    exit(0);
}
$sql = "select * from cargo_request;";
$result = $conn->query($sql);
$number = mysqli_num_rows($result);
echo "<br>";

date_default_timezone_set("Asia/Hong_Kong");
$time = date('Y-m-d H:i:s');
echo $time;
$sql_per = "";

for($i = 0; $i < $number_add; $i++){
    $new_req_id = "R".++$number;
//    echo "i:".$i."number_add:".$number_add;

    $sql_vol = "select car_volume from cargo_info where car_id='$car_id_g[$i]';";
    $result_vol = $conn->query($sql_vol);
    $row_vol = mysqli_fetch_assoc($result_vol);
    $vol = $row_vol['car_volume'] * $car_num_g[$i];

    $sql_dest = "select * from company where comp_id = '$car_comp_g[$i]';";
    echo $sql_dest."--sql_test--";
    $result_dest = $conn->query($sql_dest);
    $row_dest = mysqli_fetch_assoc($result_dest);
    $cur_dest = $row_dest['comp_dest'];
    $cur_name = $row_dest['comp_name'];

    $sql_per .= "INSERT INTO cargo_request(req_id,req_time, req_cargo_id, req_cargo_num,
req_cargo_dest_comp,req_cargo_dest,req_total_vol,req_req_user_id,req_juger_id,req_result) 
VALUES ('$new_req_id','$time','$car_id_g[$i]',$car_num_g[$i],'$cur_name','$cur_dest',$vol,$id,4,0);";
}

echo $sql_per."--sql_per--";
echo "<br>";
if(!mysqli_multi_query($conn, $sql_per)){
    echo "ERROR" .mysqli_error($conn);
    echo "alert('插入失败')";
}
//    echo "number_per:".$number_per;

//sleep(100);

echo '<script>window.location="com-que.php";</script>';
//echo '<script>window.location="com-inout-post.php";</script>';
