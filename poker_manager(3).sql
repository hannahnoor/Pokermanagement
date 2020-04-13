-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Gegenereerd op: 13 apr 2020 om 14:56
-- Serverversie: 8.0.19
-- PHP-versie: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poker_manager`
--
CREATE DATABASE IF NOT EXISTS `poker_manager` DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci;
USE `poker_manager`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `participant`
--

CREATE TABLE IF NOT EXISTS `participant` (
  `id` int NOT NULL AUTO_INCREMENT,
  `player_id` int NOT NULL,
  `table_nr` int DEFAULT '0',
  `tournament_id` int DEFAULT NULL,
  `rebuy_amount` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `participant_player` (`player_id`),
  KEY `participant_table` (`table_nr`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `player_stats`
--

CREATE TABLE IF NOT EXISTS `player_stats` (
  `player_id` int NOT NULL,
  `round_won` int NOT NULL,
  `round_played` int NOT NULL,
  `tournament_won` int NOT NULL,
  `tournament_played` int NOT NULL,
  `total_income` float NOT NULL,
  PRIMARY KEY (`player_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `player_stats`
--

INSERT INTO `player_stats` (`player_id`, `round_won`, `round_played`, `tournament_won`, `tournament_played`, `total_income`) VALUES
(3, 4, 10, 1, 5, 50);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `round`
--

CREATE TABLE IF NOT EXISTS `round` (
  `id` int NOT NULL AUTO_INCREMENT,
  `table_id` int NOT NULL,
  `round_number` int NOT NULL,
  `small_blind` int NOT NULL,
  `big_blind` int NOT NULL,
  `dealer` int NOT NULL,
  `player_won` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_round_participant` (`small_blind`),
  KEY `FK_round_participant_2` (`big_blind`),
  KEY `FK_round_participant_3` (`dealer`),
  KEY `FK_round_participant_4` (`player_won`),
  KEY `FK_round_table` (`table_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tournament`
--

CREATE TABLE IF NOT EXISTS `tournament` (
  `id` int NOT NULL AUTO_INCREMENT,
  `game_code` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `tournament_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `admin` int DEFAULT NULL,
  `start_amount` int DEFAULT NULL,
  `max_rounds` int DEFAULT NULL,
  `chip_white` int DEFAULT NULL,
  `chip_red` int DEFAULT NULL,
  `chip_green` int DEFAULT NULL,
  `chip_blue` int DEFAULT NULL,
  `chip_black` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `game_code` (`game_code`),
  KEY `tournament_admin` (`admin`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `tournament`
--

INSERT INTO `tournament` (`id`, `game_code`, `tournament_name`, `admin`, `start_amount`, `max_rounds`, `chip_white`, `chip_red`, `chip_green`, `chip_blue`, `chip_black`) VALUES
(20, 'dGVzdDNfIyRf', 'test3', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'dGVzdDEwMF8jJF8=', 'test100', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'dGVzdHNwZWxfIyRf', 'testspel', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Email` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `Password` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `Name` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`id`, `Email`, `Password`, `Name`) VALUES
(1, 'pipi@pipi.pipi', 'pipi', 'pipi'),
(2, 'test@gmail.com', '$2y$10$rqK2MUyLURNmRq4a9iSrMOI6U2Bo/nyvumd7rvwW0rDEi0U.zZzni', 'test'),
(3, 'test2@gmail.com', '$2y$10$ih6zWvWwUZlMzA/6ZwEQXetG5JaDu4iVQfKPtlBp1AXxBMOoe9uGq', 'test');

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `participant`
--
ALTER TABLE `participant`
  ADD CONSTRAINT `participant_player` FOREIGN KEY (`player_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `participant_table` FOREIGN KEY (`table_nr`) REFERENCES `tournament_table` (`id`);

--
-- Beperkingen voor tabel `round`
--
ALTER TABLE `round`
  ADD CONSTRAINT `FK_round_participant` FOREIGN KEY (`small_blind`) REFERENCES `participant` (`id`),
  ADD CONSTRAINT `FK_round_participant_2` FOREIGN KEY (`big_blind`) REFERENCES `participant` (`id`),
  ADD CONSTRAINT `FK_round_participant_3` FOREIGN KEY (`dealer`) REFERENCES `participant` (`id`),
  ADD CONSTRAINT `FK_round_participant_4` FOREIGN KEY (`player_won`) REFERENCES `participant` (`id`),
  ADD CONSTRAINT `FK_round_table` FOREIGN KEY (`table_id`) REFERENCES `tournament_table` (`id`);

--
-- Beperkingen voor tabel `tournament`
--
ALTER TABLE `tournament`
  ADD CONSTRAINT `tournament_admin` FOREIGN KEY (`admin`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
