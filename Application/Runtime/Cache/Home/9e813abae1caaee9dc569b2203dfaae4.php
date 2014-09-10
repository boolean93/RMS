<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>后台管理系统</title>
    <link rel="stylesheet" href="/backend/Public/css/common.css"/>
    <link rel="stylesheet" href="/backend/Public/css/index.css"/>

</head>
<body>
<div id="wrapper">
    <div id="head_bg">
        <div id="header">
            <img src="/backend/Public/img/logo.png" alt="后台"/>
            <ul class="nav">
                <li><a href="#">管理区首页</a></li>
                <li><a href="#">重邮主页</a></li>
                <li><a href="#">新闻中心</a></li>
                <li><a href="#">红岩网校</a></li>
            </ul>
        </div>
    </div>
<div id="content">
    <div id="main">
<div id="sub_nav">
    <ul id="accordion">
        <?php if(is_array($nav)): $k = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><li class="sub_button <?php if($k == $firstSub): ?>sub_first<?php endif; ?>">
                <a href="javascript:;">
                    <img src="/backend/Public/img/topic.png" alt=""/><?php echo ($vo["nav_name"]); ?>
                </a>
            </li>
            <ul class="dropdown">
                <?php if(is_array($vo['son'])): $kk = 0; $__LIST__ = $vo['son'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$son): $mod = ($kk % 2 );++$kk;?><li <?php if($kk == $firstSon): ?>class="on"<?php endif; ?>>
                        <a href="<?php echo U("$son[nav_controller]/$son[nav_function]");?>"><?php echo ($son["nav_name"]); ?></a>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</div>
        <div id="monitor" class="inside">
            <?php if(isset($currentContent)): ?><span class="grey_button">编辑内容</span><br/><br/>
            <?php else: ?>
                <span class="grey_button">添加内容</span><br/><br/><?php endif; ?>
            <form action="<?php echo U('Index/addSubmit');?>&tb=<?php echo ($_GET['tb']); ?>" method="post" style="text-align: center">
            <table>
            <?php if(is_array($tableContent)): $i = 0; $__LIST__ = $tableContent;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <?php if($vo["table_editable"] == 1): switch($vo['tag_type_name']): case "text": ?><th><?php echo ($vo["table_realname"]); ?>:</th>
                            <th><input type="text" name="<?php echo ($vo["table_name"]); ?>" value="<?php echo ($currentContent[$vo['table_name']]); ?>"/></th>
                            <th>
                                <?php if($vo["table_must"] == 1): ?>(必填)<?php endif; ?>
                            </th><?php break;?>

                        <?php case "textarea": ?><th><?php echo ($vo["table_realname"]); ?>:</th>
                            <th><textarea name="<?php echo ($vo["table_name"]); ?>"><?php echo ($currentContent[$vo['table_name']]); ?></textarea></th>
                            <th>
                                <?php if($vo["table_must"] == 1): ?>(必填)<?php endif; ?>
                            </th><?php break;?>

                        <!--todo-->
                        <?php case "a": ?><th><?php echo ($vo["table_realname"]); ?>:</th>
                            <th><a href=""></a><?php echo ($currentContent[$vo['table_other']]); ?></th>
                            <th>
                                <?php if($vo["table_must"] == 1): ?>(必填)<?php endif; ?>
                            </th><?php break;?>

                        <?php case "type": ?><th><?php echo ($vo["table_realname"]); ?>:</th>
                            <?php $tableName = $vo["table_name"]; ?>
                            <!--<?php $tb = $_GET['tb|getTableId']; ?>-->

                            <th><select name="<?php echo ($tableName); ?>">
                                <?php if(is_array($tempContent[$tableName])): $i = 0; $__LIST__ = $tempContent[$tableName];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$opt): $mod = ($i % 2 );++$i; $realFieldValuet = $relationMap[$tableName]; ?>

                                    <?php $realFieldValue = $realFieldValuet["real_field"]; ?>
                                    <?php $otherField = $realFieldValuet["other_field"]; ?>

                                    <?php if($currentContent[$tableName] == $opt[$otherField]): ?><option value="<?php echo ($opt["$otherField"]); ?>" selected="selected">
                                            <?php echo ($opt["$realFieldValue"]); ?>
                                        </option>
                                    <?php else: ?>
                                        <option value="<?php echo ($opt["$otherField"]); ?>">
                                            <?php echo ($opt["$realFieldValue"]); ?>
                                        </option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                            </select></th>
                            <th>
                                <?php if($vo["table_must"] == 1): ?>(必填)<?php endif; ?>
                            </th><?php break; endswitch; endif; ?>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </table>
                <br/>
                <input type="submit" name="submit" class="red_button button_float"/>
            </form>
        </div>

<div id="footer">
    <p>CopyRight © 2000-2008  校领导接待室  　All Rights Reserved.</p>
    <br/>
    <p>地址：重庆邮电大学内　邮编：400065　Tel:13650528112　E-mail:zhouchuan_cqupt@qq.com</p>
</div>
</div>
</div>
</div>
<script src="/backend/Public/js/jquery-1.11.1.js"></script>
<script src="/backend/Public/js/index.js"></script>
</body>
</html>