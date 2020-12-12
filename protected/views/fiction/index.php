<?php
$baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
		 $cs->registerCssFile($baseUrl.'/css/brushed_metal/tipjar.css');

	#echo '<div id="submenu_horizontal">'."\r\n";
	#	$this->widget('zii.widgets.CMenu', $secondary_navigation);
	#echo '</div>'."\r\n";

	foreach($stories as $story) {
	#	echo $story->get_catalog_block();
            
		$block = "<div class='story_catalog_block'>\r\n";// If the story has an active link set, link the title. If not, see if it's available in the archives and link that. Else, just display.
		if ( $story['link'] != '' && !is_null($story['link']) && $story['link_active'] == 1 ) {
			$display_title = '<a href="'.$story['link'].'">'.$story['title'].'</a>';
		} elseif ($story['available_in_archive'] == 1) {
			$archive_link = Yii::app()->createUrl('fiction/archive/'.$story['archive_url_title']);
			$display_title = '<a href="'.$archive_link.'">'.$story['title'].'</a>';
		} else {
			$display_title = $story['title'];
		}
		
		// We're only interested in the month and year of publication.
		$display_date = date( 'F Y', strtotime($story['publication_date']) );
		if ( isset($story['publication_market']) ) { $display_market = $story['publication_market']; } else { $display_market = ''; }
		// Display the actual header.
		$block.= "<h2>".$display_title;
		if ( $display_market != '' && !is_null($display_market) ) { $block.= ' &mdash; '.$display_market; }
		if ( !is_null($story['publication_date']) && $story['publication_date']!='0000-00-00' && $story['publication_date']!='' ) {
			$block.= ', '.$display_date;
		}
		$block.= "</h2>\r\n";
                
		// Pullquote.
		$block.= "<blockquote class='story_catalog_pullquote'>".trim($story['pullquote'])."</blockquote>\r\n";
		// If it's available in the archive and the archive hasn't been linked above, let people know.
		#if ( $story['available_in_archive'] == 1 && $story['link'] != '' && !is_null($story['link']) && $story['link_active'] == 1 ) {
		#	$block.= '<div class="story_link"><a href="'.Yii::app()->createUrl('fiction/archive').'/'.$story['archive_url_title'].'">Read it on-site</a> in the archive.</div>'."\r\n";
		#}
            /*
		// Any additional links, such as interviews and anthologies.
		if (count($this->story_link) > 0) {
			// Sort the links.
			#$sorted_links = SiteUtility::sort_all_found_by_property($this->story_link, 'link_text');
			// Add the links to the display list.
			foreach ( $this->story_link as $story_link ) {
				$block.= "<div class='story_link'>".$story_link->link_text."</div>\r\n";
			}
		}
		
            */
                // End the div.
		$block.= "</div><!--END div.story -->\r\n\r\n";
                echo $block;
	}
?>

<div class="error_notice">
    <em>We're experiencing technical difficulties.  Some parts of this site may not work as expected.</em>
</div>

<?php
	/***********************/
	/* PAGE FINAL - Tipjar */
	/***********************/
	
	SiteElement::get_tipjar('fiction');
?>