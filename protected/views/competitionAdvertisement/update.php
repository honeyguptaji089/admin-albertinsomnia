<?php
/* @var $this CompetitionAdvertisementController */
/* @var $model CompetitionAdvertisement */

$this->breadcrumbs=array(
	'Competition Advertisements'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CompetitionAdvertisement', 'url'=>array('index')),
	array('label'=>'Create CompetitionAdvertisement', 'url'=>array('create')),
	array('label'=>'View CompetitionAdvertisement', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CompetitionAdvertisement', 'url'=>array('admin')),
);
?>

<h1>Update CompetitionAdvertisement <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>