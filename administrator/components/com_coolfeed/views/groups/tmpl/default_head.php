<?php
/**
 * @version		$Id: default_head.php 48 2011-06-25 08:22:19Z trung3388@gmail.com $
 * @copyright	JoomAvatar.com
 * @author		Nguyen Quang Trung
 * @link		http://joomavatar.com
 * @license		License GNU General Public License version 2 or later
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
$user	= JFactory::getUser();
$userId	= $user->get('id');
$listOrder	= $this->state->get('list.ordering');
$listDirn	= $this->state->get('list.direction');
$canOrder	= $user->authorise('core.edit.state', 'com_coolfeed.coolfeeds');
$saveOrder	= $listOrder == 'f.ordering';
?><tr>
	<th width="5">
		<?php echo JText::_('ID'); ?>
	</th>
	<th width="20">
		<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->items); ?>);" />
	</th>
	<th class="title">
		<?php echo JHtml::_('grid.sort', 'JGLOBAL_TITLE', 'g.name', $listDirn, $listOrder); ?>
	</th>				
</tr>

