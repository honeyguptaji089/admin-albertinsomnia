<?php
/* @var $this SchoolGradesController */
/* @var $model SchoolGrades */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'school-grades-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'grade_name'); ?>
		<?php echo $form->textField($model,'grade_name',array('size'=>45,'maxlength'=>45,'autofocus'=>'true')); ?>
		<?php echo $form->error($model,'grade_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'school_id_fk'); ?>
		<?php echo $form->textField($model,'school_id_fk',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'school_id_fk'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		<input type="reset" value="Cancel"/>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->