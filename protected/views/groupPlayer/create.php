<?php
/* @var $this GroupPlayerController */
/* @var $model GroupPlayer */

$this->breadcrumbs=array(
	'Group Players'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List GroupPlayer', 'url'=>array('index')),
	array('label'=>'Manage GroupPlayer', 'url'=>array('admin')),
);
?>

<h1>Create GroupPlayer</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>