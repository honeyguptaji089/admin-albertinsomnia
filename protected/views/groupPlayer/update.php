<?php
/* @var $this GroupPlayerController */
/* @var $model GroupPlayer */

$this->breadcrumbs=array(
	'Group Players'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List GroupPlayer', 'url'=>array('index')),
	array('label'=>'Create GroupPlayer', 'url'=>array('create')),
	array('label'=>'View GroupPlayer', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage GroupPlayer', 'url'=>array('admin')),
);
?>

<h1>Update GroupPlayer <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>