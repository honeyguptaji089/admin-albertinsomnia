<?php
/* @var $this AdvertisementClickController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Advertisement Clicks',
);

$this->menu=array(
	array('label'=>'Create AdvertisementClick', 'url'=>array('create')),
	array('label'=>'Manage AdvertisementClick', 'url'=>array('admin')),
);
?>

<h1>Advertisement Clicks</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
