-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Gegenereerd op: 07 apr 2020 om 20:17
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
CREATE DATABASE IF NOT EXISTS `poker_manager` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `poker_manager`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `participant`
--

DROP TABLE IF EXISTS `participant`;
CREATE TABLE IF NOT EXISTS `participant` (
  `id` int NOT NULL AUTO_INCREMENT,
  `player_id` int NOT NULL,
  `table_id` int NOT NULL,
  `rebuy_amount` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `participant_player` (`player_id`),
  KEY `participant_table` (`table_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `player_stats`
--

DROP TABLE IF EXISTS `player_stats`;
CREATE TABLE IF NOT EXISTS `player_stats` (
  `player_id` int NOT NULL,
  `round_won` int NOT NULL,
  `round_played` int NOT NULL,
  `tournament_won` int NOT NULL,
  `tournament_played` int NOT NULL,
  `total_income` float NOT NULL,
  PRIMARY KEY (`player_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `round`
--

DROP TABLE IF EXISTS `round`;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tournament`
--

DROP TABLE IF EXISTS `tournament`;
CREATE TABLE IF NOT EXISTS `tournament` (
  `id` int NOT NULL AUTO_INCREMENT,
  `game_code` varchar(255) NOT NULL,
  `tournament_name` varchar(255) NOT NULL,
  `admin` int NOT NULL,
  `start_amount` int NOT NULL,
  `max_rounds` int NOT NULL,
  `chip_white` int NOT NULL,
  `chip_red` int NOT NULL,
  `chip_green` int NOT NULL,
  `chip_blue` int NOT NULL,
  `chip_black` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `game_code` (`game_code`),
  KEY `tournament_admin` (`admin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tournament_table`
--

DROP TABLE IF EXISTS `tournament_table`;
CREATE TABLE IF NOT EXISTS `tournament_table` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tournament_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `table_tournament` (`tournament_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `participant`
--
ALTER TABLE `participant`
  ADD CONSTRAINT `participant_player` FOREIGN KEY (`player_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `participant_table` FOREIGN KEY (`table_id`) REFERENCES `tournament_table` (`id`);

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

--
-- Beperkingen voor tabel `tournament_table`
--
ALTER TABLE `tournament_table`
  ADD CONSTRAINT `table_tournament` FOREIGN KEY (`tournament_id`) REFERENCES `tournament` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
