<?php
session_start();
require_once("logic/connect.php");
require_once("base/Guid.php");
require_once("base/debug.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>地点信息</title>
        <?php
        $pid = 0;
        $param_str = $_SERVER["QUERY_STRING"];
        parse_str($param_str, $param_arr);
        if(isset($param_arr['lid']))
            $pid = (int)$param_arr['lid'];

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
               
        // 创建者ID
        $creatorID = $position['CREATEUSERID'];
               
        // 创建者User
        $list1 = SQL::query("user", array("USERID"), array("$creatorID"));                
        $creatorInfo = $list1[0];
               
        // position-follower
        $list2 = SQL::query("position_follower", array("ID"), array($pid), 20);
               
        // position-activity
        $list4 = SQL::query("activity", array("POSITIONID"), array($position['POSITIONID']), 20);
    ?>
    
		<script type="text/javascript" src="script/jquery-1.9.1.js"></script>
		<script type="text/javascript" src="script/r.js"></script>
        <script type="text/javascript">
            var uid = "<?php echo $_SESSION['userID']; ?>";
            var pid = "<?php echo $position['POSITIONID']; ?>";
        
            function doclickFollow(event){
                var data = {
                    pid: pid,
                    userID: uid
                };
                
                followLoc(data);
            }
        </script>
	</head>
	<body>
		<div>
            <a href="locationList.php">地点列表</a>
     
            <p><h3>Name: <?php echo $position['POSITIONNAME']; ?></h3><a href="#" onclick="doclickFollow(event)">关注</a>&nbsp;<a href="activityAdd.php?pid=<?php echo $pid;?>">发起活动</a></p>
            <p><label>Province: <?php echo $position['PROVINCE']; ?></label></p>
            <p><label>City: <?php echo $position['CITY']; ?></label></p>
            <p><label>LocationInfo: <?php echo $position['POSITIONINFO']; ?></label></p>
            <p><label>CreatorID: <?php echo $position['CREATEUSERID']; ?></label></p>            
            <p><label>CreateDate: <?php echo date('Y-m-d H:i:s', $position['CREATEDATE']); ?></label></p>
            <p><label>UpdateDate: <?php echo date('Y-m-d H:i:s', $position['UPDATEDATE']);  ?></label></p>            
            <p><a href="locationEdit.php?lid=<?php echo $pid;?>">编辑</a></p>
            
            <p><h3>Creator: </h3></p>
            <p><label>ID: <?php echo $creatorInfo['USERID']; ?></label></p>
            <p><label>Name: <?php echo $creatorInfo['USERNAME']; ?></label></p>
            
            <p><h3>关注用户</h3></p>
            <?php 
                foreach($list2 as $follower){
                    $list3 = SQL::query("user", array("USERID"), array($follower['USERID']));
                    $f = $list3[0];
            ?>
            <p><label>UserID:<?php echo $f['USERID'] ?></label><label>, UserName:<?php echo $f['USERNAME'] ?></label></p>
            <?php
                }
            ?>           
            
            <p><h3>活动列表</h3></p>
            <?php 
                foreach($list4 as $activity){
            ?>
            <p><label>ActivityID:<?php echo $activity['ACTIVITYID'] ?></label><label>, ActivityName:<?php echo $activity['ACTIVITYNAME'] ?> </label><a href="activityInfo.php?aid=<?php echo $activity['ID'] ?>">查看</a></p>
            <?php 
                }
            ?>
		</div>
	</body>
</html>