



-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table 'Disciplina'
-- 
-- ---

DROP TABLE IF EXISTS `Disciplina`;
		
CREATE TABLE `Disciplina` (
  `disciplina_id` INT NOT NULL AUTO_INCREMENT,
  `coduc` VARCHAR(255) NOT NULL,
  `nome` VARCHAR(255) NOT NULL,
  `anoletivo` VARCHAR(255) NOT NULL,
  `curso` VARCHAR(255) NOT NULL,
  `instituicao` VARCHAR(255) NOT NULL,
  `token` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`disciplina_id`)
);

-- ---
-- Table 'Trabalho'
-- 
-- ---

DROP TABLE IF EXISTS `Trabalho`;
		
CREATE TABLE `Trabalho` (
  `trabalho_id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `datainicial` DATETIME NOT NULL,
  `datafinal` DATETIME NOT NULL,
  `visibilidade` INT NOT NULL DEFAULT 1,
  `descricao` MEDIUMTEXT NULL DEFAULT NULL,
  `tema` VARCHAR(255) NOT NULL,
  `datagrupos` DATETIME NOT NULL,
  `datarepositorio` DATETIME NOT NULL,
  `limitesubmissao` DATETIME NOT NULL,
  `atraso` INT NOT NULL DEFAULT 1,
  `desconto` FLOAT NOT NULL DEFAULT 0,
  `pesonota` INT NULL DEFAULT 100,
  `tipoavaliacao` INT NOT NULL DEFAULT 1,
  `regrasurl` MEDIUMTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`trabalho_id`)
);

-- ---
-- Table 'Grupo_Submissao'
-- 
-- ---

DROP TABLE IF EXISTS `Grupo_Submissao`;
		
CREATE TABLE `Grupo_Submissao` (
  `grupo_id` INT NOT NULL,
  `submissao_id` INT NOT NULL
);

-- ---
-- Table 'Aluno'
-- 
-- ---

DROP TABLE IF EXISTS `Aluno`;
		
CREATE TABLE `Aluno` (
  `aluno_id` INT NOT NULL AUTO_INCREMENT,
  `password` VARCHAR(255) NOT NULL,
  `nome` VARCHAR(255) NOT NULL,
  `naluno` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `website` MEDIUMTEXT NULL DEFAULT NULL,
  `foto` MEDIUMTEXT NULL DEFAULT NULL,
  `curso` VARCHAR(255) NOT NULL,
  `instituicao` VARCHAR(255) NOT NULL,
  `sobre` MEDIUMTEXT NULL DEFAULT NULL,
  `estatuto` INT NOT NULL DEFAULT 1,
  PRIMARY KEY (`aluno_id`)
);

-- ---
-- Table 'Aluno_Disciplina'
-- 
-- ---

DROP TABLE IF EXISTS `Aluno_Disciplina`;
		
CREATE TABLE `Aluno_Disciplina` (
  `aluno_id` INT NOT NULL,
  `disciplina_id` INT NOT NULL,
  `ativa` TINYINT NOT NULL DEFAULT 1
);

-- ---
-- Table 'Grupo'
-- 
-- ---

DROP TABLE IF EXISTS `Grupo`;
		
CREATE TABLE `Grupo` (
  `grupo_id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `avaliacao` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`grupo_id`)
);

-- ---
-- Table 'Trabalho_Ficheiro'
-- 
-- ---

DROP TABLE IF EXISTS `Trabalho_Ficheiro`;
		
CREATE TABLE `Trabalho_Ficheiro` (
  `trabalho_id` INT NOT NULL,
  `ficheiro_id` INT NOT NULL
);

-- ---
-- Table 'Docente_Disciplina'
-- 
-- ---

DROP TABLE IF EXISTS `Docente_Disciplina`;
		
CREATE TABLE `Docente_Disciplina` (
  `docente_id` INT NOT NULL,
  `disciplina_id` INT NOT NULL,
  `ativa` TINYINT NOT NULL DEFAULT 1
);

-- ---
-- Table 'Disciplina_Trabalho'
-- 
-- ---

DROP TABLE IF EXISTS `Disciplina_Trabalho`;
		
CREATE TABLE `Disciplina_Trabalho` (
  `disciplina_id` INT NOT NULL,
  `trabalho_id` INT NOT NULL
);

-- ---
-- Table 'Docente'
-- 
-- ---

DROP TABLE IF EXISTS `Docente`;
		
CREATE TABLE `Docente` (
  `docente_id` INT NOT NULL AUTO_INCREMENT,
  `password` VARCHAR(255) NOT NULL,
  `nome` VARCHAR(255) NOT NULL,
  `ndocente` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `website` MEDIUMTEXT NULL DEFAULT NULL,
  `foto` MEDIUMTEXT NULL DEFAULT NULL,
  `cv` MEDIUMTEXT NULL DEFAULT NULL,
  `contatos` MEDIUMTEXT NULL DEFAULT NULL,
  `sobre` MEDIUMTEXT NULL DEFAULT NULL,
  `myAcademia` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`docente_id`)
);

-- ---
-- Table 'Submissao'
-- 
-- ---

DROP TABLE IF EXISTS `Submissao`;
		
CREATE TABLE `Submissao` (
  `submissao_id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `tamanho` FLOAT NULL DEFAULT NULL,
  `url` MEDIUMTEXT NOT NULL,
  `data` DATETIME NOT NULL,
  `descricao` MEDIUMTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`submissao_id`)
);

-- ---
-- Table 'Ficheiro'
-- 
-- ---

DROP TABLE IF EXISTS `Ficheiro`;
		
CREATE TABLE `Ficheiro` (
  `ficheiro_id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `url` MEDIUMTEXT NOT NULL,
  `descricao` MEDIUMTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`ficheiro_id`)
);

-- ---
-- Table 'Admin'
-- 
-- ---

DROP TABLE IF EXISTS `Admin`;
		
CREATE TABLE `Admin` (
  `admin_id` INT NOT NULL AUTO_INCREMENT DEFAULT NULL,
  `password` VARCHAR(255) NOT NULL,
  `nome` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`admin_id`)
);

-- ---
-- Table 'Grupo_Aluno'
-- 
-- ---

DROP TABLE IF EXISTS `Grupo_Aluno`;
		
CREATE TABLE `Grupo_Aluno` (
  `grupo_id` INT NOT NULL,
  `aluno_id` INT NOT NULL
);

-- ---
-- Table 'Trabalho_Grupo'
-- 
-- ---

DROP TABLE IF EXISTS `Trabalho_Grupo`;
		
CREATE TABLE `Trabalho_Grupo` (
  `trabalho_id` INT NOT NULL,
  `grupo_id` INT NOT NULL
);

-- ---
-- Table 'Evento'
-- 
-- ---

DROP TABLE IF EXISTS `Evento`;
		
CREATE TABLE `Evento` (
  `evento_id` INT NOT NULL AUTO_INCREMENT,
  `dataEvento` DATETIME NOT NULL,
  `evento` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`evento_id`)
);

-- ---
-- Table 'Aluno_Evento'
-- 
-- ---

DROP TABLE IF EXISTS `Aluno_Evento`;
		
CREATE TABLE `Aluno_Evento` (
  `aluno_id` INT NOT NULL,
  `evento_id` INT NOT NULL
);

-- ---
-- Table 'Docente_Evento'
-- 
-- ---

DROP TABLE IF EXISTS `Docente_Evento`;
		
CREATE TABLE `Docente_Evento` (
  `docente_id` INT NOT NULL,
  `evento_id` INT NOT NULL
);

-- ---
-- Table 'Disciplina_Evento'
-- 
-- ---

DROP TABLE IF EXISTS `Disciplina_Evento`;
		
CREATE TABLE `Disciplina_Evento` (
  `disciplina_id` INT NOT NULL,
  `evento_id` INT NOT NULL
);

-- ---
-- Table 'Aluno_Trabalho'
-- 
-- ---

DROP TABLE IF EXISTS `Aluno_Trabalho`;
		
CREATE TABLE `Aluno_Trabalho` (
  `aluno_id` INT NOT NULL,
  `trabalho_id` INT NOT NULL,
  `avaliacao` VARCHAR(255) NULL DEFAULT NULL
);

-- ---
-- Foreign Keys 
-- ---

ALTER TABLE `Grupo_Submissao` ADD FOREIGN KEY (grupo_id) REFERENCES `Grupo` (`grupo_id`);
ALTER TABLE `Grupo_Submissao` ADD FOREIGN KEY (submissao_id) REFERENCES `Submissao` (`submissao_id`);
ALTER TABLE `Aluno_Disciplina` ADD FOREIGN KEY (aluno_id) REFERENCES `Aluno` (`aluno_id`);
ALTER TABLE `Aluno_Disciplina` ADD FOREIGN KEY (disciplina_id) REFERENCES `Disciplina` (`disciplina_id`);
ALTER TABLE `Trabalho_Ficheiro` ADD FOREIGN KEY (trabalho_id) REFERENCES `Trabalho` (`trabalho_id`);
ALTER TABLE `Trabalho_Ficheiro` ADD FOREIGN KEY (ficheiro_id) REFERENCES `Ficheiro` (`ficheiro_id`);
ALTER TABLE `Docente_Disciplina` ADD FOREIGN KEY (docente_id) REFERENCES `Docente` (`docente_id`);
ALTER TABLE `Docente_Disciplina` ADD FOREIGN KEY (disciplina_id) REFERENCES `Disciplina` (`disciplina_id`);
ALTER TABLE `Disciplina_Trabalho` ADD FOREIGN KEY (disciplina_id) REFERENCES `Disciplina` (`disciplina_id`);
ALTER TABLE `Disciplina_Trabalho` ADD FOREIGN KEY (trabalho_id) REFERENCES `Trabalho` (`trabalho_id`);
ALTER TABLE `Grupo_Aluno` ADD FOREIGN KEY (grupo_id) REFERENCES `Grupo` (`grupo_id`);
ALTER TABLE `Grupo_Aluno` ADD FOREIGN KEY (aluno_id) REFERENCES `Aluno` (`aluno_id`);
ALTER TABLE `Trabalho_Grupo` ADD FOREIGN KEY (trabalho_id) REFERENCES `Trabalho` (`trabalho_id`);
ALTER TABLE `Trabalho_Grupo` ADD FOREIGN KEY (grupo_id) REFERENCES `Grupo` (`grupo_id`);
ALTER TABLE `Aluno_Evento` ADD FOREIGN KEY (aluno_id) REFERENCES `Aluno` (`aluno_id`);
ALTER TABLE `Aluno_Evento` ADD FOREIGN KEY (evento_id) REFERENCES `Evento` (`evento_id`);
ALTER TABLE `Docente_Evento` ADD FOREIGN KEY (docente_id) REFERENCES `Docente` (`docente_id`);
ALTER TABLE `Docente_Evento` ADD FOREIGN KEY (evento_id) REFERENCES `Evento` (`evento_id`);
ALTER TABLE `Disciplina_Evento` ADD FOREIGN KEY (disciplina_id) REFERENCES `Disciplina` (`disciplina_id`);
ALTER TABLE `Disciplina_Evento` ADD FOREIGN KEY (evento_id) REFERENCES `Evento` (`evento_id`);
ALTER TABLE `Aluno_Trabalho` ADD FOREIGN KEY (aluno_id) REFERENCES `Aluno` (`aluno_id`);
ALTER TABLE `Aluno_Trabalho` ADD FOREIGN KEY (trabalho_id) REFERENCES `Trabalho` (`trabalho_id`);

-- ---
-- Table Properties
-- ---

-- ALTER TABLE `Disciplina` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Trabalho` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Grupo_Submissao` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Aluno` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Aluno_Disciplina` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Grupo` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Trabalho_Ficheiro` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Docente_Disciplina` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Disciplina_Trabalho` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Docente` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Submissao` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Ficheiro` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Admin` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Grupo_Aluno` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Trabalho_Grupo` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Evento` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Aluno_Evento` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Docente_Evento` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Disciplina_Evento` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Aluno_Trabalho` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ---
-- Test Data
-- ---

-- INSERT INTO `Disciplina` (`disciplina_id`,`coduc`,`nome`,`anoletivo`,`curso`,`instituicao`,`token`) VALUES
-- ('','','','','','','');
-- INSERT INTO `Trabalho` (`trabalho_id`,`nome`,`datainicial`,`datafinal`,`visibilidade`,`descricao`,`tema`,`datagrupos`,`datarepositorio`,`limitesubmissao`,`atraso`,`desconto`,`pesonota`,`tipoavaliacao`,`regrasurl`) VALUES
-- ('','','','','','','','','','','','','','','');
-- INSERT INTO `Grupo_Submissao` (`grupo_id`,`submissao_id`) VALUES
-- ('','');
-- INSERT INTO `Aluno` (`aluno_id`,`password`,`nome`,`naluno`,`email`,`website`,`foto`,`curso`,`instituicao`,`sobre`,`estatuto`) VALUES
-- ('','','','','','','','','','','');
-- INSERT INTO `Aluno_Disciplina` (`aluno_id`,`disciplina_id`,`ativa`) VALUES
-- ('','','');
-- INSERT INTO `Grupo` (`grupo_id`,`nome`,`avaliacao`) VALUES
-- ('','','');
-- INSERT INTO `Trabalho_Ficheiro` (`trabalho_id`,`ficheiro_id`) VALUES
-- ('','');
-- INSERT INTO `Docente_Disciplina` (`docente_id`,`disciplina_id`,`ativa`) VALUES
-- ('','','');
-- INSERT INTO `Disciplina_Trabalho` (`disciplina_id`,`trabalho_id`) VALUES
-- ('','');
-- INSERT INTO `Docente` (`docente_id`,`password`,`nome`,`ndocente`,`email`,`website`,`foto`,`cv`,`contatos`,`sobre`,`myAcademia`) VALUES
-- ('','','','','','','','','','','');
-- INSERT INTO `Submissao` (`submissao_id`,`nome`,`tamanho`,`url`,`data`,`descricao`) VALUES
-- ('','','','','','');
-- INSERT INTO `Ficheiro` (`ficheiro_id`,`nome`,`url`,`descricao`) VALUES
-- ('','','','');
-- INSERT INTO `Admin` (`admin_id`,`password`,`nome`,`email`) VALUES
-- ('','','','');
-- INSERT INTO `Grupo_Aluno` (`grupo_id`,`aluno_id`) VALUES
-- ('','');
-- INSERT INTO `Trabalho_Grupo` (`trabalho_id`,`grupo_id`) VALUES
-- ('','');
-- INSERT INTO `Evento` (`evento_id`,`dataEvento`,`evento`) VALUES
-- ('','','');
-- INSERT INTO `Aluno_Evento` (`aluno_id`,`evento_id`) VALUES
-- ('','');
-- INSERT INTO `Docente_Evento` (`docente_id`,`evento_id`) VALUES
-- ('','');
-- INSERT INTO `Disciplina_Evento` (`disciplina_id`,`evento_id`) VALUES
-- ('','');
-- INSERT INTO `Aluno_Trabalho` (`aluno_id`,`trabalho_id`,`avaliacao`) VALUES
-- ('','','');

