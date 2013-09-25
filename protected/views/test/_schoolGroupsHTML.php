<?php $model=Test::model();?>
<div class="schoolGroups">
	
	<fieldset class="left">
		<label>School Grade</label>
		<?php echo CHtml::activeDropDownList($model,
												'school_grade',
												$this->schoolGrades,
												array(
													'ajax' => array(
														'type'=>'POST',
														'url'=>CController::createUrl('competition/Class'),
														'update'=>'#slClass'.$this->ajaxCounter,
														'data'=>array('school_grade'=>'js:$(this).val()')
													),
													'id'=>'slGrade'.$this->ajaxCounter,
													'name'=>'Test[SchoolGroup][SchoolGrade][]'
													
												)
											); 
		?>
	</fieldset>
	
	<fieldset class="right">
		<label>School Class</label>
		<?php echo CHtml::activeDropDownList($model,
												'school_class',
												array(),
												array(
													'ajax' => array(
														'type'=>'POST',
														'url'=>CController::createUrl('test/Group'),
														'update'=>'#slGroup'.$this->ajaxCounter,
														'data'=>array('school_class'=>'js:$(this).val()')
													),
													'id'=>'slClass'.$this->ajaxCounter,
													'name'=>'Test[SchoolGroup][SchoolClass][]'
													
													
												)
											); 
		?>
	</fieldset>
	
	<fieldset style="clear:left;">
		<label>School Groups <span class="required">*</span></label>
		<?php echo CHtml::dropDownList('Test[SchoolGroup][GroupName]['.$this->ajaxCounter.'][]','', array(),array('id'=>'slGroup'.$this->ajaxCounter,'multiple'=>true)) ?>
	</fieldset>
	
</div>
<script type="text/javascript">

jQuery(function($) {
var counter='<?php echo $this->ajaxCounter;?>',
classFillURL='<?php echo CController::createUrl('competition/Class');?>';
groupFillURL='<?php echo CController::createUrl('test/Group');?>';
$('body').on('change','#slGrade'+counter,function(){jQuery.ajax({'type':'POST','url':classFillURL,'data':{'school_grade':$(this).val()},'cache':false,'success':function(html){jQuery("#slClass"+counter).html(html)}});return false;});
$('body').on('change','#slClass'+counter,function(){jQuery.ajax({'type':'POST','url':groupFillURL,'data':{'school_class':$(this).val()},'cache':false,'success':function(html){jQuery("#slGroup"+counter).html(html)}});return false;});

});

</script>