<?php /* Smarty version Smarty-3.1.14, created on 2013-08-13 07:37:47
         compiled from "D:\Program Files\wamp\www\genus\module\mainpage\template\index.html" */ ?>
<?php /*%%SmartyHeaderCode:67305209dc8f487ab8-53666086%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4083d50fda91a10cc295bb01377521ed019e6d18' => 
    array (
      0 => 'D:\\Program Files\\wamp\\www\\genus\\module\\mainpage\\template\\index.html',
      1 => 1376379051,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '67305209dc8f487ab8-53666086',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5209dc8f501bd8_26803076',
  'variables' => 
  array (
    'modulePath' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5209dc8f501bd8_26803076')) {function content_5209dc8f501bd8_26803076($_smarty_tpl) {?><!DOCTYPE html>
<html>
  <head>
    <meta charset="gb2312">
    <title>牛人网</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?php echo $_smarty_tpl->tpl_vars['modulePath']->value;?>
/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      font.a{ font-family : "Microsoft YaHei", Georgia, Serif } <!--调整字体-->
    </style>
    <link href="<?php echo $_smarty_tpl->tpl_vars['modulePath']->value;?>
/css/bootstrap-responsive.min.css" rel="stylesheet">

  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#"><font class="a" >牛人网</font></a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="mainpage.html"><font class="a" >个人首页</font></a></li>
              <li><a href="mainpage2.html"><font class="a" >个人主页</font></a></li>
              <li><a href="#"><font class="a" >好友</font></a></li>
              <!--<li><a href="#"><font class="a" >职业圈</font></a></li>-->
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><font class="a" >职业圈 </font><b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#"><font class="a" >华中科技大学</font></a></li>
                  <li><a href="#"><font class="a" >IT圈</font></a></li>
                  <li class="divider"></li>
                  <li><a href="#"><font class="a" >我管理的圈子</font></a></li>
                  <li><a href="#"><font class="a" >创建新圈子</font></a></li>
                </ul>
              </li>
              <li><a href="#"><font class="a" >谁是牛人</font></a></li>
              <!--<li><a href="#"><font class="a" >校园招聘</font></a></li>-->
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><font class="a" >校园招聘 </font><b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#"><font class="a" >找工作</font></a></li>
                  <li><a href="#"><font class="a" >找实习</font></a></li>
                  <li class="divider"></li>
                  <li><a href="#"><font class="a" >我的简历</font></a></li>
                  <li><a href="#"><font class="a" >简历投递反馈</font></a></li>
                </ul>
              </li>
              <li><a href="#"><font class="a" >公司</font></a></li>
              <li><a href="#"><font class="a" >问答</font></a></li>
              <li><a href="#"><font class="a" >推荐阅读</font></a></li>
            </ul>
            <ul class="nav pull-right">
                <li>
                  <a href="#"><font class="a" >通知</font></a>
                </li>
                <li>
                  <a href="#"><font class="a" >站内信</font></a>
                </li>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><font class="a" >个人设置 </font><b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#"><font class="a" >账号设置</font></a></li>
                  <li class="divider"></li>
                  <li><a href="http://localhost/genus/index.php/MainPage/logout"><font class="a" >退出</font></a></li>
                </ul>
                </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
      <div class="container-fluid"> 
        <div class="row-fluid">
          <div class="span1">
          </div>
          <div class="span8">
          <br/>

          <textarea id="state" class="input-block-level" rows="3" placeholder="你在干什么？（140字以内）"></textarea>
          <!--这里需要把用户输入的状态存到数据库中-->

            <div class="row-fluid">
              <div class="span4">
                <a href="#">表情&nbsp;&nbsp;</a>
                <a href="#">图片</a>
              </div>
              <div class="span6">
              </div>
              <div class="span2">
              <button class="btn btn-primary btn-block" type="button">发布</button>
              <!--点击发布按钮之后，将用户输入的状态存入数据库-->

              </div>
            </div>
            <br/>
            <br/>
            <ul class="nav nav-tabs">
              <li class="active"><a href="#">全部</a></li>
                <li><a href="#">好友</a></li>
                <li><a href="#">公司</a></li>
                <li><a href="#">职业圈</a></li>
                <li class="dropdown"> <a href="#" data-toggle="dropdown" class="dropdown-toggle">更多 <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">特别的好友</a></li>
                    <li><a href="#">青睐的公司</a></li>
                    <li><a href="#">喜爱的职业圈</a></li>
                    <li class="divider"></li>
                    <li><a href="#">刷新</a></li>
                  </ul>
              </li>
            </ul>
            <div class="row-fluid">
              <div class="span12">
                  <hr/>
                    <div class="row-fluid">
                      <div class="span2">

                      <!--这里需要读出公司的招聘信息，包括公司的头像、名称、发布的内容（可能包含链接）和发布时间，我这下面是举得例子-->
                        <img width="50" height="50" src="http://hdn.xnimg.cn/photos/hdn321/20130731/2210/tiny_URfQ_f91b0005e5b8111a.jpg"/>
                      </div>
                      <div class="span2">
                        <br/>
                        <font style="font-size:14px">微软：</font>
                      </div>
                      <div class="span4">
                        <br/>
                        <font style="font-size:14px">我发布了一条新的招聘信息，详细请进<a href="#">url</a></font>
                      </div>
                      <div class="span2">
                        <br/>
                        <font style="font-size:14px">08/09/2013</font>
                      </div>
                      <div class="span2">
                        <br/>
                        <a href="#"><font style="font-size:14px">删除</font></a>
                      </div>
                    </div>
                <hr/>
                <div class="row-fluid">
                  <div class="span12">
                    <div class="row-fluid">
                      <div class="span2">

                        <!--这里需要读出用户发布的状态信息，包括头像、姓名、状态内容和时间-->
                        <!--这里需要读出回复用户发布的状态信息，包括头像、姓名、状态内容和时间-->
                        <!--下面是举得例子-->
                        <img width="50" height="50" src="http://hdn.xnimg.cn/photos/hdn321/20130731/2210/tiny_URfQ_f91b0005e5b8111a.jpg"/>
                        <br/>
                        <img width="30" height="30" src="http://hdn.xnimg.cn/photos/hdn121/20130806/2240/h_tiny_mMAp_4b14000000e0111a.jpg"/>
                      </div>
                      <br/>
                      <div class="span2">
                        <font style="font-size:14px">张三：</font>
                        <br/>
                        <br/>
                        <font style="font-size:12px">李四回复张三：</font>
                      </div>
                      <div class="span4">
                        <font style="font-size:14px">我是中国人。</font>
                        <br/>
                        <br/>
                        <font style="font-size:12px">我也是中国人。</font>
                      </div>
                      <div class="span2">
                        <font style="font-size:14px">08/09/2013</font>
                        <br/>
                        <br/>
                        <font style="font-size:12px">08/09/2013</font>
                      </div>
                      <div class="span2">
                        <a href="#"><font style="font-size:14px">删除</font></a>
                        <br/>
                        <br/>
                        <a href="#"><font style="font-size:12px">删除</font></a>
                      </div>
                      <hr/>
                      <p>&nbsp;</p>
                      <textarea id="reply" class="input-block-level" rows="3" placeholder="添加回复"></textarea>
                        <div class="row-fluid">
                          <div class="span2">
                            <label class="checkbox">
                              <input type="checkbox"> 是否分享
                            </label>
                          </div>
                          <div class="span8">
                          </div>
                          <div class="span2">
                            <button class="btn btn-primary btn-block" type="button">发布</button>
                            <!--这里需要将用户的回复存入数据库，然后在上面显示出来-->

                          </div>
                        </div>
                    </div>
                  </div>
                </div><!--这是单个动态板块的末尾-->
                <br/>
                <div class="row-fluid">
                  <div class="span12">

                    <div class="row-fluid">
                      <div class="span2">

                        <!--这里与上相同-->
                        <img width="50" height="50" src="http://hdn.xnimg.cn/photos/hdn321/20130731/2210/tiny_URfQ_f91b0005e5b8111a.jpg"/>
                        <br/>
                        <img width="30" height="30" src="http://hdn.xnimg.cn/photos/hdn121/20130806/2240/h_tiny_mMAp_4b14000000e0111a.jpg"/>
                      </div>
                      <br/>
                      <div class="span2">
                        <font style="font-size:14px">张三：</font>
                        <br/>
                        <br/>
                        <font style="font-size:12px">李四回复张三：</font>
                      </div>
                      <div class="span4">
                        <font style="font-size:14px">我是中国人。</font>
                        <br/>
                        <br/>
                        <font style="font-size:12px">我也是中国人。</font>
                      </div>
                      <div class="span2">
                        <font style="font-size:14px">08/09/2013</font>
                        <br/>
                        <br/>
                        <font style="font-size:12px">08/09/2013</font>
                      </div>
                      <div class="span2">
                        <a href="#"><font style="font-size:14px">删除</font></a>
                        <br/>
                        <br/>
                        <a href="#"><font style="font-size:12px">删除</font></a>
                      </div>
                      <p>&nbsp;</p>
                      <textarea id="reply" class="input-block-level" rows="3" placeholder="添加回复"></textarea>
                        <div class="row-fluid">
                          <div class="span2">
                            <label class="checkbox">
                              <input type="checkbox"> 是否分享
                            </label>
                          </div>
                          <div class="span8">
                          </div>
                          <div class="span2">

                            <button class="btn btn-primary btn-block" type="button">发布</button>  
                            <!--这里需要将用户的回复存入数据库，然后在上面显示出来--> 
                            
                          </div>
                        </div>
                    </div>
                  </div>
                </div><!--这是单个动态板块的末尾-->
                <br/>
                <button class="btn btn-large btn-block btn-primary" type="button">查看更多动态</button> 
              </div>
            </div><!--这是个人动态板块的末尾-->
          </div><!--这里是span8结束的地方-->
          <div class="span2">
            <table frame="box">

            <!--读出最近访问该用户的个人或公司的头像链接-->
            <caption>最近来访&nbsp;(2000)&nbsp;<a href="#">&nbsp;&nbsp;更多</a></caption>
            <tr>
              <td><a href="#"><img width="50" height="50" src="http://hdn.xnimg.cn/photos/hdn321/20130731/2210/tiny_URfQ_f91b0005e5b8111a.jpg"/></a></td>
              <td><a href="#"><img width="50" height="50" src="http://hdn.xnimg.cn/photos/hdn321/20130731/2210/tiny_URfQ_f91b0005e5b8111a.jpg"/></a></td>
              <td><a href="#"><img width="50" height="50" src="http://hdn.xnimg.cn/photos/hdn321/20130731/2210/tiny_URfQ_f91b0005e5b8111a.jpg"/></a></td>
            </tr>
            <tr>
              <td><a href="#"><img width="50" height="50" src="http://hdn.xnimg.cn/photos/hdn321/20130731/2210/tiny_URfQ_f91b0005e5b8111a.jpg"/></a></td>
              <td><a href="#"><img width="50" height="50" src="http://hdn.xnimg.cn/photos/hdn321/20130731/2210/tiny_URfQ_f91b0005e5b8111a.jpg"/></a></td>
              <td><a href="#"><img width="50" height="50" src="http://hdn.xnimg.cn/photos/hdn321/20130731/2210/tiny_URfQ_f91b0005e5b8111a.jpg"/></a></td>
            </tr>
            <tr>
              <td><a href="#"><img width="50" height="50" src="http://hdn.xnimg.cn/photos/hdn321/20130731/2210/tiny_URfQ_f91b0005e5b8111a.jpg"/></a></td>
              <td><a href="#"><img width="50" height="50" src="http://hdn.xnimg.cn/photos/hdn321/20130731/2210/tiny_URfQ_f91b0005e5b8111a.jpg"/></a></td>
              <td><a href="#"><img width="50" height="50" src="http://hdn.xnimg.cn/photos/hdn321/20130731/2210/tiny_URfQ_f91b0005e5b8111a.jpg"/></a></td>
            </tr>
            </table>
            <br/>
            <table frame="box">

            <!--读出向该用户进行推荐的个人的头像链接，下面的以此类推-->
            <caption>好友推荐&nbsp;(2000)&nbsp;<a href="#">&nbsp;&nbsp;更多</a></caption>
            <tr>
              <td><a href="#"><img width="50" height="50" src="http://hdn.xnimg.cn/photos/hdn321/20130731/2210/tiny_URfQ_f91b0005e5b8111a.jpg"/></a></td>
              <td><a href="#"><img width="50" height="50" src="http://hdn.xnimg.cn/photos/hdn321/20130731/2210/tiny_URfQ_f91b0005e5b8111a.jpg"/></a></td>
              <td><a href="#"><img width="50" height="50" src="http://hdn.xnimg.cn/photos/hdn321/20130731/2210/tiny_URfQ_f91b0005e5b8111a.jpg"/></a></td>
            </tr>
            <tr>
              <td><a href="#"><img width="50" height="50" src="http://hdn.xnimg.cn/photos/hdn321/20130731/2210/tiny_URfQ_f91b0005e5b8111a.jpg"/></a></td>
              <td><a href="#"><img width="50" height="50" src="http://hdn.xnimg.cn/photos/hdn321/20130731/2210/tiny_URfQ_f91b0005e5b8111a.jpg"/></a></td>
              <td><a href="#"><img width="50" height="50" src="http://hdn.xnimg.cn/photos/hdn321/20130731/2210/tiny_URfQ_f91b0005e5b8111a.jpg"/></a></td>
            </tr>
            </table>
            <br/>
            <table frame="box">
            <caption>公司推荐&nbsp;(2000)&nbsp;<a href="#">&nbsp;&nbsp;更多</a></caption>
            <tr>
              <td><a href="#"><img width="50" height="50" src="http://hdn.xnimg.cn/photos/hdn321/20130731/2210/tiny_URfQ_f91b0005e5b8111a.jpg"/></a></td>
              <td><a href="#"><img width="50" height="50" src="http://hdn.xnimg.cn/photos/hdn321/20130731/2210/tiny_URfQ_f91b0005e5b8111a.jpg"/></a></td>
              <td><a href="#"><img width="50" height="50" src="http://hdn.xnimg.cn/photos/hdn321/20130731/2210/tiny_URfQ_f91b0005e5b8111a.jpg"/></a></td>
            </tr>
            <tr>
              <td><a href="#"><img width="50" height="50" src="http://hdn.xnimg.cn/photos/hdn321/20130731/2210/tiny_URfQ_f91b0005e5b8111a.jpg"/></a></td>
              <td><a href="#"><img width="50" height="50" src="http://hdn.xnimg.cn/photos/hdn321/20130731/2210/tiny_URfQ_f91b0005e5b8111a.jpg"/></a></td>
              <td><a href="#"><img width="50" height="50" src="http://hdn.xnimg.cn/photos/hdn321/20130731/2210/tiny_URfQ_f91b0005e5b8111a.jpg"/></a></td>
            </tr>
            </table>
            <br/>
            <table frame="box">
            <caption>职业圈推荐&nbsp;(2000)&nbsp;<a href="#">&nbsp;&nbsp;更多</a></caption>
            <tr>
              <td><a href="#"><img width="50" height="50" src="http://hdn.xnimg.cn/photos/hdn321/20130731/2210/tiny_URfQ_f91b0005e5b8111a.jpg"/></a></td>
              <td><a href="#"><img width="50" height="50" src="http://hdn.xnimg.cn/photos/hdn321/20130731/2210/tiny_URfQ_f91b0005e5b8111a.jpg"/></a></td>
              <td><a href="#"><img width="50" height="50" src="http://hdn.xnimg.cn/photos/hdn321/20130731/2210/tiny_URfQ_f91b0005e5b8111a.jpg"/></a></td>
            </tr>
            <tr>
              <td><a href="#"><img width="50" height="50" src="http://hdn.xnimg.cn/photos/hdn321/20130731/2210/tiny_URfQ_f91b0005e5b8111a.jpg"/></a></td>
              <td><a href="#"><img width="50" height="50" src="http://hdn.xnimg.cn/photos/hdn321/20130731/2210/tiny_URfQ_f91b0005e5b8111a.jpg"/></a></td>
              <td><a href="#"><img width="50" height="50" src="http://hdn.xnimg.cn/photos/hdn321/20130731/2210/tiny_URfQ_f91b0005e5b8111a.jpg"/></a></td>
            </tr>
            </table>
            <br/>

            <!--读出向该用户推荐的项目信息，包括项目名称和链接，下同-->
            <p>最新项目推荐&nbsp;&nbsp;<a href="#">&nbsp;&nbsp;全部</a></p>
            <ol>
              <li><a href="#">四个现代化</a></li>
              <li><a href="#">四个现代化</a></li>
              <li><a href="#">四个现代化</a></li>
            </ol>
            <br/>
            <p>最新招聘信息&nbsp;&nbsp;<a href="#">&nbsp;&nbsp;全部</a></p>
            <ol>
              <li><a href="#">四个现代化</a></li>
              <li><a href="#">四个现代化</a></li>
              <li><a href="#">四个现代化</a></li>
            </ol>
          </div>
          <div class="span1">
          </div>
        </div>
      </div>
    </div>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['modulePath']->value;?>
/js/bootstrap.min.js"></script>

  </body>
</html><?php }} ?>