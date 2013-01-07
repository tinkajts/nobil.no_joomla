<?php
/**
 * @version		$Id: coolfeeds.php 81 2011-10-15 03:02:55Z trung3388@gmail.com $
 * @copyright	JoomAvatar.com
 * @author		Nguyen Quang Trung
 * @link		http://joomavatar.com
 * @license		License GNU General Public License version 2 or later
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import the Joomla modellist library
jimport('joomla.application.component.modellist');

class CoolFeedModelCoolFeeds extends JModelList
{
	protected $context = 'cf.coolfeeds';
	/**
	 * Constructor.
	 *
	 * @param	array	An optional associative array of configuration settings.
	 * @see		JController
	 * @since	1.6
	 */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				'id', 'f.coolfeed_id',
				'title', 'f.title',
				'published', 'f.published',
				'access', 'f.access', 'access_level',
				'ordering', 'f.ordering',
				'publish_up', 'f.publish_up',
				'publish_down', 'f.publish_down',
				'f.group_id'
			);
		}

		parent::__construct($config);
	}
	
	/**
	 * Method to build an SQL query to load the list data.
	 *
	 * @return	string	An SQL query
	 */
	protected function getListQuery() 
	{
		// Create a new query object.
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);

		// Select some fields
		$query->select('*, f.title as feed_title,
						f.ordering as feed_ordering
		');

		// From the hello table
		$query->from('#__coolfeed AS f');
		
		// Join over the asset groups.
		$query->select('ag.title AS access_level');
		$query->join('LEFT', '#__viewlevels AS ag ON ag.id = f.access');
		
		// Filter by access level.
		if ($access = $this->getState('filter.access')) {
			$query->where('f.access = '.(int) $access);
		}

		// Filter by published state.
		$published = $this->getState('filter.state');
		if (is_numeric($published)) {
			$query->where('f.published = '.(int) $published);
		}
		else if ($published === '') {
			$query->where('(f.published IN (0, 1))');
		}

		// Filter by search in title
		$search = $this->getState('filter.search');
		if (!empty($search))
		{
			if (stripos($search, 'id:') === 0) {
				$query->where('f.id = '.(int) substr($search, 3));
			}
			else
			{
				$search = $db->Quote('%'.$db->getEscaped($search, true).'%');
				$query->where('(f.title LIKE '.$search.')');
			}
		}
		
		// Filter by group
		$groupID = $this->getState('filter.group');
		
		if (is_numeric($groupID)) {
			$query->where('f.group_id = '.(int) $groupID);
		}

		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering');
		$orderDirn	= $this->state->get('list.direction');
		
		$query->order($db->getEscaped($orderCol.' '.$orderDirn));
		
		return $query;
	}
	
	protected function populateState($ordering = null, $direction = null)
	{
		// Initialise variables.
		$app = JFactory::getApplication('administrator');

		// Load the filter state.
		$group = $this->getUserStateFromRequest($this->context.'.filter.group', 'filter_group');
		$this->setState('filter.group', $group);
		
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$accessId = $this->getUserStateFromRequest($this->context.'.filter.access', 'filter_access', null, 'int');
		$this->setState('filter.access', $accessId);

		$state = $this->getUserStateFromRequest($this->context.'.filter.state', 'filter_published', '', 'string');
		$this->setState('filter.state', $state);
		
		$ordering = $this->getUserStateFromRequest($this->context.'.ordercol', 'filter_order', 'f.title');
		$orderDir = $this->getUserStateFromRequest($this->context.'.orderdirn', 'filter_order_Dir', 'asc');
		
		// Load the parameters.
		$params = JComponentHelper::getParams('com_coolfeed');
		$this->setState('params', $params);

		parent::populateState('f.coolfeed_id', 'desc');
	}
}
