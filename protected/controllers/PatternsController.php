<?php

class PatternsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/super_admin',$message,$message_type,$importStatus;

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
				'actions'=>array('create','update','index','view','admin','delete','upload'),
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
		if(isset($_GET['message'])){
			switch($_GET['message']){
				case 1:
					$this->message="Pattern already exists for current set of Cards and Functions";
					$this->message_type="alert_success";
					break;		
				default:
					$this->message="Invalid Request";
					$this->message_type="alert_warning";
				break;	
			}
		}
		$model=new Patterns;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Patterns']))
		{
			$model->attributes=$_POST['Patterns'];
			$dataExists = $model->count(array(
					  'select'=>'id',
					  'condition'=>'cards=:cards AND functions=:functions',
					  'params'=>array(':cards'=>$_POST['Patterns']['cards'],':functions'=>$_POST['Patterns']['functions']))
					);
			if (!$dataExists){
				if($model->save())
				$this->redirect(array('admin','message'=>1));
			}
			else{
				$this->redirect(array('create','message'=>1));
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
		if(isset($_GET['message'])){
			switch(intVal($_GET['message'])){
				case 1:
					$this->message="Pattern already exists for current set of Cards and Functions";
					$this->message_type="alert_success";
					break;		
				default:
					$this->message="Invalid Request";
					$this->message_type="alert_warning";
				break;	
			}
		}
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Patterns']))
		{
			$model->attributes=$_POST['Patterns'];
			if($model->save()){
				$this->redirect(array('admin','message'=>2));
			}
			else{
				$this->redirect(array('update','message'=>1));
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
		$dataProvider=new CActiveDataProvider('Patterns');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		if(isset($_GET['message'])){
			switch($_GET['message']){
				case 1:
					$this->message="Pattern Created Successfully";
					$this->message_type="alert_success";
					break;
				case 2:
					$this->message="Pattern Updated Successfully";
					$this->message_type="alert_success";
					break;	
				case 3:
					$this->message="Pattern Deleted Successfully";
					$this->message_type="alert_success";
					break;		
				default:
					$this->message="Invalid Request";
					$this->message_type="alert_warning";
				break;	
			}
		}
		
		$model=new Patterns('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Patterns']))
			$model->attributes=$_GET['Patterns'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionUpload()
	{
		$model=new Patterns;
		
		if(isset($_GET['message'])){
			switch($_GET['message']){
				case 1:
					$this->message="Please Select xls file to Upload";
					$this->message_type="alert_warning";
					break;
				default:
					$this->message="Invalid Request";
					$this->message_type="alert_warning";
				break;	
			}
		}
		
		if(isset($_POST['Patterns'])){
			$patternUploadFile = CUploadedFile::getInstance($model, 'pattern_file');
			if($patternUploadFile !== null){ 
				$patternFileExt=$patternUploadFile->getExtensionName();
				if($patternFileExt=="xls"){
					$patternFileNewName = Yii::getPathOfAlias("webroot")."/upload/".time().".".$patternFileExt;
					$patternUploadFile->saveAs($patternFileNewName);
					Yii::import('application.extensions.JPhpExcelReader.Spreadsheet_Excel_Reader');      
					$data = new Spreadsheet_Excel_Reader($patternFileNewName); 
					$this->importStatus=array();
					for ($j = 2; $j <= $data->sheets[0]['numRows']; $j++)
					{
						$cards=trim($data->sheets[0]['cells'][$j][1]);
						$functions=trim($data->sheets[0]['cells'][$j][2]);
						$cards=$this->checkCardsOrder($cards) ? $cards : $this->getSortedCardOrder($cards);
						$functions=$this->checkFunctionOrder($functions) ? $functions : $this->getSortedFunctionOrder($functions);
						$max_target=$data->sheets[0]['cells'][$j][3];
						$record_exists=Patterns::model()->exists('cards=:cards and functions=:functions',
												array(':cards'=>$cards, ':functions'=>$functions));
						if($record_exists){
							$id=Patterns::model()->find(
								array(	
										'select'=>'id',
										'condition'=>'cards=:cards and functions=:functions',
										'params'=>array(':cards'=>$cards, ':functions'=>$functions)
									)
								)->id;
							$patternsModel=new Patterns;
							$patternsModel->updateByPK($id,array('max_target'=>$max_target));
							$patternsModel=null;
							array_push($this->importStatus,array("We have already found this Pattern (<b>Cards :</b> ".trim($data->sheets[0]['cells'][$j][1])." <b>Functions : </b>".trim($data->sheets[0]['cells'][$j][2]).") as (<b>Cards :</b> ".$cards." <b>Functions : </b>".$functions.") in database so we have just update the max target <b>".$max_target."</b> for this pattern","warning"));
						}
						else{
							$patternsModel=new Patterns;
							$patternsModel->cards=$cards;
							$patternsModel->functions=$functions;
							$patternsModel->max_target=$max_target;
							if($patternsModel->save()){
								array_push($this->importStatus,array("Pattern (<b>Cards :</b> ".trim($data->sheets[0]['cells'][$j][1])." <b>Functions : </b>".trim($data->sheets[0]['cells'][$j][2]).") uploaded Successfully as (<b>Cards :</b> ".$cards." <b>Functions : </b>".$functions.").","success"));
							}
							$patternsModel=null;
						}
					}
					unlink($patternFileNewName);
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
	public function checkCardsOrder($cards){
		$cards=explode(',' , $cards);
		$sortedOrder = $cards;
		sort($cards);
		if ($cards == $sortedOrder)
			return true;
		else
			return false;
	}
	
	public function getSortedCardOrder($cards){
		$cards=explode(',' , $cards);
		sort($cards);
		$value = implode(',' , $cards);
		return $value;
	}
	public function checkFunctionOrder($functions){
		$function=explode(',' , $functions);
		$order=array();
		foreach($function as $value){
			switch($value){
				case '+':
					array_push($order, 1);
					break;
				case '-':
					array_push($order, 2);
					break;
				case 'X':
					array_push($order, 3);
					break;
				case '/':
					array_push($order, 4);
					break;
				case '^':
					array_push($order, 5);
					break;
				case '!':
					array_push($order, 6);
					break;
			}
		}
		$sortedOrder = $order;
		sort($order);
		if ($order == $sortedOrder)
			return true;
		else
			return false;
	}
	
	public function getSortedFunctionOrder($functions){
		$function=explode(',', $functions);
		$order=array();
		$defiendFunction=array('+','-','X','/','^','!');
		foreach($function as $value){
			switch($value){
				case '+':
					array_push($order, 1);
					break;
				case '-':
					array_push($order, 2);
					break;
				case 'X':
					array_push($order, 3);
					break;
				case '/':
					array_push($order, 4);
					break;
				case '^':
					array_push($order, 5);
					break;
				case '!':
					array_push($order, 6);
					break;
			}
		}
		sort($order);
		$order=implode(',',$order);
		$standardOrder = array('1','2','3','4','5','6');
		$newOrder = str_replace($standardOrder, $defiendFunction, $order);
		return $newOrder;
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Patterns::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='patterns-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
