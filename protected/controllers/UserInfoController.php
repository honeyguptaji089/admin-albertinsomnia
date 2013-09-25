<?php

class UserInfoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2', $user_password, $message, $message_type;

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
				'actions'=>array('index','view','create','update','admin','delete','Change'),
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
		$model=new UserInfo;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['UserInfo']))
		{
			$model->attributes=$_POST['UserInfo'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
	public function actionUpdate($id){
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$user_id_fk=intVal(Yii::app()->user->user_id);
		$UserInfo=new UserInfo;
		$this->user_password=$UserInfo->find(array('select'=>'password','condition'=>'id=:id','params'=>array(':id'=>$user_id_fk)))->password;
		$UserInfo=null;
		
		if(intVal(Yii::app()->user->user_type)===2){
			$this->layout='//layouts/school_admin';
		}
		else if(intVal(Yii::app()->user->user_type)===4){
			$this->layout='//layouts/teacher';
		}
		else if(intVal(Yii::app()->user->user_type)===3){
			$this->layout='//layouts/player';
		}
		
		if(isset($_GET['message'])){
			switch($_GET['message']){
				case 1:
					$this->message="Password Updated Successfully";
					$this->message_type="alert_success";
					break;
				case 2:
					$this->message="You have not provided your actual password";
					$this->message_type="alert_warning";
					break;
				default:
					$this->message="Invalid Request";
					$this->message_type="alert_warning";
				break;	
			}
		}
		
		if(isset($_POST['UserInfo']))
		{
			$model->attributes=$_POST['UserInfo'];
			$cuurent_passwordDB=$_POST['UserInfo']['hiddenCurrentPassword'];
			$user_id=Yii::app()->user->user_id;
			if(md5($model->password) !== $cuurent_passwordDB){
				$this->redirect(array('update','id'=>$user_id,'message'=>2));
			}
			else{
				$model->password=md5($_POST['UserInfo']['NewPassword']);
				if($model->save())
					$this->redirect(array('update','id'=>$user_id,'message'=>1));
			}
			
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	
	public function actionChange($e, $p, $np){
		$e_exists=UserInfo::model()->exists('email=:email',
												array(':email'=>$e));
		if($e_exists){
			$uservalid=UserInfo::model()->exists('email=:email and password=:password',
												array(':email'=>$e, ':password'=>md5($p)));
			if($uservalid){
				$current_password=UserInfo::model()->find(array('select'=>'id','condition'=>'email=:email and password=:password',
										'params'=>array(':email'=>$e)))->password;
				if($current_password !== md5($np)){
					$id=UserInfo::model()->find(array('select'=>'id','condition'=>'email=:email and password=:password',
										'params'=>array(':email'=>$e, ':password'=>md5($p))))->id;
					UserInfo::model()->updateByPk($id, 'password = :password', array('password'=>md5($np)));
					echo 1;exit;
				}
				else{
					echo 2;exit;
				}
			}
			else{
				echo 3;exit;
			}
		}
		else{
			echo 4;exit;
		}
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
		$dataProvider=new CActiveDataProvider('UserInfo');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new UserInfo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['UserInfo']))
			$model->attributes=$_GET['UserInfo'];

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
		$model=UserInfo::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-info-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
