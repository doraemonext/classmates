-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 07 月 09 日 17:46
-- 服务器版本: 5.6.12
-- PHP 版本: 5.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `classmates`
--

INSERT INTO `classmates` (`id`, `password`, `privilege`, `banned_reason`, `name`, `birthday`, `sex`, `blood_type`, `residence`, `nation`, `weight`, `height`, `phone_1`, `phone_2`, `phone_3`, `qq`, `email`, `speciality`, `give_others`, `hobby_books`, `hobby_music`, `hobby_movie`, `hobby_sports`, `hobby_brands`, `hobby_worship`, `hobby_others`) VALUES
(4, '21232f297a57a5a743894a0e4a801fc3', 8, NULL, 'admin', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `index_motto`
--

CREATE TABLE IF NOT EXISTS `index_motto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `index_motto`
--

INSERT INTO `index_motto` (`id`, `content`) VALUES
(1, '请在后台修改此处文字');

-- --------------------------------------------------------

--
-- 表的结构 `index_picture`
--

CREATE TABLE IF NOT EXISTS `index_picture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- 转存表中的数据 `index_picture`
--

INSERT INTO `index_picture` (`id`, `url`) VALUES
(23, 'images/index_picture/ef1ef71e75fb63f03c0d1b0bf8782441.JPG');

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

--
-- 转存表中的数据 `options`
--

INSERT INTO `options` (`options_id`, `options_name`, `options_value`) VALUES
(1, 'title', 'CLASSMATE'),
(2, 'subtitle', 'SUBTITLE'),
(3, 'index_writing', '请在后台修改此处的话语');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
