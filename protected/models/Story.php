<?php

/**
 * This is the model class for table "story".
 *
 * The followings are the available columns in table 'story':
 * @property integer $story_id
 * @property string $title
 * @property integer $wordcount
 * @property string $link
 * @property integer $link_active
 * @property string $pullquote
 * @property integer $publication_market_id
 * @property string $publication_date
 * @property integer $available_in_archive
 * @property string $story_text
 * @property string $created
 * @property string $modified
 */
class Story extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'story';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('wordcount, link_active, publication_market_id, available_in_archive', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>150),
			array('link, pullquote, publication_date, story_text, created, modified', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('story_id, title, wordcount, link, link_active, pullquote, publication_market_id, publication_date, available_in_archive, story_text, created, modified', 'safe', 'on'=>'search'),
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
			'story_id' => 'Story',
			'title' => 'Title',
			'wordcount' => 'Wordcount',
			'link' => 'Link',
			'link_active' => 'Link Active',
			'pullquote' => 'Pullquote',
			'publication_market_id' => 'Publication Market',
			'publication_date' => 'Publication Date',
			'available_in_archive' => 'Available In Archive',
			'story_text' => 'Story Text',
			'created' => 'Created',
			'modified' => 'Modified',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('story_id',$this->story_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('wordcount',$this->wordcount);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('link_active',$this->link_active);
		$criteria->compare('pullquote',$this->pullquote,true);
		$criteria->compare('publication_market_id',$this->publication_market_id);
		$criteria->compare('publication_date',$this->publication_date,true);
		$criteria->compare('available_in_archive',$this->available_in_archive);
		$criteria->compare('story_text',$this->story_text,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Story the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
