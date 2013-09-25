<?php
/* @var $this DemoGameInfoController */
/* @var $data DemoGameInfo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('player_id_fk')); ?>:</b>
	<?php echo CHtml::encode($data->player_id_fk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('score')); ?>:</b>
	<?php echo CHtml::encode($data->score); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_level_string')); ?>:</b>
	<?php echo CHtml::encode($data->last_level_string); ?>
	<br />


</div>