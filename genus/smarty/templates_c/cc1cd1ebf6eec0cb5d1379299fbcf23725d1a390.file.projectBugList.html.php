<?php /* Smarty version Smarty-3.1.14, created on 2013-08-12 08:51:20
         compiled from "D:\Program Files\wamp\www\genus\module\mainpage\template\projectBugList.html" */ ?>
<?php /*%%SmartyHeaderCode:281045208a20844aa23-36063883%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cc1cd1ebf6eec0cb5d1379299fbcf23725d1a390' => 
    array (
      0 => 'D:\\Program Files\\wamp\\www\\genus\\module\\mainpage\\template\\projectBugList.html',
      1 => 1375760626,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '281045208a20844aa23-36063883',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'projectInfo' => 0,
    'bugList' => 0,
    'bugDetail' => 0,
    'begin' => 0,
    'end' => 0,
    'index' => 0,
    'indexSelect' => 0,
    'max' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5208a20857bcf6_88986903',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5208a20857bcf6_88986903')) {function content_5208a20857bcf6_88986903($_smarty_tpl) {?><div id="maincontent" class="span8 row-fluid clearfix">
	<div class="view">
		<div>
			<ul class="unstyled inline">
			  <li class="span4">标题:<span><?php echo $_smarty_tpl->tpl_vars['projectInfo']->value['name'];?>
</span></li>
			  <li class="span2">负责人:<span><?php echo $_smarty_tpl->tpl_vars['projectInfo']->value['incharge'];?>
</span></li>
			  <li class="span5">创建时间:<span><?php echo $_smarty_tpl->tpl_vars['projectInfo']->value['time'];?>
</span></li>
			  <li class="span1"><a id="delete_proj" href="#" role="button">删除</a></li>
			</ul>
		</div>
		<div>项目成员：<?php echo $_smarty_tpl->tpl_vars['projectInfo']->value['member'];?>
</div>
		<div>
			<div class="span2">
				 <a id="editmember_btn" href="#editmember_box" role="button" data-toggle="modal">编辑成员</a>
			</div>
			<div class="span2 offset8 text-right">
				 <a id="createbug_btn" href="#createbug_box" role="button"  data-toggle="modal">创建bug</a>
			</div>
		</div>
		<table class="table table-striped table-hover table-bordered" contenteditable="false">
		  <thead>
			<tr>
			  <th>编号</th>
			  <th>编号</th>
			  <th>类型</th>
			  <th>状态</th>
			  <th>创建者</th>
			  <th>负责人</th>
			  <th>创建时间</th>
			  <th>概要</th>
			</tr>
		  </thead>
		  <tbody>
			<?php  $_smarty_tpl->tpl_vars['bugDetail'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['bugDetail']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['bugList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['bugDetail']->key => $_smarty_tpl->tpl_vars['bugDetail']->value){
$_smarty_tpl->tpl_vars['bugDetail']->_loop = true;
?>
			<tr>
			  <td><a href="<?php echo $_smarty_tpl->tpl_vars['bugDetail']->value['link'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['bugDetail']->value['id'];?>
</a></td>
			  <td><?php echo $_smarty_tpl->tpl_vars['bugDetail']->value['level'];?>
</td>
			  <td><?php echo $_smarty_tpl->tpl_vars['bugDetail']->value['type'];?>
</td>
			  <td><?php echo $_smarty_tpl->tpl_vars['bugDetail']->value['state'];?>
</td>
			  <td><?php echo $_smarty_tpl->tpl_vars['bugDetail']->value['creator'];?>
</td>
			  <td><?php echo $_smarty_tpl->tpl_vars['bugDetail']->value['incharge'];?>
</td>
			  <td><?php echo $_smarty_tpl->tpl_vars['bugDetail']->value['time'];?>
</td>
			  <td><?php echo $_smarty_tpl->tpl_vars['bugDetail']->value['description'];?>
</td>
			</tr>
			<?php } ?>
		  </tbody>
		</table>
		<div class="pagination pagination-right">
			<ul>
				<?php if ($_smarty_tpl->tpl_vars['begin']->value==1){?>
					<li>
						<a href="#" style="color:grey;">上一页</a>
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
					<li>
						<a href="#" style="color:grey;">下一页</a>
					</li>
				<?php }else{ ?>
					<li>
						<a href="#">下一页</a>
					</li>
				<?php }?>
			</ul>
		</div>
	</div>
</div><?php }} ?>