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
<?php if ($_valid && !is_callable('content_52083886501bd3_99219347')) {function content_52083886501bd3_99219347($_smarty_tpl) {?><!--��¼�Ի���-->
<div id="login_box" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">��</button>
		<h3 id="myModalLabel">
			��¼
		</h3>
	</div>
	<div class="modal-body">
		<div class="well">
			<form class="form-horizontal">
            <div class="control-group">
              <label class="control-label" for="inputEmail">�û���</label>
              <div class="controls">
                <input type="text" id="inputEmail" placeholder="Email"></div>
            </div>
            <div class="control-group">
              <label class="control-label" for="inputPassword">����</label>
              <div class="controls">
                <input type="password" id="inputPassword" placeholder="Password"></div>
            </div>
            <div class="control-group">
              <div class="controls">
                <label class="checkbox">
                  <input type="checkbox">��ס����</label>
                <button type="submit" class="btn btn-primary">��¼</button>
              </div>
            </div>
          </form>
		</div>
	</div>
</div>

<!--ע��Ի���-->
<div id="register_box" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">��</button>
		<h3 id="myModalLabel">
			ע��
		</h3>
	</div>
	<div class="modal-body">
		<div class="well">
			<form class="form-horizontal">
            <div class="control-group">
              <label class="control-label" for="inputEmail">�û���</label>
              <div class="controls">
                <input type="text" id="inputEmail" placeholder="Email"></div>
            </div>
            <div class="control-group">
              <label class="control-label" for="inputPassword">����</label>
              <div class="controls">
                <input type="password" id="inputPassword" placeholder="Password"></div>
            </div>
			<div class="control-group">
              <label class="control-label" for="confirmPassword">ȷ������</label>
              <div class="controls">
                <input type="password" id="confirmPassword" placeholder="Password"></div>
            </div>
            <div class="control-group">
              <div class="controls">
                <button type="submit" class="btn btn-primary">ע��</button>
              </div>
            </div>
          </form>
		</div>
	</div>
</div>


<!--������Ŀ�Ի���-->
<div id="createproj_box" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">��</button>
		<h3 id="myModalLabel">
			������Ŀ
		</h3>
	</div>
	<div class="modal-body">
		<div class="well">
			<form class="form-horizontal">
				<div class="control-group">
				  <label class="control-label" for="inputproj">��Ŀ����</label>
				  <div class="controls">
					<input type="text" id="inputproj" placeholder="Project Name"></div>
				</div>
				<div class="control-group">
				  <div class="controls">
					<button type="submit" class="btn btn-primary">����</button>
				  </div>
				</div>
			</form>
		</div>
	</div>
</div>

<!--�༭��Ա�Ի���-->
<div id="editmember_box" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">��</button>
		<h3 id="myModalLabel">
			�༭��Ա
		</h3>
	</div>
	<div class="modal-body">
		<div class="well">
			<form class="form-inline">
				<div class="row-fluid clearfix">
					<div class="span4">
						<div class="control-group">
							  <label class="control-label" for="select_personnel">��Ա�б�</label>
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
							  <label class="control-label" for="select_member">��Ա�б�</label>
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
					<button type="submit" class="btn btn-primary">ȷ��</button>
				  </div>
				</div>
			</form>
		</div>
	</div>
</div>

<!--����bug�Ի���-->
<div id="createbug_box" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">��</button>
		<h3 id="myModalLabel">
			����Bug
		</h3>
	</div>
	<div class="modal-body">
		<div class="well">
			<form class="form-horizontal">
				<div class="control-group form-inline">
				  <label>�ȼ�</label>
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
				  <label>����</label>
				  <input class="span2" />
				</div>
				<div class="control-group form-inline">
				  <label>��Ҫ</label>
				  <input class="span4" />
				</div>
				<div class="control-group form-inline">
				  <label>��ϸ</label>
				</div>
				<div class="control-group form-inline">
				  <textarea class="input-block-level" rows="5"></textarea>
				</div>
				<div class="control-group">
				  <div class="controls">
					<button type="submit" class="btn btn-primary">����</button>
				  </div>
				</div>
			<form>
		</div>
	</div>
</div><?php }} ?>