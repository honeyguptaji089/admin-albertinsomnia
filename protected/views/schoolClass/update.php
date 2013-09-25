<?php
/* @var $this SchoolClassController */
/* @var $model SchoolClass */

$this->breadcrumbs=array(
	'School Classes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SchoolClass', 'url'=>array('index')),
	array('label'=>'Create SchoolClass', 'url'=>array('create')),
	array('label'=>'View SchoolClass', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SchoolClass', 'url'=>array('admin')),
);
?>

<div class="module width_full">

	<div class="header">
	  <h3>Update School Class</h3>
	</div>


<?php echo $this->renderPartial('_updateForm', array('model'=>$model)); ?>

</div>