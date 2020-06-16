-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2020 at 04:51 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `revision_back`
--

-- --------------------------------------------------------

--
-- Table structure for table `hosters`
--

CREATE TABLE `hosters` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `date` date NOT NULL,
  `trust_status` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hosters`
--

INSERT INTO `hosters` (`ID`, `name`, `username`, `password`, `email`, `phone`, `date`, `trust_status`) VALUES
(23, 'Amr Ahmed', 'Amr', '$2y$10$ryxS497.FtHCne9G8MTyueYVovH9ZXSWiXzXjnVE7ooc.LDgV8PiO', 'dasda@rtrrt.com', 1254886, '2020-06-14', 2),
(24, 'Ahmed Abdel-Fattah', 'Ahmed', '$2y$10$UYoG0b72W.oRtyLk.jp53OzgxzVc1FGJsNnJQVb9m3UFzlQEDP6GK', 'asdasfdsfsd@fdsfds.fd', 1022635745, '2020-06-14', 1),
(25, 'Ahmed Marouf', 'Ahmed_MaRF', '$2y$10$O1j7eCtHTMQqYH1.m13otOmlvLARsI4zXhBCg3qAOLJ22.cSr.Yc.', 'marouf@gmail.com', 12458756, '2020-06-14', 1),
(26, 'MTTArrrr', 'MAT_2020', '$2y$10$g0iKoPNu0i25prCywAEhaego9j0ulloUz4D7up9SZl1FZ6ekymZ5i', 'ada@fff.cd', 145626, '2020-06-14', 2),
(27, 'Mahmoud Yasser', 'Mahmoud', '$2y$10$EWWKhSJOZ.oAdGnfHhmsgeYs0ixN4FHefk0yj5aF0X.bHsKqkPKtq', 'Mahm7852@gmail.com', 453386, '2020-06-14', 1),
(28, 'Ahmed Ali', 'ALI_AHMED', '$2y$10$s7cAD/EdRbEgOJY4fk06deFCxQHF1XT4RQF84XUfqir.Q59j1h5Y6', 'asdad@fffff.ee', 47778899, '2020-06-14', 2),
(29, 'Ahmed Eldesoky', 'Ahmed_DES', '$2y$10$QmZPqokmLKWeogLLbtXgce/.yUDl5nD4Uq5GoIpBsGe9ND6MZvpU.', 'DES554@gmail.com', 58766266, '2020-06-14', 1),
(32, 'effee', 'wwee', '$2y$10$488E4NB.W/vuQB/gctet3upqiBDkXEnaOtHExKpJPr3a4Rq8Im7AW', 'ffkk@rre', 775323, '2020-06-14', 2),
(33, 'dsaasd', 'tttee', '$2y$10$lO/e1HPEjqFZlGuncif6Au/UfuXXH2hyXppGDYZ54YfjUgSLGlTPK', 'sccee@eer', 445563, '2020-06-14', 2),
(34, 'nnnvvv', 'iiio', '$2y$10$unjBFqMj8gP8ty3bhxIYNe2eDonbMZqclp./dqYGy0F/crz/IrpuG', 'dddc@dds', 55566668, '2020-06-14', 1),
(35, 'iuygg', 'yyyu', '$2y$10$Li7OGq1urWG7Mt351DKsFeyJQs7iwlOHgDPvj/x.SW62mHBA42VXi', 'cccs@eee', 775555333, '2020-06-14', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hosters`
--
ALTER TABLE `hosters`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hosters`
--
ALTER TABLE `hosters`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
