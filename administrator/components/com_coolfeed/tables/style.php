<?php
/**
 * @version		$Id: style.php 85 2011-10-25 19:24:16Z trung3388@gmail.com $
 * @copyright	JoomAvatar.com
 * @author		Nguyen Quang Trung
 * @link		http://joomavatar.com
 * @license		License GNU General Public License version 2 or later
 */

// No direct access
defined('_JEXEC') or die('Restricted access');

// import Joomla table library
jimport('joomla.database.table');

class CoolFeedTableStyle extends JTable
{
	public $style = '{
						"style_show_date":"1",
						"style_show_author":"1",
						"style_show_content":"1",
						"style_number_feed":"5",
						"style_show_translate":"1",
						"style_show_search":"1",
						"style_limit_word_feed":"",
						"style_show_active_link":"1",
						"style_rtl":"0",
						"style_strip_tag":"0",
						"style_time_reload":"0",
						"style_show_social_share":"1",
						"style_show_list_title":"1",
						"style_show_read_more":"1",
						"style_prefix_class":"",
						"style_open_first_entry":"1",
					}'; 
	public $style_name = null;
	/**
	 * Constructor
	 * @param object Database connector object
	 */
	function __construct(&$db) 
	{
		parent::__construct('#__coolfeed_style', 'style_id', $db);
	}
	
}
