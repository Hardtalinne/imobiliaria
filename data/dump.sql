-- Adminer 4.8.1 MySQL 8.0.27 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `corretores`;
CREATE TABLE `corretores` (
  `matricula` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`matricula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `imoveis`;
CREATE TABLE `imoveis` (
  `codigo` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `localizacao` varchar(255) NOT NULL,
  `codigo_corretor` int NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `codigo_corretor` (`codigo_corretor`),
  CONSTRAINT `imoveis_ibfk_1` FOREIGN KEY (`codigo_corretor`) REFERENCES `corretores` (`matricula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `codigo` int NOT NULL AUTO_INCREMENT,
  `usuario` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

SET NAMES utf8mb4;

INSERT INTO `usuarios` (`codigo`, `usuario`, `senha`) VALUES
(1,	'admin',	'21232f297a57a5a743894a0e4a801fc3');

-- 2021-12-05 20:36:30