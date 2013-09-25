<?php

/**
 * This is the model class for table "school_group".
 *
 * The followings are the available columns in table 'school_group':
 * @property string $id
 * @property string $group_name
 * @property string $class_id_fk
 * @property string $is_competition_group
 *
 * The followings are the available model relations:
 * @property SchoolClass $classIdFk
 * @property TestGroups[] $testGroups
 */
class SchoolGroup extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SchoolGroup the static model class
	 */
	 
	public $school_grade,$school_class,$player;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'school_group';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('group_name, class_id_fk, is_competition_group', 'required'),
			array('group_name', 'length', 'max'=>100),
			array('class_id_fk, is_competition_group', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, group_name, class_id_fk, is_competition_group', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'classIdFk' => array(self::BELONGS_TO, 'SchoolClass', 'class_id_fk'),
			'testGroups' => array(self::HAS_MANY, 'TestGroups', 'group_id_fk'),
			'competitionGroups' => array(self::HAS_MANY, 'CompetitionGroups', 'group_id_fk'),
		);
	}

	
	public function getStatus($value)
	{
		echo ($value==1)?'True':'False';
		
	}

	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'group_name' => 'Group Name',
			'class_id_fk' => 'Class Id Fk',
			'is_competition_group' => 'Is Competition Group',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$user_id_fk=intVal(Yii::app()->user->user_id);
		$Teacher=new Teacher;
		$School_id=$Teacher->find(array('select'=>'school_id_fk','condition'=>'user_id_fk=:user_id_fk','params'=>array(':user_id_fk'=>$user_id_fk)))->school_id_fk;
		$Teacher=null;
		
		$SchoolGrades=new SchoolGrades;
		$SchoolGradesData=$SchoolGrades->findAll(array('select'=>'id','condition'=>'school_id_fk=:school_id_fk','params'=>array(':school_id_fk'=>$School_id)));
		$SchoolGradesArray=array();
		foreach($SchoolGradesData as $data){
			array_push($SchoolGradesArray,$data->id);
		}
		$SchoolGrades=null;
		$SchoolGradesData=null;
		
		$ClassCriteria = new CDbCriteria();
		$ClassCriteria->select="id";
		$ClassCriteria->addInCondition("grade_id_fk",$SchoolGradesArray);
		$SchoolClassData = SchoolClass::model()->findAll($ClassCriteria);
		$SchoolClassArray=array();
		foreach($SchoolClassData as $data){
			array_push($SchoolClassArray,$data->id);
		}
		$SchoolClassData=null;
		
		$is_competition=($this->is_competition_group=="True")? 1:0;
		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id,true);
		$criteria->compare('group_name',$this->group_name,true);
		$criteria->compare('class_id_fk',$SchoolClassArray,true);
		$criteria->compare('is_competition_group',$this->is_competition_group,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}