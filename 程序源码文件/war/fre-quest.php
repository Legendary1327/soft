<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>index</title>
</head>
<script>
    //设置cookie
    function setCookie(name,value){
        // var date = new Date();
        // date.setDate(date.getDate() + day);
        document.cookie = name + "=" + value + ";";
    }

    //获取cookie
    // function getCookie(name){
    //     var reg = RegExp(name+'=([^;]+)');
    //     // document.cookie.
    //     var arr = document.cookie.match(reg);
    //     if(arr){
    //         return arr[1];
    //     }else {
    //         return '';
    //     }
    // }
    function getCookie(name) {
        var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");

        if (arr = document.cookie.match(reg))

            return unescape(arr[2]);
        else
            return null;
    }

    //删除cookie
    function delCookie(name){
        setCookie(name,null,-1);
    }

    function isNumber(value) {         //验证是否为数字
        var patrn = /^(-)?\d+(\.\d+)?$/;
        if (patrn.exec(value) == null || value == "") {
            return false
        } else {
            return true
        }
    }
</script>
<body>
<div class="whole_page">
    <div class="header">
        <div class="content_head">
            <div class="logo">
                <img src="../img/logo.png" alt="logo" class="logo_img">
            </div>
            <div class="user_info">
                <p>欢迎使用物流管理系统 ! <?php include 'fre.php';echo '员工号:'; echo $id; ?></p>
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

                    <table class="tab_cargo_info" >
                        <caption>已审核通过的订单</caption>
                        <tr>
                            <th>订单编号</th>
                            <th>目的地</th>
                            <th>货车</th>
                            <th>总重</th>
                            <th>选择订单</th>
                        </tr>
                        <?php

//
                        $sql = "select fre_id,fre_destination,fre_driver_id,fre_truck_id,req_total_vol from freight_info,cargo_request 
where freight_info.fre_id = cargo_request.req_id and freight_info.fre_driver_id = -1 and fre_state = 0 order by fre_destination desc;";
                        $result = $conn->query($sql);
                        $number = mysqli_num_rows($result);
                        if ($number != 0) {
                            for($i = 0; $i < $number; $i++) {
                                $row = mysqli_fetch_assoc($result);
                                $str_car = '
<tr>
<td>' . $row['fre_id'] . '</td><td>' . $row['fre_destination'] . '</td>
<td>' . $row['fre_truck_id'] . '</td><td>' . $row['req_total_vol'] . '</td>
<td>
<form method="get">
<input class="sign_button" id="'. $row['fre_id'] .'_sel" type="button" value="选择订单" onclick="select_order('. $i .');">
</form>
</td>
</tr>
<script>
setCookie(' . $i . ',"' . $row['fre_id'] . '")
</script>';
                                echo $str_car;
                            }
                        }
                        $judge_every = '
<script>
var href = "/fre/fre-quest-cho.php?Qid="

function select_order(id_para){
    get_id = getCookie(id_para);
    console.log(get_id);
    href += get_id;
    
    console.log(href);
    window.location.href = href;
}
</script>';
                        echo $judge_every;
                        ?>
                    </table>

                    <br>
                    <br>

                    <table class="tab_cargo_info" >
                        <caption>已选择订单</caption>
                        <tr>
                            <th>订单编号</th>
                            <th>目的地</th>
                            <th>货车</th>
                            <th>总重</th>
                        </tr>
                        <?php

                        //
                        $sql = "select fre_id,fre_destination,fre_driver_id,fre_truck_id,req_total_vol from freight_info,cargo_request 
where freight_info.fre_id = cargo_request.req_id and freight_info.fre_driver_id = $id and fre_state = 0 order by fre_destination desc;";
                        $result = $conn->query($sql);
                        $number = mysqli_num_rows($result);
                        if ($number != 0) {
                            for($i = 0; $i < $number; $i++) {
                                $row = mysqli_fetch_assoc($result);
                                $str_car = '
<tr>
<td>' . $row['fre_id'] . '</td><td>' . $row['fre_destination'] . '</td>
<td>' . $row['fre_truck_id'] . '</td><td>' . $row['req_total_vol'] . '</td>
</tr>
<script>
</script>';
                                echo $str_car;
                            }
                        }
                        $judge_every = '
<script>
</script>';
                        echo $judge_every;
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
}