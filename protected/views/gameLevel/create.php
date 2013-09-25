<?php
/* @var $this GameLevelController */
/* @var $model GameLevel */

$this->breadcrumbs=array(
	'Game Levels'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List GameLevel', 'url'=>array('index')),
	array('label'=>'Manage GameLevel', 'url'=>array('admin')),
);

if(isset($_GET['message'])&&intVal($_GET['message'])){
	echo "<div class='".$this->message_type."'>".$this->message."</div>";
}
?>

<div class="module width_full">
	<div class="header">
	  <h3>Create Game Level</h3>
	</div>
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>