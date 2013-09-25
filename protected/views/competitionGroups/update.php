<?php
/* @var $this CompetitionGroupsController */
/* @var $model CompetitionGroups */

$this->breadcrumbs=array(
	'Competition Groups'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CompetitionGroups', 'url'=>array('index')),
	array('label'=>'Create CompetitionGroups', 'url'=>array('create')),
	array('label'=>'View CompetitionGroups', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CompetitionGroups', 'url'=>array('admin')),
);
?>

<h1>Update CompetitionGroups <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>