<?php
session_start();

require_once("connect.php");
require_once("../base/Guid.php");
require_once("../base/debug.php");

main();

function main(){
    $oldpsw = $_POST["op"];
    $psw = $_POST["psw"];
    $nickName = $_POST["nn"];
    $IDCard = $_POST["id"];
    $mobile = $_POST["mp"];
    $email = $_POST["em"];
   
    //取出用户名及相应的密码
    $un = $_SESSION['user'];
    $list = SQL::query("user", array("USERNAME"), array($un));
    
    if(count($list) < 1){
        echo "error input";
        return;
    }    
    
    if($list[0]["PASSWORD"] != md5($oldpsw)){
        echo "error old psw";
        return;
    }    
    
    //密码是否合法
    $v_psw = Validation::validatePsw($psw);
    if(!$v_psw->isSuccess)    
        return $v_psw->output();    

    //昵称是否合法
    $v_nn = Validation::validateNickName($nickName);
    if(!$v_nn->isSuccess)        
        return $v_nn->output();

    // 自动生成uid, MD5-psw
    $uid = Guid::NewGuid();
    $mpsw = md5($psw);
    $update = SQL::update("user", array("PASSWORD","NICKNAME"), array("'$mpsw'","'$nickName'"), "USERNAME='$un'");

    if($update)
        echo "ok";
    else
        echo "error";
}
    
?>