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
                        <caption>已存储公司</caption>
                        <tr>
                            <th>公司编号</th>
                            <th>公司名称</th>
                            <th>公司地址</th>
                        </tr>
                        <?php
                        $sql_comp = "select * from company;";
                        $result_comp = $conn->query($sql_comp);
                        $number_comp = mysqli_num_rows($result_comp);
                        if ($number_comp != 0) {
                            for($i = 0; $i < $number_comp; $i++) {
                                $row = mysqli_fetch_assoc($result_comp);
                                $str_car = '
<tr>
<td>' . $row['comp_id'] . '</td><td>' . $row['comp_name'] . '</td><td>' . $row['comp_dest'] . '</td>
</tr>';
                                echo $str_car;
                            }
                        }
                        ?>
                    </table>


                    <br><br>


                    <label><input type="submit" id="add_comp_ctr" value="添加公司信息" onclick="add_btw()"/></label>
                    <label><input type="submit" id="alter_comp_ctr" value="修改公司地址" onclick="alter_btw()"/></label>

                    <br><br>


                    <div id="add_comp">
                        <form method="get" action="com-cp-add.php">
                            <table class="tab_cargo_info" >
                                <caption>添加公司信息</caption>
                                <tr>
                                    <th>公司名称</th>
                                    <th>公司地址</th>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" name="cp_name_g" placeholder="请输入公司名称" />
                                    </td>
                                    <td>
                                        <input type="text" name="location_g" placeholder="请输入公司地址" />
                                    </td>
                                </tr>
                            </table>
                            <br>
                            <button type="submit" value="添加" class="psw-btn">确认添加</button>
                        </form>
                    </div>



                    <div id="alter_comp" style="display: none;">
                        <form method="get" action="com-cp-alter.php">
                            <table class="tab_cargo_info" >
                                <caption>修改公司地址</caption>
                                <tr>
                                    <th>公司名称</th>
                                    <th>新的地址</th>
                                </tr>
                                <tr>
                                    <td>
                                        <label>&nbsp;&nbsp;请选择公司名称&nbsp;&nbsp;<select name="cp_id_g" id="select_comp">
                                            <option value="-1">--------------------</option>

                                        <?php

                                        $comp_name = "";
                                        $sql_name = "select * from company;";
                                        $result_name = $conn->query($sql_name);
                                        $number_name = mysqli_num_rows($result_name);
                                        for($j = 0; $j < $number_name; $j++){
                                            $row_name = mysqli_fetch_assoc($result_name);
                                            $comp_name .= '
<option value="'. $row_name['comp_id'] .'">'. $row_name['comp_name'] .'</option>';
                                        }

                                        echo $comp_name;

                                        ?>
                                        </select></label>
                                    </td>
                                    <td>
                                        <input type="text" name="location_g" placeholder="请输新的地址" />
                                    </td>
                                </tr>
                            </table>
                            <br>
                            <button type="submit" value="修改" class="psw-btn">确认修改</button>
                        </form>
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

    var add_part = document.getElementById("add_comp");
    // add_part.style.display="inline";
    var alter_part = document.getElementById("alter_comp");


    function add_btw(){
        if (add_part.style.display === "none") {
            add_part.style.display = "inline";
            alter_part.style.display = "none";
        }
    }

    function alter_btw(){
        if (alter_part.style.display === "none") {
            alter_part.style.display = "inline";
            add_part.style.display = "none";
        }
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
    label{color: #ffffff;}
    /*主要css-------------------------------------------------------------*/
</style>
</html>