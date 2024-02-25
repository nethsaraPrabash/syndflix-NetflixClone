-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 25, 2024 at 02:44 PM
-- Server version: 8.0.36
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `syndflix`
--

-- --------------------------------------------------------

--
-- Table structure for table `catagories`
--

DROP TABLE IF EXISTS `catagories`;
CREATE TABLE IF NOT EXISTS `catagories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `catagories`
--

INSERT INTO `catagories` (`id`, `name`) VALUES
(1, 'Action & Adventure'),
(2, 'Classic'),
(3, 'Comedies'),
(4, 'Dramas'),
(5, 'Horror'),
(6, 'Romantic'),
(7, 'Sci - Fi & Fantasy'),
(8, 'Sports'),
(9, 'Thrillers'),
(10, 'Documentaries'),
(11, 'Teen'),
(12, 'Children & Family'),
(13, 'Anime'),
(14, 'Independent'),
(15, 'Foreign'),
(16, 'Music'),
(17, 'Christmas'),
(18, 'Others'),
(19, 'Cartoon');

-- --------------------------------------------------------

--
-- Table structure for table `entities`
--

DROP TABLE IF EXISTS `entities`;
CREATE TABLE IF NOT EXISTS `entities` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `preview` varchar(255) NOT NULL,
  `categoryId` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categoryId` (`categoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `entities`
--

INSERT INTO `entities` (`id`, `name`, `thumbnail`, `preview`, `categoryId`) VALUES
(1, 'Friends', 'entities/thumbnails/friends', 'entities/previews/2.mp4', 3),
(2, 'Jaws', 'entities/thumbnails/jaws.jpg', 'entities/previews/2.mp4', 5),
(3, 'Game of thrones', 'entities/thumbnails/got.jpg', 'entities/previews/2.mp4', 4),
(4, 'Top Gun', 'entities/thumbnails/tg.jpg', 'entities/previews/2.mp4', 1),
(5, 'Jurasic park', 'entities/thumbnails/jp.jpg', 'entities/previews/2.mp4', 7),
(6, 'Zilla X Kong', 'entities/thumbnails/kungfupanda.jpg', 'entities/previews/kong.mp4', 7),
(7, 'Dead Pool', 'entities/thumbnails/deadpool.jpg', 'entities/previews/deadpool.mp4', 3),
(8, 'Kungfu Panda 4', 'entities/thumbnails/kong.jpg', 'entities/previews/kungfupanda.mp4', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` varchar(5) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `uname` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pword` varchar(255) NOT NULL,
  `signUpDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isSubscribed` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `uname`, `email`, `pword`, `signUpDate`, `isSubscribed`) VALUES
('U001', 'Jhon', 'Doe', 'Jhond', 'Abcd@gmail.com', 'Jhon123', '2024-02-20 13:01:33', 0),
('U002', 'Jhon', 'Doe', 'Jhond', 'Abcd@gmail.com', 'Jhon123', '2024-02-20 13:02:04', 0),
('U003', 'Jhon', 'Doe', 'Jhond', 'Abcd@gmail.com', 'Jhon123', '2024-02-20 13:02:41', 0),
('U004', 'Megan', 'Abc', 'Mgce', 'Mgce@gmail.com', 'Mgce123', '2024-02-20 13:04:26', 0),
('U005', 'Bruce', 'Wayne', 'Bruce', 'Bruce@gmail.com', 'Bruce123', '2024-02-20 15:48:38', 0),
('U006', 'Ann', 'Eva', 'Anneva', 'Anneva@gmail.com', '7ef950416ce5588ba7b2b71f1ec829d302d1a667c01d0ac63fc72f548a512942d33037820ba2ef04cf6ece174c728f8d1ff28b224c538364cd6811373c3bce71', '2024-02-20 17:22:08', 0),
('U007', 'Sawindu', 'Samuditha', 'Ssamuditha', 'Sawindu@gmail.com', '8c04f81448c33294368b9f6961cd603c5b20edd75255300500c566d2086cf35fd041eb0525fb1d767222582db1f4a29b5869ceca665ec5fc2cd2cc00991cd2bb', '2024-02-20 17:41:06', 0);

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

DROP TABLE IF EXISTS `videos`;
CREATE TABLE IF NOT EXISTS `videos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(70) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `filePath` varchar(250) NOT NULL,
  `isMovie` tinyint(1) NOT NULL,
  `uploadDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `releaseDate` date NOT NULL,
  `views` int NOT NULL,
  `duration` varchar(10) NOT NULL,
  `season` int NOT NULL,
  `episode` int NOT NULL,
  `entityId` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_entityId` (`entityId`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `title`, `description`, `filePath`, `isMovie`, `uploadDate`, `releaseDate`, `views`, `duration`, `season`, `episode`, `entityId`) VALUES
(1, 'Friends', 'Follow the lives of six reckless adults living in Manhattan, as they indulge in adventures which make their lives both troublesome and happening.', 'entities/videos/friends.mp4', 0, '2024-02-25 10:03:08', '1994-09-22', 117, '50:00', 1, 20, 1),
(2, 'Jaws', 'When a giant white shark fatally attacks swimmers on the shores of Amity Island, Sheriff Martin Brody teams up with a marine biologist and a local fisherman to hunt down the creature.', 'entities/videos/friends.mp4', 1, '2024-02-25 10:03:08', '1975-06-20', 104, '120:00', 1, 1, 2),
(3, 'Game of Thrones', 'Nine noble families wage war against each other in order to gain control over the mythical land of Westeros.', 'entities/videos/GOT.mp4', 0, '2024-02-25 10:03:08', '2011-09-22', 104, '50:00', 7, 10, 3),
(4, 'Top Gun', 'After losing his friend, top pilot Maverick is given a second chance to redeem himself. He struggles to be at his best and also gets romantically involved with his civilian instructor Charlie.', 'entities/videos/topgun.mp4', 0, '2024-02-25 10:03:08', '1986-05-16', 113, '120:00', 1, 1, 4),
(5, 'Jurassic Park', 'Jurassic Park is a 1993 American science fiction action film directed by Steven Spielberg, produced by Kathleen Kennedy and Gerald R. Molen, and starring Sam Neill, Laura Dern, Jeff Goldblum, and Richard Attenborough.', 'entities/videos/jurasic.mp4', 0, '2024-02-25 10:03:08', '2005-09-22', 102, '50:00', 1, 1, 5),
(6, 'Kungfu panda 4', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available.', 'entities/videos/kungfupanda.mp4', 1, '2024-02-25 17:58:03', '2024-05-07', 8, '120:00', 1, 1, 8),
(7, 'Dead Pool', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available.', 'entities/videos/deadpool.mp4', 1, '2024-02-25 17:58:03', '2024-05-07', 5, '120:00', 1, 1, 7),
(8, 'Zilla X Kong', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available.', 'entities/videos/kong.mp4', 1, '2024-02-25 17:58:03', '2024-05-07', 21, '120:00', 1, 1, 6);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `entities`
--
ALTER TABLE `entities`
  ADD CONSTRAINT `entities_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `catagories` (`id`);

--
-- Constraints for table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `fk_entityId` FOREIGN KEY (`entityId`) REFERENCES `entities` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
