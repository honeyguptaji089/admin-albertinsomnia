<?php
/* @var $this CompetitionGameLevelController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Competition Game Levels',
);

$this->menu=array(
	array('label'=>'Create CompetitionGameLevel', 'url'=>array('create')),
	array('label'=>'Manage CompetitionGameLevel', 'url'=>array('admin')),
);
?>

<h1>Competition Game Levels</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
