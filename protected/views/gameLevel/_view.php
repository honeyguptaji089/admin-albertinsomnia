<?php
/* @var $this GameLevelController */
/* @var $data GameLevel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('level_name')); ?>:</b>
	<?php echo CHtml::encode($data->level_name); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('total_targets')); ?>:</b>
	<?php echo CHtml::encode($data->total_targets); ?>
	<br />


</div>