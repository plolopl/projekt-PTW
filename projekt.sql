-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Lis 05, 2024 at 02:47 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projekt`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie`
--

CREATE TABLE `kategorie` (
  `id` int(10) UNSIGNED NOT NULL,
  `nazwa` varchar(50) NOT NULL,
  `opis` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `kategorie`
--

INSERT INTO `kategorie` (`id`, `nazwa`, `opis`) VALUES
(4, 'Rajd PVP', 'Party ma być przygotowane do podjęcia walki z innymi graczami'),
(5, 'Rajd PVE', 'Party ma mieć możliwość pokonania każdego \"moba\" - czyli efektywnie móc robić skrzynki lub lochy'),
(6, 'Ganking', 'Rajd mający na celu atak z zaskoczenia na transport lub na \"Gucci kill\". Zabicie takiego celu zapewnia duży łup.');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rajd`
--

CREATE TABLE `rajd` (
  `id` int(10) UNSIGNED NOT NULL,
  `idRajdu` int(10) UNSIGNED NOT NULL,
  `idUzytkownika` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `rajd`
--

INSERT INTO `rajd` (`id`, `idRajdu`, `idUzytkownika`) VALUES
(2, 6, 3),
(3, 7, 3),
(4, 9, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rajdy`
--

CREATE TABLE `rajdy` (
  `id` int(10) UNSIGNED NOT NULL,
  `idKategorii` int(10) UNSIGNED DEFAULT NULL,
  `nazwa` varchar(50) NOT NULL,
  `opis` text DEFAULT NULL,
  `ileOsob` int(11) DEFAULT NULL,
  `idStrefy` int(11) UNSIGNED DEFAULT NULL,
  `recommended_ip` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `rajdy`
--

INSERT INTO `rajdy` (`id`, `idKategorii`, `nazwa`, `opis`, `ileOsob`, `idStrefy`, `recommended_ip`) VALUES
(6, 4, 'Rozbój na Roadsach', 'Podejmujemy party, lanie na kolanie', 7, 4, 1200),
(7, 5, 'Pve Slaves', 'Robimy lochy, bo niby nudy, ale ip samo się nie wbije', 4, 3, 1300),
(8, 6, 'Gangsterzy? Dżentelmeni', 'Polujemy na przewozy na Black market', 4, 2, 1100),
(9, 4, 'Frakcja, posterunki', 'Dziennik się nie zrobi', 3, 1, 1000);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `recenzje`
--

CREATE TABLE `recenzje` (
  `id` int(10) UNSIGNED NOT NULL,
  `idRajdu` int(10) UNSIGNED DEFAULT NULL,
  `nick` varchar(50) DEFAULT NULL,
  `ocena` int(11) DEFAULT NULL,
  `tresc` text DEFAULT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `recenzje`
--

INSERT INTO `recenzje` (`id`, `idRajdu`, `nick`, `ocena`, `tresc`, `data`) VALUES
(12, 6, 'abc', 5, 'spoko', '2024-09-28 11:47:16'),
(14, 6, 'maciek', 3, 'okej', '2024-10-31 10:12:19'),
(15, 6, 'maciek', 3, 'okej', '2024-10-31 10:12:19');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `strefy`
--

CREATE TABLE `strefy` (
  `id` int(11) UNSIGNED NOT NULL,
  `typ` varchar(50) NOT NULL,
  `nazwa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `strefy`
--

INSERT INTO `strefy` (`id`, `typ`, `nazwa`) VALUES
(1, 'yellow.png', 'żółte'),
(2, 'red.png', 'czerwone'),
(3, 'black.png', 'czarne'),
(4, 'roads.png', 'ścieżki');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ulubione`
--

CREATE TABLE `ulubione` (
  `id` int(10) UNSIGNED NOT NULL,
  `idRajdu` int(10) UNSIGNED NOT NULL,
  `idUzytkownika` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `ulubione`
--

INSERT INTO `ulubione` (`id`, `idRajdu`, `idUzytkownika`) VALUES
(45, 6, 3),
(46, 7, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(10) UNSIGNED NOT NULL,
  `login` varchar(50) NOT NULL,
  `haslo` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `rola` varchar(50) NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `awatar` varchar(50) NOT NULL DEFAULT 'no.jpeg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `login`, `haslo`, `email`, `rola`, `data`, `awatar`) VALUES
(3, 'abc', '900150983cd24fb0d6963f7d28e17f72', 'abc@abc.pl', 'admin', '2024-11-02 11:30:46', 'Worm.webp'),
(4, 'maciek', 'c37d92bd113c608f296f0a65cd760e1d', 'maciek@maciek.pl', '', '2024-10-31 11:17:41', 'no.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zgłoszenia`
--

CREATE TABLE `zgłoszenia` (
  `id` int(10) UNSIGNED NOT NULL,
  `idUzytkownika` int(10) UNSIGNED DEFAULT NULL,
  `tresc` text DEFAULT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `zgłoszenia`
--

INSERT INTO `zgłoszenia` (`id`, `idUzytkownika`, `tresc`, `data`) VALUES
(1, 4, 'Nie ma dodanego czasu rajdu, wiem że to są dzisiejsze rajdy, ale wolałbym wiedzieć, kiedy wbić', '2024-10-28 17:07:11'),
(8, 3, 'cos jest nie tak', '2024-11-02 11:18:48'),
(9, 3, 'slabe', '2024-11-02 11:45:18');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `rajd`
--
ALTER TABLE `rajd`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idDzbana` (`idRajdu`),
  ADD KEY `idUzytkownika` (`idUzytkownika`);

--
-- Indeksy dla tabeli `rajdy`
--
ALTER TABLE `rajdy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idKategorii` (`idKategorii`),
  ADD KEY `idStrefy` (`idStrefy`);

--
-- Indeksy dla tabeli `recenzje`
--
ALTER TABLE `recenzje`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idDzbana` (`idRajdu`);

--
-- Indeksy dla tabeli `strefy`
--
ALTER TABLE `strefy`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `ulubione`
--
ALTER TABLE `ulubione`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idDzbana` (`idRajdu`),
  ADD KEY `idUzytkownika` (`idUzytkownika`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `zgłoszenia`
--
ALTER TABLE `zgłoszenia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUzytkownika` (`idUzytkownika`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rajd`
--
ALTER TABLE `rajd`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rajdy`
--
ALTER TABLE `rajdy`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `recenzje`
--
ALTER TABLE `recenzje`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `strefy`
--
ALTER TABLE `strefy`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ulubione`
--
ALTER TABLE `ulubione`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `zgłoszenia`
--
ALTER TABLE `zgłoszenia`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rajd`
--
ALTER TABLE `rajd`
  ADD CONSTRAINT `rajd_ibfk_1` FOREIGN KEY (`idRajdu`) REFERENCES `rajdy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rajd_ibfk_2` FOREIGN KEY (`idUzytkownika`) REFERENCES `uzytkownicy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rajdy`
--
ALTER TABLE `rajdy`
  ADD CONSTRAINT `rajdy_ibfk_1` FOREIGN KEY (`idKategorii`) REFERENCES `kategorie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rajdy_ibfk_2` FOREIGN KEY (`idStrefy`) REFERENCES `strefy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recenzje`
--
ALTER TABLE `recenzje`
  ADD CONSTRAINT `recenzje_ibfk_1` FOREIGN KEY (`idRajdu`) REFERENCES `rajdy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ulubione`
--
ALTER TABLE `ulubione`
  ADD CONSTRAINT `idDzbana` FOREIGN KEY (`idRajdu`) REFERENCES `rajdy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idUzytkownika` FOREIGN KEY (`idUzytkownika`) REFERENCES `uzytkownicy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `zgłoszenia`
--
ALTER TABLE `zgłoszenia`
  ADD CONSTRAINT `zgłoszenia_ibfk_1` FOREIGN KEY (`idUzytkownika`) REFERENCES `uzytkownicy` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
