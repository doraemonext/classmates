--
-- 数据库: `classmates`
--
CREATE DATABASE IF NOT EXISTS `classmates` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `classmates`;

-- --------------------------------------------------------

--
-- 表的结构 `classmates`
--

CREATE TABLE IF NOT EXISTS `classmates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` char(50) NOT NULL,
  `privilege` int(11) NOT NULL,
  `banned_reason` text,
  `name` char(20) NOT NULL,
  `birthday` date DEFAULT NULL,
  `sex` tinyint(4) DEFAULT NULL,
  `blood_type` int(11) NOT NULL DEFAULT '0',
  `residence` text,
  `nation` char(20) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `phone_1` char(20) DEFAULT NULL,
  `phone_2` char(20) DEFAULT NULL,
  `phone_3` char(20) DEFAULT NULL,
  `qq` char(20) DEFAULT NULL,
  `email` text,
  `speciality` text,
  `give_others` mediumtext,
  `hobby_books` text,
  `hobby_music` text,
  `hobby_movie` text,
  `hobby_sports` text,
  `hobby_brands` text,
  `hobby_worship` text,
  `hobby_others` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 表的结构 `index_motto`
--

CREATE TABLE IF NOT EXISTS `index_motto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- 表的结构 `index_picture`
--

CREATE TABLE IF NOT EXISTS `index_picture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

-- --------------------------------------------------------

--
-- 表的结构 `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `options_id` int(11) NOT NULL AUTO_INCREMENT,
  `options_name` char(30) NOT NULL,
  `options_value` text,
  PRIMARY KEY (`options_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;
