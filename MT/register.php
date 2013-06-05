<?php

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>用户注册</title>
        <script type="text/javascript" src="script/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="script/r.js?date=212"></script>
        <script type="text/javascript">
            function doclickSubmit(){
                var userName=$("#userN").val();
                var psw = $("#psw").val();
                var nickName = $("#nickN").val();
                var id = $("#id").val();
                var mobilePhone = $("#mobilePhone").val();
                var email = $("#email").val();
                
                //validate
                
                var data = {un: userName, psw: psw, nn: nickName, id: id, mp: mobilePhone, em: email};
                register(data);                
            }
        </script>
    </head>
    <body>
        <a href="index.php">返回主页</a>
        
        <br />
    
        <p><label>用户名</label><input type="text" id="userN" /></p>
        <p><label>密码</label><input type="text" id="psw" /></p>
        <p><label>昵称</label><input type="text" id="nickN" /></p>
        <p><label>身份证</label><input type="text" id="id" /></p>
        <p><label>手机号</label><input type="text" id="mobilePhone" /></p>
        <p><label>邮箱</label><input type="text" id="email"/></p>
        
        
        <button onclick="doclickSubmit(event)">提交注册信息</button>
    </body>
</html>
