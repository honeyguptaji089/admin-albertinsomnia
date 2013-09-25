<?php

/**
 * This is the model class for table "competition_game_level".
 *
 * The followings are the available columns in table 'competition_game_level':
 * @property string $id
 * @property string $game_level_id_fk
 * @property string $comptetition_id_fk
 *
 * The followings are the available model relations:
 * @property Competition $comptetitionIdFk
 * @property GameLevel $gameLevelIdFk
 */
class CompetitionGameLevel extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CompetitionGameLevel the static model class
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
		return 'competition_game_level';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('game_level_id_fk, comptetition_id_fk', 'required'),
			array('game_level_id_fk, comptetition_id_fk', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, game_level_id_fk, comptetition_id_fk', 'safe', 'on'=>'search'),
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
			'comptetitionIdFk' => array(self::BELONGS_TO, 'Competition', 'comptetition_id_fk'),
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
			'game_level_id_fk' => 'Game Level Id Fk',
			'comptetition_id_fk' => 'Comptetition Id Fk',
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
		$criteria->compare('game_level_id_fk',$this->game_level_id_fk,true);
		$criteria->compare('comptetition_id_fk',$this->comptetition_id_fk,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}