<?php

class SponsorController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/super_admin',$sponsor_code,$message,$message_type;
	
		

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
				'actions'=>array('create','update','admin','delete'),
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
		$model=new Sponsor;
		
		$userinfo=new UserInfo;
		$UniqueCodes=new UniqueCodes;
		$_sponsor_code=$UniqueCodes->findByPk(1)->sponsor_code+1;
		$this->sponsor_code="SP".str_pad($_sponsor_code, 4, '0', STR_PAD_LEFT);
			
			
			
			
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
		if(isset($_POST['Sponsor'])&& isset($_POST['UserInfo'])){
				$userinfo->attributes=$_POST['UserInfo'];
				$email_exists=$userinfo->exists('email=:email',array(':email'=>$userinfo->email));
				if($email_exists){
					$this->redirect(array('create','message'=>1));
				}
				else
				{
					$userinfo->user_type=1;
					$userinfo->password=md5($userinfo->password);
					if($userinfo->validate('email','password')){
						if($userinfo->save()){
							$model->attributes=$_POST['Sponsor'];
							$model->user_id_fk=$userinfo->id;
							if($model->save()){
								$UniqueCodes->sponsor_code=$_sponsor_code;
								$UniqueCodes->updateByPK(1,array('sponsor_code'=>$UniqueCodes->sponsor_code));
								print_r($UniqueCodes->sponsor_code);
								$this->redirect(array('admin','message'=>1));
							}
						}
					}
					
					
				}
				
				
			}
		
		
		
		$this->render('create',array(
			'model'=>$model,
		));
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
		if($user_type===1){
			$this->layout="sponsor";
		}
		
		if(isset($_POST['Sponsor']))
		{
			$model->attributes=$_POST['Sponsor'];
			if($model->save()){
				if($user_type===1){
					$user_id=intVal(Yii::app()->user->user_id);
					$SponsorModel=new Sponsor;
					$sponsor_id=$SponsorModel->find(array('select'=>'id','condition'=>'user_id_fk=:user_id_fk','params'=>array(':user_id_fk'=>$user_id)))->id;
					$SponsorModel=null;
					$this->redirect(array('update','id'=>$sponsor_id,'message'=>1));
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
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin','message'=>3));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Sponsor');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		
		$model=new Sponsor('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Sponsor']))
			$model->attributes=$_GET['Sponsor'];
		if(isset($_GET['message'])){
			switch($_GET['message']){
				case 1:
					$this->message="Sponsor Created Successfully";
					$this->message_type="alert_success";
					break;
				case 2:
					$this->message="Sponsor Updated Successfully";
					$this->message_type="alert_success";
					break;	
				case 3:
					$this->message="Sponsor Deleted Successfully";
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
		$model=Sponsor::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='sponsor-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
