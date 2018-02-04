-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2018 at 04:34 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bayanion_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `activity_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `post_status` varchar(20) NOT NULL,
  `act_title` varchar(100) NOT NULL,
  `act_start` datetime NOT NULL,
  `act_end` datetime NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `joined` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`activity_id`, `group_id`, `user_id`, `address_id`, `post_status`, `act_title`, `act_start`, `act_end`, `create_date`, `joined`) VALUES
(1, 1, 1, 5, 'public', 'Feeding Program', '2018-02-22 10:00:00', '2018-02-22 15:00:00', '2018-02-01 18:49:06', 0),
(2, 1, 1, 6, 'public', 'zxcvbnm', '2018-02-24 20:00:00', '2018-02-24 12:00:00', '2018-02-01 18:51:15', 0);

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL,
  `street` varchar(50) NOT NULL,
  `barangay` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `zip_code` int(11) NOT NULL,
  `province` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `street`, `barangay`, `city`, `zip_code`, `province`) VALUES
(1, 'Basubas Compound', 'Tipolo', 'Mandaue City', 6014, 'Cebu'),
(2, 'Basubas Compound', 'Tipolo', 'Mandaue City', 6014, 'Cebu'),
(3, 'Basubas Compound', 'Tipolo', 'Mandaue City', 6014, 'Cebu'),
(4, 'Basubas Compound', 'Tipolo', 'Mandaue City', 6014, 'Cebu'),
(5, 'Basubas Compound', 'Tipolo', 'Mandaue City', 6014, 'Cebu'),
(6, 'zxcv', 'zxcv', 'zxcv', 6041, 'zxcv'),
(7, 'zxcv', 'zxcv', 'zxcv', 6041, 'zxcv'),
(8, 'asdf', 'asdf', 'asdf', 6014, 'adsf');

-- --------------------------------------------------------

--
-- Table structure for table `donation_campaign`
--

CREATE TABLE `donation_campaign` (
  `campaign_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_status` varchar(50) NOT NULL,
  `campaign_photo` blob NOT NULL,
  `campaign_description` varchar(500) NOT NULL,
  `tag_user` varchar(20) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `total_like` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donation_campaign`
--

INSERT INTO `donation_campaign` (`campaign_id`, `user_id`, `post_status`, `campaign_photo`, `campaign_description`, `tag_user`, `create_date`, `total_like`) VALUES
(1, 1, 'public', 0x646f776e6c6f6164202833292e6a7067, 'to donate', '', '2018-01-25 17:30:04', 2),
(2, 1, 'timeline', 0x636c6f746865732e6a7067, 'hey! sayo nato.', 'try1', '2018-01-25 22:24:32', 1),
(3, 3, 'public', 0x646f776e6c6f6164202833292e6a7067, 'packing donation', '', '2018-01-26 14:37:03', 0),
(4, 1, 'timeline', 0x636c6f746865732e6a7067, 'aigfcvxboyij', 'try1', '2018-01-25 17:28:27', 0),
(5, 2, 'public', 0x636c6f746865732e6a7067, 'i donate this!', '', '2018-01-26 14:35:15', 0),
(6, 2, 'public', 0x646f776e6c6f61642e6a7067, 'donation campaign!', '', '2018-01-27 14:43:03', 1),
(7, 3, 'public', 0x646f776e6c6f6164202832292e6a7067, 'donationssssss', '', '2018-01-27 12:47:56', 0);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_logo` blob NOT NULL,
  `group_name` varchar(50) NOT NULL,
  `group_description` varchar(300) NOT NULL,
  `admin` varchar(50) NOT NULL,
  `members` varchar(500) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `user_id`, `group_logo`, `group_name`, `group_description`, `admin`, `members`, `create_date`) VALUES
(1, 1, 0x737175616466616d2e6a7067, 'squad', 'one for all, all for one...', 'try', 'try1', '2018-01-31 23:31:06'),
(2, 1, 0x646275672e6a7067, 'team Dbug', 'we can do it!', 'try', 'try1', '2018-01-25 00:11:42');

-- --------------------------------------------------------

--
-- Table structure for table `individual_user`
--

CREATE TABLE `individual_user` (
  `iu_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `individual_user`
--

INSERT INTO `individual_user` (`iu_id`, `user_id`, `first_name`, `last_name`, `middle_name`, `birthdate`, `gender`) VALUES
(1, 1, 'try', 'try', 'try', '2018-01-01', 'male'),
(2, 3, 'Cherry Mae', 'Estrera', 'Revilla', '1997-10-05', 'female'),
(3, 4, 'mae', 'mae', 'mae', '2018-01-02', 'female');

-- --------------------------------------------------------

--
-- Table structure for table `organization_user`
--

CREATE TABLE `organization_user` (
  `org_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `org_name` varchar(50) NOT NULL,
  `rep_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organization_user`
--

INSERT INTO `organization_user` (`org_id`, `user_id`, `org_name`, `rep_name`) VALUES
(1, 2, 'try1', 'try1'),
(2, 5, 'zxcv', 'zxcv'),
(3, 6, 'asdf', 'asdf');

-- --------------------------------------------------------

--
-- Table structure for table `post_comment`
--

CREATE TABLE `post_comment` (
  `comment_id` int(11) NOT NULL,
  `testimony_id` int(11) NOT NULL,
  `campaign_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_content` varchar(500) NOT NULL,
  `comment_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_comment`
--

INSERT INTO `post_comment` (`comment_id`, `testimony_id`, `campaign_id`, `activity_id`, `user_id`, `comment_content`, `comment_date`, `status`) VALUES
(1, 1, 0, 0, 1, 'hey thanks!', '2018-02-01 22:12:01', 0),
(2, 0, 1, 0, 1, 'grab it now!', '2018-02-01 22:12:02', 0),
(3, 0, 0, 0, 1, 'grab it now!', '2018-02-01 22:12:02', 0),
(4, 0, 2, 0, 1, 'gootorhpto7', '2018-02-01 22:12:02', 0),
(5, 0, 0, 0, 1, 'gootorhpto7', '2018-02-01 22:12:02', 0),
(6, 0, 2, 0, 1, 'FDHXGBXDHBFD', '2018-02-01 22:12:02', 0),
(7, 0, 0, 0, 1, 'FDHXGBXDHBFD', '2018-02-01 22:12:03', 0),
(8, 0, 6, 0, 1, 'fsdxgfchfhf', '2018-02-01 22:12:03', 0),
(9, 0, 0, 0, 1, 'fsdxgfchfhf', '2018-02-01 22:12:03', 0),
(10, 0, 0, 0, 1, 'dfghsgf', '2018-02-01 22:12:03', 0),
(11, 1, 0, 0, 1, 'dfghsgf', '2018-02-01 22:12:03', 0),
(12, 0, 7, 0, 1, 'fdxgxgbdx', '2018-02-01 22:12:03', 0),
(13, 0, 0, 0, 1, 'fdxgxgbdx', '2018-02-01 22:12:03', 0),
(14, 0, 7, 0, 1, 'dydryhdfjd', '2018-02-01 22:22:56', 0),
(15, 0, 0, 0, 1, 'afdghjklmfcxZXcvbnm,l', '2018-02-01 22:27:51', 0),
(16, 0, 0, 0, 1, 'afdghjklmfcxZXcvbnm,l', '2018-02-01 22:27:52', 0),
(17, 0, 0, 0, 1, 'afdsghdxyh', '2018-02-01 22:29:14', 0),
(18, 2, 0, 0, 1, 'afdsghdxyh', '2018-02-01 22:29:14', 0);

-- --------------------------------------------------------

--
-- Table structure for table `testimonies`
--

CREATE TABLE `testimonies` (
  `testimony_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_status` varchar(50) NOT NULL,
  `testimony` varchar(500) NOT NULL,
  `tag_user` varchar(20) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `total_like` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testimonies`
--

INSERT INTO `testimonies` (`testimony_id`, `user_id`, `post_status`, `testimony`, `tag_user`, `create_date`, `total_like`) VALUES
(1, 3, 'public', 'dsfxgcvhbnm,nbvcxz', '', '2018-01-27 12:02:47', 1),
(2, 1, 'public', 'sdcvbhesrdf', '', '2018-01-26 15:13:27', 0),
(3, 2, 'public', 'Dzvbcnhgfdzcx', '', '2018-01-26 15:13:41', 0),
(4, 1, 'public', 'bSzcx', '', '2018-01-26 15:13:57', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `account_type` varchar(20) NOT NULL,
  `user_photo` blob NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `mobile_no` bigint(11) NOT NULL,
  `telephone_no` bigint(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `address_id`, `account_type`, `user_photo`, `email_address`, `mobile_no`, `telephone_no`, `username`, `password`) VALUES
(1, 1, 'individual', 0x73717561642e6a7067, 'try@gmail.com', 9774531005, 3456666, 'try', 'try'),
(2, 2, 'organization', 0x73717561642e6a7067, 'try1@gmail.com', 9774531005, 3456666, 'try1', 'try1'),
(3, 3, 'individual', 0x6368656d61792e6a706567, 'cherrymaeestrera8@gmail.com', 9774531005, 3456666, 'chemay', 'chemay'),
(4, 4, 'individual', 0x616e67656c612e6a7067, 'mae@gmail.com', 9774531005, 3456666, 'mae', 'mae'),
(5, 7, 'organization', 0x676c616479732e6a706567, 'zxcv@gmail.com', 9774531005, 3456666, 'zxcv', 'zxcv'),
(6, 8, 'organization', 0x73717561642e6a7067, 'asdf@gmail.com', 9774531005, 3456666, 'asdf', 'asdf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `donation_campaign`
--
ALTER TABLE `donation_campaign`
  ADD PRIMARY KEY (`campaign_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `individual_user`
--
ALTER TABLE `individual_user`
  ADD PRIMARY KEY (`iu_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `organization_user`
--
ALTER TABLE `organization_user`
  ADD PRIMARY KEY (`org_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `post_comment`
--
ALTER TABLE `post_comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `testimonies`
--
ALTER TABLE `testimonies`
  ADD PRIMARY KEY (`testimony_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `donation_campaign`
--
ALTER TABLE `donation_campaign`
  MODIFY `campaign_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `individual_user`
--
ALTER TABLE `individual_user`
  MODIFY `iu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `organization_user`
--
ALTER TABLE `organization_user`
  MODIFY `org_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `post_comment`
--
ALTER TABLE `post_comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `testimonies`
--
ALTER TABLE `testimonies`
  MODIFY `testimony_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `individual_user`
--
ALTER TABLE `individual_user`
  ADD CONSTRAINT `individual_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `organization_user`
--
ALTER TABLE `organization_user`
  ADD CONSTRAINT `organization_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
