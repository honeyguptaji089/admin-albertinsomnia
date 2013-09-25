<?php
/* @var $this AdvertisementController */
/* @var $model Advertisement */

if(intVal(Yii::app()->user->user_type)==1){
	$this->breadcrumbs=array();
}
else{
	$this->breadcrumbs=array(
		'Advertisements'=>array('index'),
		'Manage',
	);

}	

Yii::app()->clientScript->registerScript('search', "

$('.ad-image').click(function(){
	var obj=$(this);
	var ad_url=obj.attr('src');
	$('#ad-image-dialog .content').css('background-image','url('+ad_url+')');
	$('#update-img-btn').attr('href',$('#update-img-btn').attr('href')+'&id='+obj.parents('tr').find('td:first-child').html());
	$('#ad-image-dialog').show();
	return false;
});
$(document).click(function(){
	$('#ad-image-dialog').hide();
});
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('advertisement-grid', {
		data: $(this).serialize()
	});
	return false;
});
$('.grid-view .items tbody input[type=checkbox]').change(function(){
	var checkedItems=$('.grid-view .items tbody input[type=checkbox]:checked').length;
	if(checkedItems>1){
		$('.btn-ajax').show();
	}
	else{
		$('.btn-ajax').hide();
	}
});

$('#Id_all').click(function(){
	if($('.btn-ajax').is(':visible')){
		$('.btn-ajax').hide();
	}
	else{
		$('.btn-ajax').show();
	}
});
$('.btn-ajax').click(function(){
	return confirm('Are you sure wants to Delete Selected Records');
});
");

if(isset($_GET['message'])&&intVal($_GET['message'])){
	echo "<div class='".$this->message_type."'>".$this->message."</div>";
}
	
	
?>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<form action="" method="post">
	<div class="module width_3_quarter">
			<div class="header">
				<h3 class="tabs_involved">View Advertisement</h3>
				<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
			</div>
	<?php 
		$id=0;
		if(intVal(Yii::app()->user->user_type)==1){
			$user_id=intVal(Yii::app()->user->user_id);
			$SponsorModel=new Sponsor;
			$id=$SponsorModel->find(array('select'=>'id','condition'=>'user_id_fk=:user_id_fk','params'=>array(':user_id_fk'=>$user_id)))->id;
			$SponsorModel=null;
			$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'advertisement-grid',
				'dataProvider'=>$model->search($id),
				'filter'=>$model,
				'template'=>'{pager}{items}{pager}',
				'cssFile'=>Yii::app()->baseUrl.'/css/girdViewStyle.css',
		
				'columns'=>array(
					'id',
					'ad_name',
					'description',
					'navigation_url',
					'position',
					array(
						'header'=>'Image',
						'name'=>'image_url',
						'value'=>'CHtml::image($data->image_url,"Advertisement Icon",array("height"=>"20","width"=>"50"))',
						'type'=>'raw'
					),
					//Show Sponsor name in Column
					array(
						'header'=>'Sponsor',
						'name'=>'sponsor_id_fk',
						'value'=>'$data->sponsorIdFk->sponsor_name'
					),
					array(
						'class'=>'CButtonColumn',
						'template' => '',
					),
				),
			)); 
		}
		else
		{
			echo "<p id='msgSuccess' style='display:none;margin:10px;'>Advertisements Deleted Sucessfully </p>";
			echo CHtml::ajaxSubmitButton(
							'Delete Selected Advertisement',
							array('advertisement/ajaxupdate','act'=>'doDelete'),
							array('success'=>'function(data){ 
											if(data=="Data Deleted Successfully")
												$.fn.yiiGridView.update("advertisement-grid");
												$(".btn-ajax").hide();
												$("#msgSuccess").show();
										}', 
								   'error'=>'function(){
										alert("An Unexpected Error Occurs While Processing your Request");
									}
								'),
							array('class'=>'btn-ajax')
						);
			$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'advertisement-grid',
				'dataProvider'=>$model->search($id),
				'filter'=>$model,
				'template'=>'{pager}{items}{pager}',
				'cssFile'=>Yii::app()->baseUrl.'/css/girdViewStyle.css',
				'columns'=>array(
					array(
						'id'=>'Id',
						'class'=>'CCheckBoxColumn',
						'selectableRows' => '50'
					),
					'id',
					'ad_name',
					'description',
					'navigation_url',
					'position',
					array(
						'header'=>'Image',
						'name'=>'image_url',
						'value'=>'CHtml::image($data->image_url,"Advertisement Icon",array("height"=>"20","width"=>"50","class"=>"ad-image",
							 "title"=>"Preview Image","style"=>"cursor:pointer;"
						))',
						'type'=>'raw',
						'filter'=>''
					),
					//Show Sponsor name in Column
					array(
						'header'=>'Sponsor',
						'name'=>'sponsor_id_fk',
						'value'=>'$data->sponsorIdFk->sponsor_name'
					),
					array(
						'class'=>'CButtonColumn',
					'template'=>'{update}{delete}',
					'updateButtonImageUrl'=> Yii::app()->baseUrl.'/images/update.png',
					'deleteButtonImageUrl'=> Yii::app()->baseUrl.'/images/delete.png'
					),
				),
			)); 
			
		}
		?>
	</div>
	<div class="dialog" id="ad-image-dialog">
		<p class="header">Advertisement Image
		<a class="button" href="<?php echo CController::createUrl('Advertisement/ImageUpdate');?>" id="update-img-btn">Update Image</a>
		</p>
		<div class="content"></div>
	</div>
</form>