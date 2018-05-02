-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 02, 2018 at 03:23 PM
-- Server version: 10.1.23-MariaDB-9+deb9u1
-- PHP Version: 7.0.27-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Wooamye`
--

-- --------------------------------------------------------

--
-- Table structure for table `caracteristique`
--

CREATE TABLE `caracteristique` (
  `ID` int(11) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `lunette` varchar(255) NOT NULL,
  `barbe` varchar(255) NOT NULL,
  `cheveux` varchar(255) NOT NULL,
  `chapeau` varchar(255) NOT NULL,
  `ral` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `caracteristique`
--

INSERT INTO `caracteristique` (`ID`, `genre`, `lunette`, `barbe`, `cheveux`, `chapeau`, `ral`) VALUES
(1, 'homme', 'non', 'oui', 'oui', 'oui', 'non'),
(2, 'homme', 'oui', 'non', 'oui', 'oui', 'non'),
(3, 'homme', 'oui', 'oui', 'non', 'oui', 'non'),
(4, 'homme', 'oui', 'oui', 'oui', 'non', 'non'),
(5, 'homme', 'non', 'non', 'oui', 'oui', 'non'),
(6, 'homme', 'oui', 'non', 'non', 'oui', 'non'),
(7, 'homme', 'oui', 'oui', 'non', 'non', 'non'),
(8, 'homme', 'oui', 'non', 'oui', 'non', 'non'),
(9, 'homme', 'non', 'oui', 'non', 'oui', 'non'),
(10, 'homme', 'non', 'oui', 'oui', 'non', 'non'),
(11, 'homme', 'oui', 'non', 'non', 'non', 'non'),
(12, 'homme', 'non', 'oui', 'non', 'non', 'non'),
(13, 'homme', 'non', 'non', 'oui', 'non', 'non'),
(14, 'homme', 'non', 'non', 'non', 'oui', 'non'),
(15, 'homme', 'oui', 'oui', 'oui', 'oui', 'non'),
(16, 'homme', 'non', 'non', 'non', 'non', 'non'),
(17, 'femme', 'oui', 'non', 'oui', 'non', 'oui'),
(18, 'femme', 'non', 'non', 'oui', 'oui', 'oui'),
(19, 'femme', 'oui', 'non', 'oui', 'oui', 'non'),
(20, 'femme', 'oui', 'non', 'non', 'oui', 'oui'),
(21, 'femme', 'non', 'non', 'oui', 'oui', 'non'),
(22, 'femme', 'oui', 'non', 'non', 'oui', 'non'),
(23, 'femme', 'oui', 'non', 'non', 'non', 'oui'),
(24, 'femme', 'oui', 'non', 'oui', 'non', 'non'),
(25, 'femme', 'non', 'non', 'non', 'oui', 'oui'),
(26, 'femme', 'non', 'non', 'oui', 'non', 'oui'),
(27, 'femme', 'oui', 'non', 'non', 'non', 'non'),
(28, 'femme', 'non', 'non', 'non', 'non', 'oui'),
(29, 'femme', 'non', 'non', 'oui', 'non', 'non'),
(30, 'femme', 'non', 'non', 'non', 'oui', 'non'),
(31, 'femme', 'oui', 'non', 'oui', 'oui', 'oui'),
(32, 'femme', 'non', 'non', 'non', 'non', 'non');

-- --------------------------------------------------------

--
-- Table structure for table `Decks`
--

CREATE TABLE `Decks` (
  `ID` int(11) NOT NULL,
  `decks` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `id_car` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Decks`
--

INSERT INTO `Decks` (`ID`, `decks`, `image`, `id_car`) VALUES
(2004, 'NewDeck', 'assets/images/image5ae98325332f5.jpeg', 1),
(2005, 'NewDeck', 'assets/images/image5ae983253333a.jpeg', 2),
(2006, 'NewDeck', 'assets/images/image5ae9832533379.jpeg', 3),
(2007, 'NewDeck', 'assets/images/image5ae98325333b8.jpeg', 4),
(2008, 'NewDeck', 'assets/images/image5ae98325333f7.jpeg', 5),
(2009, 'NewDeck', 'assets/images/image5ae9832533435.jpeg', 6),
(2010, 'NewDeck', 'assets/images/image5ae9832533473.jpeg', 7),
(2011, 'NewDeck', 'assets/images/image5ae98325334b1.jpeg', 8),
(2012, 'NewDeck', 'assets/images/image5ae98325334ef.jpeg', 9),
(2013, 'NewDeck', 'assets/images/image5ae983253353b.jpeg', 10),
(2014, 'NewDeck', 'assets/images/image5ae983253357a.jpeg', 11),
(2015, 'NewDeck', 'assets/images/image5ae98325335b8.jpeg', 12),
(2016, 'NewDeck', 'assets/images/image5ae98325335f6.jpeg', 13),
(2017, 'NewDeck', 'assets/images/image5ae9832533634.jpeg', 14),
(2018, 'NewDeck', 'assets/images/image5ae9832533672.jpeg', 15),
(2019, 'NewDeck', 'assets/images/image5ae98325336b0.jpeg', 16),
(2020, 'NewDeck', 'assets/images/image5ae98325336ef.jpeg', 17),
(2021, 'NewDeck', 'assets/images/image5ae983253372d.jpeg', 18),
(2022, 'NewDeck', 'assets/images/image5ae983253376b.jpeg', 19),
(2023, 'NewDeck', 'assets/images/image5ae98325337a9.jpeg', 20),
(2024, 'NewDeck', 'assets/images/image5ae98325337e9.jpeg', 21),
(2025, 'NewDeck', 'assets/images/image5ae9832533828.jpeg', 22),
(2026, 'NewDeck', 'assets/images/image5ae9832533866.jpeg', 23),
(2027, 'NewDeck', 'assets/images/image5ae98325338a4.jpeg', 24),
(2028, 'NewDeck', 'assets/images/image5ae98325338e2.jpeg', 25),
(2029, 'NewDeck', 'assets/images/image5ae9832533942.jpeg', 26),
(2030, 'NewDeck', 'assets/images/image5ae983253398a.jpeg', 27),
(2031, 'NewDeck', 'assets/images/image5ae98325339cd.jpeg', 28),
(2032, 'NewDeck', 'assets/images/image5ae9832533a08.jpeg', 29),
(2033, 'NewDeck', 'assets/images/image5ae9832533a40.jpeg', 30),
(2034, 'NewDeck', 'assets/images/image5ae9832533a80.jpeg', 31),
(2035, 'NewDeck', 'assets/images/image5ae9832533abe.jpeg', 32);

-- --------------------------------------------------------

--
-- Table structure for table `Score`
--

CREATE TABLE `Score` (
  `ID` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Score`
--

INSERT INTO `Score` (`ID`, `pseudo`, `score`) VALUES
(356, 'Hasan', 53),
(357, 'hasan', 46),
(358, 'hasan', 0),
(359, 'aze', 143);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `caracteristique`
--
ALTER TABLE `caracteristique`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Decks`
--
ALTER TABLE `Decks`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `id_car` (`id_car`);

--
-- Indexes for table `Score`
--
ALTER TABLE `Score`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `caracteristique`
--
ALTER TABLE `caracteristique`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `Decks`
--
ALTER TABLE `Decks`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2036;
--
-- AUTO_INCREMENT for table `Score`
--
ALTER TABLE `Score`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=360;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Decks`
--
ALTER TABLE `Decks`
  ADD CONSTRAINT `Decks_ibfk_1` FOREIGN KEY (`id_car`) REFERENCES `caracteristique` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
