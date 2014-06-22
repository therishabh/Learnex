-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2014 at 09:14 AM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `learnex`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `test_multi_sets`()
    DETERMINISTIC
begin
        select user() as first_col;
        select user() as first_col, now() as second_col;
        select user() as first_col, now() as second_col, now() as third_col;
        end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `academic_year`
--

CREATE TABLE IF NOT EXISTS `academic_year` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `starting_year` varchar(255) NOT NULL,
  `end_year` varchar(255) NOT NULL,
  `status` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `code` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `dob` varchar(50) NOT NULL,
  `doj` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `c_address` text NOT NULL,
  `p_address` text NOT NULL,
  `image` varchar(50) NOT NULL,
  `marital_status` varchar(200) NOT NULL,
  `parent_relation` varchar(20) NOT NULL,
  `parent_name` varchar(100) NOT NULL,
  `parent_phone` varchar(20) NOT NULL,
  `parent_email` varchar(100) NOT NULL,
  `create_date` datetime NOT NULL,
  `modify_date` varchar(50) NOT NULL,
  `last_login_time` varchar(50) NOT NULL,
  `news` text NOT NULL,
  `change_pass_status` char(1) NOT NULL DEFAULT '1',
  `change_pass_time` datetime NOT NULL,
  `status` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `code`, `password`, `email`, `dob`, `doj`, `gender`, `phone`, `country`, `state`, `city`, `c_address`, `p_address`, `image`, `marital_status`, `parent_relation`, `parent_name`, `parent_phone`, `parent_email`, `create_date`, `modify_date`, `last_login_time`, `news`, `change_pass_status`, `change_pass_time`, `status`) VALUES
(1, 'Sohan Gupta', 'admin_101', '3wcnn9r', '202cb962ac59075b964b07152d234b70', 'therishabhagrawal@gmail.com', '19-05-1990', '29-05-2014', 'Male', '8010979311', 'India', 'Uttar Pradesh', 'Ghaziabad', 'Malviya Nagar, New Delhi, India', '', 'default.png', '', 'Father', 'Deepak Gupta', '9865321245', 'Gungun Gupta', '2014-02-20 18:41:34', '', '', '*8**7**3**2**10**13**12**11*', '0', '2014-06-05 19:18:52', '1'),
(2, 'Shilpi Mishra', 'admin_102', '3wc4n91', '202cb962ac59075b964b07152d234b70', 'shilpi09@gmail.com', '16-11-1990', '29-05-2014', 'Female', '9865327845', 'India', 'Uttar Pradesh', 'Lucknow', 'Lucknow, India', 'Lucknow, India', 'admin_102.jpg', '', 'Father', 'Anuj Mishra', '8956784589', 'Usha Mishra', '2014-02-21 11:05:18', '14-06-03 18:00:03', '', '', '0', '2014-06-05 19:22:08', '1'),
(3, 'Rishabh', 'admin_103', '3wcnn44', '202cb962ac59075b964b07152d234b70', 'rishabh_agr@yahoo.com', '19-04-1990', '29-05-2014', 'Male', '8010979311', 'India', 'Uttar Pradesh', 'Kanpur', 'Sitapur, Lucknow, India', 'Sitapur, Lucknow, India', 'admin_103.jpg', '', 'Father', '', '', '', '2014-02-24 09:03:24', '14-05-21 20:01:12', '', '*8*', '1', '0000-00-00 00:00:00', '1'),
(4, 'Sachin Agrawal', 'admin_104', 'rrcnn91', '81dc9bdb52d04dc20036dbd8313ed055', 'sachin@gmail.com', '10-05-1989', '06-01-2014', 'Male', '8010979966', 'Guernsey', 'St. Saviour', 'Kerala', 'Kerala, India', 'Kerala, India', 'admin_104.jpg', '', 'Mother', 'Gita Devi', '8844775533', 'gita@gmail.com', '2014-05-10 00:48:22', '14-06-03 17:56:43', '', '*7**2**8**4**3*', '0', '2014-06-06 11:58:33', '1'),
(5, 'Rimpi Goel', 'admin_105', 'dfgnn91', '202cb962ac59075b964b07152d234b70', 'rimpi@gmail.com', '13-02-1991', '02-05-2014', 'Female', '8844775588', 'India', 'Goa', 'New Delhi', 'New Delhi', 'New Delhi', 'admin_1051.jpg', '', 'Father', '', '', '', '2014-05-10 01:00:27', '14-06-03 17:59:56', '', '', '1', '0000-00-00 00:00:00', '1'),
(6, 'Hello Hello', 'admin_106', '3wern91', '202cb962ac59075b964b07152d234b70', 'pawan_10@gmail.com,pankaj@gmail.com', '13-06-1989', '29-05-2014', 'Female', '8798657845', 'India', 'Himachal Pradesh', 'New Delhi', 'hello', 'hello', 'default.png', '', 'Mother', 'Gungun', '8956568956', 'gungun@gmail.com', '2014-05-30 16:48:19', '14-06-03 17:56:36', '', '', '1', '0000-00-00 00:00:00', '1'),
(7, 'Somya Gupta', 'admin_107', 'kkk3mc7', '202cb962ac59075b964b07152d234b70', 'somyatripathi90@yahoo.com', '12-02-1991', '29-05-2014', 'Female', '8010979365', 'India', 'Uttar Pradesh', 'Delhi', 'Malviya Nagar, New Delhi', 'Malviya Nagar, New Delhi', 'admin_107.jpg', '', 'Father', '', '', '', '2014-06-03 18:01:59', '', '', '', '1', '0000-00-00 00:00:00', '1');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timetable_id` varchar(20) NOT NULL,
  `student` text NOT NULL,
  `date` varchar(20) NOT NULL,
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `status` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `timetable_id`, `student`, `date`, `create_date`, `modify_date`, `status`) VALUES
(1, '91', '14,2', '20/05/2014', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1'),
(2, '373', '18', '20/05/2014', '0000-00-00 00:00:00', '2014-05-30 17:09:18', '1'),
(3, '373', '17', '19/05/2014', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1'),
(4, '373', '17', '16/05/2014', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1'),
(5, '373', '17,18', '12/05/2014', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1'),
(6, '373', '18', '05/05/2014', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1'),
(7, '574', '5,15', '20/05/2014', '2014-05-20 13:04:53', '0000-00-00 00:00:00', '1'),
(8, '584', '5,15', '20/05/2014', '2014-05-20 13:24:14', '0000-00-00 00:00:00', '1'),
(9, '343', '20,21', '22/05/2014', '2014-05-22 16:24:39', '0000-00-00 00:00:00', '1'),
(10, '91', '14,8,2', '22/05/2014', '2014-05-22 16:24:53', '0000-00-00 00:00:00', '1'),
(11, '571', '5,3,15,1', '22/05/2014', '2014-05-22 16:25:08', '0000-00-00 00:00:00', '1'),
(12, '373', '17,18', '22/05/2014', '2014-05-22 16:33:18', '0000-00-00 00:00:00', '1'),
(13, '373', '17,18', '21/05/2014', '2014-05-22 16:33:29', '0000-00-00 00:00:00', '1'),
(14, '373', '18', '17/05/2014', '2014-05-22 16:33:50', '0000-00-00 00:00:00', '1'),
(15, '373', '17,18', '28/05/2014', '2014-05-30 12:20:46', '0000-00-00 00:00:00', '1'),
(16, '373', '18', '30/05/2014', '2014-05-30 17:08:34', '0000-00-00 00:00:00', '1'),
(17, '377', '18', '03/06/2014', '2014-06-03 12:49:06', '2014-06-03 12:49:19', '1');

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE IF NOT EXISTS `batch` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `students` varchar(20) NOT NULL,
  `status` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`id`, `name`, `course`, `subject`, `students`, `status`) VALUES
(2, 'Batch 401', '17', '1/7/4/3/2', '', '1'),
(3, 'Batch 301', '16', '6/4/5/3/8', '', '1'),
(4, 'Batch 203', '15', '1/6/9/4/5/10/8/2', '', '1'),
(5, 'Batch 101', '14', '1/9/7/4/10/3/2', '', '1'),
(6, 'Batch 102', '14', '1/7/4/3/5', '', '1'),
(7, 'Batch 201', '15', '9/5/4/1/2', '', '1'),
(8, 'Batch 202', '15', '8/6/4/2', '', '1'),
(9, 'Batch 302', '16', '5/4/1/3/9', '', '1'),
(10, 'Batch 303', '16', '8/1/7/2/9', '', '1'),
(11, 'Batch 402', '17', '1/6/9', '', '1'),
(12, 'Batch 403', '17', '1/6/9/7/3/2/11', '', '1'),
(13, 'Batch 404', '17', '1/6/9/4/5/10', '', '1'),
(14, 'Batch 405', '17', '1/6/9/4/5/10/8/3/2/11', '', '1'),
(15, 'Batch 501', '18', '1/6/9/4/5/3/2/11', '', '1'),
(16, 'Batch 502', '18', '1/6/5/10/2', '', '1'),
(17, 'Batch 601', '21', '6/9/4/5/10', '', '1'),
(18, 'Batch 602', '21', '1/6/9/5/10', '', '1'),
(19, 'Batch 503', '18', '1/6/9/7/4/5/10/2/11', '', '1'),
(20, 'Batch 504', '18', '1/6/9/7/4/10/8/2/11', '', '1'),
(21, 'Batch 506', '18', '1/6/9/7/4/5/10/8/3/2', '', '1'),
(22, 'Batch 507', '18', '1/6/9/7/4/5/10/8/3/2/11', '', '1'),
(23, 'Batch1001', '15', '7/4/10/8/3/2/12/11', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `academic_year` varchar(255) NOT NULL,
  `fee` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `discount_mode` varchar(255) NOT NULL,
  `discount_amount` varchar(255) NOT NULL,
  `net_fee_amount` varchar(255) NOT NULL,
  `instalment_applicable` varchar(255) NOT NULL,
  `no_of_instalment` varchar(255) NOT NULL,
  `instalment_mode` varchar(255) NOT NULL,
  `instalment_amount` varchar(255) NOT NULL,
  `status` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `name`, `academic_year`, `fee`, `discount`, `discount_mode`, `discount_amount`, `net_fee_amount`, `instalment_applicable`, `no_of_instalment`, `instalment_mode`, `instalment_amount`, `status`) VALUES
(14, 'IIT', '2014-2015', '50000', 'yes', 'percent', '5.22', '47390.00', 'yes', '3', 'fix', '25000/15000/7390', '1'),
(15, 'AIEEE', '2014-2015', '36000', 'yes', 'percent', '10.52', '32212.80', 'yes', '3', 'percent', '75/15/10', '1'),
(16, 'AIPMT & AIIMS', '2014-2015', '45000', 'yes', 'fix', '450', '44550.00', 'yes', '3', 'percent', '22/34/44', '1'),
(17, 'IIT Foundation', '2014-2015', '35000', 'yes', 'percent', '10', '31500.00', 'no', '', '', '', '1'),
(18, 'IIT Correspondence', '2014-2015', '50000', 'yes', 'fix', '500', '49500.00', 'yes', '2', 'fix', '25/49475', '1'),
(21, 'AIEEE Correspondence', '2014-2015', '50000', 'yes', 'fix', '500', '49500.00', 'yes', '2', 'percent', '80/20', '1');

-- --------------------------------------------------------

--
-- Table structure for table `lecture_schedule`
--

CREATE TABLE IF NOT EXISTS `lecture_schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `batch` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `status` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `lecture_schedule`
--

INSERT INTO `lecture_schedule` (`id`, `batch`, `comment`, `status`) VALUES
(2, '2', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', '1'),
(6, '3', '', '1'),
(8, '19', '', '1'),
(20, '15', '', '1'),
(21, '11', '', '1'),
(23, '18', '', '1'),
(24, '16', '', '1'),
(28, '20', '', '1'),
(31, '5', '', '1'),
(32, '17', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1'),
(34, '21', 'hello', '1');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `create_user` varchar(50) NOT NULL,
  `news_title` varchar(255) NOT NULL,
  `news_type` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `publish_time` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `share_with` text NOT NULL,
  `custome_share` varchar(255) NOT NULL,
  `active` char(1) NOT NULL DEFAULT '1',
  `status` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `code`, `create_user`, `news_title`, `news_type`, `description`, `attachment`, `publish_time`, `create_date`, `modify_date`, `share_with`, `custome_share`, `active`, `status`) VALUES
(1, 'r78633', 'admin_101', 'Holi Leave', '1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop', '', '21-05-2014', '2014-05-21 17:34:23', '0000-00-00 00:00:00', 'all', '', '1', '1'),
(2, 'r786lw', 'admin_103', 'Testing News', '1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop', '', '22-05-2014', '2014-05-22 17:34:23', '0000-00-00 00:00:00', 'custome', 'student', '0', '1'),
(3, 'ixv2e5', 'staff_102', 'News staff', '1', 'Located on the second floor at the PVR Saket complex , above Pind Baluchi Restaurant, which used to be " Buzz " till some time back . The market as such is over its peak days . The crowd is getting worse day by day . The particular place is only good to get drunk . Do not expect a fancy place to with your Girlfriend . The place is a bit dark and dingy . You will hardly find any Ladies even on the Ladies night . The food and service is nothing great to talk about .', 'zzh500.png', '06-06-2014', '2014-05-22 18:57:21', '2014-05-30 16:30:15', 'custome', 'staff,student', '1', '1'),
(4, '74ana1', 'admin_101', 'News 1234', '2', 'Seedy is the word that describes this place is the upscale market of saket. We chanced upon this place on the back of a very bad movie. This place just made the day worse. Although looking a very charming and hiphop from the outside, it sorely disappoints the moment you enter. That’s the reason probably why there were hardly any ladies there even on a ladies night(Thursday). Dank and dark, this place offers bad food at high prices alongwith a extremely poor service.\r\nWe ordered a few beers and a veg platter alongwith it. We also took a pan flavoured sheesha( my first one). We also ordered a mocktail which they got terribly wrong. It had to be replaced twice before they got it right. The beers tasted stale and watered down. The sheesha tasted great ( but it was kinda my first time so the bar is pretty low, I guess). The food although hot did not taste great even if you get drunk . Although we left at around 11 pm but still the place hadn’t started stirring.\r\nI guess this is a place to go if you don’t find any space in saket on a Saturday and still need to party. But it’s better to get booze and drink in the car rather than go this place.', 'r786l6.docx', '22-05-2014', '2014-05-22 18:57:35', '2014-05-23 16:49:25', 'all', '', '0', '1'),
(5, '8h6fo2', 'admin_101', 'Testing 112233', '1', 'There was a time when T''Zers had its own charm in the southern part of South Delhi. But with time, and with places like City Walk and Hauz Khas Village becoming a hub for pub goers, the whole lot of resto-bars around PVR Saket have suffered. But it''s a great place if you''re looking for a casual place to hang out, if you''re not into the commercialized stuff and if you''ve really good company..\r\nThe food is kinda okay, ambiance nice, service poor.', '', '22-05-2014', '2014-05-22 18:59:41', '2014-05-23 16:49:05', 'all', '', '1', '1'),
(6, 'hl5ck8', 'admin_101', 'Hello Testing 11', '4', 'You can''t achieve this using standard input control. Common techniques include validating this on the server side or use some Flash upload control which allows more customizations. Also bare in mind that verifying the file extension is a necessary but not a sufficient condition that a file is image. There''s nothing preventing the user from renaming an executable to .jpg for example.', '', '28-05-2014', '2014-05-22 19:09:18', '2014-05-23 13:22:51', 'custome', 'staff,student', '1', '1'),
(7, 'nxaa44', 'admin_102', 'Testing One Two Three', '2', 'In the example above, we used the column alias for each column in the SELECT statements. What would be the output if we didn’t use the column alias? MySQL uses the names of columns in the first SELECT statement as the labels for the output.', 'nxaa44.jpg', '24-05-2014', '2014-05-24 01:26:36', '0000-00-00 00:00:00', 'all', '', '0', '1'),
(8, '3tjll3', 'staff_104', '1914 translation by H. Rackham', '2', 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?', '3tjll3.png', '30-05-2014', '2014-05-30 14:04:20', '0000-00-00 00:00:00', 'custome', 'student', '1', '1'),
(9, '2g5g34', 'admin_101', ' Hindu Business Line See realtime coverage	 Invite to SAARC nations to showcase strength of Indian', '2', 'Jaitley said the general election has been a great celebration of Indian democracy, it being the world''s largest democratic election, and for it to be completed peacefully in a fair manner resulting in a democratic change of power is an occasion that does India proud. \r\n\r\nHe said the swearing-in ceremony of the Prime Minister- designate Narendra Modi and his Council of Ministers on May 26 will be culmination of these celebrations, before the new government gets down to work. \r\n\r\nSources said Modi, after being appointed the Prime Minister, had conveyed to Rashtrapati Bhawan and the External Affairs Ministry his desire that leaders of all SAARC nations be invited to attend his swearing-in.', '2g5g34.jpg', '30-05-2014', '2014-05-30 16:31:58', '0000-00-00 00:00:00', 'all', '', '1', '1'),
(10, '40ixh5', 'staff_103', 'Hello Testing 12', '2', 'NEW DELHI: The BJP on Saturday expressed "delight" at the decision of Nawaz Sharif to attend the oath-taking ceremony of Narendra Modi as Prime Minister while Congress asked the new government to raise issues such as cross-border terrorism, slow .', 'mudv92.png', '30-05-2014', '2014-05-30 18:47:38', '2014-05-30 18:48:02', 'all', '', '1', '1'),
(11, 'pvi111', 'staff_101', 'Congress MPs Elect Sonia Gandhi as Party Chairperson', '2', 'You are free to use this icon for commercial purposes, to share or to modify it. In exchange, it''s necessary to credit the author for the original creation. You are free to use this icon for commercial purposes, to share or to modify it. In exchange, it''s necessary to credit the author for the original creation. You are free to use this icon for commercial purposes, to share or to modify it. In exchange, it''s necessary to credit the author for the original creation.', 'pvi111.jpg', '31-05-2014', '2014-05-30 23:19:46', '0000-00-00 00:00:00', 'all', '', '0', '1'),
(12, 'cecvk7', 'staff_101', 'Sonia, Rahul Gandhi to Attend Narendra Modi''s Swearing-In', '1', 'Congress president Sonia Gandhi and her son and party vice-president Rahul will represent Congress at the swearing-in ceremony of Narendra Modi as Prime Minister on Monday.\r\n\r\nThe Congress president had congratulated Mr Modi on May 20, hours after he was elected leader of BJP Parliamentary Party and the National Democratic Alliance or, thereby setting the stage for him to become Prime Minister.\r\n\r\nMrs Gandhi is also the Chairperson of the Congress-led UPA.\r\n\r\nMr Gandhi had led the party in the Lok Sabha polls. Congress saw the worst debacle after remaining in office for ten years.', '', '31-05-2014', '2014-05-30 23:20:45', '0000-00-00 00:00:00', 'all', '', '1', '1'),
(13, 'fq5cg4', 'admin_103', 'An Open Letter From Prisoner No. 3642, Arvind Kejriwal', '2', 'Aam Aadmi Party (AAP) leader Arvind Kejriwal today explained to his supporters the circumstances behind him being in jail even as his party launched a mass contact programme over the issue to strengthen its support base with an eye on Assembly elections in Delhi. (Kejriwal to Remain in Jail Till June 6)\r\n\r\n"I took on former BJP President Nitin Gadkari and exposed him, but he is roaming scot-free and I have been put in jail. They asked me to take bail, but what crime have I committed to take bail?" Mr Kejriwal said in a letter, which was signed "Prisoner No. 3642, Jail No. 4, Tihar." (Nitin Gadkari slaps defamation notice on Arvind Kejriwal)', '', '04-06-2014', '2014-05-30 23:43:28', '0000-00-00 00:00:00', 'all', '', '1', '1'),
(14, '722vh8', 'admin_101', 'Hello', '5', 'hello 1234', '722vh8.jpg', '2014-05-31 00:00:01', '2014-05-30 17:11:22', '0000-00-00 00:00:00', 'custome', 'student', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `news_type`
--

CREATE TABLE IF NOT EXISTS `news_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `status` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `news_type`
--

INSERT INTO `news_type` (`id`, `name`, `status`) VALUES
(1, 'Holi', '1'),
(2, 'Holiday hello', '1'),
(3, 'Mega Festival', '0'),
(4, 'Technical Event', '1'),
(5, 'examination holiday', '1'),
(6, 'asdfghj', '1');

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE IF NOT EXISTS `organization` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `status` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`id`, `name`, `logo`, `country`, `state`, `city`, `phone`, `email`, `website`, `address`, `status`) VALUES
(1, 'LearnEx Education', 'logo10.jpg', 'India', 'Rajasthan', 'Jaipur', '9865895689,9898986598', 'contact@learnexeducation.com,info@learnexeducation.com', 'http://www.learnexeducation.com', 'A-281, Shivalik, Malviya Nagar, New delhi (585869)', '1');

-- --------------------------------------------------------

--
-- Table structure for table `organization_location`
--

CREATE TABLE IF NOT EXISTS `organization_location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location_name` varchar(255) NOT NULL,
  `location_head` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `country` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `status` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `organization_location`
--

INSERT INTO `organization_location` (`id`, `location_name`, `location_head`, `address`, `country`, `state`, `city`, `phone`, `email`, `website`, `created_date`, `modify_date`, `status`) VALUES
(1, 'Career Point Jaipur', 'Ram Prashad Gupta', '12/14 H block Bulbulaiya, Jaipur, India', 'India', 'Rajasthan', 'Jaipur', '9865324578,9945783265', 'contact@careerpoint.com', 'http://www.careerpoint.com', '2014-03-14 11:32:14', '2014-03-14 11:33:41', '1'),
(2, 'CP Haryana', 'Alok nath', '123 Basecamp, srinivasan road, iyappa. ', 'India', 'Haryana', 'Rohtak', '3332564831,021554468794', 'alok@cp.com', 'http://www.careerpointharyana.com', '2014-03-11 13:12:25', '2014-03-11 13:12:25', '1'),
(3, 'Career Point Delhi', 'Rajesh Gupta', 'CP-102 Basement, Near Block A, New Delhi', 'India', 'Delhi', 'New Delhi', '9856987777,9878885888', 'cpdelhi@careerpoint.com,cpdelhi@careerpoint.in', '', '2014-03-16 18:10:40', '2014-04-07 09:15:32', '1'),
(5, 'Codebibber', 'Hello Rishabh', 'Near Malviya Nagar', 'Hungary', 'Debrecen', 'New Delhi', '9888802023,9845659898,9865324578', 'contact@learnexeducation.com,contact@careerpoint.com,hello@gmail.com', '', '2014-04-04 09:03:19', '2014-04-04 11:37:49', '1'),
(6, 'LearnEx Education', 'Rishabh', '12/14 H block Bulbulaiya, Pune, India', 'Namibia', 'Karas', 'Punjab India', '9845659898', 'contact@careerpoint.com,contact@learnexeducation.com', '', '2014-04-04 09:10:45', '2014-04-09 15:32:36', '1'),
(7, 'Codebibber Noida', 'Neeraj', 'Hello Testing, Noida, India (858598)', 'Iceland', 'Akureyri', 'New Delhi', '9855585968,8585745875,8956587458', 'contact@learnexeducation.com,info@codebibber.co.in', '', '2014-04-04 11:34:11', '2014-04-07 14:22:34', '1');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` varchar(100) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `doj` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `c_address` varchar(255) NOT NULL,
  `p_address` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `staff_type` varchar(255) NOT NULL,
  `emp_type` varchar(255) NOT NULL,
  `marital_status` varchar(255) NOT NULL,
  `parent_name` varchar(255) NOT NULL,
  `parent_relation` varchar(255) NOT NULL,
  `parent_phone` varchar(255) NOT NULL,
  `parent_email` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `news` text NOT NULL,
  `status` char(1) NOT NULL DEFAULT '1',
  `change_pass_status` char(1) NOT NULL DEFAULT '1',
  `change_pass_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `username`, `password`, `code`, `dob`, `email`, `phone`, `doj`, `gender`, `c_address`, `p_address`, `country`, `state`, `city`, `image`, `staff_type`, `emp_type`, `marital_status`, `parent_name`, `parent_relation`, `parent_phone`, `parent_email`, `create_date`, `modify_date`, `news`, `status`, `change_pass_status`, `change_pass_time`) VALUES
(1, 'Rishabh Agrawal', 'staff_101', '202cb962ac59075b964b07152d234b70', 'trl9a21', '11-07-1985', 'rishabh_agr@yahoo.com', '8010979311,8010989885', '12-01-2014', 'Male', 'Delhi', 'Delhi', 'India', 'Delhi', 'New Delhi', 'm9m1q68.jpg', 'Teaching', 'Permanent', '', 'Rakesh Mittal', 'Father', '9898657845', 'rakeshmittal735@gmail.com', '0000-00-00 00:00:00', '2014-06-03 23:38:25', '*12**13**3**5*', '1', '1', '0000-00-00 00:00:00'),
(2, 'Shilpi Mishra', 'staff_102', '202cb962ac59075b964b07152d234b70', '7bw0dy5', '11-07-1990', 'shilpi_agr@yahoo.com', '8010955311,8018589885', '22-02-2014', 'Female', 'Lucknow', 'Delhi', 'India', 'Delhi', 'New Delhi', 'y106g31.jpg', 'Non Teaching', 'Contract Based', '', 'Anuj Agrawal', 'Father', '9898658845', 'anuj_agr@gmail.com', '0000-00-00 00:00:00', '2014-06-03 23:38:41', '', '1', '1', '0000-00-00 00:00:00'),
(3, 'Mayank Agrawal', 'staff_103', '202cb962ac59075b964b07152d234b70', '6ptlwq0', '07-11-1989', 'mayank_agr@yahoo.com,mayank.agr@gmail.com', '801855311,8085589885', '14-02-2013', 'Male', 'Delhi', 'Delhi', 'India', 'Delhi', 'New Delhi', 'k6vuvo9.jpg', 'Non Teaching', 'Part Time', '', 'Rakesh Agrawal', 'Father', '988688845', 'rakeshmittal7@gmail.com', '0000-00-00 00:00:00', '2014-06-03 23:38:52', '', '1', '1', '0000-00-00 00:00:00'),
(4, 'Rituja Gupta', 'staff_104', '202cb962ac59075b964b07152d234b70', 'd2c4l00', '11-07-1991', 'rituja@gmail.com', '9845781245', '15-04-2014', 'Female', 'Lucknow, India', 'Lucknow, India', 'India', 'Uttar Pradesh', 'Lucknow', 'o1krjy7.jpg', 'Teaching', 'Permanent', '', 'Ram Gopal Gupta', 'Father', '9878457845', 'ram@gmail.com', '0000-00-00 00:00:00', '2014-06-03 23:39:11', '*7*', '1', '1', '0000-00-00 00:00:00'),
(6, 'Pankaj Singh', 'staff_106', '202cb962ac59075b964b07152d234b70', '5bfdz05', '11-07-1985', 'pankaj@gmail.com', '9865784578', '19-01-2014', 'Male', 'Kota, Rajasthan, India (986565)', 'Kota, Rajasthan, India (986565)', 'India', 'Rajasthan', 'Kota', 'm7utdh1.jpg', 'Teaching', 'Permanent', '', '', 'Father', '', '', '0000-00-00 00:00:00', '2014-06-03 23:39:31', '', '1', '1', '0000-00-00 00:00:00'),
(7, 'Mohit Mishra', 'staff_107', '202cb962ac59075b964b07152d234b70', 'uq23ag1', '11-02-1991', 'mohit@gmail.com', '8754895612', '14-01-2014', 'Male', 'Jaipur India', 'Jaipur India', 'India', 'Rajasthan', 'Jaipur', 'z4b3bh6.jpg', 'Teaching', 'Part Time', '', '', 'Father', '', '', '0000-00-00 00:00:00', '2014-06-03 23:39:49', '', '1', '1', '0000-00-00 00:00:00'),
(8, 'Somya', 'staff_108', '202cb962ac59075b964b07152d234b70', 'x2k8710', '05-08-1970', 'somyatripathi90@yahoo.com', '9865784555,9847854789', '22-12-2013', 'Female', 'Lucknow, India (266655)', 'Lucknow, India (266655)', 'Hong Kong', 'Hong Kong', 'Lucknow', '5qw9pl3.jpg', 'Teaching', 'Part Time', '', '', 'Father', '', '', '0000-00-00 00:00:00', '2014-06-03 23:40:06', '', '1', '1', '0000-00-00 00:00:00'),
(9, 'Shivani Garg', 'staff_109', '202cb962ac59075b964b07152d234b70', 'znieih3', '11-07-1992', 'shivanigarg9@gmail.com', '9878787845', '25-11-2013', 'Female', 'Mohan Nagar, Delhi, India', 'Mohan Nagar, Delhi, India', 'India', 'Delhi', 'New Delhi', '11fmwx3.jpg', 'Teaching', 'Contract Based', '', '', 'Father', '', '', '0000-00-00 00:00:00', '2014-06-03 23:40:19', '', '1', '1', '0000-00-00 00:00:00'),
(10, 'Mukesh Gupta', 'staff_110', '202cb962ac59075b964b07152d234b70', 'jeewyq6', '07-01-1990', 'mukeshgupta99@yahoo.com', '9878787845', '29-11-2013', 'Male', 'Jammu, India', 'Jammu, India', 'India', 'Jammu and Kashmir', 'Jammu', 'ijwkri4.jpg', 'Non Teaching', 'Part Time', '', '', 'Father', '', '', '0000-00-00 00:00:00', '2014-06-03 23:40:32', '*12**9**13*', '1', '1', '0000-00-00 00:00:00'),
(11, 'Manish Mishra', 'staff_111', '202cb962ac59075b964b07152d234b70', '0m2z005', '07-11-1991', 'manish@gmail.com', '9865558899', '30-11-2013', 'Male', 'Jaipur', 'Jaipur', 'Afghanistan', 'Badakhshan', 'Jaipur', 'ihr2u25.jpg', 'Teaching', 'Permanent', '', '', 'Father', '', '', '0000-00-00 00:00:00', '2014-06-03 23:41:30', '', '1', '1', '0000-00-00 00:00:00'),
(12, 'Gungun Saxena', 'staff_112', '202cb962ac59075b964b07152d234b70', 'kr2s4l2', '09-01-1992', 'gungun@gmail.com', '985858747434', '30-10-2013', 'Female', 'Hardoi, Uttar Pradesh, India (264587)', 'A-123, B Block Shivalik\n', 'India', 'Delhi', 'New Delhi', 'ep7man7.jpg', 'Teaching', 'Permanent', '', '', 'Father', '', '', '0000-00-00 00:00:00', '2014-06-03 23:41:58', '', '1', '1', '0000-00-00 00:00:00'),
(13, 'Ram Sharma', 'staff_113', '202cb962ac59075b964b07152d234b70', 'tvcn9k3', '11-07-1992', 'Leela@server.net', '999090901028', '22-12-2014', 'Female', 'Singhania palace, near badi haweli', 'Singhania palace, near badi haweli', 'India', 'Rajasthan', 'udaipur', 'lu4jpx1.jpg', 'Teaching', 'Permanent', '', 'Ram Gopal', 'Father', '9845785869', 'ramgopal@yahoo.com', '0000-00-00 00:00:00', '2014-06-03 23:42:12', '', '1', '1', '0000-00-00 00:00:00'),
(14, 'Sachin Garg', 'staff_114', '202cb962ac59075b964b07152d234b70', 'l7dj390', '11-06-1985', 'sachin@gmail.com', '9845781245,9865784556', '12-11-2013', 'Male', 'Jalandhar, Punjab (525265)', 'Jalandhar, Punjab (525265)', 'India', 'Punjab', 'Jalandhar', 'cg2fkc1.jpg', 'Teaching', 'Permanent', '', 'Gagan Garg', 'Father', '', '', '0000-00-00 00:00:00', '2014-06-03 23:42:59', '', '1', '1', '0000-00-00 00:00:00'),
(15, 'Mohit Gupta', 'staff_115', '202cb962ac59075b964b07152d234b70', '4mit155', '01-03-1990', 'mohit@gmail.com', '9847854789', '01-08-2014', 'Male', 'Delhi', 'Delhi', 'India', 'Karnataka', 'Delhi', 'mba1mc1.jpg', 'Non Teaching', 'Permanent', '', '', 'Father', '', '', '0000-00-00 00:00:00', '2014-06-03 23:43:23', '', '1', '1', '0000-00-00 00:00:00'),
(16, 'Mayank Goel', 'staff_116', '202cb962ac59075b964b07152d234b70', 'cl4fwm5', '25-07-1991', 'mayank@gmail.com', '9878457878', '06-02-2014', 'Male', 'A-299 Mohan Ganj, Aara, Bihar (885569)', 'A-299 Mohan Ganj, Aara, Bihar (885569)', 'India', 'Bihar', 'Aara', '66ob5g8.jpg', 'Non Teaching', 'Part Time', '', '', 'Guardian', '', '', '0000-00-00 00:00:00', '2014-06-03 23:36:26', '', '1', '1', '0000-00-00 00:00:00'),
(17, 'Pawan Singh', 'staff_117', '202cb962ac59075b964b07152d234b70', 't7iwsg0', '23-02-1990', 'pawan_10@gmail.com', '8798657845', '15-07-2014', 'Male', 'Shivalik, Malviya Nagar, New Delhi', 'Shivalik, Malviya Nagar, New Delhi', 'India', 'Delhi', 'New Delhi', '8lg4f89.jpg', 'Teaching', 'Permanent', '', 'Gita Gupta', 'Mother', '8855665588', 'gita98787@gmail.com', '2014-04-23 08:16:30', '2014-06-03 23:35:35', '', '1', '1', '0000-00-00 00:00:00'),
(18, 'Kalpana Yadav', 'staff_118', '202cb962ac59075b964b07152d234b70', '3wcnn91', '15-06-1988', 'kalpana@gmail.com', '9874859673', '07-05-2014', 'Female', 'Lucknow India', 'Lucknow India', 'India', 'Uttar Pradesh', 'Lucknow', 'abd8gf4.jpg', 'Teaching', 'Permanent', '', 'Juhi Yadav', 'Mother', '9475824394', 'juhi@gmail.com', '2014-05-14 23:59:25', '2014-06-04 00:00:04', '', '1', '1', '0000-00-00 00:00:00'),
(19, 'Pankaj Goyal', 'staff_119', '202cb962ac59075b964b07152d234b70', 'vhq2sn3', '12-07-1989', 'pankaj_goyal@gmail.com,pankaj_g@yahoo.com', '8956784842,8745258741', '15-05-2014', 'Male', 'New Bus Stop, Malviya Nagar, Delhi', 'New Bus Stop, Malviya Nagar, Delhi', 'India', 'Delhi', 'New Delhi', '27muwo7.jpg', 'Teaching', 'Permanent', '', 'Gungun Goyal', 'Mother', '8965874698', 'gungun_goyal@gmail.com', '2014-05-30 16:17:43', '2014-06-03 23:34:54', '', '1', '1', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `stu`
--

CREATE TABLE IF NOT EXISTS `stu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `doj` varchar(20) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `blood_group` varchar(20) NOT NULL,
  `category` varchar(100) NOT NULL,
  `class` varchar(20) NOT NULL,
  `country` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `city` varchar(200) NOT NULL,
  `parent_relation` varchar(200) NOT NULL,
  `parent_name` varchar(200) NOT NULL,
  `parent_occupation` varchar(200) NOT NULL,
  `parent_phone` varchar(200) NOT NULL,
  `parent_email` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `current_address` varchar(255) NOT NULL,
  `permanent_address` varchar(255) NOT NULL,
  `course` varchar(100) NOT NULL,
  `batch` varchar(100) NOT NULL,
  `total_amount` varchar(20) NOT NULL,
  `discount` varchar(20) NOT NULL,
  `discount_mode` varchar(20) NOT NULL,
  `discount_amount` varchar(20) NOT NULL,
  `net_amount` varchar(20) NOT NULL,
  `pay_amount` varchar(20) NOT NULL,
  `payment_mode` varchar(20) NOT NULL,
  `cheque_number` varchar(50) NOT NULL,
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `last_login_time` datetime NOT NULL,
  `news` text NOT NULL,
  `status` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `stu`
--

INSERT INTO `stu` (`id`, `name`, `username`, `password`, `code`, `image`, `dob`, `doj`, `gender`, `blood_group`, `category`, `class`, `country`, `state`, `city`, `parent_relation`, `parent_name`, `parent_occupation`, `parent_phone`, `parent_email`, `email`, `phone`, `current_address`, `permanent_address`, `course`, `batch`, `total_amount`, `discount`, `discount_mode`, `discount_amount`, `net_amount`, `pay_amount`, `payment_mode`, `cheque_number`, `create_date`, `modify_date`, `last_login_time`, `news`, `status`) VALUES
(5, 'Rishabh Agrawal', 'student_1001', '202cb962ac59075b964b07152d234b70', 'vlhl1z7', 'default.png', '20-04-1990', '20-08-2013', 'Male', 'A-', 'General', 'XII', 'India', 'Delhi', 'Delhi', 'Father', 'Rakesh Agrawa', 'Business', '9415059209', 'rakeshmittal735@gmail.com', 'rishabh_agr@yahoo.com', '8010979311', 'Near Bus Stop, Teacher Colony, Maholi (Sitapur)', 'Near Bus Stop, Teacher Colony, Maholi (Sitapur)', '15', '', '32212.80', 'Yes', 'Fix', '5000', '27212.8', '10000', 'Cheque', '2587412598', '2014-06-02 18:29:17', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '1'),
(6, 'Sachin Yadav', 'student_1002', '202cb962ac59075b964b07152d234b70', 'gh3o2x3', 'default.png', '20-08-1992', '21-05-2013', 'Female', 'AB-', 'General', 'XII', 'India', 'Maharashtra', 'Pune', 'Father', 'Ram Gopal', 'Business', '9548475869', 'ramgopal@gmail.com', 'sachinyadav@gmail.com', '8487586951', 'Pune(India)', 'Pune (India)', '14', '', '47390.00', '', '', '', '', '', '', '', '2014-06-02 18:29:17', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '1'),
(7, 'Mayank Agrawal', 'student_1003', '202cb962ac59075b964b07152d234b70', 'sgkg0a1', 'default.png', '20-06-1992', '16-08-2013', 'Male', 'A+', 'General', 'XII', 'India', 'Punjab', 'Punjab', 'Mother', 'Urmila Agrawal', 'House Wife', '8745896587', 'urmila@gmail.com', 'mayankagrawal@gmail.com', '9874587412', 'Jalandhar (India)', 'Jalandhar (India)', '15', '', '32212.80', '', '', '', '', '', '', '', '2014-06-02 18:29:17', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '1'),
(8, 'Garima Gupta', 'student_1004', '202cb962ac59075b964b07152d234b70', 'utltd70', 'default.png', '19-02-1994', '13-02-2014', 'Female', 'O-', 'OBC', 'VIII', 'India', 'Uttar Pradesh', 'Kanpur', 'Mother', 'Gita Gupta', 'Doctor', '9874587415', 'gitagupta@gmail.com', 'garimagupta@gmail.com', '9874587429', 'Kanpur (India)', 'Kanpur (India)', '14', '', '47390.00', 'Yes', 'Percent', '50', '16106.4', '5000', 'Cash', '', '2014-06-02 18:29:17', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `doj` varchar(20) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `blood_group` varchar(20) NOT NULL,
  `category` varchar(100) NOT NULL,
  `class` varchar(20) NOT NULL,
  `country` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `city` varchar(200) NOT NULL,
  `parent_relation` varchar(200) NOT NULL,
  `parent_name` varchar(200) NOT NULL,
  `parent_occupation` varchar(200) NOT NULL,
  `parent_phone` varchar(200) NOT NULL,
  `parent_email` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `current_address` varchar(255) NOT NULL,
  `permanent_address` varchar(255) NOT NULL,
  `course` varchar(100) NOT NULL,
  `batch` varchar(100) NOT NULL,
  `total_amount` varchar(20) NOT NULL,
  `discount` varchar(20) NOT NULL,
  `discount_mode` varchar(20) NOT NULL,
  `discount_amount` varchar(20) NOT NULL,
  `net_amount` varchar(20) NOT NULL,
  `pay_amount` varchar(20) NOT NULL,
  `payment_mode` varchar(20) NOT NULL,
  `cheque_number` varchar(50) NOT NULL,
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `last_login_time` datetime NOT NULL,
  `news` text NOT NULL,
  `change_pass_status` char(1) NOT NULL DEFAULT '1',
  `change_pass_time` datetime NOT NULL,
  `status` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `username`, `password`, `code`, `image`, `dob`, `doj`, `gender`, `blood_group`, `category`, `class`, `country`, `state`, `city`, `parent_relation`, `parent_name`, `parent_occupation`, `parent_phone`, `parent_email`, `email`, `phone`, `current_address`, `permanent_address`, `course`, `batch`, `total_amount`, `discount`, `discount_mode`, `discount_amount`, `net_amount`, `pay_amount`, `payment_mode`, `cheque_number`, `create_date`, `modify_date`, `last_login_time`, `news`, `change_pass_status`, `change_pass_time`, `status`) VALUES
(1, 'Rishabh Mittal', 'student_1001', '202cb962ac59075b964b07152d234b70', 'wubxva0', 'tmq99h6.jpg', '20-04-1990', '12-05-2014', 'Male', 'O+', 'General', 'XII', 'India', 'Delhi', 'New Delhi', 'Father', 'Rakesh Kumar Agrawal', 'Business', '9415059200', 'rakesh@gmail.com', 'rishabh_agr@gmail.com,therishabhagrawal@yahoo.com', '9845784578', 'Sitapur, Uttar Pradesh, India (261141)', 'Sitapur, Uttar Pradesh, India (261141)', '14', '6', '', '', '', '', '', '', '', '', '2014-05-10 14:20:56', '2014-06-04 00:08:26', '0000-00-00 00:00:00', '', '1', '0000-00-00 00:00:00', '1'),
(2, 'Sachin Yadav', 'student_1002', '202cb962ac59075b964b07152d234b70', 'ok7ano0', '5o2x1m1.jpg', '11-05-1989', '06-05-2014', 'Male', 'O-', 'OBC', 'VIII', 'India', 'Delhi', 'New Delhi', 'Father', 'Ram Lal', 'Farmer', '8855221144', 'Ramlal@gmail.com', 'sachin@yahoo.com', '897954786', 'Pune', 'Pune', '16', '9', '', '', '', '', '', '', '', '', '2014-05-11 14:20:56', '2014-06-04 00:08:46', '0000-00-00 00:00:00', '', '1', '0000-00-00 00:00:00', '1'),
(3, 'Mayank Goel', 'student_1003', '202cb962ac59075b964b07152d234b70', 'k01r469', 'bxaaik7.jpg', '03-05-1990', '10-05-2014', 'Male', 'AB-', 'General', 'XII', 'Bahrain', 'Al Manamah', 'New Delhi', 'Mother', 'Gita Devi', 'Business', '8855224488', 'gita@gmail.com', 'mayank@gmail.com', '9878457878', 'Malviya Nagar, New Delhi (585749)', 'Malviya Nagar, New Delhi (585749)', '14', '6', '', '', '', '', '', '', '', '', '2014-05-11 14:32:35', '2014-06-04 00:08:57', '0000-00-00 00:00:00', '', '1', '0000-00-00 00:00:00', '1'),
(4, 'Shivani Garg', 'student_1004', '202cb962ac59075b964b07152d234b70', 'ygnbrg8', 'hw9gf08.jpg', '10-03-1989', '02-05-2014', 'Female', 'O+', 'General', 'XII', 'India', 'Uttar Pradesh', 'Ghaziabad', 'Mother', 'Gungun Garg', 'House Wife', '9988555566', 'gungun_garg@outlook.com', 'shivani09@yahoo.com', '9855698745', 'Rajnagar, Ghaziabad, 258548 India', 'Rajnagar, Ghaziabad, 258548 India', '14', '5', '', '', '', '', '', '', '', '', '2014-05-11 16:28:41', '2014-06-04 00:09:34', '0000-00-00 00:00:00', '', '1', '0000-00-00 00:00:00', '1'),
(5, 'Garima Gupta', 'student_1005', '202cb962ac59075b964b07152d234b70', 'ca5ghz1', '2krih24.jpg', '15-06-1988', '03-05-2014', 'Female', 'B+', 'OBC', 'XI', 'India', 'Uttar Pradesh', 'Kanpur', 'Mother', 'Gita Gupta', 'House Wife', '9958745869', 'gita_gupta@gmail.com', 'garima@gmail.com,garima_123@outlook.com', '9874585869', 'Kanpur, India', 'Kanpur India', '16', '9', '', '', '', '', '', '', '', '', '2014-05-11 16:45:18', '2014-06-04 00:10:01', '0000-00-00 00:00:00', '', '1', '0000-00-00 00:00:00', '1'),
(6, 'Gungun Gupta', 'student_1006', '202cb962ac59075b964b07152d234b70', 'm92omj7', 'r5u6ph8.jpg', '15-06-1988', '03-05-2014', 'Female', 'B+', 'OBC', 'X', 'India', 'Uttar Pradesh', 'Bhopal', 'Mother', 'Gita Gupta', 'House Wife', '9958745869', 'gita_gupta@gmail.com', 'garima@yahoo.com', '9874585867', 'Kanpur, India', 'Kanpur India', '16', '3', '', '', '', '', '', '', '', '', '2014-05-11 16:45:18', '2014-06-04 00:10:54', '0000-00-00 00:00:00', '', '1', '0000-00-00 00:00:00', '1'),
(7, 'Somya Tripathi', 'student_1007', '202cb962ac59075b964b07152d234b70', 'mgylxl9', '7b6o7g1.jpg', '01-12-1994', '02-05-2014', 'Female', 'B+', 'General', 'XII', 'India', 'Uttar Pradesh', 'Lucknow', 'Father', 'Rohan Tripathi', 'Business', '9857484758', 'rohan_tri@yahoo.com', 'somyatripathi90@gmail.com', '8574847595', 'Lucknow', 'Lucknow', '14', '5', '', '', '', '', '', '', '', '', '2014-05-11 16:51:01', '2014-06-04 00:11:07', '0000-00-00 00:00:00', '', '1', '0000-00-00 00:00:00', '1'),
(8, 'Arjur Goel', 'student_1008', '202cb962ac59075b964b07152d234b70', 'o8fgam8', 'ioclw39.jpg', '15-11-1998', '08-05-2014', 'Male', 'B-', 'General', 'XII', 'India', 'Uttar Pradesh', 'Ghaziabad', 'Father', 'Pankaj Goel', 'Doctor', '8956874125', 'pankaj@gmail.com', 'arjun@gmail.com', '8741253697', 'Ghaziabad', 'Ghaziabad', '15', '4', '', '', '', '', '', '', '', '', '2014-05-11 17:13:41', '2014-06-04 00:11:27', '0000-00-00 00:00:00', '', '1', '0000-00-00 00:00:00', '1'),
(9, 'Karan Magan', 'student_1009', '202cb962ac59075b964b07152d234b70', '', 'default.png', '10-03-1990', '02-05-2014', 'Male', 'O+', 'General', 'VIII', 'India', 'Jammu and Kashmir', 'Jammu & Kashmir', 'Father', 'Prashant Magan', 'Doctor', '9854125874', 'prasant@gmail.com', 'karan@gmail.com', '9847458745', 'Jammu & Kashmir', 'Jammu & Kashmir', '18', '16', '', '', '', '', '', '', '', '', '2014-05-11 17:17:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '1', '0000-00-00 00:00:00', '1'),
(10, 'Mukesh Agrawal', 'student_1010', '202cb962ac59075b964b07152d234b70', '3lsfwy9', 'p2rsmj3.jpg', '19-05-1992', '07-02-2014', 'Male', 'A+', 'General', 'X', 'India', 'Delhi', 'New Delhi', 'Mother', 'Shilpi Agrawal', 'Doctor', '9847596841', 'shilpi@gmail.com', 'mukesh_agr@yahoo.com', '9874521547', 'New Delhi, India', 'New Delhi, India', '18', '16', '', '', '', '', '', '', '', '', '2014-05-11 17:28:51', '2014-06-04 00:11:50', '0000-00-00 00:00:00', '', '1', '0000-00-00 00:00:00', '1'),
(11, 'Rakesh Agrawal', 'student_1011', '202cb962ac59075b964b07152d234b70', 'udkgnn1', 'ry1j4w7.jpg', '14-02-1990', '07-02-2014', 'Male', 'A+', 'General', 'XII', 'India', 'Delhi', 'Delhi', 'Father', 'Bal Krishna', 'Business', '8574847595', 'balkrishna@gmail.com', 'rakeshagrawal735@gmail.com', '8475957484', 'New Delhi, India', 'New Delhi, India', '18', '16', '', '', '', '', '', '', '', '', '2014-05-11 17:30:43', '2014-06-04 00:12:23', '0000-00-00 00:00:00', '', '1', '0000-00-00 00:00:00', '1'),
(12, 'Harshika Tayal', 'student_1012', '202cb962ac59075b964b07152d234b70', '6cnklz7', '9q0evr2.jpg', '11-11-1989', '07-02-2014', 'Female', 'A+', 'General', 'XI', 'India', 'Delhi', 'New Delhi, India', 'Father', 'Pankaj Tayal', 'Business', '8855224478', 'pankajtayal@gmail.com', 'harshika@gmail.com', '8475957584', 'Delhi', 'Delhi', '21', '18', '', '', '', '', '', '', '', '', '2014-05-11 17:32:11', '2014-06-04 00:13:41', '0000-00-00 00:00:00', '', '1', '0000-00-00 00:00:00', '1'),
(13, 'Ankit Mishra', 'student_1013', '202cb962ac59075b964b07152d234b70', 'goe34d6', 'dx1l872.jpg', '14-08-1990', '03-05-2014', 'Male', 'B-', 'General', 'IX', 'India', 'Gujarat', 'Gujarat', 'Mother', 'Monika Mishra', 'House Wife', '8844775537', 'monika@gmail.com', 'ankit@gmail.com', '8010979978', 'Gujarat', 'Gujarat', '17', '2', '', '', '', '', '', '', '', '', '2014-05-11 17:33:53', '2014-06-04 00:13:58', '0000-00-00 00:00:00', '', '1', '0000-00-00 00:00:00', '1'),
(14, 'Ankita Tayal', 'student_1014', '202cb962ac59075b964b07152d234b70', 'erii4v9', 'omdtjg5.jpg', '10-03-1988', '05-05-2014', 'Female', 'O-', 'OBC', 'XII', 'India', 'Delhi', 'New Delhi', 'Mother', 'Puja Tayal', 'Doctor', '8844775588', 'puja@gmail.com', 'ankita_tayal@gmail.com', '8748475846', 'New Delhi', 'Delhi', '17', '2', '', '', '', '', '', '', '', '', '2014-05-11 17:35:57', '2014-06-04 00:14:09', '0000-00-00 00:00:00', '', '1', '0000-00-00 00:00:00', '1'),
(15, 'Mohit Magan', 'student_1015', '202cb962ac59075b964b07152d234b70', 'uv8l8b9', 'cubkh73.JPG', '15-06-1990', '07-02-2014', 'Male', 'B+', 'General', 'X', 'India', 'Delhi', 'Delhi', 'Mother', 'Priya Tayal', 'House Wife', '8475957485', 'priya@gmail.com', 'mohit@gmail.com', '9478584125', 'Delhi', 'Delhi', '17', '2', '', '', '', '', '', '', '', '', '2014-05-11 17:38:16', '2014-06-04 00:14:57', '0000-00-00 00:00:00', '', '1', '0000-00-00 00:00:00', '1'),
(16, 'Priya Bansal', 'student_1016', '202cb962ac59075b964b07152d234b70', '2h8sph6', 'ibouvt5.jpg', '11-05-2014', '07-02-2014', 'Female', 'O-', 'General', 'XII', 'India', 'Uttar Pradesh', 'Kanpur', 'Father', 'Rakesh Bansal', 'Business', '8475951524', 'rakesh@gmail.com', 'priya@gmail.com', '8475126974', 'Kanpur', 'Kanpur', '21', '18', '', '', '', '', '', '', '', '', '2014-05-11 17:40:22', '2014-06-04 00:15:31', '0000-00-00 00:00:00', '', '1', '0000-00-00 00:00:00', '1'),
(17, 'Atishay Goel', 'student_1017', '202cb962ac59075b964b07152d234b70', '3gnz8b1', 'qr72ux6.jpg', '11-05-1990', '07-02-2014', 'Male', 'AB+', 'General', 'VIII', 'India', 'Kerala', 'Kerala', 'Mother', 'Garima Goel', 'Doctor', '9847592587', 'garima@gmail.com', 'atishay@gmail.com', '8844775577', 'Kerala', 'Kerala', '18', '15', '', '', '', '', '', '', '', '', '2014-05-11 17:43:02', '2014-06-04 00:15:53', '0000-00-00 00:00:00', '', '1', '0000-00-00 00:00:00', '1'),
(18, 'Harsh Goel', 'student_1018', '202cb962ac59075b964b07152d234b70', 'xa42rj9', 'ybp47n5.jpg', '11-12-1990', '02-05-2014', 'Male', 'A+', 'General', 'X', 'India', 'Delhi', 'New Delhi', 'Guardian', 'Gungun Garg', 'Business', '8475957488', 'gungun_garg@outlook.com', 'harsh@gmail.com', '9474847531', 'New Delhi', 'New Delhi', '21', '17', '', '', '', '', '', '', '', '', '2014-05-11 17:51:29', '2014-06-04 00:16:04', '0000-00-00 00:00:00', '', '1', '0000-00-00 00:00:00', '1'),
(19, 'Ankur Mishra', 'student_1019', '202cb962ac59075b964b07152d234b70', 'dhggx44', '0rcqij8.jpg', '10-03-1990', '03-05-2014', 'Male', 'O-', 'General', 'XII', 'India', 'Delhi', 'New Delhi', 'Father', 'Rohan Mishra', 'Business', '8475951578', 'rohan_mishra@gmail.com', 'ankur@gmail.com', '8475958474', 'New Delhi', 'New Delhi', '21', '17', '', '', '', '', '', '', '', '', '2014-05-11 17:54:22', '2014-06-04 00:16:19', '0000-00-00 00:00:00', '', '1', '0000-00-00 00:00:00', '1'),
(20, 'Kriti Sharma', 'student_1020', '202cb962ac59075b964b07152d234b70', '91p4xx7', 'gxitst3.jpg', '14-07-1989', '02-05-2014', 'Female', 'B-', 'General', 'XI', 'India', 'Uttar Pradesh', 'Lucknow', 'Father', 'Rahul Sharma', 'Business', '8844775578', 'rahul@gmail.com', 'kriti@gmail.com', '9748451269', 'Lucknow', 'Lucknow', '18', '15', '', '', '', '', '', '', '', '', '2014-05-11 17:56:42', '2014-06-04 00:16:33', '0000-00-00 00:00:00', '', '1', '0000-00-00 00:00:00', '1'),
(21, 'Pragati Sharma', 'student_1021', '202cb962ac59075b964b07152d234b70', '2x299q8', '5g5e668.jpg', '11-12-1990', '05-05-2014', 'Female', 'A-', 'General', 'XII', 'India', 'Uttar Pradesh', 'Lucknow', 'Father', 'Pawan Sharma', 'Business', '9784574152', 'pawan@gmail.com', 'pragati@gmail.com', '9748475142', 'Lucknow', 'Lucknow', '16', '3', '', '', '', '', '', '', '', '', '2014-05-11 17:58:35', '2014-06-04 00:16:44', '0000-00-00 00:00:00', '', '1', '0000-00-00 00:00:00', '1'),
(22, 'Rahul Gupta', 'student_1022', '202cb962ac59075b964b07152d234b70', 'zytx8x0', '5fl4ra2.jpg', '04-08-1990', '03-05-2014', 'Male', 'B-', 'OBC', 'X', 'India', 'Jharkhand', 'Jalandhar', 'Father', 'Rakesh Sharma', 'Business', '8844775533', 'Rakesh_sharma@gmai.com', 'rahul@gmail.com,rahul@yahoo.com', '9874123654, 9847500000', 'Unknown Address', 'Unknown Address', '18', '15', '', '', '', '', '', '', '', '', '2014-05-11 18:03:46', '2014-06-04 00:16:54', '0000-00-00 00:00:00', '', '1', '0000-00-00 00:00:00', '1'),
(23, 'Garima Goyal', 'student_1023', '202cb962ac59075b964b07152d234b70', 'ceqlc91', 'default.png', '26-06-1990', '19-02-2013', 'Female', 'A+', 'General', 'X', 'India', 'Uttarpradesh', 'Lucknow', 'Father', 'Ronak Goyal', 'Business', '9857485968', 'ronak@gmail.com', 'garima_1122@gmail.com', '9857485825', 'Lucknow, India', 'Luknow, India', '18', '19', '49500.00', '', '', '', '', '', '', '', '2014-06-05 14:58:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '1', '0000-00-00 00:00:00', '1'),
(24, 'Ronak Sharma', 'student_1024', '202cb962ac59075b964b07152d234b70', 'oe0axq5', 'default.png', '25-01-1991', '19-04-2014', 'Male', 'B-', 'OBC', 'XII', 'India', 'New Delhi', 'Delhi', 'Mother', 'Shilpa Sharma', 'Doctor', '7845857412', 'shilpa@gmail.com', 'ronak_11@gmail.com', '9857458698', 'New Delhi, India', 'Malviya Nagar, New Delhi', '18', '19', '49500.00', '', '', '', '', '', '', '', '2014-06-05 14:58:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '1', '0000-00-00 00:00:00', '1');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `topic` text NOT NULL,
  `status` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `name`, `topic`, `status`) VALUES
(1, 'Algebra', ' Algebraic Expressions,Ratio and Proportion,testing,Matrix theory,Matrix multiplication,Matrix addition,Basis transformation matrix,Trace,Characteristic polynomial,Rank,Matrix inversion, invertible matrix,Adjugate,Transpose,Dot product', '1'),
(2, 'Physics 2', 'Plane mirror,Rarefaction,Signal generator,Tension,Young''s double-slit experiment,Vibration,Velocity', '1'),
(3, 'Physics', 'Air resistance,Diffraction,Electromagnetic spectrum,Gamma ray -- Gravity,Inertia -- Interference,Kinetic energy,Oscilloscope', '1'),
(4, 'Chemistry', 'Periodic Table,Chemical and Physical Changes,Printable Periodic Tables', '1'),
(5, 'Geometry', 'Alice Meets the 4th Dimension,AskERIC Lesson Plans - Geometry,Border Pattern Gallery,Cabri Java Project,Cercle d''Euler,Combinatorial Tiling Theory: Theorems - Algorithms - Visualization', '1'),
(6, 'Calculus', 'Basic EXCEL-skills for calculus and differential equations,Better File Cabinet,Area of a Circle,AP Calculus on the Web,Aid for Calculus,Calculus Resources On-Line,Bisection Method Tutorial,Cal Poly Linked Curriculum Program Interdisciplinary Projects,Calculus', '1'),
(7, 'Calculus 2', 'Area of a Circle,AP Calculus on the Web,Aid for Calculus,Calculus Resources On-Line,Bisection Method Tutorial,Calculus', '1'),
(8, 'Number System', 'Rational Numbers, Powers,Squares, Square roots, Cubes, Cube roots,Playing with numbers', '1'),
(9, 'Calculus 1', 'Basic EXCEL-skills for calculus and differential equations,Better File Cabinet,Area of a Circle,AP Calculus on the Web,Aid for Calculus,Calculus Resources On-Line,Bisection Method Tutorial,Cal Poly Linked Curriculum Program Interdisciplinary Projects,Calculus', '1'),
(10, 'History', 'Egyptian Art in the Age of the Pyramids,The New Greek Galleries,Oriental Institute Virtual Museum', '1'),
(11, 'Trigonometry Maths', 'Angular distance,Angle,Law of sines,Law of cosines,Law of tangents,Law of cotangents,Mollweide''s formula,hello122', '1'),
(12, 'Trignometry', 'hello1,hello 2', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE IF NOT EXISTS `tax` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_name` varchar(255) NOT NULL,
  `tax_value` varchar(10) NOT NULL,
  `applicable` char(1) NOT NULL,
  `created_time` datetime NOT NULL,
  `modify_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tax`
--

INSERT INTO `tax` (`id`, `tax_name`, `tax_value`, `applicable`, `created_time`, `modify_time`) VALUES
(16, 'Service Tax', '85.8', '1', '2014-04-04 22:56:15', '2014-05-21 14:24:52');

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE IF NOT EXISTS `timetable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `batch` int(11) NOT NULL,
  `day` varchar(20) NOT NULL,
  `start_time` varchar(20) NOT NULL,
  `end_time` varchar(20) NOT NULL,
  `teacher` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `status` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=673 ;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`id`, `code`, `batch`, `day`, `start_time`, `end_time`, `teacher`, `subject`, `status`) VALUES
(31, '983a51', 2, 'Monday', '7.00 AM', '8.00 AM', '1', '4', '1'),
(32, 'nphfr3', 2, 'Monday', '8.00 AM', '9.00 AM', '6', '3', '1'),
(33, 'tqrrb3', 2, 'Tuesday', '7.00 AM', '8.00 AM', '17', '7', '1'),
(34, 'itjvc0', 2, 'Tuesday', '8.00 AM', '9.00 AM', '18', '7', '1'),
(35, 'km3e03', 2, 'Wednesday', '7.00 AM', '8.00 AM', '', '', '1'),
(36, '4cy4a8', 2, 'Wednesday', '8.00 AM', '9.00 AM', '', '', '1'),
(37, '0tvd95', 2, 'Thursday', '7.00 AM', '8.00 AM', '', '', '1'),
(38, 'swa3c8', 2, 'Thursday', '8.00 AM', '9.00 AM', '', '', '1'),
(39, '6ndbk9', 2, 'Friday', '7.00 AM', '8.00 AM', '7', '1', '1'),
(40, '9nj7t8', 2, 'Friday', '8.00 AM', '9.00 AM', '1', '1', '1'),
(41, 'n3ee09', 2, 'Saturday', '7.00 AM', '8.00 AM', '17', '7', '1'),
(42, 't98bh9', 2, 'Saturday', '8.00 AM', '9.00 AM', '18', '4', '1'),
(91, 'nxl8d8', 3, 'Monday', '6.15 AM', '7.15 AM', '4', '4', '1'),
(92, 'mbi7m3', 3, 'Monday', '7.30 AM', '8.45 AM', '', '', '1'),
(93, 'muzss9', 3, 'Tuesday', '6.15 AM', '7.15 AM', '6', '5', '1'),
(94, 'ikm6j2', 3, 'Tuesday', '7.30 AM', '8.45 AM', '', '', '1'),
(95, '7uyo55', 3, 'Wednesday', '6.15 AM', '7.15 AM', '', '', '1'),
(96, '2ejoq3', 3, 'Wednesday', '7.30 AM', '8.45 AM', '14', '4', '1'),
(97, 'ysb3i1', 3, 'Thursday', '6.15 AM', '7.15 AM', '', '', '1'),
(98, 'mgsj00', 3, 'Thursday', '7.30 AM', '8.45 AM', '4', '8', '1'),
(99, 'v4bnd6', 3, 'Friday', '6.15 AM', '7.15 AM', '', '', '1'),
(100, 'xxe8m7', 3, 'Friday', '7.30 AM', '8.45 AM', '', '', '1'),
(101, 'iqskt2', 3, 'Saturday', '6.15 AM', '7.15 AM', '', '', '1'),
(102, '9ewnd7', 3, 'Saturday', '7.30 AM', '8.45 AM', '', '', '1'),
(109, '8k7261', 19, 'Monday', '6.30 AM', '7.00 AM', '1', '1', '1'),
(110, '4g12s9', 19, 'Tuesday', '6.30 AM', '7.00 AM', '1', '1', '1'),
(111, 'wo3gc6', 19, 'Wednesday', '6.30 AM', '7.00 AM', '13', '1', '1'),
(112, 'dih6f0', 19, 'Thursday', '6.30 AM', '7.00 AM', '1', '6', '1'),
(113, 'xzmlq3', 19, 'Friday', '6.30 AM', '7.00 AM', '8', '6', '1'),
(114, 't2jwd9', 19, 'Saturday', '6.30 AM', '7.00 AM', '1', '9', '1'),
(325, '0pqj16', 15, 'Monday', '6.00 AM', '6.15 AM', '12', '9', '1'),
(326, 'ohctr3', 15, 'Monday', '6.15 AM', '8.15 AM', '8', '5', '1'),
(327, '1jt7p4', 15, 'Monday', '9.00 AM', '10.45 AM', '4', '1', '1'),
(328, '8ggwt0', 15, 'Tuesday', '6.00 AM', '6.15 AM', '', '', '1'),
(329, 'ugxi04', 15, 'Tuesday', '6.15 AM', '8.15 AM', '', '', '1'),
(330, 'esihk3', 15, 'Tuesday', '9.00 AM', '10.45 AM', '', '', '1'),
(331, 'gvb4f3', 15, 'Wednesday', '6.00 AM', '6.15 AM', '', '', '1'),
(332, 'xmj0b8', 15, 'Wednesday', '6.15 AM', '8.15 AM', '', '', '1'),
(333, 'dpr615', 15, 'Wednesday', '9.00 AM', '10.45 AM', '', '', '1'),
(334, '5n3ds7', 15, 'Thursday', '6.00 AM', '6.15 AM', '', '', '1'),
(335, 'obkcc1', 15, 'Thursday', '6.15 AM', '8.15 AM', '', '', '1'),
(336, 'sz80b6', 15, 'Thursday', '9.00 AM', '10.45 AM', '', '', '1'),
(337, 'voirf3', 15, 'Friday', '6.00 AM', '6.15 AM', '', '', '1'),
(338, '6bfro7', 15, 'Friday', '6.15 AM', '8.15 AM', '', '', '1'),
(339, '05u4q1', 15, 'Friday', '9.00 AM', '10.45 AM', '', '', '1'),
(340, '1sq347', 15, 'Saturday', '6.00 AM', '6.15 AM', '', '', '1'),
(341, 'lnejd0', 15, 'Saturday', '6.15 AM', '8.15 AM', '', '', '1'),
(342, 'q1pwg7', 15, 'Saturday', '9.00 AM', '10.45 AM', '', '', '1'),
(343, 'nkeou7', 11, 'Monday', '7.00 AM', '7.45 AM', '11', '1', '1'),
(344, 'y9ckx4', 11, 'Monday', '7.45 AM', '8.45 AM', '14', '9', '1'),
(345, 'ruoq67', 11, 'Tuesday', '7.00 AM', '7.45 AM', '18', '6', '1'),
(346, '1261d9', 11, 'Tuesday', '7.45 AM', '8.45 AM', '', '', '1'),
(347, 'wvhbw0', 11, 'Wednesday', '7.00 AM', '7.45 AM', '', '', '1'),
(348, 'rnao09', 11, 'Wednesday', '7.45 AM', '8.45 AM', '', '', '1'),
(349, 'mjml28', 11, 'Thursday', '7.00 AM', '7.45 AM', '', '', '1'),
(350, 'en5eo5', 11, 'Thursday', '7.45 AM', '8.45 AM', '', '', '1'),
(351, 'zac962', 11, 'Friday', '7.00 AM', '7.45 AM', '', '', '1'),
(352, 'p8tmm4', 11, 'Friday', '7.45 AM', '8.45 AM', '', '', '1'),
(353, 'hzgea6', 11, 'Saturday', '7.00 AM', '7.45 AM', '', '', '1'),
(354, '01s9n8', 11, 'Saturday', '7.45 AM', '8.45 AM', '', '', '1'),
(373, 'u3u553', 18, 'Monday', '6.00 AM', '7.00 AM', '6', '1', '1'),
(374, 'ytioy1', 18, 'Monday', '7.00 AM', '8.00 AM', '', '', '1'),
(375, '09p978', 18, 'Monday', '8.30 AM', '9.00 AM', '1', '9', '1'),
(376, 'jh9ka8', 18, 'Tuesday', '6.00 AM', '7.00 AM', '', '', '1'),
(377, 'p9brn0', 18, 'Tuesday', '7.00 AM', '8.00 AM', '13', '6', '1'),
(378, 'g9pq28', 18, 'Tuesday', '8.30 AM', '9.00 AM', '7', '9', '1'),
(379, 'xhzby0', 18, 'Wednesday', '6.00 AM', '7.00 AM', '17', '6', '1'),
(380, 'jbvlk7', 18, 'Wednesday', '7.00 AM', '8.00 AM', '', '', '1'),
(381, '9wg371', 18, 'Wednesday', '8.30 AM', '9.00 AM', '18', '6', '1'),
(382, '0ab1k8', 18, 'Thursday', '6.00 AM', '7.00 AM', '', '', '1'),
(383, 'pu0px2', 18, 'Thursday', '7.00 AM', '8.00 AM', '', '', '1'),
(384, 'oc3hd7', 18, 'Thursday', '8.30 AM', '9.00 AM', '', '', '1'),
(385, 's9gb48', 18, 'Friday', '6.00 AM', '7.00 AM', '', '', '1'),
(386, 't4ouq5', 18, 'Friday', '7.00 AM', '8.00 AM', '', '', '1'),
(387, 'kk3mc7', 18, 'Friday', '8.30 AM', '9.00 AM', '', '', '1'),
(388, '7s4ix0', 18, 'Saturday', '6.00 AM', '7.00 AM', '8', '1', '1'),
(389, 'jnnrm3', 18, 'Saturday', '7.00 AM', '8.00 AM', '', '', '1'),
(390, '50zds2', 18, 'Saturday', '8.30 AM', '9.00 AM', '', '', '1'),
(391, 'qwfdh6', 16, 'Monday', '6.45 AM', '8.00 AM', '9', '6', '1'),
(392, 'ew9vj8', 16, 'Monday', '8.00 AM', '9.00 AM', '', '', '1'),
(393, 'q97lx0', 16, 'Monday', '9.30 AM', '10.30 AM', '', '', '1'),
(394, '86iwz0', 16, 'Tuesday', '6.45 AM', '8.00 AM', '', '', '1'),
(395, 'i4a5k3', 16, 'Tuesday', '8.00 AM', '9.00 AM', '', '', '1'),
(396, 'hyqve4', 16, 'Tuesday', '9.30 AM', '10.30 AM', '', '', '1'),
(397, 'ndf5c0', 16, 'Wednesday', '6.45 AM', '8.00 AM', '', '', '1'),
(398, 'dxhol3', 16, 'Wednesday', '8.00 AM', '9.00 AM', '', '', '1'),
(399, '4fx8v0', 16, 'Wednesday', '9.30 AM', '10.30 AM', '', '', '1'),
(400, 'p7sqs1', 16, 'Thursday', '6.45 AM', '8.00 AM', '', '', '1'),
(401, 'i8jl37', 16, 'Thursday', '8.00 AM', '9.00 AM', '12', '1', '1'),
(402, 'rg6yu2', 16, 'Thursday', '9.30 AM', '10.30 AM', '', '', '1'),
(403, 't4kvm9', 16, 'Friday', '6.45 AM', '8.00 AM', '', '', '1'),
(404, 'cvopy1', 16, 'Friday', '8.00 AM', '9.00 AM', '', '', '1'),
(405, 'l2s8g2', 16, 'Friday', '9.30 AM', '10.30 AM', '', '', '1'),
(406, 'p2uyz1', 16, 'Saturday', '6.45 AM', '8.00 AM', '', '', '1'),
(407, 'ufic34', 16, 'Saturday', '8.00 AM', '9.00 AM', '', '', '1'),
(408, 'm7n257', 16, 'Saturday', '9.30 AM', '10.30 AM', '', '', '1'),
(469, 'lh7yi4', 17, 'Monday', '6.00 AM', '7.00 AM', '', '', '0'),
(470, 'o3y0i4', 17, 'Monday', '7.00 AM', '8.00 AM', '12', '9', '0'),
(471, '1alzc0', 17, 'Monday', '8.15 AM', '9.30 AM', '', '', '0'),
(472, 'a6zjd9', 17, 'Monday', 'Break', 'Break', 'Break', 'Break', '0'),
(473, 'ig9w29', 17, 'Monday', '10.00 AM', '10.30 AM', '6', '6', '0'),
(474, 'qv7v63', 17, 'Tuesday', '6.00 AM', '7.00 AM', '13', '5', '0'),
(475, '1cfc51', 17, 'Tuesday', '7.00 AM', '8.00 AM', '', '', '0'),
(476, 'tbne72', 17, 'Tuesday', '8.15 AM', '9.30 AM', '17', '4', '0'),
(477, '5wxio8', 17, 'Tuesday', 'Break', 'Break', 'Break', 'Break', '0'),
(478, 'u7wz97', 17, 'Tuesday', '10.00 AM', '10.30 AM', '14', '9', '0'),
(479, 'vi1161', 17, 'Wednesday', '6.00 AM', '7.00 AM', '', '', '0'),
(480, 'jnx3k5', 17, 'Wednesday', '7.00 AM', '8.00 AM', '', '', '0'),
(481, 'q3i2n3', 17, 'Wednesday', '8.15 AM', '9.30 AM', '', '', '0'),
(482, '7cblz7', 17, 'Wednesday', 'Break', 'Break', 'Break', 'Break', '0'),
(483, 's1oan4', 17, 'Wednesday', '10.00 AM', '10.30 AM', '', '', '0'),
(484, 'me1xp0', 17, 'Thursday', '6.00 AM', '7.00 AM', '', '', '0'),
(485, 'ja9t77', 17, 'Thursday', '7.00 AM', '8.00 AM', '6', '9', '0'),
(486, '3joyl7', 17, 'Thursday', '8.15 AM', '9.30 AM', '', '', '0'),
(487, '17kbu1', 17, 'Thursday', 'Break', 'Break', 'Break', 'Break', '0'),
(488, 'du84v2', 17, 'Thursday', '10.00 AM', '10.30 AM', '4', '4', '0'),
(489, 'spdzl2', 17, 'Friday', '6.00 AM', '7.00 AM', '1', '9', '0'),
(490, 'r09ac8', 17, 'Friday', '7.00 AM', '8.00 AM', '', '', '0'),
(491, 'v8zf06', 17, 'Friday', '8.15 AM', '9.30 AM', '6', '9', '0'),
(492, '17rxb1', 17, 'Friday', 'Break', 'Break', 'Break', 'Break', '0'),
(493, 'rm5t20', 17, 'Friday', '10.00 AM', '10.30 AM', '', '', '0'),
(494, 'g2bvi4', 17, 'Saturday', '6.00 AM', '7.00 AM', '', '', '0'),
(495, 'jc6td1', 17, 'Saturday', '7.00 AM', '8.00 AM', '', '', '0'),
(496, 'trwl91', 17, 'Saturday', '8.15 AM', '9.30 AM', '9', '6', '0'),
(497, 'paulw5', 17, 'Saturday', 'Break', 'Break', 'Break', 'Break', '0'),
(498, 'fx2yb6', 17, 'Saturday', '10.00 AM', '10.30 AM', '', '', '0'),
(499, 'aves69', 20, 'Monday', '6.00 AM', '6.45 AM', '7', '6', '1'),
(500, 'uyoja8', 20, 'Monday', 'Break', 'Break', 'Break', 'Break', '1'),
(501, 'wurs18', 20, 'Monday', '10.30 AM', '11.15 AM', '', '', '1'),
(502, 'ezwjq1', 20, 'Tuesday', '6.00 AM', '6.45 AM', '', '', '1'),
(503, 'uevjq3', 20, 'Tuesday', 'Break', 'Break', 'Break', 'Break', '1'),
(504, 'guwxj2', 20, 'Tuesday', '10.30 AM', '11.15 AM', '', '', '1'),
(505, '52plw2', 20, 'Wednesday', '6.00 AM', '6.45 AM', '', '', '1'),
(506, '2yxd81', 20, 'Wednesday', 'Break', 'Break', 'Break', 'Break', '1'),
(507, 'lz9br0', 20, 'Wednesday', '10.30 AM', '11.15 AM', '', '', '1'),
(508, 'r8r0u1', 20, 'Thursday', '6.00 AM', '6.45 AM', '', '', '1'),
(509, 'gu3n50', 20, 'Thursday', 'Break', 'Break', 'Break', 'Break', '1'),
(510, 'l2phx1', 20, 'Thursday', '10.30 AM', '11.15 AM', '', '', '1'),
(511, 'hr8yb7', 20, 'Friday', '6.00 AM', '6.45 AM', '', '', '1'),
(512, '1djzi5', 20, 'Friday', 'Break', 'Break', 'Break', 'Break', '1'),
(513, '0e6714', 20, 'Friday', '10.30 AM', '11.15 AM', '', '', '1'),
(514, 'r61k53', 20, 'Saturday', '6.00 AM', '6.45 AM', '', '', '1'),
(515, 'r61k5w', 20, 'Saturday', 'Break', 'Break', 'Break', 'Break', '1'),
(516, 'r61k5s', 20, 'Saturday', '10.30 AM', '11.15 AM', '', '', '1'),
(517, 'j0btd6', 17, 'Monday', '6.00 AM', '7.00 AM', '', '', '0'),
(518, 'r61k56', 17, 'Monday', '7.00 AM', '8.00 AM', '12', '9', '0'),
(519, '3dspo3', 17, 'Monday', '8.15 AM', '9.30 AM', '', '', '0'),
(520, '3dspo3', 17, 'Monday', 'Break', 'Break', 'Break', 'Break', '0'),
(521, 'kcc4s9', 17, 'Monday', '10.15 AM', '11.00 AM', '6', '6', '0'),
(522, '80bnv6', 17, 'Tuesday', '6.00 AM', '7.00 AM', '13', '5', '0'),
(523, 'irfc63', 17, 'Tuesday', '7.00 AM', '8.00 AM', '', '', '0'),
(524, 'fros01', 17, 'Tuesday', '8.15 AM', '9.30 AM', '17', '4', '0'),
(525, 'fros01', 17, 'Tuesday', 'Break', 'Break', 'Break', 'Break', '0'),
(526, 'u4q617', 17, 'Tuesday', '10.15 AM', '11.00 AM', '14', '9', '0'),
(527, 'q34rl6', 17, 'Wednesday', '6.00 AM', '7.00 AM', '', '', '0'),
(528, 'ejd0q0', 17, 'Wednesday', '7.00 AM', '8.00 AM', '', '', '0'),
(529, 'pwgrn5', 17, 'Wednesday', '8.15 AM', '9.30 AM', '', '', '0'),
(530, 'pwgrn5', 17, 'Wednesday', 'Break', 'Break', 'Break', 'Break', '0'),
(531, 'eouqy2', 17, 'Wednesday', '10.15 AM', '11.00 AM', '', '', '0'),
(532, 'ckxgr8', 17, 'Thursday', '6.00 AM', '7.00 AM', '', '', '0'),
(533, 'oq6r10', 17, 'Thursday', '7.00 AM', '8.00 AM', '6', '9', '0'),
(534, '61dyw8', 17, 'Thursday', '8.15 AM', '9.30 AM', '', '', '0'),
(535, '61dyw8', 17, 'Thursday', 'Break', 'Break', 'Break', 'Break', '0'),
(536, 'hbw0r6', 17, 'Thursday', '10.15 AM', '11.00 AM', '4', '4', '0'),
(537, 'ao0xm5', 17, 'Friday', '6.00 AM', '7.00 AM', '1', '9', '0'),
(538, 'ml2we6', 17, 'Friday', '7.00 AM', '8.00 AM', '', '', '0'),
(539, '5eojz2', 17, 'Friday', '8.15 AM', '9.30 AM', '6', '9', '0'),
(540, '5eojz2', 17, 'Friday', 'Break', 'Break', 'Break', 'Break', '0'),
(541, 'c96ap2', 17, 'Friday', '10.15 AM', '11.00 AM', '', '', '0'),
(542, 'tmmgh9', 17, 'Saturday', '6.00 AM', '7.00 AM', '', '', '0'),
(543, 'geam00', 17, 'Saturday', '7.00 AM', '8.00 AM', '', '', '0'),
(544, 's9nu50', 17, 'Saturday', '8.15 AM', '9.30 AM', '9', '6', '0'),
(545, 's9nu50', 17, 'Saturday', 'Break', 'Break', 'Break', 'Break', '0'),
(546, '8qwt22', 17, 'Saturday', '10.15 AM', '11.00 AM', '', '', '0'),
(547, 'ws8r69', 5, 'Monday', '6.00 AM', '7.00 AM', '7', '1', '0'),
(548, 'fxrer0', 5, 'Monday', '7.00 AM', '8.00 AM', '6', '9', '0'),
(549, 'fxrer0', 5, 'Monday', 'Break', 'Break', 'Break', 'Break', '0'),
(550, 'od36l5', 5, 'Monday', '8.30 AM', '9.30 AM', '12', '1', '0'),
(551, 'qnl8k5', 5, 'Tuesday', '6.00 AM', '7.00 AM', '17', '9', '0'),
(552, '81x8n2', 5, 'Tuesday', '7.00 AM', '8.00 AM', '', '', '0'),
(553, '81x8n2', 5, 'Tuesday', 'Break', 'Break', 'Break', 'Break', '0'),
(554, 'nqek35', 5, 'Tuesday', '8.30 AM', '9.30 AM', '', '', '0'),
(555, 'l72kt8', 5, 'Wednesday', '6.00 AM', '7.00 AM', '8', '9', '0'),
(556, 'yc6uk7', 5, 'Wednesday', '7.00 AM', '8.00 AM', '6', '4', '0'),
(557, 'yc6uk7', 5, 'Wednesday', 'Break', 'Break', 'Break', 'Break', '0'),
(558, '9rad69', 5, 'Wednesday', '8.30 AM', '9.30 AM', '', '', '0'),
(559, 'w3iyt4', 5, 'Thursday', '6.00 AM', '7.00 AM', '18', '9', '0'),
(560, 'b5ua92', 5, 'Thursday', '7.00 AM', '8.00 AM', '18', '7', '0'),
(561, 'b5ua92', 5, 'Thursday', 'Break', 'Break', 'Break', 'Break', '0'),
(562, 'b7db31', 5, 'Thursday', '8.30 AM', '9.30 AM', '18', '3', '0'),
(563, '99ih21', 5, 'Friday', '6.00 AM', '7.00 AM', '14', '3', '0'),
(564, 'f9bu69', 5, 'Friday', '7.00 AM', '8.00 AM', '', '', '0'),
(565, 'f9bu69', 5, 'Friday', 'Break', 'Break', 'Break', 'Break', '0'),
(566, '5gmk47', 5, 'Friday', '8.30 AM', '9.30 AM', '', '', '0'),
(567, '2hdxd7', 5, 'Saturday', '6.00 AM', '7.00 AM', '', '', '0'),
(568, 'hpwqi3', 5, 'Saturday', '7.00 AM', '8.00 AM', '', '', '0'),
(569, 'hpwqi3', 5, 'Saturday', 'Break', 'Break', 'Break', 'Break', '0'),
(570, 'hi3hg4', 5, 'Saturday', '8.30 AM', '9.30 AM', '', '', '0'),
(571, 'jj63b7', 5, 'Monday', '6.00 AM', '7.00 AM', '11', '1', '1'),
(572, 'y0qns5', 5, 'Monday', '7.00 AM', '8.00 AM', '6', '9', '1'),
(573, 'y0qns5', 5, 'Monday', 'Break', 'Break', 'Break', 'Break', '1'),
(574, 'hg6qu0', 5, 'Monday', '8.30 AM', '9.30 AM', '12', '1', '1'),
(575, '18huv1', 5, 'Tuesday', '6.00 AM', '7.00 AM', '17', '9', '1'),
(576, 'mmnz07', 5, 'Tuesday', '7.00 AM', '8.00 AM', '', '', '1'),
(577, 'mmnz07', 5, 'Tuesday', 'Break', 'Break', 'Break', 'Break', '1'),
(578, 'twuzd4', 5, 'Tuesday', '8.30 AM', '9.30 AM', '', '', '1'),
(579, 'vsrt99', 5, 'Wednesday', '6.00 AM', '7.00 AM', '8', '9', '1'),
(580, 'zirtg6', 5, 'Wednesday', '7.00 AM', '8.00 AM', '6', '4', '1'),
(581, 'zirtg6', 5, 'Wednesday', 'Break', 'Break', 'Break', 'Break', '1'),
(582, 'l86tg5', 5, 'Wednesday', '8.30 AM', '9.30 AM', '', '', '1'),
(583, 'm4llr1', 5, 'Thursday', '6.00 AM', '7.00 AM', '18', '9', '1'),
(584, 'qq1z18', 5, 'Thursday', '7.00 AM', '8.00 AM', '18', '7', '1'),
(585, 'qq1z18', 5, 'Thursday', 'Break', 'Break', 'Break', 'Break', '1'),
(586, 'g8a5g0', 5, 'Thursday', '8.30 AM', '9.30 AM', '18', '3', '1'),
(587, 'nm0vw5', 5, 'Friday', '6.00 AM', '7.00 AM', '14', '3', '1'),
(588, 'mx7q77', 5, 'Friday', '7.00 AM', '8.00 AM', '', '', '1'),
(589, 'mx7q77', 5, 'Friday', 'Break', 'Break', 'Break', 'Break', '1'),
(590, 'bm9hg9', 5, 'Friday', '8.30 AM', '9.30 AM', '', '', '1'),
(591, 'roa554', 5, 'Saturday', '6.00 AM', '7.00 AM', '', '', '1'),
(592, '30fdk9', 5, 'Saturday', '7.00 AM', '8.00 AM', '', '', '1'),
(593, '30fdk9', 5, 'Saturday', 'Break', 'Break', 'Break', 'Break', '1'),
(594, '1kyny6', 5, 'Saturday', '8.30 AM', '9.30 AM', '', '', '1'),
(595, 'jpy9y8', 17, 'Monday', '6.00 AM', '7.00 AM', '', '', '1'),
(596, '5ygqn0', 17, 'Monday', '7.00 AM', '8.00 AM', '12', '9', '1'),
(597, 'a5d954', 17, 'Monday', '8.15 AM', '9.30 AM', '', '', '1'),
(598, 'a5d954', 17, 'Monday', 'Break', 'Break', 'Break', 'Break', '1'),
(599, 'tkajy5', 17, 'Monday', '10.15 AM', '11.00 AM', '6', '6', '1'),
(600, 'eo8fq7', 17, 'Tuesday', '6.00 AM', '7.00 AM', '13', '5', '1'),
(601, 'noz3n4', 17, 'Tuesday', '7.00 AM', '8.00 AM', '', '', '1'),
(602, 'cj7bl4', 17, 'Tuesday', '8.15 AM', '9.30 AM', '17', '4', '1'),
(603, 'cj7bl4', 17, 'Tuesday', 'Break', 'Break', 'Break', 'Break', '1'),
(604, 'tdwoe2', 17, 'Tuesday', '10.15 AM', '11.00 AM', '14', '9', '1'),
(605, '0jgx49', 17, 'Wednesday', '6.00 AM', '7.00 AM', '', '', '1'),
(606, 'y4z3c8', 17, 'Wednesday', '7.00 AM', '8.00 AM', '', '', '1'),
(607, 'sylt98', 17, 'Wednesday', '8.15 AM', '9.30 AM', '', '', '1'),
(608, 'sylt98', 17, 'Wednesday', 'Break', 'Break', 'Break', 'Break', '1'),
(609, '70ml50', 17, 'Wednesday', '10.15 AM', '11.00 AM', '', '', '1'),
(610, 'lku0e5', 17, 'Thursday', '6.00 AM', '7.00 AM', '', '', '1'),
(611, 'ajqzy6', 17, 'Thursday', '7.00 AM', '8.00 AM', '6', '9', '1'),
(612, 'unt1f8', 17, 'Thursday', '8.15 AM', '9.30 AM', '', '', '1'),
(613, 'unt1f8', 17, 'Thursday', 'Break', 'Break', 'Break', 'Break', '1'),
(614, 'bqqjg3', 17, 'Thursday', '10.15 AM', '11.00 AM', '4', '4', '1'),
(615, 'fznxs0', 17, 'Friday', '6.00 AM', '7.00 AM', '1', '9', '1'),
(616, 'y5h1r0', 17, 'Friday', '7.00 AM', '8.00 AM', '', '', '1'),
(617, 'ru28c8', 17, 'Friday', '8.15 AM', '9.30 AM', '6', '9', '1'),
(618, 'ru28c8', 17, 'Friday', 'Break', 'Break', 'Break', 'Break', '1'),
(619, 'csgrj3', 17, 'Friday', '10.15 AM', '11.00 AM', '', '', '1'),
(620, 'r16yj4', 17, 'Saturday', '6.00 AM', '7.00 AM', '', '', '1'),
(621, '57hhz2', 17, 'Saturday', '7.00 AM', '8.00 AM', '', '', '1'),
(622, 'ttmm98', 17, 'Saturday', '8.15 AM', '9.30 AM', '9', '6', '1'),
(623, 'ttmm98', 17, 'Saturday', 'Break', 'Break', 'Break', 'Break', '1'),
(624, 'jf0hp3', 17, 'Saturday', '10.15 AM', '11.00 AM', '', '', '1'),
(625, 'gv0669', 21, 'Monday', '6.00 AM', '7.00 AM', '6', '9', '0'),
(626, 'uu4c25', 21, 'Monday', '7.00 AM', '8.00 AM', '1', '7', '0'),
(627, 'uu4c25', 21, 'Monday', 'Break', 'Break', 'Break', 'Break', '0'),
(628, 'ixpz30', 21, 'Monday', '8.30 AM', '9.30 AM', '', '', '0'),
(629, '541ie6', 21, 'Tuesday', '6.00 AM', '7.00 AM', '', '', '0'),
(630, '4pyki4', 21, 'Tuesday', '7.00 AM', '8.00 AM', '', '', '0'),
(631, '4pyki4', 21, 'Tuesday', 'Break', 'Break', 'Break', 'Break', '0'),
(632, 'rkx296', 21, 'Tuesday', '8.30 AM', '9.30 AM', '', '', '0'),
(633, 'nfgib8', 21, 'Wednesday', '6.00 AM', '7.00 AM', '', '', '0'),
(634, 't679a2', 21, 'Wednesday', '7.00 AM', '8.00 AM', '', '', '0'),
(635, 't679a2', 21, 'Wednesday', 'Break', 'Break', 'Break', 'Break', '0'),
(636, '0xcty6', 21, 'Wednesday', '8.30 AM', '9.30 AM', '', '', '0'),
(637, 'yhrxm3', 21, 'Thursday', '6.00 AM', '7.00 AM', '', '', '0'),
(638, 'mg90a6', 21, 'Thursday', '7.00 AM', '8.00 AM', '', '', '0'),
(639, 'mg90a6', 21, 'Thursday', 'Break', 'Break', 'Break', 'Break', '0'),
(640, 'ejzay5', 21, 'Thursday', '8.30 AM', '9.30 AM', '', '', '0'),
(641, 'ese4r9', 21, 'Friday', '6.00 AM', '7.00 AM', '', '', '0'),
(642, 'qvs6e8', 21, 'Friday', '7.00 AM', '8.00 AM', '6', '6', '0'),
(643, 'qvs6e8', 21, 'Friday', 'Break', 'Break', 'Break', 'Break', '0'),
(644, 'q8ep95', 21, 'Friday', '8.30 AM', '9.30 AM', '', '', '0'),
(645, '5imuo8', 21, 'Saturday', '6.00 AM', '7.00 AM', '', '', '0'),
(646, 'jkes75', 21, 'Saturday', '7.00 AM', '8.00 AM', '', '', '0'),
(647, 'jkes75', 21, 'Saturday', 'Break', 'Break', 'Break', 'Break', '0'),
(648, 'byc3v4', 21, 'Saturday', '8.30 AM', '9.30 AM', '', '', '0'),
(649, 'jfqq13', 21, 'Monday', '6.00 AM', '7.00 AM', '6', '9', '1'),
(650, 'qlyje1', 21, 'Monday', '7.00 AM', '8.00 AM', '7', '7', '1'),
(651, 'qlyje1', 21, 'Monday', 'Break', 'Break', 'Break', 'Break', '1'),
(652, '3w9au9', 21, 'Monday', '8.30 AM', '9.30 AM', '', '', '1'),
(653, 'g20jj2', 21, 'Tuesday', '6.00 AM', '7.00 AM', '', '', '1'),
(654, 'y9n4h0', 21, 'Tuesday', '7.00 AM', '8.00 AM', '', '', '1'),
(655, 'y9n4h0', 21, 'Tuesday', 'Break', 'Break', 'Break', 'Break', '1'),
(656, 'dc0cr1', 21, 'Tuesday', '8.30 AM', '9.30 AM', '', '', '1'),
(657, 'b5g7r9', 21, 'Wednesday', '6.00 AM', '7.00 AM', '', '', '1'),
(658, 'is8nj6', 21, 'Wednesday', '7.00 AM', '8.00 AM', '', '', '1'),
(659, 'is8nj6', 21, 'Wednesday', 'Break', 'Break', 'Break', 'Break', '1'),
(660, '0rnvy2', 21, 'Wednesday', '8.30 AM', '9.30 AM', '', '', '1'),
(661, 'fbgky1', 21, 'Thursday', '6.00 AM', '7.00 AM', '', '', '1'),
(662, 'apu3u1', 21, 'Thursday', '7.00 AM', '8.00 AM', '', '', '1'),
(663, 'apu3u1', 21, 'Thursday', 'Break', 'Break', 'Break', 'Break', '1'),
(664, '5dyti6', 21, 'Thursday', '8.30 AM', '9.30 AM', '', '', '1'),
(665, 'y609p2', 21, 'Friday', '6.00 AM', '7.00 AM', '', '', '1'),
(666, '7tjh95', 21, 'Friday', '7.00 AM', '8.00 AM', '6', '6', '1'),
(667, '7tjh95', 21, 'Friday', 'Break', 'Break', 'Break', 'Break', '1'),
(668, 'aup9b7', 21, 'Friday', '8.30 AM', '9.30 AM', '', '', '1'),
(669, 'n2g9p7', 21, 'Saturday', '6.00 AM', '7.00 AM', '', '', '1'),
(670, '2sxhz3', 21, 'Saturday', '7.00 AM', '8.00 AM', '', '', '1'),
(671, '2sxhz3', 21, 'Saturday', 'Break', 'Break', 'Break', 'Break', '1'),
(672, 'y1jbv5', 21, 'Saturday', '8.30 AM', '9.30 AM', '', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tt_staff_119`
--

CREATE TABLE IF NOT EXISTS `tt_staff_119` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `days` varchar(255) NOT NULL,
  `one` varchar(255) NOT NULL,
  `two` varchar(255) NOT NULL,
  `three` varchar(255) NOT NULL,
  `four` varchar(255) NOT NULL,
  `five` varchar(255) NOT NULL,
  `six` varchar(255) NOT NULL,
  `seven` varchar(255) NOT NULL,
  `eight` varchar(255) NOT NULL,
  `nine` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tt_staff_119`
--

INSERT INTO `tt_staff_119` (`id`, `days`, `one`, `two`, `three`, `four`, `five`, `six`, `seven`, `eight`, `nine`) VALUES
(1, '1', '', '', '', '', '', '', '', '', ''),
(2, '2', '', '', '', '', '', '', '', '', ''),
(3, '3', '', '', '', '', '', '', '', '', ''),
(4, '4', '', '', '', '', '', '', '', '', ''),
(5, '5', '', '', '', '', '', '', '', '', ''),
(6, '6', '', '', '', '', '', '', '', '', ''),
(7, '7', '', '', '', '', '', '', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
