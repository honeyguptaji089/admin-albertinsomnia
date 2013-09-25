<?php

/**
 * This is the model class for table "school_class".
 *
 * The followings are the available columns in table 'school_class':
 * @property string $id
 * @property string $class_name
 * @property string $grade_id_fk
 *
 * The followings are the available model relations:
 * @property SchoolGrades $gradeIdFk
 * @property SchoolGroup[] $schoolGroups
 */
class SchoolClass extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SchoolClass the static model class
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
		return 'school_class';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('class_name, grade_id_fk', 'required'),
			array('class_name', 'length', 'max'=>100),
			array('grade_id_fk', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, class_name, grade_id_fk', 'safe', 'on'=>'search'),
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
			'schoolGroups' => array(self::HAS_MANY, 'SchoolGroup', 'class_id_fk'),
			'playerClass' => array(self::HAS_MANY, 'Player', 'player_class_id_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'class_name' => 'Class Name',
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

		$tbl_grades= SchoolGrades::model()->tableSchema->name;
		$school_id=School::model()->find(array('select'=>'id','condition'=>'user_id_fk=:user_id_fk','params'=>array(':user_id_fk'=>Yii::app()->user->user_id)))->id;
		
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('class_name',$this->class_name,true);
		$criteria->compare('grade_id_fk',$this->grade_id_fk,true);

		$criteria->alias = 'SchoolClass';
		$criteria->join='LEFT JOIN '.$tbl_grades.' ON '.$tbl_grades.'.id=SchoolClass.grade_id_fk';
		$criteria->condition=$tbl_grades.'.school_id_fk='.$school_id;

		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}