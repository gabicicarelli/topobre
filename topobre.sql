/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.17-MariaDB : Database - topobre
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`topobre` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `topobre`;

/*Table structure for table `tbbanco` */

DROP TABLE IF EXISTS `tbbanco`;

CREATE TABLE `tbbanco` (
  `idBanco` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` int(3) unsigned zerofill NOT NULL,
  `nome` varchar(128) NOT NULL,
  PRIMARY KEY (`idBanco`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbbanco` */

insert  into `tbbanco`(`idBanco`,`codigo`,`nome`) values 
(1,001,'Banco do Brasil'),
(2,033,'Santander'),
(3,104,'Caixa Econômica Federal'),
(4,237,'Bradesco'),
(5,341,'Itaú'),
(6,652,'Itaú Unibanco'),
(7,260,'NuBank'),
(8,077,'Banco Inter'),
(9,623,'Banco PAN'),
(10,336,'C6 Bank'),
(11,735,'Neon'),
(12,212,'Banco Original'),
(13,218,'Banco BS2'),
(14,380,'Picpay');

/*Table structure for table `tbconta` */

DROP TABLE IF EXISTS `tbconta`;

CREATE TABLE `tbconta` (
  `idUsuario` int(11) NOT NULL,
  `tipo` varchar(128) NOT NULL,
  `banco` varchar(128) NOT NULL,
  `agencia` varchar(128) NOT NULL,
  `conta` varchar(128) NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbconta` */

/*Table structure for table `tbusuario` */

DROP TABLE IF EXISTS `tbusuario`;

CREATE TABLE `tbusuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `cpf` char(11) NOT NULL,
  `nome` varchar(128) NOT NULL,
  `sobrenome` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `senha` char(128) NOT NULL,
  `telefone` char(11) DEFAULT NULL,
  `cep` char(11) DEFAULT NULL,
  `endereco` varchar(128) DEFAULT NULL,
  `bairro` varchar(128) DEFAULT NULL,
  `cidade` varchar(128) DEFAULT NULL,
  `estado` varchar(128) DEFAULT NULL,
  `foto` varchar(128) DEFAULT 'default-avatar.png',
  `dtInicio` datetime NOT NULL,
  `dtFim` datetime DEFAULT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `tbusuario` */

insert  into `tbusuario`(`idUsuario`,`uuid`,`cpf`,`nome`,`sobrenome`,`email`,`senha`,`telefone`,`cep`,`endereco`,`bairro`,`cidade`,`estado`,`foto`,`dtInicio`,`dtFim`) values 
(2,'4978861d-c43b-58a9-9348-de9fe94cb047','16936861717','GABRIELLE','CICARELLI','sistema.topobre@gmail.com','9592675b2114d2ef0f38a4ce006d329ceca02168c6a01911407c4d705a768260889e48ff10ebf71ebf800aba19497c742dcf5dd337335395546ed44a9ce1c272','11941909871','03166001','Rua Taquari','Mooca','São Paulo','SP','2.jpg','2021-01-28 20:38:09',NULL),
(4,'859ef028-1016-6edf-c37d-c151a3c501fd','14246496766','GISELI','CICARELLI','sistema.topobre@gmail.com','432b54be99315a66155ef4d36bed4803dadd708125903a1282fb93b1e3eec77da9cc79a91231a9e3a28f43a8f9f6d914fc06b8d86af0d5a2219fc36e8584ba40','11941909871','03166001','Rua Taquari','Mooca','São Paulo','SP','4.jpg','2021-01-29 13:37:30',NULL);

/*Table structure for table `tbusuariotoken` */

DROP TABLE IF EXISTS `tbusuariotoken`;

CREATE TABLE `tbusuariotoken` (
  `idToken` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `token` varchar(8) NOT NULL,
  `sucesso` tinyint(1) NOT NULL DEFAULT 0,
  `dtEnvio` datetime NOT NULL,
  PRIMARY KEY (`idToken`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `tbusuariotoken` */

insert  into `tbusuariotoken`(`idToken`,`idUsuario`,`token`,`sucesso`,`dtEnvio`) values 
(1,1,'762997',1,'2021-01-28 21:40:10'),
(2,1,'347603',1,'2021-01-28 23:13:59'),
(3,1,'204259',1,'2021-01-28 23:25:28'),
(4,2,'229038',1,'2021-01-29 00:38:14'),
(5,2,'039490',1,'2021-01-29 14:33:03'),
(6,2,'412316',1,'2021-01-29 15:25:21'),
(7,4,'002764',1,'2021-01-29 17:38:12'),
(8,4,'483852',1,'2021-01-29 17:38:49'),
(9,4,'001175',1,'2021-01-29 17:40:51'),
(10,2,'006456',1,'2021-01-29 17:44:11');

/* Trigger structure for table `tbusuario` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trUsuarioInserir` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trUsuarioInserir` BEFORE INSERT ON `tbusuario` FOR EACH ROW BEGIN
    			
	SET NEW.nome = TRIM(UPPER(NEW.nome));
	SET NEW.sobrenome = TRIM(UPPER(NEW.sobrenome));		
	SET NEW.uuid = fnHash();
	SET NEW.dtInicio = NOW();
	
    END */$$


DELIMITER ;

/* Function  structure for function  `fnHash` */

/*!50003 DROP FUNCTION IF EXISTS `fnHash` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `fnHash`() RETURNS char(36) CHARSET utf8
BEGIN

DECLARE _h VARCHAR(36);
SET _h = MD5(SHA2(UUID(), 512));
RETURN CONCAT(SUBSTRING(_h, 1, 8),'-',SUBSTRING(_h, 9, 4),'-',SUBSTRING(_h, 13, 4),'-',SUBSTRING(_h, 17, 4),'-',SUBSTRING(_h, 21, 15));

END */$$
DELIMITER ;

/* Procedure structure for procedure `stpDeletaUsuario` */

/*!50003 DROP PROCEDURE IF EXISTS  `stpDeletaUsuario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `stpDeletaUsuario`(IN id INT(11), IN SENHA TEXT)
BEGIN
	IF SENHA = 'LenaLuthor' THEN
		DELETE FROM tbusuario WHERE idUsuario = id;
		DELETE FROM tblog WHERE idUsuario = id;			
		ALTER TABLE TB_USUARIOS AUTO_INCREMENT = 1;
	ELSE
		SELECT 'SENHA INVALIDA';
	END IF;
    END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
