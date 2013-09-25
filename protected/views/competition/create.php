<?php
/* @var $this CompetitionController */
/* @var $model Competition */

$this->breadcrumbs=array(
	'Competitions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Competition', 'url'=>array('index')),
	array('label'=>'Manage Competition', 'url'=>array('admin')),
);
?>
<div class="module width_full">

	<div class="header">
	  <h3>Create Competition</h3>
	</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<div style="height:200px;"></div>
</div>