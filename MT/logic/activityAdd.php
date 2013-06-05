<?php
session_start();

require_once("connect.php");
require_once("../base/Guid.php");
require_once("../base/debug.php");

main();

function main(){
    $actName = $_POST["actN"];
    $actInfo = $_POST["aInfo"];
    $extInfo = $_POST["extInfo"];
    $pid = $_POST["pid"];
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
    
    // 活动名是否合法
    $v_locName = Validation::validateActivityName($actName);
    if(!$v_locName->isSuccess)
        return $v_locName->output();
    
    // 附加信息是否合法
    $v_province = Validation::validateActivityExtraInfo($extInfo);
    if(!$v_province->isSuccess)
        return $v_province->output();    
        
    // 自动生成uid, MD5-psw
    $aid = Guid::NewGuid();
    $date = mktime();
    $ip = IP::get_client_ip();
    $ip_num = IP::ip2Num($ip);
    
    
    $insert = SQL::insert("activity", 
        array('ACTIVITYID','ACTIVITYNAME', 'POSITIONID', 'CREATEUSERID', 'ACTIVITYINFO','EXTINFO','STATUS', 'CREATEDATE', 'UPDATEDATE', 'CREATEIP', 'MODIP'), 
        array("'$aid'","'$actName'", "'$pid'","'$uid'", "'$actInfo'", "'$extInfo'", 0, "$date", "$date", "$ip_num", "$ip_num")
    );

    if($insert)
        echo "ok"."$aid";
    else
        echo "error";
}
    
?>