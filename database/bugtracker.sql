-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2020 at 11:30 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bugtracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `bugs`
--

CREATE TABLE `bugs` (
  `id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `title` varchar(128) NOT NULL,
  `description` mediumtext NOT NULL,
  `status` int(11) NOT NULL,
  `approved` int(11) NOT NULL DEFAULT 0,
  `author` varchar(64) NOT NULL,
  `solver` varchar(64) NOT NULL,
  `solving` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`solving`)),
  `request` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`request`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bugs`
--

INSERT INTO `bugs` (`id`, `datetime`, `title`, `description`, `status`, `approved`, `author`, `solver`, `solving`, `request`) VALUES
(112, '2020-12-19 10:24:35', 'navigation bar', 'The navigation bar or header is still visible (\"sticky\") even when scrolling down.\r\nIt\'s supposed to hide (\"relative\") when scrolling down.', 2, 0, 'admin', 'admin', '[\"admin\"]', '[\"admin\"]'),
(113, '2020-12-19 10:26:57', 'navigation bar', 'An issue with the navigation bar in small screen devices.\r\nWhen clicking the hamburger button the expanded navigation bar shows up for like a fraction of a second then dissapear.', 2, 0, 'admin', 'admin', '[\"admin\"]', '[\"admin\"]'),
(114, '2020-12-19 10:30:38', 'updating user info in settings', 'Issue when clicking \"Save Changes\" button.\r\nPassword is also updated in the database even if it is blank, which isn\'t supposed to happen (optional).\r\nCausing the password to be a hash of a null character?', 2, 0, 'admin', 'admin', '[\"admin\"]', '[\"admin\"]'),
(115, '2020-12-19 10:32:27', 'messy verification in updating user info', 'Verification of password length and match is all messed up. Causing very unusual behavior and in specific cases even updates the database even if the verification faild.', 2, 0, 'admin', 'admin', '[\"admin\"]', '[\"admin\"]'),
(116, '2020-12-19 10:35:10', 'Bug pool categories\' search is broken', 'When searching in an empty category something empty is retrieved from the database and displayed. Which is not supposed to happen. And should rather display \"NO DATA\".', 2, 0, 'admin', 'admin', '[\"admin\"]', '[\"admin\"]'),
(117, '2020-12-19 10:39:03', 'content is not updated when search field is cleared', 'When searching something and then pressing an action button (i.e. \"x\" or delete and \"Resolve\") and the after clearing the search field the content is still present and not deleted.\r\nBut database is already updated or deleted the content.\r\nMaking this a case a bug not related to database manipulation.', 2, 0, 'admin', 'admin', '[\"admin\"]', '[\"admin\"]'),
(118, '2020-12-19 10:42:50', 'search bug in \"Request for Resolved\"', 'The content is not updated when searching for content. And then perform an action that deletes or causes the content to move to a different category is done.\r\nThen after clearing the search fields the \"supposedly\" deleted or moved content is still present.', 2, 0, 'admin', 'admin', '[\"admin\"]', '[\"admin\"]'),
(119, '2020-12-19 10:51:46', 'processing bug title and description', 'An issue with processing description as well as title with a quotation to the database. As well as displaying the data with weird white spaces and newline characters.', 2, 0, 'admin', 'admin', '[\"admin\"]', '[\"admin\"]'),
(120, '2020-12-19 10:58:29', 'Input field resizing', 'When the screen\'s size reached some size or less. the input fields display undesirable behavior. Like jumping out of the parent container. Making the rest of the unaffected to resize accordingly while leaving the affected to remain at the same size and fail to adjust.', 2, 0, 'admin', 'admin', '[\"admin\"]', '[\"admin\"]'),
(121, '2020-12-19 11:01:46', 'THE UNRESOLVED BUG(S)', 'Some bugs are not known to me yet as of writing this bug report. May you help in improving this website by reporting bugs and if possible contacting me for discussing some specific details.', 0, 0, 'admin', '', '[]', '[]');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `privilege` int(11) NOT NULL,
  `firstname` varchar(64) NOT NULL,
  `middlename` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `repbug` int(11) NOT NULL,
  `resbug` int(11) NOT NULL,
  `rspdngbug` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `privilege`, `firstname`, `middlename`, `lastname`, `repbug`, `resbug`, `rspdngbug`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, 'Adrian Vincent', 'Beduya', 'Aguilar', 10, 9, 9),
(2, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 1, 'User First', 'User Middle', 'User Last', 0, 0, 0),
(3, 'user1', '25d55ad283aa400af464c76d713c07ad', 1, 'First Name', 'Middle Name', 'Last Name', 0, 0, 0),
(4, 'user2', '25d55ad283aa400af464c76d713c07ad', 1, 'user2 First', 'user2 Middle', 'user2 Last', 0, 0, 0),
(5, 'user3', '25d55ad283aa400af464c76d713c07ad', 1, 'user3 First', 'user3 Middle', 'user3 Last', 0, 0, 0),
(6, 'user4', '25d55ad283aa400af464c76d713c07ad', 1, 'user4 First', 'user4 Middle', 'user4 Last', 0, 0, 0),
(7, 'user5', '25d55ad283aa400af464c76d713c07ad', 1, 'user5 First', 'user5 Middle', 'user5 Last', 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bugs`
--
ALTER TABLE `bugs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bugs`
--
ALTER TABLE `bugs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
