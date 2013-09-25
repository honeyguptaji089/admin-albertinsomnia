<?php

class SchoolGroupController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/teacher',$schoolGrades,$schoolClass,$player,$ajaxCounter,$message,$message_type;

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
				'actions'=>array('create','update','index','view','admin','delete','player','AddPlayer'),
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
		$model=new SchoolGroup;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		$this->schoolGrades=$this->getSchoolGrade();
		
		if(isset($_POST['SchoolGroup']))
		{
			$model->attributes=$_POST['SchoolGroup'];
			if($model->is_competition_group==='on'){
				$model->is_competition_group=1;
			}
			else{
				$model->is_competition_group=0;
			}
			$model->class_id_fk=$_POST['SchoolGroup']['SchoolClass'];
			if($model->save())
			{
				foreach($_POST['SchoolGroup']['player'] as $player){
					$GroupPlayer=new GroupPlayer;
					$GroupPlayer->player_id_fk=$player;
					$GroupPlayer->group_id_fk=$model->id;
					$GroupPlayer->save();
					$GroupPlayer=null;
				}
				$this->redirect(array('admin','message'=>1));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	
	public function getCompetitionStatus($value){
		$status=($value==1)?'True':'False';
		return $status;
	}
	
	public function myDataRender($data){
		 $value=($data->is_competition_group==1)?"True":"False";
		 return $value;
	}

	public function getSchoolGrade($grade_id=null){
		$user_id_fk=intVal(Yii::app()->user->user_id);
		$TeacherModel=new Teacher;
		$teacherData=$TeacherModel->find(array('select'=>'id,school_id_fk','condition'=>'user_id_fk=:user_id_fk','params'=>array(':user_id_fk'=>$user_id_fk)));
		
		if($grade_id==null){
			$data=array();
			$data["Select Grade"]="Select Grade";
			foreach($teacherData->schoolIdFk->schoolGrades as $grade){
				$data[$grade->id]=$grade->grade_name;
			}
			return $data;
		}
		else
		{
			$data='';
			$data.="<select id='slGrade' name='SchoolGroup[SchoolGrade]'><option value='Select Grade'>Select Grade</option>";
			foreach($teacherData->schoolIdFk->schoolGrades as $grade){
				if($grade->id===$grade_id){
					$data.="<option value='".$grade->id."' selected>".$grade->grade_name."</option>";
				}
				else{
					$data.="<option value='".$grade->id."'>".$grade->grade_name."</option>";
				}
			}
			$data.="</select>";
			return $data;
		}
		$teacherData=null;
		$TeacherModel=null;
	
	}
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		
		$this->schoolGrades=$this->getSchoolGrade($model->classIdFk->gradeIdFk->id);
		
		$SchoolClass=new SchoolClass;
		$criteria= new CDbCriteria;
		$criteria->select='id,class_name';
		$criteria->addCondition('grade_id_fk='.$model->classIdFk->gradeIdFk->id);
		$criteria->order='class_name';
		$classData=$SchoolClass->findAll($criteria);

		$this->schoolClass="<select id='slClass' name='SchoolGroup[SchoolClass]'><option value='Select Class'>Select Class</option>";
		foreach($classData as $class){
			if($model->class_id_fk == $class->id){
				$this->schoolClass.="<option value='".$class->id."' selected >".$class->class_name."</option>";
			}
			else{
				$this->schoolClass.="<option value='".$class->id."'>".$class->class_name."</option>";
			}
		}
		$this->schoolClass.="</select>";
		
		$GroupPlayer = new GroupPlayer;
		$criteriaGroupPlayer= new CDbCriteria;
		$criteriaGroupPlayer->select='player_id_fk';
		$criteriaGroupPlayer->addCondition('group_id_fk='.$model->id);
		$GroupPlayerData = $GroupPlayer->findAll($criteriaGroupPlayer);
		$GroupPlayer = null; 
		$GroupPlayerArray=array();
		foreach($GroupPlayerData as $PlayerData){
			array_push($GroupPlayerArray,$PlayerData->player_id_fk);
		}
		
		$Player = new Player;
		$criteriaPlayer= new CDbCriteria;
		$criteriaPlayer->select='id,player_name';
		$criteriaPlayer->addCondition('player_class_id_fk='.$model->class_id_fk);
		$PlayerData = $Player->findAll($criteriaPlayer);
		$Player = null; 
		$PlayerArray=array();
		foreach($PlayerData as $Playerinfo){
			$PlayerArray[$Playerinfo->id]=$Playerinfo->player_name;
		}
		

		$this->player="<select id='slPlayer' multiple='multiple' name='SchoolGroup[player][]'>";
		foreach($PlayerArray as $key=>$value){
			if(in_array($key,$GroupPlayerArray)){
				$this->player.="<option value='".$key."' selected >".$value."</option>";
			}
			else{
				$this->player.="<option value='".$key."'>".$value."</option>";
			}
		}
		$this->player.="</select>";
		
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SchoolGroup']))
		{
			$model->attributes=$_POST['SchoolGroup'];
			if($model->is_competition_group==='on'){
				$model->is_competition_group=1;
			}
			else{
				$model->is_competition_group=0;
			}
			$model->class_id_fk=$_POST['SchoolGroup']['SchoolClass'];
			if($model->save())
			{
				$delGroupPlayer=new GroupPlayer;
				$delGroupPlayer->deleteAll('group_id_fk=:GID',array(':GID'=>$model->id));
				$delGroupPlayer=null;
				foreach($_POST['SchoolGroup']['player'] as $player){
					$GroupPlayer=new GroupPlayer;
					$GroupPlayer->player_id_fk=$player;
					$GroupPlayer->group_id_fk=$model->id;
					$GroupPlayer->save();
					$GroupPlayer=null;
				}
				$this->redirect(array('admin','message'=>2));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function getPlayerName($id)
	{
		$player = new Player;
		return $player->findByPK($id)->player_name;
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
		$dataProvider=new CActiveDataProvider('SchoolGroup');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new SchoolGroup('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['message'])){
			switch($_GET['message']){
				case 1:
					$this->message="Group Created Successfully";
					$this->message_type="alert_success";
					break;
				case 2:
					$this->message="Group Updated Successfully";
					$this->message_type="alert_success";
					break;	
				case 3:
					$this->message="Group Deleted Successfully";
					$this->message_type="alert_success";
					break;		
				default:
					$this->message="Invalid Request";
					$this->message_type="alert_warning";
				break;	
			}
		}
		
		
		if(isset($_GET['SchoolGroup']))
		{	
			$model->attributes=$_GET['SchoolGroup'];
			$model->is_competition_group=($model->is_competition_group=="True")?1:0;
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
		$model=SchoolGroup::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function actionPlayer()
	{	
		$data=Player::model()->findAll('player_class_id_fk=:player_class_id_fk', array(':player_class_id_fk'=>($_POST['school_class'])));
		$data=CHtml::listData($data,'id','player_name');
		foreach($data as $value=>$name)
		{
			echo CHtml::tag('option',array( 'value'=>$value),CHtml::encode($name),true);
		}

	}
	
	
	public function actionAddPlayer() {
		// fill school Dropdownlist
		$this->schoolGrades=$this->getSchoolGrade();
		
		if(isset($_POST['counter']))
			$this->ajaxCounter=$_POST['counter'];
			
		echo  $this->renderPartial('_playerHTML',null,true);
	}
	
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='school-group-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
