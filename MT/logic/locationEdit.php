<?php
session_start();

require_once("connect.php");
require_once("../base/Guid.php");
require_once("../base/debug.php");

main();

function main(){
    $locID = $_POST["lid"];
    $locName = $_POST["ln"];
    $province = $_POST["pro"];
    $city = $_POST["city"];
    $block = $_POST["block"];
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
    $v_locName = Validation::validateLocationName($locName);
    if(!$v_locName->isSuccess)
        return $v_locName->output();
    
    // 省市名是否合法
    $v_province = Validation::validateProvince($province);
    if(!$v_province->isSuccess)
        return $v_province->output();
    
    $v_city = Validation::validateCity($city);
    if(!$v_city->isSuccess)
        return $v_city->output();  
    
    //街道名是否合法
    $v_block = Validation::validateBlockName($block);
    if(!$v_block->isSuccess)
        return $v_block->output();    
        
    $insert = SQL::update("location", array('LOCATIONNAME','PROVINCE','CITY','LOCATIONINFO'), array("'$locName'","'$province'","'$city'","'$block'"), "ID='$locID'");

    if($insert)
        echo "ok";
    else
        echo "error";
}
    
?>