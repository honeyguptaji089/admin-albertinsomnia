<?php

/**
 * This is the model class for table "competition_groups".
 *
 * The followings are the available columns in table 'competition_groups':
 * @property string $id
 * @property string $group_id_fk
 * @property string $competition_id_fk
 *
 * The followings are the available model relations:
 * @property Competition $competitionIdFk
 * @property SchoolGroup $groupIdFk
 */
class CompetitionGroups extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CompetitionGroups the static model class
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
		return 'competition_groups';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('group_id_fk, competition_id_fk', 'required'),
			array('group_id_fk, competition_id_fk', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, group_id_fk, competition_id_fk', 'safe', 'on'=>'search'),
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
			'groupIdFk' => array(self::BELONGS_TO, 'SchoolGroup', 'group_id_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'group_id_fk' => 'Group Id Fk',
			'competition_id_fk' => 'Competition Id Fk',
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
		$criteria->compare('group_id_fk',$this->group_id_fk,true);
		$criteria->compare('competition_id_fk',$this->competition_id_fk,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}