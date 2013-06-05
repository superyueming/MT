<?php
session_start();

require_once("connect.php");
require_once("../base/Guid.php");
require_once("../base/debug.php");

main();

function main(){
    $posID = $_POST["pid"];
    $uid = $_POST["userID"];

    // 数据验证    
    if(!isset($_SESSION["userID"])){
        echo "session lost";
        return;
    }
    
    if($_SESSION["userID"] != $uid){
        echo "invalid user id";
        return;
    }

    // 是否已经存在
    $list = SQL::query("position_follower", 
        array('USERID', 'POSITIONID'), 
        array($uid, $posID)
    );
    if(count($list) > 0){
        echo "already followed";
        return;
    }
    
    $date = mktime();
    $ip = IP::get_client_ip();
    $ip_num = IP::ip2Num($ip);
    $insert = SQL::insert("position_follower", 
        array("POSITIONID", "USERID", "CREATEDATE", "CREATEIP"), 
        array("'$posID'", "'$uid'", "$date", "$ip_num")
    );
    
    if($insert)
        echo "ok";
    else
        echo "error";
}
    
?>