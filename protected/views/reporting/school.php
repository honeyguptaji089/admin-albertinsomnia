<?php
/* @var $this ReportingController */

$this->breadcrumbs=array(
	'DashBoard',
);

Yii::app()->clientScript->registerScript(
   'validateReportForm',
   '
	$("#report-form").submit(function(){
		var validate=true,message="<b>Solve all the input errors:</b><br/><br/>";
		
		if($("#slGrade").val()==="Select Grade"){
			validate=false;
			message+="Select Grade Name<br/>";
		}
		if($("#txtPeriod").val()===""){
			validate=false;
			message+="Period field can not be blank<br/>";
		}
		if($("#slType").val()==="Select Report Type"){
			validate=false;
			message+="Select Report Type<br/>";
		}
		if(validate)
		{
			return true;
		}	
		else
		{
			$("#validationMessage").show().html(message);
			return false;
		}
		
   });',
   CClientScript::POS_READY
);


?>
<script type="text/javascript" src="js/Chart.min.js"></script>


<?php 
	$form=$this->beginWidget('CActiveForm', array(
		'id'=>'report-form',
		'enableAjaxValidation'=>false,
		'enableClientValidation'=>true,
		'htmlOptions' => array('action'=>$this->createUrl('Reporting/teacher')),
	)); 
?>

<div id="validationMessage" style="display:none;" class="alert_warning"></div>	

<article class="module width_full">
	<div class="header">
	  <h3>Statistics</h3>
	</div>
	<div class="module_content">
		<div class="form">
			<fieldset >
				<label>Grade</label>
				<select name="Reporting[slSchoolGrade]" id="slGrade">
				<?php echo $this->schoolGrades; ?>
				</select>
			</fieldset>
			<fieldset>
				<label>Period:</label>
				<?php 
				$this->widget('application.extensions.EDateRangePicker.EDateRangePicker',array(
					'id'=>'txtPeriod',
					'language'=>'en-GB',
					'name'=>'Reporting[txtPeriod]',
					'options'=>array('arrows'=>true),
					'htmlOptions'=>array('class'=>'inputClass', 'autocomplete'=>'off', 'id'=>'txtPeriod','autofocus'=>'true')
					));
				?>
			</fieldset>
			<div class="clear"></div> 
			<?php echo CHtml::submitButton('Submit'); ?>
			<input type="reset" value="Cancel"/>
			<div class="report-container grid-view" style='height:100%;'>
				<?php echo $this->chartInfo; ?>
				<div style="width:100%;overflow-y:hidden;overflow-x:scroll;height:100%;"> 
					<canvas id="canvas" height="350" width="2500"></canvas>
				</div>
				<?php echo $this->Report; ?>
				<?php echo $this->chartScript; ?>
				
			</div>
			
		</div>
		</div>
	</div>
	<input type="hidden" id="txtFromDate" name="txtFromDate"/>
	<input type="hidden" id="txtToDate" name="txtToDate"/>
</article>


<?php $this->endWidget(); ?>
<style type="text/css">
.ui-daterangepicker-arrows {
	padding: 2px;
	width: 100%;
	position: relative;
	background: none;
	border: none;
	margin-left: -20px;
}
.ui-daterangepicker-arrows input.ui-rangepicker-input{
	height: 24px;
	width:100%;
	border-radius:0px;
	box-shadow:none;
}
.ui-daterangepicker-Today, .ui-daterangepicker-specificDate, .ui-daterangepicker-prev, .ui-daterangepicker-next{
	display:none;
}
</style>


<!--
	
<article class="module width_full">
	<div class="header">
	  <h3>Statistics</h3>
	</div>
	<div class="module_content">
		<article class="stats_graph">
			</article>
			
			<article class="stats_overview">
				<div class="overview_today">
					<p class="overview_day">Total Player</p>
					<p class="overview_count"><?php echo $this->total_player; ?></p>
					<p class="overview_day">Total Competition</p>
					<p class="overview_count"><?php echo $this->total_competition; ?></p>
					
				</div>
				<div class="overview_previous">
					<p class="overview_day">Total Teacher</p>
					<p class="overview_count"><?php echo $this->total_teacher;?></p>
					<p class="overview_day">Total Test</p>
					<p class="overview_count"><?php echo $this->total_tests; ?></p>
				</div>
			</article>
			<div class="clear"></div>
		</div>
	</article>
 -->