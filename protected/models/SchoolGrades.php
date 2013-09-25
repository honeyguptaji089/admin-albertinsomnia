<?php

/**
 * This is the model class for table "school_grades".
 *
 * The followings are the available columns in table 'school_grades':
 * @property string $id
 * @property string $grade_name
 * @property string $school_id_fk
 *
 * The followings are the available model relations:
 * @property SchoolClass[] $schoolClasses
 * @property School $schoolIdFk
 */
class SchoolGrades extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SchoolGrades the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'school_grades';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('grade_name, school_id_fk', 'required'),
			array('grade_name', 'length', 'max'=>45),
			array('school_id_fk', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, grade_name, school_id_fk', 'safe', 'on'=>'search'),
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
			'schoolClasses' => array(self::HAS_MANY, 'SchoolClass', 'grade_id_fk'),
			'schoolIdFk' => array(self::BELONGS_TO, 'School', 'school_id_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'grade_name' => 'Grade Name',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('grade_name',$this->grade_name,true);
		$criteria->compare('school_id_fk',$this->school_id_fk,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}