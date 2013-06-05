<?php
session_start();
require_once("logic/connect.php");
require_once("base/Guid.php");

$uid=0;
if(isset($_SESSION['userID']))
    $uid = $_SESSION['userID'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>欢迎光临麦田公益</title>
        <script type="text/javascript" src="script/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="script/r.js"></script>
        <script type="text/javascript">
        <?php
        if(isset($_SESSION['userID'])){
        ?>
        var hasLogin = true;
        <?php
        }else{
        ?>        
        var hasLogin = false;
        <?php
        }
        ?>
        main();
        
        function main(){
            //if(!hasLogin)
            //    this.window.location.href = "index.php";
        }
        
        function doclickSubmit(){
            var oldPsw=$("#oldpsw").val();
            var newPsw = $("#psw").val();
            var nickName = $("#nickN").val();
            var id = $("#id").val();
            var mobilePhone = $("#mobilePhone").val();
            var email = $("#email").val();
                
            //validate
                
            var data = {op: oldPsw, psw: newPsw, nn: nickName, id: id, mp: mobilePhone, em: email};
            edit(data);                
        }
        </script>
    </head>
    <body>
        <?php 
            if($uid <= 0){
                echo "未登录";
                return;
            }            
                       
            $list = SQL::query("user", array("	USERID"), array("$uid"));
            if(count($list) == 0){
                echo "无此数据";
                return;
            }
            
            $data = $list[0];
        ?>
    
        <a href="index.php">返回首页</a>
    
        <p><label>旧密码</label><input type="text" id="oldpsw" /></p>        
    
        <p><label>新密码</label><input type="text" id="psw" /></p>
        <p><label>昵称</label><input type="text" id="nickN" value="<?php echo $data['NICKNAME']; ?>" /></p>
        <p><label>身份证</label><input type="text" id="id" value="<?php #echo $data[]; ?>" /></p>
        <p><label>手机号</label><input type="text" id="mobilePhone" /></p>
        <p><label>邮箱</label><input type="text" id="email"/></p>
        <br />
        <p><label>用户状态 <?php echo $data['STATUS']; ?></label></p>
        <p><label>创建日期 <?php
            $timestamp = $data['CREATEDATE'];
            $datetime = date('Y-m-d H:i:s', $timestamp);
            echo $datetime;
        ?></label></p>
        <p><label>注册IP <?php 
            $ip = $data['CREATEIP']; 
            $str = IP::num2IP($ip);
            echo $str;
        ?></label></p>
        <button onclick="doclickSubmit(event)">提交注册信息</button>
    </body>
</html>
