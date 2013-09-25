<?php
/* @var $this CompetitionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Competitions',
);

$this->menu=array(
	array('label'=>'Create Competition', 'url'=>array('create')),
	array('label'=>'Manage Competition', 'url'=>array('admin')),
);
?>

<div class="module width_3_quarter">
		<div class="header">
			<h3 class="tabs_involved">Competitions</h3>
		</div>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</div>