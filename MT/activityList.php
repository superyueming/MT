<?php
session_start();
require_once("logic/connect.php");
require_once("base/debug.php");
require_once("base/Guid.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>活动列表</title>
		<script type="text/javascript" src="script/jquery-1.9.1.js"></script>
		<script type="text/javascript" src="script/register/r.js"></script>
        <script type="text/javascript">
       
        </script>
	</head>
	<body>
		<div>
			<h3>活动列表</h3>
            <?php
            $list = SQL::query("activity", array(), array(), 50);
            
            foreach($list as $data){
            ?>
                <p>ID: <?php echo $data['ID']; ?>
                    , UniqueID: <?php echo $data['ACTIVITYID']; ?>
                    , ActivityName: <?php echo $data['ACTIVITYNAME']; ?>
                    , CreatorID: <?php echo $data['CREATEUSERID']; ?>
                    , LocationID: <?php echo $data['POSITIONID']; ?>
                    , Status: <?php echo $data['STATUS']; ?>
                    <a href="activityInfo.php?aid=<?php echo $data['ID']; ?>">查看</a>
                </p>
            <?php
            }
            ?>           
            <br />
            <a href="activityAdd.php">增加活动</a>
            <a href="index.php">回到主页</a>
		</div>
	</body>
</html>