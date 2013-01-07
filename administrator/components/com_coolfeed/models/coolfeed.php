<?php
/**
 * @version		$Id: coolfeed.php 96 2011-10-26 17:59:23Z trung3388@gmail.com $
 * @copyright	JoomAvatar.com
 * @author		Nguyen Quang Trung
 * @link		http://joomavatar.com
 * @license		License GNU General Public License version 2 or later
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla modelform library
jimport('joomla.application.component.modeladmin');

class CoolFeedModelCoolFeed extends JModelAdmin
{
	/**
	 * Method override to check if you can edit an existing record.
	 *
	 * @param	array	$data	An array of input data.
	 * @param	string	$key	The name of the key for the primary key.
	 *
	 * @return	boolean
	 * @since	1.6
	 */
	protected function allowEdit($data = array(), $key = 'coolfeed_id')
	{
		// Check specific edit permission then general edit permission.
		return JFactory::getUser()->authorise('core.edit', 'com_coolfeed.coolfeed.'.((int) isset($data[$key]) ? $data[$key] : 0)) or parent::allowEdit($data, $key);
	}
	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param	type	The table type to instantiate
	 * @param	string	A prefix for the table class name. Optional.
	 * @param	array	Configuration array for model. Optional.
	 * @return	JTable	A database object
	 * @since	1.6
	 */
	public function getTable($type = 'CoolFeed', $prefix = 'CoolFeedTable', $config = array()) 
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	/**
	 * Method to get the record form.
	 *
	 * @param	array	$data		Data for the form.
	 * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
	 * @return	mixed	A JForm object on success, false on failure
	 * @since	1.6
	 */
	
	public function getForm($data = array('control'=>'jform'), $loadData = true) 
	{
		$formName = (!empty($data['formName'])) ? @$data['formName'] : 'coolfeed';
		
		$form = $this->loadForm('com_coolfeed.'.$formName, $formName, array('control' => @$data['control'], 'load_data' => $loadData));
		
		if (empty($form)) 
		{
			return false;
		}
		return $form;
	}
	/**
	 * Method to get the script that have to be included on the form
	 *
	 * @return string	Script files
	 */
	public function getScript() 
	{
		return 'administrator/components/com_coolfeed/models/forms/coolfeed.js';
	}
	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return	mixed	The data for the form.
	 * @since	1.6
	 */
	protected function loadFormData() 
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_coolfeed.edit.coolfeed.data', array());
		if (empty($data)) 
		{
			$data = $this->getItem();
		}
		return $data;
	}
	
	public function save($data)
	{
		$jform 		= JRequest::getVar('jform');
		
		if(!$jform['style_id']) {
			$this->setError(JText::_('COOLFEED_SELECT_A_STYLE')); 
			return false; 
		}
		
		$feedTable  = $this->getTable();

		$feedTable->bind($jform);

		if (!$feedTable->store()) {
			return false;
		}
		
		$feedTable->reorder();
		
		$this->setState($this->getName().'.id', $feedTable->coolfeed_id);
		
		$this->setState($this->getName().'.new', true);
		
		return true;
	}
	
	public function getItem($pk = null)
	{
		$pk	= (!empty($pk)) ? $pk : (int) $this->getState($this->getName().'.id');
		
		$coolFeedTable 	= $this->getTable();
		$coolFeedTable->load($pk);
		$coolFeedProperty 	= $coolFeedTable->getProperties(1);
		$item = JArrayHelper::toObject($coolFeedProperty, 'JObject');
		
		if (property_exists($item, 'params')) {
			$registry = new JRegistry;
			$registry->loadJSON($item->params);
			$item->params = $registry->toArray();
		}

		return $item;
	}
	
	public function delete($pks = array())
	{
		$cids = implode(',', $pks);
		$query = 'DELETE c FROM #__coolfeed AS c '.
				 'WHERE c.coolfeed_id IN ('.$cids.')';
		$this->_db->setQuery($query);
		$this->_db->query();
		
		return true;
	}
	
	public function checkout($recordID = 0){}
	
	public function changeGroup($post) 
	{
		$feedTable = $this->getTable();
		
		if ($feedTable->load($post['coolfeed_id']))
		{
			$feedTable->group_id = $post['group_id'];
			$feedTable->store();
		}
	}
}
