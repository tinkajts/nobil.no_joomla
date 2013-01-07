<?php

/**
 * @version		$Id: coolfeed.php 97 2011-12-14 15:12:49Z trung3388@gmail.com $
 * @copyright	Copyright (C) 2010 - 2011 Open Source Matters, Inc. All rights reserved.
 * @author		Nguyen Quang Trung
 * @link		http://joomavatar.com
 * @license		License GNU General Public License version 2 or later
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla modelitem library
jimport('joomla.application.component.modelitem');

class CoolFeedModelCoolFeed extends JModelItem
{
	/**
	 * @var object item
	 */
	protected $item;

	/**
	 * Method to auto-populate the model state.
	 *
	 * This method should only be called once per instantiation and is designed
	 * to be called on the first call to the getState() method unless the model
	 * configuration flag to ignore the request is set.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @return	void
	 * @since	1.6
	 */
	protected function populateState() 
	{
		$app = JFactory::getApplication();
		// Get the message id
		$id = JRequest::getInt('coolfeed_id');
		$this->setState('coolfeed.id', $id);

		// Load the parameters.
		$params = $app->getParams();
		$this->setState('params', $params);
		parent::populateState();
	}

	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param	type	The table type to instantiate
	 * @param	string	A prefix for the table class name. Optional.
	 * @param	array	Configuration array for model. Optional.
	 * @return	JTable	A database object
	 * @since	1.6
	 */
	public function getTable($type = 'CoolFeed', $prefix = 'CoolFeedTable', $config = array()) 
	{
		$path = JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_coolfeed'.DS.'tables';
		$this->addTablePath($path);
		return JTable::getInstance($type, $prefix, $config);
	}
	/**
	 * Get the message
	 * @return object The message to be displayed to the user
	 */
	public function getItem($pk = null) 
	{
		$pk = ($pk == null) ? $pk = $this->getState('coolfeed.id') : $pk;
		
		$coolFeedTable 	= $this->getTable();
		$styleTable 	= $this->getTable('style'); 
		
		if ($coolFeedTable->load($pk))
		{
			$styleTable->load($coolFeedTable->style_id);
		}
		
		$style 				= (array) json_decode($styleTable->style);
		$coolFeedProperty 	= $coolFeedTable->getProperties(1);
		$styleProperty		= $styleTable->getProperties(1);
		$arrayData 			= array_merge($style, $coolFeedProperty, $styleProperty);
		
		$this->item = JArrayHelper::toObject($arrayData, 'JObject');
		
		if (property_exists($this->item, 'params')) {
			$registry = new JRegistry;
			$registry->loadJSON($this->item->params);
			$this->item->params = $registry->toArray();
		}
		
		return $this->item;
	}
	
	public function getItems($groupID = null)
	{
		$groupID = ($groupID == null) ? $groupID = JRequest::getInt('group_id', null) : $groupID;
		
		$query 		= 'SELECT coolfeed_id FROM #__coolfeed WHERE published = 1 AND group_id ='.(int)$groupID;
		$this->_db->setQuery($query);
		$result = $this->_db->loadResultArray();
		
		$data = array();
		
		foreach ($result as $ID)
		{
			$data[] = $this->getItem($ID);
			unset($this->item);			
		}
		
		return $data;
	}
	
	function getLangBox()
	{
		$arrayLanguage = array(
		  'AFRIKAANS' => 'af',
		  'ALBANIAN' => 'sq',
		  'AMHARIC' => 'am',
		  'ARABIC' => 'ar',
		  'ARMENIAN' => 'hy',
		  'AZERBAIJANI' => 'az',
		  'BASQUE' => 'eu',
		  'BELARUSIAN' => 'be',
		  'BENGALI' => 'bn',
		  'BIHARI' => 'bh',
		  'BRETON' => 'br',
		  'BULGARIAN' => 'bg',
		  'BURMESE' => 'my',
		  'CATALAN' => 'ca',
		  'CHEROKEE' => 'chr',
		  'CHINESE' => 'zh',
		  'CHINESE_SIMPLIFIED' => 'zh-CN',
		  'CHINESE_TRADITIONAL' => 'zh-TW',
		  'CORSICAN' => 'co',
		  'CROATIAN' => 'hr',
		  'CZECH' => 'cs',
		  'DANISH' => 'da',
		  'DHIVEHI' => 'dv',
		  'DUTCH'=> 'nl',  
		  'ENGLISH' => 'en',
		  'ESPERANTO' => 'eo',
		  'ESTONIAN' => 'et',
		  'FAROESE' => 'fo',
		  'FILIPINO' => 'tl',
		  'FINNISH' => 'fi',
		  'FRENCH' => 'fr',
		  'FRISIAN' => 'fy',
		  'GALICIAN' => 'gl',
		  'GEORGIAN' => 'ka',
		  'GERMAN' => 'de',
		  'GREEK' => 'el',
		  'GUJARATI' => 'gu',
		  'HAITIAN_CREOLE' => 'ht',
		  'HEBREW' => 'iw',
		  'HINDI' => 'hi',
		  'HUNGARIAN' => 'hu',
		  'ICELANDIC' => 'is',
		  'INDONESIAN' => 'id',
		  'INUKTITUT' => 'iu',
		  'IRISH' => 'ga',
		  'ITALIAN' => 'it',
		  'JAPANESE' => 'ja',
		  'JAVANESE' => 'jw',
		  'KANNADA' => 'kn',
		  'KAZAKH' => 'kk',
		  'KHMER' => 'km',
		  'KOREAN' => 'ko',
		  'KURDISH'=> 'ku',
		  'KYRGYZ'=> 'ky',
		  'LAO' => 'lo',
		  'LATIN' => 'la',
		  'LATVIAN' => 'lv',
		  'LITHUANIAN' => 'lt',
		  'LUXEMBOURGISH' => 'lb',
		  'MACEDONIAN' => 'mk',
		  'MALAY' => 'ms',
		  'MALAYALAM' => 'ml',
		  'MALTESE' => 'mt',
		  'MAORI' => 'mi',
		  'MARATHI' => 'mr',
		  'MONGOLIAN' => 'mn',
		  'NEPALI' => 'ne',
		  'NORWEGIAN' => 'no',
		  'OCCITAN' => 'oc',
		  'ORIYA' => 'or',
		  'PASHTO' => 'ps',
		  'PERSIAN' => 'fa',
		  'POLISH' => 'pl',
		  'PORTUGUESE' => 'pt',
		  'PORTUGUESE_PORTUGAL' => 'pt-PT',
		  'PUNJABI' => 'pa',
		  'QUECHUA' => 'qu',
		  'ROMANIAN' => 'ro',
		  'RUSSIAN' => 'ru',
		  'SANSKRIT' => 'sa',
		  'SCOTS_GAELIC' => 'gd',
		  'SERBIAN' => 'sr',
		  'SINDHI' => 'sd',
		  'SINHALESE' => 'si',
		  'SLOVAK' => 'sk',
		  'SLOVENIAN' => 'sl',
		  'SPANISH' => 'es',
		  'SUNDANESE' => 'su',
		  'SWAHILI' => 'sw',
		  'SWEDISH' => 'sv',
		  'SYRIAC' => 'syr',
		  'TAJIK' => 'tg',
		  'TAMIL' => 'ta',
		  'TATAR' => 'tt',
		  'TELUGU' => 'te',
		  'THAI' => 'th',
		  'TIBETAN' => 'bo',
		  'TONGA' => 'to',
		  'TURKISH' => 'tr',
		  'UKRAINIAN' => 'uk',
		  'URDU' => 'ur',
		  'UZBEK' => 'uz',
		  'UIGHUR' => 'ug',
		  'VIETNAMESE' => 'vi',
		  'WELSH' => 'cy',
		  'YIDDISH' => 'yi',
		  'YORUBA' => 'yo',
		  'UNKNOWN' => ''
		);
		$html = '<select class="cf-feed-language-box" name="cf-feed-language-box" onchange="CoolFeed.changeLanguage(this);">';
		$html .= '<option value="">'.JText::_('COOLFEED_SELECT_LANGUAGE').'</option>';
		foreach ($arrayLanguage as $key => $value)
		{
			$html .= '<option value="'.$value.'">'.ucfirst(strtolower($key)).'</option>';
		}
		$html .= '</select>';
		return $html;
	}
}
