<?php
/* @var $this AdvertisementClickController */
/* @var $model AdvertisementClick */

$this->breadcrumbs=array(
	'Advertisement Clicks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AdvertisementClick', 'url'=>array('index')),
	array('label'=>'Manage AdvertisementClick', 'url'=>array('admin')),
);
?>

<h1>Create AdvertisementClick</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>