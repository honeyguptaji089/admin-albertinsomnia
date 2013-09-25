<?php

/**
 * This is the model class for table "teacher".
 *
 * The followings are the available columns in table 'teacher':
 * @property string $id
 * @property string $teacher_name
 * @property string $teacher_address
 * @property string $teacher_phone_no
 * @property string $user_id_fk
 * @property string $teacher_code
 * @property string $school_id_fk
 *
 * The followings are the available model relations:
 * @property UserInfo $userIdFk
 * @property School $schoolIdFk
 * @property TeacherGrades[] $teacherGrades
 * @property Test[] $tests
 */
class Teacher extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Teacher the static model class
	 */
	public $grade;
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'teacher';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('teacher_name, user_id_fk, teacher_code, school_id_fk', 'required'),
			array('teacher_name', 'length', 'max'=>200),
			array('teacher_address', 'length', 'max'=>500),
			array('teacher_phone_no, teacher_code', 'length', 'max'=>45),
			array('user_id_fk, school_id_fk', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, teacher_name, teacher_address, teacher_phone_no, user_id_fk, teacher_code, school_id_fk', 'safe', 'on'=>'search'),
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
			'userIdFk' => array(self::BELONGS_TO, 'UserInfo', 'user_id_fk'),
			'schoolIdFk' => array(self::BELONGS_TO, 'School', 'school_id_fk'),
			'teacherGrades' => array(self::HAS_MANY, 'TeacherGrades', 'teacher_id_fk'),
			'tests' => array(self::HAS_MANY, 'Test', 'teacher_id_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'teacher_name' => 'Teacher Name',
			'teacher_address' => 'Teacher Address',
			'teacher_phone_no' => 'Teacher Phone No',
			'user_id_fk' => 'User Id Fk',
			'teacher_code' => 'Teacher Code',
			'school_id_fk' => 'School Id Fk',
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
		$School=new School;
		$School_id=$School->find(array('select'=>'id','condition'=>'user_id_fk=:user_id_fk','params'=>array(':user_id_fk'=>$user_id_fk)))->id;
		$School=null;
		
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('teacher_name',$this->teacher_name,true);
		$criteria->compare('teacher_address',$this->teacher_address,true);
		$criteria->compare('teacher_phone_no',$this->teacher_phone_no,true);
		$criteria->compare('user_id_fk',$this->user_id_fk,true);
		$criteria->compare('teacher_code',$this->teacher_code,true);
		$criteria->compare('school_id_fk',$School_id,true);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
		
		
	}
}