-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2024 at 12:58 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tiki_taki_tow_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `players_info_tbl`
--

CREATE TABLE `players_info_tbl` (
  `player_ID` int(11) NOT NULL,
  `Last_Name` varchar(256) NOT NULL,
  `First_Name` varchar(256) NOT NULL,
  `Username` varchar(256) NOT NULL,
  `Password` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `players_info_tbl`
--

INSERT INTO `players_info_tbl` (`player_ID`, `Last_Name`, `First_Name`, `Username`, `Password`) VALUES
(1, 'Dela Cruz', 'Juan', 'juanD', '$2y$10$kjuHoqImYMHEHVMytOpA4OgeySGgAOqe3Te5o5bLknpYvmetd9jQm'),
(2, 'Juana', 'Mary', 'maria_hiwaga', '$2y$10$AYEasxSX8ps.710Xz6GP.OwzaxF4/.HU2vuTDxvPN2zgCVJHYL4XK'),
(3, 'papa', 'Admin', 'admin_papa', '$2y$10$6hgDm3ZrGCrwQPwuQqJ7huFGKCtKXxSuCUb4NU4I/QB0kVB2aKiaO'),
(4, 'papa', 'monde', 'mondemonde', '$2y$10$gO4ai3bqkBcg5/Kwo0pZZeMtWK2KzucWvK8FUhkUbfb.7S8VQE1IW'),
(5, 'admin', 'sample', 'admin_sample', '$2y$10$CWPs3k7MLMsZpNyBUehUkOjFF1aC5wptGzbXcxBOENDSFunefWst.'),
(6, 'tiki', 'taki', 'tiki_taki', '$2y$10$u0gSif0XMiG914HSUq.VTuoVtUaTGQKXIZLOPTbsegTrZzeZIevNW');

-- --------------------------------------------------------

--
-- Table structure for table `scoreboard_ai_tbl`
--

CREATE TABLE `scoreboard_ai_tbl` (
  `match_id` int(11) NOT NULL,
  `player_ID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Opponent_Name` varchar(255) NOT NULL,
  `Match_Date` varchar(255) NOT NULL,
  `Score` varchar(15) NOT NULL,
  `Winner_Name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scoreboard_ai_tbl`
--

INSERT INTO `scoreboard_ai_tbl` (`match_id`, `player_ID`, `Username`, `Opponent_Name`, `Match_Date`, `Score`, `Winner_Name`) VALUES
(7, 6, 'tiki_taki', 'Computer AI: Expert', '02-19-2024 6:39:35 PM', '5 - 3', 'tiki_taki'),
(8, 6, 'tiki_taki', 'Computer AI: Easy', '02-19-2024 6:39:51 PM', '5 - 0', 'tiki_taki'),
(9, 6, 'tiki_taki', 'Computer AI: Difficult', '02-19-2024 6:40:34 PM', '5 - 2', 'tiki_taki'),
(10, 6, 'tiki_taki', 'Computer AI: Expert', '02-19-2024 6:49:46 PM', '0 - 5', 'Computer AI: Expert'),
(11, 2, 'maria_hiwaga', 'Computer AI: Easy', '02-19-2024 7:34:18 PM', '5 - 0', 'maria_hiwaga'),
(12, 2, 'maria_hiwaga', 'Computer AI: Easy', '02-19-2024 7:38:00 PM', '5 - 0', 'maria_hiwaga'),
(13, 2, 'maria_hiwaga', 'Computer AI: Easy', '02-19-2024 7:38:19 PM', '5 - 0', 'maria_hiwaga'),
(14, 2, 'maria_hiwaga', 'Computer AI: Easy', '02-19-2024 7:38:31 PM', '5 - 0', 'maria_hiwaga'),
(15, 2, 'maria_hiwaga', 'Computer AI: Easy', '02-19-2024 7:38:46 PM', '5 - 0', 'maria_hiwaga'),
(16, 2, 'maria_hiwaga', 'Computer AI: Easy', '02-19-2024 7:38:59 PM', '5 - 0', 'maria_hiwaga'),
(17, 2, 'maria_hiwaga', 'Computer AI: Expert', '02-19-2024 7:39:47 PM', '0 - 5', 'Computer AI: Expert'),
(19, 2, 'maria_hiwaga', 'Computer AI: Easy', '02-19-2024 7:55:28 PM', '5 - 0', 'maria_hiwaga'),
(20, 2, 'maria_hiwaga', 'Computer AI: Easy', '02-19-2024 7:56:41 PM', '5 - 0', 'maria_hiwaga');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `players_info_tbl`
--
ALTER TABLE `players_info_tbl`
  ADD PRIMARY KEY (`player_ID`);

--
-- Indexes for table `scoreboard_ai_tbl`
--
ALTER TABLE `scoreboard_ai_tbl`
  ADD PRIMARY KEY (`match_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `players_info_tbl`
--
ALTER TABLE `players_info_tbl`
  MODIFY `player_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `scoreboard_ai_tbl`
--
ALTER TABLE `scoreboard_ai_tbl`
  MODIFY `match_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
