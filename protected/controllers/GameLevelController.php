<?php

class GameLevelController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/super_admin',$cards,$functions,$selectedCards,$selectedFunctions,$message,$message_type,$card_pattern, 
	$function_pattern;

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
				'actions'=>array('create','update','index','view','admin','delete','Target'),
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
		if(Yii::app()->user->user_type==4){
			$this->layout='teacher';
		}
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
		
		if(Yii::app()->user->user_type==4){
			$this->layout='teacher';
		}
		$this->pageTitle=Yii::app()->name." - Create Game Level";
		$model=new GameLevel;
		//$selectedCards=array();
		//$selectedFunctions=array();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		$this->cards=array();
		for($i=1;$i<=12;$i++)
			$this->cards[$i]="Card ".$i;
			
		$this->functions=array('+'=>'+','-'=>'-','X'=>'*','/'=>'/','^'=>'^','!'=>'!');
		
		
		if(isset($_POST['GameLevel']))
		{
			$model->attributes=$_POST['GameLevel'];
			if(Yii::app()->user->user_type==5){
				$model->forCompetition=1;
			}
			else if(Yii::app()->user->user_type==4){
				$model->forCompetition=0;
			}
			$model->total_targets=$_POST['GameLevel']['total_targets'];
			$modelCards=$_POST['GameLevel']['cards'];
			$modelFunctions=$_POST['GameLevel']['functions'];
			
			if($model->save()){
				$GameLevelID=$model->id;
				foreach($modelCards as $key=>$value){
					$GameLevelCard=new GameLevelCards;
					$GameLevelCard->card_number=$value;
					$GameLevelCard->game_level_id_fk=$GameLevelID;
					$GameLevelCard->save();
					$GameLevelCard=null;
				}
				
				foreach($modelFunctions as $key=>$value){
					$GameLevelFunction=new GameLevelFunction;
					$GameLevelFunction->game_funtion=$value;
					$GameLevelFunction->game_level_id_fk=$GameLevelID;
					$GameLevelFunction->save();
					$GameLevelFunction=null;
				}
				$this->redirect(array('admin','message'=>1));
			}
			
						
			
		}
		if(isset($_GET['message'])){
			switch($_GET['message']){
				default:
					$this->message="Invalid Request";
					$this->message_type="alert_warning";
				break;	
			}
		}
		$this->render('create',array(
			'model'=>$model,
		));
	}

	
	public function actionTarget($cards,$functions){
		$functions=str_replace("p","+",$functions);
		//$functions=str_replace("*","X",$functions);
		//echo "Cards : ".$cards." , Functions : ".$functions;exit;
		
		$Patterns=new Patterns;
		$data=$Patterns->find(
										array(
											'select'=>'max_target',
											'condition'=>'cards=:card AND functions=:function ',
											'params'=>array(':card'=>$cards,':function'=>$functions)
										)
									);
		if(is_object($data)){
			echo intVal($data->max_target);
		}
		else{
			echo "null";
		}
	}
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		if(Yii::app()->user->user_type==4){
			$this->layout='teacher';
		}
		$this->pageTitle=Yii::app()->name." - Update Game Level";
		
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		$this->cards=array();
		for($i=1;$i<=12;$i++)
			array_push($this->cards,$i);
			
		
		$this->selectedCards=array();
		foreach($model->gameLevelCards as $gameLevelCard)
			array_push($this->selectedCards,$gameLevelCard->card_number);
		
		foreach($this->cards as $key=>$value){
			if(in_array($value, $this->selectedCards)){
				$this->cards[$key]='true';
			}
			else
			{
				$this->cards[$key]='false';
			}
		}
		
		$this->functions=array('+'=>'+','-'=>'-','*'=>'*','/'=>'/','^'=>'^','!'=>'!');
		
		$this->selectedFunctions=array();
		foreach($model->gameLevelFunctions as $gameLevelFunction)
			array_push($this->selectedFunctions,$gameLevelFunction->game_funtion);
		
		foreach($this->functions as $key=>$value){
			if(in_array($value, $this->selectedFunctions)){
				$this->functions[$value]='true';
			}
			else
			{
				$this->functions[$value]='false';
			}
		}
		
		if(isset($_POST['GameLevel']))
		{
		
				$GameLevelID=$model->id;
				$modelCards=$_POST['GameLevel']['cards'];
				$modelFunctions=$_POST['GameLevel']['functions'];
				
				/*	Deleting Existing Game level Cards*/
				
				$GameLevelCard=new GameLevelCards;
				$existingCards=$GameLevelCard->find(
													array(
														'select'=>'id,card_number',
														'condition'=>'game_level_id_fk=:GID',
														'params'=>array(':GID'=>$model->id)
													)
												);
				if($existingCards)
					$existingCards->delete();
				
				$GameLevelCard=null;
				
				/*	Deleting Existing Game level Functions*/
				$GameLevelFunction=new GameLevelFunction;
				$existingFunctions=$GameLevelFunction->find(
													array(
														'select'=>'id,game_funtion',
														'condition'=>'game_level_id_fk=:GID',
														'params'=>array(':GID'=>$model->id)
													)
												);
				if($existingFunctions)
					$existingFunctions->delete();
				
				$GameLevelFunction=null;
				
				/*Insert new Game Level Cards*/
				foreach($modelCards as $key=>$value){
					$GameLevelCard=new GameLevelCards;
					$GameLevelCard->card_number=$value;
					$GameLevelCard->game_level_id_fk=$GameLevelID;
					$GameLevelCard->save();
					$GameLevelCard=null;
				}
				
				
				/*Insert new Game Level Functions*/
				foreach($modelFunctions as $key=>$value){
					$GameLevelFunction=new GameLevelFunction;
					$GameLevelFunction->game_funtion=$value;
					$GameLevelFunction->game_level_id_fk=$GameLevelID;
					$GameLevelFunction->save();
					$GameLevelFunction=null;
				}
				
				
				
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
		if(Yii::app()->user->user_type==4){
			$this->layout='teacher';
		}
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
		if(Yii::app()->user->user_type==4){
			$this->layout='teacher';
		}
		$dataProvider=new CActiveDataProvider('GameLevel');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		if(Yii::app()->user->user_type==4){
			$this->layout='teacher';
		}
		$this->pageTitle=Yii::app()->name." - View Game Level";
		$model=new GameLevel('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['GameLevel']))
			$model->attributes=$_GET['GameLevel'];

		
		if(isset($_GET['message'])){
			switch($_GET['message']){
				case 1:
					$this->message="Game Level Created Successfully";
					$this->message_type="alert_success";
					break;
				case 2:
					$this->message="Game Level Updated Successfully";
					$this->message_type="alert_success";
					break;	
				case 3:
					$this->message="Game Level Deleted Successfully";
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
		$model=GameLevel::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='game-level-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
