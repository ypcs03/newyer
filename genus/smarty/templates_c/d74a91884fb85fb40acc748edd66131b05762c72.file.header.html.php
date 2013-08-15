<?php /* Smarty version Smarty-3.1.14, created on 2013-08-12 08:51:20
         compiled from "D:\Program Files\wamp\www\genus\module\mainpage\template\header.html" */ ?>
<?php /*%%SmartyHeaderCode:40265208a2080b71b6-89500408%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd74a91884fb85fb40acc748edd66131b05762c72' => 
    array (
      0 => 'D:\\Program Files\\wamp\\www\\genus\\module\\mainpage\\template\\header.html',
      1 => 1375760626,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '40265208a2080b71b6-89500408',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'mainLink' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5208a2080f4247_96878686',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5208a2080f4247_96878686')) {function content_5208a2080f4247_96878686($_smarty_tpl) {?><div id="header" class="row">
	<div class="navbar navbar-inverse">
		<div class="navbar-inner">
			<div class="container-fluid">
				 <a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a> <a href="#" class="brand">QA System</a>
				<div class="nav-collapse collapse navbar-responsive-collapse">
					<ul class="nav">
						<li class="active">
							<a href="<?php echo $_smarty_tpl->tpl_vars['mainLink']->value;?>
">主页</a>
						</li>
						<li>
							<a href="#">bug页面</a>
						</li>
						<li class="dropdown">
							 <a data-toggle="dropdown" class="dropdown-toggle" href="#">下拉菜单<strong class="caret"></strong></a>
							<ul class="dropdown-menu">
								<li>
									<a href="#">下拉导航1</a>
								</li>
								<li>
									<a href="#">下拉导航2</a>
								</li>
								<li>
									<a href="#">其他</a>
								</li>
								<li class="divider">
								</li>
								<li class="nav-header">
									标签
								</li>
								<li>
									<a href="#">链接1</a>
								</li>
								<li>
									<a href="#">链接2</a>
								</li>
							</ul>
						</li>
					</ul>
					<ul class="nav pull-right">
						<li>
							 <a id="login_btn" href="#login_box" role="button"  data-toggle="modal">登录</a>					
						</li>
						<li class="divider-vertical">
						</li>
						<li class="dropdown">
							 <a id="register_btn" href="#register_box" role="button" data-toggle="modal" >注册</a>
						</li>
					</ul>
				</div>
				
			</div>
		</div>
		
	</div>
</div><?php }} ?>