<?php
 class Guid
 {
    static function NewGuid() {
        return uniqid();        
    }
 }
 
 class ValidateResult
 {
     public $isSuccess = FALSE;
     public $result = "";
     
     function ValidateResult($iss, $res){
        $this->isSuccess = $iss;
        $this->result = $res;
     }
     
     function output(){
        echo $this->result;
     }
 }
 
 class Validation
 {
    static function validateUserName($n){
        $res = new ValidateResult(true, "");
        
        //是否超长
        $num = strlen($n);
        if($num > 10){
            $res->isSuccess = false;
            $res->result = "user name too long";
            return $res;
        }
        
        //是否包含非法字符
        if (!preg_match('/^[0-9a-zA-Z|_]+$/',$n)){
            $res->isSuccess = false;
            $res->result = "user name invalid char";
            return $res;
        }

        //数据库中是否存在
        $list = SQL::query("user", array("USERNAME"), array($n));
        if(count($list) > 0){
            $res->isSuccess = false;
            $res->result = "user exsist";
            return $res;
        }
        
        return $res;            
    }
    
    static function validatePsw($p){
        $num = strlen($p);
        $res = new ValidateResult(true, "");
        
        if($num > 16){
            $res->isSuccess = false;
            $res->result = "password too long";
            return $res;
        }
        
        return $res;
    }
    
    static function validateNickName($n){
        $num = strlen($n);
        $res = new ValidateResult(true, "");
        
        if($num > 10){
            $res->isSuccess = false;
            $res->result = "nickName too long";
            return $res;
        }
        
        return $res;
    }
    
    static function validateLocationName($n){        
        $res = new ValidateResult(true, "");
        
        return $res;
    }
    
    static function validateProvince($p){
        $res = new ValidateResult(true, "");
        
        return $res;        
    }
    
    static function validateCity($c){
        $res = new ValidateResult(true, "");
        
        return $res;        
    }
    
    static function validateBlockName($b){
        $res = new ValidateResult(true, "");
        
        return $res;        
    }
    
    static function validateActivityName($b){
        $res = new ValidateResult(true, "");
        
        return $res;        
    }
    
    static function validateActivityExtraInfo($b){
        $res = new ValidateResult(true, "");
        
        return $res;        
    }
    
    static function validatePositionInfo($b){
        $res = new ValidateResult(true, "");
        
        return $res;
    }
 }
 
 
 
 class SQL
 {
    static function query($table, $attributeList, $valueList, $selectValue=1){
        $sqlStr = "select * from $table";
        $count = count($attributeList);
        
        if($count > 0){
            $sqlStr .= " where";
            for($i=0; $i<$count; $i++){
                $attr = $attributeList[$i];
                $value = $valueList[$i]; 
                $sqlStr .= " $attr='$value'";
                if($i < $count - 1)
                    $sqlStr .= " and";
            }
        }
        
        $q = mysql_query($sqlStr);       
        $f = mysql_fetch_array($q, MYSQL_ASSOC);

        $list = array();
        
        if(!is_array($f))
            return $list;

        array_push($list, $f);
            
        if($selectValue <= 1)
            return $list;
        
        // 进行到此处时, array中已经存在了$f的结果.
        while($g = mysql_fetch_array($q, MYSQL_ASSOC)){
            array_push($list, $g);
        }            

        return $list;
    }
    
    static function insert($table, $attributeList, $valueList){
        $sqlStr = "insert into $table (";
        $count = count($attributeList);
        
        for($i=0; $i<$count; $i++){
            $attr = $attributeList[$i];            
            $sqlStr .= $attr;
            if($i < $count - 1)
                $sqlStr .= ",";
        }
        $sqlStr .= ") values (";
        
        for($i=0; $i<$count; $i++){
            $value = $valueList[$i];
            $sqlStr .= $value;
            if($i < $count - 1)
                $sqlStr .= ",";
        }
        $sqlStr .= ")";
        echo $sqlStr;
        $q = mysql_query($sqlStr);
        
        return $q;
    }
    
    static function update($table, $attributeList, $valueList, $ruleStr){
        $sqlStr = "update $table set";
        $count = count($attributeList);
        
        for($i=0; $i<$count; $i++){
            $attr = $attributeList[$i];
            $value = $valueList[$i];
            
            $sqlStr .= " $attr=$value"; 
            if($i < $count - 1)
                $sqlStr .= ",";
        }
        
        $sqlStr .= " where $ruleStr";
        
        return mysql_query($sqlStr);
    }
 }
 
 class IP{
    static function get_client_ip(){      
        if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
            $ip = getenv("HTTP_CLIENT_IP");
        else
            if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
                $ip = getenv("HTTP_X_FORWARDED_FOR");
            else
                if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
                    $ip = getenv("REMOTE_ADDR");
                else
                    if (isset ($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
                        $ip = $_SERVER['REMOTE_ADDR'];
                    else
                        $ip = "unknown";
                        
        return ($ip);      
    }
    
    static function ip2Num($ipStr){
        return ip2long($ipStr);
    }
    
    static function num2IP($num){
        return long2ip($num);
    }
 }
?>