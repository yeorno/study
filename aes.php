<?php





//aes 加密
/**
 * 
 * @param string $xml要加密的字符串
 * @return encrypted 返回加密后的字符串
 * @param  该函数没有base64加密
 */
 function aes_encrypt($xml){
    $Key = $key;
    $iv = $value;

    //加密
    $encrypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, hex2bin($Key), $xml, MCRYPT_MODE_CBC, hex2bin($iv));
    //$jiami = base64_encode($encrypted);
    //return $jiami;
    return $encrypt;


}

//aes  解密
/**
 * 
 * @param string  $encrypt 要解密的字符串
 * @return string $decrypted 返回解密后的数据
 */
function aes_decrypt($encrypt){

    $privateKey = $key;;
    $iv         = $value;
    //$encryptedData = base64_decode($jiami);
    $encryptedData = $encrypt;
    $decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, hex2bin($privateKey), $encryptedData, MCRYPT_MODE_CBC, hex2bin($iv));
    return $decrypted;
}

// 接口加密函数，先压缩，再加密

function api_encrypt($str){
    $gzip    = gzencode($str); 
    $encrypt = aes_encrypt($gzip);
    return $encrypt;
}


//接口解密,先解密，再解压
function api_decrypt($str)
{
    $decrypt = aes_decrypt($str);
    $unzip   = gzdecode($decrypt);// 
    return $unzip;
}
//接口解密
/**
 * urldecode->base64_decode->aes_decrypt
 * @param unknown $str 要解密的字符串
 */
function bapi_decrypt($str){
    #$arr = aes_decrypt(base64_decode(str_replace(" ","+",urldecode($str))));
    $arr=$str;
    if(strpos($arr, '&')){//要切割数据
        $arr = explode('&', $arr);
        foreach ($arr as $key =>$val){
            $a = explode('=',$val);
            $res[$a[0]] = trim($a[1]);
            
        }
        //return $res;
    }else{
        $a = explode('=',$arr);
        $res[$a[0]] = $a[1];
        
    }
    return $res;
}
function test(){
   #对接收的参数解密
   $string="action=123&username=liu123&nage=18";#原始数据

   $after_code=aes_encrypt($string); #加密

   $result=aes_decrypt($after_code);#解密
   
   $list=bapi_decrypt($result);
  
   var_dump($list);


}
test();
