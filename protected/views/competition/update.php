<?php
/* @var $this CompetitionController */
/* @var $model Competition */

$this->breadcrumbs=array(
	'Competitions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Competition', 'url'=>array('index')),
	array('label'=>'Create Competition', 'url'=>array('create')),
	array('label'=>'View Competition', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Competition', 'url'=>array('admin')),
);
?>

<div class="module width_full">
	<div class="header">
	  <h3>Update Competition</h3>
	</div>
<?php echo $this->renderPartial('_updateForm', array('model'=>$model)); ?>
<div style="height:150px"></div>
</div>