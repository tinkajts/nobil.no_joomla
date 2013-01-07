<?php
/**
 * @version		$Id: coolfeed.php 100 2012-04-14 17:42:51Z trung3388@gmail.com $
 * @copyright	JoomAvatar.com
 * @author		Nguyen Quang Trung
 * @link		http://joomavatar.com
 * @license		License GNU General Public License version 2 or later
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');

class plgContentCoolFeed extends JPlugin
{
	
	public function onContentPrepare($context, &$article, &$params, $limitstart)
	{
		$app = JFactory::getApplication();
		if ($app->isAdmin()) return;
		require_once JPATH_ROOT.DS.'components'.DS.'com_coolfeed'.DS.'models'.DS.'coolfeed.php';
		require_once JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_coolfeed'.DS.'helpers'.DS.'social.php';
		JHTML::script('coolfeed.js', 'components/com_coolfeed/assets/js/');
		JHTML::styleSheet('coolfeed.css', 'components/com_coolfeed/assets/css/');
		JHTML::styleSheet('customize.css', 'components/com_coolfeed/assets/css/');
		$this->loadLanguage('plg_content_coolfeed');	
		$coolFeedModel 	= new CoolFeedModelCoolFeed;
		$langBox        = $coolFeedModel->getLangBox();
		$user 			= JFactory::getUser();
		$levels 		= $user->getAuthorisedViewLevels();
		$app 			= JFactory::getApplication();
		$paramsCoolFeed = $app->getParams('com_coolfeed')->toObject();
		$social = false;
		
		?>
		
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<script type="text/javascript">
		google.load("language", "1");
		google.load("feeds", "1");
		</script>
		
		<?php
		jimport('joomla.html.pane');
		$text = &$article->text;
		$pattern = '/\{coolfeed[a-z0-9=\s]*\/\}/i';
		preg_match_all($pattern, $text, $matches);
		$arrayFormat = array();
		 
		foreach ($matches[0] as $format)
		{
			$matchFeed  = false;
			$matchGroup = false;
			
			$pattern = '/\bfeed=[0-9]*\b/';
			preg_match($pattern, $format, $feedInfo);
			if (count($feedInfo) > 0) $matchFeed = true;
			
			$pattern = '/\bgroup=[0-9]*\b/';
			preg_match($pattern, $format, $groupInfo);
			if (count($groupInfo) > 0) $matchGroup = true;
			
//			var_dump($format, $feedInfo, $groupInfo);
			
			if ($matchFeed == true && $matchGroup == true)
			{
				break;
			}
			else if ($matchFeed == true && $matchGroup == false)
			{
				$feedID = explode('=', $feedInfo[0]);
//				var_dump($feedID);
				$items 	= $coolFeedModel->getItem($feedID[1]);
			}
			else if ($matchFeed == false && $matchGroup == true)
			{
				$groupID = explode('=', $groupInfo[0]);
				$items 	= $coolFeedModel->getItems($groupID[1]);
			}
			
			ob_start();
			?>
			<div id="coolfeed" class="<?php echo @$paramsCoolFeed->global_prefix_class; ?>">
			<?php 
			if ($matchGroup) // group
			{
				$pane =& JPane::getInstance('tabs', array('startOffset'=>2));
				
				echo $pane->startPane('cf-pane' );
					
					foreach ($items as $item):
						
						$rand 		= uniqid('group');
//						$countItems++;
						$cfPrefix 	= 'cf-plugin-'.$rand;
						
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
						
						if ($upDate > 0 && $upDate > $nowDate ) {
							$verifyStatus = false;
						} 
						
						if ($downDate > 0 && $downDate < $nowDate) {
							$verifyStatus = false;
						}
						 
						if ($verifyStatus == true)
						{
							echo $pane->startPanel($item->title, 'cf-pane-'.$item->coolfeed_id); ?>
						
							<script>
								var options = {};
								options.prefix				= '<?php echo $cfPrefix; ?>';
								options.feedID				= '<?php echo $item->coolfeed_id; ?>';
								options.containerID			= 'cf-plugin-container-<?php echo $item->coolfeed_id.$rand; ?>';
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
							
				<?php 		echo '<div id="cf-plugin-container-'.$item->coolfeed_id.$rand. '" class="'.((@$item->style_prefix_class) ? @$item->style_prefix_class : @$paramsCoolFeed->global_prefix_class).'"></div>';
				?>
							<div class="avatarslide-copyright" style="text-align: center; margin: 10px 0 0 0;">
								&copy; JoomAvatar.com
								<a target="_blank" href="http://joomavatar.com" title="Joomla Template & Extension">Joomla Extension</a>-
								<a target="_blank" href="http://joomavatar.com" title="Joomla Template & Extension">Joomla Template</a>
							</div>
				<?php 
							echo $pane->endPanel();	
							
						}
						
						
						echo $pane->endPanel();
					endforeach;
					
				echo $pane->endPane();
			}
			else if($matchFeed == true) // feed
			{
				$item 	  = $items;
				
				$rand 	  = uniqid('feed');
//				$countItems++;
				$cfPrefix = 'cf-plugin-'.$rand;
				
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
				
				if ($upDate > 0 && $upDate > $nowDate ) {
					$verifyStatus = false;
				} 
				
				if ($downDate > 0 && $downDate < $nowDate) {
					$verifyStatus = false;
				}
				 
				if ($verifyStatus == true)
				{?>
					<script>
						var options = {};
						options.prefix				= '<?php echo $cfPrefix; ?>';
						options.feedID				= '<?php echo $item->coolfeed_id; ?>';
						options.containerID			= 'cf-plugin-container-<?php echo $item->coolfeed_id.$rand; ?>';
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
				<?php echo '<div id="cf-plugin-container-'.$item->coolfeed_id.$rand.'" class="'.((@$item->style_prefix_class) ? @$item->style_prefix_class : @$paramsCoolFeed->global_prefix_class).'"></div>';
				?>
					<div class="avatarslide-copyright" style="text-align: center; margin: 10px 0 0 0;">
						&copy; JoomAvatar.com
						<a target="_blank" href="http://joomavatar.com" title="Joomla Template & Extension">Joomla Extension</a>-
						<a target="_blank" href="http://joomavatar.com" title="Joomla Template & Extension">Joomla Template</a>
					</div>
				<?php 
			
				}
		
			}
			?>
			</div>
			<?php 
			$content = ob_get_clean();
			$arrayFormat[$format] = $content;
		}
		
		if ($social) {
			$cFSocial = new CFSocial;
			echo $cFSocial->getSocialBox(array('Facebook','Twitter'));
		}
			
		foreach ($arrayFormat as $keyFormat => $valueFormat)
		{
			if (!empty($valueFormat)) {
				$text = str_replace($keyFormat, $valueFormat, $text);	
			} else {
				$text = str_replace($keyFormat, '', $text);
			}
		}
	}
}
