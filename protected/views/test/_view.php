<?php
/* @var $this TestController */
/* @var $data Test */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('test_name')); ?>:</b>
	<?php echo CHtml::encode($data->test_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('test_description')); ?>:</b>
	<?php echo CHtml::encode($data->test_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />


</div>