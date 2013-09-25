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
	<header><h3>Inbox Messages (<?php echo $this->inboxMessgeCount ;?>)</h3></header>
	<div class="message_list">
		<div class="module_content">
			<?php 
				foreach($this->inboxData as $d){
					echo "<a href=".$this->createUrl('Message/view',array('id'=>$d->id))."><div class='message'><p>".$d->message."</p>
						<p><strong>".$d->from_string."</strong></p></div></a>";
				}
			?>
		</div>
	</div>
	<footer>
		<form class="post_message">
		</form>
	</footer>
</article>