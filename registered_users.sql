-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 07 Sty 2017, 14:32
-- Wersja serwera: 5.7.14
-- Wersja PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `registered_users`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `articles`
--

CREATE TABLE `articles` (
  `ID` int(11) NOT NULL,
  `name` varchar(33) DEFAULT NULL,
  `kcal` decimal(5,2) DEFAULT NULL,
  `carbs` decimal(4,2) DEFAULT NULL,
  `protein` decimal(4,2) DEFAULT NULL,
  `fat` decimal(4,2) DEFAULT NULL,
  `min_portion` decimal(3,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `articles`
--

INSERT INTO `articles` (`ID`, `name`, `kcal`, `carbs`, `protein`, `fat`, `min_portion`) VALUES
(1, 'agawa syrop 100 gr', '320.00', '78.00', '0.00', '0.00', '0.05'),
(2, 'awokado 1 owoc', '224.00', '10.40', '2.80', '21.40', '0.25'),
(3, 'baklazan 100 gram', '21.00', '6.30', '1.10', '0.10', '0.10'),
(4, 'banan 100 gr', '95.00', '23.00', '1.10', '0.33', '0.10'),
(5, 'borowki 100 gram', '57.00', '14.00', '0.74', '0.33', '0.10'),
(6, 'brokul 100 gram', '27.00', '5.20', '3.00', '0.40', '0.10'),
(7, 'brukselka 100 gram', '36.00', '7.10', '2.60', '0.50', '0.10'),
(8, 'burak gotowany 100 gram', '44.00', '10.00', '1.70', '0.18', '0.10'),
(9, 'chleb 100 gram', '213.00', '51.20', '5.90', '1.70', '0.50'),
(10, 'cieciorka 100 gram', '270.00', '43.00', '21.00', '2.00', '0.10'),
(11, 'cukinia 100 gram', '21.00', '3.10', '2.70', '0.40', '0.10'),
(12, 'dorsz filet 100g', '78.00', '0.00', '17.70', '0.70', '0.10'),
(13, 'dynia cala', '235.00', '64.70', '10.90', '2.50', '0.25'),
(14, 'fasola czerwona surowa 100 gram', '337.00', '61.00', '23.00', '1.10', '0.10'),
(15, 'fasolka zielona 100 gram', '27.00', '7.60', '2.40', '0.20', '0.10'),
(16, 'feta 100 gram', '260.00', '0.20', '15.30', '21.80', '0.10'),
(17, 'groszek 100 gram', '69.00', '11.00', '4.00', '0.00', '0.10'),
(18, 'gruszka srednia', '103.00', '28.00', '0.68', '0.21', '0.25'),
(19, 'indyk piers 100 gram pieczony', '135.00', '0.00', '30.00', '0.74', '0.25'),
(20, 'jablko 100 gr', '52.00', '14.00', '0.26', '0.17', '0.25'),
(21, 'jajko bialko jedno', '49.00', '0.70', '10.90', '0.20', '1.00'),
(22, 'jajko srednie sadzone', '90.00', '0.41', '6.30', '7.00', '1.00'),
(23, 'jajko zoltko jedno', '63.00', '0.10', '3.10', '5.60', '1.00'),
(24, 'jogurt 100 gr', '63.00', '7.10', '5.20', '1.50', '0.10'),
(25, 'kapusta pekinska 100 gram', '12.00', '3.10', '1.20', '0.20', '0.10'),
(26, 'kasza gryczana 100 gram', '355.00', '69.30', '12.60', '3.10', '0.25'),
(27, 'kasza jaglana sucha 100 gram', '357.00', '66.00', '14.00', '2.50', '0.25'),
(28, 'kasza jeczmienna 100 gram', '358.00', '74.00', '8.00', '2.00', '0.25'),
(29, 'kasza manna 100 gram', '360.00', '76.00', '10.00', '1.30', '0.25'),
(30, 'kukurydza puszka 100 gram', '80.00', '11.00', '2.90', '1.90', '0.10'),
(31, 'Len mielony 100 gram', '311.00', '7.00', '32.00', '9.00', '0.05'),
(32, 'losos wedzony 100 gram', '162.00', '0.00', '21.50', '8.40', '0.10'),
(33, 'makaron 100 gr', '359.00', '75.00', '11.50', '1.30', '0.25'),
(34, 'makaron ryzowy 50 gram', '166.00', '40.40', '0.90', '0.00', '1.00'),
(35, 'makrela 100 gram', '262.00', '0.00', '24.00', '18.00', '0.10'),
(36, 'maliny 100 gram', '52.00', '12.00', '1.20', '0.65', '0.10'),
(37, 'marchewka gotowana 100 gram', '35.00', '8.20', '0.76', '0.18', '0.10'),
(38, 'maslo 5 gram', '37.00', '0.00', '0.00', '4.10', '1.00'),
(39, 'maslo orzechowe lyzka 20g', '139.00', '2.00', '2.60', '13.40', '1.00'),
(40, 'maka pszenna 100 gram', '341.00', '71.30', '11.60', '1.80', '0.10'),
(41, 'maka zytnia 100 gram', '357.00', '77.00', '9.80', '1.30', '0.10'),
(42, 'mieszanka chinska 100 gram', '53.00', '7.30', '2.40', '0.40', '0.10'),
(43, 'mieszanka na zupe 100 gram', '24.00', '3.20', '2.10', '0.30', '0.10'),
(44, 'migdaly platki 100 gram', '581.00', '10.00', '22.00', '51.00', '0.05'),
(45, 'miod 100 gram', '340.00', '70.00', '0.30', '0.00', '0.05'),
(46, 'mleko kozie 100gram', '69.00', '4.50', '3.60', '4.10', '0.10'),
(47, 'mozarella 100 gram', '286.00', '0.80', '17.00', '23.00', '0.10'),
(48, 'mus jablkowy 100 gram', '85.00', '20.00', '0.50', '0.30', '0.05'),
(49, 'musli 100 gram', '346.00', '62.00', '11.00', '4.00', '0.10'),
(50, 'nachos 100 gram', '500.00', '67.80', '7.10', '25.00', '0.10'),
(51, 'nalesnik sztuka', '170.00', '27.60', '6.50', '3.90', '1.00'),
(52, 'nasiona', '455.00', '48.80', '14.10', '21.20', '0.10'),
(53, 'nutella 100 gram', '546.00', '57.60', '6.00', '31.60', '0.10'),
(54, 'ogorek 100 gram', '15.00', '3.60', '0.65', '0.11', '0.10'),
(55, 'oliwa 100 g', '824.00', '0.00', '0.00', '92.00', '0.05'),
(56, 'oliwki 100 gram', '152.00', '0.60', '1.10', '16.40', '0.05'),
(57, 'orzechy mieszanka 100 gram', '528.00', '39.10', '11.70', '34.60', '0.05'),
(58, 'otreby 100 gram', '345.00', '54.70', '14.50', '8.70', '0.10'),
(59, 'papryka 100 gram', '31.00', '6.00', '1.50', '0.45', '0.10'),
(60, 'parmezan 100 gram', '452.00', '0.10', '41.50', '32.00', '0.10'),
(61, 'passata 100 gram', '47.30', '9.40', '1.20', '0.50', '0.10'),
(62, 'pieczarki smazone 100 gram', '26.00', '4.00', '3.60', '0.33', '0.10'),
(63, 'pomarancza 131 gram', '62.00', '15.00', '1.20', '0.16', '0.50'),
(64, 'pomidor', '18.00', '3.90', '0.88', '0.20', '1.00'),
(65, 'pomidor suszony jeden', '16.00', '3.40', '0.60', '0.00', '1.00'),
(66, 'quinoa 100g', '354.00', '57.20', '14.10', '6.10', '0.10'),
(67, 'ryba 100 gram', '243.00', '0.00', '19.30', '18.30', '0.10'),
(68, 'ryz brazowy suchy 100 gram', '363.00', '74.00', '8.60', '3.10', '0.25'),
(69, 'salata 100 gram', '14.00', '3.00', '0.90', '0.10', '0.10'),
(70, 'seler pieczony 100 gram', '57.11', '7.63', '1.58', '2.05', '0.10'),
(71, 'ser bialy 100 gram', '133.00', '3.70', '18.70', '4.70', '0.10'),
(72, 'ser p-lesniowy niebieski 100 gram', '356.00', '0.00', '19.40', '31.20', '0.10'),
(73, 'siemie lniane 100 gram', '509.00', '31.40', '24.50', '33.36', '0.05'),
(74, 'slonecznik 100 gram', '647.00', '13.00', '18.00', '56.50', '0.05'),
(75, 'soczewica sucha 100 gram', '307.00', '43.00', '21.00', '1.50', '0.10'),
(76, 'sok pomaranczowy100 ml', '41.00', '9.00', '0.80', '0.20', '0.10'),
(77, 'sos sojowy 100 ml', '73.00', '8.10', '9.30', '0.60', '0.05'),
(78, 'szparag zielony sztuka', '5.00', '1.10', '0.60', '0.10', '1.00'),
(79, 'szpinak 100 gram', '16.00', '3.00', '2.60', '0.40', '0.10'),
(80, 'Tunczyk 100g', '110.00', '0.00', '25.10', '0.90', '0.10'),
(81, 'wafel ryzowy jeden', '29.40', '5.90', '0.80', '0.20', '1.00'),
(82, 'winogrona 100 gram', '69.00', '17.60', '0.50', '0.20', '0.10'),
(83, 'wolowina 100 gram', '110.00', '0.00', '22.00', '2.30', '0.10'),
(84, 'ziemniaki gotowane 100 gram', '78.00', '17.00', '2.90', '0.10', '0.10'),
(85, 'ziemniaki pieczone 100 gr', '136.00', '31.70', '3.90', '0.20', '0.10');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `breakfasts`
--

CREATE TABLE `breakfasts` (
  `ID` int(11) NOT NULL,
  `name` varchar(36) DEFAULT NULL,
  `ingredient_1` varchar(28) DEFAULT NULL,
  `ingredient_2` varchar(21) DEFAULT NULL,
  `ingredient_3` varchar(21) DEFAULT NULL,
  `ingredient_4` varchar(16) DEFAULT NULL,
  `ingredient_5` varchar(10) DEFAULT NULL,
  `ingredient_6` varchar(10) DEFAULT NULL,
  `constraint_1` varchar(10) DEFAULT NULL,
  `constraint_2` varchar(10) DEFAULT NULL,
  `constraint_3` varchar(10) DEFAULT NULL,
  `constraint_4` varchar(10) DEFAULT NULL,
  `constraint_5` varchar(10) DEFAULT NULL,
  `constraint_6` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `breakfasts`
--

INSERT INTO `breakfasts` (`ID`, `name`, `ingredient_1`, `ingredient_2`, `ingredient_3`, `ingredient_4`, `ingredient_5`, `ingredient_6`, `constraint_1`, `constraint_2`, `constraint_3`, `constraint_4`, `constraint_5`, `constraint_6`) VALUES
(1, 'Jajka sadzone z chlebem', 'jajko srednie sadzone', 'chleb 100 gram', NULL, NULL, NULL, NULL, '1', '0.5', NULL, NULL, NULL, NULL),
(2, 'Kasza jaglana z miodem i malinami', 'kasza jaglana sucha 100 gram', 'maliny 100 gram', 'miod 100 gram', NULL, NULL, NULL, '0.25', '0.15', '0.05', NULL, NULL, NULL),
(3, 'Musli z borowkami', 'musli 100 gram', 'mleko kozie 100gram', 'jogurt 100 gr', 'borowki 100 gram', NULL, NULL, '0.25', '0.25', '0.25', '0.15', NULL, NULL),
(4, 'Nalesniki z musem jablkowym i miodem', 'nalesnik sztuka', 'mus jablkowy 100 gram', 'miod 100 gram', NULL, NULL, NULL, '1', '0.1', '0.1', NULL, NULL, NULL),
(5, 'Kanapki z serem bialym', 'chleb 100 gram', 'ser bialy 100 gram', NULL, NULL, NULL, NULL, '0.5', '0.1', NULL, NULL, NULL, NULL),
(6, 'musli z owocami', 'musli 100 gram', 'mleko kozie 100gram', 'maliny 100 gram', 'banan 100 gr', NULL, NULL, '0.25', '0.5', '0.1', '0.1', NULL, NULL),
(7, 'Jajka sadzone na szpinaku', 'jajko srednie sadzone', 'szpinak 100 gram', 'pomidor suszony jeden', NULL, NULL, NULL, '1', '0.25', '1', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dinners`
--

CREATE TABLE `dinners` (
  `ID` int(11) NOT NULL,
  `name` varchar(43) DEFAULT NULL,
  `ingredient_1` varchar(29) DEFAULT NULL,
  `ingredient_2` varchar(33) DEFAULT NULL,
  `ingredient_3` varchar(25) DEFAULT NULL,
  `ingredient_4` varchar(25) DEFAULT NULL,
  `ingredient_5` varchar(29) DEFAULT NULL,
  `ingredient_6` varchar(10) DEFAULT NULL,
  `constraint_1` varchar(10) DEFAULT NULL,
  `constraint_2` varchar(10) DEFAULT NULL,
  `constraint_3` varchar(10) DEFAULT NULL,
  `constraint_4` varchar(10) DEFAULT NULL,
  `constraint_5` varchar(10) DEFAULT NULL,
  `constraint_6` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `dinners`
--

INSERT INTO `dinners` (`ID`, `name`, `ingredient_1`, `ingredient_2`, `ingredient_3`, `ingredient_4`, `ingredient_5`, `ingredient_6`, `constraint_1`, `constraint_2`, `constraint_3`, `constraint_4`, `constraint_5`, `constraint_6`) VALUES
(1, 'Indyk pieczony z warzywami', 'indyk piers 100 gram pieczony', 'maslo 5 gram', 'pomidor', 'kukurydza puszka 100 gram', NULL, NULL, '0.5', '1', '0.5', '0.25', NULL, NULL),
(2, 'Makaron z warzywami i indykiem pieczonym', 'makaron 100 gr', 'passata 100 gram', 'kukurydza puszka 100 gram', 'papryka 100 gram', 'indyk piers 100 gram pieczony', NULL, '0.2', '0.15', '0.05', '0.05', '0.1', NULL),
(3, 'Ryz z warzywami i tunczykiem', 'ryz brazowy suchy 100 gram', 'fasolka zielona 100 gram', 'Tunczyk 100g', 'pomidor suszony jeden', 'groszek 100 gram', NULL, '0.2', '0.05', '0.05', '1', '0.05', NULL),
(4, 'Indyk pieczony z ziemniakami i papryka', 'indyk piers 100 gram pieczony', 'ziemniaki pieczone 100 gr', 'papryka 100 gram', NULL, NULL, NULL, '0.2', '0.2', '0.1', NULL, NULL, NULL),
(5, 'Cukinia zapiekana z serem plesniowym', 'cukinia 100 gram', 'ser p-lesniowy niebieski 100 gram', NULL, NULL, NULL, NULL, '6', '0.2', NULL, NULL, NULL, NULL),
(6, 'Mieszanka orientalna z ryzem', 'mieszanka chinska 100 gram', 'ryz brazowy suchy 100 gram', NULL, NULL, NULL, NULL, '0.3', '0.1', NULL, NULL, NULL, NULL),
(7, 'Mieszanka orientalna z makaronem i wolowina', 'mieszanka chinska 100 gram', 'makaron 100 gr', 'wolowina 100 gram', 'passata 100 gram', NULL, NULL, '0.3', '0.1', '0.1', '0.1', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `snacks`
--

CREATE TABLE `snacks` (
  `ID` int(11) NOT NULL,
  `name` varchar(62) DEFAULT NULL,
  `ingredient_1` varchar(26) DEFAULT NULL,
  `ingredient_2` varchar(33) DEFAULT NULL,
  `ingredient_3` varchar(29) DEFAULT NULL,
  `ingredient_4` varchar(19) DEFAULT NULL,
  `ingredient_5` varchar(31) DEFAULT NULL,
  `ingredient_6` varchar(10) DEFAULT NULL,
  `constraint_1` varchar(10) DEFAULT NULL,
  `constraint_2` varchar(10) DEFAULT NULL,
  `constraint_3` varchar(10) DEFAULT NULL,
  `constraint_4` varchar(10) DEFAULT NULL,
  `constraint_5` varchar(10) DEFAULT NULL,
  `constraint_6` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `snacks`
--

INSERT INTO `snacks` (`ID`, `name`, `ingredient_1`, `ingredient_2`, `ingredient_3`, `ingredient_4`, `ingredient_5`, `ingredient_6`, `constraint_1`, `constraint_2`, `constraint_3`, `constraint_4`, `constraint_5`, `constraint_6`) VALUES
(1, 'Salatka z serem feta i chlebem', 'chleb 100 gram', 'oliwki 100 gram', 'feta 100 gram', 'ogorek 100 gram', NULL, NULL, '0.25', '0.1', '0.15', '0.5', NULL, NULL),
(2, 'Makaron z groszkiem i cukinia', 'makaron 100 gr', 'groszek 100 gram', 'passata 100 gram', 'cukinia 100 gram', NULL, NULL, '0.2', '0.1', '0.1', '0.1', NULL, NULL),
(3, 'Salatka capresse', 'mozarella 100 gram', 'pomidor', NULL, NULL, NULL, NULL, '0.2', '0.1', NULL, NULL, NULL, NULL),
(4, 'Kanapki z lososiem', 'losos wedzony 100 gram', 'chleb 100 gram', NULL, NULL, NULL, NULL, '0.1', '0.25', NULL, NULL, NULL, NULL),
(5, 'Ryz z groszkiem, slonecznikiem i pomidorami suszonymi', 'ryz brazowy suchy 100 gram', 'groszek 100 gram', 'pomidor suszony jeden', 'slonecznik 100 gram', NULL, NULL, '0.2', '0.1', '1', '0.02', NULL, NULL),
(6, 'Pasta z lososia, sera bialego i awokado', 'losos wedzony 100 gram', 'chleb 100 gram', 'ser bialy 100 gram', 'awokado 1 owoc', NULL, NULL, '0.2', '0.5', '0.5', '0.2', NULL, NULL),
(7, 'Ziemniaki pieczone z jogurtem', 'ziemniaki pieczone 100 gr', 'jogurt 100 gr', NULL, NULL, NULL, NULL, '0.1', '0.25', NULL, NULL, NULL, NULL),
(8, 'Salatka warzywna z fasola czerwona', 'salata 100 gram', 'papryka 100 gram', 'pomidor', 'oliwki 100 gram', 'fasola czerwona surowa 100 gram', NULL, '0.1', '0.1', '0.5', '0.1', '0.1', NULL),
(9, 'Salatka z serem niebieskim i indykiem', 'salata 100 gram', 'ser p-lesniowy niebieski 100 gram', 'indyk piers 100 gram pieczony', 'oliwki 100 gram', NULL, NULL, '0.1', '0.1', '0.2', '0.05', NULL, NULL),
(10, 'Kanapki z serem bialym, suszonym pomidorem, ogorkiem i papryka', 'chleb 100 gram', 'ser bialy 100 gram', 'ogorek 100 gram', 'papryka 100 gram', NULL, NULL, '0.5', '0.1', '0.2', '0.1', NULL, NULL),
(11, 'Salatka z brokulem i serem feta', 'brokul 100 gram', 'feta 100 gram', 'kukurydza puszka 100 gram', 'chleb 100 gram', NULL, NULL, '0.6', '0.1', '0.1', '0.25', NULL, NULL),
(12, 'Guacamole z chlebem', 'awokado 1 owoc', 'pomidor', 'chleb 100 gram', NULL, NULL, NULL, '0.2', '0.2', '0.1', NULL, NULL, NULL),
(13, 'Gruszki i jablka', 'gruszka srednia', 'jablko 100 gr', NULL, NULL, NULL, NULL, '0.5', '1', NULL, NULL, NULL, NULL),
(14, 'Mieszanka orzechow', 'orzechy mieszanka 100 gram', NULL, NULL, NULL, NULL, NULL, '0.1', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `name` text NOT NULL,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `ID` int(6) NOT NULL,
  `password` text NOT NULL,
  `email_key` varchar(255) NOT NULL,
  `email_confirm` tinyint(1) NOT NULL DEFAULT '0',
  `weight` varchar(255) NOT NULL DEFAULT '0',
  `height` varchar(255) NOT NULL DEFAULT '0',
  `age` varchar(255) NOT NULL DEFAULT '0',
  `gender` text,
  `activity` text,
  `bmr` int(255) NOT NULL DEFAULT '0',
  `tmr` int(255) NOT NULL DEFAULT '0',
  `user_carbs` int(255) NOT NULL DEFAULT '0',
  `user_protein` int(255) DEFAULT '0',
  `user_fat` int(255) NOT NULL DEFAULT '0',
  `data_timestamp` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`name`, `username`, `email`, `ID`, `password`, `email_key`, `email_confirm`, `weight`, `height`, `age`, `gender`, `activity`, `bmr`, `tmr`, `user_carbs`, `user_protein`, `user_fat`, `data_timestamp`) VALUES
('Maciej', 'Sandro', 'maciej.jalowiec@gmail.com', 12, '$2y$10$izV0JziIvEEArU98wzOtNu1MK59Tme0EWK5OxB/kqV/hxnAYbQWRa', '0', 1, '60', '175', '26', 'male', '2', 1725, 2215, 383, 90, 36, '2016-11-26 17:51:38'),
('kjshfk', 'lsjdflks', 'jsfld@', 4, 'kajshfd', '', 0, '', '0', '', '', '', 0, 0, 0, 0, 0, ''),
('Maciej Jalowiec', 'Sandro2', 'maciej.jalowiec@perfectworld.com', 9, '$2y$10$6/d7zSgUIhTgu811k/mu3eoLVpKc5HoYAoyP3EElRBhMiGDqyFx/6', 'a614df35e4de263364c71316dcac38b3', 0, '', '0', '', '', '', 0, 0, 0, 0, 0, ''),
('A', '456', 'mkooo@buziaczek.pl', 10, '$2y$10$Q5wia7WL6UVKVXUt4QpQKuJU022jyUzlfF/rX0yx6sPXi1hR74NlC', '6cfe5d7303d2d3aa76e9ca42fe6823c1', 0, '', '0', '', '', '', 0, 0, 0, 0, 0, ''),
('Maciej', 'Maciej', 'sandrowarlock@poczta.fm', 14, '$2y$10$J76DzeYSDqQclIjbtWLnpOfyzKEkE1ZemHUaS4wETrJJm3D0IYpJa', '0', 1, '60', '175', '26', 'male', '2', 1725, 2215, 383, 90, 36, '2017-01-06 16:54:12');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `breakfasts`
--
ALTER TABLE `breakfasts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `dinners`
--
ALTER TABLE `dinners`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `snacks`
--
ALTER TABLE `snacks`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD KEY `ID_2` (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `articles`
--
ALTER TABLE `articles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT dla tabeli `breakfasts`
--
ALTER TABLE `breakfasts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT dla tabeli `dinners`
--
ALTER TABLE `dinners`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT dla tabeli `snacks`
--
ALTER TABLE `snacks`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
