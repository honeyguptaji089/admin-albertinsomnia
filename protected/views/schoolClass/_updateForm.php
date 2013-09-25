<?php
/* @var $this SchoolClassController */
/* @var $model SchoolClass */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerScript(
   'validateAdvertisementForm',
   '
  
		
	$("#school-class-form").submit(function(e){
		var validate=true,message="<b>Solve all the input errors:</b><br/><br/>";
		$("#validationMessage").html("");
		if($("#slSchoolClass").val()=="Select Grade"){
			validate=false;
			message+="Select School Grade.<br/>";
		}
		if($("#txtClassName").val()==""){
			validate=false;
			message+="Class Name can not be blank.<br/>";
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
		
	});
	
	
   ',
   CClientScript::POS_READY
);


?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'school-class-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
)); ?>

<div class="module_content">
	
	<div id="validationMessage" style="display:none;" class="alert_warning">
	</div>	
	
	
	<div class="form">


	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	
	<fieldset class="left">
		<label>School Class <span class="required">*</span></label>
		<?php echo $this->school_grade;?>
	</fieldset>
	<fieldset class="right">
		<?php echo $form->labelEx($model,'class_name'); ?>
		<?php echo $form->textField($model,'class_name',array('size'=>60,'maxlength'=>100,'id'=>'txtClassName','autofocus'=>'true')); ?>
		<?php echo $form->error($model,'class_name'); ?>
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
