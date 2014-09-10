<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
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
                <div id="info" class="inside">
                    <div class="info_in">
                        <h1>系统说明<span></span></h1>
                        <div>
                            <p>当前版本 V2.0  该后台管理系统供校领导接待室使用！</p>
                            <p>若有任何疑问，请联系 zhouchuan_cqupt@qq.com</p>
                        </div>
                    </div>
                    <div class="info_in">
                        <h1>系统信息<span></span></h1>
                        <div>
                            <p>PHP程式版本：5.3.3</p>
                            <p>MYSQL 版本：5.1.50-community</p>
                            <p>服务器端信息: Apache </p>
                            <p>最大上传限制：30M</p>
                            <p>最大执行时间：300 seconds</p>
                            <p>服务器所在时间：2014-08-29 11:05</p>
                        </div>
                    </div>
                    <div class="info_in">
                        <h1>开发团队<span></span></h1>
                        <div>
                            <p>系统开发： 重庆邮电大学红岩网校工作站</p>
                        </div>
                    </div>
                    <div class="info_in">
                        <h1>个人信息<span></span></h1>
                        <div>
                            <p>您上次登录时间：    2014-08-28</p>
                            <p>您上次登录IP：      127.0.0.1</p>
                        </div>
                    </div>
                </div>
                <div id="topic" class="inside">
                    <h1>主题管理</h1>
                    <table id="topic" cellpadding="0" cellspacing="0">
                        <tr>
                            <th>时间</th>
                            <th>主题标题</th>
                            <th>主题内容</th>
                            <th>编辑</th>
                            <th>删除</th>
                        </tr>
                        <tr>
                            <td>2013-04-25</td>
                            <td>学校中心工作</td>
                            <td>请广大师生围绕学校中心工作，结合自
                                身学习、工作、生活等实际情况，以及
                                所关心的其他热点问题与校领导进行交
                                流。</td>
                            <td>编辑</td>
                            <td>删除</td>
                        </tr>
                        <tr>
                            <td>2013-04-25</td>
                            <td>学校中心工作</td>
                            <td>请广大师生围绕学校中心工作，结合自
                                身学习、工作、生活等实际情况，以及
                                所关心的其他热点问题与校领导进行交
                                流。</td>
                            <td>编辑</td>
                            <td>删除</td>
                        </tr>
                    </table>
                    <ul class="flip">
                        <li class="page_up"><a href="#">上一页</a></li>
                        <ul>
                            <li class="flip_on"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                        </ul>
                        <li class="page_down"><a href="#">下一页</a></li>
                    </ul>
                </div>
                <div id="add_topic" class="inside">
                    <h1>主题添加</h1>

                    <form action="">
                        <span>标题</span>
                        <input type="text" name="head" id="head"/>
                        <textarea name="" id="" cols="62" rows="8"></textarea>
                        <div class="float">
                            <input type="submit" name="submit" value="提交" class="submits" id="submit"/>
                            <input type="submit" name="reset" value="重置" class="submits" id="reset"/>
                        </div>
                    </form>
                </div>
                <div id="monitor" class="inside">
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <th class="m_name">用户名</th>
                            <th class="m_time">时间</th>
                            <th class="m_content">内容</th>
                            <th class="m_sort">类别</th>
                            <th class="m_write">编辑</th>
                            <th class="m_read">审核</th>
                            <th class="m_delete">删除</th>
                        </tr>
                        <tr>
                            <td>愤怒的猫</td>
                            <td>18:08:44</td>
                            <td class="m_content"><p>对杜惠平的提问:</p>
                                本人是软件工程暑期实训学员，实训老师做事太没人性，想投诉
                                因为我们学生本身技术实力有好有坏，所以做出的质量不一样。
                                今天实训老师对一个同学说：“你不做出来，你今天晚上饭就不
                                用吃了”。做什么事身体最重要，他应该没权利限制别人吃饭吧
                                跟他提议了，他还很不满的说：“一顿不吃对他有</td>
                            <td>本科教学</td>
                            <td><span>编辑</span></td>
                            <td><span>审核</span></td>
                            <td><span>删除</span></td>
                        </tr>
                    </table>
                    <ul class="flip">
                        <li class="page_up"><a href="#">上一页</a></li>
                        <ul>
                            <li class="flip_on"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                        </ul>
                        <li class="page_down"><a href="#">下一页</a></li>
                    </ul>
                </div>
                <div id="chat_history" class="inside">
                    <div class="chat_bg">
                        <form action="">
                            <select name="page" id="page">
                                <option value="1">选择日期</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                            <input type="submit" value="确定"/>
                        </form>
                        <div class="chats">
                            <p>[为己重生]<span>2014-08-26 15:28:25</span> 对[杜惠平]说:   [未回复]</p>
                            <p>  在么</p>
                        </div>
                    </div>
                    <ul class="flip">
                        <li class="page_up"><a href="#">上一页</a></li>
                        <ul>
                            <li class="flip_on"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                        </ul>
                        <li class="page_down"><a href="#">下一页</a></li>
                    </ul>
                </div>
                <div id="category" class="inside">
                    <div class="chat_bg">
                        <form action="">
                            <input type="text" class="text" placeholder="类别" value="类别"/>
                            <div class="float">
                                <input type="submit" name="submit" value="提交" class="submits" id="submit"/>
                                <input type="submit" name="reset" value="重置" class="submits" id="reset"/>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="Management" class="inside">
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <th class="mg_id">ID</th>
                            <th class="mg_sort">类别名称</th>
                            <th class="mg_write">编辑</th>
                            <th class="mg_delete">删除</th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>学校行政全面工作</td>
                            <td>编辑</td>
                            <td>删除</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>学校行政全面工作</td>
                            <td>编辑</td>
                            <td>删除</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>学校行政全面工作</td>
                            <td>编辑</td>
                            <td>删除</td>
                        </tr>
                    </table>
                    <ul class="flip">
                        <li class="page_up"><a href="#">上一页</a></li>
                        <ul>
                            <li class="flip_on"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                        </ul>
                        <li class="page_down"><a href="#">下一页</a></li>
                    </ul>
                </div>
                <div id="add_leader" class="inside">
                    <form action="">
                        <select name="page" id="page">
                            <option value="1">类别</option>
                            <option value="2">类别1</option>
                            <option value="3">类别2</option>
                        </select>
                        <select name="page" id="page">
                            <option value="1">选择相关领导</option>
                            <option value="2">类别1</option>
                            <option value="3">类别2</option>
                        </select>
                        <div class="float">
                            <input type="submit" name="submit" value="提交" class="submits" id="submit"/>
                            <input type="submit" name="reset" value="重置" class="submits" id="reset"/>
                        </div>
                    </form>
                </div>
                <div id="add_input" class="inside">
                    <form action="">
                        <input type="text" class="text" value="领导姓名"/>
                        <input type="text" class="text" value="领导登陆密码"/>
                        <div class="float">
                            <input type="submit" name="submit" value="提交" class="submits" id="submit"/>
                            <input type="submit" name="reset" value="重置" class="submits" id="reset"/>
                        </div>
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