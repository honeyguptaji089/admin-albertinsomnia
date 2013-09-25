<script type="text/javascript">
	
</script>
<?php
	Yii::app()->clientScript->registerScript(
   'searchScript',
   '
	 
		(function ($) {
		  // custom css expression for a case-insensitive contains()
		  jQuery.expr[":"].Contains = function(a,i,m){
			  return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase())>=0;
		  };


		  function listFilter(header, list) { // header is any element, list is an unordered list
			// create and add the filter form to the header
			var form = $("<form>").attr({"class":"filterform quick_search","action":"#"}),
				input = $("<input>").attr({"class":"filterinput","type":"text","placeholder":"Quick Search"});
			$(form).append(input).appendTo(header);

			$(input)
			  .change( function () {
				var filter = $(this).val();
				if(filter) {
				  // this finds all links in a list that contain the input,
				  // and hide the ones not containing the input while showing the ones that do
				  $(list).find("a:not(:Contains(" + filter + "))").parent().slideUp();
				  $(list).find("a:Contains(" + filter + ")").parent().slideDown();
				} else {
				  $(list).find("li").slideDown();
				}
				return false;
			  })
			.keyup( function () {
				// fire the above change event after every letter
				$(this).change();
			});
		  }


		  //ondomready
		  $(function () {
			listFilter($("#divSearch"), $("#menu1"));
		  });
		}(jQuery));

		
	
   ',
   CClientScript::POS_END
);


?>
<?php $this->beginContent('//layouts/main')?>
	<div id="header">
			<h1 class="site_title"><a href="index.html">Welcome <?php
			switch (Yii::app()->user->user_type){
				case 1:echo "Sponsor";
					  break;
				case 2:echo "School";
					  break;
				case 3:echo "Player";
					  break;
				case 4:echo "Teacher";
					  break;
				case 5:echo "Super Admin";
					  break;
			}
			
			
			?></a></h1>
			<h2 class="section_title">Dashboard</h2>
			<div class="btn_view_site"><a href="index.php?r=site/logout" style="display:<?php !Yii::app()->user->isGuest ? 'none':'block'; ?>">Logout(<?php echo Yii::app()->user->name; ?>)</a></div>
	</div><!-- header -->
	
	<section id="secondary_bar">
	<div class="user">
		<p>
		<?php
			Yii::import('application.controllers.SiteController');
			$siteController = new SiteController("Site"); //string $id, CWebModule $module=NULL
			echo $siteController->getName();
		?></p>
		<!--
			John Doe (<a href="#">3 Messages</a>)
		-->
		<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
	</div>
	<div class="breadcrumbs_container">
		<?php if(isset($this->breadcrumbs)):?>
			<?php $this->widget('zii.widgets.CBreadcrumbs', array(
				'links'=>$this->breadcrumbs,'separator'=>'',
				'homeLink'=>false 
			)); ?><!-- breadcrumbs -->
		<?php endif?>
		
	</div>
</section>
<aside id="sidebar" class="column">
	<div id="divSearch">
		
	</div>
	<hr/>
	<h3>Admin Menu</h3>
	<ul class="toggle">
		<?php
		$this->beginWidget('zii.widgets.CPortlet',array(
			'contentCssClass'=>'',
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>array(
						array('label'=>'Create Sponsor', 'url'=>array('sponsor/create')),
						array('label'=>'View Sponsor', 'url'=>array('sponsor/admin')),
						array('label'=>'Create Advertisement', 'url'=>array('advertisement/create')),
						array('label'=>'View Advertisement', 'url'=>array('advertisement/admin')),
						array('label'=>'Create School Admin', 'url'=>array('school/create')),
						array('label'=>'View School Admin', 'url'=>array('school/admin')),
						array('label'=>'Create Game Level', 'url'=>array('GameLevel/create')),
						array('label'=>'View Game Level', 'url'=>array('GameLevel/admin')),
						array('label'=>'Create Competition', 'url'=>array('competition/create')),
						array('label'=>'View Competition', 'url'=>array('competition/admin')),
						array('label'=>'Create Pattern', 'url'=>array('Patterns/create')),
						array('label'=>'Upload Pattern', 'url'=>array('Patterns/upload')),
						array('label'=>'View Patterns', 'url'=>array('Patterns/admin')),
						array('label'=>'Statistics', 'url'=>array('Reporting/admin')),
						array('label'=>'New Message', 'url'=>array('Message/create')),
						array('label'=>'Outbox', 'url'=>array('Message/sent')),
						array('label'=>'Inbox', 'url'=>array('Message/inbox')),
						array('label'=>'OutSide Players', 'url'=>array('player/outplayers')),
						
					),
			'id'=>'menu1',
		));
		$this->endWidget();
	?>
	</ul>
	
</aside><!-- end of sidebar -->

	

<div id="main">
<?php echo $content?>
</div>
<?php $this->endContent()?>