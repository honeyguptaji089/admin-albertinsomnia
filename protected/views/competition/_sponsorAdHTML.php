<div class="sponsor">
	<?php $sponsor=Sponsor::model();?>
	<fieldset class="left sponsor_name">
		<label>Sponsor Name</label>
		<?php echo CHtml::activeDropDownList($sponsor,
												'sponsor_name',
												$this->sponsor,
												array(
													'ajax' => array(
														'type'=>'POST',
														'url'=>CController::createUrl('competition/Advertisement'),
														'update'=>'#slAdvertisement'.$this->ajaxSponsorCounter,
														'data'=>array('sponsor_name'=>'js:$(this).val()')
													),
													'id'=>'slSponsor'.$this->ajaxSponsorCounter,
													'name'=>'Competition[Sponsor][SponsorName][]'
													
													
												)
											); 
		?>
	</fieldset>
	<fieldset class="right">
		<label>SPONSOR AD <span class="required">*</span></label>
		<?php echo CHtml::dropDownList('Competition[Sponsor][Advertisement]['.$this->ajaxSponsorCounter.'][]','', array(),array('id'=>'slAdvertisement'.$this->ajaxSponsorCounter,'multiple'=>true)); ?>
	</fieldset>
	<script type="text/javascript">
		jQuery(function($) {
		var counter='<?php echo $this->ajaxSponsorCounter;?>',
		adFillURL='<?php echo CController::createUrl('competition/Advertisement');?>';
		$('body').on('change','#slSponsor'+counter,function(){jQuery.ajax({'type':'POST','url':adFillURL,'data':{'sponsor_name':$(this).val()},'cache':false,'success':function(html){jQuery("#slAdvertisement"+counter).html(html)}});return false;});

		});

	</script>
</div>