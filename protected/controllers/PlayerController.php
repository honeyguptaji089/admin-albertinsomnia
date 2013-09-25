<?php

class PlayerController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/school_admin',$grade,$message,$message_type,$player_code,$player_class,$classSelect,$selectGender,$importStatus;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','CreateOutside'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','CreateOutside', 'update','admin','delete','index','view','Class','Upload','getClassName','outplayers', 'getPaymentStatusValue'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	public function actionCreateOutside()
	{
		$this->layout='//layouts/playerOutSide';
		$model=new Player;
		$userinfo=new UserInfo;
		$UniqueCodes=new UniqueCodes;
		$_player_code=$UniqueCodes->findByPk(1)->player_code+1;
		$this->player_code="ST".str_pad($_player_code, 4, '0', STR_PAD_LEFT);
		
		if(isset($_GET['message'])){
			switch($_GET['message']){
				case 1:
					$this->message="Email ID already Exists.";
					$this->message_type="alert_warning";
					break;
				case 2:
					$this->message="You have Successfully Register. <a href='http://localhost/game_portal/app/README.txt' target='_blank'>Download Albert Insomania 2.0 App</a>";
					$this->message_type="alert_success";
					break;
				default:
					$this->message="Invalid Request";
					$this->message_type="alert_warning";
				break;	
			}
		}
		
		if(isset($_POST['Player'])&& isset($_POST['UserInfo'])){
			$userinfo->attributes=$_POST['UserInfo'];
			$email_exists=$userinfo->exists('email=:email',array(':email'=>$userinfo->email));
			if($email_exists){
				$this->redirect(array('createOutside','message'=>1));
			}
			else
			{
				$userinfo->user_type=3;
				$userinfo->password=md5($userinfo->password);
				if($userinfo->validate('email','password')){
					if($userinfo->save()){
						$model->attributes=$_POST['Player'];
						$model->player_type=1;
						$model->payment_status=0;
						$model->user_id_fk=$userinfo->id;
						if($model->save()){
							$DemoGameInfo = new DemoGameInfo;
							$DemoGameInfo->player_id_fk=$model->id;
							$DemoGameInfo->score = 0;
							if($DemoGameInfo->save()){
								$UniqueCodes->player_code=$_player_code;
								$UniqueCodes->updateByPK(1,array('player_code'=>$UniqueCodes->player_code));
								$this->redirect(array('createOutside','message'=>2));
							}
						}
					}
				}
				
				
			}
			
			
		}
	
	$this->render('createOutside',array(
			'model'=>$model,
		));
	}
	
	protected function getClassName($data,$row)
    {
       return $data->player_class_id_fk == "" ? "--" : $data->classIdFk->class_name;    
    } 
	
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Player;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		$id=Yii::app()->user->user_id;
		$school_data=School::model()->find(array(
										'select'=>'id',
										'condition'=>'user_id_fk=:user_id_fk',
										'params'=>array(':user_id_fk'=>$id),
									));
		$school_id=$school_data->id;
		$datas=SchoolGrades::model()->findAll('school_id_fk=:school_id_fk', array(':school_id_fk'=>($school_id)));
		$this->grade=array();
		$this->grade["Select Grade"]="Select Grade";
		foreach($datas as $data)
			$this->grade[$data->id]=$data->grade_name;
		
		$userinfo=new UserInfo;
		$UniqueCodes=new UniqueCodes;
		$_player_code=$UniqueCodes->findByPk(1)->player_code+1;
		$this->player_code="ST".str_pad($_player_code, 4, '0', STR_PAD_LEFT);
		
		
		if(isset($_GET['message'])){
			switch($_GET['message']){
				case 1:
					$this->message="Email ID already Exists.";
					$this->message_type="alert_warning";
					break;
				default:
					$this->message="Invalid Request";
					$this->message_type="alert_warning";
				break;	
			}
		}
		
		if(isset($_POST['Player'])&& isset($_POST['UserInfo'])){
			$userinfo->attributes=$_POST['UserInfo'];
			$email_exists=$userinfo->exists('email=:email',array(':email'=>$userinfo->email));
			if($email_exists){
				$this->redirect(array('create','message'=>1));
			}
			else
			{
				$userinfo->user_type=3;
				$userinfo->password=md5($userinfo->password);
				if($userinfo->validate('email','password')){
					if($userinfo->save()){
						$model->attributes=$_POST['Player'];
						$model->player_type=0;
						$model->payment_status=1;
						$model->user_id_fk=$userinfo->id;
						if($model->save()){
							$DemoGameInfo = new DemoGameInfo;
							$DemoGameInfo->player_id_fk=$model->id;
							$DemoGameInfo->score = 0;
							if($DemoGameInfo->save()){
								$UniqueCodes->player_code=$_player_code;
								$UniqueCodes->updateByPK(1,array('player_code'=>$UniqueCodes->player_code));
								$this->redirect(array('admin','message'=>1));
							}
						}
					}
				}
				
				
			}
			
			
		}
	
		$this->render('create',array(
			'model'=>$model,
		));
	}

	
	
	/* action for Uploading Player*/
	
	public function actionUpload()
	{
		$model=new Player;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		$id=Yii::app()->user->user_id;
		$school_id=School::model()->find(array('select'=>'id','condition'=>'user_id_fk=:user_id_fk','params'=>array(':user_id_fk'=>$id)))->id;
		$datas=SchoolGrades::model()->findAll('school_id_fk=:school_id_fk', array(':school_id_fk'=>($school_id)));
		$this->grade=array();
		$this->grade["Select Grade"]="Select Grade";
		foreach($datas as $data)
			$this->grade[$data->id]=$data->grade_name;
			
		
		if(isset($_GET['message'])){
			switch($_GET['message']){
				case 1:
					$this->message="Please Select .xls Files Only.";
					$this->message_type="alert_warning";
					break;
				default:
					$this->message="Invalid Request";
					$this->message_type="alert_warning";
				break;	
			}
		}
		
		if(isset($_POST['Player'])){
			$player_class=$_POST['Player']['player_class_id_fk'];
			$playerUploadFile = CUploadedFile::getInstance($model, 'player_file');
			if($playerUploadFile !== null){ 
				$playerFileExt=$playerUploadFile->getExtensionName();
				if($playerFileExt=="xls"){
					$playerFileNewName = Yii::getPathOfAlias("webroot")."/upload/".time().".".$playerFileExt;
					$playerUploadFile->saveAs($playerFileNewName);
					Yii::import('application.extensions.JPhpExcelReader.Spreadsheet_Excel_Reader');      
					$data = new Spreadsheet_Excel_Reader($playerFileNewName); 
					//echo "<pre>";print_r($data);echo "</pre>";exit;
					$this->importStatus=array();
					for ($j = 2; $j <= $data->sheets[0]['numRows']; $j++)
					{
							$email=$data->sheets[0]['cells'][$j][1];
							$player_name=$data->sheets[0]['cells'][$j][2];
							$gender=$data->sheets[0]['cells'][$j][3];
							$phone=$data->sheets[0]['cells'][$j][4];
							$address=$data->sheets[0]['cells'][$j][5];
							$email_exists=UserInfo::model()->exists('email=:email',array(':email'=>$email));
							if($email_exists){
								array_push($this->importStatus,array("<b>Player Name : </b>".$player_name." <b>Email :</b>".$email." already exists in database","fail"));
							}
							else
							{
								$UniqueCodes=new UniqueCodes;
								$uniquePlayerCode=$UniqueCodes->findByPk(1)->player_code+1;
								$playerCode="ST".str_pad($uniquePlayerCode, 4, '0', STR_PAD_LEFT);
								
								$userinfo=new UserInfo;
								$userinfo->email=mysql_real_escape_string($email);
								$userinfo->user_type=3;
								$userinfo->password=md5($playerCode);
								if($userinfo->validate()){
									if($userinfo->save()){
										$playerModel=new Player;
										$playerModel->player_name=$player_name;
										$playerModel->player_class_id_fk=$player_class;
										$playerModel->gender=$gender;
										$playerModel->phone_no=$phone;
										$playerModel->user_id_fk=$userinfo->id;
										$playerModel->address=$address;
										$playerModel->player_code=$playerCode;
										$playerModel->player_type=0;
										$playerModel->payment_status=1;
										if($playerModel->save(false)){
											$DemoGameInfo = new DemoGameInfo;
											$DemoGameInfo->player_id_fk=$playerModel->id;
											$DemoGameInfo->score=0;
											if($DemoGameInfo->save()){
												$UniqueCodes->player_code=$uniquePlayerCode;
												$UniqueCodes->updateByPK(1,array('player_code'=>$uniquePlayerCode));
												array_push($this->importStatus,array("<b>Player Name :</b> ".$player_name." <b>Email : </b>".$email." successfully saved with Player Code : <b>".$playerCode."</b>","success"));
											}
											$DemoGameInfo=null;
										}
										$playerModel=null;
									}
										
								}
								$userinfo=null;
								$UniqueCodes=null;
								
							}
							
					
					}
					unlink($playerFileNewName);
				}
				else{
					$this->redirect(array('upload','message'=>1));
				}
			}
		}
	
		$this->render('upload',array(
			'model'=>$model,
		));
	}

	
	
	
	public function actionClass()
	{	
		$data=SchoolClass::model()->findAll('grade_id_fk=:grade_id_fk', array(':grade_id_fk'=>($_POST['school_grade'])));
		$data=CHtml::listData($data,'id','class_name');
		echo CHtml::tag('option',array( 'value'=>'Select Class'),CHtml::encode('Select Class'),true);
		foreach($data as $value=>$name)
		{
			echo CHtml::tag('option',array( 'value'=>$value),CHtml::encode($name),true);
		}

	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		
		$playerClass=$model->player_class_id_fk;
		
		$schoolSelectedGrade=SchoolClass::model()->find('grade_id_fk','id=:id', array(':id'=>$playerClass))->grade_id_fk;
		
		/* Get School ID from User ID */
		$user_id=Yii::app()->user->user_id;
		$schoolModel=School::model();
		$school_id=$schoolModel->find(array('select'=>'id','condition'=>'user_id_fk=:user_id_fk','params'=>array(':user_id_fk'=>$user_id)))->id;
						
		
		/* Create selected Grade Select Box */
		$schoolGradeData=SchoolGrades::model()->findAll('school_id_fk=:school_id_fk', array(':school_id_fk'=>($school_id)));
		
		$this->grade="<select id='slGrade'><option value='Select Grade'>Select Grade</option>";
		foreach($schoolGradeData as $schoolGrade)
		{
			if($schoolSelectedGrade==$schoolGrade->id)
				$this->grade.="<option value='".$schoolGrade->id."' selected >".$schoolGrade->grade_name."</option>";
			else
				$this->grade.="<option value='".$schoolGrade->id."'>".$schoolGrade->grade_name."</option>";
				
		}	
		$this->grade.="</select>";
		$this->grade.="<script type='text/javascript'>$('body').on('change','#slGrade',function(){jQuery.ajax({'type':'POST','url':'".CController::createUrl('player/Class')."','data':{'school_grade':$(this).val()},'cache':false,'success':function(html){jQuery('#slClass').html(html)}});return false;});</script>";
		

		$schoolGradeData=null;
		
		/* Create selected Class Select Box */
		$schoolClassData=SchoolClass::model()->findAll('grade_id_fk=:grade_id_fk', array(':grade_id_fk'=>($schoolSelectedGrade)));
		$this->classSelect="<select id='slClass' name='Player[player_class_id_fk]'><option value='Select Class'>Select Class</option>";
		foreach($schoolClassData as $schoolClass)
		{
			if($playerClass==$schoolClass->id)
				$this->classSelect.="<option value='".$schoolClass->id."' selected >".$schoolClass->class_name."</option>";
			else
				$this->classSelect.="<option value='".$schoolClass->id."'>".$schoolClass->class_name."</option>";
				
		}	
		$this->classSelect.="</select>";
		$schoolClassData=null;
		
		$this->selectGender="<select id='slGender' name='Player[gender]'>";
		if($model->gender=="Male")
		{
			$this->selectGender.="<option value='Male' selected>Male</option><option value='Female'>Female</option>";
		}
		else
		{
			$this->selectGender.="<option value='Male'>Male</option><option value='Female' selected>Female</option>";
		}
		$this->selectGender.="</select>";
		
		if(isset($_POST['Player']))
		{
			$model->attributes=$_POST['Player'];
			if($model->save())
				$this->redirect(array('admin','message'=>2));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Player');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Player('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['message'])){
			switch($_GET['message']){
				case 1:
					$this->message="Player Created Successfully";
					$this->message_type="alert_success";
					break;
				case 2:
					$this->message="Player Updated Successfully";
					$this->message_type="alert_success";
					break;	
				case 3:
					$this->message="Player Deleted Successfully";
					$this->message_type="alert_success";
					break;		
				default:
					$this->message="Invalid Request";
					$this->message_type="alert_warning";
				break;	
			}
		}
		
		
		if(isset($_GET['Player']))
		{
			$model->attributes=$_GET['Player'];
			$SchoolClass = new SchoolClass;
			$model->player_class_id_fk=$SchoolClass->find(array('select'=>'id','condition'=>'class_name=:class_name','params'=>array(':class_name'=>$model->player_class_id_fk)))->id;
			$SchoolClass = null;
		}	

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionoutplayers()
	{	
		$this->layout='//layouts/super_admin';
		
		$model=new Player;
		$model->unsetAttributes();  // clear any default values
		
		$this->render('outadmin',array(
			'model'=>$model,
		));
	}
	
	protected function getPaymentStatusValue($data,$row)
    {
         return $data->payment_status == 0 ? "Not Paid" : "Paid";    
    }
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Player::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='player-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
