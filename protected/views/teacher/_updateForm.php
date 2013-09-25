<?php
/* @var $this TeacherController */
/* @var $model Teacher */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerScript(
   'validateSponsorUpdateForm',
   '$("#teacher-form").submit(function(e){
		var validate=true,
			message="<b>Solve all the input errors:</b><br/><br/>";
			
		$("#validationMessage").html("");
		if($("#txtName").val()==""){
			validate=false;
			message+="Teacher Name can not be blank.<br/>";
		}
		if($("#txtAddress").val()==""){
			validate=false;
			message+="Teacher Address can not be blank.<br/>";
		}
		if($("#txtPhone").val()==""){
			validate=false;
			message+="Teacher Phone can not be blank.<br/>";
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
	'id'=>'teacher-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
));
	$modelUserInfo=UserInfo::model();
 ?>
<div class="form">
	<div id="validationMessage" style="display:none;" class="alert_warning">
	</div>	
	


	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<fieldset class="left">
		<?php echo $form->labelEx($model,'teacher_name'); ?>
		<?php echo $form->textField($model,'teacher_name',array('size'=>60,'maxlength'=>200,'id'=>'txtName','autofocus'=>'true')); ?>
		<?php echo $form->error($model,'teacher_name'); ?>
	</fieldset>

	<fieldset class="right">
		<label>Teacher Address <span class="required">*</span></label>
		<?php echo $form->textField($model,'teacher_address',array('size'=>60,'maxlength'=>500,'id'=>'txtAddress')); ?>
		<?php echo $form->error($model,'teacher_address'); ?>
	</fieldset>

	<fieldset class="left">
		<label>Teacher Phone No <span class="required">*</span></label>
		<?php echo $form->textField($model,'teacher_phone_no',array('size'=>45,'maxlength'=>45,'id'=>'txtPhone')); ?>
		<?php echo $form->error($model,'teacher_phone_no'); ?>
	</fieldset>

	
	<div class="clear"></div>
	
	


</div><!-- form -->
	<div class="footer">
		<div class="submit_link">
		 <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		<input type="reset" value="Cancel"/>
		</div>
	</div>
<?php $this->endWidget(); ?>