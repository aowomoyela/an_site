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
	public function get($var) {
		if ( in_array($var, array('title', 'wordcount', 'link', 'link_active', 'pullquote', 'available_in_archive')) ) {
			return $this->$var;
		} else {
			return NULL;
		}
	}

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
			'story_market' => array(self::BELONGS_TO, 'StoryMarket', 'publication_market_id'),
			'story_link' => array(self::HAS_MANY, 'StoryLink', 'story_id'),
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

	public function afterFind() {
		
	}

	public function get_catalog_block() {
		$block = "<div class='story_catalog_block'>\r\n";
		// If the story has an active link set, link the title. If not, see if it's available in the archives and link that. Else, just display.
		if ( $this->link != '' && !is_null($this->link) && $this->link_active == 1 ) {
			$display_title = '<a href="'.$this->link.'">'.$this->title.'</a>';
		} elseif ($this->available_in_archive == 1) {
			$archive_link = Yii::app()->createUrl('fiction/archive/'.$this->archive_url_title);
			$display_title = '<a href="'.$archive_link.'">'.$this->title.'</a>';
		} else {
			$display_title = $this->title;
		}
		// We're only interested in the month and year of publication.
		$display_date = date( 'F Y', strtotime($this->publication_date) );
		if ( isset($this->story_market) ) { $display_market = $this->story_market->title.', '; } else { $display_market = ''; }
		// Display the actual header.
		$block.= "<h2>".$display_title." - ".$display_market.' '.$display_date."</h2>\r\n";
		// Pullquote.
		$block.= "<blockquote class='story_catalog_pullquote'>".$this->pullquote."</blockquote>\r\n";
		// Any additional links, such as interviews and anthologies.
		if (count($this->story_link) > 0) {
			foreach ( $this->story_link as $story_link ) {
				$block.= "<div class='story_link'>".$story_link->link_text."</div>\r\n";
			}
		}
		// End the div.
		$block.= "</div><!--END div.story -->\r\n\r\n";
		// Return.
		return $block;
	}

	public function get_archive_story_text() {
		if ($this->available_in_archive == 1 && $this->story_text != '' && !is_null($this->story_text)) {
			return $this->story_text;
		} else {
			return 'The text of this story is not available.';
		}
	}
}
