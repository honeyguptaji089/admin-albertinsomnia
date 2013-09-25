<?php

/**
 * This is the model class for table "sponsor".
 *
 * The followings are the available columns in table 'sponsor':
 * @property string $id
 * @property string $sponsor_name
 * @property string $sponsor_address
 * @property string $sponsor_phone
 * @property string $user_id_fk
 * @property string $sponsor_code
 *
 * The followings are the available model relations:
 * @property Advertisement[] $advertisements
 * @property UserInfo $userIdFk
 */
class Sponsor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Sponsor the static model class
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
		return 'sponsor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sponsor_name, user_id_fk, sponsor_code', 'required'),
			array('sponsor_name, sponsor_address, sponsor_phone, sponsor_code', 'length', 'max'=>45),
			array('user_id_fk', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sponsor_name, sponsor_address, sponsor_phone, user_id_fk, sponsor_code', 'safe', 'on'=>'search'),
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
			'advertisements' => array(self::HAS_MANY, 'Advertisement', 'sponsor_id_fk'),
			'userIdFk' => array(self::BELONGS_TO, 'UserInfo', 'user_id_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'sponsor_name' => 'Sponsor Name',
			'sponsor_address' => 'Sponsor Address',
			'sponsor_phone' => 'Sponsor Phone',
			'user_id_fk' => 'User Id Fk',
			'sponsor_code' => 'Sponsor Code',
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
		$criteria->compare('sponsor_name',$this->sponsor_name,true);
		$criteria->compare('sponsor_address',$this->sponsor_address,true);
		$criteria->compare('sponsor_phone',$this->sponsor_phone,true);
		$criteria->compare('user_id_fk',$this->user_id_fk,true);
		$criteria->compare('sponsor_code',$this->sponsor_code,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}