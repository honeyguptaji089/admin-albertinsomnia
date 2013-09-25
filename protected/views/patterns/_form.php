<?php
/* @var $this PatternsController */
/* @var $model Patterns */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerScript(
   'validatePatternForm',
   '$("#patterns-form").submit(function(e){
		var validate=true,
			message="<b>Solve all the input errors:</b><br/><br/>";
		$("#validationMessage").html("");
		if($("#txtCards").val()==""){
			validate=false;
			message+="Enter Card Sequence.<br/>";
		}
		if($("#txtFunctions").val()=="")
		{
			validate=false;
			message+="Enter Functions Sequence.<br/>";
		}
		if($("#txtTarget").val()=="" || isNaN($("#txtTarget").val()))
		{
			validate=false;
			message+="Enter Numeric Max Target (Sequential).<br/>";
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
	'id'=>'patterns-form',
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
		<?php echo $form->labelEx($model,'cards'); ?>
		<?php echo $form->textField($model,'cards',array('size'=>60,'maxlength'=>100,'id'=>'txtCards','autofocus'=>'true')); ?>
		<?php echo $form->error($model,'cards'); ?>
	</fieldset>
	

	<fieldset class="right">
		<?php echo $form->labelEx($model,'functions'); ?>
		<?php echo $form->textField($model,'functions',array('size'=>50,'maxlength'=>50,'id'=>'txtFunctions')); ?>
		<?php echo $form->error($model,'functions'); ?>
	</fieldset>

	<fieldset class="left">
		<?php echo $form->labelEx($model,'max_target'); ?>
		<?php echo $form->textField($model,'max_target',array('size'=>10,'maxlength'=>10,'id'=>'txtTarget')); ?>
		<?php echo $form->error($model,'max_target'); ?>
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
