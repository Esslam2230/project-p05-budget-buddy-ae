-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2025 at 12:19 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `budget_buddy`
--
CREATE DATABASE IF NOT EXISTS `budget_buddy` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `budget_buddy`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `income_expense` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `income_expense`, `description`) VALUES
(1, 'Salaris', 'income', 'Loon dat iemand ontvangt voor verrichte arbeid.'),
(2, 'Vakantiegeld', 'income', 'Extra inkomen dat jaarlijks wordt uitgekeerd bij vakantie.'),
(3, 'Bonus', 'income', 'Extra beloning bovenop het salaris voor goede prestaties.'),
(4, 'Kinderbijslag', 'income', 'Overheidsbijdrage aan ouders voor de kosten van kinderen.'),
(5, 'Huurinkomsten', 'income', 'Inkomen uit het verhuren van een woning of kamer.'),
(6, 'Uitkering', 'income', 'Inkomen vanuit de overheid, zoals WW of bijstand.'),
(7, 'Studiefinanciering', 'income', 'Maandelijkse bijdrage van DUO voor studenten.'),
(8, 'Rente', 'income', 'Inkomen uit spaargeld of beleggingen.'),
(9, 'Belastingteruggave', 'income', 'Geld dat wordt terugbetaald door de Belastingdienst.'),
(10, 'Erfenis', 'income', 'Geld of bezittingen ontvangen na overlijden van een familielid.'),
(11, 'Huur', 'expense', 'Maandelijkse betaling voor woonruimte.'),
(12, 'Boodschappen', 'expense', 'Kosten voor eten, drinken en huishoudelijke producten.'),
(13, 'Energie', 'expense', 'Kosten voor gas, water en elektriciteit.'),
(14, 'Verzekeringen', 'expense', 'Premies voor zorg-, auto- of inboedelverzekeringen.'),
(15, 'Abonnementen', 'expense', 'Kosten voor diensten zoals Netflix of sportschool.'),
(16, 'Vervoer', 'expense', 'Uitgaven aan OV, brandstof of onderhoud van voertuigen.'),
(17, 'Kleding', 'expense', 'Aankoop van kleding en schoenen.'),
(18, 'Schoolkosten', 'expense', 'Kosten voor boeken, lesgeld of materialen.'),
(19, 'Vrije tijd', 'expense', 'Uitgaven aan hobby’s, uitjes of entertainment.'),
(20, 'Zorgkosten', 'expense', 'Kosten voor medicijnen, tandarts of ziekenhuis.');

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20251015082306', '2025-10-27 09:28:43', 190),
('DoctrineMigrations\\Version20251017095000', '2025-10-27 09:28:43', 133);

-- --------------------------------------------------------

--
-- Table structure for table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `amount` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `country` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phonenumber` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `birthday`, `country`, `address`, `email`, `phonenumber`) VALUES
(1, 'aaaaaaa', 'aaaaaaa', '2025-10-01', 'aaaaaaa', 'aaaaaaa', 'aaaaaaa', 'aaaaaaa'),
(2, 'eeeeeeeee', 'eeeeeeeee', '2025-10-02', 'eeeeeeeee', 'eeeeeeeee', 'eeeeeeeee', 'eeeeeeeee'),
(3, 'amina', 'amina', '2020-01-01', 'amina', 'amina', 'aina', 'amina'),
(4, 'esalm', 'esalm', '2020-01-01', 'esalm', 'esalm', 'esalm', 'esalm'),
(5, 'fsdf', 'fdsf', '2020-01-01', 'fsd', 'fsf', 'fss@fsdf.nl', '123'),
(6, 'fsdf', 'fdsf', '2020-01-01', 'fsd', 'fsf', 'fss@fsdf.nl', '123'),
(7, 'fsdf', 'fdsf', '2020-01-01', 'fsd', 'fsf', 'fss@fsdf.nl', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_723705D1A76ED395` (`user_id`),
  ADD KEY `IDX_723705D112469DE2` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `FK_723705D112469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `FK_723705D1A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
