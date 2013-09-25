<?php
/* @var $this SchoolGradesController */
/* @var $data SchoolGrades */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('grade_name')); ?>:</b>
	<?php echo CHtml::encode($data->grade_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('school_id_fk')); ?>:</b>
	<?php echo CHtml::encode($data->school_id_fk); ?>
	<br />


</div>