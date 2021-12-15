<?php
header("Content-Type: text/html;charset=utf-8");

$conn = new mysqli('localhost', 'root', 'root', 'z_cargo');

session_start();
$id = $_SESSION['id_s'];

$destination = '../upload/';
$file        = $_FILES['file']; // 获取上传的图片
$filename    = $file['name'];

echo $destination;
print_r($file);
echo $filename;

$sql = "select * from img where user_id = $id;";
$result = $conn->query($sql);
$number = mysqli_num_rows($result);
if ($number) {
    $insert = "UPDATE img SET path = '$filename' where user_id = $id;";
    $test   = move_uploaded_file($file['tmp_name'], $destination . iconv("UTF-8", "gb2312", $filename));

    if ($insert && $test) {
        $conn->query($insert);
        echo '<script>window.location="com-home.php";</script>';
    } else {
        echo '上传失败' . '<br>';
    }
} else {

    $insert = "INSERT INTO img (user_id,path) VALUES ('$id','$filename')";
    $test   = move_uploaded_file($file['tmp_name'], $destination . iconv("UTF-8", "gb2312", $filename));

    if ($insert && $test) {
        $conn->query($insert);
        echo '<script>window.location="com-home.php";</script>';
    } else {
        echo '上传失败' . '<br>';
    }

}