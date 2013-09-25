<?php
/* @var $this CompetitionAdvertisementController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Competition Advertisements',
);

$this->menu=array(
	array('label'=>'Create CompetitionAdvertisement', 'url'=>array('create')),
	array('label'=>'Manage CompetitionAdvertisement', 'url'=>array('admin')),
);
?>

<h1>Competition Advertisements</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
