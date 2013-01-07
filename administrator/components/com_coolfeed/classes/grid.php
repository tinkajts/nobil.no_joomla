<?php
/**
 * @package     Joomla.Platform
 * @subpackage  HTML
 *
 * @copyright   Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

/**
 * Utility class for creating HTML Grids
 *
 * @package     Joomla.Platform
 * @subpackage  HTML
 * @since       11.1
 */
require_once JPATH_ROOT.'/administrator/components/com_coolfeed/classes/includes/database.php';
class CFGrid extends AVARTARDatabase
{
	public function groupOptions($noSelect = false)
	{
		$query = 'SELECT * FROM #__coolfeed_group';
		$this->_db->setQuery($query);
		$results = $this->_db->loadObjectList();
		
		$options = array();
		
		if ($noSelect == false) {
			$options[]	= JHtml::_('select.option', '', ' - '.JText::_('CFGRID_SELECT_GROUP').' - ');	
		}
		
		$options[]	= JHtml::_('select.option', 0, JText::_('N/A'));
		
		foreach ($results as $result) {
			$options[]	= JHtml::_('select.option', $result->id, $result->name);
		}
		
		return $options;
	}
}
