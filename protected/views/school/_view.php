<?php
/* @var $this SchoolController */
/* @var $data School */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('school_name')); ?>:</b>
	<?php echo CHtml::encode($data->school_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('school_code')); ?>:</b>
	<?php echo CHtml::encode($data->school_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('school_address')); ?>:</b>
	<?php echo CHtml::encode($data->school_address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone_number')); ?>:</b>
	<?php echo CHtml::encode($data->phone_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contact_name')); ?>:</b>
	<?php echo CHtml::encode($data->contact_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('no_student')); ?>:</b>
	<?php echo CHtml::encode($data->no_student); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id_fk')); ?>:</b>
	<?php echo CHtml::encode($data->user_id_fk); ?>
	<br />

	*/ ?>

</div>