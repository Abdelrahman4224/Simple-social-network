-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2020 at 06:52 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `registration`
--

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `user_email` varchar(50) NOT NULL,
  `friend_email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`user_email`, `friend_email`) VALUES
('abdelrahmanashraf@yahoo.com', 'AndrewKamel@yahoo.com'),
('AndrewKamel@yahoo.com', 'abdelrahmanashraf@yahoo.com');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `user_id` int(50) NOT NULL,
  `user` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `post` text NOT NULL,
  `caption` text NOT NULL,
  `Image` text NOT NULL,
  `posted time` date NOT NULL DEFAULT current_timestamp(),
  `ispublic` tinyint(1) NOT NULL,
  `postername` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`user_id`, `user`, `email`, `post`, `caption`, `Image`, `posted time`, `ispublic`, `postername`) VALUES
(134, 'Abdel', 'Abdelrahmanashraf@yahoo.com', 'A day to remember', 'Good Morning', 'http://localhost/v5/userdata/user_posts/OjCSTZ3Q0YavmLo/sunny-day-landscape-1.jpg', '2020-05-11', 1, 'My poster'),
(134, 'Abdel', 'Abdelrahmanashraf@yahoo.com', 'Great Trip', 'Back from Rome', 'http://localhost/v5/userdata/user_posts/YdECpeDSl8xtBP1/sas.jpg', '2020-05-11', 0, 'Pisa Tower'),
(135, 'Andrew', 'AndrewKamel@yahoo.com', 'This is my new profile', 'This is my new profile', '', '2020-05-11', 0, 'This is my new profile'),
(136, 'ahmed', 'ahmedmohamed@yahoo.com', 'hello', 'hi', '', '2020-05-11', 1, 'hello'),
(137, 'ahmed', 'ahmedashraf@yahoo.com', 'good afternoon', 'good afternoon', '', '2020-05-11', 1, 'good afternoon');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `email` varchar(225) NOT NULL,
  `username` varchar(225) NOT NULL,
  `firstname` varchar(225) NOT NULL,
  `lastname` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `PhoneNumber` varchar(100) NOT NULL,
  `Birthdate` date NOT NULL,
  `Hometown` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `maritalstatus` varchar(100) NOT NULL,
  `Profilepicture` longblob NOT NULL,
  `ppurl` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `username`, `firstname`, `lastname`, `password`, `registration_date`, `PhoneNumber`, `Birthdate`, `Hometown`, `gender`, `maritalstatus`, `Profilepicture`, `ppurl`) VALUES
(134, 'Abdelrahmanashraf@yahoo.com', 'Abdel', 'Abdelrahman', 'Ashraf', '267c88a9c130619b5e8fe370c0ae7730', '2020-05-11 03:35:31', '01826374635', '1111-12-12', 'Egypt', 'Male', 'Single', 0x4172726179, 'http://localhost/v5/userdata/user_photos/v3ILoPRMAND1cSs/5b566bc71d308_thumb900.jpg'),
(135, 'AndrewKamel@yahoo.com', 'Andrew', 'Andrew', 'Kamel', '267c88a9c130619b5e8fe370c0ae7730', '2020-05-11 03:42:23', '12312312312', '1997-12-12', 'Egypt', 'Male', 'Single', 0x687474703a2f2f6c6f63616c686f73742f76352f6d616c652e6a7067, 'http://localhost/v5/male.jpg'),
(136, 'ahmedmohamed@yahoo.com', 'ahmed', 'Ahmed', 'Mohamed', '9193ce3b31332b03f7d8af056c692b84', '2020-05-11 03:54:02', '01222212637', '1995-12-12', 'Egypt', 'Male', 'Single', 0x687474703a2f2f6c6f63616c686f73742f76352f6d616c652e6a7067, 'http://localhost/v5/male.jpg'),
(137, 'ahmedashraf@yahoo.com', 'ahmed', 'ahmed', 'ashraf', '9193ce3b31332b03f7d8af056c692b84', '2020-05-11 04:10:31', '01223232123', '1995-12-12', 'Egypt', 'Male', 'Single', 0x687474703a2f2f6c6f63616c686f73742f76352f6d616c652e6a7067, 'http://localhost/v5/male.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD KEY `user_email` (`user_email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
