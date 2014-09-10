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
                <a class="inside" href="<?php echo ($addUrl); ?>"><h1>添加内容</h1></a>
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <?php if(is_array($tableList)): $i = 0; $__LIST__ = $tableList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><th><?php echo ($vo["table_realname"]); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
                        <th>编辑</th>
                        <th>删除</th>
                    </tr>
                    <?php if(is_array($contentList)): $keys = 0; $__LIST__ = $contentList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($keys % 2 );++$keys;?><tr>
                            <?php if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$td): $mod = ($i % 2 );++$i;?><td><?php echo ($td['value']); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
                            <td><a href="<?php echo ($editUrl); ?>&id=<?php echo ($vo[0]["id"]); ?>">编辑</a></td>
                            <td><a href="<?php echo ($delUrl); ?>&id=<?php echo ($vo[0]["id"]); ?>">删除</a></td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </table>
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