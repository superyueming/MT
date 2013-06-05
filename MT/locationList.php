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
		<title>地点列表</title>
		<script type="text/javascript" src="script/jquery-1.9.1.js"></script>
		<script type="text/javascript" src="script/register/r.js"></script>
        <script type="text/javascript">
       
        </script>
	</head>
	<body>
		<div>
			<h3>地点列表</h3>
            <?php
                $list = SQL::query("position", array(), array(), 50);
               
                foreach($list as $data){
                    echo "<p>
                    ID: {$data['ID']}, 
                    UniqueID: {$data['POSITIONID']}, 
                    PositionName: {$data['POSITIONNAME']}, 
                    Province: {$data['PROVINCE']}, 
                    City: {$data['CITY']} ,
                    PositionInfo:{$data['POSITIONINFO']},
                    ExtensionInfo: {$data['EXTINFO']},
                    CreatorID: {$data['CREATEUSERID']},
                    <a href='locationInfo.php?lid={$data['ID']}'>查看</a>
                    </p>";                    
                }
            ?>           
            <br />
            <a href="locationAdd.php">增加地点</a>
            <a href="index.php">回到主页</a>
		</div>
	</body>
</html>