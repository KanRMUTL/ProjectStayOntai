-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 25, 2019 at 05:02 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `ontaistayproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_visitplacepic`
--

CREATE TABLE `tb_visitplacepic` (
`visitplacepic_id` int(11) NOT NULL,
`visitplace_id` int(11) NOT NULL,
`visitplacepic_img` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_visitplacepic`
--

INSERT INTO `tb_visitplacepic` (`visitplacepic_id`, `visitplace_id`, `visitplacepic_img`) VALUES
(1, 1, '0maintenance_20191215195640.jpg'),
(2, 1, '1maintenance_20191215195640.jpg'),
(3, 1, '2maintenance_20191215195640.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_visitplacepic`
--
ALTER TABLE `tb_visitplacepic`
ADD PRIMARY KEY (`visitplacepic_id`) USING BTREE,
ADD KEY `fk_tb_visitplacepic_tb_visitplace1_idx` (`visitplace_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_visitplacepic`
--
ALTER TABLE `tb_visitplacepic`
MODIFY `visitplacepic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;
