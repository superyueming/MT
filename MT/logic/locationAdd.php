<?php
session_start();

require_once("connect.php");
require_once("../base/Guid.php");

main();

function main(){
    $posName = $_POST["pn"];
    $province = $_POST["pro"];
    $city = $_POST["city"];
    $block = $_POST["block"];
    $posInfo = $_POST["pi"];
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
    $v_locName = Validation::validateLocationName($posName);
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
    
    //地点信息是否合法
    $v_info = Validation::validatePositionInfo($posInfo);
    if(!$v_info->isSuccess)
        return $v_info->output();
        
    // 自动生成uid, MD5-psw
    $lid = Guid::NewGuid();
    $createDate = mktime();
    $ip = IP::get_client_ip();
    $ip_num = IP::ip2Num($ip);
    
    $insert = SQL::insert("position", 
        array('POSITIONID','POSITIONNAME','CREATEUSERID','PROVINCE','CITY','POSITIONINFO', 'CREATEDATE', 'UPDATEDATE', 'CREATEIP', 'MODIP'),
        array("'$lid'",             "'$posName'",       "'$uid'",               "$province","$city","'$block'",         "$createDate",  "$createDate",   "'$ip_num'","'$ip_num'")
    );

    if($insert)
        echo "ok"."$lid";
    else
        echo "error";
}
    
?>