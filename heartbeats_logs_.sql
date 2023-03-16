-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2023 at 12:57 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `heartbeats_logs*`
--

-- --------------------------------------------------------

--
-- Table structure for table `genders`
--

CREATE TABLE `genders` (
  `type` int(11) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genders`
--

INSERT INTO `genders` (`type`, `name`) VALUES
(1, 'male'),
(2, 'female'),
(3, 'feur');

-- --------------------------------------------------------

--
-- Table structure for table `login_info`
--

CREATE TABLE `login_info` (
  `id` int(11) NOT NULL,
  `user_id_enc` varchar(255) NOT NULL,
  `user_email_enc` varchar(255) NOT NULL,
  `user_pass_enc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `preco`
--

CREATE TABLE `preco` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `preco`
--

INSERT INTO `preco` (`id`, `email`) VALUES
(2, 'maxdel45@outlook.fr'),
(3, 'ivan.infante33@gmail.com'),
(4, 'bruce.lhorset@eleve.isep.fr'),
(8, 'aymeric-nicolas@hotmail.fr'),
(9, 'lisa.bonvalet@gmail.com'),
(10, 'red.h0x50@gmail.com'),
(11, 'alex.delorme.pro@gmail.com'),
(12, 'ilanzahler67@gmail.com'),
(13, 'matthieu.delarue5@gmail.com'),
(14, 'raph.carabeuf@gmail.com'),
(19, 'helgriv@gmail.com'),
(22, 'iinfante@juniorisep.com'),
(23, 'alexandre.delorme@edu.heip.fr'),
(25, 'mdel01808@gmail.com'),
(27, 'river.ours@gmail.com'),
(29, 'lachankra@gmail.com'),
(30, 'aymeric.nicolas@eleve.isep.fr'),
(31, 'eme92130@gmail.com'),
(33, 'ghislain.demael@gmail.com'),
(34, 'ghislain.demael@eleve.isep.fr'),
(35, 'seljaouhari@isep.fr'),
(36, 'daniel.leurquin@eleve.isep.fr'),
(37, 'melina.magnifique@gmail.com'),
(38, 'maximilien.quignard@eleve.isep.fr'),
(40, 'blopblop@gmail.com'),
(41, 'jnjno@ff.com'),
(42, 'clemdebayser@yahoo.fr'),
(240, 'mithun92ntv@gmail.com'),
(245, 'bbordes+hb@protonmail.com'),
(246, 'maximilien-marie.delorme@eleve.isep.fr'),
(247, 'chloe.ortega20@gmail.com'),
(248, 'hello@gmail.com'),
(249, 'tugdualk@hotmail.com'),
(251, 'jeanmicheljarre@jeamicheljarreofficielmillepourcent.legit'),
(254, 'emileazema5317@gmail.com'),
(256, 'napew60234@botsoko.com'),
(257, 'kukuLeClow@isep.fr'),
(258, 'heartbeats.fr@gmail.com'),
(259, 'bruno.maciel@edu.heip.fr'),
(260, 'lepetitarvin@gmail.com'),
(261, 'chaigneaunicolas25@gmail.com'),
(262, 'mamalec91@gmail.com'),
(263, 'marius.lecocq13@gmail.com'),
(264, 'elena.charpentier456@hotmail.fr'),
(265, 'foo-bar@example.com'),
(266, 'arthuriviere@yahoo.com'),
(267, 'romain.malterre-ngo1@hotmail.com'),
(268, 'alexisjacquet9@gmail.com'),
(269, 'lujv61432@eleve.isep.fr'),
(270, 'Christophem551@gmail.com'),
(271, 'malaubrun@gmail.com'),
(272, 'admin@admin.fr'),
(273, 'test@test.test'),
(274, 'paul.stiegler@hotmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` int(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `mail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `name`, `password`, `mail`) VALUES
(6, 'Matthew', '$2y$10$AL9RTeoucu9bAqdIb70DJOxsiwbnZt9AHQVYFckjKqHeXG1sENCka', 'matthieu.delarue5@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

CREATE TABLE `userdata` (
  `id` int(255) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `device id` varchar(10) DEFAULT NULL,
  `added date` varchar(10) DEFAULT NULL,
  `device connected` varchar(5) DEFAULT NULL,
  `device mode` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`id`, `mail`, `device id`, `added date`, `device connected`, `device mode`) VALUES
(10, 'matthieu.delarue5@gmail.com', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cle` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL DEFAULT 'full name',
  `date_verified` int(11) NOT NULL DEFAULT current_timestamp(),
  `date_created` bigint(20) NOT NULL,
  `user_role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login_info`
--
ALTER TABLE `login_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `preco`
--
ALTER TABLE `preco`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- Indexes for table `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD UNIQUE KEY `device id` (`device id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`user_role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login_info`
--
ALTER TABLE `login_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `preco`
--
ALTER TABLE `preco`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=275;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `userdata`
--
ALTER TABLE `userdata`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
