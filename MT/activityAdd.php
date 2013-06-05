<?php
session_start();
require_once("logic/connect.php");
require_once("base/Guid.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>新增活动</title>
        
        <?php
            $pid = 0;
            $param_str = $_SERVER["QUERY_STRING"];
            parse_str($param_str, $param_arr);
            if(isset($param_arr['pid']))
                $pid = (int)$param_arr['pid'];

            if($pid <= 0){
                echo "参数非法";
                return;
            }else{            
                $list = SQL::query("position", array("ID"), array($pid));
                if(count($list) == 0){
                    echo "无此数据";
                    return;                        
                }
            }
                
            // positionInfo
            $position = $list[0];
        ?>
        
        
		<script type="text/javascript" src="script/jquery-1.9.1.js"></script>
		<script type="text/javascript" src="script/r.js"></script>
        <script type="text/javascript">
            var uid = '<?php echo isset($_SESSION['userID']) ? $_SESSION['userID'] : -1 ?>';
            
            function doclickSubmit(){
                var actN = $("#actN").val();
                var actInfo = $("#actInfo").val();
                var extInfo = $("#extInfo").val();
                var pid = '<?php echo $position['POSITIONID'] ?>';
                
                var data = {actN: actN, aInfo: actInfo, extInfo: extInfo, userID:uid, pid: pid};
                addActivity(data);
            }
        </script>
	</head>
	<body>
		<div>
            <a href="activityList.php">活动列表</a>
            
			<h3>输入活动信息</h3>
            <?php
			if(isset($_SESSION['userID'])){            
			?>
            <p><h3>活动地点 ID: <?php echo $position['POSITIONID']; ?>, Name: <?php echo $position['POSITIONNAME']; ?></h3></p>
            <p><label>活动名</label><input type="text" id="actN" /></p>           
            <p><label>活动信息</label><input type="text" id="actInfo" /></p>           
            <p><label>附加信息</label><input type="text" id="extInfo" /></p>
            
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