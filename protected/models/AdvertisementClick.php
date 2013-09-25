<?php

/**
 * This is the model class for table "advertisement_click".
 *
 * The followings are the available columns in table 'advertisement_click':
 * @property string $id
 * @property string $ad_id_fk
 * @property string $ip_address
 * @property string $click_time
 *
 * The followings are the available model relations:
 * @property Advertisement $adIdFk
 */
class AdvertisementClick extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AdvertisementClick the static model class
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
		return 'advertisement_click';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ad_id_fk, ip_address, click_time', 'required'),
			array('ad_id_fk', 'length', 'max'=>10),
			array('ip_address', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, ad_id_fk, ip_address, click_time', 'safe', 'on'=>'search'),
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
			'adIdFk' => array(self::BELONGS_TO, 'Advertisement', 'ad_id_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'ad_id_fk' => 'Ad Id Fk',
			'ip_address' => 'Ip Address',
			'click_time' => 'Click Time',
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
		$tbl_advertisement= Advertisement::model()->tableSchema->name;
		$user_id_fk=intVal(Yii::app()->user->user_id);
		$SponsorModel=new Sponsor;
		$sponsor_id=$SponsorModel->find(array('select'=>'id','condition'=>'user_id_fk=:user_id_fk','params'=>array(':user_id_fk'=>$user_id_fk)))->id;
		$SponsorModel=null;
		
		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id,true);
		$criteria->compare('ad_id_fk',$this->ad_id_fk,true);
		$criteria->compare('ip_address',$this->ip_address,true);
		$criteria->compare('click_time',$this->click_time,true);
		$criteria->alias = 'AdvertisementClick';
		$criteria->join='LEFT JOIN '.$tbl_advertisement.' ON '.$tbl_advertisement.'.id=AdvertisementClick.ad_id_fk';
		$criteria->condition= $tbl_advertisement.'.sponsor_id_fk='.$sponsor_id;

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}