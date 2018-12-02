



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


-- ---
-- Inserts
-- ---


/** ADMIN **/
INSERT INTO Admin (password, nome, email) 
VALUES ('1a1dc91c907325c69271ddf0c944bc72','admin','admin@gmail.com');


/** DOCENTE **/
INSERT INTO Docente (password, nome, ndocente, email, website, foto, cv, contatos, sobre, myAcademia) 
VALUES ('1a1dc91c907325c69271ddf0c944bc72','José Carlos Ramalho','p1000','jcr2@di.uminho.pt','http://www.di.uminho.pt/~jcr/', 'uploads/photos/teacher/teacherphoto1.jpg', 'http://www.di.uminho.pt/~jcr/', 'Telef: +351-253604470 | Fax: +351-253604471', 'Duis mollis non nunc non cursus. Integer euismod euismod magna ut suscipit. In venenatis auctor nisi in blandit. Fusce risus risus, mollis ac diam consequat, ullamcorper molestie augue. Donec non congue odio.', 'jcr');

INSERT INTO Docente (password, nome, ndocente, email, website, foto, cv, contatos, sobre, myAcademia)  
VALUES ('1a1dc91c907325c69271ddf0c944bc72','Pedro Rangel Henriques','p1001','prh2@di.uminho.pt','http://www3.di.uminho.pt/~prh/', 'uploads/photos/teacher/teacherphoto2.jpg', 'http://www3.di.uminho.pt/~prh/ecvprh13jun.pdf.', 'Phone: +351 253 604479 | FAX: +351 253 604471 | Ext.: 604479','Cras sit amet metus congue, pretium leo eget, vulputate elit. Praesent eu interdum enim. Suspendisse potenti. Donec accumsan quam quis augue auctor iaculis. Aliquam ac sollicitudin tellus. Aenean sed purus neque.', 'prh');

INSERT INTO Docente (password, nome, ndocente, email, website, foto, contatos) 
VALUES ('1a1dc91c907325c69271ddf0c944bc72','José João A. G. Dias de Almeida','p1002','jj2@di.uminho.pt','http://natura.di.uminho.pt/~jj/', 'uploads/photos/teacher/teacherphoto3.jpg', 'telef: (351)(053)604479');

INSERT INTO Docente (password, nome, ndocente, email, website) 
VALUES ('1a1dc91c907325c69271ddf0c944bc72','Rui Mendes','p1003','azuki2@di.uminho.pt','http://www3.di.uminho.pt/~rcm/');

INSERT INTO Docente (password, nome, ndocente, email, website, contatos) 
VALUES ('1a1dc91c907325c69271ddf0c944bc72','Nuno Oliveira','p1004','nunooliveira2@di.uminho.com','http://alfa.di.uminho.pt/~nunooliveira/', 'nuno43549@gmail.com');


/** ALUNO **/
INSERT INTO Aluno (password, nome, naluno, email, website, foto, curso, instituicao, estatuto, sobre) 
VALUES ('1a1dc91c907325c69271ddf0c944bc72','David Branco', 'a55878','davidbranco88@gmail.com','www.davidbranco.com', 'uploads/photos/student/studentphoto1.jpg', 'Licenciatura em Ciências da Computação','Universidade do Minho', 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam nec tortor rutrum metus molestie vehicula.');

INSERT INTO Aluno (password, nome, naluno, email, website, foto, curso, instituicao, estatuto, sobre) 
VALUES ('1a1dc91c907325c69271ddf0c944bc72','Bruno Araujo','pg26216','brunotiagoaraujo@gmail.com','www.brunoaraujo.com', 'uploads/photos/student/studentphoto2.jpg', 'Mestrado em Engenharia Informática','Universidade do Minho', 2, 'Sed imperdiet lorem lacus, sed scelerisque massa adipiscing ut. Nulla a dignissim metus, in tempor est.');

INSERT INTO Aluno (password, nome, naluno, email, website, curso, instituicao, estatuto) 
VALUES ('1a1dc91c907325c69271ddf0c944bc72', 'Ricardo Silva', 'a52839', 'kaiserric@gmail.com', 'www.ricardosilva.com', 'Licenciatura em Ciências da Computação', 'Universidade do Minho', 1);

INSERT INTO Aluno (password, nome, naluno, email, website, curso, instituicao, estatuto) 
VALUES ('1a1dc91c907325c69271ddf0c944bc72', 'Nelson Brandão', 'a50001', 'nelson@gmail.com', 'www.nelsonbrandao.com', 'Licenciatura em Ciências da Computação', 'Universidade do Minho', 2);

INSERT INTO Aluno (password, nome, naluno, email, website, curso, instituicao, estatuto) 
VALUES ('1a1dc91c907325c69271ddf0c944bc72', 'Ramon Rodrigues', 'a50002', 'ramon@gmail.com', 'www.ramon.com', 'Licenciatura em Ciências da Computação', 'Universidade do Minho', 2);

INSERT INTO Aluno (password, nome, naluno, email, website, curso, instituicao, estatuto) 
VALUES ('1a1dc91c907325c69271ddf0c944bc72', 'Luis Lima', 'a50003', 'luis@gmail.com', 'www.luislima.com', 'Licenciatura em Ciências da Computação', 'Universidade do Minho', 2);

INSERT INTO Aluno (password, nome, naluno, email, curso, instituicao, estatuto) 
VALUES ('1a1dc91c907325c69271ddf0c944bc72','Jorge Lobo Teixeira Lopes','a53898',' jorgelobolopes@gmail.com',  'Mestrado em Engenharia Informática', 'Universidade do Minho', 3);

INSERT INTO Aluno (password, nome, naluno, email, curso, instituicao, estatuto) 
VALUES ('1a1dc91c907325c69271ddf0c944bc72','Paulo Alexandre Ribeiro Silva','a62144',' pauloribeirosilva92@gmail.com', 'Mestrado em Engenharia Informática','Universidade do Minho', 3);

INSERT INTO Aluno (password, nome, naluno, email, curso, instituicao, estatuto) 
VALUES ('1a1dc91c907325c69271ddf0c944bc72', 'André Augusto C. Santos', 'pg30001', 'andreccdr@gmail.com', 'Mestrado em Engenharia Informática', 'Universidade do Minho', 1);

INSERT INTO Aluno (password, nome, naluno, email, curso, instituicao, estatuto) 
VALUES ('1a1dc91c907325c69271ddf0c944bc72', 'André Filipe P. Vieira', 'pg30002', 'andvieira.16@gmail.com', 'Mestrado em Engenharia Informática', 'Universidade do Minho', 1);

INSERT INTO Aluno (password, nome, naluno, email, curso, instituicao, estatuto) 
VALUES ('1a1dc91c907325c69271ddf0c944bc72', 'André Murta Pereira', 'pg30003', 'pg25303@alunos.uminho.pt', 'Mestrado em Engenharia Informática', 'Universidade do Minho', 1);

INSERT INTO Aluno (password, nome, naluno, email, curso, instituicao, estatuto) 
VALUES ('1a1dc91c907325c69271ddf0c944bc72', 'Damien da Silva Vaz', 'pg30004', 'vaz.damien@gmail.com', 'Mestrado em Engenharia Informática', 'Universidade do Minho', 2);

INSERT INTO Aluno (password, nome, naluno, email, curso, instituicao, estatuto) 
VALUES ('1a1dc91c907325c69271ddf0c944bc72', 'Daniel A. P. Carvalho', 'pg30005', 'edu@danielcarvalho.pt', 'Mestrado em Engenharia Informática', 'Universidade do Minho', 1);

INSERT INTO Aluno (password, nome, naluno, email, curso, instituicao, estatuto) 
VALUES ('1a1dc91c907325c69271ddf0c944bc72', 'Fábio A. M. Fernandes', 'pg30006', ' fabio6595@gmail.com', 'Mestrado em Engenharia Informática', 'Universidade do Minho', 1);

INSERT INTO Aluno (password, nome, naluno, email, curso, instituicao, estatuto) 
VALUES ('1a1dc91c907325c69271ddf0c944bc72', 'João Carlos Cruz', 'pg30007', ' joao.cruz28@gmail.com', 'Mestrado em Engenharia Informática', 'Universidade do Minho', 1);

INSERT INTO Aluno (password, nome, naluno, email, curso, instituicao, estatuto) 
VALUES ('1a1dc91c907325c69271ddf0c944bc72', 'João Pedro Torres Pereira', 'pg30008', ' pg25319@alunos.uminho.pt', 'Mestrado em Engenharia Informática', 'Universidade do Minho', 1);

INSERT INTO Aluno (password, nome, naluno, email, curso, instituicao, estatuto) 
VALUES ('1a1dc91c907325c69271ddf0c944bc72', 'Marina Machado', 'pg30009', 'angel.yorda@gmail.com', 'Mestrado em Engenharia Informática', 'Universidade do Minho', 1);

INSERT INTO Aluno (password, nome, naluno, email, curso, instituicao, estatuto) 
VALUES ('1a1dc91c907325c69271ddf0c944bc72', 'Nuno Miguel L. G. Vieira', 'pg30010', 'pg25322@alunos.uminho.p', 'Mestrado em Engenharia Informática', 'Universidade do Minho', 2);

INSERT INTO Aluno (password, nome, naluno, email, curso, instituicao, estatuto) 
VALUES ('1a1dc91c907325c69271ddf0c944bc72', 'Nuno Ricardo A. Morais', 'pg30011', 'geral@nuno-morais.eu', 'Mestrado em Engenharia Informática', 'Universidade do Minho', 1);

INSERT INTO Aluno (password, nome, naluno, email, curso, instituicao, estatuto) 
VALUES ('1a1dc91c907325c69271ddf0c944bc72', 'Ricardo Jorge R. Branco', 'pg30012', '28.ricardobranco@gmail.com', 'Mestrado em Engenharia Informática', 'Universidade do Minho', 1);

INSERT INTO Aluno (password, nome, naluno, email, curso, instituicao, estatuto) 
VALUES ('1a1dc91c907325c69271ddf0c944bc72', 'Sérgio Maia Dias', 'pg30013', 'pg25338@alunos.uminho.pt', 'Mestrado em Engenharia Informática', 'Universidade do Minho', 1);

INSERT INTO Aluno (password, nome, naluno, email, curso, instituicao, estatuto) 
VALUES ('1a1dc91c907325c69271ddf0c944bc72', 'Vitor Duarte da R. Armada', 'pg30014', 'vitorarmada@hotmail.com', 'Mestrado em Engenharia Informática', 'Universidade do Minho', 1);

INSERT INTO Aluno (password, nome, naluno, email, curso, instituicao, estatuto) 
VALUES ('1a1dc91c907325c69271ddf0c944bc72', 'Fernando Miguel Martins', 'a60003', 'KURAYAMA@live.com', 'Licenciatura em Engenharia Informática', 'Universidade do Minho', 2);

INSERT INTO Aluno (password, nome, naluno, email, curso, instituicao, estatuto) 
VALUES ('1a1dc91c907325c69271ddf0c944bc72', 'Daniel José Ferreira Novais', 'a60001', 'danielnovais92@gmail.com', 'Licenciatura em Ciências da Computação', 'Universidade do Minho', 1);

INSERT INTO Aluno (password, nome, naluno, email, curso, instituicao, estatuto) 
VALUES ('1a1dc91c907325c69271ddf0c944bc72', 'Eduardo José Dias Pessoa', 'a60002', 'eduardo.jose.pessoa@gmail.com', 'Licenciatura em Ciências da Computação', 'Universidade do Minho', 3);

INSERT INTO Aluno (password, nome, naluno, email, curso, instituicao, estatuto) 
VALUES ('1a1dc91c907325c69271ddf0c944bc72', 'Miguel Angelo Gomes da Costa', 'a60004', 'miguel.angelo.cst@gmail.com', 'Licenciatura em Ciências da Computação', 'Universidade do Minho', 1);

INSERT INTO Aluno (password, nome, naluno, email, curso, instituicao, estatuto) 
VALUES ('1a1dc91c907325c69271ddf0c944bc72', 'Pedro Sérgio Azevedo', 'a54065', 'a54065@alunos.uminho.pt ', 'Licenciatura em Ciências da Computação', 'Universidade do Minho', 1);

INSERT INTO Aluno (password, nome, naluno, email, curso, instituicao, estatuto) 
VALUES ('1a1dc91c907325c69271ddf0c944bc72', 'Ricardo José Sampaio', 'a58902', 'a58902@alunos.uminho.pt', 'Licenciatura em Ciências da Computação', 'Universidade do Minho', 1);

INSERT INTO Aluno (password, nome, naluno, email, curso, instituicao, estatuto) 
VALUES ('1a1dc91c907325c69271ddf0c944bc72', 'Tiago Filipe Andrade Brito', 'a60005', ' tiago.brito3@gmail.com', 'Licenciatura em Ciências da Computação', 'Universidade do Minho', 1);


/** DISCIPLINA **/
INSERT INTO Disciplina (coduc, nome, anoletivo, curso, instituicao, token) 
VALUES ('00001', 'Processamento de Linguagens e Compiladores', '2013/2014', 'Licenciatura em Ciências da Computação', 'Universidade do Minho', 'uzomzyxyz27h0rv97');

INSERT INTO Disciplina (coduc, nome, anoletivo, curso, instituicao, token) 
VALUES ('00002', 'Processamento Estruturado de Documentos', '2013/2014', 'Mestrado em Engenharia Informática', 'Universidade do Minho','irwbs2b2dk9o537c8');

INSERT INTO Disciplina (coduc, nome, anoletivo, curso, instituicao, token) 
VALUES ('00003', 'Programação Imperativa', '2013/2014', 'Licenciatura em Ciências da Computação', 'Universidade do Minho', 'peuzldxulyho8y2qo');

INSERT INTO Disciplina (coduc, nome, anoletivo, curso, instituicao, token) 
VALUES ('00004', 'Processamento de Linguagens', '2013/2014', 'Licenciatura em Engenharia Informática', 'Universidade do Minho', 'ihf8scn85ebjvzs2b');

INSERT INTO Disciplina (coduc, nome, anoletivo, curso, instituicao, token) 
VALUES ('00005', 'Engenharia Gramatical', '2012/2013', 'Mestrado em Engenharia Informática', 'Universidade do Minho', '5ggjsanqerk0z6s4e');

INSERT INTO Disciplina (coduc, nome, anoletivo, curso, instituicao, token) 
VALUES ('00006', 'Programação Funcional', '2012/2013', 'Licenciatura em Ciências da Computação', 'Universidade do Minho', 'rqdqopx5px3751fw1');


/** GRUPO **/
INSERT INTO Grupo (nome, avaliacao) 
VALUES ('Grupo 1', '10');

INSERT INTO Grupo (nome, avaliacao) 
VALUES ('Grupo 2', '11');

INSERT INTO Grupo (nome, avaliacao) 
VALUES ('Grupo 3', '12');

INSERT INTO Grupo (nome, avaliacao) 
VALUES ('Grupo 4', '13');

INSERT INTO Grupo (nome, avaliacao) 
VALUES ('Grupo 5', '14');

INSERT INTO Grupo (nome, avaliacao) 
VALUES ('Grupo 6', '15');

INSERT INTO Grupo (nome, avaliacao)
VALUES ('Grupo 1', '15');

INSERT INTO Grupo (nome, avaliacao)
VALUES ('Grupo 2', '14');

INSERT INTO Grupo (nome, avaliacao)
VALUES ('Grupo 3', '13');

INSERT INTO Grupo (nome, avaliacao)
VALUES ('Grupo 4', '12');

INSERT INTO Grupo (nome, avaliacao)
VALUES ('Grupo 5', '11');

INSERT INTO Grupo (nome, avaliacao)
VALUES ('Grupo 6', '10');

INSERT INTO Grupo (nome) 
VALUES ('Grupo 1');

INSERT INTO Grupo (nome) 
VALUES ('Grupo 2');

INSERT INTO Grupo (nome) 
VALUES ('Grupo 3');

INSERT INTO Grupo (nome) 
VALUES ('Grupo 4');

INSERT INTO Grupo (nome) 
VALUES ('Grupo 5');

INSERT INTO Grupo (nome) 
VALUES ('Grupo 6');

INSERT INTO Grupo (nome) 
VALUES ('Grupo 7');

INSERT INTO Grupo (nome) 
VALUES ('Grupo 8');

INSERT INTO Grupo (nome) 
VALUES ('Grupo 9');

INSERT INTO Grupo (nome) 
VALUES ('Grupo 10');

INSERT INTO Grupo (nome, avaliacao) 
VALUES ('Grupo 1', '15');

INSERT INTO Grupo (nome, avaliacao) 
VALUES ('Grupo 2', '13');

INSERT INTO Grupo (nome, avaliacao) 
VALUES ('Grupo 3', '12');

INSERT INTO Grupo (nome, avaliacao) 
VALUES ('Grupo 4', '10');

INSERT INTO Grupo (nome, avaliacao) 
VALUES ('Grupo 5', '9');

INSERT INTO Grupo (nome, avaliacao) 
VALUES ('Grupo 6', '8');

INSERT INTO Grupo (nome) 
VALUES ('Grupo 1');

INSERT INTO Grupo (nome) 
VALUES ('Grupo 2');

INSERT INTO Grupo (nome) 
VALUES ('Grupo 3');

INSERT INTO Grupo (nome) 
VALUES ('Grupo 4');

INSERT INTO Grupo (nome) 
VALUES ('Grupo 5');

INSERT INTO Grupo (nome) 
VALUES ('Grupo 6');

INSERT INTO Grupo (nome) 
VALUES ('Grupo 1');

INSERT INTO Grupo (nome) 
VALUES ('Grupo 2');

INSERT INTO Grupo (nome) 
VALUES ('Grupo 3');

INSERT INTO Grupo (nome) 
VALUES ('Grupo 4');

INSERT INTO Grupo (nome) 
VALUES ('Grupo 5');

INSERT INTO Grupo (nome) 
VALUES ('Grupo 6');

INSERT INTO Grupo (nome, avaliacao) 
VALUES ('Grupo 1', '13');

INSERT INTO Grupo (nome, avaliacao) 
VALUES ('Grupo 2', '12');

INSERT INTO Grupo (nome, avaliacao) 
VALUES ('Grupo 3', '13');

INSERT INTO Grupo (nome, avaliacao) 
VALUES ('Grupo 4', '15');

INSERT INTO Grupo (nome, avaliacao) 
VALUES ('Grupo 5', '10');

INSERT INTO Grupo (nome, avaliacao)  
VALUES ('Grupo 1', '10');

INSERT INTO Grupo (nome, avaliacao)  
VALUES ('Grupo 2', '11');

INSERT INTO Grupo (nome, avaliacao)  
VALUES ('Grupo 3', '12');

INSERT INTO Grupo (nome, avaliacao)  
VALUES ('Grupo 4', '13');

INSERT INTO Grupo (nome, avaliacao)  
VALUES ('Grupo 5', '12');

INSERT INTO Grupo (nome, avaliacao)  
VALUES ('Grupo 6', '11');

INSERT INTO Grupo (nome, avaliacao)  
VALUES ('Grupo 7', '10');

INSERT INTO Grupo (nome, avaliacao)  
VALUES ('Grupo 8', '9');

INSERT INTO Grupo (nome, avaliacao)  
VALUES ('Grupo 9', '15');

INSERT INTO Grupo (nome, avaliacao)  
VALUES ('Grupo 10', '16');

INSERT INTO Grupo (nome, avaliacao)  
VALUES ('Grupo 11', '14');

INSERT INTO Grupo (nome, avaliacao)  
VALUES ('Grupo 12', '13');

INSERT INTO Grupo (nome, avaliacao)  
VALUES ('Grupo 13', '10');

INSERT INTO Grupo (nome, avaliacao)  
VALUES ('Grupo 14', '7');


/** TRABALHO **/
INSERT INTO Trabalho (nome, datainicial, datafinal, visibilidade, descricao, tema, datagrupos, datarepositorio, limitesubmissao, pesonota) 
VALUES ('Trabalho Prático nº 1', '2014-01-01 00:00:00', '2014-02-01 00:00:00','2', 'Processamento da Wikipedia', 'Flex', '2014-01-15 00:00:00', '2014-04-02 00:00:00', '2014-02-01 00:00:00', '50');

INSERT INTO Trabalho (nome, datainicial, datafinal, visibilidade, descricao, tema, datagrupos, datarepositorio, limitesubmissao, atraso, desconto, pesonota)  
VALUES ('Trabalho Prático nº2', '2014-05-01 00:00:00','2014-07-19 00:00:00', '1', 'A famosa ODume', 'Yacc/Flex', '2014-06-20 00:00:00', '2014-07-30 00:00:00', '2014-07-20 00:00:00', '3', '10', '50');

INSERT INTO Trabalho (nome, datainicial, datafinal, visibilidade, descricao, tema, datagrupos, datarepositorio, limitesubmissao, tipoavaliacao) 
VALUES ('myAcademia', '2014-01-01 00:00:00', '2014-08-01 00:00:00', '2', 'Um gestor de curriculum académico', 'Engenharia Web', '2014-08-01 00:00:00', '2014-08-25 00:00:00', '2014-08-01 00:00:00', '2');

INSERT INTO Trabalho (nome, datainicial, datafinal, visibilidade, descricao, tema, datagrupos, datarepositorio, limitesubmissao, atraso, desconto, pesonota) 
VALUES ('Trabalho Prático', '2014-03-01 00:00:00', '2014-07-10 00:00:00', '1', 'Pede-se que desenvolva um programa para implementar a tão tradicional e formativa Batalha Naval', 'C', '2014-06-01 00:00:00', '2014-08-01 00:00:00', '2014-07-10 00:00:00', '3', '10', '50');

INSERT INTO Trabalho (nome, datainicial, datafinal, visibilidade, descricao, tema, datagrupos, datarepositorio, limitesubmissao) 
VALUES ('Trabalho Prático nº 1', '2014-01-01 00:00:00', '2014-02-01 00:00:00','2', 'BibTeXPro — Um processador de BibTeX', 'Flex', '2014-01-15 00:00:00', '2014-04-02 00:00:00', '2014-02-01 00:00:00');

INSERT INTO Trabalho (nome, datainicial, datafinal, visibilidade, descricao, tema, datagrupos, datarepositorio, limitesubmissao, atraso, desconto) 
VALUES ('Trabalho Prático nº2', '2014-05-01 00:00:00','2014-07-19 00:00:00', '1', 'Rede Semântica do Museu da Emigração', 'Yacc/Flex', '2014-06-20 00:00:00', '2014-07-30 00:00:00', '2014-07-20 00:00:00', '3', '15');

INSERT INTO Trabalho (nome, datainicial, datafinal, visibilidade, descricao, tema, datagrupos, datarepositorio, limitesubmissao) 
VALUES ('Trabalho Prático', '2013-01-01 00:00:00', '2013-02-01 00:00:00','3', 'Monads', 'Monads', '2013-01-15 00:00:00', '2013-04-02 00:00:00', '2013-02-01 00:00:00');

INSERT INTO Trabalho (nome, datainicial, datafinal, visibilidade, descricao, tema, datagrupos, datarepositorio, limitesubmissao, atraso, pesonota)  
VALUES ('Exame', '2014-07-07 14:00:00', '2014-07-07 17:00:00', '1', 'Exame relativo a toda a matéria leccionada.', 'Exame Programação Imperativa', '2014-07-07 14:05:00', '2014-07-07 17:00:00', '2014-07-07 17:00:00', '1', '50');


/** SUBMISSAO **/
INSERT INTO Submissao (nome, tamanho , url , data, descricao) 
VALUES ('g13_1.zip', '2.63', 'uploads/submissions/class2/work3/workteam13/3-13-20140511105256.zip', '2014-05-11 10:52:56', "Trabalho sem Relatório");

INSERT INTO Submissao (nome, tamanho , url , data, descricao)  
VALUES ('g13_2.zip', '2.63', 'uploads/submissions/class2/work3/workteam13/3-13-20140512105256.zip', '2014-05-12 10:52:56', "Trabalho e Relatório");;

INSERT INTO Submissao (nome, tamanho , url , data) 
VALUES ('g14_1.zip', '2.63', 'uploads/submissions/class2/work3/workteam14/3-14-20140411105256.zip', '2014-04-11 10:52:56');

INSERT INTO Submissao (nome, tamanho , url , data) 
VALUES ('g1_1.zip', '70.41', 'uploads/submissions/class1/work1/workteam1/1-1-20140130100120.zip', '2014-01-30 10:01:20');

INSERT INTO Submissao (nome, tamanho , url , data) 
VALUES ('g2_1.zip', '70.41', 'uploads/submissions/class1/work1/workteam2/1-2-20140130100120.zip', '2014-01-30 10:01:20');

INSERT INTO Submissao (nome, tamanho , url , data) 
VALUES ('g3_1.zip', '70.41', 'uploads/submissions/class1/work1/workteam3/1-3-20140130100120.zip', '2014-01-30 10:01:20');

INSERT INTO Submissao (nome, tamanho , url , data) 
VALUES ('g4_1.zip', '70.41', 'uploads/submissions/class1/work1/workteam4/1-4-20140130100120.zip', '2014-01-30 10:01:20');

INSERT INTO Submissao (nome, tamanho , url , data) 
VALUES ('g5_1.zip', '70.41', 'uploads/submissions/class1/work1/workteam5/1-5-20140130100120.zip', '2014-01-30 10:01:20');

INSERT INTO Submissao (nome, tamanho , url , data) 
VALUES ('g6_1.zip', '70.41', 'uploads/submissions/class1/work1/workteam6/1-6-20140130100120.zip', '2014-01-30 10:01:20');

INSERT INTO Submissao (nome, tamanho , url , data) 
VALUES ('g29_1.zip', '70.41', 'uploads/submissions/class4/work5/workteam29/5-29-20140129110230.zip', '2014-01-29 11:02:30');

INSERT INTO Submissao (nome, tamanho , url , data) 
VALUES ('g30_1.zip', '70.41', 'uploads/submissions/class4/work5/workteam30/5-30-20140129110230.zip', '2014-01-29 11:02:30');

INSERT INTO Submissao (nome, tamanho , url , data) 
VALUES ('g31_1.zip', '70.41', 'uploads/submissions/class4/work5/workteam31/5-31-20140129110230.zip', '2014-01-29 11:02:30');

INSERT INTO Submissao (nome, tamanho , url , data) 
VALUES ('g32_1.zip', '70.41', 'uploads/submissions/class4/work5/workteam32/5-32-20140129110230.zip', '2014-01-29 11:02:30');

INSERT INTO Submissao (nome, tamanho , url , data) 
VALUES ('g33_1.zip', '70.41', 'uploads/submissions/class4/work5/workteam33/5-33-20140129110230.zip', '2014-01-29 11:02:30');

INSERT INTO Submissao (nome, tamanho , url , data) 
VALUES ('g34_1.zip', '70.41', 'uploads/submissions/class4/work5/workteam34/5-34-20140129110230.zip', '2014-01-29 11:02:30');

INSERT INTO Submissao (nome, tamanho , url , data) 
VALUES ('g41.zip', '2.63', 'uploads/submissions/class6/work7/workteam41/7-41-20130130100120.zip', '2013-01-30 10:01:20');

INSERT INTO Submissao (nome, tamanho , url , data) 
VALUES ('g42.zip', '2.63', 'uploads/submissions/class6/work7/workteam42/7-42-20130130100120.zip', '2013-01-30 10:01:20');

INSERT INTO Submissao (nome, tamanho , url , data) 
VALUES ('g43.zip', '2.63', 'uploads/submissions/class6/work7/workteam43/7-43-20130130100120.zip', '2013-01-30 10:01:20');

INSERT INTO Submissao (nome, tamanho , url , data) 
VALUES ('g44.zip', '2.63', 'uploads/submissions/class6/work7/workteam44/7-44-20130130100120.zip', '2013-01-30 10:01:20');

INSERT INTO Submissao (nome, tamanho , url , data) 
VALUES ('g45.zip', '2.63', 'uploads/submissions/class6/work7/workteam45/7-45-20130130100120.zip', '2013-01-30 10:01:20');

INSERT INTO Submissao (nome, tamanho , url , data) 
VALUES ('g23.zip', '0.73', 'uploads/submissions/class3/work4/workteam23/4-23-20140713120420.zip', '2014-07-13 12:04:20');

INSERT INTO Submissao (nome, tamanho , url , data) 
VALUES ('g24.zip', '0.73', 'uploads/submissions/class3/work4/workteam24/4-24-20140708120420.zip', '2014-07-08 12:04:20');

INSERT INTO Submissao (nome, tamanho , url , data) 
VALUES ('g25.zip', '0.73', 'uploads/submissions/class3/work4/workteam25/4-25-20140708120420.zip', '2014-07-08 12:04:20');

INSERT INTO Submissao (nome, tamanho , url , data) 
VALUES ('g26.zip', '0.73', 'uploads/submissions/class3/work4/workteam26/4-26-20140708120420.zip', '2014-07-08 12:04:20');

INSERT INTO Submissao (nome, tamanho , url , data) 
VALUES ('g27.zip', '0.73', 'uploads/submissions/class3/work4/workteam27/4-27-20140708120420.zip', '2014-07-08 12:04:20');

INSERT INTO Submissao (nome, tamanho , url , data) 
VALUES ('g28.zip', '0.73', 'uploads/submissions/class3/work4/workteam28/4-28-20140708120420.zip', '2014-07-08 12:04:20');


/** FICHEIRO **/
INSERT INTO Ficheiro (nome, url, descricao) 
VALUES ('Enunciado_TP1.pdf', 'uploads/files/class1/work1/Enunciado_TP1.pdf', 'Enunciado Trabalho Prático');

INSERT INTO Ficheiro (nome, url, descricao) 
VALUES ('Enunciado_TP2.pdf', 'uploads/files/class1/work2/Enunciado_TP2.pdf', 'Enunciado Trabalho Prático');

INSERT INTO Ficheiro (nome, url, descricao) 
VALUES ('Enunciado_Projeto.pdf', 'uploads/files/class2/work3/Enunciado_Projeto.pdf', 'Enunciado Trabalho Prático');

INSERT INTO Ficheiro (nome, url, descricao) 
VALUES ('dados.xml', 'uploads/files/class2/work3/dados.xml', 'Dados uteis para o projeto');

INSERT INTO Ficheiro (nome, url, descricao) 
VALUES ('Enunciado.pdf', 'uploads/files/class3/work4/Enunciado.pdf', 'Enunciado Trabalho Prático');

INSERT INTO Ficheiro (nome, url, descricao) 
VALUES ('Enunciado_TP1.pdf', 'uploads/files/class4/work5/Enunciado_TP1.pdf', 'Enunciado Trabalho Prático');

INSERT INTO Ficheiro (nome, url, descricao) 
VALUES ('Enunciado_TP2.pdf', 'uploads/files/class4/work6/Enunciado_TP2.pdf', 'Enunciado Trabalho Prático');

INSERT INTO Ficheiro (nome, url) 
VALUES ('output.txt','uploads/files/class2/work3/output.txt');


/** DOCENTE_DISCIPLINA **/
INSERT INTO Docente_Disciplina (docente_id, disciplina_id) 
VALUES ('1','1');

INSERT INTO Docente_Disciplina (docente_id, disciplina_id) 
VALUES ('1','2');

INSERT INTO Docente_Disciplina (docente_id, disciplina_id) 
VALUES ('2','1');

INSERT INTO Docente_Disciplina (docente_id, disciplina_id) 
VALUES ('2','3');

INSERT INTO Docente_Disciplina (docente_id, disciplina_id) 
VALUES ('2','5');

INSERT INTO Docente_Disciplina (docente_id, disciplina_id) 
VALUES ('3','4');

INSERT INTO Docente_Disciplina (docente_id, disciplina_id) 
VALUES ('4','4');

INSERT INTO Docente_Disciplina (docente_id, disciplina_id) 
VALUES ('5','5');

INSERT INTO Docente_Disciplina (docente_id, disciplina_id, ativa) 
VALUES ('1','6', '0');

INSERT INTO Docente_Disciplina (docente_id, disciplina_id, ativa) 
VALUES ('2','6', '0');


/** DISCIPLINA_TRABALHO **/
INSERT INTO Disciplina_Trabalho (disciplina_id, trabalho_id) 
VALUES ('1', '1');

INSERT INTO Disciplina_Trabalho (disciplina_id, trabalho_id) 
VALUES ('1', '2');

INSERT INTO Disciplina_Trabalho (disciplina_id, trabalho_id) 
VALUES ('2', '3');

INSERT INTO Disciplina_Trabalho (disciplina_id, trabalho_id) 
VALUES ('3', '4');

INSERT INTO Disciplina_Trabalho (disciplina_id, trabalho_id) 
VALUES ('4', '5');

INSERT INTO Disciplina_Trabalho (disciplina_id, trabalho_id) 
VALUES ('4', '6');

INSERT INTO Disciplina_Trabalho (disciplina_id, trabalho_id) 
VALUES ('6', '7');

INSERT INTO Disciplina_Trabalho (disciplina_id, trabalho_id) 
VALUES ('3', '8');

/** ALUNO_DISCIPLINA **/
INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('1', '1');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('1', '2');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('1', '3');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('1', '5');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('2', '1');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('2', '2');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('2', '3');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('2', '5');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('3', '1');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('3', '3');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('4', '1');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('4', '3');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('5', '1');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('5', '3');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('6', '1');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('6', '3');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('7', '1');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('7', '2');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('7', '3');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('7', '5');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('8', '1');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('8', '2');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('8', '3');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('8', '5');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('9', '2');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('9', '4');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('9', '5');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('10', '2');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('10', '4');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('10', '5');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('11', '2');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('11', '4');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('11', '5');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('12', '2');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('12', '4');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('12', '5');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('13', '2');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('13', '4');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('13', '5');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('14', '2');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('14', '4');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('14', '5');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('15', '2');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('15', '4');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('15', '5');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('16', '2');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('16', '4');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('16', '5');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('17', '2');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('17', '4');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('17', '5');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('18', '2');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('18', '4');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('18', '5');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('19', '2');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('19', '4');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('19', '5');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('20', '2');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('20', '4');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('20', '5');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('21', '2');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('21', '4');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('21', '5');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('22', '2');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('22', '4');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('22', '5');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('23', '2');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('23', '4');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('23', '5');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('24', '1');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('24', '2');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('24', '3');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('24', '5');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('25', '1');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('25', '2');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('25', '3');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('25', '5');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('26', '1');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('26', '2');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('26', '3');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('26', '5');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('27', '1');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('27', '2');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('27', '3');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('27', '5');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('28', '1');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('28', '2');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('28', '3');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('28', '5');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('29', '1');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('29', '2');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('29', '3');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id) 
VALUES ('29', '5');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id, ativa) 
VALUES ('1', '6' ,'0');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id, ativa) 
VALUES ('2', '6' ,'0');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id, ativa) 
VALUES ('3', '6' ,'0');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id, ativa) 
VALUES ('4', '6' ,'0');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id, ativa) 
VALUES ('5', '6' ,'0');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id, ativa) 
VALUES ('6', '6' ,'0');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id, ativa) 
VALUES ('7', '6' ,'0');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id, ativa) 
VALUES ('8', '6' ,'0');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id, ativa) 
VALUES ('24', '6' ,'0');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id, ativa) 
VALUES ('25', '6' ,'0');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id, ativa) 
VALUES ('26', '6' ,'0');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id, ativa) 
VALUES ('27', '6' ,'0');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id, ativa) 
VALUES ('28', '6' ,'0');

INSERT INTO Aluno_Disciplina (aluno_id, disciplina_id, ativa) 
VALUES ('29', '6' ,'0');


/** TRABALHO_GRUPO **/
INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('1','1');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('1','2');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('1','3');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('1','4');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('1','5');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('1','6');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('2','7');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('2','8');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('2','9');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('2','10');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('2','11');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('2','12');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('3','13');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('3','14');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('3','15');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('3','16');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('3','17');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('3','18');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('3','19');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('3','20');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('3','21');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('3','22');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('4','23');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('4','24');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('4','25');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('4','26');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('4','27');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('4','28');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('5','29');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('5','30');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('5','31');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('5','32');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('5','33');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('5','34');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('6','35');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('6','36');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('6','37');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('6','38');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('6','39');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('6','40');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('7','41');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('7','42');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('7','43');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('7','44');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('7','45');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('8','46');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('8','47');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('8','48');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('8','49');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('8','50');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('8','51');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('8','52');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('8','53');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('8','54');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('8','55');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('8','56');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('8','57');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('8','58');

INSERT INTO Trabalho_Grupo (trabalho_id, grupo_id) 
VALUES ('8','59');


/** GRUPO_ALUNO **/
INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('1','1');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('2','1');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('3','1');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('4','2');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('5','2');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('6','2');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('7','3');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('8','3');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('24','4');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('25','4');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('26','5');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('27','5');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('28','6');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('29','6');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('1','7');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('2','7');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('3','7');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('4','8');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('5','8');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('6','8');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('7','9');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('8','9');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('24','10');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('25','10');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('26','11');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('27','11');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('28','12');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('29','12');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('1','13');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('2','13');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('7','14');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('8','14');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('9','15');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('10','15');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('11','15');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('12','16');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('13','16');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('14','16');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('15','17');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('16','17');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('17','17');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('18','18');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('19','18');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('20','18');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('21','19');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('22','19');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('23','19');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('24','20');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('25','20');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('26','21');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('27','21');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('28','22');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('29','22');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('1','23');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('2','23');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('3','23');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('4','24');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('5','24');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('6','24');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('7','25');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('8','25');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('24','26');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('25','26');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('26','27');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('27','27');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('28','28');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('29','28');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('9','29');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('10','29');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('11','29');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('12','30');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('13','30');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('14','30');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('15','31');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('16','31');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('17','31');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('18','32');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('19','32');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('20','33');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('21','33');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('22','34');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('23','34');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('9','35');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('10','35');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('11','35');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('12','36');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('13','36');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('14','36');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('15','37');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('16','37');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('17','37');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('18','38');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('19','38');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('20','39');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('21','39');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('22','40');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('23','40');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('1','41');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('2','41');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('3','41');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('4','42');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('5','42');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('6','43');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('7','43');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('8','43');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('24','44');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('25','44');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('26','44');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('27','45');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('28','45');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('29','45');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('1','46');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('2','47');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('3','48');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('4','49');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('5','50');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('6','51');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('7','52');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('8','53');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('24','54');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('25','55');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('26','56');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('27','57');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('28','58');

INSERT INTO Grupo_Aluno (aluno_id, grupo_id) 
VALUES ('29','59');


/** GRUPO_SUBMISSAO */
INSERT INTO Grupo_Submissao (grupo_id, submissao_id) 
VALUES ('13', '1');

INSERT INTO Grupo_Submissao (grupo_id, submissao_id) 
VALUES ('13', '2');

INSERT INTO Grupo_Submissao (grupo_id, submissao_id) 
VALUES ('14', '3');

INSERT INTO Grupo_Submissao (grupo_id, submissao_id) 
VALUES ('1', '4');

INSERT INTO Grupo_Submissao (grupo_id, submissao_id) 
VALUES ('2', '5');

INSERT INTO Grupo_Submissao (grupo_id, submissao_id) 
VALUES ('3', '6');

INSERT INTO Grupo_Submissao (grupo_id, submissao_id) 
VALUES ('4', '7');

INSERT INTO Grupo_Submissao (grupo_id, submissao_id) 
VALUES ('5', '8');

INSERT INTO Grupo_Submissao (grupo_id, submissao_id) 
VALUES ('6', '9');

INSERT INTO Grupo_Submissao (grupo_id, submissao_id) 
VALUES ('29', '10');

INSERT INTO Grupo_Submissao (grupo_id, submissao_id) 
VALUES ('30', '11');

INSERT INTO Grupo_Submissao (grupo_id, submissao_id) 
VALUES ('31', '12');

INSERT INTO Grupo_Submissao (grupo_id, submissao_id) 
VALUES ('32', '13');

INSERT INTO Grupo_Submissao (grupo_id, submissao_id) 
VALUES ('33', '14');

INSERT INTO Grupo_Submissao (grupo_id, submissao_id) 
VALUES ('34', '15');

INSERT INTO Grupo_Submissao (grupo_id, submissao_id) 
VALUES ('41', '16');

INSERT INTO Grupo_Submissao (grupo_id, submissao_id) 
VALUES ('42', '17');

INSERT INTO Grupo_Submissao (grupo_id, submissao_id) 
VALUES ('43', '18');

INSERT INTO Grupo_Submissao (grupo_id, submissao_id) 
VALUES ('44', '19');

INSERT INTO Grupo_Submissao (grupo_id, submissao_id) 
VALUES ('45', '20');

INSERT INTO Grupo_Submissao (grupo_id, submissao_id) 
VALUES ('23', '21');

INSERT INTO Grupo_Submissao (grupo_id, submissao_id) 
VALUES ('24', '22');

INSERT INTO Grupo_Submissao (grupo_id, submissao_id) 
VALUES ('25', '23');

INSERT INTO Grupo_Submissao (grupo_id, submissao_id) 
VALUES ('26', '24');

INSERT INTO Grupo_Submissao (grupo_id, submissao_id) 
VALUES ('27', '25');

INSERT INTO Grupo_Submissao (grupo_id, submissao_id) 
VALUES ('28', '26');


/** TRABALHO_FICHEIRO **/
INSERT INTO Trabalho_Ficheiro (trabalho_id, ficheiro_id) 
VALUES ('1', '1');

INSERT INTO Trabalho_Ficheiro (trabalho_id, ficheiro_id) 
VALUES ('2', '2');

INSERT INTO Trabalho_Ficheiro (trabalho_id, ficheiro_id) 
VALUES ('3', '3');

INSERT INTO Trabalho_Ficheiro (trabalho_id, ficheiro_id) 
VALUES ('3', '4');

INSERT INTO Trabalho_Ficheiro (trabalho_id, ficheiro_id) 
VALUES ('4', '5');

INSERT INTO Trabalho_Ficheiro (trabalho_id, ficheiro_id) 
VALUES ('5', '6');

INSERT INTO Trabalho_Ficheiro (trabalho_id, ficheiro_id) 
VALUES ('5', '7');

INSERT INTO Trabalho_Ficheiro (trabalho_id, ficheiro_id) 
VALUES ('3','8');


/** EVENTO **/
INSERT INTO Evento (dataEvento, evento) 
VALUES ('2014-05-29 15:00:00','Reunião de Grupo de PLC');

INSERT INTO Evento (dataEvento, evento) 
VALUES ('2014-05-20 18:30:00','Lançar notas do TP1 de PLC');

INSERT INTO Evento (dataEvento, evento) 
VALUES ('2014-07-20 09:00:00','Teste(1h30)');

INSERT INTO Evento (dataEvento, evento) 
VALUES ('2014-06-20 16:00:00','Teste(2h) Sala:2210');

INSERT INTO Evento (dataEvento, evento) 
VALUES ('2014-07-17 14:00:00','Exame(2h) Sala:1215');

INSERT INTO Evento (dataEvento, evento) 
VALUES ('2014-07-01 11:00:00','Exame Recurso(2h) Sala:2210');

INSERT INTO Evento (dataEvento, evento) 
VALUES ('2013-03-01 14:00:00','Teste(1h30) Sala:1301');


/** ALUNO_EVENTO **/
INSERT INTO Aluno_Evento (aluno_id, evento_id) 
VALUES ('1','1');

INSERT INTO Aluno_Evento (aluno_id, evento_id) 
VALUES ('2','1');


/** DOCENTE_EVENTO **/
INSERT INTO Docente_Evento (docente_id, evento_id) 
VALUES ('1','2');

INSERT INTO Docente_Evento (docente_id, evento_id) 
VALUES ('2','2');


/** DISCIPLINA_EVENTO **/
INSERT INTO Disciplina_Evento (disciplina_id, evento_id) 
VALUES ('1', '3');

INSERT INTO Disciplina_Evento (disciplina_id, evento_id) 
VALUES ('2', '4');

INSERT INTO Disciplina_Evento (disciplina_id, evento_id) 
VALUES ('3', '5');

INSERT INTO Disciplina_Evento (disciplina_id, evento_id) 
VALUES ('4', '6');

INSERT INTO Disciplina_Evento (disciplina_id, evento_id) 
VALUES ('6', '7');


/** ALUNO_TRABALHO **/
INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
VALUES ('1', '1', '10');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
VALUES ('2', '1', '10');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
VALUES ('3', '1', '10');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
VALUES ('4', '1', '11');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
VALUES ('5', '1', '11');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
VALUES ('6', '1', '11');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
VALUES ('7', '1', '12');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
VALUES ('8', '1', '12');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
VALUES ('24', '1', '13');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
VALUES ('25', '1', '13');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
VALUES ('26', '1', '14');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
VALUES ('27', '1', '14');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
VALUES ('28', '1', '15');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
VALUES ('29', '1', '15');

-- INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
-- VALUES ('1', '2', '15');

-- INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
-- VALUES ('2', '2', '15');

-- INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
-- VALUES ('3', '2', '15');

-- INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
-- VALUES ('4', '2', '14');

-- INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
-- VALUES ('5', '2', '14');

-- INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
-- VALUES ('6', '2', '14');

-- INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
-- VALUES ('7', '2', '13');

-- INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
-- VALUES ('8', '2', '13');

-- INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
-- VALUES ('24', '2', '12');

-- INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
-- VALUES ('25', '2', '12');

-- INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
-- VALUES ('26', '2', '11');

-- INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
-- VALUES ('27', '2', '11');

-- INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
-- VALUES ('28', '2', '10');

-- INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
-- VALUES ('29', '2', '10');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('2', '2');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('3', '2');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('4', '2');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('5', '2');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('6', '2');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('7', '2');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('8', '2');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('24', '2');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('25', '2');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('26', '2');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('27', '2');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('28', '2');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('29', '2');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('1', '3');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('2', '3');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('7', '3');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('8', '3');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('9', '3');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('10', '3');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('11', '3');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('12', '3');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('13', '3');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('14', '3');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('15', '3');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('16', '3');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('17', '3');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('18', '3');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('19', '3');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('20', '3');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('21', '3');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('22', '3');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('23', '3');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('24', '3');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('25', '3');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('26', '3');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('27', '3');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('28', '3');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('29', '3');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)  
VALUES ('1', '4', '15');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)  
VALUES ('2', '4', '15');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)  
VALUES ('3', '4', '15');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)  
VALUES ('4', '4', '13');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)  
VALUES ('5', '4', '13');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)  
VALUES ('6', '4', '13');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)  
VALUES ('7', '4', '12');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)  
VALUES ('8', '4', '12');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)  
VALUES ('24', '4', '10');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)  
VALUES ('25', '4', '10');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)  
VALUES ('26', '4', '9');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)  
VALUES ('27', '4', '9');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)  
VALUES ('28', '4', '8');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)  
VALUES ('29', '4', '8');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
VALUES ('9', '5', '10');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
VALUES ('10', '5', '11');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
VALUES ('11', '5', '12');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
VALUES ('12', '5', '13');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
VALUES ('13', '5', '12');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
VALUES ('14', '5', '11');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
VALUES ('15', '5', '10');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
VALUES ('16', '5', '11');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
VALUES ('17', '5', '13');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
VALUES ('18', '5', '12');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
VALUES ('19', '5', '11');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
VALUES ('20', '5', '10');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
VALUES ('21', '5', '11');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
VALUES ('22', '5', '13');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao) 
VALUES ('23', '5', '11');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('9', '6');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('10', '6');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('11', '6');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('12', '6');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('13', '6');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('14', '6');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('15', '6');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('16', '6');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('17', '6');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('18', '6');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('19', '6');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('20', '6');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('21', '6');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('22', '6');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id) 
VALUES ('23', '6');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)   
VALUES ('1', '7', '13');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)   
VALUES ('2', '7', '13');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)   
VALUES ('3', '7', '13');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)   
VALUES ('4', '7', '12');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)   
VALUES ('5', '7', '12');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)   
VALUES ('6', '7', '13');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)   
VALUES ('7', '7', '13');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)   
VALUES ('8', '7', '13');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)   
VALUES ('24', '7', '15');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)   
VALUES ('25', '7', '15');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)   
VALUES ('26', '7', '15');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)   
VALUES ('27', '7', '10');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)   
VALUES ('28', '7', '10');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)   
VALUES ('29', '7', '10');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)   
VALUES ('1', '8', '10');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)   
VALUES ('2', '8', '11');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)   
VALUES ('3', '8', '12');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)   
VALUES ('4', '8', '13');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)   
VALUES ('5', '8', '12');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)   
VALUES ('6', '8', '11');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)   
VALUES ('7', '8', '10');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)   
VALUES ('8', '8', '9');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)   
VALUES ('24', '8', '15');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)   
VALUES ('25', '8', '16');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)   
VALUES ('26', '8', '14');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)   
VALUES ('27', '8', '13');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)   
VALUES ('28', '8', '10');

INSERT INTO Aluno_Trabalho (aluno_id, trabalho_id, avaliacao)   
VALUES ('29', '8', '7');
