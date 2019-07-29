-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-07-2019 a las 19:56:48
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdarchivo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbladmin`
--

CREATE TABLE `tbladmin` (
  `id_admin` int(11) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `ndni` varchar(15) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbladmin`
--

INSERT INTO `tbladmin` (`id_admin`, `usuario`, `ndni`, `password`) VALUES
(1, 'master', '74241735', '$2y$10$db244xtf.OXTmENAVVm43O9EZzZ9qBPn.BhKep/ZW2sufcfRsAiD6'),
(2, 'LHOYOS', '40995221', '$2y$10$TNEAld9En1KvoT/rvEzchOj0PtFUppgkmKKq8KBC8MEcG2kpffKGm');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblarea`
--

CREATE TABLE `tblarea` (
  `id_area` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tblarea`
--

INSERT INTO `tblarea` (`id_area`, `nombre`) VALUES
(1, 'PERSONAL-PROYECTOS-WAMS'),
(2, 'ADMINISTRACIÃ“N'),
(3, 'PERSONAL-NEXUS'),
(4, 'PROCESO ADMINISTRATIVO'),
(5, 'PERSONAL PROYECTOS-MRR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcontrol`
--

CREATE TABLE `tblcontrol` (
  `id_control` int(11) NOT NULL,
  `id_personal` int(11) NOT NULL,
  `id_area` int(11) NOT NULL,
  `nfolios` varchar(5) NOT NULL,
  `f_entrega` date DEFAULT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblmotivo`
--

CREATE TABLE `tblmotivo` (
  `id_motivo` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tblmotivo`
--

INSERT INTO `tblmotivo` (`id_motivo`, `descripcion`) VALUES
(1, 'CONCEDER LICENCIA CON GOCE DE REMUNERACIONES'),
(2, 'RECONOCER EL PAGO POR TIEMPO DE SERVICIO- CTS'),
(3, 'ENCARGAR FUNCIONES DE DIRECTOR'),
(4, 'RECTIFICAR LA RD NÂ° 3166-2019'),
(5, 'OTORGAR SUBSIDIO POR LUTO Y SEPELIO'),
(6, 'RECONOCER EL PAGO POR SERVICIOS PERSONALES'),
(7, 'CONCEDER LICENCIA SIN GOCE DE REMUNERACIONES'),
(8, 'DESIGNAR FEDATARIOS DE LA UGEL CAJAMARCA'),
(9, 'RECONOCER Y APROBAR DEUDA TOTAL EN ATENCIÃ“N A MANDATO JUDICIAL'),
(10, 'APROBAR CONTRATO'),
(11, 'RECONOCER Y FELICITAR POR HABER CUMPLIDO 25 AÃ‘OS DE SERVICIO'),
(12, 'RECONOCER Y FELICITAR POR HABER CUMPLIDO 30 AÃ‘OS DE SERVICIO'),
(13, 'DECLARAR IMPROCEDENTE AL RECURSO ADMINISTRATIVO DE RECONSIDERACIÃ“N'),
(14, 'RECONOCER EL PAGO EN PLANILLA CONTINUA EN ATENCIÃ“N A MANDATO JUDICIAL'),
(15, 'RECONOCER 02 HORAS ADICIONALES'),
(16, 'DESIGNAR COORDINADORES PEDAGÃ“GICOS Y TUTORIA DE LA IIEE-JEC  IE JESUS DE NAZARET'),
(17, 'CUMPLIR CON LO ORDENADO EN LA RDR NÂ° 1936-2019'),
(18, 'APROBAR EL INCREMENTO DEL 25 POR CIENTO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblpersonal`
--

CREATE TABLE `tblpersonal` (
  `id_personal` int(11) NOT NULL,
  `nombres` varchar(30) NOT NULL,
  `apellidos` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblresolucion`
--

CREATE TABLE `tblresolucion` (
  `id_resolucion` int(11) NOT NULL,
  `id_motivo` int(11) NOT NULL,
  `id_area` int(11) NOT NULL,
  `nresolucion` varchar(5) NOT NULL,
  `nproyecto` varchar(5) NOT NULL,
  `f_emision` date DEFAULT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tblresolucion`
--

INSERT INTO `tblresolucion` (`id_resolucion`, `id_motivo`, `id_area`, `nresolucion`, `nproyecto`, `f_emision`, `estado`) VALUES
(1, 1, 1, '4506', '5337', '2019-06-24', 1),
(2, 1, 1, '4507', '5336', '2019-06-24', 1),
(3, 2, 1, '4508', '0842', '2019-06-24', 1),
(4, 3, 1, '4796', '5682', '2019-07-05', 1),
(5, 4, 2, '4795', '4830', '2019-07-05', 1),
(6, 5, 1, '4794', '0891', '2019-07-05', 1),
(7, 2, 1, '4793', '0644', '2019-07-05', 1),
(8, 5, 1, '4792', '0791', '2019-07-05', 1),
(9, 2, 1, '4791', '0808', '2019-07-05', 1),
(10, 7, 1, '4790', '5467', '2019-07-05', 1),
(11, 8, 1, '4789', '0888', '2019-07-05', 1),
(12, 9, 1, '47882', '0831', '2019-02-05', 1),
(13, 10, 3, '4787', '3674', '2019-07-05', 1),
(14, 10, 3, '4786', '3673', '2019-07-05', 1),
(15, 10, 3, '4785', '3672', '2019-07-05', 1),
(16, 10, 3, '4784', '3671', '2019-07-05', 1),
(17, 10, 3, '4733', '3670', '2019-07-05', 1),
(18, 10, 3, '4782', '3669', '2019-07-05', 1),
(19, 10, 3, '4781', '3668', '2019-07-05', 1),
(20, 10, 3, '4780', '3667', '2019-07-05', 1),
(21, 1, 3, '4779', '3666', '2019-07-05', 1),
(22, 10, 3, '4778', '3665', '2019-07-05', 1),
(23, 10, 3, '4777', '3664', '2019-07-05', 1),
(24, 10, 3, '4776', '3663', '2019-07-05', 1),
(25, 10, 3, '4775', '3662', '2019-07-05', 1),
(26, 10, 3, '4774', '3661', '2019-07-05', 1),
(27, 10, 3, '4797', '3679', '2019-07-05', 1),
(28, 10, 3, '4798', '3677', '2019-07-08', 1),
(29, 11, 1, '4799', '5550', '2019-07-08', 1),
(30, 5, 1, '4800', '0777', '2019-07-08', 1),
(31, 5, 1, '4801', '0781', '2019-07-08', 1),
(32, 12, 1, '4802', '5551', '2019-07-08', 1),
(33, 13, 4, '4804', '4919', '2019-07-08', 1),
(34, 12, 1, '4805', '5549', '2019-07-08', 1),
(35, 12, 1, '4806', '5548', '2019-07-08', 1),
(36, 12, 1, '4807', '5547', '2019-07-08', 1),
(37, 12, 1, '4808', '5544', '2019-07-08', 1),
(38, 11, 1, '4809', '5543', '2019-07-08', 1),
(39, 12, 1, '4810', '5545', '2019-07-08', 1),
(40, 12, 1, '4811', '5546', '2019-07-08', 1),
(41, 14, 1, '4812', '0849', '2019-07-08', 1),
(42, 15, 1, '4813', '0845', '2019-07-08', 1),
(43, 15, 1, '4813', '0845', '2019-07-08', 1),
(44, 14, 1, '4814', '0847', '2019-07-08', 1),
(45, 2, 1, '4815', '0844', '2019-07-08', 1),
(46, 10, 1, '4816', '3678', '2019-07-08', 1),
(47, 10, 1, '4817', '3493', '2019-07-08', 1),
(48, 16, 1, '4803', '0948', '2019-07-08', 1),
(49, 10, 3, '4773', '3658', '2019-07-05', 1),
(50, 10, 3, '4772', '3494', '2019-07-05', 1),
(51, 10, 3, '4771', '3492', '2019-07-05', 1),
(52, 10, 3, '4770', '3491', '2019-07-05', 1),
(53, 10, 3, '4769', '3784', '2019-07-05', 1),
(54, 10, 3, '4768', '3483', '2019-07-05', 1),
(55, 10, 3, '4767', '3482', '2019-07-05', 1),
(56, 6, 1, '4766', '0915', '2019-07-05', 1),
(57, 6, 1, '4765', '0909', '2019-07-05', 1),
(58, 6, 1, '4764', '0855', '2019-07-05', 1),
(59, 6, 1, '4763', '0853', '2019-07-05', 1),
(60, 6, 1, '4762', '0850', '2019-07-05', 1),
(61, 10, 3, '4761', '3657', '2019-07-05', 1),
(62, 10, 3, '4760', '3495', '2019-07-05', 1),
(63, 10, 3, '4759', '3676', '2019-07-05', 1),
(64, 12, 1, '4758', '5541', '2019-07-05', 1),
(65, 11, 1, '4757', '5542', '2019-07-05', 1),
(66, 10, 3, '4756', '3675', '2019-07-05', 1),
(67, 17, 1, '4755', '5540', '2019-07-05', 1),
(68, 12, 1, '4754', '5537', '2019-07-05', 1),
(69, 6, 1, '4753', '0856', '2019-07-05', 1),
(70, 18, 1, '4742', '0954', '2019-07-04', 1),
(71, 10, 3, '4838', '3500', '2019-07-10', 1),
(72, 9, 1, '4837', '0824', '2019-07-10', 1),
(73, 9, 1, '4836', '0823', '2019-07-10', 1),
(74, 5, 1, '4835', '0866', '2019-07-10', 1),
(75, 5, 1, '4834', '0867', '2019-07-10', 1),
(76, 5, 1, '4833', '0868', '2019-07-10', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblusuarios`
--

CREATE TABLE `tblusuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombres` varchar(30) NOT NULL,
  `apellidos` varchar(70) NOT NULL,
  `ndni` varchar(8) NOT NULL,
  `carnet` varchar(15) NOT NULL,
  `contacto` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tblusuarios`
--

INSERT INTO `tblusuarios` (`id_usuario`, `nombres`, `apellidos`, `ndni`, `carnet`, `contacto`) VALUES
(1, 'JUDITH OCTAVIA', 'MEJIA DE FLORES', '', '', ''),
(2, 'ELSA DORALIZA', 'YSQUIERDO ESPINOZA', '', '', ''),
(3, 'PABLO RAUL', 'ALARCON COBEÃ‘AS', '16761256', '', ''),
(4, 'LUIS ANTONIO', 'DANZ SALDAÃ‘A', '45272260', '', ''),
(5, 'GINO DAGOBERTO', 'ALBITES BAZAN', '41905778', '', ''),
(6, 'HAYDEE TERESA', 'ALMIRON FLORES', '00430976', '', ''),
(7, 'NORMA CORINA', 'ALVAREZ MENDOZA', '26696519', '', ''),
(8, 'CARMEN ROSA', 'ALVITES LOPEZ DE VARGAS', '45580632', '', ''),
(9, 'EVELI BETTY', 'ALZA JAICO', '42215644', '', ''),
(10, 'MIRIAN ROSA', 'ANGULO DE SAENZ', '26672506', '', ''),
(11, 'MIRIAN LILIBETH', 'AREVALO PASCUAL', '43564973', '', ''),
(12, 'NELLY EUGENI', 'AZAÃ‘ERO CARMONA', '44349990', '', ''),
(13, 'MARIA DEL ROSARIO', 'BAZAN DIAZ', '44289800', '', ''),
(14, 'MIRIAM', 'BAZAN MONTOYA', '40956758', '', ''),
(15, 'BERNABE', 'BECERRA CABANILLAS', '40827854', '', ''),
(16, 'AZUCENA ELIZABETH', 'BECERRA VASQUEZ', '28073677', '', ''),
(17, 'FANNY MILAGRITOS', 'BRAVO CHAVEZ', '26722861', '', ''),
(18, 'ALEJANDRO', 'BRINGAS CASAS', '26735258', '', ''),
(19, 'MARIA ELIZABETH', 'BRIONES CHAVEZ', '43307051', '', ''),
(20, 'YOLANDA', 'BRIONES VALENCIA', '44003252', '', ''),
(21, 'LILIANA MARILU', 'CABANILLAS GARAMENDI', '45460939', '', ''),
(22, 'JAIME', 'CABANILLAS MEDINA', '42394016', '', ''),
(23, 'DALY GEANNINA', 'CABELLOS MENDOZA', '46941925', '', ''),
(24, 'HUMBERTO', 'CABRERA SALCEDO', '26717497', '', ''),
(25, 'GLADIS EDIN', 'CANTERA RIOS', '26703772', '', ''),
(26, 'NANCY VIOLETA', 'CARRANZA CAMACHO', '42319163', '', ''),
(27, 'SARA', 'CASTREJON VALDEZ', '26731822', '', ''),
(28, 'IRMA IRIS', 'CHOLAN CUSQUISIBAN', '44878884', '', ''),
(29, 'JOE KEN', 'AREVALO VILLAVICENCIO', '26710903', '', ''),
(30, 'FLOR ESTHER', 'CHUNQUE CERQUIN', '41709119', '', ''),
(31, 'DENISSE', 'CHUQUILIN MARQUINA DE TORRES', '41785469', '', ''),
(32, 'HERMAN VITELMO', 'CORREA SANCHEZ', '26717609', '', ''),
(33, 'YOVANA', 'CRUZADO ESPILCO', '42808730', '', ''),
(34, 'LILA JANETH', 'CUSQUISIBAN YOPLA', '46161133', '', ''),
(35, 'MANUEL ALEJANDRO', 'CUSTODIO BENZUNCE', '26703149', '', ''),
(36, 'ELIZABETH DEL ROCIO', 'DE LA CRUZ CHAVEZ', '41103910', '', ''),
(37, 'NANCY MARLENI', 'FERNANDEZ MORI', '26686072', '', ''),
(38, 'ROXANA DEL ROCIO', 'FERNANDEZ RUIZ', '71133207', '', ''),
(39, 'MARIA CONSUELO', 'FLORES MEJIA', '43025057', '', ''),
(40, 'JOSE SMITH', 'FLORES SAAVEDRA', '41785470', '', ''),
(41, 'ALBERTO RICARDO', 'GALVEZ MUÃ‘OZ', '80626681', '', ''),
(42, 'SEGUNDO AGUSTIN', 'GARCIA MONTOYA', '26704831', '', ''),
(43, 'YESSENIA MARIA', 'GARRAMPIE MENDOZA', '45923295', '', ''),
(44, 'EDGAR ANDRES', 'GONZALO GALLARDO', '26696749', '', ''),
(45, 'FRANCISCO WILFREDO', 'GONZALES GALLARDO', '26688834', '', ''),
(46, 'DARLY', 'GONZALES ROJAS', '40554620', '', ''),
(47, 'ELSA BEATRIZ', 'GRANADOS NOVOA', '26722751', '', ''),
(48, 'NORMA ELIZABETH', 'HERNANDEZ URTEAGA', '40116477', '', ''),
(49, 'LUIS', 'HUACCHA REYES', '41831105', '', ''),
(50, 'PEDRO FLORENTINO', 'HUAMAN ARANDA', '26698870', '', ''),
(51, 'KARINA MARILYN', 'HUARIPATA MENDOZA', '44377722', '', ''),
(52, 'YUDITH', 'HUARIPATA LLANOS', '46071717', '', ''),
(53, 'ROSA ISABEL', 'IZQUIERDO CASTREJON', '40670915', '', ''),
(54, 'MARIA SANTOS', 'JULCA SANCHEZ DE MORERA', '26604041', '', ''),
(55, 'ANA MARIBEL', 'JULCAHUANCA GALVEZ', '45210218', '', ''),
(56, 'MARIA VIOLETA', 'LEON RODRIGUEZ', '26646076', '', ''),
(57, 'WALTER ANIBAL', 'LEON URTEAGA', '26705869', '', ''),
(58, 'FLOR MRGARITA', 'LIMAY SALAZAR', '26714562', '', ''),
(59, 'ROSA', 'LUCANO BUENO', '26644475', '', ''),
(60, 'LILIAM JACQUELINE', 'MALAVER RUITON', '41614501', '', ''),
(61, 'ZOILA ELICIRA', 'MEDINA LOZADA', '27161008', '', ''),
(62, 'NANCY', 'MENDOZA BUGARIN', '44639175', '', ''),
(63, 'ROSA ELENA', 'MENDOZA DE ORRILLO', '27546438', '', ''),
(64, 'JOHANA ELIZABETH', 'MONTENEGRO SALDAÃ‘A', '41236643', '', ''),
(65, 'JESUS IRIS', 'MORI CHAVEZ', '26682734', '', ''),
(66, 'SEGUNDO ERNESTO', 'NAUCA VASQUEZ', '27574909', '', ''),
(67, 'CESAR ELADIO', 'PAICO SANCHEZ', '45215402', '', ''),
(68, 'MARIA ANGELA HORMECINDA', 'ORTIZ ZEGARRA', '26715649', '', ''),
(69, 'ROSA CARMEN', 'PALOMINO QUIROZ', '40241087', '', ''),
(70, 'SONIA ALEJANDRINA', 'PAREDES HERNANDEZ', '19258817', '', ''),
(71, 'PEDRO', 'PISCO GODOY', '43141242', '', ''),
(72, 'DAVID', 'PISCO VEGA', '41173334', '', ''),
(73, 'CORINA', 'PORTILLA DELGADO', '40083389', '', ''),
(74, 'RICHAR HELI', 'QUIROZ ROMERO', '27993736', '', ''),
(75, 'MARGARITA', 'RAICO AZAÃ‘ERO', '26655810', '', ''),
(76, 'ROSITA', 'RAICO HUARIPATA', '26702461', '', ''),
(77, 'FATIMA', 'RAMOS CORREA', '42202325', '', ''),
(78, 'RUTH NOEMI', 'RAMOS CORREA', '42980864', '', ''),
(79, 'TADEO', 'RODRIGUEZ BRIONES', '44113926', '', ''),
(80, 'SAYDA VERONICA', 'RODRIGUEZ CAMACHO', '40945988', '', ''),
(81, 'EVA MARGOT', 'RODRIGUEZ HUANGAL', '42106842', '', ''),
(82, 'EDITA', 'RODRIGUEZ MACHUCA', '26709584', '', ''),
(83, 'CLARA NINFA', 'SALAZAR GRANDA', '40353066', '', ''),
(84, 'VICENTINA', 'SANCHEZ CONDORI', '26731490', '', ''),
(85, 'KARINA EDITH', 'SANCHEZ DIAZ', '42190238', '', ''),
(86, 'LUIS ALBERTO', 'SANCHEZ GUTIERREZ', '26722246', '', ''),
(87, 'LIDIA LUZ', 'SANCHEZ MEJIA', '27049648', '', ''),
(88, 'ROSA', 'SAUCEDO CABRERA', '26617987', '', ''),
(89, 'FANNY LUZ', 'SIFUENTES PEREZ', '40751814', '', ''),
(90, 'ORLANDO', 'TACILLA VILLANUEVA', '26729372', '', '926479543'),
(91, 'VLADIMIR ALEJANDRO', 'TELLO CHUMACERO', '26718133', '', ''),
(92, 'PASCUALA ELIZABETH', 'TELLO PEREZ', '43176791', '', ''),
(93, 'JAVIER', 'TERRONES CERDAN', '42589304', '', ''),
(94, 'PETER', 'TERRONES GUTIERREZ', '26696250', '', ''),
(95, 'GABRIEL', 'TERRONES VILELA', '26729227', '', ''),
(96, 'IRMA', 'TIRADO CAMPOS', '41353042', '', ''),
(97, 'FERNANDO DAVID', 'TORRES SAENZ', '42993718', '', ''),
(98, 'FLOR LILIANA', 'UCEDA JARA', '26644796', '', ''),
(99, 'RICHARD HOMERO', 'VALERA RODAS', '40028478', '', ''),
(100, 'NELLY', 'VARGAS CABRERA', '80486342', '', ''),
(101, 'PENELOPE DE MILAGROS', 'VARGAS LLANOS', '40355299', '', ''),
(102, 'ERIKA JUDITH', 'VASQUEZ ARELLANO', '44799711', '', ''),
(103, 'NANCY MARIBEL', 'VASQUEZ VILLANUEVA', '26685965', '', ''),
(104, 'FANNY ANITA', 'VELEZMORO TIRADO', '41837945', '', ''),
(105, 'LUZ ELENA', 'VIGO BRICEÃ‘O', '26646394', '', ''),
(106, 'SHIRLEY NOEMI', 'VIGO HUAMAN', '44456502', '', ''),
(107, 'NANCY IRIS', 'VILCHEZ SANCHEZ', '41084178', '', ''),
(108, 'ALAN CARLOS', 'VILLATY PINEDO', '42614176', '', ''),
(109, 'JAQUELIN ROSABEL', 'COJAL CEPEDA', '', '', ''),
(110, 'BLANCA ISABEL', 'GUEVARA CHUQUILIN', '', '', ''),
(111, 'LUIS ALBERTO', 'COLORADO RAMIREZ', '', '', ''),
(112, 'ROCÃO DEL PILAR', 'BANDA LIMAY', '', '', ''),
(113, 'JOSE ANCELMO', 'BAZAN VASQUEZ', '', '', ''),
(114, 'WILDER', 'ALVARADO GUEVARA', '', '', ''),
(115, 'GLORIA', 'MARIN LIMAY', '', '', ''),
(116, 'RAUL', 'VASQUEZ TORRES', '', '', ''),
(117, 'ROSA', 'CHAFLOQUE VARGAS', '', '', ''),
(118, 'JAIRO', 'PEREZ ZAMORA', '', '', ''),
(119, 'FLOR MARGARITA', 'TACILLA HUARIPATA', '', '', ''),
(120, 'PEDRO HENRY', 'PEREDA QUIROZ', '', '', ''),
(121, 'DEISY YOBANA', 'LOBATO QUISPE', '', '', ''),
(122, 'SINDIA BEATRIZ', 'TEJADA DE LA CRUZ', '', '', ''),
(123, 'MARIA VANESA', 'CASTREJON MALAVER', '', '', ''),
(124, 'MARCO RAFAEL', 'CUZCO VASQUEZ', '', '', ''),
(125, 'KAREN FIORELA', 'QUIROZ DURAN', '', '', ''),
(126, 'KARLA NATALY', 'BRIONES SALDAÃ‘A', '', '', ''),
(127, 'JHONY ANDERSON', 'VASQUEZ ARTEAGA', '', '', ''),
(128, 'LIZBETH', 'MIRES CAMPOS', '', '', ''),
(129, 'DUANY MARCELA', 'MARTOS TEJADA', '', '', ''),
(130, 'WALTER OMAR', 'CHANDUCAS CERNA', '42092187', '', ''),
(131, 'JHANET MARISOL', 'BAUTISTA CHAVEZ', '44207878', '', ''),
(132, 'KELLY MEDALY', 'CARRANZA CASTRO', '43703526', '', '920825733'),
(133, 'MONICA ELIZABETH', 'CABRERA ALVAREZ', '42195525', '', '974812233'),
(134, 'ERICK ALBERTO', 'ROMERO LEZAMA', '45174811', '', ''),
(135, 'MILAGRITOS EMPERATRIZ', 'POSTIJO QUISPE', '70206007', '', ''),
(136, 'JHAMIT YHOBANA', 'MENDOZA BURGARIN', '40450713', '', ''),
(137, 'NORMA PATRICIA', 'MARROQUIN PALACIOS', '26730746', '', '979545009'),
(138, 'SEGUNDO JESUS', 'PAJARES YOPLA', '44619598', '', ''),
(139, 'ROGER ARMANDO', 'RIVERA HUERTA', '42642132', '', ''),
(140, 'MILAGROS SANTOS', 'CORONADO NUÃ‘EZ', '40029790', '', ''),
(141, 'CESAR AUGUSTO', 'HUACCHA AQUINO', '42574691', '', '931034649'),
(142, 'EVER OSCAR', 'CULQUI BARBA', '43487825', '', ''),
(143, 'VICENTE', 'AZAÃ‘ER CARMONA', '', '', ''),
(144, 'VICENTE', 'AZAÃ‘ERO CARMONA', '', '', ''),
(145, 'JOSE SANTOS', 'CARRANZA LEON', '', '', ''),
(146, 'MARGOT ELIZABETH', 'ALCANTARA MESTANZA', '', '', ''),
(147, 'ALAMIRO BENICIO', 'AYAY CORREA', '', '', ''),
(148, 'ROLANDO', 'MINCHAN FERNADEZ', '', '', ''),
(149, 'MARITTA RUBI', 'VELASQUEZ ROJAS', '', '', ''),
(150, 'MARIA ESTHER', 'LOZANO ROJAS DE CACERES', '', '', ''),
(151, 'JAIME', 'SALAZAR SALDAÃ‘A', '', '', ''),
(152, 'PASUCAL', 'RUMAY ALCANTARA', '', '', ''),
(153, 'MARGARITA ELENA', 'CASTILLA FELIX', '', '', ''),
(154, 'SARA MARLENE', 'AGUIRRE LEON', '', '', ''),
(155, 'PENELOPE', 'SANCHEZ DE MARTOS', '', '', ''),
(156, 'NELLO MILDER', 'GUEVARA HERRERA', '', '', ''),
(157, 'ENEDINA', 'ABANTO CHAVEZ', '', '', ''),
(158, 'NILA ELIZABETH', 'MERCADO RONCAL', '', '', ''),
(159, 'CAROL JANET', 'ALVARADO CUBAS', '26684970', '', ''),
(160, 'AMALIA ELIZABETH', 'LOPEZ CHEGNE', '26602113', '', ''),
(161, 'NELLY MANUELA', 'SANCHEZ MARIN', '', '', ''),
(162, 'HERMAN ENRIQUE', 'FERNANDEZ JIMENEZ', '', '', ''),
(163, 'SONIA LILI', 'TORRES DIAZ', '', '', ''),
(164, 'VICTOR', 'DAVILA CUBAS', '', '', ''),
(165, 'FRANCISCO JAVIER', 'BOÃ‘ON CHEGNE', '', '', ''),
(166, 'PLACIDA MARINA', 'MUÃ‘OZ AMCHUCA', '', '', ''),
(167, 'FELIX', 'TELLO VASQUEZ', '', '', ''),
(168, 'EDGAR ROBERTO', 'JARA BARRANTES', '', '', ''),
(169, 'ROGELIA ERESVITA', 'BECERRA SUAREZ', '', '', ''),
(170, 'CARLOS MARTIN', 'CHILON DE LA CRUZ', '', '', ''),
(171, 'BIQUI AIDEE', 'PLASENCIA PLASENCIA', '', '', ''),
(172, 'SEBASTIAN', 'RAMOS LULAYCO', '', '', ''),
(173, 'WILFREDO ENRIQUE', 'MANTILLA TAFUR', '', '', ''),
(174, 'JUAN HELMER', 'DIAZ CUBAS', '', '', ''),
(175, 'ROSA ESTHER', 'GAMARRA DIAZ', '', '', ''),
(176, 'MIGUEL ANGEL', 'RODRIGUEZ CARRION', '', '', ''),
(177, 'MARIA ROSA', 'ARRESTEGUI ALCANTARA', '', '', ''),
(178, 'NELSON', 'TORRES LLANOS', '', '', ''),
(179, 'DORIS RABEL', 'CERNA PALOMINO', '', '', ''),
(180, 'MARLENY HAYDEE', 'BARDALES QUISPE', '', '', ''),
(181, 'VILMA DORIS', 'HERAS TERRONES', '', '', ''),
(182, 'YSABEL DORIS', 'DIAZ ALCANTARA', '', '', ''),
(183, 'IRMA', 'MONTENEGRO QUISPE', '40182014', '', ''),
(184, 'MAGNA DE JESUS', 'PASTOR BECERRA', '40514296', '', ''),
(185, 'GERMAN ELMILO', 'RAMIREZ MALCA', '26612002', '', ''),
(186, 'JUANA FRANCISCA', 'TANTA ESCALANTE', '26695893', '', ''),
(187, 'ANGELICA ANAIS', 'MUÃ‘OZ VILCHEZ', '72546197', '', ''),
(188, 'JEIMER', 'MEJIA FERNANDEZ', '', '', ''),
(189, 'CARMEN ISABEL', 'FIGUEROA MESTANZA', '', '', ''),
(190, 'JULIO CESAR', 'CASTAÃ‘EDA VASQUEZ', '27928138', '', ''),
(191, 'KATTIA JACKELINI', 'CAMPOS YUPANQUI', '47636294', '', '976186258'),
(192, 'ROSA JULIA', 'NUNTON MENDOZA DE SALAZAR', '', '', ''),
(193, 'OSCAR GUILLERMO', 'SANCHEZ VILLAR', '42009854', '', ''),
(194, 'FLOR MARIELA', 'ESTELA VILLACORTA', '26714582', '', ''),
(195, 'JHONNY PORFIRIO', 'MENDOZA OCON', '42079984', '', ''),
(196, 'PRESCILA VIOLETA', 'HUAMAN CUEVA', '', '', ''),
(197, 'BETTY MARILIS', 'CALDERON GUTIERREZ', '', '', ''),
(198, 'ALDO CHARLI', 'MARTOS MACHUCA', '40562138', '', ''),
(199, 'YNES AMPARO', 'SILVA LUNQUI', '', '', ''),
(200, 'LUIS ABSALON', 'RODRIGUEZ NINA', '', '', ''),
(201, 'JULIO CESAR', 'CASTAÃ‘EDA VASQUEZ', '', '', ''),
(202, 'JUAN JOSE', 'VASQUEZ VASQUEZ', '', '', ''),
(203, 'CESAR LUIS', 'CHUNQUE QUIROZ', '41642116', '', ''),
(204, 'GLADIS RAQUEL', 'LEON CARDENAS', '', '', ''),
(205, 'EDITH MARGOTH', 'BAZAN VARGAS', '', '', ''),
(206, 'CARMEN GUZMARA', 'PLASENCIA MORALES', '', '', ''),
(207, 'MONICA MARIBEL', 'LEON ABANTO', '', '', ''),
(208, 'MONICA MARIBEL', 'LEON OBANDO', '', '', ''),
(209, 'LIDIA', 'MANTILLA SALAZAR', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_detcontrol`
--

CREATE TABLE `tbl_detcontrol` (
  `id_detcontrol` int(11) NOT NULL,
  `id_control` int(11) NOT NULL,
  `id_resolucion` int(11) NOT NULL,
  `f_recepcion` date DEFAULT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_detresolucion`
--

CREATE TABLE `tbl_detresolucion` (
  `id_detresolucion` int(11) NOT NULL,
  `id_resolucion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `f_entrega` date DEFAULT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_detresolucion`
--

INSERT INTO `tbl_detresolucion` (`id_detresolucion`, `id_resolucion`, `id_usuario`, `f_entrega`, `estado`) VALUES
(1, 1, 1, NULL, 0),
(2, 2, 2, NULL, 0),
(3, 3, 3, NULL, 0),
(4, 3, 5, NULL, 0),
(5, 3, 6, NULL, 0),
(6, 3, 7, NULL, 0),
(7, 3, 8, NULL, 0),
(8, 3, 9, NULL, 0),
(9, 3, 10, NULL, 0),
(10, 3, 11, NULL, 0),
(11, 3, 29, NULL, 0),
(12, 3, 12, NULL, 0),
(13, 3, 13, NULL, 0),
(14, 3, 14, NULL, 0),
(15, 3, 15, NULL, 0),
(16, 3, 16, NULL, 0),
(17, 3, 17, NULL, 0),
(18, 3, 18, NULL, 0),
(19, 3, 19, NULL, 0),
(20, 3, 20, NULL, 0),
(21, 3, 21, NULL, 0),
(22, 3, 22, NULL, 0),
(23, 3, 23, NULL, 0),
(24, 3, 24, NULL, 0),
(25, 3, 25, NULL, 0),
(26, 3, 26, NULL, 0),
(27, 3, 27, NULL, 0),
(28, 3, 28, NULL, 0),
(29, 3, 30, NULL, 0),
(31, 3, 31, NULL, 0),
(32, 3, 32, NULL, 0),
(33, 3, 33, NULL, 0),
(34, 3, 34, NULL, 0),
(35, 3, 35, NULL, 0),
(36, 3, 4, NULL, 0),
(37, 3, 36, NULL, 0),
(38, 3, 37, NULL, 0),
(39, 3, 38, NULL, 0),
(40, 3, 39, NULL, 0),
(41, 3, 40, NULL, 0),
(42, 3, 41, NULL, 0),
(43, 3, 42, NULL, 0),
(44, 3, 43, NULL, 0),
(45, 3, 45, NULL, 0),
(46, 3, 46, NULL, 0),
(47, 3, 47, NULL, 0),
(48, 3, 48, NULL, 0),
(49, 3, 49, NULL, 0),
(50, 3, 50, NULL, 0),
(51, 3, 51, NULL, 0),
(52, 3, 52, NULL, 0),
(53, 3, 53, NULL, 0),
(54, 3, 54, NULL, 0),
(55, 3, 56, NULL, 0),
(56, 3, 55, NULL, 0),
(57, 3, 57, NULL, 0),
(58, 3, 58, NULL, 0),
(59, 3, 59, NULL, 0),
(60, 3, 60, NULL, 0),
(61, 3, 61, NULL, 0),
(62, 3, 62, NULL, 0),
(63, 3, 63, NULL, 0),
(64, 3, 64, NULL, 0),
(65, 3, 65, NULL, 0),
(66, 4, 109, NULL, 0),
(67, 5, 110, NULL, 0),
(68, 5, 111, NULL, 0),
(69, 5, 112, NULL, 0),
(70, 5, 113, NULL, 0),
(71, 5, 114, NULL, 0),
(72, 5, 115, NULL, 0),
(73, 6, 116, NULL, 0),
(74, 7, 117, NULL, 0),
(75, 8, 118, NULL, 0),
(76, 9, 119, NULL, 0),
(77, 10, 120, NULL, 0),
(78, 11, 121, NULL, 0),
(79, 11, 122, NULL, 0),
(80, 11, 123, NULL, 0),
(81, 11, 124, NULL, 0),
(82, 11, 125, NULL, 0),
(83, 11, 126, NULL, 0),
(84, 11, 127, NULL, 0),
(85, 11, 128, NULL, 0),
(86, 12, 129, NULL, 0),
(87, 13, 130, NULL, 0),
(88, 14, 131, NULL, 0),
(89, 15, 132, '2019-07-10', 1),
(90, 16, 133, '2019-07-09', 1),
(91, 17, 134, NULL, 0),
(92, 18, 135, NULL, 0),
(93, 19, 136, NULL, 0),
(94, 20, 137, '2019-07-09', 1),
(95, 21, 138, NULL, 0),
(96, 22, 90, '2019-07-10', 1),
(98, 23, 71, NULL, 0),
(99, 24, 140, NULL, 0),
(100, 25, 16, '2019-07-10', 1),
(101, 26, 141, '2019-07-09', 1),
(102, 27, 139, NULL, 0),
(103, 28, 142, NULL, 0),
(104, 29, 144, NULL, 0),
(105, 30, 145, NULL, 0),
(106, 31, 146, NULL, 0),
(107, 32, 147, NULL, 0),
(108, 33, 148, NULL, 0),
(109, 34, 149, NULL, 0),
(110, 35, 150, NULL, 0),
(111, 36, 151, NULL, 0),
(112, 37, 152, NULL, 0),
(113, 38, 152, NULL, 0),
(114, 39, 153, NULL, 0),
(115, 40, 154, NULL, 0),
(116, 41, 155, NULL, 0),
(117, 42, 156, NULL, 0),
(118, 43, 156, NULL, 0),
(119, 44, 157, NULL, 0),
(120, 45, 158, NULL, 0),
(121, 46, 159, NULL, 0),
(122, 47, 160, NULL, 0),
(123, 48, 161, NULL, 0),
(124, 48, 162, NULL, 0),
(125, 48, 163, NULL, 0),
(126, 48, 164, NULL, 0),
(127, 48, 165, NULL, 0),
(128, 48, 166, NULL, 0),
(129, 48, 167, NULL, 0),
(130, 48, 168, NULL, 0),
(131, 48, 169, NULL, 0),
(132, 48, 170, NULL, 0),
(133, 48, 171, NULL, 0),
(134, 48, 172, NULL, 0),
(135, 48, 173, NULL, 0),
(136, 48, 174, NULL, 0),
(137, 48, 175, NULL, 0),
(138, 48, 176, NULL, 0),
(139, 48, 177, NULL, 0),
(140, 48, 178, NULL, 0),
(141, 48, 179, NULL, 0),
(142, 48, 180, NULL, 0),
(143, 48, 181, NULL, 0),
(144, 48, 182, NULL, 0),
(145, 49, 183, NULL, 0),
(146, 50, 184, NULL, 0),
(147, 51, 185, NULL, 0),
(148, 52, 186, NULL, 0),
(149, 53, 187, NULL, 0),
(150, 54, 185, NULL, 0),
(151, 55, 185, NULL, 0),
(152, 56, 188, NULL, 0),
(153, 57, 189, NULL, 0),
(154, 58, 190, NULL, 0),
(155, 59, 191, NULL, 0),
(156, 60, 192, NULL, 0),
(157, 61, 193, NULL, 0),
(158, 62, 194, NULL, 0),
(159, 63, 195, NULL, 0),
(160, 64, 196, NULL, 0),
(161, 65, 197, NULL, 0),
(162, 66, 198, NULL, 0),
(163, 67, 199, NULL, 0),
(164, 68, 200, NULL, 0),
(165, 69, 190, NULL, 0),
(166, 70, 202, NULL, 0),
(167, 71, 203, NULL, 0),
(168, 72, 204, NULL, 0),
(169, 73, 205, NULL, 0),
(170, 74, 206, NULL, 0),
(171, 75, 208, NULL, 0),
(172, 76, 209, NULL, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indices de la tabla `tblarea`
--
ALTER TABLE `tblarea`
  ADD PRIMARY KEY (`id_area`);

--
-- Indices de la tabla `tblcontrol`
--
ALTER TABLE `tblcontrol`
  ADD PRIMARY KEY (`id_control`),
  ADD KEY `fk_control_personal_idx` (`id_personal`),
  ADD KEY `fk_control_area_idx` (`id_area`);

--
-- Indices de la tabla `tblmotivo`
--
ALTER TABLE `tblmotivo`
  ADD PRIMARY KEY (`id_motivo`);

--
-- Indices de la tabla `tblpersonal`
--
ALTER TABLE `tblpersonal`
  ADD PRIMARY KEY (`id_personal`);

--
-- Indices de la tabla `tblresolucion`
--
ALTER TABLE `tblresolucion`
  ADD PRIMARY KEY (`id_resolucion`),
  ADD KEY `fk_resolucion_motivo_idx` (`id_motivo`),
  ADD KEY `fk_resolucion_areap_idx` (`id_area`);

--
-- Indices de la tabla `tblusuarios`
--
ALTER TABLE `tblusuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `tbl_detcontrol`
--
ALTER TABLE `tbl_detcontrol`
  ADD PRIMARY KEY (`id_detcontrol`),
  ADD KEY `fk_detcontrol_resolucion_idx` (`id_resolucion`),
  ADD KEY `fk_detcontrol_control_idx` (`id_control`);

--
-- Indices de la tabla `tbl_detresolucion`
--
ALTER TABLE `tbl_detresolucion`
  ADD PRIMARY KEY (`id_detresolucion`),
  ADD KEY `fk_detresolucion_usuarios_idx` (`id_usuario`),
  ADD KEY `fk_detresolucion_resolucion_idx` (`id_resolucion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tblarea`
--
ALTER TABLE `tblarea`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tblcontrol`
--
ALTER TABLE `tblcontrol`
  MODIFY `id_control` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tblmotivo`
--
ALTER TABLE `tblmotivo`
  MODIFY `id_motivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `tblpersonal`
--
ALTER TABLE `tblpersonal`
  MODIFY `id_personal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tblresolucion`
--
ALTER TABLE `tblresolucion`
  MODIFY `id_resolucion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT de la tabla `tblusuarios`
--
ALTER TABLE `tblusuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

--
-- AUTO_INCREMENT de la tabla `tbl_detcontrol`
--
ALTER TABLE `tbl_detcontrol`
  MODIFY `id_detcontrol` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_detresolucion`
--
ALTER TABLE `tbl_detresolucion`
  MODIFY `id_detresolucion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tblcontrol`
--
ALTER TABLE `tblcontrol`
  ADD CONSTRAINT `fk_control_area` FOREIGN KEY (`id_area`) REFERENCES `tblarea` (`id_area`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_control_personal` FOREIGN KEY (`id_personal`) REFERENCES `tblpersonal` (`id_personal`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tblresolucion`
--
ALTER TABLE `tblresolucion`
  ADD CONSTRAINT `fk_resolucion_areap` FOREIGN KEY (`id_area`) REFERENCES `tblarea` (`id_area`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_resolucion_motivo` FOREIGN KEY (`id_motivo`) REFERENCES `tblmotivo` (`id_motivo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_detcontrol`
--
ALTER TABLE `tbl_detcontrol`
  ADD CONSTRAINT `fk_detcontrol_control` FOREIGN KEY (`id_control`) REFERENCES `tblcontrol` (`id_control`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detcontrol_resolucion` FOREIGN KEY (`id_resolucion`) REFERENCES `tblresolucion` (`id_resolucion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_detresolucion`
--
ALTER TABLE `tbl_detresolucion`
  ADD CONSTRAINT `fk_detresolucion_resolucion` FOREIGN KEY (`id_resolucion`) REFERENCES `tblresolucion` (`id_resolucion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detresolucion_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `tblusuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
