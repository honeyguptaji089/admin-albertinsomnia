<?php

/**
 * This is the model class for table "game_level_function".
 *
 * The followings are the available columns in table 'game_level_function':
 * @property string $id
 * @property string $game_funtion
 * @property string $game_level_id_fk
 *
 * The followings are the available model relations:
 * @property GameLevel $gameLevelIdFk
 */
class GameLevelFunction extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GameLevelFunction the static model class
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
		return 'game_level_function';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('game_funtion, game_level_id_fk', 'required'),
			array('game_funtion', 'length', 'max'=>45),
			array('game_level_id_fk', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, game_funtion, game_level_id_fk', 'safe', 'on'=>'search'),
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
			'gameLevelIdFk' => array(self::BELONGS_TO, 'GameLevel', 'game_level_id_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'game_funtion' => 'Game Funtion',
			'game_level_id_fk' => 'Game Level Id Fk',
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
		$criteria->compare('game_funtion',$this->game_funtion,true);
		$criteria->compare('game_level_id_fk',$this->game_level_id_fk,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}