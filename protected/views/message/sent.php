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
	<header><h3>Sent Messages (<?php echo $this->sentMessgeCount ;?>)</h3></header>
	<div class="message_list">
		<div class="module_content">
			<?php 
				foreach($this->sentData as $d){
					echo "<a href=".$this->createUrl('Message/view',array('id'=>$d->id))."><div class='message'><p><strong>".$d->to_string."</strong></p><p>".$d->message."</p>
						</div></a>";
				}
			?>
		</div>
	</div>
	<footer>
		<form class="post_message">
		</form>
	</footer>
</article>