<?php
/* @var $this PatternsController */
/* @var $model Patterns */

$this->breadcrumbs=array(
	'Patterns'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Patterns', 'url'=>array('index')),
	array('label'=>'Create Patterns', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('patterns-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

if(isset($_GET['message'])&&intVal($_GET['message'])){
	echo "<div class='".$this->message_type."'>".$this->message."</div>";
}

?>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<div class="module width_3_quarter">
		<div class="header">
			<h3 class="tabs_involved">View Patterns</h3>
			<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
		</div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'patterns-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'template'=>'{pager}{items}{pager}',
	'cssFile'=>Yii::app()->baseUrl.'/css/girdViewStyle.css',
	'columns'=>array(
		'id',
		'cards',
		'functions',
		'max_target',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}{delete}',
			'updateButtonImageUrl'=> Yii::app()->baseUrl.'/images/update.png',
			'deleteButtonImageUrl'=> Yii::app()->baseUrl.'/images/delete.png'
		),
	),
)); ?>
</div>
