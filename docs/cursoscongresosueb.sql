
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "-05:00";

DROP DATABASE IF EXISTS cursoscongresosueb;
CREATE DATABASE cursoscongresosueb;
USE cursoscongresosueb;
CREATE TABLE `td_evento_usuario` (
  `curd_id` int(11) NOT NULL,
  `even_id` int(11) NOT NULL,
  `usu_id` int(11) NOT NULL,
  `fech_crea` datetime NOT NULL,
  `est_aprueba` int(11) NOT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
CREATE TABLE `td_evento_usuario_dias` (
  `asistencia_id` int(11) NOT NULL AUTO_INCREMENT,
  `curd_id` int(11) NOT NULL,
  `fecha_asistencia` DATETIME NOT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY (`asistencia_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



INSERT INTO `td_evento_usuario` (`curd_id`, `even_id`, `usu_id`, `fech_crea`, `est`,`est_aprueba`) VALUES
(1, 1, 1, '2023-10-17 23:11:34', 1,0),
(2, 1, 2, '2023-10-17 23:11:34', 1,0),
(3, 1, 3, '2023-10-17 23:11:34', 1,0),
(4, 1, 4, '2023-10-17 23:11:34', 1,0),
(5, 2, 4, '2023-10-17 23:16:50', 1,0),
(6, 3, 4, '2023-10-17 23:16:56', 1,0);



CREATE TABLE `tm_dependencias` (
  `cat_id` int(11) NOT NULL,
  `cat_nom` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `fech_crea` datetime DEFAULT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


INSERT INTO `tm_dependencias` (`cat_id`, `cat_nom`, `fech_crea`, `est`) VALUES
(1, 'Facultad de Ciencias Administrativas, Gestión Empresarial e Informática', '2023-04-26 20:27:52', 1),
(2, 'Facultad de Jurisprudencia, Ciencias Sociales y Políticas', '2023-04-26 20:27:52', 1),
(3, 'Facultad de Ciencias de la Educación, Sociales, Filosóficas y Humanísticas', '2023-04-26 20:27:52', 1),
(4, 'Facultad de Ciencias Agropecuarias, Recursos Naturales y del Medio Ambiente', '2023-04-26 20:27:52', 1),
(5, 'Facultad de Ciencias de la Salud y del Ser Humano', '2023-08-17 20:46:37', 0);

CREATE TABLE `tm_evento` (
  `even_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `portada_img` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cur_nom` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `cur_descrip` varchar(1000) COLLATE utf8_spanish_ci NOT NULL,
  `cur_fechini` date DEFAULT NULL,
  `cur_fechfin` date DEFAULT NULL,
  `nhours` int(11) NOT NULL,
  `modality_id` int(11) NOT NULL,
  `eventype_id` int(11) NOT NULL,
  `cur_img` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fech_crea` datetime DEFAULT NULL,
  `est` int(11) NOT NULL,
  `est_asistencia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
CREATE TABLE `event_type` (
  `eventype_id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
ALTER TABLE `event_type`
ADD PRIMARY KEY (`eventype_id`);
ALTER TABLE `event_type`
  MODIFY `eventype_id` int(11) NOT NULL AUTO_INCREMENT;
  INSERT INTO `event_type` (
  `eventype_id`,
  `name`,
  `est`
)VALUES(1,"Congreso",1),(2,"Curso",1),(3,"Capacitación",1);
CREATE TABLE `modality` (
  `modality_id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


ALTER TABLE `modality`
ADD PRIMARY KEY (`modality_id`);
ALTER TABLE `modality`
  MODIFY `modality_id` int(11) NOT NULL AUTO_INCREMENT;
INSERT INTO `modality` (
  `modality_id`,
  `name`,
  `est`
)VALUES(1,"PRESENCIAL",1),(2,"VIRTUAL",1),(3,"HIBRIDA",1);
ALTER TABLE `tm_evento` ADD CONSTRAINT `fk_event_type`
FOREIGN KEY (`eventype_id`)
REFERENCES `event_type`(`eventype_id`);

INSERT INTO `tm_evento` (`even_id`, `cat_id`, `cur_nom`, `cur_descrip`, `cur_fechini`, `cur_fechfin`, `cur_img`, `fech_crea`, `modality_id`, `nhours`, `portada_img`, `eventype_id`,`est`, `est_asistencia`) VALUES
(1, 1, 'CURSO DE HTML5', 'Occaecat Lorem velit qui magna dolore culpa qui. Aliqua nostrud nisi cillum sunt consequat irure commodo qui reprehenderit in in quis. Esse pariatur amet esse sint tempor fugiat laborum consectetur exercitation anim in voluptate sunt est. Sint amet elit et id qui nisi qui. Incididunt et pariatur nostrud do dolore duis consequat non eu velit labore.', '2023-04-01', '2023-04-30', '../../public/2.png', '2023-04-26 20:32:32','2','50', '../../public/1616601522.png',1, 1,0),
(3, 2, 'PHP', 'Laborum consequat laboris incididunt ipsum ea irure enim consectetur. Mollit non in ex ut culpa elit commodo id nostrud magna voluptate amet. Aute duis ea duis nulla. Ad ipsum id reprehenderit fugiat do commodo excepteur labore ex. Tempor ex consectetur proident anim minim id ex laboris elit. Laborum do aliquip duis veniam tempor esse nisi eiusmod id elit tempor.', '2023-04-01', '2023-04-30',  '../../public/3.png', '2023-04-26 20:32:32','3','85', '../../public/1616601522.png',1, 1,0),
(4, 1, 'LARAVEL y MYSQL', 'Aliqua magna eu minim irure aliqua esse esse irure irure cupidatat ex magna. Laborum pariatur velit adipisicing nisi id ex esse nisi mollit magna nostrud quis minim. Aliquip excepteur pariatur duis qui irure mollit in deserunt velit est excepteur enim reprehenderit excepteur.', '2023-04-01', '2023-04-30',  '../../public/4.png', '2023-04-26 20:32:32','1','120', '../../public/1616601522.png', 1,1,0),
(5, 2, 'IV Congreso Académico Internacional (CAI IV – 2023 ) y III Congreso Internacional de Posgrado y Educación Continua (CIPEC III, 2023)', 'La Universidad Estatal de Bolívar en este año tiene el honor de planificar y presentar el IV Congreso Académico Internacional (CAI IV – 2023 ) y III Congreso Internacional de Posgrado y Educación Continua (CIPEC III, 2023), como un espacio reflexión, intercambio de experiencias y divulgación de trabajos de investigación científica y académica en los campos de la “Transformación digital e interculturalidad en la educación superior: Retos y oportunidades para la inclusión y el desarrollo regional".En este año el congreso se realizará en un formato hibrido (Presencial / Virtual) que pretende promover la investigación y difusión de los avances científicos en el área educativa, renovar y construir propuestas pedagógicas que contribuyan a seguir generando mejoras en los procesos de formación. ', '2023-10-25', '2023-10-27', '../../public/1616601522.png', '2023-10-20 20:32:32','1','85', '../../public/1616601522.png', 1,1,1),
(6, 1, 'ESTUDIO DE MERCADO', 'CURSO de MERCADO', '2023-08-22', '2023-09-22', '../../public/28629721.png', '2023-08-22 14:54:50',1,55, '../../public/1616601522.png', 1,1,1);

CREATE TABLE `tm_instructor` (
  `inst_id` int(11) NOT NULL,
  `inst_nom` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `inst_apep` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `inst_apem` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `inst_correo` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `inst_sex` varchar(1) COLLATE utf8_spanish_ci NOT NULL,
  `inst_telf` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `fech_crea` datetime DEFAULT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


INSERT INTO `tm_instructor` (`inst_id`, `inst_nom`, `inst_apep`, `inst_apem`, `inst_correo`, `inst_sex`, `inst_telf`, `fech_crea`, `est`) VALUES
(1, 'RICARDO', 'PALMA', 'PALMA', 'RPALMA@TEST.COM.PE', 'M', '5555555', '2023-04-26 20:24:06', 1),
(2, 'CESAR', 'VALLEJO', 'MEDRANO', 'CVALLEJO@MEDRANO.COM.PE', 'M', '5555555', '2023-04-26 20:24:06', 1),
(3, 'asda', 'asd', 'asd', 'test@test.com', 'M', '111111', '2023-08-17 21:27:40', 0),
(4, 'ddd', 'dd', 'ddd', 'test@test.com', 'M', '111111', '2023-08-17 21:31:26', 0),
(5, 'www', 'www', 'www', 'test@test.com', 'F', '111111', '2023-08-17 21:31:32', 0),
(6, 'aaaa', 'aaa', 'aaaa', 'aaaa@www.com', 'F', '123123123123', '2023-08-17 21:32:55', 0);

CREATE TABLE `academic_level` (
  `aclevel_id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `abreviature` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
ALTER TABLE academic_level
ADD PRIMARY KEY (aclevel_id);
ALTER TABLE `academic_level`
  MODIFY `aclevel_id` int(11) NOT NULL AUTO_INCREMENT;
INSERT INTO `academic_level` (
  `aclevel_id` ,
  `name`,
  `abreviature`,
  `est`
)VALUES(1,"Pregrado","Est.","1"),(2,"Maestria","MsC.","1"),(3,"Doctorado","PhD.","1");
CREATE TABLE `tm_usuario` (
  `usu_id` int(11) NOT NULL,
  `usu_nom` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `usu_apep` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `usu_apem` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `usu_correo` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `usu_pass` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `usu_sex` varchar(1) COLLATE utf8_spanish_ci NOT NULL,
  `usu_telf` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `rol_id` int(11) NOT NULL,
  `usu_ci` varchar(10) DEFAULT NULL,
  `fech_crea` datetime DEFAULT NULL,
  `est` int(11) NOT NULL,
  `aclevel_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

ALTER TABLE `tm_usuario` ADD CONSTRAINT `fk_academic_level`
FOREIGN KEY (`aclevel_id`)
REFERENCES `academic_level`(`aclevel_id`);

INSERT INTO `tm_usuario` (`usu_id`, `usu_nom`, `usu_apep`, `usu_apem`, `usu_correo`, `usu_pass`, `usu_sex`, `usu_telf`, `rol_id`, `usu_ci`, `fech_crea`, `est`, `aclevel_id`) VALUES
(1, "Alexander Paul", "Luna", "Arteaga", "aluna@mailes.ueb.edu.ec", "12345", "M", "0985726434", 2, "0202433918", "2023-04-26 20:14:08", 1,1),
(2, "Wilson Efrain", "Paredes", "Guano", "wiparedes@mailes.ueb.edu.ec", "12345", "M", "0985726434",2, "0202433912", "2023-04-26 20:14:08", 1,1),
(3, "USU5", "USU5", "USU5", "user@mailes.ueb.edu.ec", "12345", "F", "0985726439", 1, "0202433911", "2023-04-26 20:14:08", 1,1);

ALTER TABLE `td_evento_usuario`
  ADD PRIMARY KEY (`curd_id`);

ALTER TABLE `tm_dependencias`
  ADD PRIMARY KEY (`cat_id`);

ALTER TABLE `tm_evento`
  ADD PRIMARY KEY (`even_id`);

ALTER TABLE `tm_instructor`
  ADD PRIMARY KEY (`inst_id`);

ALTER TABLE `tm_usuario`
  ADD PRIMARY KEY (`usu_id`);

ALTER TABLE `td_evento_usuario`
  MODIFY `curd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

ALTER TABLE `tm_dependencias`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `tm_evento`
  MODIFY `even_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

ALTER TABLE `tm_instructor`
  MODIFY `inst_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
ALTER TABLE `tm_usuario`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
ALTER TABLE `td_evento_usuario_dias` ADD CONSTRAINT `fk_asistencia`
FOREIGN KEY (`curd_id`)
REFERENCES `td_evento_usuario`(`curd_id`);
COMMIT;
