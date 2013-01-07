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
$styleForm = $this->form;
?>

<form action="<?php echo JRoute::_('index.php?option=com_coolfeed&layout=edit&coolfeed_id='.(int) $this->item->style_id); ?>" method="post" name="adminForm" id="group-form" class="form-validate">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo JText::_('STYLE_DETAIL'); ?></legend>
			<ul class="adminformlist">
				<li><?php echo $styleForm->getLabel('style_name'); 
				echo $styleForm->getInput('style_name'); ?></li>
			</ul>
		</fieldset>
		<fieldset class="adminform">
			<legend><?php echo JText::_( 'FEED_STYLE' ); ?></legend>
			
			<ul class="adminformlist">
				<li><?php echo $styleForm->getLabel('style_id'); 
				echo $styleForm->getInput('style_id'); ?></li>
				
				<li><?php echo $styleForm->getLabel('style_show_list_title'); 
				echo$styleForm->getInput('style_show_list_title'); ?></li>
				
				<li><?php echo $styleForm->getLabel('style_show_date'); 
				echo$styleForm->getInput('style_show_date'); ?></li>
				
				<li><?php echo $styleForm->getLabel('style_show_author'); 
				echo $styleForm->getInput('style_show_author'); ?></li>
				
				<li><?php echo $styleForm->getLabel('style_show_content'); 
				echo $styleForm->getInput('style_show_content'); ?></li>
				
				<li><?php echo $styleForm->getLabel('style_show_read_more'); 
				echo$styleForm->getInput('style_show_read_more'); ?></li>
				
				<li><?php echo $styleForm->getLabel('style_number_feed'); 
				echo $styleForm->getInput('style_number_feed'); ?></li>
				
				<li><?php echo $styleForm->getLabel('style_show_translate'); 
				echo $styleForm->getInput('style_show_translate'); ?></li>
				
				<li><?php echo $styleForm->getLabel('style_show_search'); 
				echo $styleForm->getInput('style_show_search'); ?></li>
				
				<li><?php echo $styleForm->getLabel('style_limit_word_feed'); 
				echo $styleForm->getInput('style_limit_word_feed'); ?></li>
				
				<li><?php echo $styleForm->getLabel('style_strip_tag'); 
				echo $styleForm->getInput('style_strip_tag'); ?></li>
				
				<li><?php echo $styleForm->getLabel('style_show_active_link'); 
				echo $styleForm->getInput('style_show_active_link'); ?></li>
				
				<!--<li></?php echo $styleForm->getLabel('style_time_reload'); 
				echo $styleForm->getInput('style_time_reload'); ?></li>-->
				
				<li><?php echo $styleForm->getLabel('style_show_social_share'); 
				echo $styleForm->getInput('style_show_social_share'); ?></li>
				
				<li><?php echo $styleForm->getLabel('style_open_first_entry'); 
				echo $styleForm->getInput('style_open_first_entry'); ?></li>
				
				<li><?php echo $styleForm->getLabel('style_modal'); 
				echo $styleForm->getInput('style_modal'); ?></li>
				
				<li><?php echo $styleForm->getLabel('style_modal_size'); 
				echo $styleForm->getInput('style_modal_size'); ?></li>
			
			</ul>
		</fieldset>
		<fieldset class="adminform">
			<legend><?php echo JText::_('FEED_CSS'); ?></legend>
			<ul class="adminformlist">
				<li><?php echo $styleForm->getLabel('style_prefix_class'); 
				echo $styleForm->getInput('style_prefix_class'); ?></li>
			</ul>
		</fieldset>
	</div>
	<div>
		<input type="hidden" name="task" value="group.edit" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>

