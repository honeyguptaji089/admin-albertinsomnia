<?php
/* @var $this PlayerController */
/* @var $model Player */

$this->breadcrumbs=array(
	'Players'=>array('index'),
	'Create',
);


if(isset($_GET['message'])&& intVal($_GET['message'])){
	echo "<div class='".$this->message_type."'>".$this->message."</div>";
}

?>
<div class="module width_full">

	<div class="header">
	  <h3>REGISTER for Albert Instomania 2.0</h3>
	</div>

<?php echo $this->renderPartial('_formOutside', array('model'=>$model)); ?>
</div>