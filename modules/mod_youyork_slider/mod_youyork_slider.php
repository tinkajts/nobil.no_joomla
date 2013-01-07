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
require_once (dirname(__FILE__).DS.'helper.php');

$module_template 			= $params->get('module_template','Default');
$slider_width           	= $params->get('slider_width');
$slider_height          	= $params->get('slider_height');
$module_title 				= $params->get('module_title','Title1|Title2');
$titles 					= explode(",", $module_title);
$showtitle					= $params->get('showtitle',1);
$show_title   			 	= $params->get('show_title');
$module_pozi 				= $params->get('module_pozi','user1|user2');
$slide2mods 				= explode(",", $module_pozi);
$is_copy 					= $params->get('is_copy');
$visible_modules       	 	= $params->get('visible_modules','2');


$yy_slideitems_height 		= $slider_height -40;
$items_width 				=  number_format(($slider_width/$visible_modules),0, '.', '');


$youyork_slides 			= modYouyorkSLiderhHelper::getYouyorkSliderItems($params);
require(JModuleHelper::getLayoutPath('mod_youyork_slider',''.$module_template.'/default'));
?>