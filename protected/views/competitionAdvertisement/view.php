<?php
/* @var $this CompetitionAdvertisementController */
/* @var $model CompetitionAdvertisement */

$this->breadcrumbs=array(
	'Competition Advertisements'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CompetitionAdvertisement', 'url'=>array('index')),
	array('label'=>'Create CompetitionAdvertisement', 'url'=>array('create')),
	array('label'=>'Update CompetitionAdvertisement', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CompetitionAdvertisement', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CompetitionAdvertisement', 'url'=>array('admin')),
);
?>

<h1>View CompetitionAdvertisement #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'competition_id_fk',
		'ad_id_fk',
	),
)); ?>
