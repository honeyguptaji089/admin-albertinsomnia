<?php
/* @var $this SchoolGroupController */
/* @var $data SchoolGroup */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('group_name')); ?>:</b>
	<?php echo CHtml::encode($data->group_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('class_id_fk')); ?>:</b>
	<?php echo CHtml::encode($data->class_id_fk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_competition_group')); ?>:</b>
	<?php echo CHtml::encode($data->is_competition_group); ?>
	<br />


</div>