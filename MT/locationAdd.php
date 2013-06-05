<?php
session_start();
require_once("logic/connect.php");
require_once("base/Guid.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>新增地点</title>
		<script type="text/javascript" src="script/jquery-1.9.1.js"></script>
		<script type="text/javascript" src="script/r.js"></script>
        <script type="text/javascript">
            var uid = '<?php echo isset($_SESSION['userID']) ? $_SESSION['userID'] : -1 ?>';
            
            function doclickSubmit(){
                var posName = $("#posN").val();
                var province = $("#pro").val();
                var city = $("#city").val();
                var block = $("#block").val();
                var posInfo = $("#posInfo").val();
                
                var data = {pn: posName, pro: province, city: city, block: block, userID:uid, pi: posInfo};
                addLoc(data);
            }
        </script>
	</head>
	<body>
		<div>
            <a href="locationList.php">地点列表</a>
            
			<h3>输入地点信息</h3>
            <?php
			if(isset($_SESSION['userID'])){            
			?>
             <p><label>地点名</label><input type="text" id="posN" /></p>
            <p><label>省</label><input type="text" id="pro" /></p>
            <p><label>市</label><input type="text" id="city" /></p>
            <p><label>街道位置</label><input type="text" id="block" /></p>
            <p><label>信息</lable><textarea id="posInfo"></textarea></p>
            
            <button onclick="doclickSubmit()">提交</button>
            <?php
            }else{
            ?>
            <p>请先登录<a href="index.php" >登录</a><p>
            <?php
            }
            ?>
		</div>
	</body>
</html>