<?php
/* @var $this PlayerController */
/* @var $model Player */

$this->breadcrumbs=array(
	'Players'=>array('index'),
	'Manage',
);

$this->menu=array(
);

Yii::app()->clientScript->registerScript('search', "");


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
	'dataProvider'=>$model->outplayer(),
	'filter'=>$model,
	'template'=>'{pager}{items}{pager}',
	'cssFile'=>Yii::app()->baseUrl.'/css/girdViewStyle.css',
	'columns'=>array(
		'id',
		'player_name',
		'gender',
		'phone_no',
		'player_code',
		array(
			'header'=>'Payment Status',
			'name'=>'payment_status',
			'value'=>array($this,'getPaymentStatusValue'),
		),
		
	),
)); ?>
</div>