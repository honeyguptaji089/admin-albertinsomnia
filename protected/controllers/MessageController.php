<?php

class MessageController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2', $sentData,$sentMessgeCount,$inboxData,$inboxMessgeCount;

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
				'actions'=>array('create','index','delete','sent','getAllList','inbox'),
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
		$user_type=Yii::app()->user->user_type;
		$user_id=Yii::app()->user->user_id;
		if($user_type==5){
			$this->layout='//layouts/super_admin';
		}
		if($user_type==2){
			$this->layout='//layouts/school_admin';
		}
		if($user_type==3){
			$this->layout='//layouts/player';
		}
		if($user_type==4){
			$this->layout='//layouts/teacher';
		}
		if($user_type==1){
			$this->layout='//layouts/sponsor';
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
		$model=new Message;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$user_type=Yii::app()->user->user_type;
		$user_id=Yii::app()->user->user_id;
		$fromString="";
		if($user_type==5){
			$this->layout='//layouts/super_admin';
			$fromString="Admin";
		}
		if($user_type==2){
			$this->layout='//layouts/school_admin';
			$data=School::model()->find('user_id_fk=:user_id_fk',array(':user_id_fk'=>$user_id));
			$fromString="School: ".$data->school_name;
		}
		if($user_type==3){
			$this->layout='//layouts/player';
			$data=Player::model()->find('user_id_fk=:user_id_fk',array(':user_id_fk'=>$user_id));
			$fromString="Player: ".$data->player_name;
		}
		if($user_type==4){
			$this->layout='//layouts/teacher';
			$data=Teacher::model()->find('user_id_fk=:user_id_fk',array(':user_id_fk'=>$user_id));
			$fromString="Teacher: ".$data->teacher_name;
		}
		if($user_type==1){
			$this->layout='//layouts/sponsor';
			$data=Sponsor::model()->find('user_id_fk=:user_id_fk',array(':user_id_fk'=>$user_id));
			$fromString="Sponsor: ".$data->sponsor_name;
		}
		if(isset($_POST['Message']))
		{
			$model->attributes=$_POST['Message'];
			$ToString=$_POST['Message']['to'];
			$arrayMessageTO=array_unique(explode(",",$ToString));
			array_pop($arrayMessageTO);
			for($i=0;$i<=count($arrayMessageTO)-1;$i++){
				if($arrayMessageTO[$i]==="Admin"){
					$m1=new Message;
					$m1->to_id = 1;
					$m1->to_string = "<b>Admin</b>";
					$m1->from_string = "<b>".$fromString."</b>";
					$m1->from_id = Yii::app()->user->user_id;
					$m1->subject = htmlentities($_POST['Message']['subject']);
					$m1->message = htmlentities($_POST['Message']['message']);
					$m1->date = date('Y-m-d H:i:s');
					$m1->save();
				
				}
				else{
					$bracket_start = strrpos($arrayMessageTO[$i], "(")+1;
					$colon_start = strrpos($arrayMessageTO[$i], ":")+1;
					$bracket_end = strrpos($arrayMessageTO[$i], ")");
					$data_id=substr($arrayMessageTO[$i], $bracket_start, $bracket_end-$bracket_start);
					$data_value=substr($arrayMessageTO[$i], $colon_start, ($bracket_start-1)-$colon_start);
					$data_type="";
					$to_id=0;
					if(preg_match('/School/', $arrayMessageTO[$i])){
						$data_type="School";
						$data=School::model()->find('id=:id',array(':id'=>$data_id));
						$to_id=$data->user_id_fk;
					}
					if(preg_match('/Player/', $arrayMessageTO[$i])){
						$data_type="Player";
						$to_id=Player::model()->find(
							array('select'=>'user_id_fk','condition'=>'id=:id','params'=>array(':id'=>$data_id))
							)->user_id_fk;
					}
					if(preg_match('/Teacher/', $arrayMessageTO[$i])){
						$data_type="Teacher";
						$data=Teacher::model()->find('id=:id',array(':id'=>$data_id));
						$to_id=$data->user_id_fk;
						
					}
					if(preg_match('/Sponsor/', $arrayMessageTO[$i])){
						$data_type="Sponsor";
						$data=Sponsor::model()->find('id=:id',array(':id'=>$data_id));
						$to_id=$data->user_id_fk;
					}
					if($to_id!==0){
						$m1=new Message;
						$m1->to_id = $to_id;
						$m1->to_string = "<b>".$data_type.": ".$data_value."</b>";
						$m1->from_string = "<b>".$fromString."</b>";
						$m1->from_id = Yii::app()->user->user_id;
						$m1->subject = htmlentities($_POST['Message']['subject']);
						$m1->message = htmlentities($_POST['Message']['message']);
						$m1->date = date('Y-m-d H:i:s');
						$m1->save();
					}
				}
				
			}
			$this->redirect(array('sent'));
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

		if(isset($_POST['Message']))
		{
			$model->attributes=$_POST['Message'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
		$dataProvider=new CActiveDataProvider('Message');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		if(Yii::app()->user->user_type==5){
			$this->layout='//layouts/super_admin';
		}

		$model=new Message('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Message']))
			$model->attributes=$_GET['Message'];

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
		$model=Message::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='message-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	
	public function actiongetAllList(){
		if(isset($_GET['term']) && isset($_GET['qt'])){
			
			$suggest=array();
			switch($_GET['qt']){
				case "School":
					$School=new School;
					$models=$School->findAll(array(
						'condition'=>'school_name LIKE "%'.$_GET['term'].'%"',
						'order'=>'school_name',
						'limit'=>20,
					));
					foreach($models as $model) {
						$suggest[] = array(
							'label'=>$model->school_code.': '.$model->school_name,  // label for dropdown list
							'value'=>$model->school_name,  // value for input field
							'id'=>$model->id,    
							'school_code'=>$model->school_code,
						);
					}
					break;
				case "Sponsor":
					$Sponsor=new Sponsor;
					$models=$Sponsor->findAll(array(
						'condition'=>'sponsor_name LIKE "%'.$_GET['term'].'%"',
						'order'=>'sponsor_name',
						'limit'=>20,
					));
					foreach($models as $model) {
						$suggest[] = array(
							'label'=>$model->sponsor_code.': '.$model->sponsor_name,  // label for dropdown list
							'value'=>$model->sponsor_name,  // value for input field
							'id'=>$model->id,    
							'school_code'=>$model->sponsor_code,
						);
					}
					break;
				case "Player":
					$Player=new Player;
					$models=$Player->findAll(array(
						'condition'=>'player_name LIKE "%'.$_GET['term'].'%"',
						'order'=>'player_name',
						'limit'=>20,
					));
					foreach($models as $model) {
						$suggest[] = array(
							'label'=>$model->player_code.': '.$model->player_name,  // label for dropdown list
							'value'=>$model->player_name,  // value for input field
							'id'=>$model->id,    
							'school_code'=>$model->player_code,
						);
					}
					break;
				case "Teacher":
					$Teacher=new Teacher;
					$models=$Teacher->findAll(array(
						'condition'=>'teacher_name LIKE "%'.$_GET['term'].'%"',
						'order'=>'teacher_name',
						'limit'=>20,
					));
					foreach($models as $model) {
						$suggest[] = array(
							'label'=>$model->teacher_code.': '.$model->teacher_name,  // label for dropdown list
							'value'=>$model->teacher_name,  // value for input field
							'id'=>$model->id,    
							'school_code'=>$model->teacher_code,
						);
					}
					break;
			}
			echo CJSON::encode($suggest);

		}
	}
	
	
	
	public function actionSent()
	{
		$user_type=Yii::app()->user->user_type;
		$user_id=Yii::app()->user->user_id;
		if($user_type==5){
			$this->layout='//layouts/super_admin';
		}
		if($user_type==2){
			$this->layout='//layouts/school_admin';
		}
		if($user_type==3){
			$this->layout='//layouts/player';
		}
		if($user_type==4){
			$this->layout='//layouts/teacher';
		}
		if($user_type==1){
			$this->layout='//layouts/sponsor';
		}
		$this->sentData = Message::model()->findAll('from_id=:from_id', array(':from_id'=>$user_id));
		$this->sentMessgeCount = Message::model()->count('from_id=:from_id', array(':from_id'=>$user_id));	
		$this->render('sent');
	}
	public function actionInbox()
	{
		$user_type=Yii::app()->user->user_type;
		$user_id=intVal(Yii::app()->user->user_id);
		if($user_type==5){
			$this->layout='//layouts/super_admin';
		}
		if($user_type==2){
			$this->layout='//layouts/school_admin';
		}
		if($user_type==3){
			$this->layout='//layouts/player';
		}
		if($user_type==4){
			$this->layout='//layouts/teacher';
		}
		if($user_type==1){
			$this->layout='//layouts/sponsor';
		}
		
		$this->inboxData = Message::model()->findAll('to_id=:to_id', array(':to_id'=>$user_id));
		$this->inboxMessgeCount = Message::model()->count('to_id=:to_id', array(':to_id'=>$user_id));	
		$this->render('inbox');
	}

	
}
