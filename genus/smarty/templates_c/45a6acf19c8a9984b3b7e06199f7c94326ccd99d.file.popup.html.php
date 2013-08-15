<?php /* Smarty version Smarty-3.1.14, created on 2013-08-12 01:21:10
         compiled from "D:\Program Files\wamp\www\genus\module\MainPage\template\popup.html" */ ?>
<?php /*%%SmartyHeaderCode:745852083886501bd8-65659109%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '45a6acf19c8a9984b3b7e06199f7c94326ccd99d' => 
    array (
      0 => 'D:\\Program Files\\wamp\\www\\genus\\module\\MainPage\\template\\popup.html',
      1 => 1376270445,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '745852083886501bd8-65659109',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52083886501bd3_99219347',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52083886501bd3_99219347')) {function content_52083886501bd3_99219347($_smarty_tpl) {?><!--登录对话框-->
<div id="login_box" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">
			登录
		</h3>
	</div>
	<div class="modal-body">
		<div class="well">
			<form class="form-horizontal">
            <div class="control-group">
              <label class="control-label" for="inputEmail">用户名</label>
              <div class="controls">
                <input type="text" id="inputEmail" placeholder="Email"></div>
            </div>
            <div class="control-group">
              <label class="control-label" for="inputPassword">密码</label>
              <div class="controls">
                <input type="password" id="inputPassword" placeholder="Password"></div>
            </div>
            <div class="control-group">
              <div class="controls">
                <label class="checkbox">
                  <input type="checkbox">记住密码</label>
                <button type="submit" class="btn btn-primary">登录</button>
              </div>
            </div>
          </form>
		</div>
	</div>
</div>

<!--注册对话框-->
<div id="register_box" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">
			注册
		</h3>
	</div>
	<div class="modal-body">
		<div class="well">
			<form class="form-horizontal">
            <div class="control-group">
              <label class="control-label" for="inputEmail">用户名</label>
              <div class="controls">
                <input type="text" id="inputEmail" placeholder="Email"></div>
            </div>
            <div class="control-group">
              <label class="control-label" for="inputPassword">密码</label>
              <div class="controls">
                <input type="password" id="inputPassword" placeholder="Password"></div>
            </div>
			<div class="control-group">
              <label class="control-label" for="confirmPassword">确认密码</label>
              <div class="controls">
                <input type="password" id="confirmPassword" placeholder="Password"></div>
            </div>
            <div class="control-group">
              <div class="controls">
                <button type="submit" class="btn btn-primary">注册</button>
              </div>
            </div>
          </form>
		</div>
	</div>
</div>


<!--创建项目对话框-->
<div id="createproj_box" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">
			创建项目
		</h3>
	</div>
	<div class="modal-body">
		<div class="well">
			<form class="form-horizontal">
				<div class="control-group">
				  <label class="control-label" for="inputproj">项目名称</label>
				  <div class="controls">
					<input type="text" id="inputproj" placeholder="Project Name"></div>
				</div>
				<div class="control-group">
				  <div class="controls">
					<button type="submit" class="btn btn-primary">创建</button>
				  </div>
				</div>
			</form>
		</div>
	</div>
</div>

<!--编辑成员对话框-->
<div id="editmember_box" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">
			编辑成员
		</h3>
	</div>
	<div class="modal-body">
		<div class="well">
			<form class="form-inline">
				<div class="row-fluid clearfix">
					<div class="span4">
						<div class="control-group">
							  <label class="control-label" for="select_personnel">人员列表</label>
							  <div class="controls">
									<select id="select_personnel" multiple="multiple" size="8" class="span10">
										<option>xxx</option>
										<option>xxx</option>
										<option>xxx</option>
										<option>xxx</option>
										<option>xxx</option>
										<option>xxx</option>
										<option>xxx</option>
										<option>xxx</option>
										<option>xxx</option>
									</select>
							  </div>
						 </div>
					</div>
					<div class="span4 text-center">
						<div><input type="button" value=">>" /></div>
						<div><input type="button" value=">>" /></div>
					</div>
					<div class="span4">
					<div class="control-group">
							  <label class="control-label" for="select_member">成员列表</label>
							  <div class="controls">
									<select id="select_member" multiple="multiple" size="8" class="span10">
										<option>xxx</option>
										<option>xxx</option>
										<option>xxx</option>
										<option>xxx</option>
										<option>xxx</option>
										<option>xxx</option>
										<option>xxx</option>
										<option>xxx</option>
										<option>xxx</option>
									</select>
							  </div>
						 </div>
					</div>
				</div>
				<div class="control-group">
				  <div class="controls text-right">
					<button type="submit" class="btn btn-primary">确定</button>
				  </div>
				</div>
			</form>
		</div>
	</div>
</div>

<!--创建bug对话框-->
<div id="createbug_box" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">
			创建Bug
		</h3>
	</div>
	<div class="modal-body">
		<div class="well">
			<form class="form-horizontal">
				<div class="control-group form-inline">
				  <label>等级</label>
				  <select class="span2">
					<option>
						high
					</option>
					<option>
						medium
					</option>
					<option>
						low
					</option>
				  </select>
				  <label>类型</label>
				  <input class="span2" />
				</div>
				<div class="control-group form-inline">
				  <label>概要</label>
				  <input class="span4" />
				</div>
				<div class="control-group form-inline">
				  <label>详细</label>
				</div>
				<div class="control-group form-inline">
				  <textarea class="input-block-level" rows="5"></textarea>
				</div>
				<div class="control-group">
				  <div class="controls">
					<button type="submit" class="btn btn-primary">创建</button>
				  </div>
				</div>
			<form>
		</div>
	</div>
</div><?php }} ?>