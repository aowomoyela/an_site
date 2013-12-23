<?php

/**
 * This is the model class for table "story_submission".
 *
 * The followings are the available columns in table 'story_submission':
 * @property integer $submission_id
 * @property integer $story_id
 * @property integer $draft_number
 * @property integer $market_id
 * @property string $submitted
 * @property string $returned
 * @property integer $response_id
 * @property string $notes
 */
class StorySubmission extends CActiveRecord
{
	
	public function set_id_to_new() {
		if ( $this->submission_id == '' || is_null($this->submission_id) ) {
			$this->submission_id = 'new';
			return true;
		} else {
			return false;
		}
	}
	
	public function get($var) {
		if ( in_array($var, array('submission_id', 'story_id', 'draft_number', 'market_id', 'submitted', 'returned', 'response_id', 'notes')) ) {
			return $this->$var;
		} else {
			return NULL;
		}
	}
	
	public function set($var, $value) {
		if ( in_array($var, array('submission_id', 'story_id', 'draft_number', 'market_id', 'submitted', 'returned', 'response_id', 'notes')) ) {
			$this->$var = $value;
		} else {
			return false;
		}
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'story_submission';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('story_id, market_id', 'required'),
			array('story_id, draft_number, market_id, response_id', 'numerical', 'integerOnly'=>true),
			array('submitted, returned, notes', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('submission_id, story_id, draft_number, market_id, submitted, returned, response_id, notes', 'safe', 'on'=>'search'),
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
			'story' => array(self::BELONGS_TO, 'Story', 'story_id'),
			'story_market' => array(self::BELONGS_TO, 'StoryMarket', 'market_id'),
			'story_submission_response' => array(self::BELONGS_TO, 'StorySubmissionResponse', 'response_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'submission_id' => 'Submission',
			'story_id' => 'Story',
			'draft_number' => 'Draft Number',
			'market_id' => 'Market',
			'submitted' => 'Submitted',
			'returned' => 'Returned',
			'response_id' => 'Response',
			'notes' => 'Notes',
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

		$criteria->compare('submission_id',$this->submission_id);
		$criteria->compare('story_id',$this->story_id);
		$criteria->compare('draft_number',$this->draft_number);
		$criteria->compare('market_id',$this->market_id);
		$criteria->compare('submitted',$this->submitted,true);
		$criteria->compare('returned',$this->returned,true);
		$criteria->compare('response_id',$this->response_id);
		$criteria->compare('notes',$this->notes,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return StorySubmission the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
