<?php
/**
 * @version		$Id: default_body.php 85 2011-10-25 19:24:16Z trung3388@gmail.com $
 * @copyright	JoomAvatar.com
 * @author		Nguyen Quang Trung
 * @link		http://joomavatar.com
 * @license		License GNU General Public License version 2 or later
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
require_once JPATH_ROOT.'/administrator/components/com_coolfeed/classes/grid.php';
$listOrder	= $this->state->get('list.ordering');
$listDirn	= $this->state->get('list.direction');
$saveOrder	= $listOrder == 'f.ordering';
$groupTable = JTable::getInstance('group', 'coolfeedtable');
$cfGrid = new CFGrid();
$confirmChangeGroup = JText::_('COOLFEEDS_CHANGE_GROUP');
?>
<?php foreach($this->items as $i => $item): ?>
	<tr class="row<?php echo $i % 2; ?>">
		<td>
			<?php echo $item->coolfeed_id; ?>
		</td>
		<td>
			<?php echo JHtml::_('grid.id', $i, $item->coolfeed_id); ?>
		</td>
		<td>
			<a href="<?php echo JRoute::_('index.php?option=com_coolfeed&task=coolfeed.edit&coolfeed_id=' . $item->coolfeed_id); ?>">
				<?php echo $item->feed_title; ?>
			</a>
		</td>
		<td>
			<?php echo $item->link; ?>
		</td>
		<td align="center">
			<select name="filter_group_<?php echo $item->coolfeed_id; ?>" class="inputbox" onchange="CoolFeedAdmin.changeGroup(this, <?php echo $item->coolfeed_id; ?>, <?php echo $item->group_id; ?>, '<?php echo $confirmChangeGroup; ?>');">
				<?php echo JHtml::_('select.options', $cfGrid->groupOptions(true), 'value', 'text', $item->group_id , true);?>
			</select>
		</td>
		<td class="center">
			<?php echo JHtml::_('jgrid.published', $item->published, $i, 'coolfeeds.', $canChange = true, 'cb'); ?>
		</td>
		<td class="order">
			<?php $disabled = $saveOrder ?  '' : 'disabled="disabled"'; ?>
			<input type="text" name="order[]" size="5" value="<?php echo $item->feed_ordering;?>" <?php echo $disabled ?> class="text-area-order" />
		</td>
		<td class="center">
			<?php echo $this->escape($item->access_level); ?>
		</td>
	</tr>
<?php endforeach; ?>
<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
