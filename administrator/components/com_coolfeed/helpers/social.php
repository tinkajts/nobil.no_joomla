<?php
/**
 * @version		$Id: social.php 74 2011-09-30 16:38:39Z trung3388@gmail.com $
 * @copyright	JoomAvatar.com
 * @author		Nguyen Quang Trung
 * @link		http://joomavatar.com
 * @license		License GNU General Public License version 2 or later
 */

class CFSocial
{
	function getSocialBox($arrayButton = array())
	{
		$html = '<div class="cf-social-share-box">';
		foreach ($arrayButton as $button)
		{
			$button = 'get'.$button.'Button';
			$html .= $this->$button();
		}				
		$html .= '</div>';
		return $html;
	}
	
	function getFacebookButton()
	{
		$html 	= '<a class="cf-share-facebook" target="blank" href="http://www.facebook.com/sharer.php">
					<img src="'.JURI::base().'components/com_coolfeed/assets/images/social/facebook.png"/>
				   </a>';
		return $html;
	}
	
	function getTwitterButton()
	{
		$html 	= '<a class="cf-share-twitter" target="_blank" href="http://twitter.com/share">
					<img src="'.JURI::base().'components/com_coolfeed/assets/images/social/twitter.png"/>
				  </a>';
		return $html;
	}
}