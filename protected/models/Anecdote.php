<?php

/**
 * This is the model class for table "anecdote".
 *
 * The followings are the available columns in table 'anecdote':
 * @property integer $anecdote_id
 * @property string $anecdote_title
 * @property string $anecdote_text
 * @property string $created
 * @property string $modified
 */
class Anecdote extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'anecdote';
	}

	public function get($var) {
		if ( in_array($var, array('anecdote_title', 'anecdote_text')) ) {
			return $this->$var;
		} else {
			return null;
		}
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('anecdote_title', 'length', 'max'=>100),
			array('anecdote_text, created, modified', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('anecdote_id, anecdote_title, anecdote_text, created, modified', 'safe', 'on'=>'search'),
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
			'anecdote_id' => 'Anecdote',
			'anecdote_title' => 'Anecdote Title',
			'anecdote_text' => 'Anecdote Text',
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

		$criteria->compare('anecdote_id',$this->anecdote_id);
		$criteria->compare('anecdote_title',$this->anecdote_title,true);
		$criteria->compare('anecdote_text',$this->anecdote_text,true);
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
	 * @return Anecdote the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
