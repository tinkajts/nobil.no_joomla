<?php

/*----------------------------------------------------------------------
#Youjoomla Images
# ----------------------------------------------------------------------
# Copyright (C) Since 2007 You Joomla. All Rights Reserved.
# Designed by: You Joomla
# License: Copyright Youjoomla.com
# Website: http://www.youjoomla.com
------------------------------------------------------------------------*/

	// no direct access
	defined('_JEXEC') or die('Restricted access');
	/**
	 * Image detection inside article. Searches in intro text and if not found, in full article text
	 *
	 * @param object $row
	 * @return string - image path
	 */
	function yjnf5_image ($row)
	{
			$version = new JVersion;
			if($version->RELEASE > 1.7){	
				
				$img_from_params 	= json_decode($row->images);
				if(isset($img_from_params->image_intro)){
					$img_intro 			= $img_from_params->image_intro;
				}else{
					$img_intro='';
				}
				if(isset($img_from_params->image_fulltext)){
					$image_fulltext 	= $img_from_params->image_fulltext;
				}else{
					$image_fulltext='';
				}
				$img 				= search_yjnf5_image ( $row->introtext );
				$img_full 			= search_yjnf5_image ( $row->fulltext );
				if( $img ) return $img;
				if( $img_full ) return $img_full;
				if( $img_intro ) return $img_intro;
				if( $image_fulltext ) return $image_fulltext;

			}else{
				
				$img = search_yjnf5_image ( $row->introtext );
				if( $img ) return $img;
						
				$img = search_yjnf5_image ( $row->fulltext );
				return $img;			
				
			}	
	}
	/**
	 * Searches for all images inside a text and returns the first one found
	 *
	 * @param string $text
	 * @return string
	 */
	function search_yjnf5_image( $text )
	{		
		preg_match_all("#\<img(.*)src\=\"(.*)\"#Ui", $text, $mathes);		
		return isset($mathes[2][0]) ? $mathes[2][0] : '';			
	}	
?>