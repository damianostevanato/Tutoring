-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mar 20, 2019 alle 17:59
-- Versione del server: 10.1.35-MariaDB
-- Versione PHP: 7.2.9

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
-- Struttura della tabella `domanda`
--

CREATE TABLE `domanda` (
  `id_domanda` int(11) NOT NULL,
  `testo_domanda` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `titolo_domanda` varchar(30) NOT NULL,
  `id_materia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `domanda`
--

INSERT INTO `domanda` (`id_domanda`, `testo_domanda`, `email`, `titolo_domanda`, `id_materia`) VALUES
(1, 'Chi era Napoleone?', 'damiano.stevanato99@gmail.com', 'Napoleone', 3),
(2, 'Quanto fa 15+18?', 'tommaso.pellizon00@gmail.com', 'Operazioni numeri avanzati', 2),
(3, 'Quando morì Verga?', 'riccardo.mamprin00@gmail.com', 'Verga', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `materia`
--

CREATE TABLE `materia` (
  `id_materia` int(11) NOT NULL,
  `nome_materia` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `materia`
--

INSERT INTO `materia` (`id_materia`, `nome_materia`) VALUES
(1, 'italiano'),
(2, 'matematica'),
(3, 'stroria'),
(4, 'geografia');

-- --------------------------------------------------------

--
-- Struttura della tabella `risposta`
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
-- Dump dei dati per la tabella `risposta`
--

INSERT INTO `risposta` (`id_risposta`, `testo_risposta`, `valutazione`, `id_materia`, `id_domanda`, `email`) VALUES
(1, 'Un generale francese', NULL, 3, 1, 'tommaso.pellizon00@gmail.com'),
(2, 'Il 22 gennaio 1922', NULL, 1, 3, 'mattia.simonato00@gmail.com'),
(3, 'Credo 36', NULL, 2, 2, 'damiano.stevanato99@gmail.com');

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `email` varchar(30) NOT NULL,
  `nome_utente` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `valutazione` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`email`, `nome_utente`, `password`, `valutazione`) VALUES
('damiano.stevanato99@gmail.com', 'steva', '1234', NULL),
('mattia.simonato00@gmail.com', 'simo', '1234', NULL),
('riccardo.mamprin00@gmail.com', 'rando', '1234', NULL),
('tommaso.pellizon00@gmail.com', 'pelli', '1234', NULL);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `domanda`
--
ALTER TABLE `domanda`
  ADD PRIMARY KEY (`id_domanda`),
  ADD KEY `fk1` (`email`),
  ADD KEY `fk6` (`id_materia`);

--
-- Indici per le tabelle `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`id_materia`);

--
-- Indici per le tabelle `risposta`
--
ALTER TABLE `risposta`
  ADD PRIMARY KEY (`id_risposta`),
  ADD KEY `fk3` (`email`),
  ADD KEY `fk2` (`id_domanda`),
  ADD KEY `fk4` (`id_materia`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `domanda`
--
ALTER TABLE `domanda`
  MODIFY `id_domanda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `materia`
--
ALTER TABLE `materia`
  MODIFY `id_materia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `risposta`
--
ALTER TABLE `risposta`
  MODIFY `id_risposta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `domanda`
--
ALTER TABLE `domanda`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`email`) REFERENCES `utente` (`email`),
  ADD CONSTRAINT `fk6` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id_materia`);

--
-- Limiti per la tabella `risposta`
--
ALTER TABLE `risposta`
  ADD CONSTRAINT `fk2` FOREIGN KEY (`id_domanda`) REFERENCES `domanda` (`id_domanda`),
  ADD CONSTRAINT `fk3` FOREIGN KEY (`email`) REFERENCES `utente` (`email`),
  ADD CONSTRAINT `fk4` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id_materia`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
