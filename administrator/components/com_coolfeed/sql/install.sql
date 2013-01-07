
CREATE TABLE IF NOT EXISTS `#__coolfeed` (
  `coolfeed_id` int(11) NOT NULL auto_increment,
  `group_id` int(11) NOT NULL,
  `title` varchar(25) NOT NULL,
  `link` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL default '0',
  `access` tinyint(3) NOT NULL default '0',
  `publish_up` datetime default NULL,
  `publish_down` datetime default NULL,
  `ordering` int(11) NOT NULL,
  `style_id` int(10) default NULL,
  PRIMARY KEY  (`coolfeed_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__coolfeed_group` (
  `id` int(11) NOT NULL auto_increment,
  `name` char(25) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__coolfeed_style` (
  `style_id` int(11) NOT NULL auto_increment,
  `style_name` char(30) NOT NULL,
  `style` text NOT NULL,
  PRIMARY KEY  (`style_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

