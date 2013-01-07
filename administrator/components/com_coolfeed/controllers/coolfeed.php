<?php
/**
 * @version		$Id: coolfeed.php 85 2011-10-25 19:24:16Z trung3388@gmail.com $
 * @copyright	JoomAvatar.com
 * @author		Nguyen Quang Trung
 * @link		http://joomavatar.com
 * @license		License GNU General Public License version 2 or later
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controllerform library
jimport('joomla.application.component.controllerform');

class CoolFeedControllerCoolFeed extends JControllerForm
{
	function changeGroup()
	{
		$post = JRequest::get('post');
		
		if (!$post['coolfeed_id']) return false;
		
		$model = $this->getModel();
		$model->changeGroup($post);
		
		return true;
	}
}
