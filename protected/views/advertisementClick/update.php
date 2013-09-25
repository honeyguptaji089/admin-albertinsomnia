<?php
/* @var $this AdvertisementClickController */
/* @var $model AdvertisementClick */

$this->breadcrumbs=array(
	'Advertisement Clicks'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AdvertisementClick', 'url'=>array('index')),
	array('label'=>'Create AdvertisementClick', 'url'=>array('create')),
	array('label'=>'View AdvertisementClick', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage AdvertisementClick', 'url'=>array('admin')),
);
?>

<h1>Update AdvertisementClick <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>