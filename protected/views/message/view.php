<?php
/* @var $this MessageController */
/* @var $model Message */

$this->breadcrumbs=array(
	'Messages'=>array('sent'),
);

$this->menu=array(
);
?>
<article class="module width_full message">
	<header style="padding: 8px 0px 0px 7px;height: 25px;width:99.3%;"><?php echo $model->subject; ?></header>
		<div class="module_content"> 
			<fieldset>
				<label>Subject</label>
				<span><?php echo $model->subject; ?></span>
			</fieldset>
			
			<fieldset>
				<label>To</label>
				<span><?php echo $model->to_string; ?></span>
			</fieldset>
			
			<fieldset>
				<label>From</label>
				<span><?php echo $model->from_string; ?></span>
			</fieldset>
			
			<fieldset>
				<label>When</label>
				<span>
				<?php 
					$st_timezone = str_replace("*", "+", $_COOKIE['YIITZ']);
					$valid_date=date('Y-m-d H:i:s', strtotime($model->date));
					$model->date=date('F j, Y, g:i A',strtotime($valid_date . $st_timezone));
					echo date("F j, Y, g:i A",strtotime($model->date)); 
				?>
				</span>
			</fieldset>
			
			<fieldset>
				<span style="padding: 5px;display:block;word-break: break-all;"><?php echo $model->message; ?></span>
			</fieldset>
		</div>
</div>
