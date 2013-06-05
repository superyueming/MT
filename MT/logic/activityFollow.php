<?php
session_start();

require_once("connect.php");
require_once("../base/Guid.php");
require_once("../base/debug.php");

main();

function main(){
    $aid = $_POST["aid"];
    $uid = $_POST["uid"];

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
    $list = SQL::query("activity_follower", 
        array('USERID', 'ACTIVITYID'), 
        array($uid, $aid)
    );
    echo count($list);
    if(count($list) > 0){
        echo "already followed";
        return;
    }
    
    $date = mktime();
    $ip = IP::get_client_ip();
    $ip_num = IP::ip2Num($ip);
    $insert = SQL::insert("activity_follower", 
        array("ACTIVITYID", "USERID", "CREATEDATE", "CREATEIP"), 
        array("'$aid'", "'$uid'", "$date", "$ip_num")
    );
    
    if($insert)
        echo "ok";
    else
        echo "error";
}
    
?>