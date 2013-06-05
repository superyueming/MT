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
		<title>活动信息</title>
         <?php
         $aid = 0;
         $param_str = $_SERVER["QUERY_STRING"];
         parse_str($param_str, $param_arr);
         if(isset($param_arr['aid']))
             $aid = (int)$param_arr['aid'];

         if($aid <= 0){
             echo "参数非法";
             return;
         }else{            
             $list = SQL::query("activity", array("ID"), array($aid));
             if(count($list) == 0){
                 echo "无此数据";
                 return;                        
             }             
         }
         
         // activityInfo
         $activity = $list[0];
         
         // 创建者ID
         $creatorID = $activity['CREATEUSERID'];
         
         // 创建者
         $list1 = SQL::query("user", array("USERID"), array("$creatorID"));
         $creatorInfo = $list1[0];
         
         // activity-follower
         $list2 = SQL::query("activity_follower", array("ID"), array($aid));
         
         ?>
		<script type="text/javascript" src="script/jquery-1.9.1.js"></script>
		<script type="text/javascript" src="script/r.js"></script>
        <script type="text/javascript">
            var uid = "<?php echo $_SESSION['userID']; ?>";
            var aid = "<?php echo $activity['ACTIVITYID']; ?>";
        
            function doclickFollow(event){
                var d = {
                    aid: aid,
                    uid: uid
                };
                followActivity(d);
            }
        </script>
	</head>
	<body>
		<div>
            <a href="activityList.php">活动列表</a>
           
            <p><h3>Name: <?php echo $activity['ACTIVITYNAME']; ?>&nbsp;<a href="activityEdit.php?aid=<?php echo $aid;?>">编辑</a>&nbsp;<a href="#" onclick="doclickFollow(event)">关注</a></h3></p>            
            <p><label>ActivityInfo: <?php echo $activity['ACTIVITYINFO']; ?></label></p>
            <p><label>ExtraInfo: <?php echo $activity['EXTINFO']; ?></label></p>
            <p><label>CreateDate: <?php echo date('Y-m-d H:i:s', $activity['CREATEDATE']); ?></label></p>
            <p><label>Status: <?php echo $activity['STATUS']; ?></label></p>
            <p><label>CreatorID: <?php echo $activity['CREATEUSERID']; ?></label></p>

            <p><h3>Creator: </h3></p>
            <p><label>ID: <?php echo $creatorInfo['USERID']; ?></label></p>
            <p><label>Name: <?php echo $creatorInfo['USERNAME']; ?></label></p>
            
            <p><h3>关注用户</h3></p>
            <?php 
                foreach($list2 as $follower){
                    $list3 = SQL::query("user", array("USERID"), array($follower['USERID']));
                    $f = $list3[0];
            ?>
            <p><label>UserID: <?php echo $f['USERID']; ?></label><label>, UserName: <?php echo $f['USERNAME']; ?></label></p>
            <?php
                }
            ?>
		</div>
	</body>
</html>