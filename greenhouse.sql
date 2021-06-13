DROP DATABASE IF EXISTS `greenhouse`;
CREATE DATABASE `greenhouse`;
USE `greenhouse`;

DROP TABLE IF EXISTS `sensores`;
CREATE TABLE `sensores` (
	designacao VARCHAR(30) NOT NULL,
	valor VARCHAR(255) NOT NULL,
	hora VARCHAR(20) NOT NULL,
	PRIMARY KEY (`designacao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `sensores` (`designacao`, `valor`, `hora`) VALUES
	('luminosidade', '48', '25/05/2021 18:00:00'),
	('temperatura', '52', '25/05/2021 18:00:00'),
	('movimento', '0', '25/05/2021 18:00:00'),
	('camara', 'public/img/webcam/camara_13-06-2021_09-37-14.jpg', '13/06/2021 09:37:15'),
	('aquecimento', '0', '08/06/2021 12:00:00'),
	('refrigerador', '0', '08/06/2021 12:00:00'),
	('humidade', '45', '25/05/2021 18:00:00'),
	('nivel da agua', '32', '08/06/2021 12:00:00'),
	('humidificador', '1', '25/05/2021 18:00:00'),
	('ventoinha', '0', '25/05/2021 18:00:00'),
	('rega', '0', '08/06/2021 12:00:00'),
	('co2', '32', '26/05/2021 18:00:00'),
	('porta', '0', '08/06/2021 12:00:00'),
	('janela', '0', '08/06/2021 12:00:00');



DROP TABLE IF EXISTS `utilizadores`;
CREATE TABLE `utilizadores` (
	idUtilizador INT AUTO_INCREMENT PRIMARY KEY,
    username varchar(20) NOT NULL UNIQUE,
    password varchar(20) NOT NULL,
	perfil ENUM('admin', 'funcionario', 'user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `utilizadores` (`idUtilizador`, `username`, `password`, `perfil`) VALUES
	(1, 'mariana', 'pass', 1),
	(2, 'maria', 'pass', 1),
	(3, 'hugo', 'pass', 2),
	(4, 'jose', 'pass', 2),
	(5, 'ana', 'pass', 3),
	(6, 'mario', 'pass', 3);



DROP TABLE IF EXISTS `historico`;
CREATE TABLE `historico` (
	idHistorico  INT AUTO_INCREMENT NOT NULL,
    nome VARCHAR(30) NOT NULL,
	valor VARCHAR(255) NOT NULL,
	hora VARCHAR(20) NOT NULL,
	PRIMARY KEY (`idHistorico`),
    FOREIGN KEY (`nome`) REFERENCES `sensores`(`designacao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `historico` (`idHistorico`, `nome`, `valor`, `hora`) VALUES
	(1, 'humidade', '88', '24/05/2021 18:00:00'),
	(2, 'humidade', '59', '24/05/2021 18:00:00'),
	(3, 'temperatura', '35', '24/05/2021 18:00:00'),
	(4, 'temperatura', '45', '24/05/2021 18:30:00'),
	(5, 'temperatura', '52', '25/05/2021 18:00:00'),
	(6, 'luminosidade', '42', '24/05/2021 17:20:00'),
	(7, 'luminosidade', '51', '24/05/2021 17:32:00'),
	(8, 'luminosidade', '48', '24/05/2021 18:00:00'),
	(9, 'humidade', '44', '24/05/2021 15:16:02'),
	(10, 'humidade', '45', '25/05/2021 18:00:00'),
	(11, 'co2', '46', '26/05/2021 14:22:00'),
	(12, 'co2', '32', '26/05/2021 18:00:00'),
	(13, 'nivel da agua', '32', '08/06/2021 12:00:00'),
	(14, 'porta', '0', '08/06/2021 12:00:00'),
	(15, 'janela', '0', '08/06/2021 12:00:00'),
	(16, 'rega', '0', '08/06/2021 12:00:00'),
	(17, 'aquecimento', '0', '08/06/2021 12:00:00'),
	(18, 'refrigerador', '0', '08/06/2021 12:00:00'),
	(19, 'movimento', '0', '08/06/2021 12:00:00'),
	(20, 'camara', 'public/img/webcam/camara_13-06-2021_09-37-14.jpg', '13/06/2021 09:37:15'),
	(21, 'humidificador', '0', '08/06/2021 12:00:00'),
	(22, 'ventoinha', '1', '08/06/2021 12:00:00');
    
