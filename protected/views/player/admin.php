<?php
/* @var $this PlayerController */
/* @var $model Player */

$this->breadcrumbs=array(
	'Players'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Player', 'url'=>array('index')),
	array('label'=>'Create Player', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('player-grid', {
		data: $(this).serialize()
	});
	return false;
});
");


?>

<div class="module width_full">
	<div class="header">
	  <h3>View Players</h3>
	  <?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
	</div>


<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'player-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'template'=>'{pager}{items}{pager}',
	'cssFile'=>Yii::app()->baseUrl.'/css/girdViewStyle.css',
	'columns'=>array(
		'id',
		'player_name',
		array(
			'header'=>'Class',
			'name'=>'player_class_id_fk',
			'value'=>array($this,'getClassName')
		),
		
		'gender',
		'phone_no',
		'player_code',
		array(
			'header'=>'Email',
			'name'=>'user_id_fk',
			'value'=>'$data->userIdFk->email'
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}{delete}',
			'updateButtonImageUrl'=> Yii::app()->baseUrl.'/images/update.png',
			'deleteButtonImageUrl'=> Yii::app()->baseUrl.'/images/delete.png'
		),
	),
)); ?>
</div>