<?php
/**
 * @version		$Id: feed.php 59 2011-08-01 14:08:34Z trung3388@gmail.com $
 * @copyright	JoomAvatar.com
 * @author		Nguyen Quang Trung
 * @link		http://joomavatar.com
 * @license		License GNU General Public License version 2 or later
 */

// No direct access to this file
defined('_JEXEC') or die;

// import the list field type
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');

class JFormFieldFeed extends JFormFieldList
{
	/**
	 * The field type.
	 *
	 * @var		string
	 */
	protected $type = 'Feed';

	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return	array		An array of JHtml options.
	 */
	protected function getOptions() 
	{
		$db 	= JFactory::getDBO();
		$query 	= $db->getQuery(true);
		
		$query->select('#__coolfeed.coolfeed_id as id, title');
		$query->from('#__coolfeed');
		$db->setQuery((string)$query);
		
		$messages 	= $db->loadObjectList();
		
		$options 	= array();
		$options[] 	= JHtml::_('select.option', 0, JText::_('FIELD_FEED_SELECT_FEED'));
		
		if ($messages)
		{
			foreach($messages as $message) 
			{
				$options[] = JHtml::_('select.option', $message->id, $message->title);
			}
		}
		
		$options = array_merge(parent::getOptions(), $options);
		
		return $options;
	}
}
