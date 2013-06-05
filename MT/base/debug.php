<?php
class DEBUG
{
    static function trace($str, $writeFile=false){        
        if($writeFile){
            $v = print_r($str, TRUE);
            $fp = fopen("output/trace.txt", "w");
            fwrite($fp, $v);
            fclose($fp);    
        }else{
            $v = print_r($str);
        }       
    }
}
?>