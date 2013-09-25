<?php
/* @var $this PatternsController */
/* @var $data Patterns */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cards')); ?>:</b>
	<?php echo CHtml::encode($data->cards); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('functions')); ?>:</b>
	<?php echo CHtml::encode($data->functions); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('max_target')); ?>:</b>
	<?php echo CHtml::encode($data->max_target); ?>
	<br />


</div>