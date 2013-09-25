<?php

/**
 * This is the model class for table "competition_score".
 *
 * The followings are the available columns in table 'competition_score':
 * @property string $id
 * @property string $competition_id_fk
 * @property string $player_id_fk
 * @property string $score
 *
 * The followings are the available model relations:
 * @property Competition $competitionIdFk
 * @property Player $playerIdFk
 */
class CompetitionScore extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CompetitionScore the static model class
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
		return 'competition_score';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('competition_id_fk, player_id_fk', 'required'),
			array('competition_id_fk, player_id_fk, score', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, competition_id_fk, player_id_fk, score', 'safe', 'on'=>'search'),
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
			'competitionIdFk' => array(self::BELONGS_TO, 'Competition', 'competition_id_fk'),
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
			'competition_id_fk' => 'Competition Id Fk',
			'player_id_fk' => 'Player Id Fk',
			'score' => 'Score',
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
		$criteria->compare('competition_id_fk',$this->competition_id_fk,true);
		$criteria->compare('player_id_fk',$this->player_id_fk,true);
		$criteria->compare('score',$this->score,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}