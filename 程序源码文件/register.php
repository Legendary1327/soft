<?php
header("Content-type: text/html; charset=utf-8");
$id = $_POST['id_p'];
$password = $_POST['password_p'];
$re_password = $_POST['re_password_p'];
if ($id == ''){
    echo '<script>alert("请输入员工号！");history.go(-1);</script>';
    exit(0);
}
if ($id >=10000 || $id <1){
    echo '<script>alert("请输入正确的员工号");history.go(-1);</script>';
    exit(0);
}
if (strlen($password) <5 || strlen($password) > 12){
    echo '<script>alert("请输入正确的密码");history.go(-1);</script>';
    exit(0);
}
if ($password != $re_password){
    echo '<script>alert("密码与确认密码应该一致");history.go(-1);</script>';
    exit(0);
}
if($password == $re_password){
    $conn = new mysqli('localhost','root','root','z_cargo');
    if ($conn->connect_error){
        echo '数据库连接失败！';
        exit(0);
    }else {
        $sql = "select id_acc from account where id_acc = '$id';";
        $result = $conn->query($sql);
        $number = mysqli_num_rows($result);
        if ($number) {
            echo '<script>alert("该员工号已注册");history.go(-1);</script>';
        } else {
            $sql_insert = "insert into account(id_acc, pswd_acc)values($id,'$password');";
            $res_insert = $conn->query($sql_insert);
            if ($res_insert) {
                echo '<script>alert("注册成功，请重新登录");</script>';
                echo '<script>window.location="index.html";</script>';
            } else {
                echo "<script>alert('系统繁忙，请稍候！');</script>";
            }
        }
    }
}else{
    echo "<script>alert('提交未成功！'); history.go(-1);</script>";
}
?>