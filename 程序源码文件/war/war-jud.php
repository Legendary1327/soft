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

                    <table class="tab_cargo_info" >
                        <caption>待审核</caption>
                        <tr>
                            <th>发起时间</th>
                            <th>发起人员编号</th>
                            <th>货物名称</th>
                            <th>数量</th>
                            <th>仓库余量</th>
                            <th>公司</th>
                            <th>处理结果</th>
                            <th>提交</th>
                        </tr>
                        <?php

                        $sql = "select req_id, req_time, req_req_user_id, car_name, req_cargo_num, car_num, req_cargo_dest_comp from cargo_request LEFT JOIN 
cargo_info on cargo_request.req_cargo_id = cargo_info.car_id where req_juger_id = '$id' and req_result = 0;";
                        $result = $conn->query($sql);
                        $number = mysqli_num_rows($result);

                        if ($number != 0) {
                            for($i = 0; $i < $number; $i++) {
                                $row = mysqli_fetch_assoc($result);
                                $str_car = '<tr>
<td>' . $row['req_time'] . '</td><td>' . $row['req_req_user_id'] . '</td><td>' . $row['car_name'] . '</td>
<td>' . $row['req_cargo_num'] . '</td><td>' . $row['car_num'] . '</td><td>' . $row['req_cargo_dest_comp'] . '</td>
<td><select id="' . $row['req_id'] . '_sel_jud" onchange="jud_change('. $i .')">
<option value="-1">---请选择---</option>
<option value="1">允许</option>
<option value="2">再议</option>
<option value="3">否定</option>
</select></td>
<td><form method="get">
<input class="sign_button" id="' . $row['req_id'] . '_sub" type="button" value="确认提交" onclick="finish_judging('. $i .',this);">
</form></td>
</tr>
<script>
setCookie(' . $i . ',"' . $row['req_id'] . '")
</script>';
                                echo $str_car;
                            }
                        }

                        $judge_every = '
<script>
var resu = 0
var href = "/war/war-jud-judged.php?text=0"
function jud_change(id_para){
    var row_id = getCookie(id_para);//从cookie中得到序号对应的名字
    elmt_id = row_id + "_sel_jud";
    var obj = document.getElementById(elmt_id);
    resu = obj.options[obj.selectedIndex].value;
    setCookie(elmt_id, resu);
    console.log(resu + "---" + elmt_id);
}

function finish_judging(id_para, obj){
    var row_id = getCookie(id_para);//从cookie中得到序号对应的名字
    var cur_resu = getCookie(row_id + "_sel_jud");
    if (!(cur_resu <= 3 && cur_resu >= 1)){
        alert("请选择");
    } else {
        href += "&result_g=" + cur_resu;
        href += "&Rid_g=" + row_id;
        console.log(href);
        window.location.href = href;
    }
}
</script>';
                        echo $judge_every;



                        ?>
                    </table>

                    <table class="tab_req_finish" >
                        <caption>已完成</caption>
                        <tr>
                            <th>发起时间</th>
                            <th>发起人员编号</th>
                            <th>货物名称</th>
                            <th>数量</th>
                            <th>公司</th>
                            <th>处理结果</th>
                            <th>完成时间</th>
                        </tr><br><br><br>
                        <?php

                        $sql_2 = "select req_time, req_req_user_id, car_name, req_cargo_num, req_cargo_dest_comp, req_result, req_jud_time from cargo_request LEFT JOIN 
cargo_info on cargo_request.req_cargo_id = cargo_info.car_id where req_juger_id = '$id' and req_result <> 0 order by req_jud_time desc ;";
                        $result_2 = $conn->query($sql_2);
                        $number_2 = mysqli_num_rows($result_2);

                        if ($number_2 != 0) {
                            for($i = 0; $i < $number_2; $i++) {
                                $row = mysqli_fetch_assoc($result_2);
                                $str_car_2 = '

<tr>
<td>' . $row['req_time'] . '</td><td>' . $row['req_req_user_id'] . '</td><td>' . $row['car_name'] . '</td><td>' . $row['req_cargo_num'] . '</td>
<td>' . $row['req_cargo_dest_comp'] . '</td><td>' . $row['req_result'] . '</td><td>' . $row['req_jud_time'] . '</td></tr><script>
</script>';
                                echo $str_car_2;
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
    .tab_cargo_info, .tab_req_finish {border: 1px solid;width: 100%;color: #ffffff}
    td,th{border:1px solid;}
    /*主要css-------------------------------------------------------------*/
</style>
</html>
