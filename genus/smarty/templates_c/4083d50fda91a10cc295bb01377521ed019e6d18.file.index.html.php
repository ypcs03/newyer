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
    <title>ţ����</title>
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
      font.a{ font-family : "Microsoft YaHei", Georgia, Serif } <!--��������-->
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
          <a class="brand" href="#"><font class="a" >ţ����</font></a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="mainpage.html"><font class="a" >������ҳ</font></a></li>
              <li><a href="mainpage2.html"><font class="a" >������ҳ</font></a></li>
              <li><a href="#"><font class="a" >����</font></a></li>
              <!--<li><a href="#"><font class="a" >ְҵȦ</font></a></li>-->
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><font class="a" >ְҵȦ </font><b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#"><font class="a" >���пƼ���ѧ</font></a></li>
                  <li><a href="#"><font class="a" >ITȦ</font></a></li>
                  <li class="divider"></li>
                  <li><a href="#"><font class="a" >�ҹ����Ȧ��</font></a></li>
                  <li><a href="#"><font class="a" >������Ȧ��</font></a></li>
                </ul>
              </li>
              <li><a href="#"><font class="a" >˭��ţ��</font></a></li>
              <!--<li><a href="#"><font class="a" >У԰��Ƹ</font></a></li>-->
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><font class="a" >У԰��Ƹ </font><b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#"><font class="a" >�ҹ���</font></a></li>
                  <li><a href="#"><font class="a" >��ʵϰ</font></a></li>
                  <li class="divider"></li>
                  <li><a href="#"><font class="a" >�ҵļ���</font></a></li>
                  <li><a href="#"><font class="a" >����Ͷ�ݷ���</font></a></li>
                </ul>
              </li>
              <li><a href="#"><font class="a" >��˾</font></a></li>
              <li><a href="#"><font class="a" >�ʴ�</font></a></li>
              <li><a href="#"><font class="a" >�Ƽ��Ķ�</font></a></li>
            </ul>
            <ul class="nav pull-right">
                <li>
                  <a href="#"><font class="a" >֪ͨ</font></a>
                </li>
                <li>
                  <a href="#"><font class="a" >վ����</font></a>
                </li>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><font class="a" >�������� </font><b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#"><font class="a" >�˺�����</font></a></li>
                  <li class="divider"></li>
                  <li><a href="http://localhost/genus/index.php/MainPage/logout"><font class="a" >�˳�</font></a></li>
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

          <textarea id="state" class="input-block-level" rows="3" placeholder="���ڸ�ʲô����140�����ڣ�"></textarea>
          <!--������Ҫ���û������״̬�浽���ݿ���-->

            <div class="row-fluid">
              <div class="span4">
                <a href="#">����&nbsp;&nbsp;</a>
                <a href="#">ͼƬ</a>
              </div>
              <div class="span6">
              </div>
              <div class="span2">
              <button class="btn btn-primary btn-block" type="button">����</button>
              <!--���������ť֮�󣬽��û������״̬�������ݿ�-->

              </div>
            </div>
            <br/>
            <br/>
            <ul class="nav nav-tabs">
              <li class="active"><a href="#">ȫ��</a></li>
                <li><a href="#">����</a></li>
                <li><a href="#">��˾</a></li>
                <li><a href="#">ְҵȦ</a></li>
                <li class="dropdown"> <a href="#" data-toggle="dropdown" class="dropdown-toggle">���� <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">�ر�ĺ���</a></li>
                    <li><a href="#">�����Ĺ�˾</a></li>
                    <li><a href="#">ϲ����ְҵȦ</a></li>
                    <li class="divider"></li>
                    <li><a href="#">ˢ��</a></li>
                  </ul>
              </li>
            </ul>
            <div class="row-fluid">
              <div class="span12">
                  <hr/>
                    <div class="row-fluid">
                      <div class="span2">

                      <!--������Ҫ������˾����Ƹ��Ϣ��������˾��ͷ�����ơ����������ݣ����ܰ������ӣ��ͷ���ʱ�䣬���������Ǿٵ�����-->
                        <img width="50" height="50" src="http://hdn.xnimg.cn/photos/hdn321/20130731/2210/tiny_URfQ_f91b0005e5b8111a.jpg"/>
                      </div>
                      <div class="span2">
                        <br/>
                        <font style="font-size:14px">΢��</font>
                      </div>
                      <div class="span4">
                        <br/>
                        <font style="font-size:14px">�ҷ�����һ���µ���Ƹ��Ϣ����ϸ���<a href="#">url</a></font>
                      </div>
                      <div class="span2">
                        <br/>
                        <font style="font-size:14px">08/09/2013</font>
                      </div>
                      <div class="span2">
                        <br/>
                        <a href="#"><font style="font-size:14px">ɾ��</font></a>
                      </div>
                    </div>
                <hr/>
                <div class="row-fluid">
                  <div class="span12">
                    <div class="row-fluid">
                      <div class="span2">

                        <!--������Ҫ�����û�������״̬��Ϣ������ͷ��������״̬���ݺ�ʱ��-->
                        <!--������Ҫ�����ظ��û�������״̬��Ϣ������ͷ��������״̬���ݺ�ʱ��-->
                        <!--�����Ǿٵ�����-->
                        <img width="50" height="50" src="http://hdn.xnimg.cn/photos/hdn321/20130731/2210/tiny_URfQ_f91b0005e5b8111a.jpg"/>
                        <br/>
                        <img width="30" height="30" src="http://hdn.xnimg.cn/photos/hdn121/20130806/2240/h_tiny_mMAp_4b14000000e0111a.jpg"/>
                      </div>
                      <br/>
                      <div class="span2">
                        <font style="font-size:14px">������</font>
                        <br/>
                        <br/>
                        <font style="font-size:12px">���Ļظ�������</font>
                      </div>
                      <div class="span4">
                        <font style="font-size:14px">�����й��ˡ�</font>
                        <br/>
                        <br/>
                        <font style="font-size:12px">��Ҳ���й��ˡ�</font>
                      </div>
                      <div class="span2">
                        <font style="font-size:14px">08/09/2013</font>
                        <br/>
                        <br/>
                        <font style="font-size:12px">08/09/2013</font>
                      </div>
                      <div class="span2">
                        <a href="#"><font style="font-size:14px">ɾ��</font></a>
                        <br/>
                        <br/>
                        <a href="#"><font style="font-size:12px">ɾ��</font></a>
                      </div>
                      <hr/>
                      <p>&nbsp;</p>
                      <textarea id="reply" class="input-block-level" rows="3" placeholder="��ӻظ�"></textarea>
                        <div class="row-fluid">
                          <div class="span2">
                            <label class="checkbox">
                              <input type="checkbox"> �Ƿ����
                            </label>
                          </div>
                          <div class="span8">
                          </div>
                          <div class="span2">
                            <button class="btn btn-primary btn-block" type="button">����</button>
                            <!--������Ҫ���û��Ļظ��������ݿ⣬Ȼ����������ʾ����-->

                          </div>
                        </div>
                    </div>
                  </div>
                </div><!--���ǵ�����̬����ĩβ-->
                <br/>
                <div class="row-fluid">
                  <div class="span12">

                    <div class="row-fluid">
                      <div class="span2">

                        <!--����������ͬ-->
                        <img width="50" height="50" src="http://hdn.xnimg.cn/photos/hdn321/20130731/2210/tiny_URfQ_f91b0005e5b8111a.jpg"/>
                        <br/>
                        <img width="30" height="30" src="http://hdn.xnimg.cn/photos/hdn121/20130806/2240/h_tiny_mMAp_4b14000000e0111a.jpg"/>
                      </div>
                      <br/>
                      <div class="span2">
                        <font style="font-size:14px">������</font>
                        <br/>
                        <br/>
                        <font style="font-size:12px">���Ļظ�������</font>
                      </div>
                      <div class="span4">
                        <font style="font-size:14px">�����й��ˡ�</font>
                        <br/>
                        <br/>
                        <font style="font-size:12px">��Ҳ���й��ˡ�</font>
                      </div>
                      <div class="span2">
                        <font style="font-size:14px">08/09/2013</font>
                        <br/>
                        <br/>
                        <font style="font-size:12px">08/09/2013</font>
                      </div>
                      <div class="span2">
                        <a href="#"><font style="font-size:14px">ɾ��</font></a>
                        <br/>
                        <br/>
                        <a href="#"><font style="font-size:12px">ɾ��</font></a>
                      </div>
                      <p>&nbsp;</p>
                      <textarea id="reply" class="input-block-level" rows="3" placeholder="��ӻظ�"></textarea>
                        <div class="row-fluid">
                          <div class="span2">
                            <label class="checkbox">
                              <input type="checkbox"> �Ƿ����
                            </label>
                          </div>
                          <div class="span8">
                          </div>
                          <div class="span2">

                            <button class="btn btn-primary btn-block" type="button">����</button>  
                            <!--������Ҫ���û��Ļظ��������ݿ⣬Ȼ����������ʾ����--> 
                            
                          </div>
                        </div>
                    </div>
                  </div>
                </div><!--���ǵ�����̬����ĩβ-->
                <br/>
                <button class="btn btn-large btn-block btn-primary" type="button">�鿴���ද̬</button> 
              </div>
            </div><!--���Ǹ��˶�̬����ĩβ-->
          </div><!--������span8�����ĵط�-->
          <div class="span2">
            <table frame="box">

            <!--����������ʸ��û��ĸ��˻�˾��ͷ������-->
            <caption>�������&nbsp;(2000)&nbsp;<a href="#">&nbsp;&nbsp;����</a></caption>
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

            <!--��������û������Ƽ��ĸ��˵�ͷ�����ӣ�������Դ�����-->
            <caption>�����Ƽ�&nbsp;(2000)&nbsp;<a href="#">&nbsp;&nbsp;����</a></caption>
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
            <caption>��˾�Ƽ�&nbsp;(2000)&nbsp;<a href="#">&nbsp;&nbsp;����</a></caption>
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
            <caption>ְҵȦ�Ƽ�&nbsp;(2000)&nbsp;<a href="#">&nbsp;&nbsp;����</a></caption>
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

            <!--��������û��Ƽ�����Ŀ��Ϣ��������Ŀ���ƺ����ӣ���ͬ-->
            <p>������Ŀ�Ƽ�&nbsp;&nbsp;<a href="#">&nbsp;&nbsp;ȫ��</a></p>
            <ol>
              <li><a href="#">�ĸ��ִ���</a></li>
              <li><a href="#">�ĸ��ִ���</a></li>
              <li><a href="#">�ĸ��ִ���</a></li>
            </ol>
            <br/>
            <p>������Ƹ��Ϣ&nbsp;&nbsp;<a href="#">&nbsp;&nbsp;ȫ��</a></p>
            <ol>
              <li><a href="#">�ĸ��ִ���</a></li>
              <li><a href="#">�ĸ��ִ���</a></li>
              <li><a href="#">�ĸ��ִ���</a></li>
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