<?php
/* @var $this TestGroupsController */
/* @var $model TestGroups */

$this->breadcrumbs=array(
	'Test Groups'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List TestGroups', 'url'=>array('index')),
	array('label'=>'Create TestGroups', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('test-groups-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Test Groups</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'test-groups-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'template'=>'{pager}{items}{pager}',
	'cssFile'=>Yii::app()->baseUrl.'/css/girdViewStyle.css',
	'columns'=>array(
		'id',
		'test_id_fk',
		'group_id_fk',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}{delete}',
			'updateButtonImageUrl'=> Yii::app()->baseUrl.'/images/update.png',
			'deleteButtonImageUrl'=> Yii::app()->baseUrl.'/images/delete.png'
		),
	),
)); ?>
