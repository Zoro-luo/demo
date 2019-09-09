<html>
<head>
    <title>cryptoJS 安装与使用</title>
</head>
<body>
<!--
1.安装
    npm install crypto-js
    #安装之后看到node_modules目录直接放到public目录下
2.使用
    主要引入以下这个文件
    crypto-js/crypto-js.js
-->
<script>
    //js端
    function secret(string, code, operation) {
        code = CryptoJS.MD5('contentDocuments').toString();
        code2 = CryptoJS.MD5('contentWindowHig').toString();
        var iv = CryptoJS.enc.Utf8.parse(code.substring(0, 16));
        var key = CryptoJS.enc.Utf8.parse(code2.substring(0,16));
        if (operation) {
            return CryptoJS.AES.decrypt(string, key, {iv: iv, padding: CryptoJS.pad.Pkcs7}).toString(CryptoJS.enc.Utf8);
        }
        return CryptoJS.AES.encrypt(string, key, {
            iv: iv,
            mode: CryptoJS.mode.CBC,
            padding: CryptoJS.pad.Pkcs7
        }).toString();
    }
</script>

</body>
</html>

<?php
    //php端
    public function secret($string,$code,$operation=false){
        $code = md5('contentDocuments');
        $code2 = md5('contentWindowHig');
        $iv = substr($code,0,16);
        $key = substr($code2,0,16);
        if($operation){
            return openssl_decrypt(base64_decode($string),"AES-128-CBC",$key,OPENSSL_RAW_DATA,$iv);
        }
        return base64_encode(openssl_encrypt($string,"AES-128-CBC",$key,OPENSSL_RAW_DATA,$iv));
    }

?>
