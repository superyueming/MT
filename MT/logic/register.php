<?php
require_once("connect.php");
require_once("../base/Guid.php");

main();

function main(){
    $user = $_POST["un"];
    $psw = $_POST["psw"];
    $nickName = $_POST["nn"];
    $IDCard = $_POST["id"];
    $mobile = $_POST["mp"];
    $email = $_POST["em"];
   
    //用户名是否存在
    $v_user = Validation::validateUserName($user);
    if(!$v_user->isSuccess)
        return $v_user->output();
    
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
    $date = mktime();
    $ip = IP::get_client_ip();
    $ip_num = IP::ip2Num($ip);
    
    $insert = SQL::insert("user", 
        array('USERNAME', 'PASSWORD','NICKNAME','USERID', 'CREATEDATE', 'CREATEIP'), 
        array("'$user'", "'$mpsw'", "'$nickName'", "'$uid'", "$date", "'$ip_num'")
    );        
    
    if($insert)
        echo "ok". " $uid";
    else
        echo "error";
}
    
?>