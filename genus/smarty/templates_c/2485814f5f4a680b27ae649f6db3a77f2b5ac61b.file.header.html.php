<?php /* Smarty version Smarty-3.1.14, created on 2013-08-12 01:21:09
         compiled from "D:\Program Files\wamp\www\genus\module\MainPage\template\header.html" */ ?>
<?php /*%%SmartyHeaderCode:1576652083885ec82e6-08427135%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2485814f5f4a680b27ae649f6db3a77f2b5ac61b' => 
    array (
      0 => 'D:\\Program Files\\wamp\\www\\genus\\module\\MainPage\\template\\header.html',
      1 => 1375760626,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1576652083885ec82e6-08427135',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'mainLink' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5208388603d095_70475375',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5208388603d095_70475375')) {function content_5208388603d095_70475375($_smarty_tpl) {?><div id="header" class="row">
	<div class="navbar navbar-inverse">
		<div class="navbar-inner">
			<div class="container-fluid">
				 <a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a> <a href="#" class="brand">QA System</a>
				<div class="nav-collapse collapse navbar-responsive-collapse">
					<ul class="nav">
						<li class="active">
							<a href="<?php echo $_smarty_tpl->tpl_vars['mainLink']->value;?>
">��ҳ</a>
						</li>
						<li>
							<a href="#">bugҳ��</a>
						</li>
						<li class="dropdown">
							 <a data-toggle="dropdown" class="dropdown-toggle" href="#">�����˵�<strong class="caret"></strong></a>
							<ul class="dropdown-menu">
								<li>
									<a href="#">��������1</a>
								</li>
								<li>
									<a href="#">��������2</a>
								</li>
								<li>
									<a href="#">����</a>
								</li>
								<li class="divider">
								</li>
								<li class="nav-header">
									��ǩ
								</li>
								<li>
									<a href="#">����1</a>
								</li>
								<li>
									<a href="#">����2</a>
								</li>
							</ul>
						</li>
					</ul>
					<ul class="nav pull-right">
						<li>
							 <a id="login_btn" href="#login_box" role="button"  data-toggle="modal">��¼</a>					
						</li>
						<li class="divider-vertical">
						</li>
						<li class="dropdown">
							 <a id="register_btn" href="#register_box" role="button" data-toggle="modal" >ע��</a>
						</li>
					</ul>
				</div>
				
			</div>
		</div>
		
	</div>
</div><?php }} ?>