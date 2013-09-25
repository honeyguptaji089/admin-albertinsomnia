<?php
/* @var $this AdvertisementClickController */
/* @var $model AdvertisementClick */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'advertisement-click-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ad_id_fk'); ?>
		<?php echo $form->textField($model,'ad_id_fk',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'ad_id_fk'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ip_address'); ?>
		<?php echo $form->textField($model,'ip_address',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'ip_address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'click_time'); ?>
		<?php echo $form->textField($model,'click_time'); ?>
		<?php echo $form->error($model,'click_time'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->