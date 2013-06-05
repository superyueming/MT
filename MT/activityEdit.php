<?php
session_start();
require_once("logic/connect.php");
require_once("base/Guid.php");

$aid = 0;
$param_str = $_SERVER["QUERY_STRING"];
parse_str($param_str, $param_arr);
if(isset($param_arr['aid']))
    $aid = (int)$param_arr['aid'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>编辑活动</title>
		<script type="text/javascript" src="script/jquery-1.9.1.js"></script>
		<script type="text/javascript" src="script/r.js"></script>
        <script type="text/javascript">
            var uid = '<?php echo isset($_SESSION['userID']) ? $_SESSION['userID'] : -1 ?>';
            var aid = <?php echo $aid;?>;
            
            function doclickSubmit(){
                var actN = $("#actN").val();
                var extI = $("#extI").val();
                var status = $("#status").val();
    
                var data = {aid: aid, an: actN, ei: extI, s: status, userID:uid};
                editActivity(data);
            }
        </script>
	</head>
	<body>
		<div>
            <a href="activityList.php">地点列表</a>
            
            <?
            if($aid <= 0){
                echo "参数非法";
                return;
            }
            
            $list = SQL::query("activity", array("ID"), array("$aid"));
            if(count($list) == 0){
                echo "无此数据";
                return;
            }
            
            $data = $list[0];
            
            if(isset($_SESSION['userID'])){
            ?>
            <p><label>活动名</label><input type="text" id="actN" value="<?php echo $data['ACTIVITYNAME']; ?>" /></p>
            <p><label>附加信息</label><input type="text" id="extI" value="<?php echo $data['EXTINFO'];?>" /></p>
            <p><label>活动状态</label><input type="text" id="status" value="<?php echo $data['STATUS'];?>" /></p>
            
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