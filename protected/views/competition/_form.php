<?php
/* @var $this CompetitionController */
/* @var $model Competition */
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
		
		$("#btnDeleteSponsorInfo").click(function(){
			 var sponsorCount=$("#sponsorContainer .sponsor").length;
			if(sponsorCount>1){
				$("#sponsorContainer .sponsor:last").remove();
				var counterVal=parseInt($("#hdSponsorCounter").val())-1;
				$("#hdSponsorCounter").val(counterVal);
			}
		});
		
	$("#competition-form").submit(function(e){
		var validate=true,message="<b>Solve all the input errors:</b><br/><br/>";
		$("#validationMessage").html("");
		var groupSelectID="slGroup",adSelectID="slAdvertisement";
		var numbers=["First","Second","Third","Forth","Fifth","Sixth","Seventh","Eighth","Ninth","Tenth"];
		if($("#Competition_competition_name").val()==""){
			validate=false;
			message+="Competition Name can not be blank.<br/>";
		}
		if($("#slGameLevel").val()===null){
			validate=false;
			message+="Select at least one Game Level.<br/>";
		}
		else if($("#slGameLevel").val().length<1){
			validate=false;
			message+="Select at least one Game Level.<br/>";
		}
		if($("select[id^=slSchool]").length<2){
			validate=false;
			message+="Competition needs at least 2 Schools to be Selected.<br/>";
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
		var selectAdCollection=$("#sponsorContainer .sponsor select[id^="+adSelectID+"]");
		selectAdCollection.each(function(index, selectBox){
			if($(selectBox).val()===null){
				validate=false;
				message+=numbers[index]+" Advertisement Select Box needs to select at least one value.<br/>";
			}
			else if($(selectBox).val().length<1){
				validate=false;
				message+=index+" Advertisement Select Box needs to select at least one value.<br/>";
			}
		});
		if($("#Competition_date").val()==""){
			validate=false;
			message+="Competition Date can not be blank.<br/>";
		}
		if($("#competition_time").val()==""){
			validate=false;
			message+="Enter numeric Competition Time in minutes.<br/>";
		}
		if($("#competition_time").val()!="" && isNaN($("#competition_time").val())){
			validate=false;
			message+="Enter numeric Competition Time in minutes.<br/>";
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
		'id'=>'competition-form',
		'enableAjaxValidation'=>false,
		'enableClientValidation'=>true,
	)); 

		$game_level=GameLevel::model();
		$school=School::model();
		$sponsor=Sponsor::model();
		$advertisement=Advertisement::model();
?>
<div class="module_content">
	<div id="validationMessage" style="display:none;" class="alert_warning"></div>


			<div class="form">

			<p class="note">Fields with <span class="required">*</span> are required.</p>

			<?php echo $form->errorSummary($model); ?>

			<fieldset class="left comp_name">
				<?php echo $form->labelEx($model,'competition_name'); ?>
				<?php echo $form->textField($model,'competition_name',array('size'=>60,'maxlength'=>200,'autofocus'=>'true')); ?>
				<?php echo $form->error($model,'competition_name'); ?>
			</fieldset>
			
			<fieldset class="right">
				<label>game level <span class="required">*</span></label>
				<?php echo CHtml::activeDropDownList($game_level, 'id', $this->gameLevel,array('id'=>'slGameLevel','name'=>'Competition[GameLevel][]','multiple'=>'true'));  ?>
				<?php echo $form->error($game_level,'game_level'); ?>
			</fieldset>
			
			<div class="clear"></div>
			<div id="schoolGroupcontainer">
				<div class="schoolGroups">
					<fieldset class="left">
						<?php echo $form->labelEx($model,'school_name'); ?>
						<?php echo CHtml::activeDropDownList($model,
																'school_name',
																$this->school,
																array(
																	'ajax' => array(
																		'type'=>'POST',
																		'url'=>CController::createUrl('competition/Grade'),
																		'update'=>'#slGrade',
																		'data'=>array('school_name'=>'js:$(this).val()')
																	),
																	'id'=>'slSchool',
																	'name'=>'Competition[SchoolGroup][SchoolName][]'
																	
																)
															); 
						?>
						<?php echo $form->error($model,'school_name'); ?>
					</fieldset>
					
					<fieldset class="right">
						<?php echo $form->labelEx($model,'school_grade'); ?>
						<?php echo CHtml::activeDropDownList($model,
																'school_grade',
																array(),
																array(
																	'ajax' => array(
																		'type'=>'POST',
																		'url'=>CController::createUrl('competition/Class'),
																		'update'=>'#slClass',
																		'data'=>array('school_grade'=>'js:$(this).val()')
																	),
																	'id'=>'slGrade',
																	'name'=>'Competition[SchoolGroup][SchoolGrade][]'
																	
																	
																)
															); 
						?>
						<?php echo $form->error($model,'school_grade'); ?>
					</fieldset>
					
					<fieldset class="left school_class">
						<?php echo $form->labelEx($model,'school_class'); ?>
						<?php echo CHtml::activeDropDownList($model,
																'school_class',
																array(),
																array(
																	'ajax' => array(
																		'type'=>'POST',
																		'url'=>CController::createUrl('competition/Group'),
																		'update'=>'#slGroup',
																		'data'=>array('school_class'=>'js:$(this).val()')
																	),
																	'id'=>'slClass',
																	'name'=>'Competition[SchoolGroup][SchoolClass][]'
																	
																	
																)
															); 
						?>
						<?php echo $form->error($model,'school_class'); ?>
					</fieldset>
					
					<fieldset class="right">
						<label>school group <span class="required">*</span></label>
						<?php echo CHtml::dropDownList('Competition[SchoolGroup][GroupName][0][]','', array(),array('id'=>'slGroup','multiple'=>true)) ?>
						<?php echo $form->error($model,'school_group'); ?>
					</fieldset>
					
				</div>
			</div>	
			<div class="clear"></div>
			<div class="button-container">
				<input type="hidden" id="hdCounter" value="1"/>
				<?php echo CHtml::ajaxButton("Add School Information", 
								CController::createUrl('competition/Test'),
								array ( 
									'type'=>'POST',
									'data'=>array('counter'=>'js:$("#hdCounter").val()'),
									'success'=>'function(html){
									$("#schoolGroupcontainer").append(html);
									var counterVal=parseInt($("#hdCounter").val())+1;
									$("#hdCounter").val(counterVal);}'
								));
				?>
				<input type="button" value="Delete School Information" id="btnDeleteGroupInfo"/>
				
			</div>
			<div class="clear"></div>
			<div id="sponsorContainer">
				<div class="sponsor">
					<fieldset class="left sponsor_name">
						<?php echo $form->labelEx($sponsor,'sponsor_name'); ?>
						<?php echo CHtml::activeDropDownList($sponsor,
																'sponsor_name',
																$this->sponsor,
																array(
																	'ajax' => array(
																		'type'=>'POST',
																		'url'=>CController::createUrl('competition/Advertisement'),
																		'update'=>'#slAdvertisement',
																		'data'=>array('sponsor_name'=>'js:$(this).val()')
																	),
																	'id'=>'slSponsor',
																	'name'=>'Competition[Sponsor][SponsorName][]'
																	
																	
																)
															); 
						?>
						<?php echo $form->error($sponsor,'sponsor_name'); ?>
					</fieldset>
					<fieldset class="right">
						<label>Sponsor Ad <span class="required">*</span></label>
						<?php echo CHtml::dropDownList('Competition[Sponsor][Advertisement][0][]','', array(),array('id'=>'slAdvertisement','multiple'=>true)) ?>
						<?php echo $form->error($advertisement,'sponsor_ad'); ?>
					</fieldset>
				</div>	
			</div>
			<div class="clear"></div>
			<div class="button-container">
				<input type="hidden" id="hdSponsorCounter" value="1"/>
				<?php echo CHtml::ajaxButton("Add Sponsor Information", 
								CController::createUrl('competition/Sponsor'),
								array ( 
									'type'=>'POST',
									'data'=>array('counter'=>'js:$("#hdSponsorCounter").val()'),
									'success'=>'function(html){
									$("#sponsorContainer").append(html);
									var counterVal=parseInt($("#hdSponsorCounter").val())+1;
									$("#hdCounter").val(counterVal);}'
								));
				?>
				<input type="button" value="Delete Sponsor Information" id="btnDeleteSponsorInfo"/>
				
			</div>
			<div class="clear"></div>
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
							'name'=>'Competition[date]',
						), 

					));
				?>
				<?php echo $form->error($model,'date'); ?>
			</div>
			<fieldset class="right" style="margin-top: -11px;margin-right: 21px;">
				<?php echo $form->labelEx($model,'competition_time'); ?>
				<?php echo $form->textField($model,'competition_time',array('id'=>'competition_time', 'size'=>60,'maxlength'=>200,'style'=>'width:280px !important')); ?> &nbsp; <b style="display: block;margin-top: 9px;clear: right;">min</b>
				<?php echo $form->error($model,'competition_time'); ?>
			</fieldset>
			<fieldset class="left" style="margin-left: 10px;">
				<?php echo $form->checkBox($model,'limited_time_target',array('id'=>'limited_time_target')); ?> &nbsp; <label> Allow limited time Targets </label>
			</fieldset>
			
			<div class="clear"></div>
			
		</div><!-- form -->
	
		<div class="footer">
			<div class="submit_link">
			 <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('id'=>'btnSubmit')); ?>
			<input type="reset" value="Cancel"/>
			</div>
		</div>
		

</div>
<?php $this->endWidget(); ?>
	