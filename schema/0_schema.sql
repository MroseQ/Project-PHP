-- W niniejszym pliku umieść schemat bazy danych (tworzenie tabel, relacji itd.)
-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 04 Kwi 2021, 20:16
-- Wersja serwera: 10.4.14-MariaDB
-- Wersja PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `mkgames`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `gra`
--

CREATE TABLE `gra` (
  `ID_gry` int(11) NOT NULL,
  `Nazwa_gry` text NOT NULL,
  `Cel_gry` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
--
-- Struktura tabeli dla tabeli `uzytkownik`
--

CREATE TABLE `uzytkownik` (
  `ID_Użytkownika` int(11) NOT NULL,
  `Nazwa_Użytkownika` text NOT NULL,
  `Hasło_Użytkownika` text NOT NULL,
  `E-mail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
--
-- Struktura tabeli dla tabeli `wynik`
--

CREATE TABLE `wynik` (
  `ID_przebiegu` int(11) NOT NULL,
  `ID_Użytkownika` int(11) NOT NULL,
  `ID_gra` int(11) NOT NULL,
  `punkty_zdobyte` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `gra`
--
ALTER TABLE `gra`
  ADD PRIMARY KEY (`ID_gry`);

--
-- Indeksy dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  ADD PRIMARY KEY (`ID_Użytkownika`);

--
-- Indeksy dla tabeli `wynik`
--
ALTER TABLE `wynik`
  ADD PRIMARY KEY (`ID_przebiegu`),
  ADD KEY `ID_gra` (`ID_gra`),
  ADD KEY `user_fk` (`ID_Użytkownika`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `gra`
--
ALTER TABLE `gra`
  MODIFY `ID_gry` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  MODIFY `ID_Użytkownika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `wynik`
--
ALTER TABLE `wynik`
  MODIFY `ID_przebiegu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `wynik`
--
ALTER TABLE `wynik`
  ADD CONSTRAINT `gra_fk` FOREIGN KEY (`ID_gra`) REFERENCES `gra` (`ID_gry`),
  ADD CONSTRAINT `user_fk` FOREIGN KEY (`ID_Użytkownika`) REFERENCES `uzytkownik` (`ID_Użytkownika`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;