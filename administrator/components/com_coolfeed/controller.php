<?php
/**
 * @version		$Id: controller.php 85 2011-10-25 19:24:16Z trung3388@gmail.com $
 * @copyright	JoomAvatar.com
 * @author		Nguyen Quang Trung
 * @link		http://joomavatar.com
 * @license		License GNU General Public License version 2 or later
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controller library
jimport('joomla.application.component.controller');
JHTML::styleSheet('coolfeed.css', 'administrator/components/com_coolfeed/assets/css/');
JSubMenuHelper::addEntry(JText::_('Feeds'), 'index.php?option=com_coolfeed');
JSubMenuHelper::addEntry(JText::_('Groups'), 'index.php?option=com_coolfeed&view=groups');
JSubMenuHelper::addEntry(JText::_('Styles'), 'index.php?option=com_coolfeed&view=styles');

class CoolFeedController extends JController
{
	/**
	 * display task
	 *
	 * @return void
	 */
	function display($cachable = false) 
	{
		// set default view if not set
		JRequest::setVar('view', JRequest::getCmd('view', 'coolfeeds'));

		// call parent behavior
		parent::display($cachable);
	}
}
