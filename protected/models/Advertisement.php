<?php

/**
 * This is the model class for table "advertisement".
 *
 * The followings are the available columns in table 'advertisement':
 * @property string $id
 * @property string $ad_name
 * @property string $description
 * @property string $navigation_url
 * @property string $position
 * @property string $image_url
 * @property string $sponsor_id_fk
 *
 * The followings are the available model relations:
 * @property Sponsor $sponsorIdFk
 * @property AdvertisementClick[] $advertisementClicks
 * @property CompetitionAdvertisement[] $competitionAdvertisements
 */
class Advertisement extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Advertisement the static model class
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
		return 'advertisement';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ad_name, description, navigation_url, position, sponsor_id_fk', 'required'),
			array('ad_name', 'length', 'max'=>50),
			array('description', 'length', 'max'=>500),
			array('navigation_url, image_url', 'length', 'max'=>200),
			array('position', 'length', 'max'=>45),
			array('sponsor_id_fk', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, ad_name, description, navigation_url, position, image_url, sponsor_id_fk', 'safe', 'on'=>'search'),
			//array('image_url', 'file', 'types'=>'jpg, gif, png'),
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
			'sponsorIdFk' => array(self::BELONGS_TO, 'Sponsor', 'sponsor_id_fk'),
			'advertisementClicks' => array(self::HAS_MANY, 'AdvertisementClick', 'ad_id_fk'),
			'competitionAdvertisements' => array(self::HAS_MANY, 'CompetitionAdvertisement', 'ad_id_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'ad_name' => 'Ad Name',
			'description' => 'Description',
			'navigation_url' => 'Navigation Url',
			'position' => 'Position',
			'image_url' => 'Image Url',
			'sponsor_id_fk' => 'Sponsor Id Fk',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($id)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		
		
		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id,true);
		$criteria->compare('ad_name',$this->ad_name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('navigation_url',$this->navigation_url,true);
		$criteria->compare('position',$this->position,true);
		$criteria->compare('image_url',$this->image_url,true);
		if($id==0)
			$criteria->compare('sponsor_id_fk',$this->sponsor_id_fk,true);
		else
			$criteria->compare('sponsor_id_fk',$id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}