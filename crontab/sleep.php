<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/25 0025
 * Time: 下午 5:41
 */

//用户吧浏览器关闭后正常执行
ignore_user_abort(true);
//设置 0 让程序不挺执行
set_time_limit(0);
//休息时间
$interval = 10;
do{
    $run = include "./config.php";
    // 如果配置项是关 则定时停止
    if(!$run) break;
    file_put_contents(time().'.txt',"php定时！");
    sleep($interval);
}while(true);
