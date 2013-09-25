<?php
/* @var $this DemoGameInfoController */
/* @var $model DemoGameInfo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'demo-game-info-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'player_id_fk'); ?>
		<?php echo $form->textField($model,'player_id_fk',array('size'=>10,'maxlength'=>10,'autofocus'=>'true')); ?>
		<?php echo $form->error($model,'player_id_fk'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'score'); ?>
		<?php echo $form->textField($model,'score',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'score'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_level_string'); ?>
		<?php echo $form->textField($model,'last_level_string',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'last_level_string'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		<input type="reset" value="Cancel"/>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->