<?php

class AdvertisementController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/super_admin',$sponsors,$sponsor_array,$message,$message_type;

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
				'actions'=>array('index','view','create','update','admin','delete','ImageUpdate','Ajaxupdate'),
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
		$model=new Advertisement;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		// fill Sponsor Dropdownlist
		$sponsorModel=new Sponsor;
		$criteria= new CDbCriteria;
		$criteria->select='id,sponsor_name';
		$criteria->order='sponsor_name';
		$sponsorData=$sponsorModel->findAll($criteria);
		$this->sponsor_array=array();
		$this->sponsor_array['Select Sponsor Name']='Select Sponsor Name';
		foreach($sponsorData as $data){
			$this->sponsor_array[$data->id]=$data->sponsor_name;
		}
		
		if(isset($_GET['message'])&& intVal($_GET['message'])){
			switch($_GET['message']){
				case 1:
					$this->message="Please use valid Image format for Advertisement.<br/><b>(.jpg, .jpeg, .gif, .png)</b>";
					$this->message_type="alert_warning";
					break;
				default:
					$this->message="Invalid Request";
					$this->message_type="alert_error";
					break;
			}
				
		}
		if(isset($_POST['Advertisement'])&&isset($_POST['Sponsor']))
		{
			if(intVal($_POST['Advertisement']['ad_img_type'])===1){
				$adImageUploadFile = CUploadedFile::getInstance($model, 'image_url');
				$adImageExt=$adImageUploadFile->getExtensionName();
				if($adImageUploadFile !== null){ // only do if file is really uploaded
					if($adImageExt=="jpg" || $adImageExt=="gif" || $adImageExt=="png" || $adImageExt=="jpeg")
					{
						$adImagesNewName = Yii::getPathOfAlias("webroot")."/images/ad_images/".time().".".$adImageExt;
						$adImageUploadFile->saveAs($adImagesNewName);
						$model->attributes=$_POST['Advertisement'];
						$model->image_url="images/ad_images/".time().".".$adImageExt;
						$model->sponsor_id_fk=$_POST['Sponsor']['id'];
						if($model->save())
							$this->redirect(array('admin','message'=>1));
					}
					else
					{
						$this->redirect(array('create','message'=>1));
					}
				}
			}
			else if(intVal($_POST['Advertisement']['ad_img_type'])===0){
				$model->attributes=$_POST['Advertisement'];
				$model->image_url=$_POST['txtImageURL'];
				$model->sponsor_id_fk=$_POST['Sponsor']['id'];
				if($model->save())
					$this->redirect(array('admin','message'=>1));

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

		if(isset($_POST['Advertisement']))
		{	$model->attributes=$_POST['Advertisement'];
			$model->image_url=$model->findByPk($model->id)->image_url;
			if($model->save())
				$this->redirect(array('admin','message'=>2));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	
	public function actionImageUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Advertisement']))
		{	
			if(intVal($_POST['Advertisement']['ad_img_type'])===1){
				$adImageUploadFile = CUploadedFile::getInstance($model, 'image_url');
				$adImageExt=$adImageUploadFile->getExtensionName();
				if($adImageUploadFile !== null){ // only do if file is really uploaded
					if($adImageExt=="jpg" || $adImageExt=="gif" || $adImageExt=="png" || $adImageExt=="jpeg")
					{
						$adImagesNewName = Yii::getPathOfAlias("webroot")."/images/ad_images/".time().".".$adImageExt;
						$adImageUploadFile->saveAs($adImagesNewName);
						$model->attributes=$_POST['Advertisement'];
						/*
							if(file_exists(Yii::getPathOfAlias("webroot")."/images/".$model->findByPK($model->id)->image_url))
							unlink(Yii::getPathOfAlias("webroot")."/images/".$model->findByPK($model->id)->image_url);
						*/
						$model->image_url="images/ad_images/".time().".".$adImageExt;
						$model->updateByPK($model->id,array('image_url'=>$model->image_url));
						$this->redirect(array('admin','message'=>4));
					}
				} 
			}
			else if(intVal($_POST['Advertisement']['ad_img_type'])===0){
				$model->attributes=$_POST['Advertisement'];
				$model->image_url=$_POST['txtImageURL'];
				
				$model->updateByPK($model->id,array('image_url'=>$model->image_url));
				$this->redirect(array('admin','message'=>4));
						
			}
			
		}

		$this->render('image_update',array(
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
		$dataProvider=new CActiveDataProvider('Advertisement');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Advertisement('search');
		$model->unsetAttributes();  // clear any default values
		
		if(intVal(Yii::app()->user->user_type)===1){
			$this->layout="sponsor";
		}
		
		
		if(isset($_GET['Advertisement']))
			$model->attributes=$_GET['Advertisement'];

		if(isset($_GET['message'])){
			switch($_GET['message']){
				case 1:
					$this->message="Advertisement Created Successfully";
					$this->message_type="alert_success";
					break;
				case 2:
					$this->message="Advertisement Updated Successfully";
					$this->message_type="alert_success";
					break;	
				case 3:
					$this->message="Advertisement Deleted Successfully";
					$this->message_type="alert_success";
					break;		
				case 4:
					$this->message="Advertisement Image Updated Successfully";
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
		$model=Advertisement::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='advertisement-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionAjaxupdate()
	{
		$act = $_GET['act'];
		if($act=='doDelete')
		{          
			$Data = $_POST['Id'];
			if(count($Data)>0)
			{
				foreach($Data as $d)
				{
					$this->loadModel($d)->delete();
				}
			}
		}
		echo "Data Deleted Successfully";
		
	}
}
