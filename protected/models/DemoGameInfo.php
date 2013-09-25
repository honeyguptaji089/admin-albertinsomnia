<?php

/**
 * This is the model class for table "demo_game_info".
 *
 * The followings are the available columns in table 'demo_game_info':
 * @property string $id
 * @property string $player_id_fk
 * @property string $score
 * @property string $last_level_string
 *
 * The followings are the available model relations:
 * @property Player $playerIdFk
 */
class DemoGameInfo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DemoGameInfo the static model class
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
		return 'demo_game_info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('player_id_fk', 'required'),
			array('player_id_fk', 'length', 'max'=>10),
			array('score', 'length', 'max'=>45),
			array('last_level_string', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, player_id_fk, score, last_level_string', 'safe', 'on'=>'search'),
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
			'playerIdFk' => array(self::BELONGS_TO, 'Player', 'player_id_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'player_id_fk' => 'Player Id Fk',
			'score' => 'Score',
			'last_level_string' => 'Last Level String',
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
		$criteria->compare('player_id_fk',$this->player_id_fk,true);
		$criteria->compare('score',$this->score,true);
		$criteria->compare('last_level_string',$this->last_level_string,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}