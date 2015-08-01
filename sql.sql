-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.5.25 - MySQL Community Server (GPL)
-- ОС Сервера:                   Win32
-- HeidiSQL Версия:              8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры для функция mind50.geodist
DROP FUNCTION IF EXISTS `geodist`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` FUNCTION `geodist`(
  src_lat DECIMAL(9,6), src_lon DECIMAL(9,6),
  dst_lat DECIMAL(9,6), dst_lon DECIMAL(9,6)
) RETURNS decimal(6,2)
    DETERMINISTIC
BEGIN
 SET @dist := 6371 * 2 * ASIN(SQRT(
      POWER(SIN((src_lat - ABS(dst_lat)) * PI()/180 / 2), 2) +
      COS(src_lat * PI()/180) *
      COS(ABS(dst_lat) * PI()/180) *
      POWER(SIN((src_lon - dst_lon) * PI()/180 / 2), 2)
    ));
 RETURN @dist;
END//
DELIMITER ;


-- Дамп структуры для таблица mind50.message
DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `Индекс 2` (`user_id`),
  KEY `Индекс 3` (`created_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Экспортируемые данные не выделены.


-- Дамп структуры для таблица mind50.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nick` varchar(255) NOT NULL DEFAULT '0',
  `geo` point NOT NULL,
  `last_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Экспортируемые данные не выделены.


-- Дамп структуры для таблица mind50.user_message
DROP TABLE IF EXISTS `user_message`;
CREATE TABLE IF NOT EXISTS `user_message` (
  `user_id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`message_id`),
  KEY `Индекс 2` (`message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Экспортируемые данные не выделены.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
