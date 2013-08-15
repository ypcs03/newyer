<?php /* Smarty version Smarty-3.1.14, created on 2013-08-13 03:43:28
         compiled from "D:\Program Files\wamp\www\genus\module\MainPage\template\main.html" */ ?>
<?php /*%%SmartyHeaderCode:296195208388653ec65-00034324%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b990e5e18367920e9afa56baedaefae41118c210' => 
    array (
      0 => 'D:\\Program Files\\wamp\\www\\genus\\module\\MainPage\\template\\main.html',
      1 => 1376364887,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '296195208388653ec65-00034324',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5208388657bcf8_97371958',
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
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5208388657bcf8_97371958')) {function content_5208388657bcf8_97371958($_smarty_tpl) {?><!DOCTYPE html>
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