-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2019 at 10:20 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tutoring`
--

-- --------------------------------------------------------

--
-- Table structure for table `domanda`
--

CREATE TABLE `domanda` (
  `id_domanda` int(11) NOT NULL,
  `testo_domanda` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `titolo_domanda` varchar(75) NOT NULL,
  `data` date NOT NULL,
  `id_materia` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `domanda`
--

INSERT INTO `domanda` (`id_domanda`, `testo_domanda`, `email`, `titolo_domanda`, `data`, `id_materia`, `deleted`) VALUES
(15, 'Chi era Pirandello?', 'admin@gmail.com', 'Pirandello', '2019-05-22', 1, 0),
(16, 'Non so come calcolare il limite per x->+oo  dell\'integrale definito di x+2 con a=0 e b=x\r\nUn aiutino?', 'admin@gmail.com', 'Come calcolare l\'integrale indeterminato', '2019-05-22', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `materia`
--

CREATE TABLE `materia` (
  `id_materia` int(11) NOT NULL,
  `nome_materia` varchar(30) NOT NULL,
  `deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `materia`
--

INSERT INTO `materia` (`id_materia`, `nome_materia`, `deleted`) VALUES
(1, 'Italiano', 0),
(2, 'Matematica', 0),
(3, 'Storia', 0),
(4, 'Geografia', 0),
(6, 'Fisica', 0),
(7, 'Scienze', 0),
(10, 'Algebra', 0),
(11, 'Educazione Fisica', 0);

-- --------------------------------------------------------

--
-- Table structure for table `risposta`
--

CREATE TABLE `risposta` (
  `id_risposta` int(11) NOT NULL,
  `testo_risposta` text NOT NULL,
  `valutazione` int(1) DEFAULT NULL,
  `id_materia` int(11) NOT NULL,
  `id_domanda` int(11) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `risposta`
--

INSERT INTO `risposta` (`id_risposta`, `testo_risposta`, `valutazione`, `id_materia`, `id_domanda`, `email`) VALUES
(2, 'Pirandello e\' stato uno dei piu grandi letterati italiani del 900', NULL, 1, 15, 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `utente`
--

CREATE TABLE `utente` (
  `email` varchar(30) NOT NULL,
  `nome_utente` varchar(30) NOT NULL,
  `password` varchar(72) NOT NULL,
  `ruolo` int(1) UNSIGNED NOT NULL COMMENT '0=user,1=admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utente`
--

INSERT INTO `utente` (`email`, `nome_utente`, `password`, `ruolo`) VALUES
('admin@gmail.com', 'admin', '$2y$12$5s.oYxVU8NxHOI0s8NtI5eRkM32DoGGSi/a6/tp2neF./arI3PkUe', 1),
('tizio@caio.it', 'tizio', '$2y$12$YAG2mZ4pEzwCFohAgKm7z.49/ZkMg6sllCZcbdbOSZh6bHmn48VEu', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `domanda`
--
ALTER TABLE `domanda`
  ADD PRIMARY KEY (`id_domanda`),
  ADD KEY `fk1` (`email`),
  ADD KEY `fk6` (`id_materia`);

--
-- Indexes for table `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`id_materia`);

--
-- Indexes for table `risposta`
--
ALTER TABLE `risposta`
  ADD PRIMARY KEY (`id_risposta`),
  ADD KEY `fk3` (`email`),
  ADD KEY `fk2` (`id_domanda`),
  ADD KEY `fk4` (`id_materia`);

--
-- Indexes for table `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `domanda`
--
ALTER TABLE `domanda`
  MODIFY `id_domanda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `materia`
--
ALTER TABLE `materia`
  MODIFY `id_materia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `risposta`
--
ALTER TABLE `risposta`
  MODIFY `id_risposta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `domanda`
--
ALTER TABLE `domanda`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`email`) REFERENCES `utente` (`email`),
  ADD CONSTRAINT `fk6` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id_materia`);

--
-- Constraints for table `risposta`
--
ALTER TABLE `risposta`
  ADD CONSTRAINT `fk2` FOREIGN KEY (`id_domanda`) REFERENCES `domanda` (`id_domanda`),
  ADD CONSTRAINT `fk3` FOREIGN KEY (`email`) REFERENCES `utente` (`email`),
  ADD CONSTRAINT `fk4` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id_materia`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
