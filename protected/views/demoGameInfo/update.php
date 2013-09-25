<?php
/* @var $this DemoGameInfoController */
/* @var $model DemoGameInfo */

$this->breadcrumbs=array(
	'Demo Game Infos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DemoGameInfo', 'url'=>array('index')),
	array('label'=>'Create DemoGameInfo', 'url'=>array('create')),
	array('label'=>'View DemoGameInfo', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DemoGameInfo', 'url'=>array('admin')),
);
?>

<h1>Update DemoGameInfo <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>