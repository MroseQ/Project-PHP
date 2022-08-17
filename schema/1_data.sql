--
-- Zrzut danych tabeli `gra`
--

INSERT INTO `gra` (`ID_gry`, `Nazwa_gry`, `Cel_gry`) VALUES
(1, 'Kółko i Krzyżyk', 'Zdobądź trzy kółka w rzędzie, kolumnie lub po skosie. Twój przeciwnik będzie stawiał krzyżyki po Twoim ruchu, nie daj mu zdobyć trzech krzyżyków w rzędzie, kolumnie lub po skosie!'),
(2, 'Pick the tenth', 'wybierz poprawną liczbę z dziesięciu'),
(3, 'RPS', 'Klasyczna gra w papier, kamień, nożyce.');
--
-- Zrzut danych tabeli `uzytkownik`
--

INSERT INTO `uzytkownik` (`ID_Użytkownika`, `Nazwa_Użytkownika`, `Hasło_Użytkownika`, `E-mail`) VALUES
(1, 'Marek', 'Krasiński', 'marekkrasinski@gmail.com'),
(2, 'Paweł', 'Cierzniakowski', 'najlepszynauczyciel@gmail.com'),
(3, 'Admin', 'admin', 'admin@admin.com'),
(4, 'Asjkp', 'Armin', 'asjkp@gmail.jp');
--
-- Zrzut danych tabeli `wynik`
--

INSERT INTO `wynik` (`ID_przebiegu`, `ID_Użytkownika`, `ID_gra`, `punkty_zdobyte`) VALUES
(31, 3, 1, 7),
(35, 3, 3, 3),
(53, 1, 1, 18),
(55, 1, 3, 6),
(59, 4, 1, 4),
(62, 4, 2, 3),
(63, 4, 3, 1);