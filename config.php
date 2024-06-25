CREATE DATABASE IF NOT EXISTS crud;

USE crud;

CREATE TABLE `usuarios` (
  `cod` int(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `tel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`cod`);
  
ALTER TABLE `usuarios`
  MODIFY `cod` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32448;
