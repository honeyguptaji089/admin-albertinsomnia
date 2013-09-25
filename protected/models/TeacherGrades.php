<?php

/**
 * This is the model class for table "teacher_grades".
 *
 * The followings are the available columns in table 'teacher_grades':
 * @property string $id
 * @property string $teacher_id_fk
 * @property string $grade_id_fk
 *
 * The followings are the available model relations:
 * @property SchoolGrades $gradeIdFk
 * @property Teacher $teacherIdFk
 */
class TeacherGrades extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TeacherGrades the static model class
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
		return 'teacher_grades';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('teacher_id_fk, grade_id_fk', 'required'),
			array('teacher_id_fk, grade_id_fk', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, teacher_id_fk, grade_id_fk', 'safe', 'on'=>'search'),
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
			'gradeIdFk' => array(self::BELONGS_TO, 'SchoolGrades', 'grade_id_fk'),
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
			'teacher_id_fk' => 'Teacher Id Fk',
			'grade_id_fk' => 'Grade Id Fk',
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
		$criteria->compare('teacher_id_fk',$this->teacher_id_fk,true);
		$criteria->compare('grade_id_fk',$this->grade_id_fk,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}