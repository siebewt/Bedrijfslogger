-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 01 feb 2023 om 22:37
-- Serverversie: 10.4.24-MariaDB
-- PHP-versie: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bedrijven`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bedrijven`
--

CREATE TABLE `bedrijven` (
  `id` int(11) NOT NULL,
  `date` datetime DEFAULT NULL,
  `bedrijfsid` int(11) DEFAULT NULL,
  `bedrijfsnaam` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `provincie` enum('friesland','drenthe','groningen','gelderland','overijssel','noord-holland','zuid-holland','noord-brabant','flevoland','zeeland','utrecht','limburg') CHARACTER SET utf8 DEFAULT NULL,
  `sector` enum('overheid','consument','particulier') CHARACTER SET utf8 DEFAULT NULL,
  `image` varchar(256) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `bedrijven`
--

INSERT INTO `bedrijven` (`id`, `date`, `bedrijfsid`, `bedrijfsnaam`, `provincie`, `sector`, `image`) VALUES
(14, '2023-01-31 21:18:14', NULL, 'Bedrijf ', 'friesland', 'overheid', '63d97786c2b1e2.19112493.jpg'),
(24, '2023-02-01 16:18:43', NULL, 'Test', 'friesland', 'overheid', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `contactspersoon`
--

CREATE TABLE `contactspersoon` (
  `id` int(11) NOT NULL,
  `naam` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `Cid` int(11) NOT NULL,
  `Bid` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `contactspersoon`
--

INSERT INTO `contactspersoon` (`id`, `naam`, `Cid`, `Bid`, `Email`) VALUES
(4, 'Persoon A', 1, 0, 'Mail@mail.com'),
(5, 'test', 1, 14, 'test'),
(6, 'tt', 1, 24, 'tt');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruikers`
--

CREATE TABLE `gebruikers` (
  `id` int(11) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `admin` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `gebruikers`
--

INSERT INTO `gebruikers` (`id`, `username`, `password`, `created_at`, `admin`) VALUES
(1, 'admin', 'adpexzg3FUZAk', '2023-01-31 12:43:28', 1),
(19, 'Gebruiker', 'AdS9O3DYbGQ/I', '2023-01-31 20:20:30', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `notities`
--

CREATE TABLE `notities` (
  `id` int(11) NOT NULL,
  `Bid` int(11) DEFAULT NULL,
  `Cid` int(11) DEFAULT NULL,
  `notitie` varchar(512) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `notities`
--

INSERT INTO `notities` (`id`, `Bid`, `Cid`, `notitie`) VALUES
(24, 24, 1, 'test');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `Bid` int(11) DEFAULT NULL,
  `tasks` varchar(512) CHARACTER SET utf8 DEFAULT NULL,
  `Cid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tasks`
--

INSERT INTO `tasks` (`id`, `Bid`, `tasks`, `Cid`) VALUES
(19, 24, 'test', 1),
(20, 14, 'iets te doen', 1),
(21, 14, 'bg', 1),
(22, 24, '\\\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor', 1),
(23, 24, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i', 1);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `bedrijven`
--
ALTER TABLE `bedrijven`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `contactspersoon`
--
ALTER TABLE `contactspersoon`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `gebruikers`
--
ALTER TABLE `gebruikers`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `notities`
--
ALTER TABLE `notities`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `bedrijven`
--
ALTER TABLE `bedrijven`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT voor een tabel `contactspersoon`
--
ALTER TABLE `contactspersoon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `gebruikers`
--
ALTER TABLE `gebruikers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT voor een tabel `notities`
--
ALTER TABLE `notities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT voor een tabel `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
