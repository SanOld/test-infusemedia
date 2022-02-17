-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.6.47 - MySQL Community Server (GPL)
-- Операционная система:         Win64
-- HeidiSQL Версия:              11.0.0.5958
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры для таблица infusemedia_test.visitors
CREATE TABLE IF NOT EXISTS `visitors` (
  `id` char(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` int(11) unsigned NOT NULL DEFAULT '0',
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `view_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `page_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `views_count` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы infusemedia_test.visitors: ~6 rows (приблизительно)
/*!40000 ALTER TABLE `visitors` DISABLE KEYS */;
/*!40000 ALTER TABLE `visitors` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
