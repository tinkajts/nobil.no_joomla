<?php
/*======================================================================*\
|| #################################################################### ||
|| # Youjoomla LLC - YJ- Licence Number 79410DN276
|| # Licensed to - Jahn-Tore Skåland
|| # ---------------------------------------------------------------- # ||
|| # Copyright (C) 2006-2009 Youjoomla LLC. All Rights Reserved.        ||
|| # This file may not be redistributed in whole or significant part. # ||
|| # ---------------- THIS IS NOT FREE SOFTWARE ---------------- #      ||
|| # http://www.youjoomla.com | http://www.youjoomla.com/license.html # ||
|| #################################################################### ||
\*======================================================================*/

// no direct access
defined('_JEXEC') or die('Restricted access');

JHTML::_('behavior.mootools');
require_once (JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php');

class modYouyorkSLiderhHelper
{
	function getYouyorkSliderItems(&$params)
	{
		$is_copy					= $params->get   ('is_copy');
		 $slider_width           	= $params->get   ('slider_width');
		 $visible_modules       	= $params->get   ('visible_modules','2');
		 $autoslide    			 	= $params->get   ('autoslide');
		 $items_width 				=  number_format(($slider_width/$visible_modules),0, '.', '');
		 $effectDuration			= $params->get   ('effectDuration');

		$document = &JFactory::getDocument();

		$document->addStyleSheet(JURI::base() . 'modules/mod_youyork_slider/css/stylesheet.css');
		$document->addScript(JURI::base() . 'modules/mod_youyork_slider/src/youyork_slider12.js');
		
	 
		$document->addScriptDeclaration("
	window.addEvent('load', function(){
		new YouYorkModuleSlider({
			container : 'yy_container". $is_copy."', 
			items :'.yy_slideitems',
			itemWidth : ".$items_width.",
			visibleItems: ".$visible_modules.",
			effectDuration : ". $effectDuration.",
			autoSlide : ". $autoslide .",
			mouseEventSlide: ". $autoslide .",
			navigation: {
				'forward':'linkForward', 
				'back':'linkBackward'
			}
		});
	})
		");

	}
}
?>