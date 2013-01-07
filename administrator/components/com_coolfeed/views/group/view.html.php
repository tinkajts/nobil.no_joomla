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

class CoolFeedViewGroup extends JView
{
	public function display($tpl = null) 
	{
		// get the Data
		$model	 = $this->getModel();
		$form	 = $model->getForm();
		$item 	 = $this->get('Item');
		$script  = $this->get('Script');
		
		// Check for errors.
		if (count($errors = $this->get('Errors'))) 
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		
		// Assign the Data
		$this->form		 	= $form;
		$this->item 		= $item;
		$this->script 		= $script;
		
		// Set the toolbar
		$this->addToolBar();

		// Display the template
		parent::display($tpl);

		// Set the document
		$this->setDocument();
	}

	protected function addToolBar() 
	{
		JRequest::setVar('hidemainmenu', true);
		$user = JFactory::getUser();
		$userId = $user->id;
		$isNew = $this->item->id == 0;

		JToolBarHelper::title($isNew ? 'CoolFeed: '.JText::_('GROUP_NEW_GROUP') : 'CoolFeed: '.JText::_('GROUP_EDIT_GROUP'), 'group.png');
		JToolBarHelper::apply('group.apply', 'JTOOLBAR_APPLY');
		JToolBarHelper::save('group.save', 'JTOOLBAR_SAVE');
		JToolBarHelper::custom('group.save2new', 'save-new.png', 'save-new_f2.png', 'JTOOLBAR_SAVE_AND_NEW', false);
		JToolBarHelper::cancel('group.cancel', 'JTOOLBAR_CLOSE');
		JToolBarHelper::preferences('com_coolfeed');
	}
	
	protected function setDocument() 
	{
		$isNew = $this->item->id == 0;
		$document = JFactory::getDocument();
		$document->setTitle($isNew ? 'CoolFeed: '.JText::_('GROUP_NEW_GROUP') : 'CoolFeed: '.JText::_('GROUP_EDIT_GROUP'));
		$document->addScript(JURI::root() . $this->script);
		$document->addScript(JURI::root() . "/administrator/components/com_coolfeed/views/coolfeed/submitbutton.js");
	}
}
