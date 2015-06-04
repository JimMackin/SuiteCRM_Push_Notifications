<?php
require_once 'modules/AOW_Actions/actions/actionBase.php';
require 'custom/include/JSMPushNotification/PushBulletService.php';
class actionJSMPushNotification extends actionBase{
	function actionJSMPushNotification($id = ''){
	
		parent::actionBase($id);
	
	}
	function run_action(SugarBean $bean, $params = array()){
		global $sugar_config;
		if(empty($params['user_id'])){
			return;
		}
		if(empty($params['subject'])){
			$subject = "SuiteCRM notification";
		}else{
			$subject = $params['subject'];
		}
		if(empty($params['body'])){
			$body = "SuiteCRM notification";
		}else{
			$body = $params['body'];
		}
		$userId = $params['user_id'];
		$user = BeanFactory::getBean('Users',$userId);
		
		$pushService = new PushBulletService();
		//$GLOBALS['log']->fatal($bean->name.' ran in Wokflow!!!');
		$pushService->push($subject,
				$body,
				$sugar_config['site_url']."?module=".$bean->module_name."&action=DetailView&record=".$bean->id,
				$user);
	
		return true;
	
	}
	
	function edit_display($line, SugarBean $bean = null, $params = array()){
		global $mod_strings;
		echo "<pre>";
		print_r($params);
		echo "</pre>";
		$userName = $params['user_name'];
		$userId = $params['user_id'];
		$subject = $params['subject'];
		$body = $params['body'];
		$lblSubject = translate('LBL_SUBJECT','AOW_Actions');
		$lblBody = translate('LBL_BODY','AOW_Actions');
		$lblRecipient = translate('LBL_RECIPIENT','AOW_Actions');
		
		$html = <<<EOF

<table border='0' cellpadding='0' cellspacing='0' width='100%'>
<tr>
<td id="name_label" scope="row" valign="top">
	{$lblSubject}
	<input name='aow_actions_param[{$line}][subject]' value='$subject'>
</td>
<td id="name_label" scope="row" valign="top">
	{$lblBody}
	<input name='aow_actions_param[{$line}][body]' value='$body'>
</td>
<td id="name_label" scope="row" valign="top">
{$lblRecipient}
<input name="aow_actions_param[$line][user_name]" 
		class="sqsEnabled yui-ac-input" 
		tabindex="0" 
		id="aow_actions_param_user_name_$line" 
		size="" 
		value="$userName" 
		title="" 
		autocomplete="off" 
		type="text">
				<div class="yui-ac-container" id="EditView_aow_actions_param_user_name_results">
				<div style="display: none;" class="yui-ac-content">
				<div style="display: none;" class="yui-ac-hd">
				</div>
				<div class="yui-ac-bd">
				<ul>
				<li style="display: none;"></li>
				<li style="display: none;"></li>
				<li style="display: none;"></li>
				<li style="display: none;"></li>
				<li style="display: none;"></li>
				<li style="display: none;"></li>
				<li style="display: none;"></li>
				<li style="display: none;"></li>
				<li style="display: none;"></li>
				<li style="display: none;"></li>
				</ul>
				</div>
				<div style="display: none;" class="yui-ac-ft">
				</div>
				</div>
				</div>
				<input name="aow_actions_param[$line][user_id]" id="aow_actions_param_user_id_$line" value="$userId" type="hidden">
				<span class="id-ff multiple">
				<button type="button" name="btn_aow_actions_param_user_name_$line" id="btn_aow_actions_param_user_name_$line" tabindex="0" title="Select User" class="button firstChild" value="Select User" onclick="open_popup(
					&quot;Users&quot;, 
					600, 
					400, 
					&quot;&quot;, 
					true, 
					false, 
					{&quot;call_back_function&quot;:&quot;set_return&quot;,&quot;form_name&quot;:&quot;EditView&quot;,&quot;field_to_name_array&quot;:{&quot;id&quot;:&quot;aow_actions_param_user_id&quot;,&quot;user_name&quot;:&quot;aow_actions_param_user_name_$line&quot;}}, 
					&quot;single&quot;, 
					true
					);"><img src="themes/default/images/id-ff-select.png?v=Fyr8mVFR9LCp8JkQHa32Pg"></button><button type="button" name="btn_clr_assigned_user_name" id="btn_clr_assigned_user_name" tabindex="0" title="Clear User" class="button lastChild" onclick="SUGAR.clearRelateField(this.form, 'assigned_user_name', 'assigned_user_id');" value="Clear User"><img src="themes/default/images/id-ff-clear.png?v=Fyr8mVFR9LCp8JkQHa32Pg"></button>
</span>
<script type="text/javascript">
SUGAR.util.doWhen(
		"typeof(sqs_objects) != 'undefined' && typeof(sqs_objects['EditView_aow_actions_param_user_name_$line']) != 'undefined'",
		enableQS
);
</script>			
</td>
</tr>
</table>
		
			
			

					
			
EOF;
		return $html;
	}
}