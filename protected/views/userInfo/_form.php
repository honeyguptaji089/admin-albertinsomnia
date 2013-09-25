<?php
/* @var $this UserInfoController */
/* @var $model UserInfo */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerScript(
   'validateSponsorUpdateForm',
   '$("#user-info-form").submit(function(e){
		var validate=true,
			message="<b>Solve all the input errors:</b><br/><br/>",
			email_exp=/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
		$("#validationMessage").html("");
		if($("#txtPassword").val()==""){
			validate=false;
			message+="Current Password can not be blank.<br/>";
		}
		
		if($("#txtNewPassword").val()==""){
			validate=false;
			message+="New Password can not be blank.<br/>";
		}
		
		if($("#txtConfirmPassword").val()==""){
			validate=false;
			message+="Confim Password Field can not be blank.<br/>";
		}
		
		if($("#txtNewPassword").val()!==$("#txtConfirmPassword").val()){
			validate=false;
			message+="Your New Password does not match with Confirm Password.<br/>";
		}
		
		if($("#txtPassword").val()===$("#txtNewPassword").val()){
			validate=false;
			message+="Your New Password could not be same as Current Password.<br/>";
		}
		
		if(validate)
		{
			return true;
		}	
		else
		{
			$("#validationMessage").show().append(message);
			return false;
		}
		
   });',
   CClientScript::POS_READY
);

?>

<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'user-info-form',
		'enableAjaxValidation'=>false,
		'enableClientValidation'=>true,
	)); ?>

<div class="module_content">
	<div id="validationMessage" style="display:none;" class="alert_warning"></div>

	<div class="form">

	
		<p class="note">Fields with <span class="required">*</span> are required.</p>

		<?php echo $form->errorSummary($model); ?>

		
		<fieldset >
			<label>Current Password</label>
			<input type="hidden" id="hCurrentPassword" name="UserInfo[hiddenCurrentPassword]" value='<?php echo $this->user_password; ?>'/>
			<input type="password" id="txtPassword" name="UserInfo[password]" autofocus='true'/>
		</fieldset>
		
		<div class="claer"></div>
		
		<fieldset >
			<label>New Password</label>
			<input type="password" id="txtNewPassword" name="UserInfo[NewPassword]"/>
		</fieldset>
		
		<div class="claer"></div>
		
		<fieldset >
			<label>Confirm Password</label>
			<input type="password" id="txtConfirmPassword" name="UserInfo[ConfirmPassword]"/>
			
		</fieldset>
		
		<div class="claer"></div>
		
		
	</div><!-- form -->
	<div class="footer">
		<div class="submit_link">
		 <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Change Password',array('id'=>'btnSubmit')); ?>
		<input type="reset" value="Cancel"/>
		</div>
	</div>

</div>

<?php $this->endWidget(); ?>