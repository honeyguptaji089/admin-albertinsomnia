<?php

/**
 * This is the model class for table "message".
 *
 * The followings are the available columns in table 'message':
 * @property string $id
 * @property string $to_id
 * @property string $from_id
 * @property string $message
 * @property string $date
 * @property string $subject
 * @property string $to_string
 * @property string $from_string
 */
class Message extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Message the static model class
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
		return 'message';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('to_id, from_id, message, date, subject, to_string, from_string', 'required'),
			array('to_id', 'length', 'max'=>10),
			array('from_id, subject', 'length', 'max'=>200),
			array('message', 'length', 'max'=>1000),
			array('to_string, from_string', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, to_id, from_id, message, date, subject, to_string, from_string', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'to_id' => 'To',
			'from_id' => 'from_id',
			'message' => 'Message',
			'date' => 'Date',
			'subject' => 'Subject',
			'to_string' => 'To String',
			'from_string' => 'From String',
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
		$criteria->compare('to_id',$this->to_id,true);
		$criteria->compare('from_id',$this->from_id,true);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('to_string',$this->to_string,true);
		$criteria->compare('from_string',$this->from_string,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}