-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2014 at 10:34 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `petshare`
--

-- --------------------------------------------------------

--
-- Table structure for table `access`
--

CREATE TABLE IF NOT EXISTS `access` (
`id` int(11) unsigned NOT NULL,
  `key` varchar(40) NOT NULL DEFAULT '',
  `controller` varchar(50) NOT NULL DEFAULT '',
  `date_created` datetime DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `access`
--

INSERT INTO `access` (`id`, `key`, `controller`, `date_created`, `date_modified`) VALUES
(1, '6d9f729b765aae27f45e5ef9150fa073f8a61b94', 'key', '2014-03-03 04:04:07', '2014-03-03 19:30:57');

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE IF NOT EXISTS `keys` (
`id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `is_private_key` tinyint(1) NOT NULL DEFAULT '0',
  `ip_addresses` text,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `keys`
--

INSERT INTO `keys` (`id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, '6d9f729b765aae27f45e5ef9150fa073f8a61b94', 3, 0, 0, NULL, 1393594893);

-- --------------------------------------------------------

--
-- Table structure for table `limits`
--

CREATE TABLE IF NOT EXISTS `limits` (
`id` int(11) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `count` int(10) NOT NULL,
  `hour_started` int(11) NOT NULL,
  `api_key` varchar(40) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=460 ;

--
-- Dumping data for table `limits`
--

INSERT INTO `limits` (`id`, `uri`, `count`, `hour_started`, `api_key`) VALUES
(459, 'key', 1, 1413203803, '6d9f729b765aae27f45e5ef9150fa073f8a61b94');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
`id` int(11) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `method` varchar(6) NOT NULL,
  `params` text,
  `api_key` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` int(11) NOT NULL,
  `rtime` float DEFAULT NULL,
  `authorized` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`) VALUES
(1, 'key/index/format/json', 'post', '{"format":"json"}', '6d9f729b765aae27f45e5ef9150fa073f8a61b94', '111.93.85.70', 1399616741, 0.059473, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
`iAdminID` int(11) NOT NULL,
  `vFirstName` varchar(50) NOT NULL,
  `vLastName` varchar(50) NOT NULL,
  `vEmail` varchar(255) NOT NULL,
  `vPassword` varchar(255) NOT NULL,
  `iAddedBy` int(11) NOT NULL,
  `iLastEditedBy` int(11) NOT NULL,
  `eStatus` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `dTlogouttime` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=99 ;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`iAdminID`, `vFirstName`, `vLastName`, `vEmail`, `vPassword`, `iAddedBy`, `iLastEditedBy`, `eStatus`, `dTlogouttime`) VALUES
(95, 'Poonam', '', 'poonam@openxcell.com', '21232f297a57a5a743894a0e4a801fc3', 0, 0, 'Active', '2014-11-24 05:22:23'),
(98, 'Pulkit', 'K Pithva', 'pulkit@openxcelltechnolabs.com', '21232f297a57a5a743894a0e4a801fc3', 95, 0, 'Active', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hmac`
--

CREATE TABLE IF NOT EXISTS `tbl_hmac` (
`iHmacID` int(11) NOT NULL,
  `iUserID` int(11) NOT NULL,
  `vHmac` varchar(255) NOT NULL,
  `dtCreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pagecontent`
--

CREATE TABLE IF NOT EXISTS `tbl_pagecontent` (
`iPageID` int(11) NOT NULL,
  `vPageTitle` varchar(255) NOT NULL,
  `tMetaKeywords` text NOT NULL,
  `tMetaDescription` text NOT NULL,
  `tContent` text NOT NULL,
  `tCreatedAt` datetime NOT NULL,
  `tModifiedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_pagecontent`
--

INSERT INTO `tbl_pagecontent` (`iPageID`, `vPageTitle`, `tMetaKeywords`, `tMetaDescription`, `tContent`, `tCreatedAt`, `tModifiedAt`) VALUES
(1, 'Terms & Use', 'Terms & Use', '<p>Terms & Use</p>', '<p>Terms &amp; Use Content Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.asdsasad</p>\r\n', '0000-00-00 00:00:00', '2014-11-25 09:24:56');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting`
--

CREATE TABLE IF NOT EXISTS `tbl_setting` (
`iSettingID` int(11) NOT NULL,
  `vContactmail` varchar(255) NOT NULL,
  `vCompanymail` varchar(255) NOT NULL,
  `tCreatedAt` datetime NOT NULL,
  `tModifiedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `eStatus` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
`iUserID` int(11) NOT NULL,
  `vFirstName` varchar(255) NOT NULL,
  `vLastName` varchar(255) NOT NULL,
  `vUserName` varchar(255) NOT NULL,
  `vEmail` varchar(255) NOT NULL,
  `vPassword` varchar(255) NOT NULL,
  `vProfilePic` varchar(255) NOT NULL,
  `dDob` date NOT NULL,
  `tAdd1` text NOT NULL,
  `tAdd2` text NOT NULL,
  `vCity` varchar(255) NOT NULL,
  `vState` varchar(255) NOT NULL,
  `vCountry` varchar(255) NOT NULL,
  `vPhone` varchar(255) NOT NULL,
  `eGender` enum('Male','Female') NOT NULL,
  `ePlatform` varchar(255) NOT NULL,
  `vDeviceToken` varchar(255) NOT NULL,
  `eStatus` enum('Active','Inactive') NOT NULL,
  `dtCreated` datetime NOT NULL,
  `tsModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dLat` double NOT NULL,
  `dLong` double NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`iUserID`, `vFirstName`, `vLastName`, `vUserName`, `vEmail`, `vPassword`, `vProfilePic`, `dDob`, `tAdd1`, `tAdd2`, `vCity`, `vState`, `vCountry`, `vPhone`, `eGender`, `ePlatform`, `vDeviceToken`, `eStatus`, `dtCreated`, `tsModified`, `dLat`, `dLong`) VALUES
(1, 'dummy', 'dummy', 'dummy user', 'dummy@user.com', '21232f297a57a5a743894a0e4a801fc3', '', '2014-11-11', 'sxfsdsd', 'dsfds', 'Ahmendabad', 'Gujarat', 'India', '9510785176', 'Male', 'Android', 'dlk;jfadklsjfkdsj', 'Inactive', '2014-11-12 00:00:00', '2014-11-25 09:15:58', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access`
--
ALTER TABLE `access`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `limits`
--
ALTER TABLE `limits`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
 ADD PRIMARY KEY (`iAdminID`);

--
-- Indexes for table `tbl_hmac`
--
ALTER TABLE `tbl_hmac`
 ADD PRIMARY KEY (`iHmacID`), ADD KEY `iUserID` (`iUserID`);

--
-- Indexes for table `tbl_pagecontent`
--
ALTER TABLE `tbl_pagecontent`
 ADD PRIMARY KEY (`iPageID`);

--
-- Indexes for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
 ADD PRIMARY KEY (`iSettingID`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
 ADD PRIMARY KEY (`iUserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access`
--
ALTER TABLE `access`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `limits`
--
ALTER TABLE `limits`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=460;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
MODIFY `iAdminID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=99;
--
-- AUTO_INCREMENT for table `tbl_hmac`
--
ALTER TABLE `tbl_hmac`
MODIFY `iHmacID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_pagecontent`
--
ALTER TABLE `tbl_pagecontent`
MODIFY `iPageID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
MODIFY `iSettingID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
MODIFY `iUserID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_hmac`
--
ALTER TABLE `tbl_hmac`
ADD CONSTRAINT `tbl_hmac_ibfk_1` FOREIGN KEY (`iUserID`) REFERENCES `tbl_user` (`iUserID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
