-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Gegenereerd op: 07 apr 2020 om 20:54
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

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `participant`
--

CREATE TABLE `participant` (
  `id` int NOT NULL,
  `player_id` int NOT NULL,
  `table_id` int NOT NULL,
  `rebuy_amount` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `player_stats`
--

CREATE TABLE `player_stats` (
  `player_id` int NOT NULL,
  `round_won` int NOT NULL,
  `round_played` int NOT NULL,
  `tournament_won` int NOT NULL,
  `tournament_played` int NOT NULL,
  `total_income` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `round`
--

CREATE TABLE `round` (
  `id` int NOT NULL,
  `table_id` int NOT NULL,
  `round_number` int NOT NULL,
  `small_blind` int NOT NULL,
  `big_blind` int NOT NULL,
  `dealer` int NOT NULL,
  `player_won` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tournament`
--

CREATE TABLE `tournament` (
  `id` int NOT NULL,
  `game_code` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `tournament_name` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `admin` int NOT NULL,
  `start_amount` int NOT NULL,
  `max_rounds` int NOT NULL,
  `chip_white` int NOT NULL,
  `chip_red` int NOT NULL,
  `chip_green` int NOT NULL,
  `chip_blue` int NOT NULL,
  `chip_black` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tournament_table`
--

CREATE TABLE `tournament_table` (
  `id` int NOT NULL,
  `tournament_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `Email` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `Password` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `Name` varchar(255) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `participant_player` (`player_id`),
  ADD KEY `participant_table` (`table_id`);

--
-- Indexen voor tabel `player_stats`
--
ALTER TABLE `player_stats`
  ADD PRIMARY KEY (`player_id`);

--
-- Indexen voor tabel `round`
--
ALTER TABLE `round`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_round_participant` (`small_blind`),
  ADD KEY `FK_round_participant_2` (`big_blind`),
  ADD KEY `FK_round_participant_3` (`dealer`),
  ADD KEY `FK_round_participant_4` (`player_won`),
  ADD KEY `FK_round_table` (`table_id`);

--
-- Indexen voor tabel `tournament`
--
ALTER TABLE `tournament`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `game_code` (`game_code`),
  ADD KEY `tournament_admin` (`admin`);

--
-- Indexen voor tabel `tournament_table`
--
ALTER TABLE `tournament_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `table_tournament` (`tournament_id`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `participant`
--
ALTER TABLE `participant`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `round`
--
ALTER TABLE `round`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `tournament`
--
ALTER TABLE `tournament`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `tournament_table`
--
ALTER TABLE `tournament_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

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
