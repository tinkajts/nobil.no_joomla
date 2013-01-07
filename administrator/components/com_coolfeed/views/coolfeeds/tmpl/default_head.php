<?php
/**
 * @version		$Id: default_head.php 81 2011-10-15 03:02:55Z trung3388@gmail.com $
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
		<?php echo JHtml::_('grid.sort', 'JGLOBAL_TITLE', 'f.title', $listDirn, $listOrder); ?>
	</th>			
	<th>
		<?php echo JText::_('FEEDS_LINK'); ?>
	</th>
	<th width="5%">
		<?php echo JHtml::_('grid.sort', 'GROUP', 'f.group_id', $listDirn, $listOrder); ?>
	</th>
	<th width="5%">
		<?php echo JHtml::_('grid.sort', 'JPUBLISHED', 'f.published', $listDirn, $listOrder); ?>
	</th>
	<th width="10%">
		<?php echo JHtml::_('grid.sort',  'JGRID_HEADING_ORDERING', 'f.ordering', $listDirn, $listOrder); ?>
		<?php if ($canOrder && $saveOrder) :?>
			<?php echo JHtml::_('grid.order',  $this->items, 'filesave.png', 'coolfeeds.saveorder'); ?>
		<?php endif; ?>
	</th>
	<th width="5%">
		<?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ACCESS', 'f.access', $listDirn, $listOrder); ?>
	</th>
</tr>

