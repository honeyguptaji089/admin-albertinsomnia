<?php
/* @var $this CompetitionGroupsController */
/* @var $model CompetitionGroups */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'competition-groups-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'group_id_fk'); ?>
		<?php echo $form->textField($model,'group_id_fk',array('size'=>10,'maxlength'=>10,'autofocus'=>'true')); ?>
		<?php echo $form->error($model,'group_id_fk'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'competition_id_fk'); ?>
		<?php echo $form->textField($model,'competition_id_fk',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'competition_id_fk'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		<input type="reset" value="Cancel"/>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->