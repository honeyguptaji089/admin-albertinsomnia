<?php

/**
 * This is the model class for table "game_level".
 *
 * The followings are the available columns in table 'game_level':
 * @property string $id
 * @property string $level_name
 *
 * The followings are the available model relations:
 * @property CompetitionGameLevel[] $competitionGameLevels
 * @property GameLevelCards[] $gameLevelCards
 * @property GameLevelFunction[] $gameLevelFunctions
 * @property TestGameLevel[] $testGameLevels
 */
class GameLevel extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GameLevel the static model class
	 */
	public $cards,$functions; 
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'game_level';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('level_name', 'required'),
			array('level_name', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, level_name,total_targets', 'safe', 'on'=>'search'),
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
			'competitionGameLevels' => array(self::HAS_MANY, 'CompetitionGameLevel', 'game_level_id_fk'),
			'gameLevelCards' => array(self::HAS_MANY, 'GameLevelCards', 'game_level_id_fk'),
			'gameLevelFunctions' => array(self::HAS_MANY, 'GameLevelFunction', 'game_level_id_fk'),
			'testGameLevels' => array(self::HAS_MANY, 'TestGameLevel', 'game_level_id_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'level_name' => 'Level Name',
			'total_targets'=>'Total Targets',
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
		$criteria->compare('level_name',$this->level_name,true);
		$criteria->compare('total_targets',$this->total_targets,true);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}