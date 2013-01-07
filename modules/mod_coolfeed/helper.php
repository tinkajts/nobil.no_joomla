<?php
/**
 * @version		$Id: helper.php 99 2012-04-14 17:42:10Z trung3388@gmail.com $
 * @copyright	JoomAvatar.com
 * @author		Nguyen Quang Trung
 * @link		http://joomavatar.com
 * @license		License GNU General Public License version 2 or later
 */
defined('_JEXEC') or die('Restricted access');
require_once JPATH_ROOT.DS.'components'.DS.'com_coolfeed'.DS.'models'.DS.'coolfeed.php';
require_once JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_coolfeed'.DS.'helpers'.DS.'social.php';
JHTML::_( 'behavior.modal' );
JHTML::script('coolfeed.js', 'components/com_coolfeed/assets/js/');
JHTML::styleSheet('coolfeed.css', 'components/com_coolfeed/assets/css/');
JHTML::styleSheet('customize.css', 'components/com_coolfeed/assets/css/');
$coolFeedModel 	= new CoolFeedModelCoolFeed;
$displayStyle 	= $params->get('display_style');
$groupID 		= $params->get('group_id');
$feedID  		= $params->get('feed_id');

if ($displayStyle == 'feed')
{
	$items = $coolFeedModel->getItem($feedID);	
}
else if ($displayStyle == 'group')
{
	$items = $coolFeedModel->getItems($groupID);
}

if (empty($items))
{
	return;
}
$langBox        = $coolFeedModel->getLangBox();
$user 			= JFactory::getUser();
$levels 		= $user->getAuthorisedViewLevels();
$app 			= JFactory::getApplication();
$paramsCoolFeed = $app->getParams('com_coolfeed')->toObject();
$cfPrefix	 	= 'cf-module-'.rand(); 
$social			= false;
?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
google.load("language", "1");
google.load("feeds", "1");
</script>
<div id="coolfeed" class="<?php echo @$paramsCoolFeed->global_prefix_class; ?>">
<?php
if (!is_array($items))
{
	$item 			= $items;
	$verifyStatus 	= true;
	
	if ($item->style_show_social_share) {
		$social = true;
	}
	
	if (in_array($item->access, $levels) == false) {
		$verifyStatus = false;
	}
	
	if ($item->published == 0) {
		$verifyStatus = false;
	}
	
	$nowDate 	= JFactory::getDate()->toUnix();
	$upDate 	= JFactory::getDate($item->publish_up)->toUnix();
	$downDate 	= JFactory::getDate($item->publish_down)->toUnix();
	
	if ($upDate > 0 && $upDate > $nowDate ) {
		$verifyStatus = false;
	} 
	
	if ($downDate > 0 && $downDate < $nowDate) {
		$verifyStatus = false;
	}
	 
	if ($verifyStatus == true)
	{
		 ?>
	
		<script type="text/javascript">
			
			var options = {};
			options.prefix				= '<?php echo $cfPrefix; ?>';
			options.feedID				= '<?php echo $item->coolfeed_id; ?>';
			options.containerID			= 'cf-module-container-<?php echo $cfPrefix.'-'.$item->coolfeed_id; ?>';
		  	options.feedOptions 		= <?php echo $item->style; ?>;
		  	options.feedOptions.linkRSS = '<?php echo $item->link; ?>';
		  	options.langBOX 			= '<?php echo $langBox; ?>';
		  	options.ReadMore			= '<?php echo JText::_('COOLFEED_READ_MORE', true); ?>';
			options.ClosePost			= '<?php echo JText::_('COOLFEED_CLOSE_THIS_POST', true); ?>';
		  	options.parentObj = {};
		  	CoolFeed.objectCF[options.prefix + 'options-<?php echo $item->coolfeed_id; ?>'] = options;
			
		  	window.addEvent('domready', function(){
		  		 CoolFeed.loadFeeds(CoolFeed.objectCF['<?php echo $cfPrefix; ?>options-<?php echo $item->coolfeed_id; ?>']);
			  	 CoolFeed.enableSearchFeed(<?php echo $item->style_show_search; ?>, CoolFeed.objectCF['<?php echo $cfPrefix; ?>options-<?php echo $item->coolfeed_id; ?>']);
			});
		</script>
		<div class="cf-feed-search-wrapper">
			<?php if ($item->style_show_search == 1){?><input type="text" value="search" name="<?php echo JText::_('COOLFEED_KEYWORD'); ?>" class="cf-feed-search-keyword <?php echo $cfPrefix; ?>cf-feed-search-keyword-<?php echo $item->coolfeed_id; ?>"/>
			<a class="cf-feed-search <?php echo $cfPrefix; ?>cf-feed-search-<?php echo $item->coolfeed_id; ?>"><?php echo JText::_('COOLFEED_SEARCH'); ?></a>
			<div style="clear:both;"></div><?php }?>
		</div>
		
<?php 	echo '<div id="cf-module-container-'.$cfPrefix.'-'.$item->coolfeed_id.'" class="'.((@$item->style_prefix_class) ? @$item->style_prefix_class : @$paramsCoolFeed->global_prefix_class).'"></div>';
?>
		
<?php }
}

if (is_array($items))
{
	jimport('joomla.html.pane');
	
	$pane =& JPane::getInstance('tabs', array('startOffset'=>2));
	
	echo $pane->startPane('cf-pane' );
	
		foreach ($items as $item):

			$verifyStatus = true;
			
			if ($item->style_show_social_share) {
				$social = true;
			}
			
			if (in_array($item->access, $levels) == false) {
				$verifyStatus = false;
			}
			
			if ($item->published == 0) {
				$verifyStatus = false;
			}
			
			$nowDate 	= JFactory::getDate()->toUnix();
			$upDate 	= JFactory::getDate($item->publish_up)->toUnix();
			$downDate 	= JFactory::getDate($item->publish_down)->toUnix();
			
			if ($upDate > 0 && $upDate > $nowDate )
			{
				$verifyStatus = false;
			} 
			if ($downDate > 0 && $downDate < $nowDate)
			{
				$verifyStatus = false;
			}
			 
			if ($verifyStatus == true)
			{
				echo $pane->startPanel($item->title, 'cf-pane-'.$item); ?>
			
				<script type="text/javascript">
					
					var options = {};
					options.prefix				= '<?php echo $cfPrefix; ?>';
					options.feedID				= '<?php echo $item->coolfeed_id; ?>';
					options.containerID			= 'cf-module-container-<?php echo $cfPrefix.'-'.$item->coolfeed_id; ?>';
				  	options.feedOptions 		= <?php echo $item->style; ?>;
				  	options.feedOptions.linkRSS = '<?php echo $item->link; ?>';
				  	options.langBOX 			= '<?php echo $langBox; ?>';
				  	options.ReadMore			= '<?php echo JText::_('COOLFEED_READ_MORE', true); ?>';
					options.ClosePost			= '<?php echo JText::_('COOLFEED_CLOSE_THIS_POST', true); ?>';
				  	options.parentObj = {};
				  	CoolFeed.objectCF[options.prefix + 'options-<?php echo $item->coolfeed_id; ?>'] = options;
					
				  	window.addEvent('domready', function(){
				  		 CoolFeed.loadFeeds(CoolFeed.objectCF['<?php echo $cfPrefix; ?>options-<?php echo $item->coolfeed_id; ?>']);
					  	 CoolFeed.enableSearchFeed(<?php echo $item->style_show_search; ?>, CoolFeed.objectCF['<?php echo $cfPrefix; ?>options-<?php echo $item->coolfeed_id; ?>']);
					});
				</script>
				<div class="cf-feed-search-wrapper">
					<?php if ($item->style_show_search == 1){?><input type="text" value="search" name="<?php echo JText::_('COOLFEED_KEYWORD'); ?>" class="cf-feed-search-keyword <?php echo $cfPrefix; ?>cf-feed-search-keyword-<?php echo $item->coolfeed_id; ?>"/>
					<a class="cf-feed-search <?php echo $cfPrefix; ?>cf-feed-search-<?php echo $item->coolfeed_id; ?>"><?php echo JText::_('COOLFEED_SEARCH'); ?></a>
					<div style="clear:both;"></div><?php }?>
				</div>
				
	<?php 		echo '<div id="cf-module-container-'.$cfPrefix.'-'.$item->coolfeed_id.'" class="'.((@$item->style_prefix_class) ? @$item->style_prefix_class : @$paramsCoolFeed->global_prefix_class).'"></div>';
	?>
				
	<?php 
			echo $pane->endPanel();	
				
			}
			
		endforeach;
		
	echo $pane->endPane();
}
?>
</div>
<?php 
if ($social) {
	$cFSocial = new CFSocial;
	echo $cFSocial->getSocialBox(array('Facebook','Twitter'));
}