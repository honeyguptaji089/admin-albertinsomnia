<?php

/**
 * This is the model class for table "test".
 *
 * The followings are the available columns in table 'test':
 * @property string $id
 * @property string $test_name
 * @property string $test_description
 * @property string $date
 *
 * The followings are the available model relations:
 * @property TestGameLevel[] $testGameLevels
 * @property TestGroups[] $testGroups
 */
class Test extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Test the static model class
	 */
	 
	public $school_grade,$school_class; 
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'test';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('test_name, test_description, date,time_allowed', 'required'),
			array('test_name', 'length', 'max'=>200),
			array('test_description', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, test_name, test_description, date,time_allowed, limited_time_target', 'safe', 'on'=>'search'),
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
			'testGameLevels' => array(self::HAS_MANY, 'TestGameLevel', 'test_id_fk'),
			'testGroups' => array(self::HAS_MANY, 'TestGroups', 'test_id_fk'),
			'teacherIdFk' => array(self::BELONGS_TO, 'Teacher', 'teacher_id_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'test_name' => 'Test Name',
			'test_description' => 'Test Description',
			'date' => 'Date',
			'time_allowed'=>'Time Allowed',
			'limited_time_target'=>'Limited Time Target',
			'teacher_id_fk'=>'Teacher Id Fk'
		);
	}

	
	public function getDate($value)
	{
		$st_timezone = str_replace("*", "+", $_COOKIE['YIITZ']);
		$valid_date=date('Y-m-d H:i:s', strtotime($value));
		$st_postDate=date('F j, Y, g:i A',strtotime($valid_date . $st_timezone));
		echo $st_postDate;
		//April 20, 2013, 2:27 AM
	}

	
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('test_name',$this->test_name,true);
		$criteria->compare('test_description',$this->test_description,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('time_allowed',$this->time_allowed,true);
		$criteria->compare('limited_time_target',$this->time_allowed,true);
		$criteria->order = 'date DESC';
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}