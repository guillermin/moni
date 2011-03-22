-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 07, 2011 at 09:02 AM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `moni`
--

-- --------------------------------------------------------

--
-- Table structure for table `drains`
--

CREATE TABLE IF NOT EXISTS `drains` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=65 ;

--
-- Dumping data for table `drains`
--

INSERT INTO `drains` (`id`, `parent_id`) VALUES
(1, NULL),
(4, NULL),
(8, NULL),
(11, NULL),
(17, NULL),
(24, NULL),
(28, NULL),
(32, NULL),
(36, NULL),
(43, NULL),
(49, NULL),
(52, NULL),
(60, NULL),
(2, 1),
(3, 1),
(5, 4),
(6, 4),
(7, 4),
(9, 8),
(10, 8),
(12, 11),
(13, 11),
(14, 11),
(15, 11),
(16, 11),
(18, 17),
(19, 17),
(20, 17),
(21, 17),
(22, 17),
(23, 17),
(25, 24),
(26, 24),
(27, 24),
(29, 28),
(30, 28),
(31, 28),
(33, 32),
(34, 32),
(35, 32),
(37, 36),
(38, 36),
(39, 36),
(40, 36),
(41, 36),
(42, 36),
(44, 43),
(45, 43),
(46, 43),
(47, 43),
(48, 43),
(50, 49),
(51, 49),
(53, 52),
(54, 52),
(55, 52),
(56, 52),
(57, 52),
(58, 52),
(59, 52),
(61, 60),
(62, 60),
(63, 60),
(64, 60);

-- --------------------------------------------------------

--
-- Table structure for table `drain_languages`
--

CREATE TABLE IF NOT EXISTS `drain_languages` (
  `drain_id` int(10) unsigned NOT NULL,
  `language_id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`drain_id`,`language_id`),
  KEY `language_id` (`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `drain_languages`
--

INSERT INTO `drain_languages` (`drain_id`, `language_id`, `name`, `description`) VALUES
(1, 1, 'Food and non-alcoholic beverages', ''),
(1, 2, 'Alimentos y bebidas no alcohólicas', ''),
(2, 1, 'Food', ''),
(2, 2, 'Alimentos', ''),
(3, 1, 'Non-alcoholic beverages', ''),
(3, 2, 'Bebidas no alcohólicas', ''),
(4, 1, 'Alcoholic beverages, tobacco and narcotics', ''),
(4, 2, 'Bebidas alcohólicas, tabaco y estupefacientes', ''),
(5, 1, 'Alcoholic beverages', ''),
(5, 2, 'Bebidas alcohólicas', ''),
(6, 1, 'Tobacco', ''),
(6, 2, 'Tabaco', ''),
(7, 1, 'Narcotics', ''),
(7, 2, 'Estupefacientes', ''),
(8, 1, 'Clothing and footwear', ''),
(8, 2, 'Prendas de vestir y calzado', ''),
(9, 1, 'Clothing', ''),
(9, 2, 'Prendas de vestir', ''),
(10, 1, 'Footwear', ''),
(10, 2, 'Calzado', ''),
(11, 1, 'Housing, water, electricity, gas and other fuels', ''),
(11, 2, 'Alojamiento, agua, electricidad, gas y otros combustibles', ''),
(12, 1, 'Actual rentals for housing', ''),
(12, 2, 'Alquileres efectivos del alojamiento', ''),
(13, 1, 'Imputed rentals for housing', ''),
(13, 2, 'Alquileres imputados del alojamiento', ''),
(14, 1, 'Maintenance and repair of the dwelling', ''),
(14, 2, 'Conservación y reparación de la vivienda', ''),
(15, 1, 'Water supply and miscellaneous services relating to the dwelling', ''),
(15, 2, 'Suministro de agua y servicios diversos relacionados con la vivienda', ''),
(16, 1, 'Electricity, gas and other fuels', ''),
(16, 2, 'Electricidad, gas y otros combustibles', ''),
(17, 1, 'Furnishings, household equipment and routine household maintenance', ''),
(17, 2, 'Muebles, artículos para el hogar y para la conservación ordinaria del hogar', ''),
(18, 1, 'Furniture and furnishings, carpets and other floor coverings', ''),
(18, 2, 'Muebles y accesorios, alfombras y otros materiales para pisos', ''),
(19, 1, 'Household textiles', ''),
(19, 2, 'Productos textiles para el hogar', ''),
(20, 1, 'Household appliances', ''),
(20, 2, 'Artefactos para el hogar', ''),
(21, 1, 'Glassware, tableware and household utensils', ''),
(21, 2, 'Artículos de vidrio y cristal, vajilla y utensilios para el hogar', ''),
(22, 1, 'Tools and equipment for house and garden', ''),
(22, 2, 'Herramientas y equipo para el hogar y el jardín', ''),
(23, 1, 'Goods and services for routine household maintenance', ''),
(23, 2, 'Bienes y servicios para conservación ordinaria del hogar', ''),
(24, 1, 'Health', ''),
(24, 2, 'Salud', ''),
(25, 1, 'Medical products, appliances and equipment', ''),
(25, 2, 'Productos, artefactos y equipo médicos', ''),
(26, 1, 'Outpatient services', ''),
(26, 2, 'Servicios para pacientes externos', ''),
(27, 1, 'Hospital services', ''),
(27, 2, 'Servicios de hospital', ''),
(28, 1, 'Transport', ''),
(28, 2, 'Transporte', ''),
(29, 1, 'Purchase of vehicles', ''),
(29, 2, 'Adquisición de vehículos', ''),
(30, 1, 'Operation of personal transport equipment', ''),
(30, 2, 'Funcionamiento de equipo de transporte personal', ''),
(31, 1, 'Transport services', ''),
(31, 2, 'Servicios de transporte', ''),
(32, 1, 'Communication', ''),
(32, 2, 'Comunicaciones', ''),
(33, 1, 'Postal services', ''),
(33, 2, 'Servicios postales', ''),
(34, 1, 'Telephone and telefax equipment', ''),
(34, 2, 'Equipo telefónico y de facsímile', ''),
(35, 1, 'Telephone and telefax services', ''),
(35, 2, 'Servicios telefónicos y de facsímile', ''),
(36, 1, 'Recreation and culture', ''),
(36, 2, 'Recreación y cultura', ''),
(37, 1, 'Audio-visual, photographic and information processing equipment', ''),
(37, 2, 'Equipo audiovisual, fotográfico y de procesamiento de información', ''),
(38, 1, 'Other major durables for recreation and culture', ''),
(38, 2, 'Otros productos duraderos importantes para recreación y cultura', ''),
(39, 1, 'Other recreational items and equipment, gardens and pets', ''),
(39, 2, 'Otros artículos y equipo para recreación, jardines y animales domésticos', ''),
(40, 1, 'Recreational and cultural services', ''),
(40, 2, 'Servicios de recreación y culturales', ''),
(41, 1, 'Newspapers, books and stationery', ''),
(41, 2, 'Periódicos, libros y papeles y útiles de oficina', ''),
(42, 1, 'Package holidays', ''),
(42, 2, 'Paquetes turísticos', ''),
(43, 1, 'Education', ''),
(43, 2, 'Educación', ''),
(44, 1, 'Pre-primary and primary education', ''),
(44, 2, 'Enseñanza preescolar y enseñanza primaria', ''),
(45, 1, 'Secondary education', ''),
(45, 2, 'Enseñanza secundaria', ''),
(46, 1, 'Post-secondary non-tertiary education', ''),
(46, 2, 'Enseñanza postsecundaria, no terciaria', ''),
(47, 1, 'Tertiary education', ''),
(47, 2, 'Enseñanza terciaria', ''),
(48, 1, 'Education not definable by level', ''),
(48, 2, 'Enseñanza no atribuible a ningún nivel', ''),
(49, 1, 'Restaurants and hotels', ''),
(49, 2, 'Restaurantes y hoteles', ''),
(50, 1, 'Catering services', ''),
(50, 2, 'Servicios de suministro de comidas por contrato', ''),
(51, 1, 'Accommodation services', ''),
(51, 2, 'Servicios de alojamiento', ''),
(52, 1, 'Miscellaneous goods and services', ''),
(52, 2, 'Bienes y servicios diversos', ''),
(53, 1, 'Personal care', ''),
(53, 2, 'Cuidado personal', ''),
(54, 1, 'Prostitution', ''),
(54, 2, 'Prostitución', ''),
(55, 1, 'Personal effects', ''),
(55, 2, 'Efectos personales', ''),
(56, 1, 'Social protection', ''),
(56, 2, 'Protección social', ''),
(57, 1, 'Insurance', ''),
(57, 2, 'Seguros', ''),
(58, 1, 'Financial services', ''),
(58, 2, 'Servicios financieros', ''),
(59, 1, 'Other services', ''),
(59, 2, 'Otros servicios', ''),
(60, 1, 'Taxes', ''),
(60, 2, 'Impuestos', ''),
(61, 1, 'Income tax', ''),
(61, 2, 'IRPF', 'Impuesto sobre la Renta de las Personas Físicas.'),
(62, 1, 'Social security', ''),
(62, 2, 'Seguridad social', ''),
(63, 1, 'VAT', 'Value Added Tax.'),
(63, 2, 'IVA', 'Impuesto al Valor Agregado.'),
(64, 1, 'Property tax', ''),
(64, 2, 'IBI', 'Impuesto sobre Bienes Inmuebles.');

-- --------------------------------------------------------

--
-- Table structure for table `equities`
--

CREATE TABLE IF NOT EXISTS `equities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `equities`
--

INSERT INTO `equities` (`id`, `user_id`, `name`, `description`) VALUES
(1, 1, 'CajaMadrid', 'Cuenta corriente de Caja Madrid');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE IF NOT EXISTS `expenses` (
  `movement_id` int(10) unsigned NOT NULL,
  `drain_id` int(10) unsigned NOT NULL,
  `amount` int(10) unsigned NOT NULL,
  PRIMARY KEY (`movement_id`,`drain_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expenses`
--


-- --------------------------------------------------------

--
-- Table structure for table `incomes`
--

CREATE TABLE IF NOT EXISTS `incomes` (
  `movement_id` int(10) unsigned NOT NULL,
  `source_id` int(10) unsigned NOT NULL,
  `amount` int(10) unsigned NOT NULL,
  PRIMARY KEY (`movement_id`,`source_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `incomes`
--

INSERT INTO `incomes` (`movement_id`, `source_id`, `amount`) VALUES
(1, 2, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` char(2) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `code`, `name`) VALUES
(1, 'en', 'English'),
(2, 'es', 'Español'),
(3, 'fr', 'Français');

-- --------------------------------------------------------

--
-- Table structure for table `movements`
--

CREATE TABLE IF NOT EXISTS `movements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `timestamp` int(10) unsigned NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `movements`
--

INSERT INTO `movements` (`id`, `user_id`, `timestamp`, `description`) VALUES
(1, 1, 1296938823, '');

-- --------------------------------------------------------

--
-- Table structure for table `sources`
--

CREATE TABLE IF NOT EXISTS `sources` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `sources`
--

INSERT INTO `sources` (`id`, `parent_id`) VALUES
(1, NULL),
(5, NULL),
(2, 1),
(3, 1),
(4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `source_languages`
--

CREATE TABLE IF NOT EXISTS `source_languages` (
  `source_id` int(10) unsigned NOT NULL,
  `language_id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`source_id`,`language_id`),
  KEY `language_id` (`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `source_languages`
--

INSERT INTO `source_languages` (`source_id`, `language_id`, `name`, `description`) VALUES
(1, 1, 'Salary', ''),
(1, 2, 'Salario', ''),
(2, 1, 'Base salary', ''),
(2, 2, 'Salario base', ''),
(3, 1, 'Bonus', ''),
(3, 2, 'Plus', ''),
(4, 1, 'Commission', ''),
(4, 2, 'Comisión', ''),
(5, 1, 'Interest', ''),
(5, 2, 'Interés', '');

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE IF NOT EXISTS `transfers` (
  `movement_id` int(10) unsigned NOT NULL,
  `equity_id` int(10) unsigned NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`movement_id`,`equity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transfers`
--

INSERT INTO `transfers` (`movement_id`, `equity_id`, `amount`) VALUES
(1, 1, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`) VALUES
(1, 'guillermin');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `drains`
--
ALTER TABLE `drains`
  ADD CONSTRAINT `drains_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `drains` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `drain_languages`
--
ALTER TABLE `drain_languages`
  ADD CONSTRAINT `drain_languages_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `drain_languages_ibfk_1` FOREIGN KEY (`drain_id`) REFERENCES `drains` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `equities`
--
ALTER TABLE `equities`
  ADD CONSTRAINT `equities_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sources`
--
ALTER TABLE `sources`
  ADD CONSTRAINT `sources_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `sources` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `source_languages`
--
ALTER TABLE `source_languages`
  ADD CONSTRAINT `source_languages_ibfk_1` FOREIGN KEY (`source_id`) REFERENCES `sources` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `source_languages_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE;
