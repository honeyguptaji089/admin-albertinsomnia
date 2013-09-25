<?php

class TeacherController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/school_admin',$teacher_code,$message,$message_type, $grade;

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
				'actions'=>array('create','update','index','view','admin','delete'),
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
		$model=new Teacher;

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
		foreach($datas as $data)
			$this->grade[$data->id]=$data->grade_name;
		
		
		$UniqueCodes=new UniqueCodes;
		$_teacher_code=$UniqueCodes->findByPk(1)->teacher_code+1;
		$this->teacher_code="TC".str_pad($_teacher_code, 4, '0', STR_PAD_LEFT);
		
		
		if(isset($_POST['Teacher'])&&isset($_POST['UserInfo']))
		{
			$userInfo=new UserInfo;
			$userInfo->attributes=$_POST['UserInfo'];
			$userInfo->password=md5($_POST['UserInfo']['password']);
			$userInfo->user_type=4;
			if($userInfo->validate()){
				if($userInfo->save()){
					$model->attributes=$_POST['Teacher'];
					$model->user_id_fk=$userInfo->id;
					$user_id_fk=intVal(Yii::app()->user->user_id);
					$SchoolModel=new School;
					$school_id=$SchoolModel->find(array('select'=>'id','condition'=>'user_id_fk=:user_id_fk','params'=>array(':user_id_fk'=>$user_id_fk)))->id;
					$SchoolModel=null;
					$model->school_id_fk=$school_id;
					if($model->save()){
						$UniqueCodes->teacher_code=$_teacher_code;
						$UniqueCodes->updateByPK(1,array('teacher_code'=>$UniqueCodes->teacher_code));
						$UniqueCodes=null;
						
						foreach($_POST['Teacher']['Grade'] as $grade){
							$TeacherGrades=new TeacherGrades;
							$TeacherGrades->teacher_id_fk = $model->id;
							$TeacherGrades->grade_id_fk = $grade;
							$TeacherGrades->save();
							$TeacherGrades=null;
						}

						$this->redirect(array('admin','message'=>1));
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
		if(intVal(Yii::app()->user->user_type)===4){
			$this->layout='teacher';
		}
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['Teacher']))
		{
			$model->attributes=$_POST['Teacher'];
			if($model->save()){
				if(intVal(Yii::app()->user->user_type)===4){
					$user_id_fk=intVal(Yii::app()->user->user_id);
					$Teacher=new Teacher;
					$teacher_id=$Teacher->find(array('select'=>'id','condition'=>'user_id_fk=:user_id_fk','params'=>array(':user_id_fk'=>$user_id_fk)))->id;
					$Teacher=null;
					$this->redirect(array('update&message=2&id='.$teacher_id));
				}
				else{
					$this->redirect(array('admin','message'=>2));
				}
			}
				
		}
		if(isset($_GET['message'])){
			switch($_GET['message']){
				case 2:
					$this->message="Profile Updated Successfully";
					$this->message_type="alert_success";
					break;	
				default:
					$this->message="Invalid Request";
					$this->message_type="alert_warning";
				break;	
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
		$dataProvider=new CActiveDataProvider('Teacher');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Teacher('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['message'])){
			switch($_GET['message']){
				case 1:
					$this->message="Teacher Created Successfully";
					$this->message_type="alert_success";
					break;
				case 2:
					$this->message="Teacher Updated Successfully";
					$this->message_type="alert_success";
					break;	
				case 3:
					$this->message="Teacher Deleted Successfully";
					$this->message_type="alert_success";
					break;		
				default:
					$this->message="Invalid Request";
					$this->message_type="alert_warning";
				break;	
			}
		}
		
		
		if(isset($_GET['Teacher']))
			$model->attributes=$_GET['Teacher'];

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
		$model=Teacher::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='teacher-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
