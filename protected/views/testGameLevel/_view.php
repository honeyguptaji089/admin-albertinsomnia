<?php
/* @var $this TestGameLevelController */
/* @var $data TestGameLevel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('test_id_fk')); ?>:</b>
	<?php echo CHtml::encode($data->test_id_fk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('game_level_id_fk')); ?>:</b>
	<?php echo CHtml::encode($data->game_level_id_fk); ?>
	<br />


</div>