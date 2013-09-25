<?php
/* @var $this SchoolClassController */
/* @var $model SchoolClass */

$this->breadcrumbs=array(
	'School Class'=>array('index'),
	'Create',
);





?>

<div class="module width_full">

	<div class="header">
	  <h3>Create School Class</h3>
	</div>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</div>