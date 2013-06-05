<?php 
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>欢迎光临麦田公益</title>
		<script type="text/javascript" src="script/jquery-1.9.1.js"></script>
		<script type="text/javascript" src="script/r.js"></script>
        <script type="text/javascript">
            function doclickSubmit(){
                var userName = $("#user").val();
                var psw = $("#psw").val();
                
                var data = {un: userName, psw: psw};
                login(data);
            }
            function doclickExit(){
                logout({});
            }
        </script>
	</head>
	<body>
        <div>
            <span>LOGO</span>
            <t />
            <a href="locationList.php">地点列表</a>
            <t />
            <a href="activityList.php">活动列表</a>
        </div>
		<div>
			<h3>用户登录</h3>
			<?php
			if(isset($_SESSION['userName'])){            
			?>
				<div>
					<p><?php echo $_SESSION['userName']; ?>, 恭喜你登录成功!</p>
					<a href="javascript:doclickExit()">【退出】</a>
                    <a href="userEdit.php">编辑资料</a>
				</div>
			<?php 
			}else{
			?>
				<div>
					<p><label>用户名</label><input type="text" id="user" /></p>
					<p><label>密码</label><input type="password" id="psw" /></p>
					
					<button onclick="doclickSubmit(event)">提交</button>
				</div>
                <a href="register.php">用户注册</a>
			<?php 
			}
			?>
            <br />
            <a href="locationList.php">地点列表</a>
            <br />
            <a href="activityList.php">活动列表</a>
		</div>
        
        <?php
        if(isset($_SESSION['userName'])){        
        ?>
        
        <div>
            <p>地点推荐(未做)</p>
            <p>活动推荐(未做)</p>
        </div>
        
        <?php
        }
        ?>
	</body>
</html>