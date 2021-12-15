<?php
header("Content-type: text/html; charset=utf-8");
$id = $_POST['id_p'];
$password = $_POST['password_p'];
$people = $_POST['people_p'];

$conn = new mysqli('localhost','root','root','z_cargo');

session_start();
$_SESSION['id_s'] = $id;
$_SESSION['password_s'] = $password;
$_SESSION['people_s'] = $people;
$_SESSION['con_s'] = $conn;


if ($conn->connect_error){
    echo '数据库连接失败！';
    exit(0);
}else{
    if ($id == ''){
        echo '<script>alert("请输入用户名！");history.go(-1);</script>';
        exit(0);
    }
    if ($password == ''){
        echo '<script>alert("请输入密码！");history.go(-1);</script>';
        exit(0);
    }
    $sql = "select id_acc, pswd_acc from account where id_acc = (select id_all from all_users where id_all = '$id' and dept_all = '$people') and pswd_acc = '$password';";
    $result = $conn->query($sql);
    $number = mysqli_num_rows($result);
    if ($number) {
        if ($people == 'com')
            echo '<script>window.location="/com/com-home.php";</script>';
        elseif ($people == 'war')
            echo '<script>window.location="/war/war-home.php";</script>';
//        elseif ($people == 'fre')
//            echo '<script>window.location="/fre/fre-home.php";</script>';
//        else
//            echo '<script>window.location="home-adm.html";</script>';
    } else {
        echo '<script>alert("用户名或密码错误！");history.go(-1);</script>';
    }
}
?>

