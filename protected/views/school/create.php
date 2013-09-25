<?php
/* @var $this SchoolController */
/* @var $model School */

$this->breadcrumbs=array(
	'Schools'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List School', 'url'=>array('index')),
	array('label'=>'Manage School', 'url'=>array('admin')),
);
?>
<div class="module width_full">

	<div class="header">
	  <h3>Create School Admin</h3>
	</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>