<?php

class SchoolClassController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='school_admin',$school_grade, $message, $message_type;

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
		$model=new SchoolClass;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		$school_id=School::model()->find(array('select'=>'id','condition'=>'user_id_fk=:user_id_fk','params'=>array(':user_id_fk'=>Yii::app()->user->user_id)))->id;
		
		$school_grade=array();
		$SchoolGrades=new SchoolGrades;
		$criteria= new CDbCriteria;
		$criteria->select='id,grade_name';
		$criteria->addCondition('school_id_fk='.$school_id);
		$gradeData=$SchoolGrades->findAll($criteria);
		$this->school_grade['Select Grade']='Select Grade';
		foreach($gradeData as $data){
			$this->school_grade[$data->id]=$data->grade_name;
		}
		
		if(isset($_POST['SchoolClass']))
		{
			$model->attributes=$_POST['SchoolClass'];
			if($model->save())
				$this->redirect(array('admin','message'=>1));
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

		$school_id=School::model()->find(array('select'=>'id','condition'=>'user_id_fk=:user_id_fk','params'=>array(':user_id_fk'=>Yii::app()->user->user_id)))->id;
		
		$SchoolGrades=new SchoolGrades;
		$criteria= new CDbCriteria;
		$criteria->select='id,grade_name';
		$criteria->addCondition('school_id_fk='.$school_id);
		$gradeData=$SchoolGrades->findAll($criteria);
		$this->school_grade='<select id="slSchoolClass" name="SchoolClass[grade_id_fk]">
								<option value="Select Grade">Select Grade</option>';
		foreach($gradeData as $data){
			if($model->grade_id_fk===$data->id)
				$this->school_grade.='<option value="'.$data->id.'" selected>'.$data->grade_name.'</option>';
			else
				$this->school_grade.='<option value="'.$data->id.'">'.$data->grade_name.'</option>';
		}
		$this->school_grade.='</select>';
		if(isset($_POST['SchoolClass']))
		{
			$model->attributes=$_POST['SchoolClass'];
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
		$dataProvider=new CActiveDataProvider('SchoolClass');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new SchoolClass('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SchoolClass']))
			$model->attributes=$_GET['SchoolClass'];

		if(isset($_GET['message'])){
			switch($_GET['message']){
				case 1:
					$this->message="School Class Created Successfully";
					$this->message_type="alert_success";
					break;
				case 2:
					$this->message="School Class Updated Successfully";
					$this->message_type="alert_success";
					break;	
				case 3:
					$this->message="School Class Deleted Successfully";
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
		$model=SchoolClass::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='school-class-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
