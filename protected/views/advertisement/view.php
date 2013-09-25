<?php
/* @var $this AdvertisementController */
/* @var $model Advertisement */

$this->breadcrumbs=array(
	'Advertisements'=>array('index'),
	$model->id,
);

?>

<div class="module width_3_quarter">
		<div class="header">
			<h3 class="tabs_involved">View Advertisement <?php echo $model->id; ?></h3>
		</div>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'ad_name',
		'description',
		'navigation_url',
		'position',
		'image_url',
		'sponsor_id_fk',
	),
)); ?>
</div>