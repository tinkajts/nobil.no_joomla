<?php

/**
 * @version		$Id: view.html.php 38 2011-06-11 17:41:32Z trung3388@gmail.com $
 * @copyright	Copyright (C) 2010 - 2011 Open Source Matters, Inc. All rights reserved.
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
	function display($tpl = null) 
	{
		$model 			= $this->getModel();
		$displayStyle 	= JRequest::getVar('display_style');
		$groupID 		= JRequest::getInt('group_id', 0);
		$feedID 		= JRequest::getInt('feed_id', 0);
		
		if ($displayStyle == 'group')
		{
			$this->items = $model->getItems($groupID);
		} 
		else if ($displayStyle == 'feed')
		{
			$this->items = $model->getItem($feedID);
		}
		
		if (empty($this->items))
		{
			return;
		}
		
		$this->langBox = $model->getLangBox();
		
		if (count($errors = $this->get('Errors'))) 
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}

		parent::display($tpl);
	}
}
