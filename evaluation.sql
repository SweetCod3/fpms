-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2022 at 02:03 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evaluation`
--

-- --------------------------------------------------------

--
-- Table structure for table `allowed_f`
--

CREATE TABLE `allowed_f` (
  `al_id` int(11) NOT NULL,
  `al_ext` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `allowed_f`
--

INSERT INTO `allowed_f` (`al_id`, `al_ext`) VALUES
(2, 'pdf'),
(3, 'xlsx'),
(4, 'xlsm'),
(5, 'docx'),
(7, 'png'),
(8, 'jpeg'),
(9, 'psd'),
(10, 'mp3');

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `ann_id` int(11) NOT NULL,
  `ann_desc` varchar(1000) NOT NULL,
  `ann_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`ann_id`, `ann_desc`, `ann_date`) VALUES
(1, '<b>BSIS - Eval Schedule</b>', '2022-11-30 11:21:10'),
(2, '1st Year - December 8 - 9, 2022', '2022-11-30 11:21:58'),
(3, '2nd Year - December 10 - 11, 2022', '2022-11-30 11:22:29'),
(4, '3rd - Year - December 12 - 13, 2022', '2022-11-30 11:23:00'),
(5, '4th Year - December 14 - 15, 2022 ', '2022-11-30 11:23:26'),
(11, '<b>BSIS - Eval Schedule</b>', '2022-11-30 11:26:09'),
(12, '1st Year - December 8 - 9, 2022', '2022-11-30 11:26:20'),
(13, '2nd Year - December 10 - 11, 2022', '2022-11-30 11:26:25'),
(14, '3rd - Year - December 12 - 13, 2022', '2022-11-30 11:26:32'),
(15, '4th Year - December 14 - 15, 2022 ', '2022-11-30 11:26:38');

-- --------------------------------------------------------

--
-- Table structure for table `comment_type`
--

CREATE TABLE `comment_type` (
  `comment_id` int(11) NOT NULL,
  `e_code` varchar(255) NOT NULL,
  `comment_feedback` varchar(255) NOT NULL,
  `negative_comment` varchar(255) NOT NULL,
  `com_uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment_type`
--

INSERT INTO `comment_type` (`comment_id`, `e_code`, `comment_feedback`, `negative_comment`, `com_uid`) VALUES
(1, 'HR-1446634471', 'Ganda ganda nyo po', 'Bad comment -testing', 55),
(2, 'HR-1446634471', 'Bait nyo nman po', 'Bad comment -testing', 56),
(3, 'HR-1446634471', 'Masungit', 'Bad comment -testing', 57),
(4, 'HR-2040449147', 'mbait', 'Bad comment -testing', 58),
(5, 'HR-2040449147', 'kyot\r\n', 'Bad comment -testing', 59),
(6, 'HR-2040449147', 'sunget', 'Bad comment -testing', 60),
(7, 'HR-1555296050', 'lamaw', 'Bad comment -testing', 61),
(8, 'HR-1546050676', 'kyot kyot', 'Bad comment -testing', 62),
(10, 'HR-1392677366', 'good commnet -testing', 'Bad comment -testing', 63),
(11, 'HR-1300393662', 'mgaling na teacher', 'masungit pero', 65),
(12, 'HR-1925172419', 'testing good comment', 'testing bad comment', 64),
(16, 'HR-1925172419', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis a mollis lorem, a varius elit. Mauris condimentum suscipit hendrerit. Integer fringilla convallis odio mollis bibendum. Etiam laoreet commodo enim sed eleifend. Pellentesque habitant morbi tris', 'Proin tristique laoreet lorem, sit amet tempus sem condimentum sit amet. Pellentesque nec condimentum nibh. Proin in arcu et justo interdum blandit. Quisque ornare risus at euismod vehicula. Duis malesuada, nisi ac imperdiet pellentesque, metus lorem fini', 74),
(17, 'HR-1925172419', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis a mollis lorem, a varius elit. Mauris condimentum suscipit hendrerit. Integer fringilla convallis odio mollis bibendum. Etiam laoreet commodo enim sed eleifend. Pellentesque habitant morbi tris', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis a mollis lorem, a varius elit. Mauris condimentum suscipit hendrerit. Integer fringilla convallis odio mollis bibendum. Etiam laoreet commodo enim sed eleifend. Pellentesque habitant morbi tris', 69);

-- --------------------------------------------------------

--
-- Table structure for table `course_list`
--

CREATE TABLE `course_list` (
  `section_id` int(11) NOT NULL,
  `section_name` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_list`
--

INSERT INTO `course_list` (`section_id`, `section_name`, `created_by`, `date_added`) VALUES
(1, 'STEM', 'Missionari della fede', '2020-03-05 14:01:35'),
(2, 'GAS', 'Missionari della fede', '2020-03-05 14:01:45'),
(3, 'HUMMS', 'Missionari della fede', '2020-03-05 14:01:56'),
(4, 'ABM', 'Missionari della fede', '2020-03-05 14:02:05'),
(5, 'ICT', 'Howard Wolowitz', '2022-11-25 12:22:42');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `day_id` int(11) NOT NULL,
  `day_name` text NOT NULL,
  `day_category` int(11) NOT NULL COMMENT '0=hs, elem 1= Senior',
  `created_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `deliv_files`
--

CREATE TABLE `deliv_files` (
  `file_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_dest` varchar(255) NOT NULL,
  `file_type` varchar(255) NOT NULL,
  `file_uid` int(11) NOT NULL,
  `file_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deliv_files`
--

INSERT INTO `deliv_files` (`file_id`, `file_name`, `file_dest`, `file_type`, `file_uid`, `file_date`) VALUES
(3, 'IMG_20220222_154914_134.png638603bea20942.75667913.png', '../uploads/IMG_20220222_154914_134.png638603bea20942.75667913.png', 'png', 48, '2022-11-29 00:00:00'),
(4, 'IMG_20220222_154914_134.png6386081c001553.05958189.png', '../uploads/IMG_20220222_154914_134.png6386081c001553.05958189.png', 'png', 48, '2022-11-29 00:00:00'),
(5, '284107276_282877153980397_8896817869176930363_n.png63860972322068.78324857.png', '../uploads/284107276_282877153980397_8896817869176930363_n.png63860972322068.78324857.png', 'png', 48, '2022-11-29 00:00:00'),
(7, 'NicePng_man-jumping-png_2853431.png6386eaf55db067.48221972.png', '../uploads/NicePng_man-jumping-png_2853431.png6386eaf55db067.48221972.png', 'png', 48, '2022-11-30 00:00:00'),
(8, 'White-Coffee-Mug-PNG-Download-Image.png6386f1be3d7c66.48496020.png', '../uploads/White-Coffee-Mug-PNG-Download-Image.png6386f1be3d7c66.48496020.png', 'png', 49, '2022-11-30 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_sheet`
--

CREATE TABLE `evaluation_sheet` (
  `eval_id` int(11) NOT NULL,
  `e_code` varchar(255) NOT NULL,
  `sub_incharge` varchar(255) NOT NULL,
  `e_status` int(11) NOT NULL,
  `date_started` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evaluation_sheet`
--

INSERT INTO `evaluation_sheet` (`eval_id`, `e_code`, `sub_incharge`, `e_status`, `date_started`) VALUES
(2, 'HR-1571769425', '5', 1, '2022-08-13'),
(3, 'HR-1974064210', '6', 1, '2022-08-13'),
(4, 'HR-1925172419', '7', 1, '2022-08-13'),
(5, 'HR-235745849', '8', 1, '2022-08-13');

-- --------------------------------------------------------

--
-- Table structure for table `ipcrf`
--

CREATE TABLE `ipcrf` (
  `form_id` int(11) NOT NULL,
  `form_name` varchar(255) NOT NULL,
  `creator` varchar(255) NOT NULL,
  `teacher` varchar(255) NOT NULL,
  `mfo_type` varchar(255) NOT NULL,
  `strat_prio` varchar(255) NOT NULL,
  `measure` varchar(255) NOT NULL,
  `target` varchar(255) NOT NULL,
  `actual_acc` varchar(255) NOT NULL,
  `r_q1` int(11) NOT NULL,
  `r_e2` int(11) NOT NULL,
  `r_t3` int(11) NOT NULL,
  `r_a4` int(11) NOT NULL,
  `remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ipcrf_ansf`
--

CREATE TABLE `ipcrf_ansf` (
  `fans_id` int(11) NOT NULL,
  `fans_fid` int(11) NOT NULL,
  `fans_frate` double DEFAULT NULL,
  `fans_date` datetime NOT NULL,
  `fans_appr` int(11) NOT NULL DEFAULT 0,
  `fans_appr_date` datetime DEFAULT NULL,
  `fans_appr_admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ipcrf_ansf`
--

INSERT INTO `ipcrf_ansf` (`fans_id`, `fans_fid`, `fans_frate`, `fans_date`, `fans_appr`, `fans_appr_date`, `fans_appr_admin`) VALUES
(1, 48, 4.01, '2022-11-29 04:02:00', 2, '2022-11-29 04:34:00', 91),
(2, 49, 3.75, '2022-11-30 11:37:00', 2, '2022-11-30 11:43:00', 91),
(3, 45, 5, '2022-11-30 12:08:00', 2, '2022-11-30 01:17:00', 91);

-- --------------------------------------------------------

--
-- Table structure for table `ipcrf_ansm`
--

CREATE TABLE `ipcrf_ansm` (
  `mans_id` int(11) NOT NULL,
  `mans_fid` int(11) NOT NULL,
  `mans_meas` int(11) NOT NULL,
  `mans_accomp` varchar(255) NOT NULL,
  `mans_remark` varchar(255) NOT NULL,
  `mans_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ipcrf_ansm`
--

INSERT INTO `ipcrf_ansm` (`mans_id`, `mans_fid`, `mans_meas`, `mans_accomp`, `mans_remark`, `mans_date`) VALUES
(1, 48, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ullamcorper est id ultricies laoreet. Aliquam semper, ipsum quis sollicitudin molestie,', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ullamcorper est id ultricies laoreet. Aliquam semper, ipsum quis sollicitudin molestie,', '2022-11-29 04:02:00'),
(2, 48, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ullamcorper est id ultricies laoreet. Aliquam semper, ipsum quis sollicitudin molestie,', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ullamcorper est id ultricies laoreet. Aliquam semper, ipsum quis sollicitudin molestie,', '2022-11-29 04:02:00'),
(3, 48, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ullamcorper est id ultricies laoreet. Aliquam semper, ipsum quis sollicitudin molestie,', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ullamcorper est id ultricies laoreet. Aliquam semper, ipsum quis sollicitudin molestie,', '2022-11-29 04:02:00'),
(4, 48, 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ullamcorper est id ultricies laoreet. Aliquam semper, ipsum quis sollicitudin molestie,', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ullamcorper est id ultricies laoreet. Aliquam semper, ipsum quis sollicitudin molestie,', '2022-11-29 04:02:00'),
(5, 48, 5, 'sfasfasfa', 'sfasfasfasfafsasf', '2022-11-29 04:02:00'),
(6, 48, 6, 'ASAFAF', 'asfasFASA', '2022-11-29 04:02:00'),
(7, 48, 7, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ullamcorper est id ultricies laoreet. Aliquam semper, ipsum quis sollicitudin molestie,', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ullamcorper est id ultricies laoreet. Aliquam semper, ipsum quis sollicitudin molestie,', '2022-11-29 04:02:00'),
(8, 48, 8, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ullamcorper est id ultricies laoreet. Aliquam semper, ipsum quis sollicitudin molestie,', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ullamcorper est id ultricies laoreet. Aliquam semper, ipsum quis sollicitudin molestie,', '2022-11-29 04:02:00'),
(9, 48, 9, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ullamcorper est id ultricies laoreet. Aliquam semper, ipsum quis sollicitudin molestie,', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ullamcorper est id ultricies laoreet. Aliquam semper, ipsum quis sollicitudin molestie,', '2022-11-29 04:02:00'),
(10, 48, 10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ullamcorper est id ultricies laoreet. Aliquam semper, ipsum quis sollicitudin molestie,', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ullamcorper est id ultricies laoreet. Aliquam semper, ipsum quis sollicitudin molestie,', '2022-11-29 04:02:00'),
(11, 48, 11, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ullamcorper est id ultricies laoreet. Aliquam semper, ipsum quis sollicitudin molestie,', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ullamcorper est id ultricies laoreet. Aliquam semper, ipsum quis sollicitudin molestie,', '2022-11-29 04:02:00'),
(12, 48, 12, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ullamcorper est id ultricies laoreet. Aliquam semper, ipsum quis sollicitudin molestie,', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ullamcorper est id ultricies laoreet. Aliquam semper, ipsum quis sollicitudin molestie,', '2022-11-29 04:02:00'),
(13, 49, 3, 'TEST', 'TEST', '2022-11-30 11:37:00'),
(14, 49, 4, 'TEST', 'TEST', '2022-11-30 11:37:00'),
(15, 49, 5, 'ASFASF', 'TEST', '2022-11-30 11:37:00'),
(16, 49, 6, 'TEST', 'TEST', '2022-11-30 11:37:00'),
(17, 49, 7, 'TEST', 'TEST', '2022-11-30 11:37:00'),
(18, 49, 8, 'TEST', 'TEST', '2022-11-30 11:37:00'),
(19, 49, 9, 'TEST', 'TEST', '2022-11-30 11:37:00'),
(20, 49, 10, 'TEST', 'TEST', '2022-11-30 11:37:00'),
(21, 49, 11, 'TEST', 'TEST', '2022-11-30 11:37:00'),
(22, 49, 12, 'TEST', 'TEST', '2022-11-30 11:37:00'),
(23, 45, 1, 'TESTT', 'TEST', '2022-11-30 12:08:00'),
(24, 45, 2, '10201001', '10201001', '2022-11-30 12:08:00'),
(25, 45, 3, 'TEST', 'QETQE', '2022-11-30 12:08:00'),
(26, 45, 4, 'TEST', 'TEST', '2022-11-30 12:08:00'),
(27, 45, 5, '', '', '2022-11-30 12:08:00'),
(28, 45, 6, '', '', '2022-11-30 12:08:00'),
(29, 45, 7, 'TEST', 'TEST', '2022-11-30 12:08:00'),
(30, 45, 8, 'TEST', 'TEST', '2022-11-30 12:08:00'),
(31, 45, 9, 'TEST', 'TEST', '2022-11-30 12:08:00'),
(32, 45, 10, 'TEST', 'TEST', '2022-11-30 12:08:00'),
(33, 45, 11, '', '', '2022-11-30 12:08:00'),
(34, 45, 12, 'TEST', 'TEST', '2022-11-30 12:08:00');

-- --------------------------------------------------------

--
-- Table structure for table `ipcrf_anst`
--

CREATE TABLE `ipcrf_anst` (
  `ans_id` int(11) NOT NULL,
  `ans_fid` int(11) NOT NULL,
  `ans_target` int(11) NOT NULL,
  `ans_val` int(11) NOT NULL,
  `ans_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ipcrf_anst`
--

INSERT INTO `ipcrf_anst` (`ans_id`, `ans_fid`, `ans_target`, `ans_val`, `ans_date`) VALUES
(59, 47, 7, 5, '2022-11-29 12:16:00'),
(60, 47, 8, 5, '2022-11-29 12:16:00'),
(61, 47, 9, 5, '2022-11-29 12:16:00'),
(62, 47, 10, 5, '2022-11-29 12:16:00'),
(63, 47, 11, 5, '2022-11-29 12:16:00'),
(64, 47, 12, 5, '2022-11-29 12:16:00'),
(65, 47, 13, 5, '2022-11-29 12:16:00'),
(66, 47, 32, 5, '2022-11-29 12:16:00'),
(67, 47, 15, 5, '2022-11-29 12:16:00'),
(68, 47, 16, 5, '2022-11-29 12:16:00'),
(69, 47, 17, 5, '2022-11-29 12:16:00'),
(70, 47, 18, 5, '2022-11-29 12:16:00'),
(71, 47, 24, 5, '2022-11-29 12:16:00'),
(72, 47, 25, 5, '2022-11-29 12:16:00'),
(73, 47, 26, 5, '2022-11-29 12:16:00'),
(74, 47, 27, 5, '2022-11-29 12:16:00'),
(75, 47, 28, 5, '2022-11-29 12:16:00'),
(76, 47, 29, 0, '2022-11-29 12:16:00'),
(77, 47, 30, 5, '2022-11-29 12:16:00'),
(78, 47, 31, 5, '2022-11-29 12:16:00'),
(79, 48, 1, 5, '2022-11-29 04:02:00'),
(80, 48, 2, 5, '2022-11-29 04:02:00'),
(81, 48, 3, 5, '2022-11-29 04:02:00'),
(82, 48, 4, 5, '2022-11-29 04:02:00'),
(83, 48, 5, 5, '2022-11-29 04:02:00'),
(84, 48, 6, 2, '2022-11-29 04:02:00'),
(85, 48, 7, 5, '2022-11-29 04:02:00'),
(86, 48, 8, 5, '2022-11-29 04:02:00'),
(87, 48, 9, 5, '2022-11-29 04:02:00'),
(88, 48, 10, 4, '2022-11-29 04:02:00'),
(89, 48, 11, 4, '2022-11-29 04:02:00'),
(90, 48, 12, 1, '2022-11-29 04:02:00'),
(91, 48, 13, 4, '2022-11-29 04:02:00'),
(92, 48, 14, 3, '2022-11-29 04:02:00'),
(93, 48, 15, 5, '2022-11-29 04:02:00'),
(94, 48, 16, 3, '2022-11-29 04:02:00'),
(95, 48, 17, 3, '2022-11-29 04:02:00'),
(96, 48, 18, 3, '2022-11-29 04:02:00'),
(97, 48, 19, 5, '2022-11-29 04:02:00'),
(98, 48, 20, 4, '2022-11-29 04:02:00'),
(99, 48, 21, 2, '2022-11-29 04:02:00'),
(100, 49, 4, 5, '2022-11-30 11:37:00'),
(101, 49, 5, 5, '2022-11-30 11:37:00'),
(102, 49, 6, 5, '2022-11-30 11:37:00'),
(103, 49, 7, 5, '2022-11-30 11:37:00'),
(104, 49, 8, 5, '2022-11-30 11:37:00'),
(105, 49, 9, 5, '2022-11-30 11:37:00'),
(106, 49, 10, 5, '2022-11-30 11:37:00'),
(107, 49, 11, 5, '2022-11-30 11:37:00'),
(108, 49, 12, 5, '2022-11-30 11:37:00'),
(109, 49, 13, 5, '2022-11-30 11:37:00'),
(110, 49, 14, 5, '2022-11-30 11:37:00'),
(111, 49, 15, 5, '2022-11-30 11:37:00'),
(112, 49, 16, 5, '2022-11-30 11:37:00'),
(113, 49, 17, 5, '2022-11-30 11:37:00'),
(114, 49, 18, 5, '2022-11-30 11:37:00'),
(115, 49, 19, 5, '2022-11-30 11:37:00'),
(116, 49, 20, 5, '2022-11-30 11:37:00'),
(117, 49, 21, 5, '2022-11-30 11:37:00'),
(118, 45, 1, 5, '2022-11-30 12:08:00'),
(119, 45, 2, 5, '2022-11-30 12:08:00'),
(120, 45, 3, 5, '2022-11-30 12:08:00'),
(121, 45, 4, 5, '2022-11-30 12:08:00'),
(122, 45, 5, 5, '2022-11-30 12:08:00'),
(123, 45, 6, 5, '2022-11-30 12:08:00'),
(124, 45, 7, 5, '2022-11-30 12:08:00'),
(125, 45, 8, 5, '2022-11-30 12:08:00'),
(126, 45, 9, 5, '2022-11-30 12:08:00'),
(127, 45, 10, 5, '2022-11-30 12:08:00'),
(128, 45, 11, 5, '2022-11-30 12:08:00'),
(129, 45, 12, 5, '2022-11-30 12:08:00'),
(130, 45, 13, 5, '2022-11-30 12:08:00'),
(131, 45, 14, 5, '2022-11-30 12:08:00'),
(132, 45, 15, 5, '2022-11-30 12:08:00'),
(133, 45, 16, 5, '2022-11-30 12:08:00'),
(134, 45, 17, 5, '2022-11-30 12:08:00'),
(135, 45, 18, 5, '2022-11-30 12:08:00'),
(136, 45, 19, 5, '2022-11-30 12:08:00'),
(137, 45, 20, 5, '2022-11-30 12:08:00'),
(138, 45, 21, 5, '2022-11-30 12:08:00');

-- --------------------------------------------------------

--
-- Table structure for table `ipcrf_category`
--

CREATE TABLE `ipcrf_category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ipcrf_category`
--

INSERT INTO `ipcrf_category` (`cat_id`, `cat_name`) VALUES
(1, 'Core Functions'),
(2, 'Strategic Functions'),
(5, 'Support to Other Functions');

-- --------------------------------------------------------

--
-- Table structure for table `ipcrf_legend`
--

CREATE TABLE `ipcrf_legend` (
  `leg_id` int(11) NOT NULL,
  `leg_value` int(11) NOT NULL,
  `leg_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ipcrf_legend`
--

INSERT INTO `ipcrf_legend` (`leg_id`, `leg_value`, `leg_name`) VALUES
(1, 1, 'Poor'),
(2, 2, 'Unsatisfactory'),
(3, 3, 'Satisfactory'),
(4, 4, 'Very Satisfactory '),
(5, 5, 'Outstanding\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `ipcrf_measures`
--

CREATE TABLE `ipcrf_measures` (
  `meas_id` int(11) NOT NULL,
  `meas_desc` varchar(255) NOT NULL,
  `meas_wt` double NOT NULL,
  `meas_sp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ipcrf_measures`
--

INSERT INTO `ipcrf_measures` (`meas_id`, `meas_desc`, `meas_wt`, `meas_sp`) VALUES
(1, 'Development   of instructional materials', 0.15, 1),
(2, 'Application of Teaching strategy', 0.1, 1),
(3, 'Construction of test material(s) highlighting integration of content knowledge within and across subject areas', 0.1, 2),
(4, 'Performance tasks highlighting integration of content knowledge within and across subject areas', 0.1, 2),
(5, 'Faculty rated very satisfactory or better by the following: Students', 0.2, 3),
(6, 'Faculty rated very satisfactory or better by the following:  Supervisors', 0.05, 3),
(7, 'Participation on the conduct of research', 0.1, 4),
(8, 'Participation in the College extension program', 0.1, 5),
(9, 'Participation in School Activities', 0.03, 6),
(10, 'Conduct of Consultation to Advisory Class / Classes and to students of teaching loads for the semester', 0.02, 6),
(11, 'Submission of Grade sheets/ consultation forms/TOMF, and other required documents', 0.02, 6),
(12, 'Professional Development - Attendance to meeting and seminars(2%), Attendance to School Meetings (1%)', 0.03, 6);

-- --------------------------------------------------------

--
-- Table structure for table `ipcrf_metrics`
--

CREATE TABLE `ipcrf_metrics` (
  `met_id` int(11) NOT NULL,
  `met_desc` varchar(255) NOT NULL,
  `met_leg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ipcrf_stratprio`
--

CREATE TABLE `ipcrf_stratprio` (
  `sp_id` int(11) NOT NULL,
  `sp_desc` varchar(255) NOT NULL,
  `sp_cat` int(11) NOT NULL,
  `sp_wt` double NOT NULL,
  `access` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ipcrf_stratprio`
--

INSERT INTO `ipcrf_stratprio` (`sp_id`, `sp_desc`, `sp_cat`, `sp_wt`, `access`) VALUES
(1, 'Teaching Instruction(25%)', 1, 0.25, 0),
(2, 'Learning delivery', 1, 0.2, 0),
(3, 'Assessment on the delivery of learning instruction', 1, 0.25, 1),
(4, 'Research Capabilities', 2, 0.1, 0),
(5, 'Extension Capabilities', 2, 0.1, 0),
(6, 'Adherence to Institutional Standards and Policies', 5, 0.1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ipcrf_target`
--

CREATE TABLE `ipcrf_target` (
  `t_id` int(11) NOT NULL,
  `t_desc` varchar(1000) NOT NULL,
  `t_type` varchar(11) NOT NULL,
  `t_meas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ipcrf_target`
--

INSERT INTO `ipcrf_target` (`t_id`, `t_desc`, `t_type`, `t_meas`) VALUES
(1, 'Develop eight (12) instructional materials highlighting mastery of content and its integration in other subject areas: 1 for Developed less than four (4) instructional materials, 2 for Developed five (5) to seven (7) instructional materials, 3 for Developed eight (8) instructional materials, 4 for Developed nine (9) to twelve (12) instructional materials, and 5 for Developed thirteen (13) to sixteen (16) instructional materials', 'Quality', 1),
(2, 'Able to use eight (12) instructional materials highlighting mastery of content and its integration in other subject areas:\r\n\r\n1 for Able to use less than four (4) instructional materials,\r\n2 for Able to use five (5) to seven (7) instructional materials,\r\n3 for Able to use eight (8) instructional materials,\r\n4 for Able to use nine (9) to twelve (12) instructional materials, and \r\n5 for Able to use thirteen (13) to sixteen (16) instructional materials', 'Efficiency', 1),
(3, 'Used of three (4) various teaching strategies:\r\n1 for Used of one (1) teaching strategy for the entire semester,\r\n2 for Used of two (2) teaching strategies for the entire semester,\r\n3 for Used of three (3) teaching strategies for the entire semester,\r\n4 for Used of four (4) teaching strategies for the entire semester,\r\n5 for Used of five (5) or more teaching strategies for the entire semester', 'Quality', 2),
(4, 'Collaboration in the Construction of the two major term examinations with TOS:\r\n1 for Did not prepare any major examinations,\r\n2 for Collaborated in the preparation of one major examinations,\r\n3 for Collaborated in the preparations of two major examinations,\r\n4 for Constructed one major examination,\r\n5 for Constructed two major examinations', 'Quality', 3),
(5, 'Submission of major examinations on time:\r\n1 for The major examinations were submitted two (2) or more working days late from the deadline,\r\n2 for The major examinations were submitted one (1) working day late from the deadline,\r\n3 for The major examinations were submitted on time,\r\n4 for The major examinations were submitted one (1)  working day ahead of the deadline,\r\n5 for The major examinations were submitted two (2) or more working days ahead of the deadline', 'Timeliness', 3),
(6, 'Assignment of six (12) performance tasks for the entire semester:\r\n1 for No assigned performance task for the entire semester,\r\n2 for Assigned one (3) performance task for the entire semester,\r\n3 for Assigned two (6) performance tasks for the entire semester,\r\n4 for Assigned three (9) performance tasks for the entire semester,\r\n5 for Assigned at least four (12) performance tasks for the entire semester', 'Quality', 4),
(7, 'Faculty rated very satisfactory or better by the students in the performance evaluation:\r\n1 for Poor - Below 1.499,2 for Needs Improvement    1.5 &ndash; 2.499, 3 for Satisfactory 2.5 &ndash; 3.499, 4 for Very Satisfactory 3.5 &ndash; 4.499, 5 for Outstanding 4.5 &ndash; 5.000', 'Quality', 5),
(8, 'Faculty rated very satisfactory or better by the students in the performance evaluation: \r\n1 for Poor - Below 1.499,2 for Needs Improvement    1.5 &ndash; 2.499, 3 for Satisfactory 2.5 &ndash; 3.499, 4 for Very Satisfactory 3.5 &ndash; 4.499, 5 for Outstanding 4.5 &ndash; 5.000', 'Quality', 6),
(9, 'Submission of Research Output for the semester: \r\n1 for No research submitted,\r\n2 for 70% and below of the research proposal was accepted based on the rubrics,\r\n3 for 71 &ndash; 80% of the research was accepted based on the rubrics,\r\n4 for 81 &ndash; 90% of the research was accepted based on the rubrics,\r\n5 for 91 &ndash; 100% of the research was accepted based on the rubrics', 'Quality', 7),
(10, 'The Research was submitted on time: \r\n1 for No research submitted. \r\n2 for The Research was submitted one (1) or more working days after the deadline. \r\n3 for The Research was submitted on time. \r\n4 for The Research was submitted one (1) to three (3) working days before the deadline. \r\n5 for The Research was submitted four (4) or more working days before the deadline.', 'Quality', 7),
(11, 'Served as a resource speaker/ lecturer/ Instructor:', 'Quality', 8),
(12, 'Attended the activities on time: \r\n1 for No School Meetings attended in the semester,\r\n2 for 25% of school meetings attended in the semester,\r\n3 for 50 of school meetings attended in the semester,\r\n4 for 75%  of school meetings attended in the semester,\r\n5 for 100%  of school meetings attended in the Semester.', 'Timeliness', 8),
(13, 'Participated in three (3) school activities: \r\n1 for No participation in school activities, \r\n2 for Participated in one (1) school activity, \r\n3 for Participated in two (2) school activities, \r\n4 for Participated in three (3) school activities, \r\n5 for Participated in four (4) or more school activities', 'Efficiency', 9),
(14, 'No. of incurred tardiness: \r\n1 for 10 and above Incurred tardiness in participating to school activities,\r\n2 for 7 Incurred tardiness in participating to school activities, \r\n3 for 5 Incurred tardiness in participating to school activities, \r\n4 for 2 Incurred tardiness in participating to school activities, \r\n5 for Incurred no tardiness in participating to school activities', 'Timeliness', 9),
(15, 'Conducted consultation to 50% students in the entire semester: \r\n1 for No consultations were done to students in the entire semester, \r\n2 for 1 &ndash; 25 % consultations were done to students in the entire semester, \r\n3 for 26 &ndash; 50% consultations were done to students in the entire semester, \r\n4 for 51 &ndash; 75% consultations were done to students in the entire semester, \r\n5 for 76-100% consultations were done to students in the entire semester', 'Quality', 10),
(16, 'All grade sheets are accepted', 'Quality', 11),
(17, 'No late submitted grade sheets:', 'Timeliness', 11),
(18, 'Participation in  three (3) seminars/ trainings in the entire semester:\r\n1 for  1 Seminar Attended - No training or seminar attended in the semester, \r\n2 for  2 Seminars  Attended - One (1) to two (2) trainings and/or seminars attended in the semester, \r\n3 for  3 Seminar Attended - Three (3) trainings and/or seminars attended in the semester, \r\n4 for 4  Seminar Attended - Four (4) trainings and/or seminars attended in the semester,\r\n5 for 5 or more Seminar Attended - Five (5) or more trainings and/or seminars attended in the semester', 'Quality', 12),
(19, 'Was able to pass 6 units in post graduate studies in the semester', 'Quality', 12),
(20, 'Attended School Meetings in the semester: \r\n1 for No School Meetings attended in the semester, \r\n2 for 25% of school meetings attended in the semester, \r\n3 for 50 of school meetings attended in the semester, \r\n4 for 75%  of school meetings attended in the semester, \r\n5 for 100%  of school meetings attended in the Semester', 'Quality', 12),
(21, 'Incurred two (2) tardiness in attending school meetings held for the semester:\r\n1 for Incurred four (4) or more tardiness in attending school meetings for the semester,\r\n2 for Incurred three (3) tardiness in attending school meetings held for the semester,\r\n3 for Incurred two (2) tardiness in attending school meetings held for the semester,\r\n4 for Incurred one (1) tardiness in the school meetings held for the semester,\r\n5 for Incurred no tardiness in attending school meetings held for the semester', 'Timeliness', 12);

-- --------------------------------------------------------

--
-- Table structure for table `ipcrf_valmap`
--

CREATE TABLE `ipcrf_valmap` (
  `map_id` int(11) NOT NULL,
  `map_targ` int(11) NOT NULL,
  `map_desc` varchar(255) NOT NULL,
  `map_val` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `log_id` int(11) NOT NULL,
  `log_desc` varchar(255) NOT NULL,
  `date_created` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`log_id`, `log_desc`, `date_created`) VALUES
(1, 'Patrick Tandoc Sarmiento has signoff to the system', ''),
(2, 'Missionari  della fede has login to the system', ''),
(3, 'Missionari  della fede has signoff to the system', ''),
(4, 'Missionari  della fede has login to the system', ''),
(5, 'Missionari  della fede has login to the system', ''),
(6, 'Missionari  della fede has login to the system', ''),
(7, 'Missionari  della fede has login to the system', ''),
(8, 'Missionari  della fede has login to the system', ''),
(9, 'Missionari  della fede has login to the system', ''),
(10, 'Missionari  della fede has login to the system', ''),
(11, 'Missionari  della fede has login to the system', ''),
(12, 'russ rubio vicente has login to the system', ''),
(13, 'russ rubio vicente has login to the system', ''),
(14, 'Missionari  della fede has login to the system', ''),
(15, 'Missionari  della fede has login to the system', ''),
(16, 'Missionari  della fede has login to the system', ''),
(17, 'Jhayem Duran sahagun has login to the system', ''),
(18, 'Jhayem Duran sahagun has signoff to the system', ''),
(19, 'Russ Rubio Vicente has login to the system', ''),
(20, 'Russ Rubio Vicente has signoff to the system', ''),
(21, 'Waren punta Samiano has login to the system', ''),
(22, 'Missionari  della fede has login to the system', ''),
(23, 'Missionari  della fede has login to the system', ''),
(24, 'Jhayem Duran sahagun has login to the system', ''),
(25, 'Jhayem Duran sahagun has signoff to the system', ''),
(26, 'Russ Rubio Vicente has login to the system', ''),
(27, 'Russ Rubio Vicente has signoff to the system', ''),
(28, 'Waren punta Samiano has login to the system', ''),
(29, 'Lowella Lunaria Sancon has login to the system', ''),
(30, 'Paul Daniel Pagtalunan Corpuz has login to the system', ''),
(31, 'Paul Daniel Pagtalunan Corpuz has signoff to the system', ''),
(32, 'Lowella Lunaria Sancon has login to the system', ''),
(33, 'Missionari  della fede has login to the system', ''),
(34, 'Missionari  della fede has login to the system', ''),
(35, 'Paul Daniel Pagtalunan Corpuz has login to the system', ''),
(36, 'Missionari  della fede has login to the system', ''),
(37, 'Missionari  della fede has login to the system', ''),
(38, 'Missionari  della fede has login to the system', ''),
(39, 'Missionari  della fede has login to the system', ''),
(40, 'Missionari  della fede has login to the system', ''),
(41, 'Jun Amiel Ramos Dausin has login to the system', ''),
(42, 'Jun Amiel Ramos Dausin has signoff to the system', ''),
(43, 'Lowella Lunaria Sancon has login to the system', ''),
(44, 'Lowella Lunaria Sancon has signoff to the system', ''),
(45, 'Ma Khailah Telles Evio has login to the system', ''),
(46, 'Ma Khailah Telles Evio has signoff to the system', ''),
(47, 'Diana Arcel Catacutan Clemino has login to the system', ''),
(48, 'Diana Arcel Catacutan Clemino has signoff to the system', ''),
(49, 'Lowella Lunaria Sancon has login to the system', ''),
(50, 'Missionari  della fede has login to the system', ''),
(51, 'Missionari  della fede has login to the system', ''),
(52, 'Missionari  della fede has signoff to the system', ''),
(53, 'Jaymark Oliva Bermejo has login to the system', ''),
(54, 'Jaymark Oliva Bermejo has signoff to the system', ''),
(55, 'Glydel Maloles Califlores has login to the system', ''),
(56, 'Missionari  della fede has signoff to the system', ''),
(57, 'Glydel Maloles Califlores has signoff to the system', ''),
(58, 'Missionari  della fede has login to the system', ''),
(59, 'Diana Arcel Catacutan Clemino has login to the system', ''),
(60, 'Diana Arcel Catacutan Clemino has signoff to the system', ''),
(61, 'Jaymark Oliva Bermejo has login to the system', ''),
(62, 'Jaymark Oliva Bermejo has signoff to the system', ''),
(63, 'Glydel Maloles Califlores has login to the system', ''),
(64, 'Glydel Maloles Califlores has signoff to the system', ''),
(65, 'Missionari  della fede has signoff to the system', ''),
(66, 'Missionari  della fede has login to the system', ''),
(67, 'Lowella Lunaria Sancon has login to the system', ''),
(68, 'Lowella Lunaria Sancon has signoff to the system', ''),
(69, '   has signoff to the system', ''),
(70, 'Missionari  della fede has login to the system', ''),
(71, 'Missionari  della fede has signoff to the system', ''),
(72, 'Lowella Lunaria Sancon has login to the system', ''),
(73, 'Lowella Lunaria Sancon has signoff to the system', ''),
(74, 'Missionari  della fede has login to the system', ''),
(75, 'Missionari  della fede has signoff to the system', ''),
(76, 'Samuel Juvida Dela Cruz has login to the system', ''),
(77, 'Samuel Juvida Dela Cruz has signoff to the system', ''),
(78, 'Missionari  della fede has login to the system', ''),
(79, 'Paul Daniel Pagtalunan Corpuz has login to the system', ''),
(80, 'Paul Daniel Pagtalunan Corpuz has signoff to the system', ''),
(81, 'Margin Beth Rebong Yabut has login to the system', ''),
(82, 'Margin Beth Rebong Yabut has signoff to the system', ''),
(83, 'Missionari  della fede has login to the system', ''),
(84, 'Missionari  della fede has login to the system', ''),
(85, 'Gracylie Relova Evio has login to the system', ''),
(86, 'Gracylie Relova Evio has signoff to the system', ''),
(87, 'Patrick Tandoc Sarmiento has login to the system', ''),
(88, 'Patrick Tandoc Sarmiento has signoff to the system', ''),
(89, 'Gracylie Relova Evio has login to the system', ''),
(90, 'Gracylie Relova Evio has signoff to the system', ''),
(91, 'Patrick Tandoc Sarmiento has login to the system', ''),
(92, 'Patrick Tandoc Sarmiento has signoff to the system', ''),
(93, 'Gracylie Relova Evio has login to the system', ''),
(94, 'Missionari  della fede has login to the system', ''),
(95, 'Patrick Tandoc Sarmiento has login to the system', ''),
(96, 'Missionari  della fede has signoff to the system', ''),
(97, 'Patrick Tandoc Sarmiento has signoff to the system', ''),
(98, 'Missionari  della fede has login to the system', ''),
(99, 'Ferdinand Edralin Marcos has login to the system', ''),
(100, 'Missionari  della fede has signoff to the system', ''),
(101, 'Lowella Lunaria Sancon has login to the system', ''),
(102, 'Lowella Lunaria Sancon has signoff to the system', ''),
(103, 'Missionari  della fede has login to the system', ''),
(104, 'Missionari  della fede has signoff to the system', ''),
(105, 'Lowella Lunaria Sancon has login to the system', ''),
(106, 'Lowella Lunaria Sancon has signoff to the system', ''),
(107, 'Missionari  della fede has login to the system', ''),
(108, 'Ferdinand Edralin Marcos has signoff to the system', ''),
(109, 'Ferdinand Edralin Marcos has login to the system', ''),
(110, 'Ferdinand Edralin Marcos has signoff to the system', ''),
(111, 'Lowella Lunaria Sancon has login to the system', ''),
(112, 'Missionari  della fede has signoff to the system', ''),
(113, 'Missionari  della fede has login to the system', ''),
(114, 'Missionari  della fede has signoff to the system', ''),
(115, 'Missionari  della fede has login to the system', ''),
(116, 'Missionari  della fede has signoff to the system', ''),
(117, 'Paul Daniel Pagtalunan Corpuz has login to the system', ''),
(118, 'Missionari  della fede has login to the system', ''),
(119, 'Missionari  della fede has signoff to the system', ''),
(120, 'Glydel Maloles Califlores has login to the system', ''),
(121, 'Missionari  della fede has login to the system', ''),
(122, 'Missionari  della fede has signoff to the system', ''),
(123, 'Missionari  della fede has login to the system', ''),
(124, 'Missionari  della fede has signoff to the system', ''),
(125, 'Missionari  della fede has login to the system', ''),
(126, 'Missionari  della fede has signoff to the system', ''),
(127, 'Missionari  della fede has login to the system', ''),
(128, 'Missionari  della fede has login to the system', ''),
(129, 'Missionari  della fede has signoff to the system', ''),
(130, 'Howard Heinken Wolowitz has login to the system', ''),
(131, 'Howard Heinken Wolowitz has signoff to the system', ''),
(132, 'Howard Heinken Wolowitz has login to the system', ''),
(133, 'Howard Heinken Wolowitz has login to the system', ''),
(134, 'Howard Heinken Wolowitz has login to the system', ''),
(135, 'Missionari  della fede has login to the system', ''),
(136, 'Howard Heinken Wolowitz has login to the system', ''),
(137, 'Howard Heinken Wolowitz has signoff to the system', ''),
(138, 'Lei Renell Corcuera Dausin has login to the system', ''),
(139, 'Lei Renell Corcuera Dausin has signoff to the system', ''),
(140, 'Missionari  della fede has login to the system', ''),
(141, 'Howard Heinken Wolowitz has login to the system', ''),
(142, 'Howard Heinken Wolowitz has login to the system', ''),
(143, 'Howard Heinken Wolowitz has signoff to the system', ''),
(144, 'Howard Heinken Wolowitz has login to the system', ''),
(145, 'Howard Heinken Wolowitz has signoff to the system', ''),
(146, 'Glydel Maloles Califlores has login to the system', ''),
(147, 'Glydel Maloles Califlores has login to the system', ''),
(148, 'Glydel Maloles Califlores has login to the system', ''),
(149, 'Glydel Maloles Califlores has login to the system', ''),
(150, 'Glydel Maloles Califlores has signoff to the system', ''),
(151, 'Howard  Wolowitz has login to the system', ''),
(152, 'Howard  Wolowitz has signoff to the system', ''),
(153, 'Glydel Maloles Califlores has login to the system', ''),
(154, 'Glydel Maloles Califlores has signoff to the system', ''),
(155, 'Howard  Wolowitz has login to the system', ''),
(156, 'Howard  Wolowitz has signoff to the system', ''),
(157, 'Ana Rose Buenaventura Cabral has login to the system', ''),
(158, 'Ana Rose Buenaventura Cabral has signoff to the system', ''),
(159, 'Howard  Wolowitz has login to the system', ''),
(160, 'Howard  Wolowitz has signoff to the system', ''),
(161, 'Ana Rose Buenaventura Cabral has login to the system', ''),
(162, 'Howard  Wolowitz has login to the system', ''),
(163, 'Howard  Wolowitz has signoff to the system', ''),
(164, 'Howard  Wolowitz has login to the system', ''),
(165, 'Howard  Wolowitz has signoff to the system', ''),
(166, 'Howard  Wolowitz has login to the system', ''),
(167, 'Howard  Wolowitz has login to the system', ''),
(168, 'Howard  Wolowitz has signoff to the system', ''),
(169, 'Howard  Wolowitz has login to the system', ''),
(170, 'Howard  Wolowitz has signoff to the system', ''),
(171, 'Howard  Wolowitz has login to the system', ''),
(172, 'Howard  Wolowitz has signoff to the system', ''),
(173, 'Trixie San jose Torres has login to the system', ''),
(174, 'Trixie San jose Torres has signoff to the system', ''),
(175, 'Trixie San jose Torres has login to the system', ''),
(176, 'Trixie San jose Torres has signoff to the system', ''),
(177, 'Trixie San jose Torres has login to the system', ''),
(178, 'Trixie San jose Torres has signoff to the system', ''),
(179, 'Howard  Wolowitz has login to the system', ''),
(180, 'Howard  Wolowitz has signoff to the system', ''),
(181, 'Trixie San jose Torres has login to the system', ''),
(182, 'Trixie San jose Torres has signoff to the system', ''),
(183, 'Howard  Wolowitz has login to the system', ''),
(184, 'Howard  Wolowitz has signoff to the system', ''),
(185, 'Dummy Farce McFake has login to the system', ''),
(186, 'Dummy Farce McFake has signoff to the system', ''),
(187, 'Howard  Wolowitz has login to the system', ''),
(188, 'Howard  Wolowitz has signoff to the system', ''),
(189, 'Trixie San jose Torres has login to the system', ''),
(190, 'Trixie San jose Torres has signoff to the system', ''),
(191, 'Howard  Wolowitz has login to the system', ''),
(192, 'Howard  Wolowitz has signoff to the system', ''),
(193, 'Mary Jane Mejia Bariring has login to the system', ''),
(194, 'Mary Jane Mejia Bariring has signoff to the system', ''),
(195, 'Trixie San jose Torres has login to the system', ''),
(196, 'Trixie San jose Torres has login to the system', ''),
(197, 'Howard  Wolowitz has login to the system', ''),
(198, 'Howard  Wolowitz has signoff to the system', ''),
(199, 'Trixie San jose Torres has login to the system', ''),
(200, 'Trixie San jose Torres has login to the system', ''),
(201, 'Trixie San jose Torres has signoff to the system', ''),
(202, 'Howard  Wolowitz has login to the system', ''),
(203, 'Howard  Wolowitz has signoff to the system', ''),
(204, 'Howard  Wolowitz has login to the system', ''),
(205, 'Howard  Wolowitz has signoff to the system', ''),
(206, 'Howard  Wolowitz has login to the system', ''),
(207, 'Howard  Wolowitz has signoff to the system', ''),
(208, 'Howard  Wolowitz has login to the system', ''),
(209, 'Howard  Wolowitz has signoff to the system', ''),
(210, 'Howard  Wolowitz has login to the system', ''),
(211, 'Howard  Wolowitz has signoff to the system', ''),
(212, 'Howard  Wolowitz has login to the system', ''),
(213, 'Howard  Wolowitz has signoff to the system', ''),
(214, 'Howard  Wolowitz has login to the system', ''),
(215, 'Howard  Wolowitz has signoff to the system', ''),
(216, 'Howard  Wolowitz has login to the system', ''),
(217, 'Howard  Wolowitz has signoff to the system', ''),
(218, 'Howard  Wolowitz has login to the system', ''),
(219, 'Howard  Wolowitz has signoff to the system', ''),
(220, 'Paul Daniel Pagtalunan Corpuz has login to the system', ''),
(221, 'Paul Daniel Pagtalunan Corpuz has signoff to the system', ''),
(222, 'Howard  Wolowitz has login to the system', ''),
(223, 'Howard  Wolowitz has signoff to the system', ''),
(224, 'Gracylie Relova Evio has login to the system', ''),
(225, 'Gracylie Relova Evio has signoff to the system', ''),
(226, 'Howard  Wolowitz has login to the system', ''),
(227, 'Howard  Wolowitz has signoff to the system', ''),
(228, 'Gracylie Relova Evio has login to the system', ''),
(229, 'Gracylie Relova Evio has signoff to the system', ''),
(230, 'Maria Theresa  Rebong has login to the system', ''),
(231, 'Maria Theresa  Rebong has signoff to the system', ''),
(232, 'Howard  Wolowitz has login to the system', ''),
(233, 'Howard  Wolowitz has signoff to the system', ''),
(234, 'Maria Theresa  Rebong has login to the system', ''),
(235, 'Maria Theresa  Rebong has signoff to the system', ''),
(236, 'Howard  Wolowitz has login to the system', ''),
(237, 'Howard  Wolowitz has signoff to the system', ''),
(238, 'Howard  Wolowitz has login to the system', ''),
(239, 'Howard  Wolowitz has signoff to the system', ''),
(240, 'Lowella Lunaria Sancon has login to the system', ''),
(241, 'Lowella Lunaria Sancon has signoff to the system', ''),
(242, 'Howard  Wolowitz has login to the system', ''),
(243, 'Howard  Wolowitz has signoff to the system', ''),
(244, 'Trixie San jose Torres has login to the system', ''),
(245, 'Trixie San jose Torres has signoff to the system', ''),
(246, 'Howard  Wolowitz has login to the system', ''),
(247, 'Howard  Wolowitz has signoff to the system', ''),
(248, 'Sheldon Bradey Cooper has login to the system', ''),
(249, 'Sheldon Bradey Cooper has signoff to the system', ''),
(250, 'Trixie San jose Torres has login to the system', ''),
(251, 'Trixie San jose Torres has signoff to the system', ''),
(252, 'Gracylie Relova Evio has login to the system', ''),
(253, 'Gracylie Relova Evio has signoff to the system', ''),
(254, 'Sheldon Bradey Cooper has login to the system', ''),
(255, 'Sheldon Bradey Cooper has signoff to the system', ''),
(256, 'Howard  Wolowitz has login to the system', '');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `q_id` int(11) NOT NULL,
  `question_name` varchar(255) NOT NULL,
  `avg_rate` varchar(255) NOT NULL,
  `rate_dean` varchar(255) NOT NULL,
  `question_cat` varchar(255) NOT NULL,
  `date_created` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`q_id`, `question_name`, `avg_rate`, `rate_dean`, `question_cat`, `date_created`) VALUES
(8, 'Demonstrates sensitively to students ability to attend and absorb content information.', '', '', 'A. Commitment', '2020-03-02 11:04 am'),
(9, 'Integrates sensitively his/her learning objectives with those of the students on a collaborative process.', '', '', 'A. Commitment', '2020-03-02 11:04 am'),
(10, 'Makes self available to students beyond official time.', '', '', 'A. Commitment', '2020-03-02 11:04 am'),
(11, 'Regularly comes to class on time, well groomed and well prepared to complete assigned task.', '', '', 'A. Commitment', '2020-03-02 11:04 am'),
(12, 'Keeps accurate records of students performance and prompt submission of the same.', '', '', 'A. Commitment', '2020-03-02 11:04 am'),
(13, 'Demonstrates mastery of the subject matter (explains the subject without relying solely on the prescribed textbook).', '', '', 'B. Knowledge of the subject', '2020-03-02 11:13 am'),
(14, 'Draws and share information on the state of the art theory and practice his/her discipline.', '', '', 'B. Knowledge of the subject', '2020-03-02 11:13 am'),
(15, 'Integrates subject to practical circumstances and learning intents/purposes of students.', '', '', 'B. Knowledge of the subject', '2020-03-02 11:13 am'),
(16, 'Explains the relevance of present topics to previous lessons and relates the subject matter to relevant current issues and/or daily activities.', '', '', 'B. Knowledge of the subject', '2020-03-02 11:13 am'),
(17, 'Demonstrates up-to-date knowledge and/or awareness of current trends and issues of the subject.', '', '', 'B. Knowledge of the subject', '2020-03-02 11:13 am'),
(18, 'Creates teaching strategies that allows students to practice concepts they need t understand (interactive discussion).', '', '', 'C. Teaching for independent learning', '2020-03-02 11:14 am'),
(19, 'Enhances student self-esteem and/or gives due recognition to students performance/potentials.', '', '', 'C. Teaching for independent learning', '2020-03-02 11:14 am'),
(20, 'Allows students to create their own course with objectives and realistically define student-professor rules and make them accountable for their performance.', '', '', 'C. Teaching for independent learning', '2020-03-02 11:14 am'),
(21, 'Allows students to think independently and make their own decisions and holding them accountable for their performance based largely on their success in executing decisions.', '', '', 'C. Teaching for independent learning', '2020-03-02 11:15 am'),
(22, 'Encourages students to learn beyond what is required and help/guide the students how to apply concepts learned.', '', '', 'C. Teaching for independent learning', '2020-03-02 11:15 am'),
(23, 'Creates opportunities for intensive and/or extensive contribution of students in the class activities (e.g. break class in dyads, triads or buzz/task group).', '', '', 'D. Management of learning', '2020-03-02 11:15 am'),
(24, 'Assumes roles as facilitator, resource person, coach, inquisitor, referee in drawing students to contribute to knowledge and understanding of the concepts of hand.', '', '', 'D. Management of learning', '2020-03-02 11:15 am'),
(25, 'Assumes various appropriate roles, (facilitator, coach, resource speaker, integrator, inquisitor, referee, etc.) in drawing students to contribute knowledge and understanding of the concepts at hand.', '', '', 'D. Management of learning', '2020-03-02 11:15 am'),
(26, 'Structures/re-structures learning conditions and experience that promotes healthy exchange and/or confrontations.', '', '', 'D. Management of learning', '2020-03-02 11:15 am'),
(27, 'Uses instructional materials (audio- video materials, fieldtrips, film showing, computer aided instruction and etc.) to reinforce learning processes.', '', '', 'D. Management of learning', '2020-03-02 11:16 am');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `result_id` int(11) NOT NULL,
  `e_code` varchar(255) NOT NULL,
  `question_cat` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `r_question` varchar(255) NOT NULL,
  `r_result` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`result_id`, `e_code`, `question_cat`, `user_id`, `r_question`, `r_result`) VALUES
(1, 'HR-1925172419', 'A. Commitment', 73, '8', 3),
(2, 'HR-1925172419', 'A. Commitment', 73, '9', 4),
(3, 'HR-1925172419', 'A. Commitment', 73, '10', 4),
(4, 'HR-1925172419', 'A. Commitment', 73, '11', 4),
(5, 'HR-1925172419', 'A. Commitment', 73, '12', 1),
(6, 'HR-1925172419', 'B. Knowledge of the subject', 73, '13', 3),
(7, 'HR-1925172419', 'B. Knowledge of the subject', 73, '14', 4),
(8, 'HR-1925172419', 'B. Knowledge of the subject', 73, '15', 4),
(9, 'HR-1925172419', 'B. Knowledge of the subject', 73, '16', 2),
(10, 'HR-1925172419', 'B. Knowledge of the subject', 73, '17', 5),
(11, 'HR-1925172419', 'C. Teaching for independent learning', 73, '18', 5),
(12, 'HR-1925172419', 'C. Teaching for independent learning', 73, '19', 5),
(13, 'HR-1925172419', 'C. Teaching for independent learning', 73, '20', 1),
(14, 'HR-1925172419', 'C. Teaching for independent learning', 73, '21', 2),
(15, 'HR-1925172419', 'C. Teaching for independent learning', 73, '22', 1),
(16, 'HR-1925172419', 'D. Management of learning', 73, '23', 5),
(17, 'HR-1925172419', 'D. Management of learning', 73, '24', 4),
(18, 'HR-1925172419', 'D. Management of learning', 73, '25', 5),
(19, 'HR-1925172419', 'D. Management of learning', 73, '26', 2),
(20, 'HR-1925172419', 'D. Management of learning', 73, '27', 3),
(61, 'HR-235745849', 'A. Commitment', 74, '8', 5),
(62, 'HR-235745849', 'A. Commitment', 74, '9', 5),
(63, 'HR-235745849', 'A. Commitment', 74, '10', 5),
(64, 'HR-235745849', 'A. Commitment', 74, '11', 5),
(65, 'HR-235745849', 'A. Commitment', 74, '12', 5),
(66, 'HR-235745849', 'B. Knowledge of the subject', 74, '13', 5),
(67, 'HR-235745849', 'B. Knowledge of the subject', 74, '14', 5),
(68, 'HR-235745849', 'B. Knowledge of the subject', 74, '15', 5),
(69, 'HR-235745849', 'B. Knowledge of the subject', 74, '16', 5),
(70, 'HR-235745849', 'B. Knowledge of the subject', 74, '17', 5),
(71, 'HR-235745849', 'C. Teaching for independent learning', 74, '18', 5),
(72, 'HR-235745849', 'C. Teaching for independent learning', 74, '19', 5),
(73, 'HR-235745849', 'C. Teaching for independent learning', 74, '20', 5),
(74, 'HR-235745849', 'C. Teaching for independent learning', 74, '21', 5),
(75, 'HR-235745849', 'C. Teaching for independent learning', 74, '22', 5),
(76, 'HR-235745849', 'D. Management of learning', 74, '23', 5),
(77, 'HR-235745849', 'D. Management of learning', 74, '24', 5),
(78, 'HR-235745849', 'D. Management of learning', 74, '25', 5),
(79, 'HR-235745849', 'D. Management of learning', 74, '26', 5),
(80, 'HR-235745849', 'D. Management of learning', 74, '27', 5);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_name`, `date_created`, `created_by`) VALUES
(1, 'R01', '2020-03-09 03:53:46', 'admin'),
(2, 'R02', '2020-03-09 03:53:53', 'admin'),
(3, 'R03', '2020-03-09 03:54:40', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `school_year`
--

CREATE TABLE `school_year` (
  `sy_id` int(11) NOT NULL,
  `year` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `set_default` int(255) NOT NULL,
  `created_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school_year`
--

INSERT INTO `school_year` (`sy_id`, `year`, `semester`, `date_created`, `set_default`, `created_by`) VALUES
(23, '2018-2019', '1st Semester', '2020-02-11 07:25:06', 0, 'admin'),
(24, '2020-2021', '1st Semester', '2020-02-11 07:25:00', 0, 'admin'),
(25, '2021-2022', '1st Semester', '2020-02-15 13:08:12', 0, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `student_list`
--

CREATE TABLE `student_list` (
  `list_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sched_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_list`
--

INSERT INTO `student_list` (`list_id`, `user_id`, `sched_id`) VALUES
(8, 10202001, 1),
(9, 10202002, 1),
(10, 10202003, 1),
(16, 10202004, 2),
(18, 10202001, 3),
(19, 10202002, 3),
(20, 10202003, 3),
(21, 10202001, 4),
(22, 10202002, 4),
(23, 10202003, 4),
(24, 10202004, 4),
(25, 10202005, 4),
(26, 10202006, 4),
(27, 10202007, 4),
(28, 10202016, 5),
(29, 10202017, 5),
(30, 10202014, 6),
(31, 10202012, 6),
(32, 12003661, 7),
(33, 16010141, 8);

-- --------------------------------------------------------

--
-- Table structure for table `subject_list`
--

CREATE TABLE `subject_list` (
  `sub_id` int(11) NOT NULL,
  `course_code` varchar(255) NOT NULL,
  `course_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subject_schedule`
--

CREATE TABLE `subject_schedule` (
  `sched_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `course_id` varchar(255) NOT NULL,
  `sub_from` time NOT NULL,
  `sub_code` varchar(255) NOT NULL,
  `sub_name` text NOT NULL,
  `sub_until` time NOT NULL,
  `sub_day` text NOT NULL,
  `sub_year` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject_schedule`
--

INSERT INTO `subject_schedule` (`sched_id`, `user_id`, `room_id`, `course_id`, `sub_from`, `sub_code`, `sub_name`, `sub_until`, `sub_day`, `sub_year`) VALUES
(5, 45, 1, '4', '07:00:00', 'Accounting', 'ABM', '17:00:00', 'MWF', '2020-2021'),
(6, 46, 1, '3', '13:00:00', 'ALGB2', 'Basic algebra', '15:00:00', 'MWF', '2018-2019'),
(7, 49, 1, '2', '08:00:00', 'CAL101', 'Basic Calculus', '09:00:00', '', ''),
(8, 45, 0, '4', '08:00:00', 'IT101', 'Networking 1', '17:00:00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `time_sched`
--

CREATE TABLE `time_sched` (
  `time_id` int(11) NOT NULL,
  `time_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_sched`
--

INSERT INTO `time_sched` (`time_id`, `time_name`) VALUES
(1, '07:00 '),
(2, '08:00'),
(3, '9:00'),
(4, '10:00'),
(5, '11:00'),
(6, '12:00');

-- --------------------------------------------------------

--
-- Table structure for table `upload_config`
--

CREATE TABLE `upload_config` (
  `config_id` int(11) NOT NULL,
  `config_size` int(11) NOT NULL,
  `config_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `upload_config`
--

INSERT INTO `upload_config` (`config_id`, `config_size`, `config_type`) VALUES
(0, 14000000, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `ipcrf` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `user_role` int(11) NOT NULL COMMENT '0=admin,1=prof, 2=student\r\nDouble nums: Unverified',
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `suffix` text NOT NULL,
  `section_name` varchar(255) NOT NULL,
  `user_address` text NOT NULL,
  `user_brgy` varchar(255) NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_contact` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_photo` varchar(255) NOT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`ipcrf`, `user_id`, `user_name`, `pass`, `user_role`, `fname`, `mname`, `lname`, `suffix`, `section_name`, `user_address`, `user_brgy`, `user_city`, `user_contact`, `user_email`, `user_photo`, `DateCreated`) VALUES
(1, 45, '10201001', 'fb3794f34ef37e0af9300756458aeda6b02aeb3d79a45356a23083ea2a93766d', 1, 'Lowella', 'Lunaria', 'Sancon', '', '', 'Victoria Sta.Cruz Laguna', 'sample brgy', 'sample city', '09307548854', 'LowellaSancon@yahoo.com', '', '2022-11-30 04:08:39'),
(0, 46, '10201002', 'a4e464387ac42eda5eddd3bdff9ee766d798f3b1108b503759871bea5f397fa2', 1, 'Glydel', 'Maloles', 'Califlores', '', '', 'Victoria Sta.Cruz Laguna', '', '', '09101875574', 'GlydelMalolesCaliflores@yahoo.com', '', '2022-11-30 04:07:08'),
(0, 47, '10201003', '24d6ef644387edce8488f538f6f58e350b7a99cde8887445b5e435e42d48c182', 1, 'Ana Rose', 'Buenaventura', 'Cabral', '', '', 'Victoria Sta.Cruz Laguna', '', '', '09093067816', 'AnaRoseCabral@yahoo.com', '', '2022-11-30 04:07:08'),
(0, 48, '10201004', '858c329d296df139ac54b1bfa41d9a5848e929020949fa3806665090a23485c4', 1, 'Trixie', 'San jose', 'Torres', '', '', 'Victoria Sta.Cruz Laguna', '', '', '09557137469', 'TrixieTorres@yahoo.com', '', '2022-11-30 04:07:08'),
(0, 49, '10201005', '994d344ada6caebe99f5a19545dae616f51e8e5985c613e0fe11087f00fcd08f', 1, 'Gracylie', 'Relova', 'Evio', '', '', 'Victoria Sta.Cruz Laguna', '', '', '09070736358', 'GracylieEvio@yahoo.com', '', '2022-11-30 04:07:08'),
(0, 50, '10201006', '03fc8e57cdf08fab99deda7463e341e20869819b84c70791b0e41247e5a72ec3', 1, 'Maria Theresa', '', 'Rebong', '', '', 'Victoria Sta.Cruz Laguna', '', '', '09357423874', 'MariaTheresaRebong@yahoo.com', '', '2022-11-30 04:07:08'),
(0, 55, '10202001', 'ebbab64b69ca4b5baf92297c4e76d8d245d06231519e82c856d029ead7f12ae4', 2, 'Paul Daniel', 'Pagtalunan', 'Corpuz', '', '2', 'Victoria', 'Sta.Cruz', 'Laguna', '09354654165', 'Pauldaniiel@yahoo.com', '', '2022-11-30 04:07:08'),
(0, 56, '10202002', 'e7029730eb3446c989699775235e71ef1886d979d1baa77273fdb2cd62cc6d50', 2, 'Samuel', 'Juvida', 'Dela Cruz', '', '1', '180 malakas street', 'Victoria', 'Calamba CIty Laguna', '09556546768', 'SamuelDelacruz@yahoo.com', '', '2022-11-30 04:07:08'),
(0, 57, '10202003', '26c74c326393a68399576b918672a79c377d1f5f8f3989783d87f7455e523506', 2, 'Ednym Christian', 'Ramirez', 'Espiritu', '', '1', 'Victoria Sta.Cruz Laguna', '', '', '09096562265', 'EdnymChristian@yahoo.com', '', '2022-11-30 04:07:08'),
(0, 58, '10202004', 'cdd1651e42700b86b70b7abfe3bbcdc4405ebe2af63122dbebbbe29f52ee5dab', 2, 'Ken Axl', 'Manaig', 'Cambe', '', '1', 'Victoria Sta.Cruz Laguna', '', '', '09070765468', 'KenAxl@yahoo.com', '', '2022-11-30 04:07:08'),
(0, 59, '10202005', '1668c457b2f9ddb4dd5d55f948290f7a56c47f0b0e91566c4af15c9e8104bccf', 2, 'Jay  Julius Japhet', 'Herradura', 'Ramos', '', '1', 'Victoria Sta.Cruz Laguna', '', '', '09101564871', 'Jayherradura@yahoo.com', '', '2022-11-30 04:07:08'),
(0, 60, '10202006', '6bce7484fdee02bee41613c0b6ee7334652651e3be2476eb2bd1eab1674fbac7', 2, 'Calvin Luiz', 'Relova', 'Rebong', '', '1', 'Victoria Sta.Cruz Laguna', '', '', '09106871654', 'CalvinRebong@yahoo.com', '', '2022-11-30 04:07:08'),
(0, 61, '10202007', '07856bec75ad099f7e9428189ea62fc12e8ef9aaafe54aec696a2c22ac9b4dcd', 2, 'Mary Jane', 'Mejia', 'Bariring', '', '1', 'Victoria Sta.Cruz Laguna', '', '', '09126138746', 'Maryjane@yahoo.com', '', '2022-11-30 04:07:08'),
(0, 62, '10202008', '6c16cd2d4630314c493318aead654315da2a9b957db910c0a4d58abd09255da8', 2, 'Diana', 'Villanueva', 'Camunias', '', '1', 'Victoria Sta.Cruz Laguna', '', '', '09101011054', 'Dianacamunias@yaoo.com', '', '2022-11-30 04:07:08'),
(0, 63, '10202009', '63bf987790036b7dd92515cae642bdaf90011e697f12404ca3931124f01a9fa3', 2, 'Marlyn', 'Torres', 'Herradura', '', '1', 'Victoria Sta.Cruz Laguna', '', '', '09067389910', 'Marlynherradura@yahoo.com', '', '2022-11-30 04:07:08'),
(0, 64, '10202010', 'a84e086d82b1abdb8fb55a9cf6ed58c51a3685348cf43ea90c5d8617d2fe7af3', 2, 'Margin Beth', 'Rebong', 'Yabut', '', '1', 'Victoria Sta.Cruz Laguna', '', '', '09061273947', 'Marginbethyabut@yahoo.com', '', '2022-11-30 04:07:08'),
(0, 65, '10202011', '5dd68c31394f6836b5fe5d58ae963bbbcafa5c0a2c46774a399e5d15be6134bd', 2, 'Aedrian', 'Usman', 'Bermejo', '', '3', 'Victoria Sta.Cruz Laguna', '', '', '09127361487', 'Aedrianbermejo@yahoo.com', '', '2022-11-30 04:07:08'),
(0, 66, '10202012', 'b4303931c779e54368ca4b31251ceb9f59d142aecb64847c5c69df6a0caa3617', 2, 'Jaymark', 'Oliva', 'Bermejo', '', '3', 'Victoria Sta.Cruz Laguna', '', '', '09550760460', 'Jaymarkbermejo@yahoo.com', '', '2022-11-30 04:07:08'),
(0, 67, '10202013', '58487d7c5e77af4f648cfc70662bc7e9da36042238c151ea5b6f27f5ce131c9f', 2, 'Lei Renell', 'Corcuera', 'Dausin', '', '3', 'Victoria Sta.Cruz Laguna', '', '', '09309059571', 'LeiRenellDausin@yahoo.com', '', '2022-11-30 04:07:08'),
(0, 68, '10202014', 'eb291340f4caff80c2ac160e27d0579773f8bbe5ab1eb2af5a00b9572571d743', 2, 'Angelo Arnez', 'Barcelona', 'Flores', '', '3', 'Victoria Sta.Cruz Laguna', '', '', '09067530484', 'Angeloflores@yahoo.com', '', '2022-11-30 04:07:08'),
(0, 69, '10202015', '421435cd9f61af3e576655bab773e047a88175ec348b810b6afb9495e072b443', 2, 'John Cedric', 'Cerrudo', 'Larano', '', '1', 'Victoria Sta.Cruz Laguna', '', '', '09094628103', 'JohncedrickLarano@yahoo.com', '', '2022-11-30 04:07:08'),
(0, 70, '10202016', 'd7fc762562a01b094f969c73a3d23246cf39663c6a5d8513568745340422ab9c', 2, 'Jun Amiel', 'Ramos', 'Dausin', '', '4', 'Victoria Sta.Cruz Laguna', '', '', '09127192863', 'JunAmielRamos@yahoo.com', '', '2022-11-30 04:07:08'),
(0, 71, '10202017', '743fcfc5ab673ee387ef8ca3dcbeba0ee3bfc913c871010248e1dcdbf0d611fa', 2, 'Diana Arcel', 'Catacutan', 'Clemino', '', '4', 'Victoria Sta.Cruz Laguna', '', '', '09551097613', 'DianaArcelClemino@yahoo.com', '', '2022-11-30 04:07:08'),
(0, 72, '10202018', 'b3310a1fa8a8cab645dbd63d9a0fd1a407b093de8f84ee66612e72db9d979294', 2, 'Ma Khailah', 'Telles', 'Evio', '', '1', 'Victoria Sta.Cruz Laguna', '', '', '09127743913', 'KhailahEvio@yahoo.com', '', '2022-11-30 04:07:08'),
(0, 73, '12003661', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 2, 'Patrick', 'Tandoc', 'Sarmiento', 'Jr', '2', '180 Domalandan East Lingayen Pangasinan', '', '', '099993658', 'ptsarmiento12@yahoo.com', '', '2022-11-30 04:07:08'),
(0, 74, '16010141', '80125031abdcbbb0e616c9c92b6b3bc5317b0429ab618239b7c44813d5c5804a', 2, 'Ferdinand', 'Edralin', 'Marcos', 'Jr.', '4', 'Sabangan', 'Laoag', 'Ilocos Sur', '09204663591', 'marcos@gmail.com', '', '2022-11-30 04:07:08'),
(0, 76, '12040545', '5f70c16f207e82dad0908bd29dd294a4ff3e13a21ae6cd2a449acf75859f2abd', 2, 'Mary Rose', 'Tandoc', 'Sarmiento', '', '1', '180', 'Domalandan East', 'Lingayen', '09993045355', 'sartanbikeshop@gmail.com', '', '2022-11-30 04:07:08'),
(0, 77, 'asdadassa', 'ea131682a48f9c291bf75b7b7a0b0bfc2f198930da4e43d2abf86177cb32ab13', 33, 'asdadassa', '', 'asdsad', '', '', '', '', '', '', 'root@aas.com', '', '2022-11-30 04:07:08'),
(0, 78, 'asdadassa', 'ea131682a48f9c291bf75b7b7a0b0bfc2f198930da4e43d2abf86177cb32ab13', 33, 'asdadassa', '', 'asdsad', '', '', '', '', '', '', 'root@aas.com', '', '2022-11-30 04:07:08'),
(0, 79, 'John', 'ea131682a48f9c291bf75b7b7a0b0bfc2f198930da4e43d2abf86177cb32ab13', 33, 'John', '', 'Backer', '', '', '', '', '', '', 'root@sada.cpm', '', '2022-11-30 04:07:08'),
(0, 80, 'Henessy', 'ea131682a48f9c291bf75b7b7a0b0bfc2f198930da4e43d2abf86177cb32ab13', 33, 'Henessy', '', 'Richards', '', '', '', '', '', '', 'Example@gmail.com', '', '2022-11-30 04:07:08'),
(0, 82, '2022e3b0c', '14f67e8ceebe362ee9e763ec953b89c965f32198e3e9cc82cd4a80eeae569e9a', 2, 'Rocker', '', 'Rakky', '', '1', '', '', '', '', 'root@asdsadsa.com', '', '2022-11-30 06:03:25'),
(0, 84, '2022a8cfc', '14f67e8ceebe362ee9e763ec953b89c965f32198e3e9cc82cd4a80eeae569e9a', 2, 'John', '', 'Doe', '', '1', '', '', '', '', 'americanCitizen@gmail.com', '', '2022-11-30 04:07:08'),
(0, 88, '202247300', '14f67e8ceebe362ee9e763ec953b89c965f32198e3e9cc82cd4a80eeae569e9a', 2, 'Rhodora', 'Lastimosa', 'Delacruz', '', '3', 'Buhay na bato', 'Purok2', 'Batangas', '09235382568', 'Rhodora@gmail.com', '', '2022-11-30 04:07:08'),
(0, 89, '23423523', '3fc4b9a4756d5ddf194a15658c27b3464a86a7071aa336bed022f0ca7e30c25f', 2, 'Random', 'haha', 'Daboi', '', '3', 'House', 'Brgy', 'City', '09235382568', 'zamnDawg@woof.com', '', '2022-11-30 06:03:23'),
(0, 90, '10201234', '4e4fb3d87c8fe6620b979a9dfc8ffa17833e6811b3cd3675c9e34f9803e5991b', 2, 'Dummy', 'Farce', 'McFake', '', '2', 'Pseudo Address', 'Artificia', 'Artificity', '09345678765', 'fake@mail.com', '', '2022-11-30 04:07:08'),
(0, 91, '69420', '441b7681786fefcf0b41c3952a0ffecb1221315407a031f61d145ae99dbe9bf7', 0, 'Howard', '', 'Wolowitz', '', '', 'Pasedina, California U.S.A', '', '', '09235322568', 'big@bang.theory', '', '2022-11-30 04:07:08'),
(0, 92, '202287255', '14c86030b44ca29d409a63a56e99e4fea35dc6c17413a2e584b2724cdb9e76f0', 11, 'Rajesh', '', 'Koothrapali', '', ' 5', '', '', '', '', 'bigbang@theory.show', '', '2022-11-30 04:07:08'),
(0, 93, '35612213', 'b236034e4cbc0b24b261852dde75412c6c1ef9fbde214c8b96b4e5a95044d9b2', 0, 'Sheldon', 'Bradey', 'Cooper', 'Jr', '', 'Pasedina, California U.S.A', '', '', '09876545678', 'big@bang.theor', '', '2022-11-30 05:35:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allowed_f`
--
ALTER TABLE `allowed_f`
  ADD PRIMARY KEY (`al_id`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`ann_id`);

--
-- Indexes for table `comment_type`
--
ALTER TABLE `comment_type`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `com_uid` (`com_uid`);

--
-- Indexes for table `course_list`
--
ALTER TABLE `course_list`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`day_id`);

--
-- Indexes for table `deliv_files`
--
ALTER TABLE `deliv_files`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `evaluation_sheet`
--
ALTER TABLE `evaluation_sheet`
  ADD PRIMARY KEY (`eval_id`);

--
-- Indexes for table `ipcrf`
--
ALTER TABLE `ipcrf`
  ADD PRIMARY KEY (`form_id`);

--
-- Indexes for table `ipcrf_ansf`
--
ALTER TABLE `ipcrf_ansf`
  ADD PRIMARY KEY (`fans_id`),
  ADD KEY `fans_fid` (`fans_fid`),
  ADD KEY `fans_appr_admin` (`fans_appr_admin`);

--
-- Indexes for table `ipcrf_ansm`
--
ALTER TABLE `ipcrf_ansm`
  ADD PRIMARY KEY (`mans_id`),
  ADD KEY `mans_fid` (`mans_fid`),
  ADD KEY `mans_meas` (`mans_meas`);

--
-- Indexes for table `ipcrf_anst`
--
ALTER TABLE `ipcrf_anst`
  ADD PRIMARY KEY (`ans_id`),
  ADD KEY `ans_fid` (`ans_fid`);

--
-- Indexes for table `ipcrf_category`
--
ALTER TABLE `ipcrf_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `ipcrf_legend`
--
ALTER TABLE `ipcrf_legend`
  ADD PRIMARY KEY (`leg_id`);

--
-- Indexes for table `ipcrf_measures`
--
ALTER TABLE `ipcrf_measures`
  ADD PRIMARY KEY (`meas_id`),
  ADD KEY `ipcrf_measures_ibfk_1` (`meas_sp`);

--
-- Indexes for table `ipcrf_metrics`
--
ALTER TABLE `ipcrf_metrics`
  ADD PRIMARY KEY (`met_id`);

--
-- Indexes for table `ipcrf_stratprio`
--
ALTER TABLE `ipcrf_stratprio`
  ADD PRIMARY KEY (`sp_id`),
  ADD KEY `ipcrf_stratprio_ibfk_1` (`sp_cat`);

--
-- Indexes for table `ipcrf_target`
--
ALTER TABLE `ipcrf_target`
  ADD PRIMARY KEY (`t_id`),
  ADD KEY `ipcrf_target_ibfk_1` (`t_meas`);

--
-- Indexes for table `ipcrf_valmap`
--
ALTER TABLE `ipcrf_valmap`
  ADD PRIMARY KEY (`map_id`),
  ADD KEY `ipcrf_valmap_ibfk_1` (`map_targ`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`q_id`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`result_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `school_year`
--
ALTER TABLE `school_year`
  ADD PRIMARY KEY (`sy_id`);

--
-- Indexes for table `student_list`
--
ALTER TABLE `student_list`
  ADD PRIMARY KEY (`list_id`);

--
-- Indexes for table `subject_list`
--
ALTER TABLE `subject_list`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `subject_schedule`
--
ALTER TABLE `subject_schedule`
  ADD PRIMARY KEY (`sched_id`);

--
-- Indexes for table `time_sched`
--
ALTER TABLE `time_sched`
  ADD PRIMARY KEY (`time_id`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allowed_f`
--
ALTER TABLE `allowed_f`
  MODIFY `al_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `ann_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `comment_type`
--
ALTER TABLE `comment_type`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `course_list`
--
ALTER TABLE `course_list`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `day_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `deliv_files`
--
ALTER TABLE `deliv_files`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `evaluation_sheet`
--
ALTER TABLE `evaluation_sheet`
  MODIFY `eval_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ipcrf_ansf`
--
ALTER TABLE `ipcrf_ansf`
  MODIFY `fans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ipcrf_ansm`
--
ALTER TABLE `ipcrf_ansm`
  MODIFY `mans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `ipcrf_anst`
--
ALTER TABLE `ipcrf_anst`
  MODIFY `ans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `ipcrf_category`
--
ALTER TABLE `ipcrf_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ipcrf_legend`
--
ALTER TABLE `ipcrf_legend`
  MODIFY `leg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ipcrf_measures`
--
ALTER TABLE `ipcrf_measures`
  MODIFY `meas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ipcrf_metrics`
--
ALTER TABLE `ipcrf_metrics`
  MODIFY `met_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ipcrf_stratprio`
--
ALTER TABLE `ipcrf_stratprio`
  MODIFY `sp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ipcrf_target`
--
ALTER TABLE `ipcrf_target`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `ipcrf_valmap`
--
ALTER TABLE `ipcrf_valmap`
  MODIFY `map_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=257;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `q_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `school_year`
--
ALTER TABLE `school_year`
  MODIFY `sy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `student_list`
--
ALTER TABLE `student_list`
  MODIFY `list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `subject_list`
--
ALTER TABLE `subject_list`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subject_schedule`
--
ALTER TABLE `subject_schedule`
  MODIFY `sched_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `time_sched`
--
ALTER TABLE `time_sched`
  MODIFY `time_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment_type`
--
ALTER TABLE `comment_type`
  ADD CONSTRAINT `comment_type_ibfk_1` FOREIGN KEY (`com_uid`) REFERENCES `user_account` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `ipcrf_ansf`
--
ALTER TABLE `ipcrf_ansf`
  ADD CONSTRAINT `ipcrf_ansf_ibfk_1` FOREIGN KEY (`fans_fid`) REFERENCES `user_account` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ipcrf_ansf_ibfk_2` FOREIGN KEY (`fans_appr_admin`) REFERENCES `user_account` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `ipcrf_anst`
--
ALTER TABLE `ipcrf_anst`
  ADD CONSTRAINT `ipcrf_anst_ibfk_1` FOREIGN KEY (`ans_fid`) REFERENCES `user_account` (`user_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
