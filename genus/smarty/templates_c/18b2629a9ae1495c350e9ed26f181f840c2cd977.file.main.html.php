<?php /* Smarty version Smarty-3.1.14, created on 2013-08-12 09:01:37
         compiled from "D:\Program Files\wamp\www\genus\module\mainpage\template\main.html" */ ?>
<?php /*%%SmartyHeaderCode:97995208a4715f5e19-97908337%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '18b2629a9ae1495c350e9ed26f181f840c2cd977' => 
    array (
      0 => 'D:\\Program Files\\wamp\\www\\genus\\module\\mainpage\\template\\main.html',
      1 => 1375933856,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '97995208a4715f5e19-97908337',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'modulePath' => 0,
    'tplHeader' => 0,
    'tplProjectList' => 0,
    'tplProjectBugList' => 0,
    'tplFooter' => 0,
    'tplPopup' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5208a47166ff31_14196205',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5208a47166ff31_14196205')) {function content_5208a47166ff31_14196205($_smarty_tpl) {?><!DOCTYPE html>
<html>
 <head>
	<meta charset="gb2312">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
	<title>QA System</title>

	<!-- Le styles -->
    <link href="<?php echo $_smarty_tpl->tpl_vars['modulePath']->value;?>
/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <style type="text/css">
      body {
        padding:0;
      }
    </style>
    <link href="<?php echo $_smarty_tpl->tpl_vars['modulePath']->value;?>
/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css">

    
 </head>

 <body>
 <div class="container">
	<?php echo $_smarty_tpl->tpl_vars['tplHeader']->value;?>

	<div class="view">
		<div class="row-fluid clearfix">
			<?php echo $_smarty_tpl->tpl_vars['tplProjectList']->value;?>

			<?php echo $_smarty_tpl->tpl_vars['tplProjectBugList']->value;?>

		</div>
	</div>
	<?php echo $_smarty_tpl->tpl_vars['tplFooter']->value;?>

</div>
<?php echo $_smarty_tpl->tpl_vars['tplPopup']->value;?>

 	
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	
	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <script src="<?php echo $_smarty_tpl->tpl_vars['modulePath']->value;?>
/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['modulePath']->value;?>
/js/main.js"></script>
 </body>
</html><?php }} ?>