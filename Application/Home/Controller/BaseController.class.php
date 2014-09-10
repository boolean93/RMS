<?php
namespace Home\Controller;
use Think\Controller;

class BaseController extends Controller {
    public function _initialize(){
        //判断登陆
        if(!check_login()) $this->error("Please Login.", U("Index/login"));

        //输出导航
        $Nav = D("nav");
        $father = $Nav->where("nav_fid = 0")->select();
        foreach($father as $key => $value){
            $father[$key]['son'] = $Nav->where("nav_fid=$value[nav_id]")->select();
        }

        $temp = explode("/",$_SERVER['REQUEST_URI']);
        foreach($temp as $key => $value){
            if($value == "Home"){
                $firstSub = $temp[$key+1];
                $firstSon = $temp[$key+2];
            }
        }
        $fatherArray = $Nav->where("nav_fid=0")->select();
        foreach($fatherArray as $key => $value){
            if($firstSub == $value['nav_controller']){
                $firstSub = $key + 1;
                break;
            }
        }

        $sonArray = $Nav->where("nav_function='$firstSon'")->find();
        $sonArray = $sonArray['nav_fid'];
        $sonArray = $Nav->where("nav_fid=$sonArray")->select();
        foreach($sonArray as $key => $value){
            if($firstSon == $value['nav_function']){
                $firstSon = $key + 1;
                break;
            }
        }

        $this->assign("firstSub", $firstSub);
        $this->assign("firstSon", $firstSon);
        $this->assign("nav", $father);
    }
}
