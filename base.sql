-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 14, 2020 at 12:28 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `laCarte`
--

-- --------------------------------------------------------

--
-- Table structure for table `cooks`
--

CREATE TABLE `cooks` (
  `id` int(11) NOT NULL,
  `last_name` text NOT NULL,
  `first_name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `biography` varchar(250) NOT NULL,
  `profile_picture` text NOT NULL,
  `identifiant` text NOT NULL,
  `date` datetime NOT NULL,
  `subscription` text NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cooks`
--

INSERT INTO `cooks` (`id`, `last_name`, `first_name`, `email`, `password`, `biography`, `profile_picture`, `identifiant`, `date`, `subscription`, `points`) VALUES
(1, '', '', 'test@email', '$2y$10$ak5RqYXjSU13nJew0E.wxOr8VO6DaZITWJ2QgTYEbXfbpD2b.b.FS', '', '1.jpeg', 'id1', '2020-04-14 13:13:15', '', 0),
(2, '', '', 'test2@email', '$2y$10$jU95PE.NgNO6E6eiN3QI9eBotedqeC7Ms4Z/NKulotj8UNzHrmkqG', '', 'account.svg', 'id 2', '2020-04-14 14:20:38', '', 0),
(3, '', '', 'test3@email', '$2y$10$WBcxPj6kmZVy3PSHMIRJI.a2fUO89Gdxmy35lxp8DHL3Efdd5DIhW', '', 'account.svg', 'id 3', '2020-04-14 14:21:33', '', 0),
(4, '', '', 'test4@email', '$2y$10$hdZkUbCJjwYhv94lxtGVe.gugBgzKXntfm9hS9/uJPciIjFhsRepG', '', 'account.svg', 'id 4', '2020-04-14 14:22:35', '', 0),
(5, '', '', 'test5@email', '$2y$10$iiSTQXTpKK12lROu4bVJXuVG/BPnL6IFaLgN2SCxgP3wvA2/xkaWm', '', 'account.svg', 'id 5', '2020-04-14 14:23:40', '', 0),
(6, '', '', 'test6@email', '$2y$10$gaXQTzVtfPslbQvME0WhKO0PI1c.gkDnuqjLGisYr0BmfbQdFdov6', '', 'account.svg', 'id 6', '2020-04-14 14:24:38', '', 0),
(7, '', '', 'test7@email', '$2y$10$whXh/QajiEb/GC77oi7yuObTSFRuAI/RVZfgWFpzMVqPZXaHDLI9K', '', 'account.svg', 'id 7', '2020-04-14 14:25:29', '', 0),
(8, '', '', 'test8@email', '$2y$10$OUuOmjDjfPR5fsYmkzwp8eF6rPEl48HNZqfb1uzUWXq1U47Gi4.AS', '', 'account.svg', 'id 8', '2020-04-14 14:26:16', '', 0),
(9, '', '', 'test9@email', '$2y$10$8/6qTE2F.WTSkJ//LYCQ1.NJpeLOtltH9xqNDdsWTrFm7kMXrsTMG', '', 'account.svg', 'id 9', '2020-04-14 14:27:00', '', 0),
(10, '', '', 'test10@email', '$2y$10$lWEi5LL.q/Xf3YReqC./7elDO7gt9K9F5AMS9GfPPBTqRUuP4sQ/u', '', 'account.svg', 'id 10', '2020-04-14 14:27:54', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `id` int(11) NOT NULL,
  `id_follower` int(11) NOT NULL,
  `id_following` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `password`
--

CREATE TABLE `password` (
  `id` int(11) NOT NULL,
  `cle` text NOT NULL,
  `email` text NOT NULL,
  `date` datetime NOT NULL,
  `done` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `id_cook` int(11) NOT NULL,
  `recipe_picture` text NOT NULL,
  `ingredients` varchar(500) NOT NULL,
  `steps` varchar(1000) NOT NULL,
  `serve` varchar(500) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `title`, `id_cook`, `recipe_picture`, `ingredients`, `steps`, `serve`, `date`) VALUES
(1, 'titre', 1, '15868631301.jpeg', 'ingred', 'prepa', 'serv', '2020-04-14 13:18:50'),
(2, 'titre', 1, '11586866738.jpeg', 'ingred', 'prepa', 'serv', '2020-04-14 14:18:58'),
(3, 'titre', 2, '21586866856.jpeg', 'ingred', 'prepa', 'serv', '2020-04-14 14:20:56'),
(4, 'azertyu', 2, '21586866877.jpeg', 'zertyui', 'zertyuio', 'zertyui', '2020-04-14 14:21:17'),
(5, 'azertyuio', 3, '31586866916.jpeg', 'azertyuiop', 'zertyuiop', 'zertyuio', '2020-04-14 14:21:56'),
(6, 'azertyuiop', 3, '31586866936.jpeg', 'azertyuiop', 'azertyuiop', 'zertyuiop', '2020-04-14 14:22:16'),
(7, 'azertyuiop', 4, '41586866973.jpeg', 'azertyuiop', 'azertyuio', 'azertyuio', '2020-04-14 14:22:53'),
(8, 'azertyuio', 4, '41586867000.jpeg', 'azertyuio', 'azertyui', 'azertyui', '2020-04-14 14:23:20'),
(9, 'azertyuiop', 5, '51586867048.jpeg', 'azertyuiop', 'azertyuio', 'azertyuio', '2020-04-14 14:24:08'),
(10, 'azertyuio', 5, '51586867064.jpeg', 'azertyu', 'zertyu', 'zertyui', '2020-04-14 14:24:24'),
(11, 'azertyuiop', 6, '61586867092.jpeg', 'azertyuio', 'zertyuio', 'ertyuio', '2020-04-14 14:24:52'),
(12, 'azertyuio', 6, '61586867111.jpeg', 'azertyui', 'zertyuio', 'zertyui', '2020-04-14 14:25:11'),
(13, 'azertyuio', 7, '71586867141.jpeg', 'azertyui', 'zertyui', 'zertyui', '2020-04-14 14:25:41'),
(14, 'azertyui', 7, '71586867156.jpeg', 'zertyu', 'zertyu', 'zertyu', '2020-04-14 14:25:56'),
(15, 'zert', 8, '81586867189.jpeg', 'erty', 'erty', 'erty', '2020-04-14 14:26:29'),
(16, 'zert', 8, '81586867205.jpeg', 'erty', 'erty', 'erty', '2020-04-14 14:26:45'),
(17, 'rty', 9, '91586867232.jpeg', 'rtyrty', 'rtyrtyu', 'tyu', '2020-04-14 14:27:12'),
(18, 'hj', 9, '91586867246.jpeg', 'ghj', 'ghjghj', 'hjk', '2020-04-14 14:27:26'),
(19, 'gh', 10, '101586867285.jpeg', 'fgh', 'fghj', 'fghj', '2020-04-14 14:28:05'),
(20, 'ghj', 10, '101586867298.jpeg', 'gh', 'ghj', 'ghj', '2020-04-14 14:28:18');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `id_recipe` int(11) NOT NULL,
  `id_cook` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cooks`
--
ALTER TABLE `cooks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password`
--
ALTER TABLE `password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cooks`
--
ALTER TABLE `cooks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `password`
--
ALTER TABLE `password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
