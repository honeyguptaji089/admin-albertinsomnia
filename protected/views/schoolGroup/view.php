<?php
/* @var $this SchoolGroupController */
/* @var $model SchoolGroup */

$this->breadcrumbs=array(
	'School Groups'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SchoolGroup', 'url'=>array('index')),
	array('label'=>'Create SchoolGroup', 'url'=>array('create')),
	array('label'=>'Update SchoolGroup', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SchoolGroup', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SchoolGroup', 'url'=>array('admin')),
);
?>

<div class="module width_3_quarter">
		<div class="header">
			<h3 class="tabs_involved">View SchoolGroup <?php echo $model->id; ?></h3>
		</div>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'group_name',
		'class_id_fk',
		'is_competition_group',
	),
)); ?>
</div>