<?php
/**
 * @version		$Id: group.php 79 2011-09-30 18:18:13Z trung3388@gmail.com $
 * @copyright	JoomAvatar.com
 * @author		Nguyen Quang Trung
 * @link		http://joomavatar.com
 * @license		License GNU General Public License version 2 or later
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla modelform library
jimport('joomla.application.component.modeladmin');

class CoolFeedModelStyle extends JModelAdmin
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
	protected function allowEdit($data = array(), $key = 'id')
	{
		// Check specific edit permission then general edit permission.
		return JFactory::getUser()->authorise('core.edit', 'com_coolfeed.style.'.((int) isset($data[$key]) ? $data[$key] : 0)) or parent::allowEdit($data, $key);
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
	public function getTable($type = 'Style', $prefix = 'CoolFeedTable', $config = array()) 
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
	public function getForm($data = array(), $loadData = true) 
	{
		// Get the form.
		$form = $this->loadForm('com_coolfeed.style', 'style', array('control' => 'jform', 'load_data' => $loadData));
		
		if (empty($form)) 
		{
			return false;
		}
		return $form;
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
		$data = JFactory::getApplication()->getUserState('com_coolfeed.edit.style.data', array());
		if (empty($data)) 
		{
			$data = $this->getItem();
		}
		return $data;
	}
	
	public function save($data)
	{
		$jform 		= JRequest::getVar('jform');
		
		$styleTable = $this->getTable('style');
		
		$styleTable->bind($jform);
		
		$styleTable->style = json_encode($jform);
		
		$styleTable->store();
		
		$this->setState($this->getName().'.id', $styleTable->style_id);
		
		$this->setState($this->getName().'.new', true);
		
		return true;
	}
	
	public function delete($pks = array())
	{
		$cids = implode(',', $pks);
		$query = ' DELETE FROM #__coolfeed_style WHERE style_id '.
				 ' IN ('.$cids.')';
		$this->_db->setQuery($query);
		$this->_db->query();
		
		$query = ' UPDATE #__coolfeed SET style_id = 0 WHERE style_id '.
				 ' IN ('.$cids.')';
		$this->_db->setQuery($query);
		$this->_db->query();
		
		return true;
	}
	
	public function checkout($recordID = 0){}
	
	public function getItem($pk = null)
	{
		$pk	= (!empty($pk)) ? $pk : (int) $this->getState($this->getName().'.id');
		
		$styleTable = $this->getTable(); 

		$styleTable->load($pk);
		
		$style 				= (array) json_decode($styleTable->style);
		$styleProperty		= $styleTable->getProperties(1);
		$arrayData 			= array_merge($style, $styleProperty);
		
		$item = JArrayHelper::toObject($arrayData, 'JObject');
		
		if (property_exists($item, 'params')) {
			$registry = new JRegistry;
			$registry->loadJSON($item->params);
			$item->params = $registry->toArray();
		}

		return $item;
	}
}
