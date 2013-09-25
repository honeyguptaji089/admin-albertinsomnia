<?php
/* @var $this TestController */
/* @var $model Test */

$this->breadcrumbs=array(
	'Tests'=>array('index'),
);

$this->menu=array(
	array('label'=>'List Test', 'url'=>array('index')),
	array('label'=>'Create Test', 'url'=>array('create')),
);

if(isset($_GET['message'])&&intVal($_GET['message'])){
	echo "<div class='".$this->message_type."'>".$this->message."</div>";
}

?>

<div class="module width_3_quarter">
	<div class="header">
		<h3 class="tabs_involved">Test Timeing in Different Areas</h3>
	</div>
	<div class="module_content">
		<div class="form">
		<fieldset >
			<label>Test Name : </label>
			<span><?php echo $model->test_name; ?></span>
		</fieldset>
		<?php
			if(isset($_COOKIE['YIITZ'])){
			$timezoneSting=str_replace("*", "+", $_COOKIE['YIITZ']);
		?>
			<fieldset >
				<label>Test Time at Your Location : </label>
				<span><?php echo date('F j, Y, g:i A',strtotime($model->date .$timezoneSting)); ?></span>
			</fieldset>
		<?php
			}
		?>
		</div>
		<table class="items timeTable">
			<thead>
				<tr>
					<th>Area</th>
					<th>Differece from GMT 00:00</th>
					<th>Expected Time</th>
				</tr>
			</thead>
			<tbody>
				<?php		
					foreach ($this->timearray as $key => $value)
					{
						echo "<tr>";
						echo "	<td>".$key."</td>";
						echo "	<td>".$value."</td>";
						echo "	<td>".date('F j, Y, g:i A',strtotime($this->gmtTestTime . $value))."</td>";
						echo "</tr>";
					}
			
				?>
			</tbody>
		</table>
		
	</div>
</div>