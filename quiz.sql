-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2020 at 02:48 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `attempt`
--

CREATE TABLE `attempt` (
  `attemptid` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `quizid` varchar(100) NOT NULL,
  `correct` int(11) NOT NULL,
  `wrong` int(11) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attempt`
--

INSERT INTO `attempt` (`attemptid`, `email`, `quizid`, `correct`, `wrong`, `score`) VALUES
('5fd60eaa44aa2', 'ak@gmail.com', '5fd5fdf8d3001', 2, 0, 10);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `quizid` text NOT NULL,
  `questionid` text NOT NULL,
  `srn` int(11) NOT NULL,
  `questiontext` text NOT NULL,
  `choices` int(10) NOT NULL,
  `optiona` varchar(200) NOT NULL,
  `optionb` varchar(200) NOT NULL,
  `optionc` varchar(200) NOT NULL,
  `optiond` varchar(200) NOT NULL,
  `solution` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`quizid`, `questionid`, `srn`, `questiontext`, `choices`, `optiona`, `optionb`, `optionc`, `optiond`, `solution`) VALUES
('5b13ed30cd71f', '5b13ed3a6e006', 0, 'dbjb', 4, '', '', '', '', '1'),
('5b13ed6bb8bcd', '5b13ed72489d8', 0, 'dvsd', 4, '', '', '', '', '1'),
('5b141b8009cf0', '5b141d712647f', 0, 'What does PHP stand for?', 4, '', '', '', '', '1'),
('5b141b8009cf0', '5b141d718f873', 0, 'Who is the father of PHP?', 4, '', '', '', '', '2'),
('5b141b8009cf0', '5b141d71ddb46', 0, 'PHP files have a default file extension of.', 4, '', '', '', '', '3'),
('5b141b8009cf0', '5b141d721a738', 0, 'Which of the looping statements is/are supported by PHP?', 4, '', '', '', '', '4'),
('5b141b8009cf0', '5b141d7260b7d', 0, 'Which of the following PHP statements will output Hello World on the screen?', 4, '', '', '', '', '5'),
('5b141b8009cf0', '5b141d72a6fa1', 0, 'Which one of the following function is capable of reading a file into an array?', 4, '', '', '', '', '6'),
('5b141b8009cf0', '5b141d72d7a1c', 0, 'A function in PHP which starts with __ (double underscore) is know as..', 4, '', '', '', '', '7'),
('5b141b8009cf0', '5b141d731429b', 0, 'Which one of the following statements is used to create a table?', 4, '', '', '', '', '8'),
('5b141b8009cf0', '5b141d7345176', 0, 'Which of the methods are used to manage result sets using both associative and indexed arrays?', 4, '', '', '', '', '9'),
('5b141b8009cf0', '5b141d737ddfc', 0, 'Which one of the following functions can be used to concatenate array elements to form a single delimited string?', 4, '', '', '', '', '10'),
('5b141f1e8399e', '5b1422651fdde', 0, 'How long is an IPv6 address?', 4, '', '', '', '', '1'),
('5b141f1e8399e', '5b14226574ed5', 0, 'Which protocol does DHCP use at the Transport layer?', 4, '', '', '', '', '2'),
('5b141f1e8399e', '5b142265b5d08', 0, 'Where is a hub specified in the OSI model?', 4, '', '', '', '', '3'),
('5b141f1e8399e', '5b1422661d93f', 0, 'Which of the following is private IP address?', 4, '', '', '', '', '4'),
('5b141f1e8399e', '5b14226663cf4', 0, 'If you use either Telnet or FTP, which is the highest layer you are using to transmit data?', 4, '', '', '', '', '5'),
('5b141f1e8399e', '5b1422669481b', 0, 'Which of the following is a layer 2 protocol used to maintain a loop-free network?', 4, '', '', '', '', '6'),
('5b141f1e8399e', '5b142266c525c', 0, 'What is the maximum number of IP addresses that can be assigned to hosts on a local subnet that uses the 255.255.255.224 subnet mask?', 4, '', '', '', '', '7'),
('5b141f1e8399e', '5b14226711d91', 0, 'You need to subnet a network that has 5 subnets, each with at least 16 hosts. Which classful subnet mask would you use?', 4, '', '', '', '', '8'),
('5b141f1e8399e', '5b1422674286d', 0, 'You have an interface on a router with the IP address of 192.168.192.10/29. Including the router interface, how many hosts can have IP addresses on the LAN attached to the router interface?', 4, '', '', '', '', '9'),
('5b141f1e8399e', '5b1422677371f', 0, 'To test the IP stack on your local host, which IP address would you ping?\r\n\r\n', 4, '', '', '', '', '10'),
('5fd5fdf8d3001', '5fd5fe22a3cb2', 1, 'Is SQL good?', 4, 'Yes', 'No', 'Both', 'Can not say', 'Yes'),
('5fd5fdf8d3001', '5fd5fe22aa782', 2, 'Is PHP good?', 4, 'Yes', 'No', 'Both', 'Can not say', 'No'),
('5fd617854a62f', '5fd61b1a78a3c', 1, 'What does SQL stand for?\r\n\r\n', 4, 'Strong Question Language', 'Structured Query Language', 'Structured Question Language', 'Strong Question Language', 'Structured Query Language'),
('5fd617854a62f', '5fd61b1a84cc9', 2, 'Which SQL statement is used to extract data from database?', 4, 'GET', 'EXTRACT', 'OPEN', 'SELECT', 'SELECT'),
('5fd617854a62f', '5fd61b1a8f4a2', 3, 'Which SQL statement is used to update data in a database;', 4, 'UPDATE', 'SAVE AS', 'SAVE', 'MODIFY', 'UPDATE'),
('5fd617854a62f', '5fd61b1a99109', 4, 'Which SQL statement is used to delete data from a database?\r\n\r\n', 4, 'COLLAPSE', 'DELETE', 'REMOVE', 'DISCARD', 'DELETE'),
('5fd617854a62f', '5fd61b1aa12bc', 5, 'Which SQL statement is used to insert new data in a database?\r\n\r\n', 4, 'INSERT INTO', 'INSERT NEW', 'ADD RECORD', 'ADD NEW', 'INSERT INTO'),
('5fd617854a62f', '5fd61b1ab9ba6', 6, 'With SQL, how do you select a column named \"FirstName\" from a table named \"Persons\"?', 4, 'EXTRACT FirstName FROM Persons', 'SELECT Persons.FirstName', 'SELECT FirstName FROM Persons', 'EXTRACT Persons.FirstName', 'SELECT FirstName FROM Persons'),
('5fd617854a62f', '5fd61b1abdc7f', 7, 'With SQL, how do you select all the columns from a table named \"Persons\"?\r\n\r\n', 4, 'SELECT * FROM Persons', 'SELECT * .Persons', 'SELECT Persons', 'SELECT [all] FROM Persons', 'SELECT * FROM Persons');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `quizid` text NOT NULL,
  `title` varchar(100) NOT NULL,
  `pluspoints` int(11) NOT NULL,
  `minuspoints` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`quizid`, `title`, `pluspoints`, `minuspoints`, `total`, `date`) VALUES
('5b141b8009cf0', 'Php & Mysqli', 3, 1, 10, '2018-06-03 16:46:56'),
('5b141f1e8399e', 'Ip Networking', 3, 1, 10, '2018-06-03 17:02:22'),
('5fd5fdf8d3001', 'Quiz 2', 5, 2, 2, '2020-12-13 11:41:44'),
('5fd617854a62f', 'Sql Quiz', 3, 1, 10, '2020-12-13 13:30:45');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `isadmin` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`name`, `email`, `password`, `isadmin`) VALUES
('Admin', 'admin@gmail.com', 'toor', 1),
('Ashvin Kasture', 'ak@gmail.com', 'passwd', 0),
('Swagatika Padhi', 'pinky@gmail.com', 'pinky', 0),
('Priyanka Pattnaik', 'priyanka@gmail.com', 'pinka', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
