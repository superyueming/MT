<?php
session_start();
require_once("logic/connect.php");
require_once("base/Guid.php");

$lid = 0;
$param_str = $_SERVER["QUERY_STRING"];
parse_str($param_str, $param_arr);
if(isset($param_arr['lid']))
    $lid = (int)$param_arr['lid'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>编辑地点</title>
		<script type="text/javascript" src="script/jquery-1.9.1.js"></script>
		<script type="text/javascript" src="script/r.js"></script>
        <script type="text/javascript">
            var uid = '<?php echo isset($_SESSION['userID']) ? $_SESSION['userID'] : -1 ?>';
            var lid = <?php echo $lid;?>;
            
            function doclickSubmit(){
                var locName = $("#posN").val();
                var province = $("#pro").val();
                var city = $("#city").val();
                var block = $("#block").val();
    
                var data = {lid: lid, ln: locName, pro: province, city: city, block: block, userID:uid};
                editLoc(data);
            }
        </script>
	</head>
	<body>
		<div>
            <a href="locationList.php">地点列表</a>
            
            <?php
                if($lid <= 0){
                    echo "参数非法";
                    return;
                }
      
                $list = SQL::query("location", array("ID"), array("$lid"));
                if(count($list) == 0){
                    echo "无此数据";
                    return;
                }
                
                $data = $list[0];
                    
                if(isset($_SESSION['userID'])){
            ?>
            <p><label>地点名</label><input type="text" id="posN" value="<?php echo $data['LOCATIONNAME']; ?>" /></p>
            <p><label>省</label><input type="text" id="pro" value="<?php echo $data['PROVINCE'];?>" /></p>
            <p><label>市</label><input type="text" id="city" value="<?php echo $data['CITY'];?>" /></p>
            <p><label>街道位置</label><input type="text" id="block" value="<?php echo $data['LOCATIONINFO'];?>" /></p>
            
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