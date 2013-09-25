<?php

class SchoolController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/super_admin',$school_code,$message,$message_type;

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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','delete','index','view','Mail'),
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new School;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		
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
		else{
			$userinfo=new UserInfo;
			$UniqueCodes=new UniqueCodes;
			$_sponsor_code=$UniqueCodes->findByPk(1)->school_code+1;
			$this->school_code="SC".str_pad($_sponsor_code, 4, '0', STR_PAD_LEFT);
			
			$school_grades=array('K','1','2','3','4','5','6','7','8','9','10','11');
			if(isset($_POST['School'])&& isset($_POST['UserInfo']))
			{
				
				$userinfo->attributes=$_POST['UserInfo'];
				$email_exists=$userinfo->exists('email=:email',array(':email'=>$userinfo->email));
				if($email_exists){
					$this->redirect(array('create','message'=>1));
				}
				else
				{
					$userinfo->user_type=2;
					$paintPWD=$userinfo->password;
					$userinfo->password=md5($userinfo->password);
					if($userinfo->validate('email','password')){
						if($userinfo->save()){
							
							$model->attributes=$_POST['School'];
							$model->user_id_fk=$userinfo->id;
							if($model->save()){
								$UniqueCodes->school_code=$_sponsor_code;
								$UniqueCodes->updateByPK(1,array('school_code'=>$UniqueCodes->school_code));
								foreach($school_grades as $data){
									$SchoolGrades=new SchoolGrades;
									$SchoolGrades->school_id_fk = $model->id;
									$SchoolGrades->grade_name = $data;
									$SchoolGrades->save();
								}

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
	
	public function actionMail(){
		Yii::import('application.extensions.phpmailer.JPhpMailer');
		$mail = new JPhpMailer;
		$mail->IsSMTP();
		$mail->Host = 'smpt.gmail.com';
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'ssl';
		$mail->Username = 'ankitit14@gmail.com';
		$mail->Password = '$_GMAIL[2013]';
		$mail->SetFrom('ankitit14@gmail.com', 'Ankit Sharma');
		$mail->Subject = 'PHPMailer Test Subject via smtp, basic with authentication';
		$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
		$mail->MsgHTML('<h1>JUST A TEST!</h1>');
		$mail->AddAddress('virushowman@gmail.com', 'Virendra Sharma');
		if($mail->Send()){
			echo "Mail Sent";
		}
		else{
			echo "Mail not Sent";
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_GET['message']) && intVal($_GET['message'])===1)
		{
			$this->message="Profile Updated Successfully";
			$this->message_type="alert_success";
		}
		
		
		
		$user_type=intVal(Yii::app()->user->user_type);
		
		if($user_type===2){
			$this->layout="school_admin";
		}
		if(isset($_POST['School']))
		{
			$model->attributes=$_POST['School'];
			if($model->save()){
				if($user_type===2){
					$user_id=intVal(Yii::app()->user->user_id);
					$SchoolModel=new School;
					$school_id=$SchoolModel->find(array('select'=>'id','condition'=>'user_id_fk=:user_id_fk','params'=>array(':user_id_fk'=>$user_id)))->id;
					$SchoolModel=null;

					$this->redirect(array('update','id'=>$school_id,'message'=>1));
				}
				else{
					$this->redirect(array('admin','message'=>2));
				}
				
			}
				
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
		$dataProvider=new CActiveDataProvider('School');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new School('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['School']))
			$model->attributes=$_GET['School'];
			
		if(isset($_GET['message'])){
			switch($_GET['message']){
				case 1:
					$this->message="School Admin Created Successfully";
					$this->message_type="alert_success";
					break;
				case 2:
					$this->message="School Admin Updated Successfully";
					$this->message_type="alert_success";
					break;	
				case 3:
					$this->message="School Admin Deleted Successfully";
					$this->message_type="alert_success";
					break;		
				default:
					$this->message="Invalid Request";
					$this->message_type="alert_warning";
				break;	
			}
		}
		
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=School::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='school-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
