<?php
/* @var $this TestGameLevelController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Test Game Levels',
);

$this->menu=array(
	array('label'=>'Create TestGameLevel', 'url'=>array('create')),
	array('label'=>'Manage TestGameLevel', 'url'=>array('admin')),
);
?>

<h1>Test Game Levels</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
