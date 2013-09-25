<?php

class TestController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/teacher',$gameLevel,$schoolGrades,$ajaxCounter,$message,$message_type,$_updateGameLevel,$_updateSchoolGroups,$updateContent,$mysql_time,
	$timearray,$gmtTestTime;

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
				'actions'=>array('create','update','index','view','admin','delete','Group','AjaxAddGroup','GameLevel',
				'SchoolGroupData','SchoolGradeData','SchoolClassData','SchoolData','getLimitedTargetValue',
				'getFormmattedDate','Test','Time'),
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

	protected function getFormmattedDate($data,$row)
    { 
		return date("F j, Y, g:i A",strtotime($data->date));    
    }
	
	protected function getLimitedTargetValue($data,$row)
    {
         return $data->limited_time_target == 0 ? "No" : "Yes";    
    }
	
	public function actionTime($id)
	{
		if(isset($_GET['message'])){
			switch($_GET['message']){
				case 1:
					$this->message="Test Created Successfully";
					$this->message_type="alert_success";
					break;
				case 2:
					$this->message="Test Updated Successfully";
					$this->message_type="alert_success";
					break;	
				case 3:
					$this->message="Test Deleted Successfully";
					$this->message_type="alert_success";
					break;		
				default:
					$this->message="Invalid Request";
					$this->message_type="alert_warning";
				break;	
			}
		}
		
		$model=$this->loadModel($id);
		$this->timearray=array('International Date Line Wes'=>'-12 hours -0 minutes','Midway Island, Samo'=>'-11 hours -0 minutes','Hawai'=>'-10 hours -0 minutes','Alask'=>'-09 hours -0 minutes','Pacific Time (US & Canada'=>'-08 hours -0 minutes','Tijuana, Baja Californi'=>'-08 hours -0 minutes','Arizon'=>'-07 hours -0 minutes','Chihuahua, La Paz, Mazatla'=>'-07 hours -0 minutes','Mountain Time (US & Canada'=>'-07 hours -0 minutes','Central Americ'=>'-06 hours -0 minutes','Central Time (US & Canada'=>'-06 hours -0 minutes','Guadalajara, Mexico City, Monterre'=>'-06 hours -0 minutes','Saskatchewa'=>'-06 hours -0 minutes','Bogota, Lima, Quito, Rio Branc'=>'-05 hours -0 minutes','Eastern Time (US & Canada'=>'-05 hours -0 minutes','Indiana (East'=>'-05 hours -0 minutes','Atlantic Time (Canada'=>'-04 hours -0 minutes','Caracas, La Pa'=>'-04 hours -0 minutes','Manau'=>'-04 hours -0 minutes','Santiag'=>'-04 hours -0 minutes','Newfoundlan'=>'-03 hours -30 minutes','Brasili'=>'-03 hours -0 minutes','Buenos Aires, Georgetow'=>'-03 hours -0 minutes','Greenlan'=>'-03 hours -0 minutes','Montevide'=>'-03 hours -0 minutes','Mid-Atlanti'=>'-02 hours -0 minutes','Cape Verde Is'=>'-01 hours -0 minutes','Azore'=>'-01 hours -0 minutes','Casablanca, Monrovia, Reykjavi'=>'+00 hours +0 minutes','Greenwich Mean Time : Dublin, Edinburgh, Lisbon, Londo'=>'+00 hours +0 minutes','Amsterdam, Berlin, Bern, Rome, Stockholm, Vienn'=>'+01 hours +0 minutes','Belgrade, Bratislava, Budapest, Ljubljana, Pragu'=>'+01 hours +0 minutes','Brussels, Copenhagen, Madrid, Pari'=>'+01 hours +0 minutes','Sarajevo, Skopje, Warsaw, Zagre'=>'+01 hours +0 minutes','West Central Afric'=>'+01 hours +0 minutes','Amma'=>'+02 hours +0 minutes','Athens, Bucharest, Istanbu'=>'+02 hours +0 minutes','Beiru'=>'+02 hours +0 minutes','Cair'=>'+02 hours +0 minutes','Harare, Pretori'=>'+02 hours +0 minutes','Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilniu'=>'+02 hours +0 minutes','Jerusale'=>'+02 hours +0 minutes','Mins'=>'+02 hours +0 minutes','Windhoe'=>'+02 hours +0 minutes','Kuwait, Riyadh, Baghda'=>'+03 hours +0 minutes','Moscow, St. Petersburg, Volgogra'=>'+03 hours +0 minutes','Nairob'=>'+03 hours +0 minutes','Tbilis'=>'+03 hours +0 minutes','Tehra'=>'+03 hours +30 minutes','Abu Dhabi, Musca'=>'+04 hours +0 minutes','Bak'=>'+04 hours +0 minutes','Yereva'=>'+04 hours +0 minutes','Kabu'=>'+04 hours +30 minutes','Yekaterinbur'=>'+05 hours +0 minutes','Islamabad, Karachi, Tashken'=>'+05 hours +0 minutes','Sri Jayawardenapur'=>'+05 hours +30 minutes','Chennai, Kolkata, Mumbai, New Delh'=>'+05 hours +30 minutes','Kathmand'=>'+05 hours +40 minutes','Almaty, Novosibirs'=>'+06 hours +0 minutes','Astana, Dhak'=>'+06 hours +0 minutes','Yangon (Rangoon'=>'+06 hours +30 minutes','Bangkok, Hanoi, Jakart'=>'+07 hours +0 minutes','Krasnoyars'=>'+07 hours +0 minutes','Beijing, Chongqing, Hong Kong, Urumq'=>'+08 hours +0 minutes','Kuala Lumpur, Singapor'=>'+08 hours +0 minutes','Irkutsk, Ulaan Bataa'=>'+08 hours +0 minutes','Pert'=>'+08 hours +0 minutes','Taipe'=>'+08 hours +0 minutes','Osaka, Sapporo, Toky'=>'+09 hours +0 minutes','Seou'=>'+09 hours +0 minutes','Yakuts'=>'+09 hours +0 minutes','Adelaid'=>'+09 hours +30 minutes','Darwi'=>'+09 hours +30 minutes','Brisban'=>'+10 hours +0 minutes','Canberra, Melbourne, Sydne'=>'+10 hours +0 minutes','Hobar'=>'+10 hours +0 minutes','Guam, Port Moresb'=>'+10 hours +0 minutes','Vladivosto'=>'+10 hours +0 minutes','Magadan, Solomon Is., New Caledoni'=>'+11 hours +0 minutes','Auckland, Wellingto'=>'+12 hours +0 minutes','Fiji, Kamchatka, Marshall Is'=>'+12 hours +0 minutes','Nuku alof'=>'+13 hours +0 minutes');
		$this->gmtTestTime = $model->date;
		$this->render('time',array(
			'model'=>$this->loadModel($id),
		));
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
		$model=new Test;

		
		// fill Game Level Dropdownlist
		$gameLevelModel=new GameLevel;
		$criteria= new CDbCriteria;
		$criteria->select='id,level_name';
		$criteria->order='level_name';
		$criteria->addCondition('forCompetition=0');
		$gameLevelData=$gameLevelModel->findAll($criteria);
		$this->gameLevel=array();
		foreach($gameLevelData as $data){
			$this->gameLevel[$data->id]=$data->level_name;
		}
		
		$this->schoolGrades=$this->getSchoolGrade();
		
		
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Test']) && isset($_COOKIE['YIITZ']))
		{
			//echo "<pre>";print_r($_POST);echo "</pre>";
			$model->attributes=$_POST['Test'];
			
			$yiiz = str_replace("*", "+", $_COOKIE['YIITZ']);
			$st_timezone = strrpos($yiiz, "+") ? str_replace("+" , "-", $yiiz) : str_replace("-" , "+", $yiiz);
			$postDate=$_POST['Test']['date'];
			$valid_date=date('Y-m-d H:i:s', strtotime($postDate));
			$st_postDate=date('Y-m-d H:i:s',strtotime($valid_date . $st_timezone));
			$model->date=$st_postDate;
			$model->teacher_id_fk=Teacher::model()->find('user_id_fk=:user_id_fk',array(':user_id_fk'=>Yii::app()->user->user_id))->id;
			
			$model->limited_time_target=$_POST['Test']['limited_time_target'];
			
			
			if($model->save()){
				$testGameLevels=$_POST['Test']['GameLevel'];
				foreach($testGameLevels as $game_level){
					$TestGameLevel=new TestGameLevel;
					$TestGameLevel->game_level_id_fk=$game_level;
					$TestGameLevel->test_id_fk=$model->id;
					$TestGameLevel->save();
					$TestGameLevel=null;
				}
				$testGroupsCollection=$_POST['Test']['SchoolGroup']['GroupName'];
				foreach($testGroupsCollection as $testGroups){
					foreach($testGroups as $group){
						$TestGroups=new TestGroups;
						$TestGroups->group_id_fk=$group;
						$TestGroups->test_id_fk=$model->id;
						$TestGroups->save();
						$TestGroups=null;
					}
				}
				$this->redirect(array('time','message'=>1,'id'=>$model->id));
			}
			
		}

		$this->render('create',array(
			'model'=>$model,
		));
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
	
	public function actionAjaxAddGroup() {
		$this->schoolGrades=$this->getSchoolGrade();
		if(isset($_POST['counter']))
			$this->ajaxCounter=$_POST['counter'];
			
		echo  $this->renderPartial('_schoolGroupsHTML',null,true);
	}
	
	
	public function actionTest() {
		
		$query="SELECT NOW()";
		$result=mysql_query($query);
		$row=mysql_fetch_array($result);
		$criteria->select='NOW() as mysql_time';
		$model=$model=new Test;
		$data=$model->findAll($criteria);
		
		echo "<pre>";print_r($data);echo "</pre>";exit;
		echo "MYSQL Date and Time ".$row[0]."<br/>";
		echo "PHP Date and Time : ".date('Y-m-d H:i:s');
	}
	
	public function actionGroup()
	{	
		$data=SchoolGroup::model()->findAll('class_id_fk=:class_id_fk and is_competition_group=0', array(':class_id_fk'=>($_POST['school_class'])));
		$data=CHtml::listData($data,'id','group_name');
		//echo CHtml::tag('option',array( 'value'=>'Select Group'),CHtml::encode('Select Group'),true);
		foreach($data as $value=>$name)
		{
			echo CHtml::tag('option',array( 'value'=>$value),CHtml::encode($name),true);
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

		
		$gameLevelArray=array();
		foreach($model->testGameLevels as $game_level){
			array_push($gameLevelArray,$game_level->game_level_id_fk);
		}
		$this->_updateGameLevel="<select name='Test[GameLevel][]' multiple='true' id='slGameLevel'>
									".$this->actionGameLevel($gameLevelArray)."
								</select>";
		
		$this->_updateSchoolGroups=array("SchoolGrade"=>array(),"SchoolClass"=>array(),"GroupName"=>array());
		$dbGroups=array();
		foreach( $model->testGroups as $testGroup)
			array_push($dbGroups,$testGroup->group_id_fk);
		
		$groupClasses=array();
		foreach($dbGroups as $group){
			$schoolGroup=new SchoolGroup;
			$schoolGroups=$schoolGroup::model()->findAll('id=:id',array(':id'=>$group));
			foreach($schoolGroups as $schoolGroup){
				array_push($groupClasses,$schoolGroup->class_id_fk);
			}
		}
		$uniqueClasses=array_unique($groupClasses);
		$tmpGroups=array();
		$counter=0;
		foreach($uniqueClasses as $class){
			$schoolGroup=new SchoolGroup;
			$schoolGroupModel=$schoolGroup::model();
			$schoolGroups=$schoolGroupModel->findAll('class_id_fk=:class_id_fk',array(':class_id_fk'=>$class));
			$classGroups=array();
			foreach($schoolGroups as $schoolgroup){
				array_push($classGroups,$schoolgroup->id);
			}
			$tmpGroups[$counter]=array();
			foreach($classGroups as $classGroup){
				if(in_array($classGroup,$dbGroups))
					array_push($tmpGroups[$counter],$classGroup);
				
			}
			array_push($this->_updateSchoolGroups["GroupName"],$tmpGroups[$counter]);
			$counter++;
			
		}
		
		foreach($uniqueClasses as $class)
		{
			array_push($this->_updateSchoolGroups["SchoolClass"],$class);
		}
		
		$schoolGrades=array();
		foreach($uniqueClasses as $class){
			$schoolClass=new SchoolClass;
			$schoolClassData=$schoolClass::model()->findAll('id=:id',array(':id'=>$class));
			foreach($schoolClassData as $schoolClass){
				array_push($this->_updateSchoolGroups["SchoolGrade"],$schoolClass->grade_id_fk);
				array_push($schoolGrades,$schoolClass->grade_id_fk);
			} 
		}
		
		
		
		$length=count($this->_updateSchoolGroups["SchoolGrade"]);
		$this->updateContent="";
		$this->updateContent.="<input type='hidden' id='hdCounter' value='".$length."'>";
		for( $i=1;$i<=$length;$i++){
		
			$grade_id=$this->_updateSchoolGroups["SchoolGrade"][$i-1];
			$class_id=$this->_updateSchoolGroups["SchoolClass"][$i-1];
			$groupArray=$this->_updateSchoolGroups["GroupName"][$i-1];
			$this->updateContent.="<div class='schoolGroups'>
					<fieldset class='left'>
						<label for='slGrade".($i-1)."'>School Grade</label>
						<select id='slGrade".($i-1)."' name='Test[SchoolGroup][SchoolGrade][]'>
							".$this->actionSchoolGradeData($this->actionSchoolData(),$grade_id)."
						</select>
					</fieldset>
					<fieldset class='right'>
						<label for='slClass".($i-1)."'>School Class</label>
						<select id='slClass".($i-1)."' name='Test[SchoolGroup][SchoolClass][]'>
							".$this->actionSchoolClassData($grade_id,$class_id)."
						</select>
					</fieldset>
					
					<fieldset style='clear:left;'>
						<label for='slGroup".($i-1)."'>School Group <span class='required'>*</span></label>
						<select id='slGroup".($i-1)."' name='Test[SchoolGroup][GroupName][".($i-1)."][]' multiple='true'>
							".$this->actionSchoolGroupData($class_id,$groupArray)."
						</select>
					</fieldset>
					
				</div>
				<script type='text/javascript'>
					$('body').on('change','#slGrade".($i-1)."',function(){jQuery.ajax({'type':'POST','url':'".CController::createUrl('competition/Class')."','data':{'school_grade':$(this).val()},'cache':false,'success':function(html){jQuery('#slClass".($i-1)."').html(html)}});return false;});
					$('body').on('change','#slClass".($i-1)."',function(){jQuery.ajax({'type':'POST','url':'".CController::createUrl('test/Group')."','data':{'school_class':$(this).val()},'cache':false,'success':function(html){jQuery('#slGroup".($i-1)."').html(html)}});return false;});

				</script>";
			
		}
		if(isset($_COOKIE['YIITZ'])){
			$st_timezone = str_replace("*", "+", $_COOKIE['YIITZ']);
			$valid_date=date('Y-m-d H:i:s', strtotime($model->date));
			$model->date=date('Y-m-d H:i:s',strtotime($valid_date . $st_timezone));
		}

		if(isset($_POST['Test']) && isset($_COOKIE['YIITZ']))
		{
			$model->attributes=$_POST['Test'];
			$model->limited_time_target=$_POST['Test']['limited_time_target'];
			
			$yiiz = str_replace("*", "+", $_COOKIE['YIITZ']);
			$st_timezone = strrpos($yiiz, "+") ? str_replace("+" , "-", $yiiz) : str_replace("-" , "+", $yiiz);
			$postDate=$_POST['Test']['date'];
			$valid_date=date('Y-m-d H:i:s', strtotime($postDate));
			$st_postDate=date('Y-m-d H:i:s',strtotime($valid_date . $st_timezone));
			$model->date=$st_postDate;
			
			
			if($model->save()){
				
				$TestGameLevel=new TestGameLevel;
				$TestGameLevel->deleteAll('test_id_fk=:GID',array(':GID'=>$model->id));
				$TestGameLevel=null;
				$testGameLevels=$_POST['Test']['GameLevel'];
				foreach($testGameLevels as $game_level){
					$TestGameLevel=new TestGameLevel;
					$TestGameLevel->game_level_id_fk=$game_level;
					$TestGameLevel->test_id_fk=$model->id;
					$TestGameLevel->save();
					$TestGameLevel=null;
				}
				
				$TestGroups=new TestGroups;
				$TestGroups->deleteAll('test_id_fk=:GID',array(':GID'=>$model->id));
				$TestGroups=null;
				$testGroupsCollection=$_POST['Test']['SchoolGroup']['GroupName'];
				foreach($testGroupsCollection as $testGroups){
					foreach($testGroups as $group){
						$TestGroups=new TestGroups;
						$TestGroups->group_id_fk=$group;
						$TestGroups->test_id_fk=$model->id;
						$TestGroups->save();
						$TestGroups=null;
					}
				}
				$this->redirect(array('time','message'=>2,'id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionSchoolData(){
		$user_id=Yii::app()->user->user_id;
		$Teacher=new Teacher;
		$school_id=$Teacher->find(array('select'=>'school_id_fk','condition'=>'user_id_fk=:user_id_fk','params'=>array(':user_id_fk'=>$user_id)))->school_id_fk;
		return $school_id;
	}
	public function actionSchoolGradeData($school,$selected_grade)
	{	
		$content="";
		$data=SchoolGrades::model()->findAll('school_id_fk=:school_id_fk', array(':school_id_fk'=>$school));
		$data=CHtml::listData($data,'id','grade_name');
		$content.="<option value='Select Grade'>Select Grade</option>";
		foreach($data as $id=>$grade_name)
		{
			if($selected_grade == $id)
				$content.="<option value='".$id."' selected>".$grade_name."</option>";
			else
				$content.="<option value='".$id."'>".$grade_name."</option>";
				
		}
		return $content;
	}
	
	public function actionSchoolClassData($grade,$selected_class)
	{	
		$content="";
		$data=SchoolClass::model()->findAll('grade_id_fk=:grade_id_fk', array(':grade_id_fk'=>($grade)));
		$data=CHtml::listData($data,'id','class_name');
		$content.="<option value='Select Class'>Select Class</option>";
		foreach($data as $id=>$class_name)
		{
			if($selected_class == $id)
				$content.="<option value='".$id."' selected>".$class_name."</option>";
			else
				$content.="<option value='".$id."'>".$class_name."</option>";
				
		}
		return $content;

	}
	
	public function actionSchoolGroupData($class,$groupArray)
	{	
		$content="";
		$data=SchoolGroup::model()->findAll('class_id_fk=:class_id_fk and is_competition_group=0', array(':class_id_fk'=>($class)));
		$data=CHtml::listData($data,'id','group_name');
		foreach($data as $id=>$group_name)
		{
			if(in_array($id,$groupArray))
				$content.="<option value='".$id."' selected>".$group_name."</option>";
			else
				$content.="<option value='".$id."'>".$group_name."</option>";
				
		}
		return $content;

	}
	
	public function actionGameLevel($gameLevelArray)
	{	
		$content="";
		$gameLevelModel=new GameLevel;
		$criteria= new CDbCriteria;
		$criteria->select='id,level_name';
		$criteria->order='level_name';
		$criteria->addCondition('forCompetition=0');
		$gameLevelData=$gameLevelModel->findAll($criteria);
		foreach($gameLevelData as $data){
			if(in_array($data->id,$gameLevelArray))
				$content.="<option value='".$data->id."' selected>".$data->level_name."</option>";
			else
				$content.="<option value='".$data->id."'>".$data->level_name."</option>";
		}
		return $content;

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
		$dataProvider=new CActiveDataProvider('Test');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Test('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['message'])){
			switch($_GET['message']){
				case 1:
					$this->message="Test Created Successfully";
					$this->message_type="alert_success";
					break;
				case 2:
					$this->message="Test Updated Successfully";
					$this->message_type="alert_success";
					break;	
				case 3:
					$this->message="Test Deleted Successfully";
					$this->message_type="alert_success";
					break;		
				default:
					$this->message="Invalid Request";
					$this->message_type="alert_warning";
				break;	
			}
		}
		
		if(isset($_GET['Test']))
			$model->attributes=$_GET['Test'];

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
		$model=Test::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='test-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
