<?php
/* @var $this PatternsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Patterns',
);

$this->menu=array(
	array('label'=>'Create Patterns', 'url'=>array('create')),
	array('label'=>'Manage Patterns', 'url'=>array('admin')),
);
?>

<div class="module width_3_quarter">
		<div class="header">
			<h3 class="tabs_involved">Pattern</h3>
		</div>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</div>