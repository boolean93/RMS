<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends BaseController {

    /**
     * 根据参数进行join操作, 可以适应可变join个数
     * @param $MyModel object 已经实例化的模型
     * @param $relations array 关系以及联查规则, 对应relation表
     * @param $subQuery array 上次的子查询语句
     * @return array 取回的结果集
     */
    public function multiJoin($MyModel, $relations, $subQuery){

        //获取单个关系
        $singleRela = array_pop($relations);

        //判断是否为第一层(第一层的subQuery为空)
        if(!$subQuery)
            $multiSql = $MyModel
                ->join("$singleRela[relation_join_method] $singleRela[relation_other_table] ON `$singleRela[relation_main_field]`=$singleRela[relation_other_field]")
                ->buildSql();
        else
            $multiSql = $MyModel
                ->table($subQuery." ".time())
                ->join("$singleRela[relation_join_method] $singleRela[relation_other_table] ON `$singleRela[relation_main_field]`= `$singleRela[relation_other_field]`")
                ->buildSql();

        //判断所有的SQL联查语句是否已经组装完毕
        if(count($relations) == 0)
            return $MyModel->table($multiSql." last")->select();

        //否则继续递归
        return $this->multiJoin($MyModel, $relations, $multiSql);
    }

    /**
     * @param $tb string 需要管理的表名
     * 用于显示所管理表的内容(包括关联)
     * @assign tableList array 字段名及其中文名
     * @assign contentList array 表中内容显示
     * @TODO 分页暂时没做
     */
    public function manage($tb){
        $Tb = D($tb);
        if(count($temp = $Tb->query("SHOW COLUMNS FROM  `$tb`"))==0){
            $this->error("参数错误!", U("Index/index"));
        }

        //从table表中将$tb表中的字段显示出来,结果为tableList
        $tableList = array();
        $Table = D("table");
        for($i=1; $i<count($temp); $i++){
            $fieldName = $temp[$i]['Field'];
            $tempTableList = $Table->where("table_name = '$fieldName'")->select();
            $tableList[$i-1] = $tempTableList[0];
        }

        //将字段对应的所有值取出来
        $Relation = D("relation");
        $relations = $Relation->where("relation_main_table = '$tb'")->select();

        //获取内容列表
        $tempList = $this->multiJoin($Tb, $relations, null);

        //获取数组所有键,便于下面查询
        $keys = array_keys($tempList[0]);

        //装载查询条件
        $map = array(
            "table_name"=>"",
            "table_readable"=>"1",
        );

        for($i = 0; $i<count($tempList); $i++){
            foreach($keys as $vn){
                $map["table_name"] = $vn;

                //若有满足readable的table_name,那么就渲染进去
                if($Table->where($map)->count() > 0)
                    $contentList[$i][] = array(
                        'value' => $tempList[$i][$vn],
                        "field" => $vn,
                        'id' => $tempList[$i]['av_id'],
                    );
            }
        }

//        dump($contentList);

        $editUrl = U("Index/edit",array("tb"=>$tb));
        $delUrl = U("Index/delete",array("tb"=>$tb));
        $addUrl = U("Index/add",array("tb"=>$tb));

        $assign = array(
            "tb" => $tb,
            "addUrl" => $addUrl,
            "editUrl" => $editUrl,
            "delUrl" => $delUrl,
            "tableList" => $tableList,
            "contentList" => $contentList,
        );
        $this->assign($assign);
        $this->display();
    }

    /**
     * 用于显示可添加内容的页面
     * @param $tb
     */
    public function add($tb){

        //将字段对应的所有值取出来
        $Relation = D("relation");
        $relations = $Relation->where("relation_main_table = '$tb'")->select();

        //将主字段与副字段相连
        foreach($relations as $value){
            $relationMap[$value['relation_main_field']] = array(
                'real_field' => $value['relation_real_field'],
                'other_field' => $value['relation_other_field'],
            );

            $tempContent[$value['relation_main_field']] = D($value['relation_other_table'])->select();
        }


        $tableContent = D("table")
            ->where(array("table_table"=>$tb))
            ->join("tag_type ON tag_type_id=table_type")
            ->select();

//        mdump("tempContent", $tempContent);
//        mdump("relationMap", $relationMap);
//        mdump("tableContent", $tableContent);

        $this->assign("relationMap", $relationMap);
        $this->assign("tempContent", $tempContent);
        $this->assign("tableContent", $tableContent);
        $this->display();
    }

    /**
     * 用于提交新增内容或者修改内容
     * @param $tb
     */
    public function addSubmit($tb){

        $editableField = D("table")
            ->join("tag_type ON tag_type_id=table_type")
            ->where(
                array(
                    "table_editable"=>1,
                    "table_table"=>$tb,
                )
            )
        ->select();

        foreach($editableField as $value){
            $tableName = $value['table_name'];
            $tableRealName = $value['table_realname'];
            $data[$tableName] = I("post.$tableName");
            switch($value['tag_type_name']){
                case "time":{
                    $data[$tableName] = time();
                    break;
                }
            }
            if((!$data[$tableName]) && ($value['table_must'] == 1)){
                $this->error("请输入 $tableRealName");
            }
        }
        if(D($tb)->data($data)->add()){
            $this->success("添加成功!", U("Index/manage", array("tb"=>$tb)));
        }else{
            $this->error("添加失败!");
        }
    }

    public function edit($tb, $id){

        //将字段对应的所有值取出来
        $Relation = D("relation");
        $relations = $Relation->where("relation_main_table = '$tb'")->select();

        //将主字段与副字段相连
        foreach($relations as $value){
            $relationMap[$value['relation_main_field']] = array(
                'real_field' => $value['relation_real_field'],
                'other_field' => $value['relation_other_field'],
            );

            $tempContent[$value['relation_main_field']] = D($value['relation_other_table'])->select();
        }


        $tableContent = D("table")
            ->where(
                array(
                    "table_table"=>$tb,
                ))
            ->join("tag_type ON tag_type_id=table_type")
            ->select();

//        mdump("tempContent", $tempContent);
//        mdump("relationMap", $relationMap);
//        mdump("tableContent", $tableContent);

        $currentContent = D($tb)->find($id);
//        mdump("currentContent", $currentContent);
        $this->assign("tb_id", $tb."_id");
        $this->assign("currentContent", $currentContent);
        $this->assign("relationMap", $relationMap);
        $this->assign("tempContent", $tempContent);
        $this->assign("tableContent", $tableContent);
        $this->display("Index:add");
    }

    /**
     * 用于删除
     * @param $tb String 表名
     * @param $id Int 删除对应东西的id
     */
    public function delete($tb, $id){
        if(D($tb)->delete($id))
            $this->success("删除成功!", U("Index/manage",array("tb"=>$tb)));
        else $this->error("删除失败!", U("Index/manage",array("tb"=>$tb)));
    }


    /*
     * 登陆模块 AJAX
     * -----------------------------
     * 登陆成功:
     *  $state = array(
     *      "Code"=>"200",
     *      "Message"=>"登陆成功!",
     *  );
     * 登录失败:
     *  $state = array(
     *     "Code"=>"401",
     *     "Message"=>"登陆失败!",
     *  );
     * ------------------------------
     */
    public function login(){
        $state = array(
            "Code"=>"401",
            "Message"=>"登陆失败!",
        );

        $username = I("post.username", "");
        $password = md5(I("post.password", ""));
        $User = D("User");
        $res = $User->where("user_realname = '$username' AND user_password = '$password' AND user_state=1")->select();

        if(is_numeric($res[0]["user_id"])){
            session("uid", $res[0]["user_id"]);
            cookie("uid", cookie_encode($res[0]["user_id"]), 36000);
            cookie("username", $username, 36000);
            $state["Code"] = "200";
            $state["Message"] = "登陆成功!";
        }

        $this->ajaxReturn($state);
        $this->display();
    }

    public function logout(){
        session("uid", null);
        cookie("uid", null);
        cookie("username", null);
        $this->success("注销成功!",U("Index/index"));
    }

}