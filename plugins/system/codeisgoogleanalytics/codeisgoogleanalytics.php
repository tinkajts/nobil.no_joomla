<?php
/**
 * @version		$Id$
 * @package		codeis.com
 * @subpackage	system
 * @copyright	Copyright (C) 2011 http://www.codeis.com. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.plugin.plugin');

class plgSystemCodeisgoogleanalytics extends JPlugin {

    function onAfterRender() {
        $app = JFactory::getApplication();
        $accountId = $this->params->get('account_id');
        if ($accountId == '' || $app->isAdmin()) {
            return true;
        }
        
        $analytics_code = "
<script type=\"text/javascript\">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '" . $accountId . "']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>";

        $html = JResponse::getBody();
        $html = preg_replace("/<\/head>/", "\n\n" . $analytics_code . "\n\n</head>", $html);
        JResponse::setBody($html);      
        return true;
    }

}

?>