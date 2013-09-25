<?php
/* @var $this CompetitionGroupsController */
/* @var $model CompetitionGroups */

$this->breadcrumbs=array(
	'Competition Groups'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CompetitionGroups', 'url'=>array('index')),
	array('label'=>'Manage CompetitionGroups', 'url'=>array('admin')),
);
?>

<h1>Create CompetitionGroups</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>