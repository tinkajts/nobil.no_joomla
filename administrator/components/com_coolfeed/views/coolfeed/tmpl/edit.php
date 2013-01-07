<?php
/**
 * @version		$Id: edit.php 85 2011-10-25 19:24:16Z trung3388@gmail.com $
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

<form action="<?php echo JRoute::_('index.php?option=com_coolfeed&layout=edit&coolfeed_id='.(int) $this->item->coolfeed_id); ?>" method="post" name="adminForm" id="coolfeed-form" class="form-validate">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo JText::_( 'FEED_DETAILS' ); ?></legend>
			<ul class="adminformlist">
				<?php foreach($this->coolFeedForm->getFieldset('details') as $field): ?>
					<li><?php echo $field->label; echo $field->input;?></li>
				<?php endforeach; ?>
			</ul>
		</fieldset>
	</div>
	<div class="width-40 fltrt">
		<fieldset class="adminform">
			<legend><?php echo JText::_( 'FEED_GROUP' ); ?></legend>
			<?php
				$styleForm = $this->styleForm;
			?>
			<ul class="adminformlist">
				<?php foreach($this->coolFeedForm->getFieldset('group') as $field): ?>
					<li><?php echo $field->label; echo $field->input;?></li>
				<?php endforeach; ?>
			</ul>
		</fieldset>
		<fieldset class="adminform">
			<legend><?php echo JText::_( 'FEED_STYLE' ); ?></legend>
			<ul class="adminformlist">
				<?php foreach($this->coolFeedForm->getFieldset('style') as $field): ?>
					<li><?php echo $field->label; echo $field->input;?></li>
				<?php endforeach; ?>
			</ul>
		</fieldset>
	</div>
	<div>
		<input type="hidden" name="task" value="coolfeed.edit" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>

