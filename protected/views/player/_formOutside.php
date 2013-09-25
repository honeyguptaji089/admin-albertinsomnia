<?php
/* @var $this PlayerController */
/* @var $model Player */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerScript(
   'validatePlayerForm',
   '$("#player-form").submit(function(e){
		var validate=true,
			message="<b>Solve all the input errors:</b><br/><br/>",
			email_exp=/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
		$("#validationMessage").html("");
		if($("#txtPlayerName").val()==""){
			validate=false;
			message+="Player Name can not be blank.<br/>";
		}
		if($("#txtEmail").val()==""){
			validate=false;
			message+="Player Email can not be blank.<br/>";
		}
		if(!email_exp.test($("#txtEmail").val())){
			validate=false;
			message+="Player Email is not valid.<br/>";
		}
		if($("#txtPassword").val()==""){
			validate=false;
			message+="Player Password can not be blank.<br/>";
		}
		if($("#txtConfirmPassword").val()==""){
			validate=false;
			message+="Confrim Password field can not be blank.<br/>";
		}
		if($("#txtPassword").val()!==$("#txtConfirmPassword").val()){
			validate=false;
			message+="Confrim Password not match with Password.<br/>";
		}
		if($("#slGender").val()=="Select Gender")
		{
			validate=false;
			message+="Select Player Gender.<br/>";
		}
		if($("#txtAddress").val()==""){
			validate=false;
			message+="Player Address can not be blank.<br/>";
		}
		if($("#txtPhone").val()==""){
			validate=false;
			message+="Phone can not be blank.<br/>";
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
	'id'=>'player-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
)); 
	$modelUserInfo=UserInfo::model();
?>
<div class="module_content">
	<div id="validationMessage" style="display:none;" class="alert_warning">
	</div>	
	
<div class="form outside-player">


	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<fieldset>
		<?php echo $form->labelEx($model,'player_name'); ?>
		<?php echo $form->textField($model,'player_name',array('size'=>60,'maxlength'=>200,'id'=>'txtPlayerName','autofocus'=>'true')); ?>
	</fieldset>

	
	<fieldset>
		<?php echo $form->labelEx($modelUserInfo,'email'); ?>
		<?php echo $form->textField($modelUserInfo,'email',array('size'=>45,'maxlength'=>45,'id'=>'txtEmail')); ?>
		<?php echo $form->error($modelUserInfo,'email'); ?>
	</fieldset>
	
	<fieldset>
		<?php echo $form->labelEx($modelUserInfo,'password'); ?>
		<?php echo $form->passwordField($modelUserInfo,'password',array('size'=>45,'maxlength'=>45,'id'=>'txtPassword')); ?>
		<?php echo $form->error($modelUserInfo,'password'); ?>
	</fieldset>
	<fieldset>
		<label>CONFIRM PASSWORD</label>
		<input type="password" name="confirm_pwd" id="txtConfirmPassword"/>
	</fieldset>
	
	<fieldset>
		<?php echo $form->labelEx($model,'gender'); ?>
		<select id="slGender" name="Player[gender]">
			<option value="Select Gender">Select Gender</option>
			<option value="Male">Male</option>
			<option value="Female">Female</option>
		</select>
	</fieldset>

	<fieldset>
		<label>PHONE NO <span class="required">*</span></label>
		<?php echo $form->textField($model,'phone_no',array('size'=>45,'maxlength'=>45,'id'=>'txtPhone')); ?>
	</fieldset>

	<fieldset>
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textArea($model,'address',array('maxlength'=>200,'id'=>'txtAddress')); ?>
		
	</fieldset>
	<fieldset>
			<?php echo $form->labelEx($model,'player_code'); ?>
			<?php echo $form->textField($model,'player_code',array('size'=>45,'maxlength'=>45,'readonly'=>'true','value'=>$this->player_code)); ?>
			<?php echo $form->error($model,'player_code'); ?>
		</fieldset>
		
	<div class="clear"></div>


</div>
		<div class="footer">
			<div class="submit_link">
				<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
				<input type="reset" value="Cancel"/>
			</div>
		</div>
</div>

<?php $this->endWidget(); ?>
