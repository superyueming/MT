<?php

session_start();
require_once("connect.php");
require_once("../base/Guid.php");
require_once("../base/debug.php");

main();

function main(){
    $method = $_POST["type"];    
    if($method == 1){
        login();
    }else if($method == 2){
        logout();
    } 
}

function login(){
    $user = $_POST["un"];
    $psw = $_POST["psw"];

    #validation
    
    $list = SQL::query("user", array("USERNAME", "PASSWORD"), array($user,md5($psw)));    

    if(count($list) <= 0){
        echo "error";
        return;
    }
    
    $_SESSION['userID'] = $list[0]["USERID"];
    $_SESSION['userName'] = $list[0]["USERNAME"];
    echo "ok";    
}

function logout(){
	unset($_SESSION);
	session_destroy();
	echo 'ok';
}

?>