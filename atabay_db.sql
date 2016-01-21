

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `token` varchar(255) COLLATE utf8_bin NOT NULL,
  `direccion` varchar(255) COLLATE utf8_bin NOT NULL,
  `longitud` double NOT NULL,
  `latitud` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Datos tabla usuario `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `token`, `direccion`, `longitud`, `latitud`) VALUES
(5, 'Efrain Espinosa', 'efrain@espinosa.com', '$2y$10$HucXbiL1my/LsbgdBXvjYuSbOnQiqoesIs4V3EJtCyJGeoAT6FGTa', 'f091e510cc55540abc1b7e695fc90c6f', 'Soria 20, La Esperanza, 53600 Naucalpan de Ju', -99.25331949999999, 19.4582485);

--La contraseña tiene hash y es: 12345x
