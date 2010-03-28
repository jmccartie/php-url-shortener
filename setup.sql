--
-- Table structure for table `links`
--

CREATE TABLE IF NOT EXISTS `links` (
  `id` int(11) NOT NULL auto_increment,
  `hash` varchar(128) NOT NULL,
  `url` varchar(256) NOT NULL,
  `created_at` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE IF NOT EXISTS `views` (
  `view_id` int(11) NOT NULL auto_increment,
  `link_id` int(11) NOT NULL,
  `user_ip` varchar(40) NOT NULL,
  `user_agent` varchar(256) NOT NULL,
  `created_at` int(11) NOT NULL,
  PRIMARY KEY  (`view_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;
