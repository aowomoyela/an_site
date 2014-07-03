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
	public function set_id_to_new() {
		if ( $this->story_id == '' || is_null($this->story_id) ) {
			$this->story_id = 'new';
			return true;
		} else {
			return false;
		}
	}

	public function get($var) {
		if ( in_array($var, array('story_id', 'title', 'wordcount', 'link', 'link_active', 'pullquote', 'available_in_archive', 'publication_market_id', )) ) {
			return $this->$var;
		} elseif ( in_array($var, array('publication_category')) ) {
			switch($var) {
				case 'publication_category':
					return SiteUtility::querySingleColumn("select publication_category_id from link_story_publication_category where story_id = '".$this->story_id."'");
				break;
				
				default:
					// This should never fire.
					return NULL;
				break;
			}
		} else {
			return NULL;
		}
	}

	public function set($var, $value) {
		if ( in_array($var, array(
					'title', 'wordcount', 'link', 'link_active', 'pullquote', 'published', 'publication_market_id', 'publication_date',
					'available_in_archive', 'archive_url_title', 'story_text'
					)) ) {
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
			// Unwise hacky stuff as a temporary measure. Folks, don't do what I'm doing.
			#array('wordcount, publication_market_id,', 'numerical', 'integerOnly'=>true),
			#array('title', 'length', 'max'=>150),
			array('title, wordcount, link, link_active, pullquote, publication_market_id, publication_date, available_in_archive, story_text', 'safe'),
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
			'story_submission' => array(self::HAS_MANY, 'StorySubmission', 'story_id'),
			'story_publication_category' => array(self::MANY_MANY, 'StoryPublicationCategory', 'link_story_publication_category(story_id, publication_category_id)'),
			#'story_publication_category' => array(self::HAS_MANY, 'StoryPublicationCategory', 'publication_category_id', 'through' => 'link_story_publication_category'),
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
		if ( isset($this->story_market) ) { $display_market = $this->story_market->title; } else { $display_market = ''; }
		// Display the actual header.
		$block.= "<h2>".$display_title;
		if ( $display_market != '' && !is_null($display_market) ) { $block.= ' &mdash; '.$display_market; }
		if ( !is_null($this->publication_date) && $this->publication_date!='0000-00-00' && $this->publication_date!='' ) {
			$block.= ', '.$display_date;
		}
		$block.= "</h2>\r\n";
		// Pullquote.
		$block.= "<blockquote class='story_catalog_pullquote'>".trim($this->pullquote)."</blockquote>\r\n";
		// If it's available in the archive and the archive hasn't been linked above, let people know.
		if ( $this->available_in_archive == 1 && $this->link != '' && !is_null($this->link) && $this->link_active == 1 ) {
			$block.= '<div class="story_link"><a href="'.Yii::app()->createUrl('fiction/archive').'/'.$this->archive_url_title.'">Read it on-site</a> in the archive.</div>'."\r\n";
		}
		// Any additional links, such as interviews and anthologies.
		if (count($this->story_link) > 0) {
			// Sort the links.
			#$sorted_links = SiteUtility::sort_all_found_by_property($this->story_link, 'link_text');
			// Add the links to the display list.
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
