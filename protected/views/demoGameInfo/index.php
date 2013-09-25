<?php
/* @var $this DemoGameInfoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Demo Game Infos',
);

$this->menu=array(
	array('label'=>'Create DemoGameInfo', 'url'=>array('create')),
	array('label'=>'Manage DemoGameInfo', 'url'=>array('admin')),
);
?>

<h1>Demo Game Infos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
