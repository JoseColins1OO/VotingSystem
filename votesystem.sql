-- Exportación de MySQL realizada por phpMyAdmin
-- versión 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Hora de generación: 27 de mayo de 2021, 02:28 PM
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `votesystem`
--

-- --------------------------------------------------------

--
-- Estructura de la tabla `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL, -- Identificador único del administrador
  `username` varchar(50) NOT NULL, -- Nombre de usuario
  `password` varchar(60) NOT NULL, -- Contraseña encriptada
  `firstname` varchar(50) NOT NULL, -- Nombre
  `lastname` varchar(50) NOT NULL, -- Apellido
  `photo` varchar(150) NOT NULL, -- Ruta de la foto
  `created_on` date NOT NULL -- Fecha de creación del administrador
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Datos de la tabla `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `firstname`, `lastname`, `photo`, `created_on`) VALUES
(1, 'crce', '$2y$10$kLqXG4BAJrPbsOjJ/.B4eeZn6oojNhAb8l5/cb9eZvFnYU.pz2qni', 'CRCE', 'Admin', 'WhatsApp Image 2021-05-27 at 17.55.34.jpeg', '2018-04-02');

-- --------------------------------------------------------

--
-- Estructura de la tabla `candidates`
--

CREATE TABLE `candidates` (
  `id` int(11) NOT NULL, -- Identificador único del candidato
  `position_id` int(11) NOT NULL, -- ID de la posición que representa
  `firstname` varchar(30) NOT NULL, -- Nombre
  `lastname` varchar(30) NOT NULL, -- Apellido
  `photo` varchar(150) NOT NULL, -- Ruta de la foto
  `platform` text NOT NULL -- Descripción de su plataforma política
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de la tabla `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL, -- Identificador único de la posición
  `description` varchar(50) NOT NULL, -- Descripción del cargo
  `max_vote` int(11) NOT NULL, -- Número máximo de votos permitidos
  `priority` int(11) NOT NULL -- Prioridad de la posición
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de la tabla `voters`
--

CREATE TABLE `voters` (
  `id` int(11) NOT NULL, -- Identificador único del votante
  `voters_id` varchar(15) NOT NULL, -- ID del votante
  `password` varchar(60) NOT NULL, -- Contraseña encriptada
  `firstname` varchar(30) NOT NULL, -- Nombre
  `lastname` varchar(30) NOT NULL, -- Apellido
  `email` varchar(100) NOT NULL -- Correo electrónico del votante
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de la tabla `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL, -- Identificador único del voto
  `voters_id` int(11) NOT NULL, -- ID del votante
  `candidate_id` int(11) NOT NULL, -- ID del candidato
  `position_id` int(11) NOT NULL -- ID de la posición
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices de las tablas
--

--
-- Índices para la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Índices para la tabla `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`);

--
-- Índices para la tabla `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Índices para la tabla `voters`
--
ALTER TABLE `voters`
  ADD PRIMARY KEY (`id`);

--
-- Índices para la tabla `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- Configuración de AUTO_INCREMENT en las tablas
--

--
-- AUTO_INCREMENT para la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT para la tabla `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT para la tabla `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT para la tabla `voters`
--
ALTER TABLE `voters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT para la tabla `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
