<?php
/* @var $this DemoGameInfoController */
/* @var $model DemoGameInfo */

$this->breadcrumbs=array(
	'Demo Game Infos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DemoGameInfo', 'url'=>array('index')),
	array('label'=>'Manage DemoGameInfo', 'url'=>array('admin')),
);
?>

<h1>Create DemoGameInfo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>