<?php
namespace app\index\controller;
use think\Controller;

class Regular extends Controller
{
    public function regular(){
    //1、用户名不可有非法字符；
//        $username="~^&&*";
//        $zz="/^\W+$/i";
//        echo preg_match($zz,$username);
    //2、手机号
//        $phone="18786100798";
//        $zz="/^1[3-8]{1}\d{9}$/i";
//        echo preg_match($zz,$phone);
    //3、邮箱
//        $email="a_w@126.com";
//        $zz="/^\w+@\d+\.\w{2,3}$/i";
//        echo preg_match($zz,$email);
    //4、验证真实姓名
//        $username="陈鑫磊";
//        $zz="/^[\x{4e00}-\x{9fa5}]{1,5}$/u";
//        echo preg_match($zz,$username);
    //5、整数
//        $shu="1";
//        $zz="/^\d+$/";
//        echo preg_match($zz,$shu);
    //6、仅中文
//        $utf8="陈鑫磊";
//        $zz="/^[\x{4e00}-\x{9fa5}]{1,5}$/u";
//        echo preg_match($zz,$utf8);
    //7、身份证
//        $utf8="37132520000303113x";
//        $zz="/^\d{17}[Xx0-9]{1}$/";
//        echo preg_match($zz,$utf8);
    //8、ip地址
//        $ip="127.0.0.1";
//        $zz="/\d+\.\d+\.\d+\.\d+/";
//        echo preg_match($zz,$ip);
    //9、正常url
        $ip="www.niubi.com";
        $zz="/^[w]{3}\.\w+\.\w{2,3}$/i";
        echo preg_match($zz,$ip);
    }
}
?>