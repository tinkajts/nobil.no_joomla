<?php
/**
 * @version		$Id: view.html.php 48 2011-06-25 08:22:19Z trung3388@gmail.com $
 * @copyright	JoomAvatar.com
 * @author		Nguyen Quang Trung
 * @link		http://joomavatar.com
 * @license		License GNU General Public License version 2 or later
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

class CoolFeedViewStyle extends JView
{
	public function display($tpl = null) 
	{
		// get the Data
		$model	 = $this->getModel();
		$form	 = $model->getForm();
		$item 	 = $this->get('Item');
		
		
		// Check for errors.
		if (count($errors = $this->get('Errors'))) 
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		
		// Assign the Data
		$this->form		 	= $form;
		$this->item 		= $item;
		
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
		$isNew = $this->item->style_id == 0;

		JToolBarHelper::title($isNew ? 'CoolFeed: '.JText::_('STYLE_NEW_STYLE') : 'CoolFeed: '.JText::_('STYLE_EDIT_STYLE'), 'group.png');
		JToolBarHelper::apply('style.apply', 'JTOOLBAR_APPLY');
		JToolBarHelper::save('style.save', 'JTOOLBAR_SAVE');
		JToolBarHelper::custom('style.save2new', 'save-new.png', 'save-new_f2.png', 'JTOOLBAR_SAVE_AND_NEW', false);
		JToolBarHelper::cancel('style.cancel', 'JTOOLBAR_CLOSE');
		JToolBarHelper::preferences('com_coolfeed');
	}
	
	protected function setDocument() 
	{
		$isNew = $this->item->style_id == 0;
		$document = JFactory::getDocument();
		$document->setTitle($isNew ? 'CoolFeed: '.JText::_('STYLE_NEW_STYLE') : 'CoolFeed: '.JText::_('STYLE_EDIT_STYLE'));
		//$document->addScript(JURI::root() . "/administrator/components/com_coolfeed/views/coolfeed/submitbutton.js");
	}
}
