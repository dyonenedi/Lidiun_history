-- --------------------------------------------------------
-- Servidor:                     localhost
-- Versão do servidor:           5.6.20 - MySQL Community Server (GPL)
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura do banco de dados para lidiun
CREATE DATABASE IF NOT EXISTS `lidiun` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `lidiun`;


-- Copiando estrutura para tabela lidiun.login
DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL DEFAULT '0',
  `password` varchar(40) NOT NULL DEFAULT '0',
  `type` enum('ADMIN','DEVELOPER') NOT NULL DEFAULT 'DEVELOPER',
  `active` bit(1) NOT NULL DEFAULT b'1',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user` (`email`),
  KEY `password` (`password`),
  KEY `type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela lidiun.login: ~2 rows (aproximadamente)
DELETE FROM `login`;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` (`id`, `email`, `password`, `type`, `active`, `date`) VALUES
	(1, 'dyonenedi@lidiun.com', '56af17d11f657386329c8cdf5cdc9c8eb97db538', 'ADMIN', b'1', '2014-11-13 16:13:25'),
	(2, 'dyonenedi@lidiun.com.br', '56af17d11f657386329c8cdf5cdc9c8eb97db538', 'DEVELOPER', b'1', '2014-11-17 09:14:26');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;


-- Copiando estrutura para tabela lidiun.plugin
DROP TABLE IF EXISTS `plugin`;
CREATE TABLE IF NOT EXISTS `plugin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `documentation` varchar(20000) NOT NULL,
  `link` varchar(255) NOT NULL,
  `type_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `link` (`link`),
  KEY `description` (`description`),
  KEY `type` (`type_id`),
  KEY `documentation` (`documentation`(255)),
  KEY `user` (`user_id`),
  CONSTRAINT `FK_plugin_plugin_type` FOREIGN KEY (`type_id`) REFERENCES `plugin_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_plugin_user_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela lidiun.plugin: ~0 rows (aproximadamente)
DELETE FROM `plugin`;
/*!40000 ALTER TABLE `plugin` DISABLE KEYS */;
INSERT INTO `plugin` (`id`, `name`, `description`, `documentation`, `link`, `type_id`, `user_id`, `active`, `date`, `date_update`) VALUES
	(1, 'Building', 'Classe construtora de queries que utiliza a classe Database do Lidiun.', 'Classe construtora de queries que utiliza a classe Database do Lidiun.', 'building', 4, 2, 1, '2014-11-28 16:21:24', '2014-11-28 16:21:24'),
	(2, 'Validation', 'Classe faz validações utilizando a class Request do Lidiun.', 'Classe faz validações utilizando a class Request do Lidiun.', 'validation', 13, 2, 1, '2014-11-28 16:21:24', '2014-11-28 16:21:24'),
	(3, 'Treatment', 'Classe que faz o tratamento dos dados.', 'Classe que faz o tratamento dos dados.', 'treatment', 11, 2, 1, '2014-11-28 16:23:37', '2014-11-28 16:23:38'),
	(4, 'Encrypt', 'Classe que faz o encode de uma senha usando um algoritmo personalizado.', 'Classe que faz o encode de uma senha usando um algoritmo personalizado.', 'encrypt', 11, 2, 1, '2014-11-28 16:24:41', '2014-11-28 16:24:41'),
	(5, 'Auth', 'Classe que ajuda fazer o login e manter a session.', 'Classe que ajuda fazer o login e manter a session.', 'auth', 1, 2, 1, '2014-11-28 17:37:44', '2014-11-28 17:37:45');
/*!40000 ALTER TABLE `plugin` ENABLE KEYS */;


-- Copiando estrutura para tabela lidiun.plugin_type
DROP TABLE IF EXISTS `plugin_type`;
CREATE TABLE IF NOT EXISTS `plugin_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(50) NOT NULL,
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela lidiun.plugin_type: ~0 rows (aproximadamente)
DELETE FROM `plugin_type`;
/*!40000 ALTER TABLE `plugin_type` DISABLE KEYS */;
INSERT INTO `plugin_type` (`id`, `type_name`, `active`) VALUES
	(1, 'Auth', 1),
	(2, 'Caching', 1),
	(3, 'Console', 1),
	(4, 'Database', 1),
	(5, 'Date and Time', 1),
	(6, 'Error Handling', 1),
	(7, 'File System', 1),
	(8, 'Logging', 1),
	(9, 'Mail', 1),
	(10, 'Networking', 1),
	(11, 'Security', 1),
	(12, 'User Interface', 1),
	(13, 'Validation', 1),
	(14, 'Web Service', 1),
	(15, 'Others', 1);
/*!40000 ALTER TABLE `plugin_type` ENABLE KEYS */;


-- Copiando estrutura para tabela lidiun.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_login` int(11) unsigned NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `sex` enum('M','F') DEFAULT NULL COMMENT 'M=Male, F=Female',
  `birthday` date DEFAULT NULL,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `name` (`first_name`),
  KEY `last_name` (`last_name`),
  KEY `id_login` (`id_login`),
  CONSTRAINT `FK_user_login` FOREIGN KEY (`id_login`) REFERENCES `login` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='This is a user table from some application with login. ';

-- Copiando dados para a tabela lidiun.user: ~2 rows (aproximadamente)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `id_login`, `first_name`, `last_name`, `sex`, `birthday`, `update_date`) VALUES
	(1, 1, 'Dyon Enedi', 'da Silva de Souza', 'M', '1987-06-05', '2014-11-13 16:13:42'),
	(2, 2, 'Dyon Enedi', 'da Silva de Souza', 'M', '2014-11-17', '2014-11-17 09:14:56');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
