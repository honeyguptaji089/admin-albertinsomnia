<?php

/**
 * This is the model class for table "player".
 *
 * The followings are the available columns in table 'player':
 * @property string $id
 * @property string $player_name
 * @property string $player_grade_id_fk
 * @property string $gender
 * @property string $phone_no
 * @property string $user_id_fk
 *
 * The followings are the available model relations:
 * @property UserInfo $userIdFk
 */
class Player extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Player the static model class
	 */
	 
	public $player_grade_id_fk,$file; 
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'player';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('player_name, gender, user_id_fk,address,player_code,payment_status,player_type', 'required'),
			array('player_name,address', 'length', 'max'=>200),
			array('player_class_id_fk, gender, user_id_fk', 'length', 'max'=>10),
			array('phone_no,player_code', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, player_name, player_class_id_fk, gender, phone_no, user_id_fk,player_code,payment_status,player_type', 'safe', 'on'=>'search'),
			array('id, player_name, player_class_id_fk, gender, phone_no, user_id_fk,player_code,payment_status,player_type', 'safe', 'on'=>'outplayer'),
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
			'userIdFk' => array(self::BELONGS_TO, 'UserInfo', 'user_id_fk'),
			'classIdFk' => array(self::BELONGS_TO, 'SchoolClass', 'player_class_id_fk'),
			'demo_game' => array(self::HAS_MANY, 'DemoGameInfo', 'player_id_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'player_name' => 'Player Name',
			'player_class_id_fk' => 'Player Class Id Fk',
			'gender' => 'Gender',
			'phone_no' => 'Phone No',
			'user_id_fk' => 'User Id Fk',
			'address' => 'Address',
			'player_code'=>'Player Code',
			'payment_status'=>'Payment Status',
			'player_type'=>'Player Typer'
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

		$user_id_fk=intVal(Yii::app()->user->user_id);
		$School=new School;
		$School_id=$School->find(array('select'=>'id','condition'=>'user_id_fk=:user_id_fk','params'=>array(':user_id_fk'=>$user_id_fk)))->id;
		$School=null;
		
		$SchoolGrades=new SchoolGrades;
		$SchoolGradesData=$SchoolGrades->findAll(array('select'=>'id','condition'=>'school_id_fk=:school_id_fk','params'=>array(':school_id_fk'=>$School_id)));
		$SchoolGradesArray=array();
		foreach($SchoolGradesData as $data){
			array_push($SchoolGradesArray,$data->id);
		}
		$SchoolGrades=null;
		
		
		$ClassCriteria = new CDbCriteria();
		$ClassCriteria->select="id";
		$ClassCriteria->addInCondition("grade_id_fk",$SchoolGradesArray);
		$SchoolClassData = SchoolClass::model()->findAll($ClassCriteria);
		$SchoolClassArray=array();
		foreach($SchoolClassData as $data){
			array_push($SchoolClassArray,$data->id);
		}
		
		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id,true);
		$criteria->compare('player_name',$this->player_name,true);
		$criteria->compare('player_class_id_fk',$SchoolClassArray,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('phone_no',$this->phone_no,true);
		$criteria->compare('user_id_fk',$this->user_id_fk,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('player_code',$this->player_code,true);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function outplayer()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id,true);
		$criteria->compare('player_name',$this->player_name,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('phone_no',$this->phone_no,true);
		$criteria->compare('player_code',$this->player_code,true);
		$criteria->compare('player_type',$this->player_type,true);
		$criteria->compare('payment_status',$this->payment_status,true);
		$criteria->addCondition("player_type",1);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}