<?php
/* @var $this CompetitionAdvertisementController */
/* @var $model CompetitionAdvertisement */

$this->breadcrumbs=array(
	'Competition Advertisements'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CompetitionAdvertisement', 'url'=>array('index')),
	array('label'=>'Manage CompetitionAdvertisement', 'url'=>array('admin')),
);
?>

<h1>Create CompetitionAdvertisement</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>