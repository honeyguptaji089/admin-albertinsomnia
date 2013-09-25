<?php
/* @var $this MessageController */
/* @var $model Message */

$this->breadcrumbs=array(
	'Messages'=>array('sent'),
	'Create',
);

$this->menu=array(
);


Yii::app()->clientScript->registerScript('scriptId', "
	function split(val) {
		return val.split(/,\s*/);
	}
	function extractLast(term) {
		return split(term).pop();
	}
	
", CClientScript::POS_HEAD);

?>

<article class="module width_full message">
	<header>
	  <h3>Send Message</h3>
	</header>
		<div class="module_content">
			<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
		</div>
</article>