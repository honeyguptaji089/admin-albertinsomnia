<?php
/* @var $this GroupPlayerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Group Players',
);

$this->menu=array(
	array('label'=>'Create GroupPlayer', 'url'=>array('create')),
	array('label'=>'Manage GroupPlayer', 'url'=>array('admin')),
);
?>

<h1>Group Players</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
