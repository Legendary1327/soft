<?php
header("Content-type: text/html; charset=utf-8");
$name = $_GET['name_g'];
$vol = $_GET['vol_g'];
$type = (int)$_GET['type_g'];
$comp_name = $_GET['comp_name_g'];
$num = $_GET['num_g'];
//$if_type = $_GET['if_g'];
$ware = $_GET['ware_g'];


date_default_timezone_set("Asia/Hong_Kong");
$time = date('Y-m-d H:i:s');


if ($name == ''){
    echo '<script>alert("请输入名称！");history.go(-1);</script>';
    exit(0);
}
if ($vol >=10000 || $vol <1){
    echo '<script>alert("请输入正确的大小");history.go(-1);</script>';
    exit(0);
}
if ($type != 1 && $type != 2){
    echo '<script>alert("'.$type.'");</script>';
    echo '<script>alert("请输入类型！");history.go(-1);</script>';
    exit(0);
}
if ($comp_name == ''){
    echo '<script>alert("请输入公司名称！");history.go(-1);</script>';
    exit(0);
}
if ($num >=10000 || $num <1){
    echo '<script>alert("请输入正确的数量");history.go(-1);</script>';
    exit(0);
}
//if ($if_type != 1 && $if_type != 2){
////    echo '<script>alert("'.$type.'");</script>';
//    echo '<script>alert("请选择操作类型！");history.go(-1);</script>';
//    exit(0);
//}
if ($ware != 1 && $ware != 2){
    echo '<script>alert("请输入正确的仓库！");history.go(-1);</script>';
    exit(0);
}

$conn = new mysqli('localhost','root','root','z_cargo');
if ($conn->connect_error){
    echo '数据库连接失败！';
    exit(0);
}else {
        $sql = "select * from cargo_info;";
        $result = $conn->query($sql);
        $number = mysqli_num_rows($result);
        $new_id = "C" .(string)(++$number);

        $insert = "INSERT INTO cargo_info(car_id, car_name, car_volume, car_type, car_sou_cpname, car_num, car_warehouse_num, car_in_time)
VALUES ('$new_id','$name',$vol,$type,'$comp_name',$num,$ware,'$time');";
        $res_insert = $conn->query($insert);
    echo '<script>alert("添加成功");window.location="war-add.php";</script>';

}