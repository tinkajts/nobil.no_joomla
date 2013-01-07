<?php 

class AVARTARDatabase {
	
	public $_db;
	
	function __construct()
	{
		$this->_db = JFactory::getDBO();
	}
}