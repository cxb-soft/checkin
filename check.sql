-- Adminer 4.6.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `checks`;
CREATE TABLE `checks` (
  `checker` mediumtext NOT NULL,
  `date` mediumtext NOT NULL,
  `class` mediumtext NOT NULL,
  `sub` mediumtext NOT NULL,
  `check_name` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `teacher_usr`;
CREATE TABLE `teacher_usr` (
  `username` mediumtext NOT NULL,
  `password` mediumtext NOT NULL,
  `class` mediumtext NOT NULL,
  `sub` mediumtext NOT NULL,
  `name` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `titles`;
CREATE TABLE `titles` (
  `class` mediumtext NOT NULL,
  `title` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `name` mediumtext NOT NULL,
  `class` mediumtext NOT NULL,
  `xuehao` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- 2020-03-17 08:54:50
