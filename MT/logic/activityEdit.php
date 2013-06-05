<?php
session_start();

require_once("connect.php");
require_once("../base/Guid.php");
require_once("../base/debug.php");

main();

function main(){
    $activity_id = $_POST["aid"];
    $activity_name = $_POST["an"];
    $activity_extraInfo = $_POST["ei"];
    $activity_status = $_POST["s"];
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
    
    // 地点名是否合法
    $v_locName = Validation::validateActivityName($activity_name);
    if(!$v_locName->isSuccess)
        return $v_locName->output();
        
    // 附加信息是否合法
    $v_province = Validation::validateActivityExtraInfo($activity_extraInfo);
    if(!$v_province->isSuccess)
        return $v_province->output();        
        
    $insert = SQL::update("activity", array('ACTIVITYNAME','EXTINFO','STATUS'), array("'$activity_name'","'$activity_extraInfo'","'$activity_status'"), "ID='$activity_id'");

    if($insert)
        echo "ok";
    else
        echo "error";
}
    
?>