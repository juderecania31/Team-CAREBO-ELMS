-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2024 at 11:11 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employee_leave`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblaccounts`
--

CREATE TABLE `tblaccounts` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `phone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblaccounts`
--

INSERT INTO `tblaccounts` (`id`, `first_name`, `last_name`, `email_id`, `password`, `role`, `gender`, `phone`) VALUES
(8, 'jude', 'recania', 'jude123@gmail.com', '$2y$10$DhFMnZkg1/toRBMIYXvaHu4pTVqOCCk/oWJTw1iaWgkDBKyxbC4ne', 1, 'Male', '09561595988');

-- --------------------------------------------------------

--
-- Table structure for table `tblattendance`
--

CREATE TABLE `tblattendance` (
  `id` int(11) NOT NULL,
  `email_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `attendance_time` time NOT NULL,
  `attendance_date` date NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `status` enum('In','Out') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblroles`
--

CREATE TABLE `tblroles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblroles`
--

INSERT INTO `tblroles` (`id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'Employee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblaccounts`
--
ALTER TABLE `tblaccounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_id` (`email_id`),
  ADD KEY `role` (`role`);

--
-- Indexes for table `tblattendance`
--
ALTER TABLE `tblattendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email_id` (`email_id`);

--
-- Indexes for table `tblroles`
--
ALTER TABLE `tblroles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblaccounts`
--
ALTER TABLE `tblaccounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblattendance`
--
ALTER TABLE `tblattendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblroles`
--
ALTER TABLE `tblroles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblaccounts`
--
ALTER TABLE `tblaccounts`
  ADD CONSTRAINT `tblaccounts_ibfk_1` FOREIGN KEY (`role`) REFERENCES `tblroles` (`id`);

--
-- Constraints for table `tblattendance`
--
ALTER TABLE `tblattendance`
  ADD CONSTRAINT `tblattendance_ibfk_1` FOREIGN KEY (`email_id`) REFERENCES `tblaccounts` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- Table for employees
CREATE TABLE tblemployees (
    emp_id INT AUTO_INCREMENT PRIMARY KEY,
    account_id INT NOT NULL,
    department VARCHAR(100) NOT NULL,
    hire_date DATE NOT NULL,
    FOREIGN KEY (account_id) REFERENCES tblaccounts(id)
);

-- Table for leave requests
CREATE TABLE tblleaves (
    leave_id INT AUTO_INCREMENT PRIMARY KEY,
    emp_id INT NOT NULL,
    leave_type VARCHAR(50) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    reason TEXT,
    status ENUM('Pending', 'Approved', 'Rejected') DEFAULT 'Pending',
    FOREIGN KEY (emp_id) REFERENCES tblemployees(emp_id)
);

-- Table for payroll records
CREATE TABLE tblpayroll (
    payroll_id INT AUTO_INCREMENT PRIMARY KEY,
    emp_id INT NOT NULL,
    basic_salary DECIMAL(10, 2) NOT NULL,
    deductions DECIMAL(10, 2) DEFAULT 0.00,
    bonuses DECIMAL(10, 2) DEFAULT 0.00,
    net_salary DECIMAL(10, 2) NOT NULL,
    payroll_date DATE NOT NULL,
    FOREIGN KEY (emp_id) REFERENCES tblemployees(emp_id)
);

-- Sample data for tblroles
INSERT INTO tblroles (role_name) VALUES
('Admin'),
('Employee');

-- Sample data for tblemployees
INSERT INTO tblemployees (account_id, department, hire_date) VALUES
(1, 'IT', '2023-01-15');

-- Sample data for tblleaves
INSERT INTO tblleaves (emp_id, leave_type, start_date, end_date, reason, status) VALUES
(1, 'Sick Leave', '2023-12-01', '2023-12-05', 'Medical reasons', 'Approved');

-- Sample data for tblpayroll
INSERT INTO tblpayroll (emp_id, basic_salary, deductions, bonuses, net_salary, payroll_date) VALUES
(1, 30000.00, 2000.00, 5000.00, 33000.00, '2023-12-05');
