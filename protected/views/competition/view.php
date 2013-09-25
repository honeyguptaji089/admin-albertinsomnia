<?php
/* @var $this CompetitionController */
/* @var $model Competition */

$this->breadcrumbs=array(
	'Competitions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Competition', 'url'=>array('index')),
	array('label'=>'Create Competition', 'url'=>array('create')),
	array('label'=>'Update Competition', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Competition', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Competition', 'url'=>array('admin')),
);
?>

<div class="module width_3_quarter">
		<div class="header">
			<h3 class="tabs_involved">View Competition <?php echo $model->id; ?></h3>
		</div>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'competition_name',
		'date',
	),
)); ?>
</div>
