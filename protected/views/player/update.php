<?php
/* @var $this PlayerController */
/* @var $model Player */

$this->breadcrumbs=array(
	'Players'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Player', 'url'=>array('index')),
	array('label'=>'Create Player', 'url'=>array('create')),
	array('label'=>'View Player', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Player', 'url'=>array('admin')),
);
?>

<div class="module width_3_quarter">
		<div class="header">
			<h3 class="tabs_involved">Update Player</h3>
		</div>
<?php echo $this->renderPartial('_updateForm', array('model'=>$model)); ?>
</div>