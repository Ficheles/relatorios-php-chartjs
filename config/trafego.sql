/*
Navicat MySQL Data Transfer

Source Server         : Localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : sihwall

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-02-09 19:00:02
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for trafego
-- ----------------------------
DROP TABLE IF EXISTS `trafego`;
CREATE TABLE `trafego` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` datetime DEFAULT NULL,
  `pagina` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `regiao` varchar(255) DEFAULT NULL,
  `pais` varchar(255) DEFAULT NULL,
  `navegador` varchar(255) DEFAULT NULL,
  `referencia` varchar(255) DEFAULT NULL,
  `plataforma` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of trafego
-- ----------------------------
INSERT INTO `trafego` VALUES ('1', '2015-10-11 10:07:25', 'home', '::1', 'Osasco', 'São Paulo', 'Brasil', 'Chrome', 'Acesso direto ou não identificado', 'Windows 10');
INSERT INTO `trafego` VALUES ('2', '2015-11-08 13:07:25', 'services', '::1', 'Carapicuiba', 'São Paulo', 'Brasil', 'Chrome', 'Facebook', 'Android');
INSERT INTO `trafego` VALUES ('3', '2015-12-08 17:07:25', 'home', '::1', 'Osasco', 'São Paulo', 'Brasil', 'Chrome', 'Google', 'IOS');
INSERT INTO `trafego` VALUES ('4', '2016-01-23 14:07:25', 'home', '::1', 'Desconhecida', 'Desconhecida', 'Desconhecido', 'Chrome', 'Acesso direto ou não identificado', 'Windows 7');
INSERT INTO `trafego` VALUES ('5', '2016-02-04 13:07:25', 'home', '::1', 'Desconhecida', 'Desconhecida', 'Desconhecido', 'Chrome', 'Acesso direto ou não identificado', 'Windows 10');
INSERT INTO `trafego` VALUES ('6', '2016-02-06 02:07:25', 'home', '::1', 'Carapicuiba', 'São Paulo', 'Brasil', 'Chrome', 'Acesso direto ou não identificado', 'Windows 7');
INSERT INTO `trafego` VALUES ('7', '2016-02-07 14:07:25', 'home', '::1', 'Barueri', 'São Paulo', 'Brasil', 'Chrome', 'Acesso direto ou não identificado', 'Windows 10');
INSERT INTO `trafego` VALUES ('8', '2016-02-08 17:07:25', 'home', '::1', 'Desconhecida', 'Desconhecida', 'Desconhecido', 'Chrome', 'Acesso direto ou não identificado', 'Windows Phone');
INSERT INTO `trafego` VALUES ('9', '2016-02-08 14:07:25', 'home', '::1', 'Desconhecida', 'Desconhecida', 'Desconhecido', 'Chrome', 'Acesso direto ou não identificado', 'Windows Phone');
INSERT INTO `trafego` VALUES ('10', '2016-02-09 10:47:09', 'home', '::1', 'Desconhecida', 'Desconhecida', 'Desconhecido', 'Chrome', 'Acesso direto ou não identificado', 'Windows 10');

/*
create table trafego (
id INTEGER PRIMARY KEY AUTOINCREMENT,
date datetime,
page varchar(250),
ip varchar(30),
city varchar(50),
region varchar(50),
country varchar(40),
browser varchar(40),
platform varchar(40),
referer varchar(80)
);

*/