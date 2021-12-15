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
                <p>欢迎使用物流管理系统 ! <?php include 'com.php';echo '员工号:'; echo $id; ?></p>
            </div>
        </div>
    </div>
    <div class="middle">
        <div class="navigate">
            <div class="blank_b">
            </div>
            <div class="content_nav">
                <div class="main" onclick="window.location='com-home.php';"><a>个人主页</a></div>
                <div class="inout" onclick="window.location='com-inout.php';"><a>出库操作</a></div>
                <div class="que" onclick="window.location='com-que.php';"><a>审核结果</a></div>
                <div class="his" onclick="window.location='com-his.php';"><a>货物出库记录</a></div>
                <div class="cp" onclick="window.location='com-cp.php';"><a>公司信息修改</a></div>
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

                    <table class="tab_cargo_info" >
                        <caption>出库记录</caption>
                        <tr>
                            <th>请求编号</th>
                            <th>日期</th>
                            <th>货物编号</th>
                            <th>数量</th>
                            <th>总大小</th>
                            <th>公司</th>
                            <th>目的地</th>
                            <th>结果</th>
                            <th>处理时间</th>
                        </tr>
                        <?php
                        $sql = "select * from cargo_request where req_req_user_id = $id and req_result = 1;";
                        $result = $conn->query($sql);
                        $number = mysqli_num_rows($result);
                        if ($number != 0) {
                            for($i = 0; $i < $number; $i++) {
                                $row = mysqli_fetch_assoc($result);
                                $str_car = '
<tr>
<td>' . $row['req_id'] . '</td><td>' . $row['req_time'] . '</td><td>' . $row['req_cargo_id'] . '</td>
<td>' . $row['req_cargo_num'] . '</td><td>' . $row['req_total_vol'] . '</td>
<td>' . $row['req_cargo_dest_comp'] . '</td><td>' . $row['req_cargo_dest'] . '</td><td>' . $row['req_result'] . '</td><td>' . $row['req_jud_time'] . '</td>
</tr>';
                                echo $str_car;
                            }
                        }
                        ?>
                    </table>



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
    /*主要css-------------------------------------------------------------*/
</style>
</html>