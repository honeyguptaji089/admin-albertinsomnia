<?php

/**
 * This is the model class for table "unique_codes".
 *
 * The followings are the available columns in table 'unique_codes':
 * @property string $sponsor_code
 * @property string $player_code
 * @property string $school_code
 * @property string $teacher_code
 */
class UniqueCodes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UniqueCodes the static model class
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
		return 'unique_codes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sponsor_code, player_code, school_code, teacher_code', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sponsor_code, player_code, school_code, teacher_code', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'sponsor_code' => 'Sponsor Code',
			'player_code' => 'Player Code',
			'school_code' => 'School Code',
			'teacher_code' => 'Teacher Code',
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

		$criteria->compare('sponsor_code',$this->sponsor_code,true);
		$criteria->compare('player_code',$this->player_code,true);
		$criteria->compare('school_code',$this->school_code,true);
		$criteria->compare('teacher_code',$this->teacher_code,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}