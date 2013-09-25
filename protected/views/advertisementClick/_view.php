<?php
/* @var $this AdvertisementClickController */
/* @var $data AdvertisementClick */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ad_id_fk')); ?>:</b>
	<?php echo CHtml::encode($data->ad_id_fk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ip_address')); ?>:</b>
	<?php echo CHtml::encode($data->ip_address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('click_time')); ?>:</b>
	<?php echo CHtml::encode($data->click_time); ?>
	<br />


</div>