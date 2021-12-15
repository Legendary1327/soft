<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>index</title>
</head>
<body>
<div class="whole_page">
    <div class="header">
        <div class="content_head">
            <div class="logo">
                <img src="../img/logo.png" alt="logo" class="logo_img">
            </div>
            <div class="user_info">
                <p>欢迎使用物流管理系统 ! <?php include 'war.php';echo '员工号:'; echo $id; ?></p>
            </div>
        </div>
    </div>
    <div class="middle">
        <div class="navigate">
            <div class="blank_b">
            </div>
            <div class="content_nav">
                <div class="hom" onclick="window.location='war-home.php';"><a>个人主页</a></div>
                <div class="jud" onclick="window.location='war-jud.php';"><a>出库信息审核</a></div>
                <div class="all" onclick="window.location='war-all.php?text=0';"><a>库存信息查看</a></div>
                <div class="add" onclick="window.location='war-add.php';"><a>货物入库管理</a></div>
                <div class="car" onclick="window.location='fre-car.php';"><a>货物车辆分配</a></div>
                <div class="rea" onclick="window.location='fre-ready.php';"><a>送货车辆管理</a></div>
                <div class="his" onclick="window.location='fre-his.php';"><a>送货记录信息</a></div>
                <!--<div class="req" onclick="window.location='user-req.html';"><a>库存申请</a></div>-->
                <!--<div class="sel" onclick="window.location='user-sel.html';"><a>库存查询</a></div>-->
                <!--<div class="mv" onclick="window.location='user-mv.html';"><a>库存调整</a></div>-->
                <!--<div class="tal" onclick="window.location='com-tal.html';"><a>月末清点</a></div>-->
                <!--<div class="table" onclick="window.location='user-table.html';"><a>报表生成</a></div>-->
                <!--<div class="history" onclick="window.location='user-history.html';"><a>历史记录</a></div>-->
            </div>
            <div class="blank_b" id="blank_2">
            </div>
        </div>
        <div class="gallery">
            <div class="content_bg">
                <div class="content">
                    <!--主要代码在此===================================================-->

                    <div>
                        <label>&nbsp;&nbsp;根据货物名称查找&nbsp;:&nbsp;<input type="text" placeholder="请输入货物名称" id="input_name"/></label>&nbsp;&nbsp;
                        <input type="submit" id="confirm" value="查询" onclick="confirm_sel()"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="submit" id="confirm" value="清空查询" onclick="delete_sel()"/>
                    </div>



                    <div id="no_input">
                        <table class="tab_cargo_info" >
                            <caption>库存余量</caption>
                            <tr>
                                <th>货物编号</th>
                                <th>货物名称</th>
                                <th>剩余数量</th>
                                <th>仓库编号</th>
                                <th>入库时间</th>
                            </tr>
                            <?php

                            $cond = $_GET['text'];
                            if($cond == "0") $sql = "select * from cargo_info where car_type = 1 order by car_name;";
                            else $sql = "select * from cargo_info where car_type = 1 and car_name LIKE '%$cond%' order by car_name;";

                            $result = $conn->query($sql);
                            $number = mysqli_num_rows($result);
                            if ($number != 0) {
                                for($i = 0; $i < $number; $i++) {
                                    $row = mysqli_fetch_assoc($result);
                                    $str_car = '
<tr>
<td>' . $row['car_id'] . '</td><td>' . $row['car_name'] . '</td><td>' . $row['car_num'] . '</td>
<td>' . $row['car_warehouse_num'] . '</td><td>' . $row['car_in_time'] . '</td>
</tr>
<script>
</script>';
                                    echo $str_car;
                                }
                            }
                            ?>
                        </table>
                    </div>

                    <!--主要代码在此===================================================-->
                </div>
            </div>
        </div>
        <div class="main-page">
            <div class="news"></div>
            <div class="show_func"></div>
        </div>
    </div>
    <div class="blank_b" id="blank_3">
    </div>

    <div class="blank_b" id="blank_4">
    </div>
</div>
</body>

<script>

    var no_part = document.getElementById("no_input");
    var have_part = document.getElementById("have_input");
    var condition = document.getElementById("input_name");

    function confirm_sel(){
        if (condition.value === "") alert("请输入查询内容!");

        else window.location.href = "/war/war-all.php?text=" + condition.value;
        //
        //
        // if (have_part.style.display === "none") {
        //     have_part.style.display = "inline";
        //     no_part.style.display = "none";
        // }
    }

    function delete_sel(){
        window.location.href = "/war/war-all.php?text=0";
    }

</script>

<style>
    body{margin: 0;}
    .header {background: #171A21;}
    .content_head {display: flex; /*flex的子元素没有float的效果*/align-items: center;height: 100px;width: 1200px;margin: 0 auto;}
    .user_info p {color: #b8b6b4;letter-spacing: 2px;margin-left: 800px;}
    .middle {background: #343144;}
    .blank_b {height: 50px;}
    #blank_2 {height: 50px;}
    .content_nav {margin: 0 auto;width: 1200px;display: table;}
    .content_nav div {background: #6E7881;width: 200px;text-align: center;cursor:pointer;display: table-cell;box-shadow: 0 0 1px #000;}
    .content_nav div:hover {background: #838d95;box-shadow: 0 0 10px #000;}
    .content_nav div a {line-height: 50px; /*文字垂直居中*/margin:0 auto;text-decoration:none;color: #D3D4D8;}
    .content_bg {margin: 0 auto;width: 1100px;opacity:0.8;background: #2A2C30;height: 800px;padding: 50px;}
    /*.content {border: 1px solid; !*padding: 50px;*!}*/
    #blank_3 {background: #343144;}
    #blank_4 {background: #343144;}
    .bottom_rights_div a{font-size: 10px;color: #D3D4D8;}
    /*主要css-------------------------------------------------------------*/
    .tab_cargo_info, .tab_cargo_add {border: 1px solid;width: 100%;color: #ffffff}
    td,th{border:1px solid;}
    label{color:#ffffff;}
    /*主要css-------------------------------------------------------------*/
</style>
</html>
