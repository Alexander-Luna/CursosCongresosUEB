
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `td_curso_usuario` (
  `curd_id` int(11) NOT NULL,
  `cur_id` int(11) NOT NULL,
  `usu_id` int(11) NOT NULL,
  `fech_crea` datetime NOT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



INSERT INTO `td_curso_usuario` (`curd_id`, `cur_id`, `usu_id`, `fech_crea`, `est`) VALUES
(191, 1, 1, '2023-10-17 23:11:34', 1),
(192, 1, 2, '2023-10-17 23:11:34', 1),
(193, 1, 3, '2023-10-17 23:11:34', 1),
(194, 1, 4, '2023-10-17 23:11:34', 1),
(195, 2, 4, '2023-10-17 23:16:50', 1),
(196, 3, 4, '2023-10-17 23:16:56', 1);


CREATE TABLE `tm_facultades` (
  `cat_id` int(11) NOT NULL,
  `cat_nom` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `fech_crea` datetime DEFAULT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


INSERT INTO `tm_facultades` (`cat_id`, `cat_nom`, `fech_crea`, `est`) VALUES
(1, 'Facultad de Ciencias Administrativas, Gestión Empresarial e Informática', '2023-04-26 20:27:52', 1),
(2, 'Facultad de Jurisprudencia, Ciencias Sociales y Políticas', '2023-04-26 20:27:52', 1),
(3, 'Facultad de Ciencias de la Educación, Sociales, Filosóficas y Humanísticas', '2023-04-26 20:27:52', 1),
(4, 'Facultad de Ciencias Agropecuarias, Recursos Naturales y del Medio Ambiente', '2023-04-26 20:27:52', 1),
(5, 'Facultad de Ciencias de la Salud y del Ser Humano', '2023-08-17 20:46:37', 0);

CREATE TABLE `tm_curso` (
  `cur_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `cur_nom` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `cur_descrip` varchar(1000) COLLATE utf8_spanish_ci NOT NULL,
  `cur_fechini` date DEFAULT NULL,
  `cur_fechfin` date DEFAULT NULL,
  `inst_id` int(11) NOT NULL,
  `cur_img` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fech_crea` datetime DEFAULT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


INSERT INTO `tm_curso` (`cur_id`, `cat_id`, `cur_nom`, `cur_descrip`, `cur_fechini`, `cur_fechfin`, `inst_id`, `cur_img`, `fech_crea`, `est`) VALUES
(1, 1, 'CURSO DE HTML5', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-04-01', '2023-04-30', 1, '../../public/1.png', '2023-04-26 20:32:32', 1),
(2, 2, 'INTRODUCCION DE LOS NEGOCIOS', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-04-01', '2023-04-30', 2, '../../public/2.png', '2023-04-26 20:32:32', 1),
(3, 2, 'PHP', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-04-01', '2023-04-30', 2, '../../public/3.png', '2023-04-26 20:32:32', 1),
(19, 1, 'LARAVEL y MYSQL', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-04-01', '2023-04-30', 1, '../../public/4.png', '2023-04-26 20:32:32', 1),
(20, 2, 'CURSO3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-04-01', '2023-04-30', 2, '../../public/1.png', '2023-04-26 20:32:32', 1),
(21, 2, 'CURSO4', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-04-01', '2023-04-30', 2, '../../public/1.png', '2023-04-26 20:32:32', 1),
(22, 2, 'CURSO5', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-04-01', '2023-04-30', 2, '../../public/1613003806.png', '2023-04-26 20:32:32', 1),
(23, 2, 'CURSO6', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-04-01', '2023-04-30', 2, '../../public/957232075.png', '2023-04-26 20:32:32', 1),
(24, 2, 'CURSO7', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-04-01', '2023-04-30', 2, '../../public/1127664046.png', '2023-04-26 20:32:32', 1),
(25, 1, 'ESTUDIO DE MERCADO', 'CURSO de MERCADO', '2023-08-22', '2023-09-22', 1, '../../public/28629721.png', '2023-08-22 14:54:50', 1);

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
  `abreviature` varchar(150) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
ALTER TABLE academic_level
ADD PRIMARY KEY (aclevel_id);
INSERT INTO `academic_level` (
  `aclevel_id` ,
  `name`,
  `abreviature`
)VALUES(1,"Pregrado","Est."),(2,"Maestria","MsC."),(3,"Doctorado","PhD.");
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
ALTER TABLE `academic_level`
  MODIFY `aclevel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;
INSERT INTO `tm_usuario` (`usu_id`, `usu_nom`, `usu_apep`, `usu_apem`, `usu_correo`, `usu_pass`, `usu_sex`, `usu_telf`, `rol_id`, `usu_ci`, `fech_crea`, `est`, `aclevel_id`) VALUES
(1, "Alexander Paul", "Luna", "Arteaga", "aluna@mailes.ueb.edu.ec", "12345", "M", "0985726434", 2, "0202433918", "2023-04-26 20:14:08", 1,1),
(2, "Wilson Efrain", "Paredes", "Guano", "wiparedes@mailes.ueb.edu.ec", "12345", "M", "0985726434",2, "0202433912", "2023-04-26 20:14:08", 1,1),
(3, "USU5", "USU5", "USU5", "user@mailes.ueb.edu.ec", "12345", "F", "0985726439", 1, "0202433911", "2023-04-26 20:14:08", 1,1);

ALTER TABLE `td_curso_usuario`
  ADD PRIMARY KEY (`curd_id`);

ALTER TABLE `tm_facultades`
  ADD PRIMARY KEY (`cat_id`);

ALTER TABLE `tm_curso`
  ADD PRIMARY KEY (`cur_id`);

ALTER TABLE `tm_instructor`
  ADD PRIMARY KEY (`inst_id`);

ALTER TABLE `tm_usuario`
  ADD PRIMARY KEY (`usu_id`);

ALTER TABLE `td_curso_usuario`
  MODIFY `curd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

ALTER TABLE `tm_facultades`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `tm_curso`
  MODIFY `cur_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

ALTER TABLE `tm_instructor`
  MODIFY `inst_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
ALTER TABLE `tm_usuario`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;
