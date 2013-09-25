<?php
/* @var $this SponsorController */
/* @var $model Sponsor */

$this->breadcrumbs=array(
	'Sponsors'=>array('index'),
	$model->id,
);


?>

<div class="module width_3_quarter">
		<div class="header">
			<h3 class="tabs_involved">View Sponsor <?php echo $model->id; ?></h3>
		</div>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'sponsor_name',
		'sponsor_address',
		'sponsor_phone',
		'user_id_fk',
		'sponsor_code',
	),
)); ?>
</div>