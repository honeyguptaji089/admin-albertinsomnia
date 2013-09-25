<?php
/* @var $this AdvertisementController */
/* @var $model Advertisement */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ad_name'); ?>
		<?php echo $form->textField($model,'ad_name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'navigation_url'); ?>
		<?php echo $form->textField($model,'navigation_url',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'position'); ?>
		<?php echo $form->textField($model,'position',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<!--<?php echo $form->label($model,'image_url'); ?>
		<?php echo $form->textField($model,'image_url',array('size'=>60,'maxlength'=>200)); ?>-->
	</div>

	<div class="row">
		<!--<?php echo $form->label($model,'sponsor_id_fk'); ?>
		<?php echo $form->textField($model,'sponsor_id_fk',array('size'=>10,'maxlength'=>10)); ?>-->
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->