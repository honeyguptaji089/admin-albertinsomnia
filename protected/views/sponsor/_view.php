<?php
/* @var $this SponsorController */
/* @var $data Sponsor */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sponsor_name')); ?>:</b>
	<?php echo CHtml::encode($data->sponsor_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sponsor_address')); ?>:</b>
	<?php echo CHtml::encode($data->sponsor_address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sponsor_phone')); ?>:</b>
	<?php echo CHtml::encode($data->sponsor_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sponsor_code')); ?>:</b>
	<?php echo CHtml::encode($data->sponsor_code); ?>
	<br />


</div>