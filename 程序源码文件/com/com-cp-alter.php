<?php
header("Content-type: text/html; charset=utf-8");
$cp_id = $_GET['cp_id_g'];
$location = $_GET['location_g'];

date_default_timezone_set("Asia/Hong_Kong");
$time = date('Y-m-d H:i:s');

//echo $cp_name;
//echo $location;


if ($location == ''){
    echo '<script>alert("请输入正确地址！");history.go(-1);</script>';
    exit(0);
}

$conn = new mysqli('localhost','root','root','z_cargo');
if ($conn->connect_error){
    echo '数据库连接失败！';
    exit(0);
}else {
    $sql = "update company SET comp_dest = '$location' where comp_id = '$cp_id';";

    $result = $conn->query($sql);
//    $number = mysqli_num_rows($result);
//    $new_id = "P" .(string)(++$number);
//
//    $insert = "INSERT INTO company(comp_id, comp_name, comp_dest)
//VALUES ('$new_id','$cp_name','$location');";
//    $res_insert = $conn->query($insert);
    echo '<script>alert("修改成功");window.location="com-cp.php";</script>';

}