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

    //选择车辆总重
    var total_vol = 0
    //选择任务后重量
    var temp_vol = 0
    var truck_id = 0
    var href = "/war/fre-car-add.php?text=0"
    var add_car = ""

    function change_truck(){

        var obj = document.getElementById("sel_truck");
        resu = obj.options[obj.selectedIndex].value;

        truck_id = getCookie(resu);
        add_car = ("&Truck_id=" + truck_id);
        total_vol = getCookie(truck_id);
        console.log(total_vol);
        console.log(resu);
    }

    function quest_add(req_truck_id,req_truck_vol,req_truck_dest,req_comp_name,obj) {
        var str_id = req_truck_id + "_add";
        var tp_str = "&Qid[]=" + req_truck_id + "&Q_vol[]=" + req_truck_vol + "&Q_dest[]=" + req_truck_dest + "&Q_comp[]" + req_comp_name;
        var len = tp_str.length;
        // console.log("total:" + total_vol);
        if (obj.checked == true) {
            href += tp_str;
            temp_vol += Number(req_truck_vol);
            console.log(temp_vol);
        } else {
            href = href.replace(tp_str, "");
            temp_vol -= Number(req_truck_vol);
            // href = href.substring(0, href.length - len);
            console.log(temp_vol);
        }
    }

    function truck_get(){
        if (total_vol >= temp_vol && temp_vol != 0) {
            href += add_car;
            console.log(href);
            window.location.href = href;
        }
        else
            alert("车容量不足或未选择订单");
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
                        <caption>请选择车辆</caption>
                        <tr>
                            <th>车辆编号</th>
                            <th>车牌</th>
                            <th>状态</th>
                            <th>载重量</th>
                        </tr>
                        <?php

                        //
                        $sql = "select * from truck_info where truck_state = 0 order by truck_volume desc ;";
                        $result = $conn->query($sql);
                        $number = mysqli_num_rows($result);
                        if ($number != 0) {
                            for($i = 0; $i < $number; $i++) {
                                $row = mysqli_fetch_assoc($result);
                                if ($row['truck_state'] == 0) $state = "空闲";
                                else if ($row['truck_state'] == 2) $state = "暂停使用";
                                else $state = "不可用";
                                    $str_car = '
<tr>
<td>' . $row['truck_id'] . '</td><td>' . $row['truck_license'] . '</td>
<td>' . $state . '</td><td>' . $row['truck_volume'] . '</td>
</tr>
<script>
setCookie('.$i.',"'. $row['truck_id'] .'")
setCookie("'. $row['truck_id'] .'","'. $row['truck_volume'] .'")
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


                    <br><br>

                    <label id="next">车辆编号选择:</label>
                    <?php

                    $sel_str = '
<select id="sel_truck" onchange="change_truck()">
<option value="-1">---请选择---</option>
';

                    $result = $conn->query($sql);
                    for($i = 0; $i < $number; $i++){
                        $row = mysqli_fetch_assoc($result);
                        $sel_str .= '<option value="'. $i .'">'.$row['truck_id'].'</option>';
                    }

                    $sel_str .= '</select>';

                    echo $sel_str;

                    ?>

                    <br><br>


                    <table class="tab_cargo_info" >
                        <caption>已审批通过出货</caption>
                        <tr>
                            <th>订单编号</th>
                            <th>公司名称</th>
                            <th>公司地址</th>
                            <th>总重</th>
                            <th>选择</th>
                        </tr>
                        <?php

                        //
                        $sql_req = "select req_id, req_cargo_dest_comp,req_cargo_dest, req_total_vol, req_result, 
req_juger_id from cargo_request where req_result = 1 and req_juger_id = '$id' and req_id NOT IN 
(select fre_id from freight_info);";
                        $result_req = $conn->query($sql_req);
                        $number = mysqli_num_rows($result_req);
                        if ($number != 0) {
                            for($i = 0; $i < $number; $i++) {
                                $row = mysqli_fetch_assoc($result_req);
                                $id_str = (string)$row['req_id'];
                                $vol_str = (string)$row['req_total_vol'];
                                $dest_str = (string)$row['req_cargo_dest'];
                                $comp_str = (string)$row['req_cargo_dest_comp'];
                                $str_car = '
<tr>
<td>' . $row['req_id'] . '</td><td>' . $row['req_cargo_dest_comp'] . '</td><td>' . $row['req_cargo_dest'] . '</td>
<td>' . $row['req_total_vol'] . '</td>
<td><input type="checkbox" id="'. $row['req_id'] .'_add'.'" value="添加" onclick='.'quest_add("'.$id_str.'","'.$vol_str.'","'.$dest_str.'","'.$comp_str.'",this)'.'></td>
</tr>
<script>
</script>';
                                echo $str_car;
                            }
                        }

                        ?>
                    </table>

                    <br><br>

                    <?php


                    $confirm = '
                        
<form method="get">
<input class="sign_button" type="button" value="提交" onclick="truck_get();">
</form>
                        ';

                    echo $confirm;



                    ?>


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
    label{color: #ffffff;}
    /*主要css-------------------------------------------------------------*/
</style>
</html>
