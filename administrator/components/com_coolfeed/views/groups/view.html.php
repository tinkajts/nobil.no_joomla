<?php
/**
 * @version		$Id: view.html.php 94 2011-10-26 17:31:27Z trung3388@gmail.com $
 * @copyright	JoomAvatar.com
 * @author		Nguyen Quang Trung
 * @link		http://joomavatar.com
 * @license		License GNU General Public License version 2 or later
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

class CoolFeedViewGroups extends JView
{
	function display($tpl = null) 
	{
		// Get data from the model
		$items = $this->get('Items');
		$pagination = $this->get('Pagination');
		$state = $this->get('State');
		
		// Check for errors.
		if (count($errors = $this->get('Errors'))) 
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		// Assign data to the view
		$this->items = $items;
		$this->pagination = $pagination;
		$this->state = $state;

		// Set the toolbar
		$this->addToolBar();

		// Display the template
		parent::display($tpl);

		// Set the document
		$this->setDocument();
	}

	protected function addToolBar() 
	{
		JToolBarHelper::title('CoolFeed: '.JText::_('GROUP_GROUP_MANAGER'), 'group.png');
		JToolBarHelper::addNew('group.add', 'JTOOLBAR_NEW');
		JToolBarHelper::editList('group.edit', 'JTOOLBAR_EDIT');
		JToolBarHelper::deleteList('', 'groups.delete', 'JTOOLBAR_DELETE');
		JToolBarHelper::preferences('com_coolfeed');
	}
	
	protected function setDocument() 
	{
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('GROUP_GROUP_MANAGER'));
	}
}
