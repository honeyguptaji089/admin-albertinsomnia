<?php
/* @var $this TeacherController */
/* @var $model Teacher */

$this->breadcrumbs=array(
	'Teachers'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Teacher', 'url'=>array('index')),
	array('label'=>'Create Teacher', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
	$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
	});
	$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('teacher-grid', {
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
			<h3 class="tabs_involved">View Teacher</h3>
		<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
	
		</div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'teacher-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'template'=>'{pager}{items}{pager}',
	'cssFile'=>Yii::app()->baseUrl.'/css/girdViewStyle.css',
	
	'columns'=>array(
		'id',
		'teacher_name',
		'teacher_address',
		'teacher_phone_no',
		'teacher_code',
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
