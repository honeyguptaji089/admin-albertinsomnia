<?php
/* @var $this CompetitionAdvertisementController */
/* @var $data CompetitionAdvertisement */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('competition_id_fk')); ?>:</b>
	<?php echo CHtml::encode($data->competition_id_fk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ad_id_fk')); ?>:</b>
	<?php echo CHtml::encode($data->ad_id_fk); ?>
	<br />


</div>