<?php
/* @var $this PlayerController */
/* @var $model Player */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerScript(
   'validatePlayerForm',
   '$("#player-form").submit(function(e){
		var validate=true,
			message="<b>Solve all the input errors:</b><br/><br/>";
		$("#validationMessage").html("");
		if($("#txtPlayerName").val()==""){
			validate=false;
			message+="Player Name can not be blank.<br/>";
		}
		if($("#slGrade").val()=="Select Grade")
		{
			validate=false;
			message+="Select Player Grade.<br/>";
		}
		if($("#slClass").val()==null || $("#slClass").val()=="Select Class")
		{
			validate=false;
			message+="Select Player Class.<br/>";
		}
		if($("#slGender").val()=="Select Gender")
		{
			validate=false;
			message+="Select Player Gender.<br/>";
		}
		if(isNaN($("#txtPhone").val())){
			validate=false;
			message+="Phone Number can have number only .<br/>";
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
	
<div class="form">

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<fieldset class="left">
		<?php echo $form->labelEx($model,'player_name'); ?>
		<?php echo $form->textField($model,'player_name',array('size'=>60,'maxlength'=>200,'id'=>'txtPlayerName','autofocus'=>'true')); ?>
	</fieldset>

	<fieldset class="right">
		<label>GRADE <span class="required">*</span></label>
		<?php echo $this->grade;?>
	</fieldset>
	
	<fieldset class="left">
		<label>CLASS <span class="required">*</span></label>
		<?php echo $this->classSelect;?>
	</fieldset>
	
	<fieldset class="right">
		<?php echo $form->labelEx($model,'gender'); ?>
		<?php echo $this->selectGender;?>
	</fieldset>

	<fieldset class="left">
		<label>PHONE NO <span class="required">*</span></label>
		<?php echo $form->textField($model,'phone_no',array('size'=>45,'maxlength'=>45,'id'=>'txtPhone')); ?>
	</fieldset>

	<fieldset class="right">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textArea($model,'address',array('maxlength'=>200,'id'=>'txtAddress')); ?>
		
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
