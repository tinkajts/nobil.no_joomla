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

class CoolFeedViewCoolFeed extends JView
{
	public function display($tpl = null) 
	{
		// get the Data
		$model		 	= $this->getModel();
		$coolFeedForm 	= $model->getForm();
		$styleForm 		= $model->getForm($data = array('formName'=>'style', 'control'=>'jformStyle'));
		
		$item = $this->get('Item');
		$script = $this->get('Script');
		
		// Check for errors.
		if (count($errors = $this->get('Errors'))) 
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		
		// Assign the Data
		$this->coolFeedForm = $coolFeedForm;
		$this->styleForm 	= $styleForm;
		$this->item 		= $item;
		$this->script 		= $script;
		
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
		JRequest::setVar('hidemainmenu', true);
		$user = JFactory::getUser();
		$userId = $user->id;
		$isNew = $this->item->coolfeed_id == 0;

		JToolBarHelper::title($isNew ? 'CoolFeed: '.JText::_('FEED_MANAGER_NEW') : 'CoolFeed: '.JText::_('FEED_MANAGER_EDIT'), 'feed.png');
		JToolBarHelper::apply('coolfeed.apply', 'JTOOLBAR_APPLY');
		JToolBarHelper::save('coolfeed.save', 'JTOOLBAR_SAVE');
		JToolBarHelper::custom('coolfeed.save2new', 'save-new.png', 'save-new_f2.png', 'JTOOLBAR_SAVE_AND_NEW', false);
		JToolBarHelper::cancel('coolfeed.cancel', 'JTOOLBAR_CLOSE');
		JToolBarHelper::preferences('com_coolfeed');
	}
	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument() 
	{
		$isNew = $this->item->coolfeed_id == 0;
		$document = JFactory::getDocument();
		$document->setTitle($isNew ? 'CoolFeed: '.JText::_('FEED_MANAGER_NEW') : 'CoolFeed: '.JText::_('FEED_MANAGER_EDIT'));
		$document->addScript(JURI::root() . $this->script);
		$document->addScript(JURI::root() . "/administrator/components/com_coolfeed/views/coolfeed/submitbutton.js");
	}
}
