<?php
/**
 * @package		YJ Module Engine
 * @author		Youjoomla LLC
 * @website     Youjoomla.com 
 * @copyright	Copyright (c) 2007 - 2011 Youjoomla LLC.
 * @license   PHP files are GNU/GPL V2. CSS / JS / IMAGES are Copyrighted Commercial
 */

// no direct access
defined('_JEXEC') or die('Restricted access');
			JHtml::_('behavior.framework', true);
			$document = &JFactory::getDocument();
			$module_css			= $params->get   ('module_css','stylesheet.css');
			$document->addStyleSheet(JURI::base() . 'modules/'.$yj_mod_name.'/css/'.$module_css.'');
			
		$document->addScript(JURI::base() . 'modules/'.$yj_mod_name.'/src/youretro_reader.js');
		$fx_poz = $slider_width - ($thumb_width * 2);
		//$slider_height
		
		if($slide_from =='top'){
			$slide_dir_start 	='marginTop:0';
			$slide_dir_end 		='marginTop:-'.$slider_height.'';
		}elseif($slide_from =='bottom'){
			$slide_dir_start 	='marginTop:0';
			$slide_dir_end 		='marginTop:'.$slider_height.'';
		}elseif($slide_from =='left'){
			$slide_dir_start 	='marginLeft:0';
			$slide_dir_end 		='marginLeft:-'.$fx_poz.'';
		}elseif($slide_from =='right'){
			$slide_dir_start 	='marginLeft:0';
			$slide_dir_end 		='marginLeft:'.$fx_poz.'';
		}
		
		
		
		
		
		$document->addScriptDeclaration("
		window.addEvent('domready', function(){
				new YouretroReader({
					navigation:{
						container: 'yrrnavigator".$is_copy."',
						elements:'.yrrelement',
						outer: 'yrrnavigator_outer".$is_copy."',
						selectedClass: 'yrrselected',
						visibleItems: ".$visibleItems."
					},
					slides:{
						container:'yrrslides".$is_copy."',
						elements:'.yrrslide',
						infoContainer:'.long_desc',
						infoContainerPosition: '".$infoContainerPosition."',
						slideTranz:".$slideTranz.",
						slideSpeed:".$slideSpeed.",
						fadeDurr:".$fadeDurr.",
						startFx:{
							'opacity':[0,1],
							".$slide_dir_start."
						},
						endFx:{
							'opacity':0,
							".$slide_dir_end."
							
						}
					},
					startElem: ".$startElem.",
					autoSlide: ".$autoSlide."
				});

			});
		");
		
	if($con_border_radius > 0) {
		$document->addScriptDeclaration("
		window.addEvent('load', function(){
			  $$('.yrrelement ').setStyles({
			  		borderRadius: '".$con_border_radius."px',
			  		WebkitBorderRadius:'".$con_border_radius."px',
			  		MozBorderRadius:'".$con_border_radius."px'
				});
			
		});
			");
	}



		
//Document type examples
//$document->addStyleSheet(JURI::base() . 'modules/'.$yj_mod_name.'/css/'.$module_css.'');
//$document->addScript('');
//$document->addScriptDeclaration("jQuery.noConflict();");
//$document->addCustomTag('<style type="text/css"></style>');
//$document->addScriptDeclaration("");

?>