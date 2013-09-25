<?php

/**
 * This is the model class for table "user_info".
 *
 * The followings are the available columns in table 'user_info':
 * @property string $id
 * @property string $email
 * @property string $password
 * @property string $user_type
 *
 * The followings are the available model relations:
 * @property Player[] $players
 * @property School[] $schools
 * @property Sponsor[] $sponsors
 * @property Teacher[] $teachers
 */
class UserInfo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserInfo the static model class
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
		return 'user_info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, password, user_type', 'required'),
			//array('email, password', 'length', 'max'=>45),
			//array('user_type', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, email, password, user_type', 'safe', 'on'=>'search'),
			
            
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
			'players' => array(self::HAS_MANY, 'Player', 'user_id_fk'),
			'schools' => array(self::HAS_MANY, 'School', 'user_id_fk'),
			'sponsors' => array(self::HAS_MANY, 'Sponsor', 'user_id_fk'),
			'teachers' => array(self::HAS_MANY, 'Teacher', 'user_id_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'email' => 'Email',
			'password' => 'Password',
			'user_type' => 'User Type',
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
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('user_type',$this->user_type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}