<?php

/**
 * This is the model class for table "school".
 *
 * The followings are the available columns in table 'school':
 * @property string $id
 * @property string $school_name
 * @property string $school_code
 * @property string $school_address
 * @property string $phone_number
 * @property string $contact_name
 * @property string $no_student
 * @property string $user_id_fk
 *
 * The followings are the available model relations:
 * @property CompetitionSchools[] $competitionSchools
 * @property UserInfo $userIdFk
 * @property SchoolGrades[] $schoolGrades
 */
class School extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return School the static model class
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
		return 'school';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('school_name, school_code, school_address, phone_number, user_id_fk', 'required'),
			array('school_name', 'length', 'max'=>200),
			array('school_code, no_student, user_id_fk', 'length', 'max'=>10),
			array('school_address', 'length', 'max'=>500),
			array('phone_number', 'length', 'max'=>45),
			array('contact_name', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, school_name, school_code, school_address, phone_number, contact_name, no_student, user_id_fk', 'safe', 'on'=>'search'),
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
			'competitionSchools' => array(self::HAS_MANY, 'CompetitionSchools', 'school_id_fk'),
			'userIdFk' => array(self::BELONGS_TO, 'UserInfo', 'user_id_fk'),
			'schoolGrades' => array(self::HAS_MANY, 'SchoolGrades', 'school_id_fk'),
			'schoolIdFk' => array(self::HAS_MANY, 'School', 'school_id_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'school_name' => 'School Name',
			'school_code' => 'School Code',
			'school_address' => 'School Address',
			'phone_number' => 'Phone Number',
			'contact_name' => 'Contact Name',
			'no_student' => 'No Student',
			'user_id_fk' => 'User Id Fk',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('school_name',$this->school_name,true);
		$criteria->compare('school_code',$this->school_code,true);
		$criteria->compare('school_address',$this->school_address,true);
		$criteria->compare('phone_number',$this->phone_number,true);
		$criteria->compare('contact_name',$this->contact_name,true);
		$criteria->compare('no_student',$this->no_student,true);
		$criteria->compare('user_id_fk',$this->user_id_fk,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}