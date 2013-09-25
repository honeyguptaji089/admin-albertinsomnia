<?php
/* @var $this AdvertisementClickController */
/* @var $model AdvertisementClick */

$this->breadcrumbs=array(
	'Advertisement Clicks'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List AdvertisementClick', 'url'=>array('index')),
	array('label'=>'Create AdvertisementClick', 'url'=>array('create')),
	array('label'=>'Update AdvertisementClick', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete AdvertisementClick', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AdvertisementClick', 'url'=>array('admin')),
);
?>

<h1>View AdvertisementClick #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'ad_id_fk',
		'ip_address',
		'click_time',
	),
)); ?>
