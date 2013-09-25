<?php
/* @var $this SchoolGroupController */
/* @var $model SchoolGroup */

$this->breadcrumbs=array(
	'School Groups'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SchoolGroup', 'url'=>array('index')),
	array('label'=>'Manage SchoolGroup', 'url'=>array('admin')),
);
?>

<div class="module width_full">

	<div class="header">
	  <h3>Create Group</h3>
	</div>
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>