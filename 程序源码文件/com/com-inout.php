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



    // function change_comp() {
        // document.getElementById("up_part").style.display="none";

        //添加公司
        // var obj = document.getElementById("sel_comp");
        // comp_name = obj.options[obj.selectedIndex].value;

        // obj.selectedIndex.value = -1;

        // console.log(obj);
        // console.log(comp_name);
    // }



</script>
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

<!--查询剩余货物-->

                    <table class="tab_cargo_info" >
                        <caption>货物出库信息录入</caption>
                        <tr>
                            <th>货物编号</th>
                            <th>货物名称</th>
                            <th>剩余数量</th>
                            <th>数量</th>
                            <th>选择</th>
                        </tr>
                        <?php
                        $sql = "select * from cargo_info where car_type = 1;";
                        $result = $conn->query($sql);
                        $number = mysqli_num_rows($result);
                        if ($number != 0) {
                            for($i = 0; $i < $number; $i++) {
                                $row = mysqli_fetch_assoc($result);

//                                $str_car_A = '<tr>
//<td>' . $row['car_id'] . '</td><td>' . $row['car_name'] . '</td><td>' . $row['car_num'] . '</td><td><select id="sel_comp" onchange="change_comp()">
//<option value="-1">---请选择公司---</option>';

                                $str_car = '
<tr><td>' . $row['car_id'] . '</td><td>' . $row['car_name'] . '</td><td>' . $row['car_num'] . '</td>
<td><input type="text" id="'. $row['car_id'] .'_num'.'"/></td>
<td><input type="submit" id="'. $row['car_id'] .'_add'.'" value="选择" onclick="car_add('. $i .')"/></td>
</tr>
<script>
setCookie('. $i .',"'. $row['car_id'] .'")
setCookie("'. $row['car_id'] .'","'. $row['car_name'] .'")
setCookie("'. $row['car_name'] .'",'. $row['car_num'] .')
</script>';
                                echo $str_car;
                                //<input type="text" id="'. $row['car_id'] .'_comp'.'"/>
                            }
                        }
                        ?>
                    </table>

                    <br>

                    <div id="mid_part" style="display: none;">
                        <label style="color:#b8b6b4">请选择公司 : <select id="select_comp" onchange="change_comp()">
                            <option value="-1">--------------------</option>
                                <?php



                                $sel_str = "";
                                $sql_comp = "select * from company;";
                                $result_comp = $conn->query($sql_comp);
                                $number_comp = mysqli_num_rows($result_comp);
                                for($i = 0; $i < $number_comp; $i++){
                                    $row_comp = mysqli_fetch_assoc($result_comp);
                                    $sel_str .= '<option value="'. $row_comp['comp_id'] .'">'.$row_comp['comp_name'].'</option>
<script>
setCookie("'. $row_comp['comp_id'] .'","'. $row_comp['comp_name'] .'")
</script>';
                                }

                                echo $sel_str.'';


                                ?>
                            </select></label>
                        <input type="submit" id="" value="确认公司" onclick="comp_sel()"/>
                    </div>


                    <br>
<!--添加的结果-->
                    <form method="get">
                        <table class="tab_cargo_add" >
                            <caption>已添加</caption>
                            <tr id="next">
                                <th>货物编号</th>
                                <th>货物名称</th>
                                <th>添加数量</th>
                                <th>公司</th>
                                <th>移除</th>
                            </tr>
                        </table>
                        <br>
                        <input class="sign_button" type="button" value="提交审核" onclick="car_get();">
                    </form>





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

<!--$str_add = '-->

<script>
    var href = "/com/com-inout-get.php?text=0"
    var len = 0
    var str_get=[]
    var num = 0

    var comp_id
    var comp_name

    var row_id
    var row_name
    var str_id
    var num_js

    function car_add(id_para){
        // if (comp_name == undefined) console.log("NULL");
        // else  console.log(comp_name);

        row_id = getCookie(id_para);//从cookie中得到序号对应的名字
        row_name = getCookie(row_id);
        var row_num = getCookie(row_name);
        str_id = row_id + "_num";
        // var str_id_company = row_id + "_comp";
        num_js = document.getElementById(str_id);
        // var company_js = document.getElementById(str_id_company);
        row_num = parseInt(row_num);
        num_val = parseInt(num_js.value);
        if ( num_val < 0 || num_val > row_num || num_val == "" || !isNumber(num_val)){
            alert("请输入正确的数量");
            document.getElementById(str_id).value = "";
            return 0;
        }
        else{

            var comp_js = document.getElementById("mid_part");
            comp_js.style.display="inline";
        }
    }

    function change_comp(){

        var sel_obj = document.getElementById("select_comp");
        comp_id = sel_obj.options[sel_obj.selectedIndex].value;

        console.log(comp_id);

    }

    function comp_sel(){

        var cur_tab = document.getElementById("next");
        var car_num = num_js.value;
        //comp 最新的
        // var car_comp = company_js.value;
        var new_tr = document.createElement("tr");

        //comp 最新的
        str_get[num] ="&id_g[]=" + row_id + "&num_g[]=" + car_num + "&comp_g[]=" + comp_id;
        comp_name = getCookie(comp_id);

        //comp 最新的
        new_tr.innerHTML = "<tr><td>" + row_id + "</td><td>" + row_name + "</td><td>" + car_num + "</td><td>" + comp_name + "</td><td>" +
            "<label><a style=" + "color:red;text-decoration:none;" + " href=" + "javascript:;" + " onclick = " + "add_del(this,"+ num +")" + ">[-]</a></td></tr>";
        cur_tab.parentNode.insertBefore(new_tr, cur_tab.nextSibling)
        document.getElementById(str_id).value = "";
        // document.getElementById(str_id_company).value = "";
        href += str_get[num++];
        console.log(href);
        var comp_js = document.getElementById("mid_part");
        comp_js.style.display="none";

    }

    function add_del(obj,del_num){
        var cur_tr = obj.parentNode.parentNode;
        cur_tr.parentNode.remove(cur_tr);
        href = href.replace(str_get[del_num], "");
//        href = href.substr(0, href.length - len);
        console.log(href);
    }

    function car_get(){
        window.location.href = href;
//        if(href.length < 25) alert("未选取")
//        else{
//            console.log(href);
//            window.location.href = href;
//        }
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
    /*主要css-------------------------------------------------------------*/
</style>
</html>