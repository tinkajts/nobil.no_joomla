<?php
/**
 * @version		$Id: edit.php 48 2011-06-25 08:22:19Z trung3388@gmail.com $
 * @copyright	JoomAvatar.com
 * @author		Nguyen Quang Trung
 * @link		http://joomavatar.com
 * @license		License GNU General Public License version 2 or later
 */
// No direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
?>

<form action="<?php echo JRoute::_('index.php?option=com_coolfeed&layout=edit&coolfeed_id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="group-form" class="form-validate">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo JText::_('GROUP_GROUP_DETAILS'); ?></legend>
			<ul class="adminformlist">
				<?php foreach($this->form->getFieldset('details') as $field): ?>
					<li><?php echo $field->label; echo $field->input;?></li>
				<?php endforeach; ?>
			</ul>
		</fieldset>
	</div>
	<div>
		<input type="hidden" name="task" value="group.edit" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>

