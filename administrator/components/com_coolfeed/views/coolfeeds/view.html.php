<?php
/**
 * @version		$Id: view.html.php 85 2011-10-25 19:24:16Z trung3388@gmail.com $
 * @copyright	JoomAvatar.com
 * @author		Nguyen Quang Trung
 * @link		http://joomavatar.com
 * @license		License GNU General Public License version 2 or later
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

class CoolFeedViewCoolFeeds extends JView
{
	function display($tpl = null) 
	{
		JHTML::script('coolfeedadmin.js', 'administrator/components/com_coolfeed/assets/js/');
		// Get data from the model
		$items 			= $this->get('Items');
		$pagination 	= $this->get('Pagination');
		$state 			= $this->get('State');
		
		// Check for errors.
		if (count($errors = $this->get('Errors'))) 
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		// Assign data to the view
		$this->items		= $items;
		$this->pagination 	= $pagination;
		$this->state 		= $state;
		 
		// Set the toolbar
		$this->addToolBar();

		// Display the template
		parent::display($tpl);

		// Set the document
		$this->setDocument();
	}

	/**
	 * Setting the toolbar
	 */
	protected function addToolBar() 
	{
		JToolBarHelper::title('CoolFeed: '.JText::_('FEEDS_MANAGER'), 'feed.png');
		JToolBarHelper::addNew('coolfeed.add', 'JTOOLBAR_NEW');
		JToolBarHelper::editList('coolfeed.edit', 'JTOOLBAR_EDIT');
		JToolBarHelper::deleteList('', 'coolfeeds.delete', 'JTOOLBAR_DELETE');
		JToolBarHelper::divider();
		JToolBarHelper::preferences('com_coolfeed');
	}
	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument() 
	{
		$document = JFactory::getDocument();
		$document->setTitle('CoolFeed: '.JText::_('FEEDS_MANAGER'));
	}
}
