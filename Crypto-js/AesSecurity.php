<?php


class AesSecurity
{
    /**
     * method 为AES-128-CBC时
     * @var string传入要加密的明文
     * 传入一个16字节的key
     * 传入一个16字节的初始偏移向量IV
     */
    private static $method = 'AES-128-CBC';
    private static $key = 'contentWindowHig';
    private static $options = OPENSSL_RAW_DATA;
    private static $iv = 'contentDocuments';

    public static function getKey()
    {
        return self::$key;
    }
    public function __construct()
    {
        self::$key = md5(self::$key,true);
    }

    public static function setMethod($method){
        self::$method = $method;
    }
    public static function setKey($key){
        self::$key = $key;
    }
    /**
     * @param $options 可取值 OPENSSL_ZERO_PADDING OPENSSL_RAW_DATA
     */
    public static function setOptions($options){
        self::$options = $options;
    }

    /**
     * 加密
     * @param $input
     * @return string
     */
    public static function _encrypt($input){
        $key = substr(md5(self::$key),0,16);
        $iv = substr(md5(self::$iv),0,16);
        $data = base64_encode(openssl_encrypt($input,self::$method,$key,self::$options,$iv));
        return $data;
    }

    /**
     * 解密
     * @param $input
     * @return bool|string
     * todo rtrim
     */
    public static function _decrypt($input){
        $key = substr(md5(self::$key),0,16);
        $iv = substr(md5(self::$iv),0,16);
        $data = openssl_decrypt(base64_decode($input),self::$method,$key,self::$options,$iv);
        return $data;
    }
}

//加密
/*$data = AesSecurity::_encrypt('前端加密方式使用的Crypto-JS');
var_dump($data);*/

//解密
$res = AesSecurity::_decrypt('nq83NhvpWp8KtNFBnuzslw==');
var_dump($res);

