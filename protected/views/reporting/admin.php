<?php
/* @var $this ReportingController */

$this->breadcrumbs=array(
	'DashBoard',
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

<script type="text/javascript" src="js/Chart.min.js"></script>

<article class="module width_full">
	<div class="header">
	  <h3>Statistics</h3>
	</div>
	<div class="module_content">
		<article class="stats_graph">
			<canvas id="canvas" height="240" width="520" style="margin: 10px;"></canvas>
		</article>
		
		<article class="stats_overview">
			<div class="overview_today">
				<p class="overview_day">Total School</p>
				<p class="overview_count"><?php echo $this->total_school; ?></p>
			<p class="overview_day">Total Payment</p>
				<p class="overview_count"><?php echo $this->total_payment; ?></p>
				
			</div>
			<div class="overview_previous">
				<p class="overview_day">Total Renewal</p>
				<p class="overview_count">N/A</p>
			</div>
		</article>
		<div class="clear"></div>
	</div>
</article>
<script type="text/javascript">
	var lineChartData = {
			labels : ["July, 2013","<?php echo date("d F, Y");?>"],
			datasets : [
				{
					fillColor : "rgba(220,220,220,0.5)",
					strokeColor : "rgba(220,220,220,1)",
					pointColor : "rgba(220,220,220,1)",
					pointStrokeColor : "#fff",
					data : [0,<?php echo $this->total_school; ?>]
				},
				{
					fillColor : "rgba(151,187,205,0.5)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					data : [0,<?php echo $this->total_payment; ?>]
				}
			]
			
		}

	var myLine = new Chart(document.getElementById("canvas").getContext("2d")).Line(lineChartData);
	
</script>
