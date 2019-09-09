<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/25 0025
 * Time: 下午 5:48
 */
// 定时抓取百度热点大数据
header("content-type:text/html;charset=utf-8");
$run = include "./config.php";
if (!$run) die("stop");

$time = 10;
$url = "http://top.baidu.com/buzz?b=1&c=513&fr=topcategory_c513";

// 1. curl 初始化
$ch = curl_init();
// 2. 设置选项
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); //以字符串返回
// 3. 执行并获取url文档内容
$content = curl_exec($ch);
if ($content == false){
    echo "error:".curl_error($ch);
}
//4.关闭
curl_close($ch);

//过滤文档数据
preg_match_all('/<td\sclass="keyword">[\s\S]*<\/td>/',$content,$match);
preg_match_all('/<a\sclass="list-title[^>]*">.*<\/a>/',$match[0][0],$titles);
//数据写入文件
$str = '';
for ($i=0;$i<50;$i++){
    $tag = strip_tags($titles[0][$i]);
    $str .= "\r$tag\r";
}
file_put_contents(time().'.txt',$str);
sleep($time);
//继续接力 引入当前文件
include "./file.php";
