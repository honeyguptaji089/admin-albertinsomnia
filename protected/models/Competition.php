<?php

/**
 * This is the model class for table "competition".
 *
 * The followings are the available columns in table 'competition':
 * @property string $id
 * @property string $competition_name
 * @property string $date
 * @property integer $limited_time_target
 *
 * The followings are the available model relations:
 * @property CompetitionAdvertisement[] $competitionAdvertisements
 * @property CompetitionGameLevel[] $competitionGameLevels
 */
class Competition extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Competition the static model class
	 */
	
	public $school_name,$school_grade,$school_class,$school_group;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'competition';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('competition_name, date, competition_time', 'required'),
			array('competition_name', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, competition_name, date, competition_time, limited_time_target', 'safe', 'on'=>'search'),
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
			'competitionAdvertisements' => array(self::HAS_MANY, 'CompetitionAdvertisement', 'competition_id_fk'),
			'competitionGameLevels' => array(self::HAS_MANY, 'CompetitionGameLevel', 'comptetition_id_fk'),
			'competitionGroups' => array(self::HAS_MANY, 'CompetitionGroups', 'competition_id_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'competition_name' => 'Competition Name',
			'date' => 'Date',
			'competition_time' => 'Competition Time',
			'limited_time_target'=>'Limited Time Target',
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
		//echo $this->limited_time_target;exit;
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('competition_name',$this->competition_name,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('competition_time',$this->competition_time,true);
		$criteria->compare('limited_time_target',$this->limited_time_target,true);
		$criteria->order = 'date DESC';
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}