<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionLoadJs{
	var $formname;
	var $formid;
	var $details = array('title' => 'Load JS', 'tooltip' => 'Eval and show the JS code');
	function load($clear){
		if($clear){
			$action_params = array(
				'content1' => '',
				'dynamic_file' => 0
			);
		}
		return array('action_params' => $action_params);
	}
	
	function run($form, $actiondata){
		
	}	
}
?>