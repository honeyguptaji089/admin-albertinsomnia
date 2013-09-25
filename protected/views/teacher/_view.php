<?php
/* @var $this TeacherController */
/* @var $data Teacher */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('teacher_name')); ?>:</b>
	<?php echo CHtml::encode($data->teacher_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('teacher_address')); ?>:</b>
	<?php echo CHtml::encode($data->teacher_address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('teacher_phone_no')); ?>:</b>
	<?php echo CHtml::encode($data->teacher_phone_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id_fk')); ?>:</b>
	<?php echo CHtml::encode($data->user_id_fk); ?>
	<br />


</div>