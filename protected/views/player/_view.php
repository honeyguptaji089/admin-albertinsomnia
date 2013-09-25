<?php
/* @var $this PlayerController */
/* @var $data Player */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('player_name')); ?>:</b>
	<?php echo CHtml::encode($data->player_name); ?>
	<br />

	<b><label>Player Class</label>:</b>
	<?php echo CHtml::encode($data->classIdFk->class_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gender')); ?>:</b>
	<?php echo CHtml::encode($data->gender); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone_no')); ?>:</b>
	<?php echo CHtml::encode($data->phone_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id_fk')); ?>:</b>
	<?php echo CHtml::encode($data->user_id_fk); ?>
	<br />


</div>