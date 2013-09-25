<?php
/* @var $this AdvertisementController */
/* @var $model Advertisement */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerScript(
   'validateAdvertisementForm',
   '
    $("#slAdPosition").change(function(){
		var el=$(this),ad=$("#ad-positions"), span=ad.find("span"), 
		span1=ad.find("span:nth-child(1)"),
		span2=ad.find("span:nth-child(2)"),
		span3=ad.find("span:nth-child(3)"),
		span4=ad.find("span:nth-child(4)");
		span.removeClass("active");
		switch(el.val()){
			case "Top":
				span1.addClass("active");
				break;
			case "Right":
				span2.addClass("active");
				break;
			case "Left":
				span3.addClass("active");
				break;
			case "Bottom":
				span4.addClass("active");
				break;
				
		}
	});
	$(".rdImageOption").change(function(obj){
		$("#divWebURL, #divCompURL").hide();
		if(parseInt(this.value)===0){
			$("#divWebURL").show();
		}
		else{
			$("#divCompURL").show();
		}
	});
	$("#advertisement-form").submit(function(){
		var validate=true,message="<b>Solve all the input errors:</b><br/><br/>",
		urlregex = new RegExp("^(http:\/\/www.|https:\/\/www.|ftp:\/\/www.|www.){1}([0-9A-Za-z]+\.)"),
		imageUrlRegex= new RegExp("\.(jpeg|jpg|gif|png)$"),
		adFile=$("#AdFile").val(),
		adfileExt=adFile.substring(adFile.lastIndexOf('.') + 1).toLowerCase();
		$("#validationMessage").html("");
		var radioName="ad_img_type";
		
		if($("#slSponsorName").val()==="Select Sponsor Name"){
			validate=false;
			message+="Select Sponsor Name<br/>";
		}
		if($("#txtAdName").val()==""){
			validate=false;
			message+="Advertisement Name can not be blank<br/>";
		}
		if($("#txtAdDes").val()==""){
			validate=false;
			message+="Advertisement Description can not be blank<br/>";
		}
		if($("#txtAdNavURL").val()==""){
			validate=false;
			message+="Advertisement URL can not be blank<br/>";
		}
		if(($("#txtAdNavURL").val()!="")&&(!urlregex.test($("#txtAdNavURL").val()))){
			validate=false;
			message+="Advertisement URL should be valid.<br/>";
		}
		if($("#slAdPosition").val()==="Select Position"){
			validate=false;
			message+="Select Advertisement Position<br/>";
		}
		if($(".rdImageOption:checked").length<1){
			validate=false;
			message+="Please Select option for adding Advertisement Image<br/>";
		}
		if(parseInt($(".rdImageOption:checked").val())===0){
			if($("#txtImageURL").val()==""){
				validate=false;
				message+="Write Advertisement Image URL<br/>";
			}
			if(($("#txtImageURL").val()!="")&&(!imageUrlRegex.test($("#txtImageURL").val()))){
				validate=false;
				message+="Advertisement Image URL should be valid.<br/>";
			}
		}
		if(parseInt($(".rdImageOption:checked").val())===1){
			if($("#AdFile").val()===""){
				validate=false;
				message+="Select Advertisement Image File<br/>";
			}
			if(adfileExt=="jpg"||adfileExt=="gif"||adfileExt=="png"){
				validate=false;
				message+="Select valid Advertisement Image File<br/>";
			}
			
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
		
   });',
   CClientScript::POS_READY
);


?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'advertisement-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); 


	$sponsor=Sponsor::model();
?>
<div class="module_content">
	
	<div id="validationMessage" style="display:none;" class="alert_warning">
	</div>	
	
	
	<div class="form">



	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<fieldset class="left">
		<?php echo $form->labelEx($sponsor,'sponsor_name'); ?>
		<?php echo CHtml::activeDropDownList($sponsor, 'id', $this->sponsor_array,array('id'=>'slSponsorName','autofocus'=>'true'));  ?>
		<?php echo $form->error($sponsor,'sponsor_name'); ?>
	</fieldset>
	<fieldset class="right">
		<?php echo $form->labelEx($model,'ad_name'); ?>
		<?php echo $form->textField($model,'ad_name',array('size'=>50,'maxlength'=>50,'id'=>'txtAdName')); ?>
		<?php echo $form->error($model,'ad_name'); ?>
	</fieldset>
	<fieldset class="left">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('maxlength'=>500,'id'=>'txtAdDes')); ?>
		<?php echo $form->error($model,'description'); ?>
	</fieldset>

	<fieldset class="right long">
		<?php echo $form->labelEx($model,'navigation_url'); ?>
		<?php echo $form->textField($model,'navigation_url',array('size'=>60,'maxlength'=>200,'id'=>'txtAdNavURL')); ?>
		<?php echo $form->error($model,'navigation_url'); ?>
	</fieldset>

	<fieldset class="left">
		<?php echo $form->labelEx($model,'position'); ?>
		<div id="ad-positions">
			<span>1</span>
			<span>2</span>
			<span>3</span>
			<span>4</span>
		</div>
		<?php echo CHtml::activeDropDownList($model, 'position', array('Select Position'=>'Select Position','Top'=>'Top-Left','Right'=>'Top-Right','Left'=>'Bottom-Left','Bottom'=>'Bottom-Right'),array('id'=>'slAdPosition','onchange=getAdposition(this);'));  ?>
		<?php echo $form->error($model,'position'); ?>
	</fieldset>
	<fieldset class="right">
		<label>Image Url <span class="required">*</span></label>
		<label>
			<input type="radio" name="Advertisement[ad_img_type]" class="rdImageOption" value="0" />From URL &nbsp;&nbsp;
			<input type="radio" name="Advertisement[ad_img_type]" class="rdImageOption" value="1" />From Computer
		</label>
		<div id="divWebURL">
			<input type="text" name='txtImageURL' size="60" maxlength="200" id='txtImageURL'/>
			
		</div>
		<div id="divCompURL">
			<?php echo $form->fileField($model, 'image_url',array('id'=>'AdFile')); ?>
			<label style="width:100%;">Accepted Image Format (.jpg, .jpeg, .gif, .png)</label>
			<?php echo $form->error($model,'image_url'); ?>
		</div>
	</fieldset>
	<div class="clear"></div>

		


</div>

<div class="footer">
	<div class="submit_link">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	<input type="reset" value="Cancel"/>
	</div>
</div>
</div>

<?php $this->endWidget(); ?>
