<?php
/* @var $this SchoolClassController */
/* @var $data SchoolClass */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('class_name')); ?>:</b>
	<?php echo CHtml::encode($data->class_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('grade_id_fk')); ?>:</b>
	<?php echo CHtml::encode($data->grade_id_fk); ?>
	<br />


</div>