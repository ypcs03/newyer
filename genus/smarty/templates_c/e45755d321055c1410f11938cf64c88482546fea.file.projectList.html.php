<?php /* Smarty version Smarty-3.1.14, created on 2013-08-12 01:21:10
         compiled from "D:\Program Files\wamp\www\genus\module\MainPage\template\projectList.html" */ ?>
<?php /*%%SmartyHeaderCode:7447520838861312d0-32706674%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e45755d321055c1410f11938cf64c88482546fea' => 
    array (
      0 => 'D:\\Program Files\\wamp\\www\\genus\\module\\MainPage\\template\\projectList.html',
      1 => 1375933856,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7447520838861312d0-32706674',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'projectList' => 0,
    'project' => 0,
    'begin' => 0,
    'end' => 0,
    'index' => 0,
    'indexSelect' => 0,
    'max' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_520838861e8481_57390140',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_520838861e8481_57390140')) {function content_520838861e8481_57390140($_smarty_tpl) {?><div id="nav" class="span4 row-fluid clearfix">
	<div class="view">
		<ul class="unstyled inline">
		  <li class="span8">总项目数：1</li>
		  <li class="span4"><a id="createproj_btn" href="#createproj_box" role="button"  data-toggle="modal">创建项目</a></li>
		</ul>
	</div>
	<div id="url" class="view"><!--此处id属性的url是要通过get拿BugList的url-->
	<div></div>
		<div class="label label-info label-large span12">
		  <div class="span3">标题</div>
		  <div class="span3">负责人</div>
		  <div class="span6">创建时间</div>
		</div>
		<?php  $_smarty_tpl->tpl_vars['project'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['project']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['projectList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['project']->key => $_smarty_tpl->tpl_vars['project']->value){
$_smarty_tpl->tpl_vars['project']->_loop = true;
?>	
		<div class="label span12 clProList" proId="" isClicked="0"><!--通过GET上传的参数名字是proId-->		
		  <div class="span3"><?php echo $_smarty_tpl->tpl_vars['project']->value['name'];?>
</div>
		  <div class="span3"><?php echo $_smarty_tpl->tpl_vars['project']->value['incharge'];?>
</div>
		  <div class="span6"><?php echo $_smarty_tpl->tpl_vars['project']->value['time'];?>
</div>
		</div>		
		<?php } ?>
	</div>
	<div class="pagination pagination-centered">
		<ul>
			<?php if ($_smarty_tpl->tpl_vars['begin']->value==1){?>
				<li class="disabled">
					<a href="#">上一页</a>
				</li>
			<?php }else{ ?>
				<li>
					<a href="#">上一页</a>
				</li>
			<?php }?>
			<?php $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['index']->step = 1;$_smarty_tpl->tpl_vars['index']->total = (int)ceil(($_smarty_tpl->tpl_vars['index']->step > 0 ? $_smarty_tpl->tpl_vars['end']->value+1 - ($_smarty_tpl->tpl_vars['begin']->value) : $_smarty_tpl->tpl_vars['begin']->value-($_smarty_tpl->tpl_vars['end']->value)+1)/abs($_smarty_tpl->tpl_vars['index']->step));
if ($_smarty_tpl->tpl_vars['index']->total > 0){
for ($_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['begin']->value, $_smarty_tpl->tpl_vars['index']->iteration = 1;$_smarty_tpl->tpl_vars['index']->iteration <= $_smarty_tpl->tpl_vars['index']->total;$_smarty_tpl->tpl_vars['index']->value += $_smarty_tpl->tpl_vars['index']->step, $_smarty_tpl->tpl_vars['index']->iteration++){
$_smarty_tpl->tpl_vars['index']->first = $_smarty_tpl->tpl_vars['index']->iteration == 1;$_smarty_tpl->tpl_vars['index']->last = $_smarty_tpl->tpl_vars['index']->iteration == $_smarty_tpl->tpl_vars['index']->total;?>
			
				<?php if ($_smarty_tpl->tpl_vars['index']->value==$_smarty_tpl->tpl_vars['indexSelect']->value){?>
					<li>
						<a href="#" style="color:red;"><?php echo $_smarty_tpl->tpl_vars['index']->value;?>
</a>
					</li>
				<?php }else{ ?>
					<li>
						<a href="#"><?php echo $_smarty_tpl->tpl_vars['index']->value;?>
</a>
					</li>
				<?php }?>
			
			<?php }} ?>
			<?php if ($_smarty_tpl->tpl_vars['end']->value==$_smarty_tpl->tpl_vars['max']->value){?>
				<li class="disabled">
					<a href="#">下一页</a>
				</li>
			<?php }else{ ?>
				<li>
					<a href="#">下一页</a>
				</li>
			<?php }?>
		</ul>
	</div>
</div><?php }} ?>