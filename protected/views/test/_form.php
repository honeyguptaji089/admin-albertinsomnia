<?php
/* @var $this TestController */
/* @var $model Test */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerScript(
   'validateAdvertisementForm',
   '
  
		$("#btnDeleteGroupInfo").click(function(){
			 var groupCount=$("#schoolGroupcontainer .schoolGroups").length;
			if(groupCount>1){
				$("#schoolGroupcontainer .schoolGroups:last").remove();
				var counterVal=parseInt($("#hdCounter").val())-1;
				$("#hdCounter").val(counterVal);
			}
		});
		
	
		
	$("#test-form").submit(function(e){
		var validate=true,message="<b>Solve all the input errors:</b><br/><br/>";
		$("#validationMessage").html("");
		var groupSelectID="slGroup",adSelectID="slAdvertisement";
		var numbers=["First","Second","Third","Forth","Fifth","Sixth","Seventh","Eighth","Ninth","Tenth"];
		if($("#txtTestName").val()==""){
			validate=false;
			message+="Test Name can not be blank.<br/>";
		}
		if($("#txtTestDes").val()==""){
			validate=false;
			message+="Test Description can not be blank.<br/>";
		}
		if($("#slGameLevel").val()===null){
			validate=false;
			message+="Select at least one Game Level.<br/>";
		}
		else if($("#slGameLevel").val().length<1){
			validate=false;
			message+="Select at least one Game Level.<br/>";
		}
		var selectCollection=$("#schoolGroupcontainer .schoolGroups select[id^="+groupSelectID+"]");
		selectCollection.each(function(index, selectBox){
			if($(selectBox).val()===null){
				validate=false;
				message+=numbers[index]+" Group Select Box needs to select at least one value.<br/>";
			}
			else if($(selectBox).val().length<1){
				validate=false;
				message+=index+" Group needs to select at least one value.<br/>";
			}
		});
		if($("#txtTestDate").val()==""){
			validate=false;
			message+="Competition Date can not be blank.<br/>";
		}
		if($("#txtTestTime").val()==""){
			validate=false;
			message+="Test Time can not be blank.<br/>";
		}
		if(isNaN($("#txtTestTime").val())){
			validate=false;
			message+="Test Time should be Number.<br/>";
		}
		if(parseInt($("#txtTestTime").val())>60){
			validate=false;
			message+="Test Time should be less than 60 minutes.<br/>";
		}
		
		if(validate)
		{
			return true;
		}	
		else
		{
			$("#validationMessage").show().append(message);
			return false;
		}
		
	});
	
   ',
   CClientScript::POS_READY
);


?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'test-form',
	'enableAjaxValidation'=>false,
)); 
	$game_level=GameLevel::model();
	
	
?>
<div class="module_content">
	<div id="validationMessage" style="display:none;" class="alert_warning">
	</div>	
	<div class="form">


		<p class="note">Fields with <span class="required">*</span> are required.</p>

		<?php echo $form->errorSummary($model); ?>

		<fieldset class="left" style="height: 134px;">
			<?php echo $form->labelEx($model,'test_name'); ?>
			<?php echo $form->textField($model,'test_name',array('size'=>60,'maxlength'=>200,'id'=>'txtTestName','autofocus'=>'true')); ?>
			<?php echo $form->error($model,'test_name'); ?>
		</fieldset>

		<fieldset class="right">
			<?php echo $form->labelEx($model,'test_description'); ?>
			<?php echo $form->textArea($model,'test_description',array('size'=>60,'maxlength'=>45,'id'=>'txtTestDes')); ?>
			<?php echo $form->error($model,'test_description'); ?>
		</fieldset>
		<fieldset style="clear:both;">
			<label>game level <span class="required">*</span></label>
			<?php echo CHtml::activeDropDownList($game_level, 'id', $this->gameLevel,array('id'=>'slGameLevel','name'=>'Test[GameLevel][]','multiple'=>'true'));  ?>
			<?php echo $form->error($game_level,'game_level'); ?>
		</fieldset>
		<div id="schoolGroupcontainer">
				<div class="schoolGroups">
					<fieldset class="left">
						<?php echo $form->labelEx($model,'school_grade'); ?>
						<?php echo CHtml::activeDropDownList($model,
																'school_grade',
																$this->schoolGrades,
																array(
																	'ajax' => array(
																		'type'=>'POST',
																		'url'=>CController::createUrl('competition/Class'),
																		'update'=>'#slClass',
																		'data'=>array('school_grade'=>'js:$(this).val()')
																	),
																	'id'=>'slGrade',
																	'name'=>'Test[SchoolGroup][SchoolGrade][]'
																	
																	
																)
															); 
						?>
						<?php echo $form->error($model,'school_grade'); ?>
					</fieldset>
					
					<fieldset class="right">
						<?php echo $form->labelEx($model,'school_class'); ?>
						<?php echo CHtml::activeDropDownList($model,
																'school_class',
																array(),
																array(
																	'ajax' => array(
																		'type'=>'POST',
																		'url'=>CController::createUrl('test/Group'),
																		'update'=>'#slGroup',
																		'data'=>array('school_class'=>'js:$(this).val()')
																	),
																	'id'=>'slClass',
																	'name'=>'Test[SchoolGroup][SchoolClass][]'
																	
																	
																)
															); 
						?>
						<?php echo $form->error($model,'school_class'); ?>
					</fieldset>
					
					<fieldset style="clear:left;">
						<label>school group <span class="required">*</span></label>
						<?php echo CHtml::dropDownList('Test[SchoolGroup][GroupName][0][]','', array(),array('id'=>'slGroup','multiple'=>true)) ?>
						<?php echo $form->error($model,'school_group'); ?>
					</fieldset>
					
				</div>
		</div>
		<div class="clear"></div>
			<div class="button-container">
				<input type="hidden" id="hdCounter" value="1"/>
				<?php echo CHtml::ajaxButton("Add Group Information", 
								CController::createUrl('test/AjaxAddGroup'),
								array ( 
									'type'=>'POST',
									'data'=>array('counter'=>'js:$("#hdCounter").val()'),
									'success'=>'function(html){
									$("#schoolGroupcontainer").append(html);
									var counterVal=parseInt($("#hdCounter").val())+1;
									$("#hdCounter").val(counterVal);}'
								));
				?>
				<input type="button" value="Delete Group Information" id="btnDeleteGroupInfo"/>
				
			</div>		
		<fieldset class="left">
			<?php echo $form->labelEx($model,'date'); ?>
			<?php
				Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
					$this->widget('CJuiDateTimePicker',array(
					'model'=>$model, //Model object
					'attribute'=>'date', 
					'mode'=>'datetime' ,
					'language'=>'en-GB',
					'options'=>array(
						'showAnim'=>'fold',
						'dateFormat'=>'yy-mm-dd',
						'timeFormat'=>'hh:mm:ss',
						'minDate'=>'funtion(){
							 var date = new Date();
							 var currentMonth = date.getMonth();
							 var currentDate = date.getDate();
							 var currentYear = date.getFullYear();
							 return  new Date(currentYear, currentMonth, currentDate);
						}'
					),
					'htmlOptions'=>array(
						'style'=>'height:20px;',
						'name'=>'Test[date]',
						'id'=>'txtTestDate'
					), 

				));
			?>
			<?php echo $form->error($model,'date'); ?>
		</div>
		<fieldset class="right" style="height: 47px;margin-top: -10px;margin-right: 11px;width: 46%;">
			<label>time allowed for test (min) <span class="required">*</span></label>
			<?php echo $form->textField($model,'time_allowed',array('size'=>60,'maxlength'=>200,'id'=>'txtTestTime')); ?>
			<?php echo $form->error($model,'time_allowed'); ?>
		</fieldset>	
		<fieldset class="left" style="margin-left: 10px;">
				<?php echo $form->checkBox($model,'limited_time_target',array('id'=>'limited_time_target')); ?> &nbsp; <label> Allow limited time Targets </label>
			</fieldset>
		<div class="clear"></div>



	</div><!-- form -->
	
	<div class="footer">
		<div class="submit_link">
		 <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		<input type="reset" value="Cancel"/>
		</div>
	</div>
</div>
<?php $this->endWidget(); ?>
<div style="height: 200px;"></div>