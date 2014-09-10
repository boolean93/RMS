<?php

/**
 * @param $str
 * @return string 加盐MD5
 */
function cookie_encode($str){
   return md5($str . "_REDROCK_MANAGEMENT_SYSTEM");
}

/**
 * @return bool 是否登陆
 */
function check_login(){
   return (count_chars(cookie("user_id")))?true:false;
}

/**
 * 自定义dump函数,可以加上标题
 * @param $title
 * @param $array
 */
function mdump($title, $array){
    echo $title."<br>";
    dump($array);
}

function getTableId($tb){
    return $tb."_id";
}