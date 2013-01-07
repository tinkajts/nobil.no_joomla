<?php
/**
 * @version		$Id: group.php 70 2011-09-30 15:42:23Z trung3388@gmail.com $
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

class JFormFieldGroup extends JFormFieldList
{
	/**
	 * The field type.
	 *
	 * @var		string
	 */
	protected $type = 'Group';

	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return	array		An array of JHtml options.
	 */
	public function getOptions() 
	{
		$db 	= JFactory::getDBO();
		$query  = $db->getQuery(true);
		
		$query->select('#__coolfeed_group.id as id,name');
		$query->from('#__coolfeed_group');
		$db->setQuery((string)$query);
		
		$messages 	= $db->loadObjectList();
		
		$options 	= array();
		$options[] 	= JHtml::_('select.option', 0, JText::_('FIELD_GROUP_SELECT_GROUP'));
		
		if ($messages)
		{
			foreach($messages as $message) 
			{
				$options[] = JHtml::_('select.option', $message->id, $message->name);
			}
		}
		
		$options = array_merge(parent::getOptions(), $options);
		
		return $options;
	}
}
