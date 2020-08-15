-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 15, 2020 at 06:20 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zrc`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `addDriver` (`dname` VARCHAR(50), `daddress` VARCHAR(50), `dphone` VARCHAR(50), `dusername` VARCHAR(50), `userId` INT) RETURNS INT(11) BEGIN
	INSERT INTO drivers VALUES(NULL,dname,daddress,dphone,dusername,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,userId,1);
    RETURN ROW_COUNT();
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `bus_id` int(11) NOT NULL,
  `bus_plate` varchar(50) NOT NULL,
  `route_id` int(11) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime NOT NULL DEFAULT current_timestamp(),
  `createdBy` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`bus_id`, `bus_plate`, `route_id`, `createdAt`, `updatedAt`, `createdBy`, `status`) VALUES
(1, 'ZNZ1269990', 1, '2020-08-14 07:41:00', '2020-08-14 07:41:00', 1, 1),
(4, 'ZNZ7R7ER', 1, '2020-08-14 09:47:08', '2020-08-14 09:47:08', 1, 1),
(6, 'ZNZ897656', 2, '2020-08-14 09:50:45', '2020-08-14 09:50:45', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `driver_id` int(11) NOT NULL,
  `driver_name` varchar(50) NOT NULL,
  `driver_address` varchar(50) NOT NULL,
  `driver_phone` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime NOT NULL DEFAULT current_timestamp(),
  `createdBy` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`driver_id`, `driver_name`, `driver_address`, `driver_phone`, `username`, `createdAt`, `updatedAt`, `createdBy`, `status`) VALUES
(1, 'juma kassim jailan', 'bububu', '0777876545', 'juma', '2020-08-13 16:06:29', '2020-08-13 16:06:29', 1, 1),
(2, 'ismail omar', 'bububu', '0777876754', 'ismailar', '2020-08-14 05:29:41', '2020-08-14 05:29:41', 1, 1),
(3, 'kilaza', 'ksamaki', '0777876545', 'kilaza', '2020-08-14 05:31:17', '2020-08-14 23:19:41', 1, 1);

--
-- Triggers `drivers`
--
DELIMITER $$
CREATE TRIGGER `addUsers` AFTER INSERT ON `drivers` FOR EACH ROW BEGIN

INSERT INTO users (username,password,role,status)VALUES(NEW.username,MD5("route@2020"),"driver",1);

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `driver_bus`
--

CREATE TABLE `driver_bus` (
  `driver_bus_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `bus_id` int(11) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE `route` (
  `route_id` int(11) NOT NULL,
  `route_title` varchar(50) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime NOT NULL DEFAULT current_timestamp(),
  `createdBy` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`route_id`, `route_title`, `createdAt`, `updatedAt`, `createdBy`, `status`) VALUES
(1, 'Fuoni-Darajani', '2020-08-14 07:33:02', '2020-08-14 07:33:02', 1, 1),
(2, 'BUBUBU-FUONI', '2020-08-14 08:41:26', '2020-08-14 08:41:26', 1, 1),
(3, 'BUBUBU-DARAJANI', '2020-08-14 08:43:49', '2020-08-14 08:43:49', 1, 1),
(4, 'JUMBI-DARAJANIiiiiii', '2020-08-14 08:44:58', '2020-08-14 08:44:58', 1, 1),
(6, 'CHUOKIKUU-DARAJANI', '2020-08-14 22:23:51', '2020-08-14 22:23:51', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `station`
--

CREATE TABLE `station` (
  `station_id` int(11) NOT NULL,
  `station_title` varchar(50) NOT NULL,
  `station_address` varchar(50) NOT NULL,
  `station_time` int(11) NOT NULL,
  `station_time_unit` varchar(50) NOT NULL,
  `route_id` int(11) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime NOT NULL DEFAULT current_timestamp(),
  `createdBy` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `station`
--

INSERT INTO `station` (`station_id`, `station_title`, `station_address`, `station_time`, `station_time_unit`, `route_id`, `createdAt`, `updatedAt`, `createdBy`, `status`) VALUES
(1, 'Tavetaaa', 'Fuoni', 6, 'hour', 1, '2020-08-14 08:03:40', '2020-08-15 00:33:02', 1, 1),
(2, 'Meli Tano', 'Fuoni Meli Tano', 12, 'Minute', 1, '2020-08-14 08:15:15', '2020-08-14 08:15:15', 1, 1),
(6, 'muembeni', 'miembeni', 5, 'Minute', 1, '2020-08-15 00:01:11', '2020-08-15 00:01:11', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` varchar(50) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `role`, `createdAt`, `updatedAt`, `status`) VALUES
(1, 'juma', '9c206a0792a6f07b6e99ab0bc46b594e', 'driver', '2020-08-13 16:06:29', '2020-08-13 16:06:29', 1),
(2, 'admin', 'b99bbc0e85a70cb42dbaafabec773ddf', 'admin', '2020-08-14 01:48:40', '2020-08-14 01:48:40', 1),
(3, 'ismailar', '9c206a0792a6f07b6e99ab0bc46b594e', 'driver', '2020-08-14 05:29:41', '2020-08-14 05:29:41', 1),
(4, 'kilaza', '9c206a0792a6f07b6e99ab0bc46b594e', 'driver', '2020-08-14 05:31:17', '2020-08-14 05:31:17', 1),
(5, 'kileja', '9c206a0792a6f07b6e99ab0bc46b594e', 'driver', '2020-08-14 23:05:32', '2020-08-14 23:05:32', 1),
(6, 'jjun', '9c206a0792a6f07b6e99ab0bc46b594e', 'driver', '2020-08-14 23:06:19', '2020-08-14 23:06:19', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`bus_id`),
  ADD KEY `route_id` (`route_id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`driver_id`);

--
-- Indexes for table `driver_bus`
--
ALTER TABLE `driver_bus`
  ADD PRIMARY KEY (`driver_bus_id`),
  ADD KEY `driver_id` (`driver_id`),
  ADD KEY `bus_id` (`bus_id`);

--
-- Indexes for table `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`route_id`);

--
-- Indexes for table `station`
--
ALTER TABLE `station`
  ADD PRIMARY KEY (`station_id`),
  ADD KEY `route_id` (`route_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bus`
--
ALTER TABLE `bus`
  MODIFY `bus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `driver_bus`
--
ALTER TABLE `driver_bus`
  MODIFY `driver_bus_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `route`
--
ALTER TABLE `route`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `station`
--
ALTER TABLE `station`
  MODIFY `station_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bus`
--
ALTER TABLE `bus`
  ADD CONSTRAINT `bus_ibfk_1` FOREIGN KEY (`route_id`) REFERENCES `route` (`route_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `driver_bus`
--
ALTER TABLE `driver_bus`
  ADD CONSTRAINT `driver_bus_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`driver_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `driver_bus_ibfk_2` FOREIGN KEY (`bus_id`) REFERENCES `bus` (`bus_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `station`
--
ALTER TABLE `station`
  ADD CONSTRAINT `station_ibfk_1` FOREIGN KEY (`route_id`) REFERENCES `route` (`route_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
