<div class="schoolGroups">
	<fieldset class="left">
		<label>School Name</label>
		<?php
		$model=Competition::model();
		echo CHtml::activeDropDownList($model,
												'school_name',
												$this->school,
												array(
													'ajax' => array(
														'type'=>'POST',
														'url'=>CController::createUrl('competition/Grade'),
														'update'=>'#slGrade'.$this->ajaxCounter,
														'data'=>array('school_name'=>'js:$(this).val()')
													),
													'id'=>'slSchool'.$this->ajaxCounter,
													'name'=>'Competition[SchoolGroup][SchoolName][]'
													
												)
											); 
		?>
	</fieldset>
	
	<fieldset class="right">
		<label>School Grade</label>
		<?php echo CHtml::activeDropDownList($model,
												'school_grade',
												array(),
												array(
													'ajax' => array(
														'type'=>'POST',
														'url'=>CController::createUrl('competition/Class'),
														'update'=>'#slClass'.$this->ajaxCounter,
														'data'=>array('school_grade'=>'js:$(this).val()')
													),
													'id'=>'slGrade'.$this->ajaxCounter,
													'name'=>'Competition[SchoolGroup][SchoolGrade][]'
													
												)
											); 
		?>
	</fieldset>
	
	<fieldset class="left school_class">
		<label>School Class</label>
		<?php echo CHtml::activeDropDownList($model,
												'school_class',
												array(),
												array(
													'ajax' => array(
														'type'=>'POST',
														'url'=>CController::createUrl('competition/Group'),
														'update'=>'#slGroup'.$this->ajaxCounter,
														'data'=>array('school_class'=>'js:$(this).val()')
													),
													'id'=>'slClass'.$this->ajaxCounter,
													'name'=>'Competition[SchoolGroup][SchoolClass][]'
													
													
												)
											); 
		?>
	</fieldset>
	
	<fieldset class="right">
		<label>School Groups <span class="required">*</span></label>
		<?php echo CHtml::dropDownList('Competition[SchoolGroup][GroupName]['.$this->ajaxCounter.'][]','', array(),array('id'=>'slGroup'.$this->ajaxCounter,'multiple'=>true)) ?>
	</fieldset>
	
</div>
<script type="text/javascript">

jQuery(function($) {
var counter='<?php echo $this->ajaxCounter;?>',
gradeFillURL='<?php echo CController::createUrl('competition/Grade');?>';
classFillURL='<?php echo CController::createUrl('competition/Class');?>';
groupFillURL='<?php echo CController::createUrl('competition/Group');?>';
$('body').on('change','#slSchool'+counter,function(){jQuery.ajax({'type':'POST','url':gradeFillURL,'data':{'school_name':$(this).val()},'cache':false,'success':function(html){jQuery("#slGrade"+counter).html(html)}});return false;});
$('body').on('change','#slGrade'+counter,function(){jQuery.ajax({'type':'POST','url':classFillURL,'data':{'school_grade':$(this).val()},'cache':false,'success':function(html){jQuery("#slClass"+counter).html(html)}});return false;});
$('body').on('change','#slClass'+counter,function(){jQuery.ajax({'type':'POST','url':groupFillURL,'data':{'school_class':$(this).val()},'cache':false,'success':function(html){jQuery("#slGroup"+counter).html(html)}});return false;});

});

</script>