-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2022 at 10:56 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `allohms`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountant`
--

CREATE TABLE `accountant` (
  `id` int(100) NOT NULL,
  `img_url` varchar(200) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `x` varchar(100) DEFAULT NULL,
  `ion_user_id` varchar(100) DEFAULT NULL,
  `serial_id` varchar(10) NOT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accountant`
--

INSERT INTO `accountant` (`id`, `img_url`, `name`, `email`, `address`, `phone`, `x`, `ion_user_id`, `serial_id`, `hospital_id`) VALUES
(84, NULL, 'Mr Accountant', 'accountant@allohms.com', 'TPK Road, Madurai', '9791839199', NULL, '787', 'AD1787', '466'),
(85, NULL, 'xyz n', 'jioviohealthcare@gmail.com', 'India', '9791839199', NULL, '798', 'AD1798', '466'),
(86, NULL, 'Account Sathya', 'accountsathya@allohms.com', 'TPK', '9876754321', NULL, '802', '', '478'),
(87, NULL, 'new acc', 'acc@allohms.com', 'TPK', '8765434567', NULL, '803', '', '477');

-- --------------------------------------------------------

--
-- Table structure for table `alloted_bed`
--

CREATE TABLE `alloted_bed` (
  `id` int(100) NOT NULL,
  `number` varchar(100) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `patient` varchar(100) DEFAULT NULL,
  `a_time` varchar(100) DEFAULT NULL,
  `d_time` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `x` varchar(100) DEFAULT NULL,
  `bed_id` varchar(100) DEFAULT NULL,
  `patientname` varchar(1000) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `alloted_bed`
--

INSERT INTO `alloted_bed` (`id`, `number`, `category`, `patient`, `a_time`, `d_time`, `status`, `x`, `bed_id`, `patientname`, `hospital_id`) VALUES
(48, NULL, NULL, '69', '07 November 2021 - 01:55 PM', '09 November 2021 - 01:55 PM', NULL, NULL, 'Basic-Bed-103', 'Sathya', '466');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(100) NOT NULL,
  `patient` varchar(100) DEFAULT NULL,
  `doctor` varchar(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `time_slot` varchar(100) DEFAULT NULL,
  `s_time` varchar(100) DEFAULT NULL,
  `e_time` varchar(100) DEFAULT NULL,
  `remarks` varchar(500) DEFAULT NULL,
  `add_date` varchar(100) DEFAULT NULL,
  `registration_time` varchar(100) DEFAULT NULL,
  `s_time_key` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `request` varchar(100) DEFAULT NULL,
  `patientname` varchar(1000) DEFAULT NULL,
  `doctorname` varchar(1000) DEFAULT NULL,
  `room_id` varchar(500) DEFAULT NULL,
  `live_meeting_link` varchar(1000) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL,
  `live` int(2) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `patient`, `doctor`, `date`, `time_slot`, `s_time`, `e_time`, `remarks`, `add_date`, `registration_time`, `s_time_key`, `status`, `user`, `request`, `patientname`, `doctorname`, `room_id`, `live_meeting_link`, `hospital_id`, `live`) VALUES
(1, '62', '162', '1646607600', '05:15 PM To 05:30 PM', '05:15 PM', '05:30 PM', 'Live', '03/07/22', '1646645005', '207', 'Confirmed', '765', '', 'Mr Patient', 'Dr. Rose', 'hms-meeting-9524835677-718114-466', 'https://meet.jit.si/hms-meeting-9524835677-718114-466', '466', 0),
(2, '62', '162', '1646607600', '05:30 PM To 05:45 PM', '05:30 PM', '05:45 PM', '', '03/07/22', '1646645516', '210', 'Confirmed', '765', '', 'Mr Patient', 'Dr. Rose', 'hms-meeting-9524835677-878849-466', 'https://meet.jit.si/hms-meeting-9524835677-878849-466', '466', 0),
(3, '62', '162', '1646607600', '06:15 PM To 06:30 PM', '06:15 PM', '06:30 PM', 'Live', '03/07/22', '1646647346', '219', 'Confirmed', '765', '', 'Mr Patient', 'Dr. Rose', 'hms-meeting-9524835677-764962-466', 'https://meet.jit.si/hms-meeting-9524835677-764962-466', '466', 1),
(4, '62', '162', '1646607600', '05:45 PM To 06:00 PM', '05:45 PM', '06:00 PM', 'Live Test', '03/07/22', '1646652440', '213', 'Confirmed', '790', '', 'Mr Patient', 'Dr. Rose', 'hms-meeting-9524835677-732118-466', 'https://meet.jit.si/hms-meeting-9524835677-732118-466', '466', 1),
(5, '62', '162', '1646694000', '05:15 PM To 05:30 PM', '05:15 PM', '05:30 PM', '', '03/08/22', '1646731882', '207', 'Confirmed', '763', '', 'Mr Patient', 'Dr. Rose', 'hms-meeting-9524835677-264117-466', 'https://meet.jit.si/hms-meeting-9524835677-264117-466', '466', 0),
(6, '70', '162', '1646694000', '05:30 PM To 05:45 PM', '05:30 PM', '05:45 PM', '', '03/08/22', '1646731923', '210', 'Pending Confirmation', '763', '', 'Test', 'Dr. Rose', 'hms-meeting-7667878400-162880-466', 'https://meet.jit.si/hms-meeting-7667878400-162880-466', '466', 0),
(7, '70', '162', '1646694000', '05:45 PM To 06:00 PM', '05:45 PM', '06:00 PM', '', '03/08/22', '1646731968', '213', 'Pending Confirmation', '763', '', 'Test', 'Dr. Rose', 'hms-meeting-7667878400-717475-466', 'https://meet.jit.si/hms-meeting-7667878400-717475-466', '466', 0),
(8, '70', '162', '1646694000', '05:45 PM To 06:00 PM', '05:45 PM', '06:00 PM', '', '03/08/22', '1646731971', '213', 'Pending Confirmation', '763', '', 'Test', 'Dr. Rose', 'hms-meeting-7667878400-513192-466', 'https://meet.jit.si/hms-meeting-7667878400-513192-466', '466', 0),
(9, '62', '168', '1646694000', 'Not Selected', 'Not Selected', '', '', '03/08/22', '1646731990', '0', 'Pending Confirmation', '763', '', 'Mr Patient', 'Dr. Priyan', 'hms-meeting-9524835677-685413-466', 'https://meet.jit.si/hms-meeting-9524835677-685413-466', '466', 0),
(10, '62', '168', '1646694000', 'Not Selected', 'Not Selected', '', '', '03/08/22', '1646731994', '0', 'Pending Confirmation', '763', '', 'Mr Patient', 'Dr. Priyan', 'hms-meeting-9524835677-294405-466', 'https://meet.jit.si/hms-meeting-9524835677-294405-466', '466', 0),
(11, '70', '162', '1646694000', '06:00 PM To 06:15 PM', '06:00 PM', '06:15 PM', '', '03/08/22', '1646732021', '216', 'Pending Confirmation', '763', '', 'Test', 'Dr. Rose', 'hms-meeting-7667878400-241908-466', 'https://meet.jit.si/hms-meeting-7667878400-241908-466', '466', 0);

-- --------------------------------------------------------

--
-- Table structure for table `autoemailshortcode`
--

CREATE TABLE `autoemailshortcode` (
  `id` int(100) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `type` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `autoemailshortcode`
--

INSERT INTO `autoemailshortcode` (`id`, `name`, `type`) VALUES
(1, '{firstname}', 'payment'),
(2, '{lastname}', 'payment'),
(3, '{name}', 'payment'),
(4, '{amount}', 'payment'),
(52, '{doctorname}', 'appoinment_confirmation'),
(42, '{firstname}', 'appoinment_creation'),
(51, '{name}', 'appoinment_confirmation'),
(50, '{lastname}', 'appoinment_confirmation'),
(49, '{firstname}', 'appoinment_confirmation'),
(48, '{hospital_name}', 'appoinment_creation'),
(47, '{time_slot}', 'appoinment_creation'),
(46, '{appoinmentdate}', 'appoinment_creation'),
(45, '{doctorname}', 'appoinment_creation'),
(44, '{name}', 'appoinment_creation'),
(43, '{lastname}', 'appoinment_creation'),
(26, '{name}', 'doctor'),
(27, '{firstname}', 'doctor'),
(28, '{lastname}', 'doctor'),
(29, '{company}', 'doctor'),
(41, '{doctor}', 'patient'),
(40, '{company}', 'patient'),
(39, '{lastname}', 'patient'),
(38, '{firstname}', 'patient'),
(37, '{name}', 'patient'),
(36, '{department}', 'doctor'),
(53, '{appoinmentdate}', 'appoinment_confirmation'),
(54, '{time_slot}', 'appoinment_confirmation'),
(55, '{hospital_name}', 'appoinment_confirmation'),
(56, '{start_time}', 'meeting_creation'),
(57, '{patient_name}', 'meeting_creation'),
(58, '{doctor_name}', 'meeting_creation'),
(59, '{hospital_name}', 'meeting_creation');

-- --------------------------------------------------------

--
-- Table structure for table `autoemailtemplate`
--

CREATE TABLE `autoemailtemplate` (
  `id` int(100) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL,
  `type` varchar(1000) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `autoemailtemplate`
--

INSERT INTO `autoemailtemplate` (`id`, `name`, `message`, `type`, `status`, `hospital_id`) VALUES
(59, 'Patient Registration Confirmation', 'Dear {name}, You are registred to {company} as a patient to {doctor}. Regards', 'patient', 'Active', '466'),
(58, 'Send Appointment confirmation to Doctor', 'Dear {name}, You are appointed as a doctor in {department} . Thank You {company}', 'doctor', 'Active', '466'),
(57, 'Meeting Schedule Notification To Patient', 'Dear {patient_name}, You have a Live Video Meeting with {doctor_name} on {start_time}. For more information contact with {hospital_name} . Regards', 'meeting_creation', 'Active', '466'),
(56, 'Appointment creation email to patient', 'Dear {name}, You have an appointment with {doctorname} on {appoinmentdate} at {time_slot} .Please confirm your appointment. For more information contact with {hospital_name} Regards', 'appoinment_creation', 'Active', '466'),
(55, 'Appointment Confirmation email to patient', 'Dear {name}, Your appointment with {doctorname} on {appoinmentdate} at {time_slot} is confirmed. For more information contact with {hospital_name} Regards', 'appoinment_confirmation', 'Active', '466'),
(54, 'Payment successful email to patient', 'Dear {name}, Your paying amount - Tk {amount} was successful. Thank You Please contact our support for further queries.', 'payment', 'Active', '466'),
(102, 'Payment successful email to patient', 'Dear {name}, Your paying amount - Tk {amount} was successful. Thank You Please contact our support for further queries.', 'payment', 'Active', '477'),
(103, 'Appointment Confirmation email to patient', 'Dear {name}, Your appointment with {doctorname} on {appoinmentdate} at {time_slot} is confirmed. For more information contact with {hospital_name} Regards', 'appoinment_confirmation', 'Active', '477'),
(104, 'Appointment creation email to patient', 'Dear {name}, You have an appointment with {doctorname} on {appoinmentdate} at {time_slot} .Please confirm your appointment. For more information contact with {hospital_name} Regards', 'appoinment_creation', 'Active', '477'),
(105, 'Meeting Schedule Notification To Patient', 'Dear {patient_name}, You have a Live Video Meeting with {doctor_name} on {start_time}. For more information contact with {hospital_name} . Regards', 'meeting_creation', 'Active', '477'),
(106, 'Send Appointment confirmation to Doctor', 'Dear {name}, You are appointed as a doctor in {department} . Thank You {company}', 'doctor', 'Active', '477'),
(107, 'Patient Registration Confirmation', 'Dear {name}, You are registred to {company} as a patient to {doctor}. Regards', 'patient', 'Active', '477'),
(108, 'Payment successful email to patient', 'Dear {name}, Your paying amount - Tk {amount} was successful. Thank You Please contact our support for further queries.', 'payment', 'Active', '478'),
(109, 'Appointment Confirmation email to patient', 'Dear {name}, Your appointment with {doctorname} on {appoinmentdate} at {time_slot} is confirmed. For more information contact with {hospital_name} Regards', 'appoinment_confirmation', 'Active', '478'),
(110, 'Appointment creation email to patient', 'Dear {name}, You have an appointment with {doctorname} on {appoinmentdate} at {time_slot} .Please confirm your appointment. For more information contact with {hospital_name} Regards', 'appoinment_creation', 'Active', '478'),
(111, 'Meeting Schedule Notification To Patient', 'Dear {patient_name}, You have a Live Video Meeting with {doctor_name} on {start_time}. For more information contact with {hospital_name} . Regards', 'meeting_creation', 'Active', '478'),
(112, 'Send Appointment confirmation to Doctor', 'Dear {name}, You are appointed as a doctor in {department} . Thank You {company}', 'doctor', 'Active', '478'),
(113, 'Patient Registration Confirmation', 'Dear {name}, You are registred to {company} as a patient to {doctor}. Regards', 'patient', 'Active', '478'),
(114, 'Payment successful email to patient', 'Dear {name}, Your paying amount - Tk {amount} was successful. Thank You Please contact our support for further queries.', 'payment', 'Active', '479'),
(115, 'Appointment Confirmation email to patient', 'Dear {name}, Your appointment with {doctorname} on {appoinmentdate} at {time_slot} is confirmed. For more information contact with {hospital_name} Regards', 'appoinment_confirmation', 'Active', '479'),
(116, 'Appointment creation email to patient', 'Dear {name}, You have an appointment with {doctorname} on {appoinmentdate} at {time_slot} .Please confirm your appointment. For more information contact with {hospital_name} Regards', 'appoinment_creation', 'Active', '479'),
(117, 'Meeting Schedule Notification To Patient', 'Dear {patient_name}, You have a Live Video Meeting with {doctor_name} on {start_time}. For more information contact with {hospital_name} . Regards', 'meeting_creation', 'Active', '479'),
(118, 'Send Appointment confirmation to Doctor', 'Dear {name}, You are appointed as a doctor in {department} . Thank You {company}', 'doctor', 'Active', '479'),
(119, 'Patient Registration Confirmation', 'Dear {name}, You are registred to {company} as a patient to {doctor}. Regards', 'patient', 'Active', '479'),
(120, 'Payment successful email to patient', 'Dear {name}, Your paying amount - Tk {amount} was successful. Thank You Please contact our support for further queries.', 'payment', 'Active', '480'),
(121, 'Appointment Confirmation email to patient', 'Dear {name}, Your appointment with {doctorname} on {appoinmentdate} at {time_slot} is confirmed. For more information contact with {hospital_name} Regards', 'appoinment_confirmation', 'Active', '480'),
(122, 'Appointment creation email to patient', 'Dear {name}, You have an appointment with {doctorname} on {appoinmentdate} at {time_slot} .Please confirm your appointment. For more information contact with {hospital_name} Regards', 'appoinment_creation', 'Active', '480'),
(123, 'Meeting Schedule Notification To Patient', 'Dear {patient_name}, You have a Live Video Meeting with {doctor_name} on {start_time}. For more information contact with {hospital_name} . Regards', 'meeting_creation', 'Active', '480'),
(124, 'Send Appointment confirmation to Doctor', 'Dear {name}, You are appointed as a doctor in {department} . Thank You {company}', 'doctor', 'Active', '480'),
(125, 'Patient Registration Confirmation', 'Dear {name}, You are registred to {company} as a patient to {doctor}. Regards', 'patient', 'Active', '480');

-- --------------------------------------------------------

--
-- Table structure for table `autosmsshortcode`
--

CREATE TABLE `autosmsshortcode` (
  `id` int(100) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `type` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `autosmsshortcode`
--

INSERT INTO `autosmsshortcode` (`id`, `name`, `type`) VALUES
(1, '{name}', 'payment'),
(2, '{firstname}', 'payment'),
(3, '{lastname}', 'payment'),
(4, '{amount}', 'payment'),
(55, '{appoinmentdate}', 'appoinment_confirmation'),
(54, '{doctorname}', 'appoinment_confirmation'),
(53, '{name}', 'appoinment_confirmation'),
(52, '{lastname}', 'appoinment_confirmation'),
(51, '{firstname}', 'appoinment_confirmation'),
(50, '{time_slot}', 'appoinment_creation'),
(49, '{appoinmentdate}', 'appoinment_creation'),
(48, '{hospital_name}', 'appoinment_creation'),
(47, '{doctorname}', 'appoinment_creation'),
(46, '{name}', 'appoinment_creation'),
(45, '{lastname}', 'appoinment_creation'),
(44, '{firstname}', 'appoinment_creation'),
(28, '{firstname}', 'doctor'),
(29, '{lastname}', 'doctor'),
(30, '{name}', 'doctor'),
(31, '{company}', 'doctor'),
(43, '{doctor}', 'patient'),
(42, '{company}', 'patient'),
(41, '{lastname}', 'patient'),
(40, '{firstname}', 'patient'),
(39, '{name}', 'patient'),
(38, '{department}', 'doctor'),
(56, '{time_slot}', 'appoinment_confirmation'),
(57, '{hospital_name}', 'appoinment_confirmation'),
(58, '{start_time}', 'meeting_creation'),
(59, '{patient_name}', 'meeting_creation'),
(60, '{doctor_name}', 'meeting_creation'),
(61, '{hospital_name}', 'meeting_creation'),
(62, '{meeting_link}', 'meeting_creation');

-- --------------------------------------------------------

--
-- Table structure for table `autosmstemplate`
--

CREATE TABLE `autosmstemplate` (
  `id` int(100) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL,
  `type` varchar(1000) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `autosmstemplate`
--

INSERT INTO `autosmstemplate` (`id`, `name`, `message`, `type`, `status`, `hospital_id`) VALUES
(69, 'Patient Registration Confirmation', 'Dear {name}, You are registred to {company} as a patient to {doctor}. Regards', 'patient', 'Active', '466'),
(68, 'send appoint confirmation to Doctor', 'Dear {name}, You are appointed as a doctor in {department} . Thank You {company}', 'doctor', 'Active', '466'),
(67, 'Meeting Schedule Notification To Patient', 'Dear {patient_name}, You have a Live Video Consulting with {doctor_name}. Please click on the link to join {meeting_link}. For more information contact with {hospital_name}. Regards', 'meeting_creation', 'Active', '466'),
(66, 'Appointment creation sms to patient', 'Dear {name}, You have an appointment with {doctorname} on {appoinmentdate} at {time_slot} .Please confirm your appointment. For more information contact with {hospital_name} Regards', 'appoinment_creation', 'Active', '466'),
(65, 'Appointment Confirmation sms to patient', 'Dear {name}, Your appointment with {doctorname} on {appoinmentdate} at {time_slot} is confirmed. For more information contact with {hospital_name} Regards', 'appoinment_confirmation', 'Active', '466'),
(64, 'Payment successful sms to patient', 'Dear {name}, Your paying amount - Tk {amount} was successful. Thank You Please contact our support for further queries.', 'payment', 'Active', '466'),
(112, 'Payment successful sms to patient', 'Dear {name}, Your paying amount - Tk {amount} was successful. Thank You Please contact our support for further queries.', 'payment', 'Active', '477'),
(113, 'Appointment Confirmation sms to patient', 'Dear {name}, Your appointment with {doctorname} on {appoinmentdate} at {time_slot} is confirmed. For more information contact with {hospital_name} Regards', 'appoinment_confirmation', 'Active', '477'),
(114, 'Appointment creation sms to patient', 'Dear {name}, You have an appointment with {doctorname} on {appoinmentdate} at {time_slot} .Please confirm your appointment. For more information contact with {hospital_name} Regards', 'appoinment_creation', 'Active', '477'),
(115, 'Meeting Schedule Notification To Patient', 'Dear {patient_name}, You have a Live Video Consulting with {doctor_name}. Please click on the link to join {meeting_link}. For more information contact with {hospital_name}. Regards', 'meeting_creation', 'Active', '477'),
(116, 'send appoint confirmation to Doctor', 'Dear {name}, You are appointed as a doctor in {department} . Thank You {company}', 'doctor', 'Active', '477'),
(117, 'Patient Registration Confirmation', 'Dear {name}, You are registred to {company} as a patient to {doctor}. Regards', 'patient', 'Active', '477'),
(118, 'Payment successful sms to patient', 'Dear {name}, Your paying amount - Tk {amount} was successful. Thank You Please contact our support for further queries.', 'payment', 'Active', '478'),
(119, 'Appointment Confirmation sms to patient', 'Dear {name}, Your appointment with {doctorname} on {appoinmentdate} at {time_slot} is confirmed. For more information contact with {hospital_name} Regards', 'appoinment_confirmation', 'Active', '478'),
(120, 'Appointment creation sms to patient', 'Dear {name}, You have an appointment with {doctorname} on {appoinmentdate} at {time_slot} .Please confirm your appointment. For more information contact with {hospital_name} Regards', 'appoinment_creation', 'Active', '478'),
(121, 'Meeting Schedule Notification To Patient', 'Dear {patient_name}, You have a Live Video Consulting with {doctor_name}. Please click on the link to join {meeting_link}. For more information contact with {hospital_name}. Regards', 'meeting_creation', 'Active', '478'),
(122, 'send appoint confirmation to Doctor', 'Dear {name}, You are appointed as a doctor in {department} . Thank You {company}', 'doctor', 'Active', '478'),
(123, 'Patient Registration Confirmation', 'Dear {name}, You are registred to {company} as a patient to {doctor}. Regards', 'patient', 'Active', '478'),
(124, 'Payment successful sms to patient', 'Dear {name}, Your paying amount - Tk {amount} was successful. Thank You Please contact our support for further queries.', 'payment', 'Active', '479'),
(125, 'Appointment Confirmation sms to patient', 'Dear {name}, Your appointment with {doctorname} on {appoinmentdate} at {time_slot} is confirmed. For more information contact with {hospital_name} Regards', 'appoinment_confirmation', 'Active', '479'),
(126, 'Appointment creation sms to patient', 'Dear {name}, You have an appointment with {doctorname} on {appoinmentdate} at {time_slot} .Please confirm your appointment. For more information contact with {hospital_name} Regards', 'appoinment_creation', 'Active', '479'),
(127, 'Meeting Schedule Notification To Patient', 'Dear {patient_name}, You have a Live Video Consulting with {doctor_name}. Please click on the link to join {meeting_link}. For more information contact with {hospital_name}. Regards', 'meeting_creation', 'Active', '479'),
(128, 'send appoint confirmation to Doctor', 'Dear {name}, You are appointed as a doctor in {department} . Thank You {company}', 'doctor', 'Active', '479'),
(129, 'Patient Registration Confirmation', 'Dear {name}, You are registred to {company} as a patient to {doctor}. Regards', 'patient', 'Active', '479'),
(130, 'Payment successful sms to patient', 'Dear {name}, Your paying amount - Tk {amount} was successful. Thank You Please contact our support for further queries.', 'payment', 'Active', '480'),
(131, 'Appointment Confirmation sms to patient', 'Dear {name}, Your appointment with {doctorname} on {appoinmentdate} at {time_slot} is confirmed. For more information contact with {hospital_name} Regards', 'appoinment_confirmation', 'Active', '480'),
(132, 'Appointment creation sms to patient', 'Dear {name}, You have an appointment with {doctorname} on {appoinmentdate} at {time_slot} .Please confirm your appointment. For more information contact with {hospital_name} Regards', 'appoinment_creation', 'Active', '480'),
(133, 'Meeting Schedule Notification To Patient', 'Dear {patient_name}, You have a Live Video Meeting with {doctor_name} on {start_time}. For more information contact with {hospital_name} . Regards', 'meeting_creation', 'Active', '480'),
(134, 'send appoint confirmation to Doctor', 'Dear {name}, You are appointed as a doctor in {department} . Thank You {company}', 'doctor', 'Active', '480'),
(135, 'Patient Registration Confirmation', 'Dear {name}, You are registred to {company} as a patient to {doctor}. Regards', 'patient', 'Active', '480');

-- --------------------------------------------------------

--
-- Table structure for table `bankb`
--

CREATE TABLE `bankb` (
  `id` int(100) NOT NULL,
  `group` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bankb`
--

INSERT INTO `bankb` (`id`, `group`, `status`, `hospital_id`) VALUES
(72, 'O-', '0 Bags', '466'),
(71, 'O+', '0 Bags', '466'),
(70, 'AB-', '0 Bags', '466'),
(69, 'AB+', '0 Bags', '466'),
(68, 'B-', '0 Bags', '466'),
(67, 'B+', '0 Bags', '466'),
(66, 'A-', '0 Bags', '466'),
(65, 'A+', '0 Bags', '466'),
(153, 'A+', '0 Bags', '477'),
(154, 'A-', '0 Bags', '477'),
(155, 'B+', '0 Bags', '477'),
(156, 'B-', '0 Bags', '477'),
(157, 'AB+', '0 Bags', '477'),
(158, 'AB-', '0 Bags', '477'),
(159, 'O+', '0 Bags', '477'),
(160, 'O-', '0 Bags', '477'),
(161, 'A+', '0 Bags', '478'),
(162, 'A-', '0 Bags', '478'),
(163, 'B+', '0 Bags', '478'),
(164, 'B-', '0 Bags', '478'),
(165, 'AB+', '0 Bags', '478'),
(166, 'AB-', '0 Bags', '478'),
(167, 'O+', '0 Bags', '478'),
(168, 'O-', '0 Bags', '478'),
(169, 'A+', '0 Bags', '479'),
(170, 'A-', '0 Bags', '479'),
(171, 'B+', '0 Bags', '479'),
(172, 'B-', '0 Bags', '479'),
(173, 'AB+', '0 Bags', '479'),
(174, 'AB-', '0 Bags', '479'),
(175, 'O+', '0 Bags', '479'),
(176, 'O-', '0 Bags', '479'),
(177, 'A+', '0 Bags', '480'),
(178, 'A-', '0 Bags', '480'),
(179, 'B+', '0 Bags', '480'),
(180, 'B-', '0 Bags', '480'),
(181, 'AB+', '0 Bags', '480'),
(182, 'AB-', '0 Bags', '480'),
(183, 'O+', '0 Bags', '480'),
(184, 'O-', '0 Bags', '480');

-- --------------------------------------------------------

--
-- Table structure for table `bed`
--

CREATE TABLE `bed` (
  `id` int(10) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `number` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `last_a_time` varchar(100) DEFAULT NULL,
  `last_d_time` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `bed_id` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bed`
--

INSERT INTO `bed` (`id`, `category`, `number`, `description`, `last_a_time`, `last_d_time`, `status`, `bed_id`, `hospital_id`) VALUES
(22, 'Basic', 'Bed-103', 'Basic', '07 November 2021 - 01:55 PM', '09 November 2021 - 01:55 PM', NULL, 'Basic-Bed-103', '466');

-- --------------------------------------------------------

--
-- Table structure for table `bed_category`
--

CREATE TABLE `bed_category` (
  `id` int(100) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bed_category`
--

INSERT INTO `bed_category` (`id`, `category`, `description`, `hospital_id`) VALUES
(15, 'Basic', 'basic', '466');

-- --------------------------------------------------------

--
-- Table structure for table `camp`
--

CREATE TABLE `camp` (
  `id` int(11) NOT NULL,
  `camp_name` varchar(150) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(10) NOT NULL,
  `camp_date` date NOT NULL DEFAULT current_timestamp(),
  `img_url` varchar(150) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `camp`
--

INSERT INTO `camp` (`id`, `camp_name`, `address`, `phone`, `camp_date`, `img_url`, `hospital_id`, `created_at`) VALUES
(2, 'Test Camp', 'Tpk road', '9876543210', '2022-01-15', '', 466, '2022-01-12 09:08:18');

-- --------------------------------------------------------

--
-- Table structure for table `checkup`
--

CREATE TABLE `checkup` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `checkup`
--

INSERT INTO `checkup` (`id`, `patient_id`, `hospital_id`, `form_id`, `status`, `created_at`) VALUES
(1, 62, 466, 5, 1, '2021-09-29 13:39:24'),
(2, 69, 466, 5, 1, '2021-09-29 19:34:02'),
(3, 69, 466, 3, 1, '2021-09-29 19:45:09'),
(5, 62, 466, 10, 1, '2021-11-07 07:55:24');

-- --------------------------------------------------------

--
-- Table structure for table `checkup_datas`
--

CREATE TABLE `checkup_datas` (
  `id` int(11) NOT NULL,
  `checkup_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `field_values` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `checkup_datas`
--

INSERT INTO `checkup_datas` (`id`, `checkup_id`, `field_id`, `field_values`) VALUES
(28, 1, 3, '120'),
(29, 1, 7, '95'),
(30, 1, 8, 'pain'),
(31, 1, 5, 'just mild'),
(35, 2, 3, '234'),
(36, 2, 7, '234'),
(37, 2, 8, 'sdfsd'),
(38, 2, 5, 'sdf'),
(39, 3, 3, '120'),
(40, 3, 5, 'Little Head ache on left side'),
(50, 5, 13, '1234'),
(51, 5, 7, '23'),
(52, 5, 14, 'Yes'),
(53, 5, 0, 'tag1,tag test1,sathya');

-- --------------------------------------------------------

--
-- Table structure for table `checkup_tags`
--

CREATE TABLE `checkup_tags` (
  `id` int(11) NOT NULL,
  `checkup_id` int(11) NOT NULL,
  `tags` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `checkup_tags`
--

INSERT INTO `checkup_tags` (`id`, `checkup_id`, `tags`) VALUES
(9, 5, '15,16,18');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(10) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `x` varchar(10) DEFAULT NULL,
  `y` varchar(10) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`, `description`, `x`, `y`, `hospital_id`) VALUES
(58, 'Cardiology', '<p>Description</p>\r\n', NULL, NULL, '466'),
(60, 'ENT', '<p>Ears Nose Throat</p>\r\n', NULL, NULL, '466');

-- --------------------------------------------------------

--
-- Table structure for table `diagnostic_report`
--

CREATE TABLE `diagnostic_report` (
  `id` int(100) NOT NULL,
  `date` varchar(100) DEFAULT NULL,
  `invoice` varchar(100) DEFAULT NULL,
  `report` varchar(10000) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(10) NOT NULL,
  `img_url` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `profile` varchar(100) DEFAULT NULL,
  `x` varchar(100) DEFAULT NULL,
  `y` varchar(10) DEFAULT NULL,
  `ion_user_id` varchar(100) DEFAULT NULL,
  `serial_id` varchar(10) NOT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `img_url`, `name`, `email`, `address`, `phone`, `department`, `profile`, `x`, `y`, `ion_user_id`, `serial_id`, `hospital_id`) VALUES
(162, NULL, 'Dr. Rose', 'doctor@allohms.com', 'TPK Road, Madurai', '9791839199', 'Cardiology', 'Cardiac Specialist', NULL, NULL, '765', 'AD1765', '466'),
(168, NULL, 'Dr. Priyan', 'doctor@priyan.com', 'Madurai', '8072782765', 'Cardiology', 'Dr. Priyan', NULL, NULL, '791', 'AD1791', '466'),
(169, NULL, 'Dr. Sathya', 'dr.sathya@allohms.com', 'TPK Road', '8095207092', 'Cardiology', 'Dr. Sathya', NULL, NULL, '805', 'AD1805', '466'),
(170, 'uploads/Doctor-Live2.png', 'Dr. Glory', 'dr.glory@allo.com', '1', '9524835677', 'Cardiology', 'Dr. Glory', NULL, NULL, '816', 'AD1816', '466');

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

CREATE TABLE `donor` (
  `id` int(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `group` varchar(10) DEFAULT NULL,
  `age` varchar(10) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `ldd` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `add_date` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `id` int(100) NOT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `message` varchar(10000) DEFAULT NULL,
  `reciepient` varchar(100) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `email_settings`
--

CREATE TABLE `email_settings` (
  `id` int(100) NOT NULL,
  `admin_email` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `email_settings`
--

INSERT INTO `email_settings` (`id`, `admin_email`, `type`, `user`, `password`, `hospital_id`) VALUES
(13, 'hello@jiovio.com', NULL, NULL, NULL, '466'),
(26, 'Admin Email', NULL, NULL, NULL, '477'),
(27, 'Admin Email', NULL, NULL, NULL, '478'),
(28, 'Admin Email', NULL, NULL, NULL, '479'),
(29, 'Admin Email', NULL, NULL, NULL, '480');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(10) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `amount` varchar(100) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `datestring` varchar(1000) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `expense_category`
--

CREATE TABLE `expense_category` (
  `id` int(10) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `x` varchar(100) DEFAULT NULL,
  `y` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `featured`
--

CREATE TABLE `featured` (
  `id` int(100) NOT NULL,
  `img_url` varchar(1000) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `profile` varchar(100) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `featured`
--

INSERT INTO `featured` (`id`, `img_url`, `name`, `profile`, `description`) VALUES
(1, 'uploads/images.jpg', 'Dr Momenuzzaman', 'Cardiac Specialized', 'Redantium, totam rem aperiam, eaque ipsa qu ab illo inventore veritatis et quasi architectos beatae vitae dicta sunt explicabo. Nemo enims sadips ipsums un.'),
(2, 'uploads/doctor.png', 'Dr RahmatUllah Asif', 'Cardiac Specialized', 'Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence'),
(3, 'uploads/download_(2)2.png', 'Dr A.R.M. Jamil', 'Cardiac Specialized', 'Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence'),
(4, 'uploads/inlinePreview.jpg', 'Hospital Management Syatem', 'Cardiac Specialized', '<p>bfbjfbsjbjsbfjsbf</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `form_templates`
--

CREATE TABLE `form_templates` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `hospital_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `form_templates`
--

INSERT INTO `form_templates` (`id`, `name`, `status`, `hospital_id`, `created_at`) VALUES
(1, 'General Checkup', 1, 466, '2021-09-25 17:12:11'),
(3, 'Eye Checkup', 1, 466, '2021-09-27 19:21:40'),
(4, 'Covid', 1, 466, '2021-09-27 19:25:24'),
(5, 'ANC Checkup', 1, 466, '2021-09-27 20:39:21'),
(10, 'Test Template', 1, 466, '2021-11-07 07:54:37'),
(11, 'tes', 1, 466, '2021-11-09 07:27:54'),
(12, 'radio button', 1, 466, '2021-11-10 05:11:03');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'superadmin', 'Super Admin'),
(2, 'members', 'General User'),
(3, 'Accountant', 'For Financial Activities'),
(4, 'Doctor', ''),
(5, 'Patient', ''),
(6, 'Nurse', ''),
(7, 'Pharmacist', ''),
(8, 'Laboratorist', ''),
(10, 'Receptionist', 'Receptionist'),
(11, 'admin', 'Administrator'),
(12, 'human_resource', ''),
(13, 'vitals', 'Vitals & Symptoms'),
(14, 'symptoms', 'Vitals & Symptoms'),
(15, 'formtemplates', 'Form Templates'),
(16, 'checkup', 'Checkup'),
(17, 'encounter', 'Patient Encounter');

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` int(100) NOT NULL,
  `doctor` varchar(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `x` varchar(100) DEFAULT NULL,
  `y` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`id`, `doctor`, `date`, `x`, `y`, `hospital_id`) VALUES
(76, '170', '1646434800', NULL, NULL, '466'),
(77, '170', '1646521200', NULL, NULL, '466');

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
  `id` int(100) NOT NULL,
  `name` varchar(500) DEFAULT NULL,
  `email` varchar(500) DEFAULT NULL,
  `password` varchar(500) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `phone` varchar(500) DEFAULT NULL,
  `package` varchar(100) DEFAULT NULL,
  `p_limit` varchar(100) DEFAULT NULL,
  `d_limit` varchar(100) DEFAULT NULL,
  `module` varchar(1000) DEFAULT NULL,
  `ion_user_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`id`, `name`, `email`, `password`, `address`, `phone`, `package`, `p_limit`, `d_limit`, `module`, `ion_user_id`) VALUES
(466, 'admin', 'admin@allohms.com', NULL, 'TPK Road, Madurai', '+919791839199', '', '1000', '500', 'accountant,appointment,lab,bed,department,doctor,donor,finance,pharmacy,laboratorist,medicine,human_resource,nurse,patient,pharmacist,prescription,receptionist,report,notice,email,sms,payroll,checkup,encounter,camp,risk', '763'),
(477, 'Hospital new', 'multichain@allohms.com', NULL, 'TPK Road', '9876543210', '81', '100', '10', 'accountant,appointment,lab,bed,department,doctor,donor,finance,pharmacy,laboratorist,medicine,nurse,patient,pharmacist,prescription,receptionist,report,notice,email,sms,payroll', '800'),
(478, 'Clinic', 'clinic@allohms.com', NULL, 'TPK Road', '9897654321', '81', '100', '10', 'accountant,appointment,lab,bed,department,doctor,donor,finance,pharmacy,laboratorist,medicine,nurse,patient,pharmacist,prescription,receptionist,report,notice,email,sms', '801'),
(479, 'Test123', 'test@gmail.com', NULL, 'TPK Road', '9876543210', '81', '100', '10', 'accountant,appointment,lab,bed,department,doctor,donor,finance,pharmacy,laboratorist,medicine,nurse,patient,pharmacist,prescription,receptionist,report,notice,email,sms,vitals', '813'),
(480, 'Test Hospital', 'testhospital@gmail.com', NULL, 'TPK Road, Madurai', '9750182115', '', '1000', '500', 'accountant,appointment,lab,bed,department,doctor,donor,finance,pharmacy,laboratorist,medicine,human_resource,nurse,patient,pharmacist,prescription,receptionist,report,notice,email,sms,payroll,checkup,encounter', '814');

-- --------------------------------------------------------

--
-- Table structure for table `human_resource`
--

CREATE TABLE `human_resource` (
  `id` int(11) NOT NULL,
  `img_url` varchar(200) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `ion_user_id` int(11) NOT NULL,
  `serial_id` varchar(10) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `human_resource`
--

INSERT INTO `human_resource` (`id`, `img_url`, `name`, `email`, `address`, `phone`, `ion_user_id`, `serial_id`, `hospital_id`, `created_at`) VALUES
(1, '', 'HR', 'hr@allohms.com', 'TPK Road', '8976543210', 804, 'AD1804', 466, '2021-08-27 12:14:58');

-- --------------------------------------------------------

--
-- Table structure for table `in_patient`
--

CREATE TABLE `in_patient` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `bed` varchar(10) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `in_patient`
--

INSERT INTO `in_patient` (`id`, `patient_id`, `bed`, `hospital_id`, `created_at`) VALUES
(7, 69, '', 466, '2021-11-07 08:27:45');

-- --------------------------------------------------------

--
-- Table structure for table `lab`
--

CREATE TABLE `lab` (
  `id` int(100) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `patient` varchar(100) DEFAULT NULL,
  `doctor` varchar(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `category_name` varchar(1000) DEFAULT NULL,
  `report` varchar(10000) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `patient_name` varchar(100) DEFAULT NULL,
  `patient_phone` varchar(100) DEFAULT NULL,
  `patient_address` varchar(100) DEFAULT NULL,
  `doctor_name` varchar(100) DEFAULT NULL,
  `date_string` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `laboratorist`
--

CREATE TABLE `laboratorist` (
  `id` int(100) NOT NULL,
  `img_url` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `x` varchar(100) DEFAULT NULL,
  `y` varchar(100) DEFAULT NULL,
  `ion_user_id` varchar(100) DEFAULT NULL,
  `serial_id` varchar(10) NOT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `laboratorist`
--

INSERT INTO `laboratorist` (`id`, `img_url`, `name`, `email`, `address`, `phone`, `x`, `y`, `ion_user_id`, `serial_id`, `hospital_id`) VALUES
(6, NULL, 'Mr Laboratorist', 'laboratorist@allohms.com', 'TPK Road, Madurai', '0123456789', NULL, NULL, '789', 'AD1789', '466');

-- --------------------------------------------------------

--
-- Table structure for table `lab_category`
--

CREATE TABLE `lab_category` (
  `id` int(10) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `reference_value` varchar(1000) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lab_category`
--

INSERT INTO `lab_category` (`id`, `category`, `description`, `reference_value`, `hospital_id`) VALUES
(35, 'Troponin-I', 'Pathological Test', '', NULL),
(36, 'CBC (DIGITAL)', 'Pathological Test', '', NULL),
(37, 'Eosinophil', 'Pathological Test', '', NULL),
(38, 'Platelets', 'Pathological Test', '', NULL),
(39, 'Malarial Parasites (MP)', 'Pathological Test', '', NULL),
(40, 'BT/ CT', 'Pathological Test', '', NULL),
(41, 'ASO Titre', 'Pathological Test', '', NULL),
(42, 'CRP', 'Pathological Test', '', NULL),
(43, 'R/A test', 'Pathological Test', '', NULL),
(44, 'VDRL', 'Pathological Test', '', NULL),
(45, 'TPHA', 'Pathological Test', '', NULL),
(46, 'HBsAg (Screening)', 'Pathological Test', '', NULL),
(47, 'HBsAg (Confirmatory)', 'Pathological Test', '', NULL),
(48, 'CFT for Kala Zar', 'Pathological Test', '', NULL),
(49, 'CFT for Filaria', 'Pathological Test', '', NULL),
(50, 'Pregnancy Test', 'Pathological Test', '', NULL),
(51, 'Blood Grouping', 'Pathological Test', '', NULL),
(52, 'Widal Test', 'Pathological Test', '(70-110)mg/dl', NULL),
(53, 'RBS', 'Pathological Test', '', NULL),
(54, 'Blood Urea', 'Pathological Test', '', NULL),
(55, 'S. Creatinine', 'Pathological Test', '', NULL),
(56, 'S. cholesterol', 'Pathological Test', '', NULL),
(57, 'Fasting Lipid Profile', 'Pathological Test', '', NULL),
(58, 'S. Bilirubin', 'Pathological Test', '', NULL),
(59, 'S. Alkaline Phosohare', 'Pathological Test', '', NULL),
(61, 'S. Calcium', 'Pathological Test', '', NULL),
(62, 'RBS with CUS', 'Pathological Test', '', NULL),
(63, 'SGPT', 'Pathological Test', '', NULL),
(64, 'SGOT', 'Pathological Test', '', NULL),
(65, 'Urine for R/E', 'Pathological Test', '', NULL),
(66, 'Urine C/S', 'Pathological Test', '', NULL),
(67, 'Stool for R/E', 'Pathological Test', '', NULL),
(68, 'Semen Analysis', 'Pathological Test', '', NULL),
(69, 'S. Electrolyte', 'Pathological Test', '', NULL),
(70, 'S. T3/ T4/ THS', 'Pathological Test', '', NULL),
(71, 'MT', 'Pathological Test', '', NULL),
(106, 'ESR', 'Patho Test', '', NULL),
(107, 'FBS CUS', 'Pathological test', '', NULL),
(108, 'Hb%', 'Pathological test', '', NULL),
(114, '2HABF', 'Pathological test', '', NULL),
(113, 'FBS', 'Pathological test', '', NULL),
(115, 'S. TSH', 'Pathological test', '', NULL),
(116, 'S. T3', 'Pathological test', '', NULL),
(117, 'DC', 'Pathological test', '', NULL),
(118, 'TC', 'Pathological test', '', NULL),
(120, 'S. Uric acid', 'Pathological test', '', NULL),
(126, 'eosinphil', 'Pathology Test', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `manualemailshortcode`
--

CREATE TABLE `manualemailshortcode` (
  `id` int(100) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `type` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manualemailshortcode`
--

INSERT INTO `manualemailshortcode` (`id`, `name`, `type`) VALUES
(1, '{firstname}', 'email'),
(2, '{lastname}', 'email'),
(3, '{name}', 'email'),
(6, '{address}', 'email'),
(7, '{company}', 'email'),
(8, '{email}', 'email'),
(9, '{phone}', 'email');

-- --------------------------------------------------------

--
-- Table structure for table `manualsmsshortcode`
--

CREATE TABLE `manualsmsshortcode` (
  `id` int(100) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `type` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manualsmsshortcode`
--

INSERT INTO `manualsmsshortcode` (`id`, `name`, `type`) VALUES
(1, '{firstname}', 'sms'),
(2, '{lastname}', 'sms'),
(3, '{name}', 'sms'),
(4, '{email}', 'sms'),
(5, '{phone}', 'sms'),
(6, '{address}', 'sms'),
(10, '{company}', 'sms');

-- --------------------------------------------------------

--
-- Table structure for table `manual_email_template`
--

CREATE TABLE `manual_email_template` (
  `id` int(100) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL,
  `type` varchar(1000) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manual_email_template`
--

INSERT INTO `manual_email_template` (`id`, `name`, `message`, `type`, `hospital_id`) VALUES
(11, 'Template', '{phone} {email}', 'email', '466');

-- --------------------------------------------------------

--
-- Table structure for table `manual_sms_template`
--

CREATE TABLE `manual_sms_template` (
  `id` int(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `medical_history`
--

CREATE TABLE `medical_history` (
  `id` int(100) NOT NULL,
  `patient_id` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` varchar(10000) DEFAULT NULL,
  `patient_name` varchar(100) DEFAULT NULL,
  `patient_address` varchar(500) DEFAULT NULL,
  `patient_phone` varchar(100) DEFAULT NULL,
  `img_url` varchar(500) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `registration_time` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `id` int(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `price` varchar(100) DEFAULT NULL,
  `box` varchar(100) DEFAULT NULL,
  `s_price` varchar(100) DEFAULT NULL,
  `quantity` int(100) DEFAULT NULL,
  `strip_cnt` int(11) NOT NULL,
  `tab_per_strip` int(11) NOT NULL,
  `generic` varchar(100) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `effects` varchar(100) DEFAULT NULL,
  `e_date` date NOT NULL,
  `add_date` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL,
  `min_stock` varchar(255) DEFAULT NULL,
  `u_date` date NOT NULL DEFAULT current_timestamp(),
  `remarks` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`id`, `name`, `category`, `price`, `box`, `s_price`, `quantity`, `strip_cnt`, `tab_per_strip`, `generic`, `company`, `effects`, `e_date`, `add_date`, `hospital_id`, `min_stock`, `u_date`, `remarks`) VALUES
(2878, 'test', 'syrup', '50', '4455', '55', 0, 0, 0, 'tets', 'test company', 'no effects', '2021-08-12', '04/26/21', '466', '2', '2021-10-25', ''),
(2879, 'tablet', 'syrup', '100', '10', '120', 0, 0, 0, 'vicks', 'Vicks', 'head', '2021-08-13', '08/11/21', '466', '10', '2021-10-25', ''),
(2880, 'new tab', 'syrup', '400', '10', '500', 100, 0, 0, 'nt', 'cip', 'nt', '2021-08-20', '08/11/21', '466', '5', '2021-10-25', ''),
(2881, 'testing', 'syrup', '100', '20', '150', 20, 10, 20, 'test', 'tttt', 'sdfsdf', '2022-05-20', '09/28/21', '466', '5', '2021-10-25', ''),
(2882, 'test2', 'syrup', '1000', '20', '2000', 400, 15, 40, 'ttts2', 'geomesh', 'test', '2022-03-05', '09/28/21', '466', '1', '2021-10-25', '');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_category`
--

CREATE TABLE `medicine_category` (
  `id` int(100) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `medicine_category`
--

INSERT INTO `medicine_category` (`id`, `category`, `description`, `hospital_id`) VALUES
(26, 'syrup', 'syrup', '466');

-- --------------------------------------------------------

--
-- Table structure for table `meeting`
--

CREATE TABLE `meeting` (
  `id` int(100) NOT NULL,
  `patient` varchar(100) DEFAULT NULL,
  `doctor` varchar(100) DEFAULT NULL,
  `topic` varchar(1000) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `start_time` varchar(100) DEFAULT NULL,
  `duration` varchar(100) DEFAULT NULL,
  `timezone` varchar(100) DEFAULT NULL,
  `meeting_id` varchar(100) DEFAULT NULL,
  `meeting_password` varchar(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `time_slot` varchar(100) DEFAULT NULL,
  `s_time` varchar(100) DEFAULT NULL,
  `e_time` varchar(100) DEFAULT NULL,
  `remarks` varchar(500) DEFAULT NULL,
  `add_date` varchar(100) DEFAULT NULL,
  `registration_time` varchar(100) DEFAULT NULL,
  `s_time_key` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `request` varchar(100) DEFAULT NULL,
  `patientname` varchar(1000) DEFAULT NULL,
  `doctorname` varchar(1000) DEFAULT NULL,
  `ion_user_id` varchar(100) DEFAULT NULL,
  `doctor_ion_id` varchar(100) DEFAULT NULL,
  `patient_ion_id` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `meeting_settings`
--

CREATE TABLE `meeting_settings` (
  `id` int(100) NOT NULL,
  `api_key` varchar(100) DEFAULT NULL,
  `secret_key` varchar(100) DEFAULT NULL,
  `ion_user_id` varchar(100) DEFAULT NULL,
  `y` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `id` int(100) NOT NULL,
  `hospital_id` varchar(100) DEFAULT NULL,
  `modules` varchar(1000) DEFAULT NULL,
  `x` varchar(100) DEFAULT NULL,
  `y` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `id` int(100) NOT NULL,
  `title` varchar(500) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nurse`
--

CREATE TABLE `nurse` (
  `id` int(100) NOT NULL,
  `img_url` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `x` varchar(100) DEFAULT NULL,
  `y` varchar(100) DEFAULT NULL,
  `z` varchar(100) DEFAULT NULL,
  `ion_user_id` varchar(100) DEFAULT NULL,
  `serial_id` varchar(10) NOT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nurse`
--

INSERT INTO `nurse` (`id`, `img_url`, `name`, `email`, `address`, `phone`, `x`, `y`, `z`, `ion_user_id`, `serial_id`, `hospital_id`) VALUES
(17, NULL, 'Mrs Nurse', 'nurse@allohms.com', 'TPK Road, Madurai', '9791839199', NULL, NULL, NULL, '790', 'AD1790', '466'),
(18, NULL, 'Nurse 1', 'nurse1@priyan.com', 'address', '1234567890', NULL, NULL, NULL, '792', 'AD1792', '466'),
(19, NULL, 'fghkjk', 'nurse23@allohms.com', 'House-11,Road-13,Nikunja-2', '0435345435', NULL, NULL, NULL, '795', 'AD1795', '466');

-- --------------------------------------------------------

--
-- Table structure for table `ot_payment`
--

CREATE TABLE `ot_payment` (
  `id` int(100) NOT NULL,
  `patient` varchar(100) DEFAULT NULL,
  `doctor_c_s` varchar(100) DEFAULT NULL,
  `doctor_a_s_1` varchar(100) DEFAULT NULL,
  `doctor_a_s_2` varchar(100) DEFAULT NULL,
  `doctor_anaes` varchar(100) DEFAULT NULL,
  `n_o_o` varchar(100) DEFAULT NULL,
  `c_s_f` varchar(100) DEFAULT NULL,
  `a_s_f_1` varchar(100) DEFAULT NULL,
  `a_s_f_2` varchar(11) DEFAULT NULL,
  `anaes_f` varchar(100) DEFAULT NULL,
  `ot_charge` varchar(100) DEFAULT NULL,
  `cab_rent` varchar(100) DEFAULT NULL,
  `seat_rent` varchar(100) DEFAULT NULL,
  `others` varchar(100) DEFAULT NULL,
  `discount` varchar(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `amount` varchar(100) DEFAULT NULL,
  `doctor_fees` varchar(100) DEFAULT NULL,
  `hospital_fees` varchar(100) DEFAULT NULL,
  `gross_total` varchar(100) DEFAULT NULL,
  `flat_discount` varchar(100) DEFAULT NULL,
  `amount_received` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ot_payment`
--

INSERT INTO `ot_payment` (`id`, `patient`, `doctor_c_s`, `doctor_a_s_1`, `doctor_a_s_2`, `doctor_anaes`, `n_o_o`, `c_s_f`, `a_s_f_1`, `a_s_f_2`, `anaes_f`, `ot_charge`, `cab_rent`, `seat_rent`, `others`, `discount`, `date`, `amount`, `doctor_fees`, `hospital_fees`, `gross_total`, `flat_discount`, `amount_received`, `status`, `user`, `hospital_id`) VALUES
(85, '451', 'None', '123', 'None', '125', 'dbdbd', '', '1000', '0', '1000', '', '', '', '', '', '1506195494', '2000', '2000', '0', '2000', '', '1000', 'unpaid', '614', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `id` int(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `price` varchar(100) DEFAULT NULL,
  `p_limit` varchar(100) DEFAULT NULL,
  `d_limit` varchar(100) DEFAULT NULL,
  `module` varchar(1000) DEFAULT NULL,
  `show_in_frontend` varchar(100) DEFAULT NULL,
  `frontend_order` varchar(100) DEFAULT NULL,
  `set_as_default` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`id`, `name`, `price`, `p_limit`, `d_limit`, `module`, `show_in_frontend`, `frontend_order`, `set_as_default`) VALUES
(80, 'asdasd', '3000', '2500', '1000', 'accountant,appointment,lab,bed,department,doctor,donor,finance,pharmacy,laboratorist,medicine,nurse,patient,pharmacist,prescription,receptionist,report,notice,email,sms', 'Yes', NULL, NULL),
(81, 'Premium', '50000', '100', '10', 'accountant,appointment,lab,bed,department,doctor,donor,finance,pharmacy,laboratorist,medicine,nurse,patient,pharmacist,prescription,receptionist,report,notice,email,sms,vitals', 'Yes', NULL, '1'),
(82, 'Advance', '60000', '100', '10', 'accountant,appointment,lab,bed,department,doctor,donor,finance,pharmacy,laboratorist,medicine,nurse,patient,pharmacist,prescription,receptionist,report,notice,email,sms,payroll', 'Yes', NULL, '1'),
(83, 'HR', '20000', '100', '10', 'accountant,appointment,lab,bed,department,doctor,donor,finance,pharmacy,laboratorist,medicine,human_resource,nurse,patient,pharmacist,prescription,receptionist,report,notice,email,sms,payroll', 'Yes', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(100) NOT NULL,
  `img_url` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(1000) DEFAULT NULL,
  `doctor` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `sex` varchar(100) DEFAULT NULL,
  `birthdate` varchar(100) DEFAULT NULL,
  `age` varchar(100) DEFAULT NULL,
  `bloodgroup` varchar(100) DEFAULT NULL,
  `ion_user_id` varchar(100) DEFAULT NULL,
  `serial_id` varchar(10) NOT NULL,
  `patient_id` varchar(100) DEFAULT NULL,
  `add_date` varchar(100) DEFAULT NULL,
  `registration_time` varchar(100) DEFAULT NULL,
  `how_added` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL,
  `camp_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `img_url`, `name`, `email`, `doctor`, `address`, `phone`, `sex`, `birthdate`, `age`, `bloodgroup`, `ion_user_id`, `serial_id`, `patient_id`, `add_date`, `registration_time`, `how_added`, `hospital_id`, `camp_id`) VALUES
(62, 'uploads/photos_0021.JPG', 'Mr Patient', 'patient@allohms.com', ',162,170,168', 'TPK Road, Madurai', '9524835677', 'Male', '01-07-2020', NULL, 'O-', '764', 'AD1764', '158098', '07/28/20', '1595924679', NULL, '466', 0),
(69, NULL, 'Sathya', 'sathya.safari@gmail.com', '168,162', 'test', '9750182115', 'Male', '09-09-2021', NULL, 'O-', '809', 'AD1809', '240505', '09/16/21', '1631795775', NULL, '466', 0),
(70, 'uploads/BabyScripts.png', 'Test', 'test@allohms.com', '', 'Second Floor, Arunachala Arcade, 33/36,', '7667878400', 'Male', '06-03-2012', NULL, 'O-', '815', 'AD1815', '882275', '11/08/21', '1636371736', NULL, '466', 0);

-- --------------------------------------------------------

--
-- Table structure for table `patient_checkin`
--

CREATE TABLE `patient_checkin` (
  `id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `token` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient_checkin`
--

INSERT INTO `patient_checkin` (`id`, `appointment_id`, `token`, `hospital_id`, `created_at`) VALUES
(11, 464, 100, 466, '2021-11-07 08:34:35');

-- --------------------------------------------------------

--
-- Table structure for table `patient_deposit`
--

CREATE TABLE `patient_deposit` (
  `id` int(10) NOT NULL,
  `patient` varchar(100) DEFAULT NULL,
  `payment_id` varchar(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `deposited_amount` varchar(100) DEFAULT NULL,
  `amount_received_id` varchar(100) DEFAULT NULL,
  `deposit_type` varchar(100) DEFAULT NULL,
  `gateway` varchar(100) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `patient_material`
--

CREATE TABLE `patient_material` (
  `id` int(100) NOT NULL,
  `date` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `patient` varchar(100) DEFAULT NULL,
  `patient_name` varchar(100) DEFAULT NULL,
  `patient_address` varchar(100) DEFAULT NULL,
  `patient_phone` varchar(100) DEFAULT NULL,
  `url` varchar(1000) DEFAULT NULL,
  `date_string` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patient_material`
--

INSERT INTO `patient_material` (`id`, `date`, `title`, `category`, `patient`, `patient_name`, `patient_address`, `patient_phone`, `url`, `date_string`, `hospital_id`) VALUES
(85, '1646733000', '', NULL, NULL, '0', '0', '0', 'uploads/BabyScripts1.png', '08-03-22', '466');

-- --------------------------------------------------------

--
-- Table structure for table `patient_risk`
--

CREATE TABLE `patient_risk` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `checkup_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `risk` varchar(100) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(10) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `patient` varchar(100) DEFAULT NULL,
  `doctor` varchar(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `amount` varchar(100) DEFAULT NULL,
  `vat` varchar(100) NOT NULL DEFAULT '0',
  `x_ray` varchar(100) DEFAULT NULL,
  `flat_vat` varchar(100) DEFAULT NULL,
  `discount` varchar(100) NOT NULL DEFAULT '0',
  `flat_discount` varchar(100) DEFAULT NULL,
  `gross_total` varchar(100) DEFAULT NULL,
  `remarks` varchar(500) DEFAULT NULL,
  `hospital_amount` varchar(100) DEFAULT NULL,
  `doctor_amount` varchar(100) DEFAULT NULL,
  `category_amount` varchar(1000) DEFAULT NULL,
  `category_name` varchar(1000) DEFAULT NULL,
  `amount_received` varchar(100) DEFAULT NULL,
  `deposit_type` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `patient_name` varchar(100) DEFAULT NULL,
  `patient_phone` varchar(100) DEFAULT NULL,
  `patient_address` varchar(100) DEFAULT NULL,
  `doctor_name` varchar(100) DEFAULT NULL,
  `date_string` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `paymentgateway`
--

CREATE TABLE `paymentgateway` (
  `id` int(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `merchant_key` varchar(100) DEFAULT NULL,
  `salt` varchar(100) DEFAULT NULL,
  `x` varchar(100) DEFAULT NULL,
  `y` varchar(100) DEFAULT NULL,
  `APIUsername` varchar(100) DEFAULT NULL,
  `APIPassword` varchar(100) DEFAULT NULL,
  `APISignature` varchar(100) DEFAULT NULL,
  `status` varchar(1000) DEFAULT NULL,
  `publish` varchar(1000) DEFAULT NULL,
  `secret` varchar(1000) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL,
  `public_key` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `paymentgateway`
--

INSERT INTO `paymentgateway` (`id`, `name`, `merchant_key`, `salt`, `x`, `y`, `APIUsername`, `APIPassword`, `APISignature`, `status`, `publish`, `secret`, `hospital_id`, `public_key`) VALUES
(27, 'Stripe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test', 'Enter Publish key', 'Enter Secret Key', '466', NULL),
(26, 'Pay U Money', 'Enter Merchant key', 'Enter Salt', NULL, NULL, NULL, NULL, NULL, 'test', NULL, NULL, '466', NULL),
(25, 'PayPal', NULL, NULL, NULL, NULL, 'Enter API Username', 'Enter API Password', 'Enter API Signature', 'test', NULL, NULL, '466', NULL),
(31, 'Paystack', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test', NULL, 'Enter Secret Key', '466', 'Enter Public Key'),
(67, 'PayPal', NULL, NULL, NULL, NULL, 'PayPal API Username', 'PayPal API Password', 'PayPal API Signature', 'test', NULL, NULL, '477', NULL),
(68, 'Pay U Money', 'Merchant key', 'Salt', NULL, NULL, NULL, NULL, NULL, 'test', NULL, NULL, '477', NULL),
(69, 'Stripe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Publish', 'Secret', '477', NULL),
(70, 'Paystack', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test', NULL, 'secret', '477', 'Public key'),
(71, 'PayPal', NULL, NULL, NULL, NULL, 'PayPal API Username', 'PayPal API Password', 'PayPal API Signature', 'test', NULL, NULL, '478', NULL),
(72, 'Pay U Money', 'Merchant key', 'Salt', NULL, NULL, NULL, NULL, NULL, 'test', NULL, NULL, '478', NULL),
(73, 'Stripe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Publish', 'Secret', '478', NULL),
(74, 'Paystack', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test', NULL, 'secret', '478', 'Public key'),
(75, 'PayPal', NULL, NULL, NULL, NULL, 'PayPal API Username', 'PayPal API Password', 'PayPal API Signature', 'test', NULL, NULL, '480', NULL),
(76, 'Pay U Money', 'Merchant key', 'Salt', NULL, NULL, NULL, NULL, NULL, 'test', NULL, NULL, '480', NULL),
(77, 'Stripe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Publish', 'Secret', '480', NULL),
(78, 'Paystack', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test', NULL, 'secret', '480', 'Public key');

-- --------------------------------------------------------

--
-- Table structure for table `payment_category`
--

CREATE TABLE `payment_category` (
  `id` int(10) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `c_price` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `d_commission` int(100) DEFAULT NULL,
  `h_commission` int(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `id` int(11) NOT NULL,
  `payroll_id` varchar(10) NOT NULL,
  `role` varchar(50) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `month_name` varchar(15) NOT NULL,
  `year` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `basic` varchar(50) NOT NULL,
  `allowance` varchar(50) NOT NULL,
  `deduction` varchar(50) NOT NULL,
  `net` varchar(50) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`id`, `payroll_id`, `role`, `emp_id`, `month`, `month_name`, `year`, `status`, `basic`, `allowance`, `deduction`, `net`, `hospital_id`, `created_at`) VALUES
(1, 'AD1001', 'doctor', 791, 7, 'July', 2021, 'Paid', '30,000', '50,000', '8,000', '72,000', 466, '2021-08-22 11:32:34'),
(2, 'AD1002', 'nurse', 792, 10, 'October', 2021, 'Unpaid', '7,000', '16,000', '1,500', '21,500', 466, '2021-08-22 11:33:11'),
(3, 'AD1003', 'doctor', 791, 8, 'August', 2021, 'Paid', '30,000', '50,000', '15,000', '65,000', 466, '2021-08-22 12:09:58'),
(4, 'AD1004', 'doctor', 765, 7, 'July', 2021, 'Paid', '20,000', '20,000', '2,000', '38,000', 466, '2021-08-30 11:33:09'),
(5, 'AD1005', 'human_resource', 804, 3, 'March', 2022, 'Paid', '12,500', '12,000', '1,000', '23,500', 466, '2021-08-31 11:10:25');

-- --------------------------------------------------------

--
-- Table structure for table `permission_features`
--

CREATE TABLE `permission_features` (
  `id` int(100) NOT NULL,
  `feature` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permission_features`
--

INSERT INTO `permission_features` (`id`, `feature`) VALUES
(39, 'Laboratorist'),
(2, 'Doctor'),
(3, 'Patient'),
(36, 'Bed'),
(5, 'Appointment'),
(7, 'Finance'),
(29, 'Notice'),
(28, 'Donor'),
(27, 'Pharmacy'),
(26, 'Email'),
(12, 'Report'),
(13, 'Website'),
(14, 'Settings'),
(38, 'Accountant'),
(25, 'SMS'),
(30, 'Nurse'),
(31, 'Medicine'),
(32, 'Department'),
(33, 'Receptionist'),
(34, 'Pharmacist'),
(35, 'Prescription'),
(37, 'Lab'),
(40, 'Payment Gateway'),
(41, 'Payroll'),
(42, 'Human Resource'),
(43, 'Vitals & Symptoms'),
(44, 'Form Templates'),
(45, 'Checkup'),
(46, 'Patient Encounter');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacist`
--

CREATE TABLE `pharmacist` (
  `id` int(100) NOT NULL,
  `img_url` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `x` varchar(100) DEFAULT NULL,
  `y` varchar(100) DEFAULT NULL,
  `ion_user_id` varchar(100) DEFAULT NULL,
  `serial_id` varchar(10) NOT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pharmacist`
--

INSERT INTO `pharmacist` (`id`, `img_url`, `name`, `email`, `address`, `phone`, `x`, `y`, `ion_user_id`, `serial_id`, `hospital_id`) VALUES
(10, NULL, 'Mr Pharmacist', 'pharmacist@allohms.com', 'TPK Road, Madurai', '880123456789', NULL, NULL, '767', 'AD1767', '466'),
(11, NULL, 'Pharma1', 'Pharma1@priyan.com', 'address', '9809809809', NULL, NULL, '793', 'AD1793', '466'),
(12, NULL, 'Pharma', 'pharma2@priyan.com', 'address', '9809809809', NULL, NULL, '794', 'AD1794', '466'),
(16, NULL, 'Sathya pharma', 'sathya@gmail.com', 'TPK Road', '98766543210', NULL, NULL, '810', 'AD1810', '466'),
(14, NULL, 'testpharm', 'testpharm@allohms.com', 'Rt nagar', '9898989898', NULL, NULL, '797', 'AD1797', '466'),
(15, NULL, 'senthilparma', 'senthilparma@allohms.com', 'TPK Road', '09791839199', NULL, NULL, '799', 'AD1799', '466');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_expense`
--

CREATE TABLE `pharmacy_expense` (
  `id` int(10) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `amount` varchar(100) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_expense_category`
--

CREATE TABLE `pharmacy_expense_category` (
  `id` int(10) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `x` varchar(100) DEFAULT NULL,
  `y` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_payment`
--

CREATE TABLE `pharmacy_payment` (
  `id` int(10) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `patient` varchar(100) DEFAULT NULL,
  `doctor` varchar(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `amount` varchar(100) DEFAULT NULL,
  `vat` varchar(100) NOT NULL DEFAULT '0',
  `x_ray` varchar(100) DEFAULT NULL,
  `flat_vat` varchar(100) DEFAULT NULL,
  `discount` varchar(100) NOT NULL DEFAULT '0',
  `flat_discount` varchar(100) DEFAULT NULL,
  `gross_total` varchar(100) DEFAULT NULL,
  `hospital_amount` varchar(100) DEFAULT NULL,
  `doctor_amount` varchar(100) DEFAULT NULL,
  `category_amount` varchar(1000) DEFAULT NULL,
  `category_name` varchar(1000) DEFAULT NULL,
  `amount_received` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_payment_category`
--

CREATE TABLE `pharmacy_payment_category` (
  `id` int(10) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `c_price` varchar(100) DEFAULT NULL,
  `d_commission` int(100) DEFAULT NULL,
  `h_commission` int(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `id` int(100) NOT NULL,
  `date` varchar(100) DEFAULT NULL,
  `patient` varchar(100) DEFAULT NULL,
  `doctor` varchar(100) DEFAULT NULL,
  `symptom` varchar(100) DEFAULT NULL,
  `advice` varchar(1000) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `dd` varchar(100) DEFAULT NULL,
  `medicine` varchar(1000) DEFAULT NULL,
  `validity` varchar(100) DEFAULT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `patientname` varchar(1000) DEFAULT NULL,
  `doctorname` varchar(1000) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id` int(100) NOT NULL,
  `product` varchar(255) DEFAULT NULL,
  `seller` varchar(255) DEFAULT NULL,
  `quantity` int(100) DEFAULT NULL,
  `p_price` varchar(100) DEFAULT NULL,
  `mrp` varchar(100) DEFAULT NULL,
  `m_date` varchar(70) DEFAULT NULL,
  `e_date` varchar(70) DEFAULT NULL,
  `p_date` varchar(70) DEFAULT NULL,
  `generic` varchar(255) DEFAULT NULL,
  `pat_name` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`id`, `product`, `seller`, `quantity`, `p_price`, `mrp`, `m_date`, `e_date`, `p_date`, `generic`, `pat_name`, `company`, `hospital_id`) VALUES
(1, 'test', 'test seller', 10, '100', '120', '2021-05-02', '2021-05-29', '2021-05-01', 'testtt', 'test pat', 'test company', '466'),
(2, 'testprod', '12234', 100, '100', '150', '2021-08-12', '2021-08-31', '2021-08-12', 'T123', 'Sen', 'JioVio', '466'),
(4, 'Test Sen Kumar', 'TSK', 120, '1000', '1500', '2021-08-21', '2021-08-27', '2021-08-21', 'GN', 'PN', 'Test Company', '466');

-- --------------------------------------------------------

--
-- Table structure for table `receptionist`
--

CREATE TABLE `receptionist` (
  `id` int(100) NOT NULL,
  `img_url` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `x` varchar(100) DEFAULT NULL,
  `ion_user_id` varchar(100) DEFAULT NULL,
  `serial_id` varchar(10) NOT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `receptionist`
--

INSERT INTO `receptionist` (`id`, `img_url`, `name`, `email`, `address`, `phone`, `x`, `ion_user_id`, `serial_id`, `hospital_id`) VALUES
(9, NULL, 'Mr Receptionist', 'receptionist@allohms.com', 'TPK Road, Madurai', '+919791839199', NULL, '770', 'AD1770', '466');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(100) NOT NULL,
  `report_type` varchar(100) DEFAULT NULL,
  `patient` varchar(100) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `doctor` varchar(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `add_date` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `other` varchar(100) DEFAULT NULL,
  `package` varchar(1000) DEFAULT NULL,
  `language` varchar(100) DEFAULT NULL,
  `remarks` varchar(500) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `name`, `address`, `email`, `phone`, `other`, `package`, `language`, `remarks`, `status`) VALUES
(18, 'asdasdasd', 'asdasdasdas', 'wewerwe@gmail.com', '2423423423', NULL, '80', 'english', NULL, 'Approved'),
(19, 'czdsffsdfs', 'sdfsdfefsd', 'sdfdfcfdsf@gmail.com', '3435345', NULL, '80', 'english', NULL, 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `risk_factor_elements`
--

CREATE TABLE `risk_factor_elements` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `elements` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `risk_factor_elements`
--

INSERT INTO `risk_factor_elements` (`id`, `type`, `elements`, `status`) VALUES
(1, 1, 'Risk1', 1),
(2, 2, 'Risk2', 1),
(3, 3, 'Risk3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(100) NOT NULL,
  `img_url` varchar(1000) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `img_url`, `title`, `description`) VALUES
(1, 'uploads/cardic.jpg', 'Cardiac Excellence', 'Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence'),
(2, '', 'Cancer Treatment', 'Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence'),
(3, '', 'Stroke Management', 'Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence'),
(4, '', '24 / 7 Support', 'Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence Cardiac Excellence'),
(5, 'uploads/inlinePreview1.jpg', 'bfbfjsb', 'jvbfdjvbj'),
(6, 'uploads/photos_002.JPG', 'gdfghfghgf', 'hfghfgfgfgfg');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) NOT NULL,
  `system_vendor` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `facebook_id` varchar(100) DEFAULT NULL,
  `currency` varchar(100) DEFAULT NULL,
  `language` varchar(100) DEFAULT NULL,
  `discount` varchar(100) DEFAULT NULL,
  `live_appointment_type` varchar(100) DEFAULT NULL,
  `vat` varchar(100) DEFAULT NULL,
  `login_title` varchar(100) DEFAULT NULL,
  `logo` varchar(500) DEFAULT NULL,
  `invoice_logo` varchar(500) DEFAULT NULL,
  `payment_gateway` varchar(100) DEFAULT NULL,
  `sms_gateway` varchar(100) DEFAULT NULL,
  `codec_username` varchar(100) DEFAULT NULL,
  `codec_purchase_code` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `system_vendor`, `title`, `address`, `phone`, `email`, `facebook_id`, `currency`, `language`, `discount`, `live_appointment_type`, `vat`, `login_title`, `logo`, `invoice_logo`, `payment_gateway`, `sms_gateway`, `codec_username`, `codec_purchase_code`, `hospital_id`) VALUES
(11, 'Hospital management System', 'Hospital', 'TPK Road, Madurai', '+919791839199', 'superadmin@allohms.com', NULL, '₹', 'english', 'flat', NULL, NULL, NULL, 'uploads/allohmsfavicon1.png', NULL, 'PayPal', 'Twilio', '', '', 'superadmin'),
(10, 'Jiovio Healthcare | Hospital management System', 'ALLOHMS', 'SISU Hospital, Kandampatty By-Pass, Salem', '+919791839199', 'admin@allohms.com', NULL, '₹', 'english', 'flat', 'jitsi', NULL, NULL, 'uploads/allohmsfavicon1.png', NULL, 'PayPal', 'Twilio', '', '', '466'),
(22, 'Code Aristos - Hospital management System', 'Hospital new', 'TPK Road', '9876543210', 'multichain@allohms.com', NULL, '$', 'english', 'flat', NULL, NULL, NULL, 'uploads/allohmsfavicon1.png', NULL, NULL, 'Twilio', NULL, NULL, '477'),
(23, 'Code Aristos - Hospital management System', 'Clinic', 'TPK Road', '9897654321', 'clinic@allohms.com', NULL, '$', 'english', 'flat', NULL, NULL, NULL, 'uploads/allohmsfavicon1.png', NULL, NULL, 'Twilio', NULL, NULL, '478'),
(24, 'Code Aristos - Hospital management System', 'Test123', 'TPK Road', '9876543210', 'test@gmail.com', NULL, '$', 'english', 'flat', NULL, NULL, NULL, 'uploads/allohmsfavicon1.png', NULL, NULL, 'Twilio', NULL, NULL, '479'),
(25, 'Code Aristos - Hospital management System', 'Test Hospital', 'TPK Road, Madurai', '9750182115', 'testhospital@gmail.com', NULL, '$', 'english', 'flat', NULL, NULL, NULL, 'uploads/allohmsfavicon1.png', NULL, NULL, 'Twilio', NULL, NULL, '480');

-- --------------------------------------------------------

--
-- Table structure for table `slide`
--

CREATE TABLE `slide` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `img_url` varchar(1000) DEFAULT NULL,
  `text1` varchar(500) DEFAULT NULL,
  `text2` varchar(500) DEFAULT NULL,
  `text3` varchar(500) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slide`
--

INSERT INTO `slide` (`id`, `title`, `img_url`, `text1`, `text2`, `text3`, `position`, `status`) VALUES
(1, 'Best Hospital management System', 'uploads/1503411077revised-bhatia-homebanner-03.jpg', 'Welcome To Hospital', 'Hospital Management System', 'Hospital', '2', 'Active'),
(2, 'Best Hospital management System', 'uploads/1707260345350542.jpg', 'Best Hospital management System', 'Best Hospital management System', 'Best Hospital management System', '1', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `sms`
--

CREATE TABLE `sms` (
  `id` int(100) NOT NULL,
  `date` varchar(100) DEFAULT NULL,
  `message` varchar(1600) DEFAULT NULL,
  `recipient` varchar(100) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sms`
--

INSERT INTO `sms` (`id`, `date`, `message`, `recipient`, `user`, `hospital_id`) VALUES
(69, '1631700477', 'hi', 'All Doctor', '763', '466'),
(70, '1631795868', '{company}{phone}{email}{name}{address}', 'All Patient', '763', '466'),
(71, '1631796035', 'Sathya testing SMS Module...', 'Patient Id: 69<br> Patient Name: Sathya<br> Patient Phone: 9750182115', '763', '466'),
(72, '1631796060', 'Sathya test SMS....', 'All Doctor', '763', '466'),
(73, '1631797055', 'Sathya test sms module....\r\n{company}\r\n{email}\r\n{phone}', 'All Doctor', '763', '466');

-- --------------------------------------------------------

--
-- Table structure for table `sms_settings`
--

CREATE TABLE `sms_settings` (
  `id` int(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `api_id` varchar(100) DEFAULT NULL,
  `sender` varchar(100) DEFAULT NULL,
  `authkey` varchar(100) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `sid` varchar(1000) DEFAULT NULL,
  `token` varchar(1000) DEFAULT NULL,
  `sendernumber` varchar(1000) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sms_settings`
--

INSERT INTO `sms_settings` (`id`, `name`, `username`, `password`, `api_id`, `sender`, `authkey`, `user`, `sid`, `token`, `sendernumber`, `hospital_id`) VALUES
(29, 'Twilio', NULL, NULL, NULL, NULL, NULL, '763', 'AC5e54b237ee9f2f220a0b0a9f50cdc6d2', '2f41c24b7377697e120ac3895993630c', '+12482434984', '466'),
(28, 'MSG91', NULL, NULL, NULL, 'Enter_Sender_Number', 'Enter_Your_MSG91_Auth_Key', '763', NULL, NULL, NULL, '466'),
(27, 'Clickatell', 'Enter_Your_ClickAtell_Username', '', 'Enter_Your_ClickAtell_Api _Id', NULL, NULL, '763', NULL, NULL, NULL, '466'),
(60, 'Clickatell', 'Your ClickAtell Username', 'Your ClickAtell Password', 'Your ClickAtell Api Id', NULL, NULL, '1', NULL, NULL, NULL, '477'),
(61, 'MSG91', 'Your MSG91 Username', NULL, 'Your MSG91 API ID', 'Sender Number', 'Your MSG91 Auth Key', '1', NULL, NULL, NULL, '477'),
(62, 'Twilio', NULL, NULL, NULL, NULL, NULL, '1', 'SID Number', 'Token Number', 'Sender Number', '477'),
(63, 'Clickatell', 'Your ClickAtell Username', 'Your ClickAtell Password', 'Your ClickAtell Api Id', NULL, NULL, '1', NULL, NULL, NULL, '478'),
(64, 'MSG91', 'Your MSG91 Username', NULL, 'Your MSG91 API ID', 'Sender Number', 'Your MSG91 Auth Key', '1', NULL, NULL, NULL, '478'),
(65, 'Twilio', NULL, NULL, NULL, NULL, NULL, '1', 'SID Number', 'Token Number', 'Sender Number', '478'),
(66, 'Clickatell', 'Your ClickAtell Username', 'Your ClickAtell Password', 'Your ClickAtell Api Id', NULL, NULL, '1', NULL, NULL, NULL, '479'),
(67, 'MSG91', 'Your MSG91 Username', NULL, 'Your MSG91 API ID', 'Sender Number', 'Your MSG91 Auth Key', '1', NULL, NULL, NULL, '479'),
(68, 'Twilio', NULL, NULL, NULL, NULL, NULL, '1', 'SID Number', 'Token Number', 'Sender Number', '479'),
(69, 'Clickatell', 'Your ClickAtell Username', 'Your ClickAtell Password', 'Your ClickAtell Api Id', NULL, NULL, '1', NULL, NULL, NULL, '480'),
(70, 'MSG91', 'Your MSG91 Username', NULL, 'Your MSG91 API ID', 'Sender Number', 'Your MSG91 Auth Key', '1', NULL, NULL, NULL, '480'),
(71, 'Twilio', NULL, NULL, NULL, NULL, NULL, '1', 'SID Number', 'Token Number', 'Sender Number', '480');

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `id` int(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `template` varchar(10000) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `x` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `template_fields`
--

CREATE TABLE `template_fields` (
  `id` int(11) NOT NULL,
  `template_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `field_type` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `template_fields`
--

INSERT INTO `template_fields` (`id`, `template_id`, `field_id`, `field_type`) VALUES
(116, 3, 5, 'text'),
(117, 3, 3, 'text'),
(118, 4, 5, 'text'),
(119, 4, 3, 'number'),
(120, 4, 6, 'number'),
(121, 5, 3, 'number'),
(122, 5, 7, 'number'),
(123, 5, 8, 'textarea'),
(124, 5, 5, 'text'),
(125, 1, 3, 'text'),
(126, 1, 5, 'number'),
(127, 1, 6, 'text'),
(129, 10, 13, ''),
(130, 10, 14, ''),
(131, 10, 7, ''),
(132, 11, 3, ''),
(133, 11, 5, ''),
(134, 11, 6, ''),
(135, 11, 7, ''),
(136, 11, 8, ''),
(137, 12, 19, ''),
(138, 12, 14, '');

-- --------------------------------------------------------

--
-- Table structure for table `time_schedule`
--

CREATE TABLE `time_schedule` (
  `id` int(100) NOT NULL,
  `doctor` varchar(500) DEFAULT NULL,
  `weekday` varchar(100) DEFAULT NULL,
  `s_time` varchar(100) DEFAULT NULL,
  `e_time` varchar(100) DEFAULT NULL,
  `s_time_key` varchar(100) DEFAULT NULL,
  `duration` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `time_schedule`
--

INSERT INTO `time_schedule` (`id`, `doctor`, `weekday`, `s_time`, `e_time`, `s_time_key`, `duration`, `hospital_id`) VALUES
(108, '168', 'Friday', '05:30 PM', '05:45 PM', '210', '3', '466'),
(109, '169', 'Monday', '09:30 AM', '09:30 PM', '114', '3', '466'),
(110, '169', 'Monday', '05:00 PM', '10:00 PM', '204', '3', '466'),
(111, '162', 'Monday', '05:15 PM', '07:15 PM', '207', '3', '466'),
(112, '162', 'Tuesday', '05:15 PM', '07:15 PM', '207', '3', '466'),
(113, '170', 'Friday', '09:45 AM', '11:45 AM', '117', '3', '466');

-- --------------------------------------------------------

--
-- Table structure for table `time_slot`
--

CREATE TABLE `time_slot` (
  `id` int(100) NOT NULL,
  `doctor` varchar(100) DEFAULT NULL,
  `s_time` varchar(100) DEFAULT NULL,
  `e_time` varchar(100) DEFAULT NULL,
  `weekday` varchar(100) DEFAULT NULL,
  `s_time_key` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `time_slot`
--

INSERT INTO `time_slot` (`id`, `doctor`, `s_time`, `e_time`, `weekday`, `s_time_key`, `hospital_id`) VALUES
(2240, '168', '05:30 PM', '05:45 PM', 'Friday', '210', '466'),
(2241, '169', '09:30 AM', '09:45 AM', 'Monday', '114', '466'),
(2242, '169', '09:45 AM', '10:00 AM', 'Monday', '117', '466'),
(2243, '169', '10:00 AM', '10:15 AM', 'Monday', '120', '466'),
(2244, '169', '10:15 AM', '10:30 AM', 'Monday', '123', '466'),
(2245, '169', '10:30 AM', '10:45 AM', 'Monday', '126', '466'),
(2246, '169', '10:45 AM', '11:00 AM', 'Monday', '129', '466'),
(2247, '169', '11:00 AM', '11:15 AM', 'Monday', '132', '466'),
(2248, '169', '11:15 AM', '11:30 AM', 'Monday', '135', '466'),
(2249, '169', '11:30 AM', '11:45 AM', 'Monday', '138', '466'),
(2250, '169', '11:45 AM', '12:00 AM', 'Monday', '141', '466'),
(2251, '169', '12:00 AM', '12:15 PM', 'Monday', '144', '466'),
(2252, '169', '12:15 PM', '12:30 PM', 'Monday', '147', '466'),
(2253, '169', '12:30 PM', '12:45 PM', 'Monday', '150', '466'),
(2254, '169', '12:45 PM', '01:00 PM', 'Monday', '153', '466'),
(2255, '169', '01:00 PM', '01:15 PM', 'Monday', '156', '466'),
(2256, '169', '01:15 PM', '01:30 PM', 'Monday', '159', '466'),
(2257, '169', '01:30 PM', '01:45 PM', 'Monday', '162', '466'),
(2258, '169', '01:45 PM', '02:00 PM', 'Monday', '165', '466'),
(2259, '169', '02:00 PM', '02:15 PM', 'Monday', '168', '466'),
(2260, '169', '02:15 PM', '02:30 PM', 'Monday', '171', '466'),
(2261, '169', '02:30 PM', '02:45 PM', 'Monday', '174', '466'),
(2262, '169', '02:45 PM', '03:00 PM', 'Monday', '177', '466'),
(2263, '169', '03:00 PM', '03:15 PM', 'Monday', '180', '466'),
(2264, '169', '03:15 PM', '03:30 PM', 'Monday', '183', '466'),
(2265, '169', '03:30 PM', '03:45 PM', 'Monday', '186', '466'),
(2266, '169', '03:45 PM', '04:00 PM', 'Monday', '189', '466'),
(2267, '169', '04:00 PM', '04:15 PM', 'Monday', '192', '466'),
(2268, '169', '04:15 PM', '04:30 PM', 'Monday', '195', '466'),
(2269, '169', '04:30 PM', '04:45 PM', 'Monday', '198', '466'),
(2270, '169', '04:45 PM', '05:00 PM', 'Monday', '201', '466'),
(2271, '169', '05:00 PM', '05:15 PM', 'Monday', '204', '466'),
(2272, '169', '05:15 PM', '05:30 PM', 'Monday', '207', '466'),
(2273, '169', '05:30 PM', '05:45 PM', 'Monday', '210', '466'),
(2274, '169', '05:45 PM', '06:00 PM', 'Monday', '213', '466'),
(2275, '169', '06:00 PM', '06:15 PM', 'Monday', '216', '466'),
(2276, '169', '06:15 PM', '06:30 PM', 'Monday', '219', '466'),
(2277, '169', '06:30 PM', '06:45 PM', 'Monday', '222', '466'),
(2278, '169', '06:45 PM', '07:00 PM', 'Monday', '225', '466'),
(2279, '169', '07:00 PM', '07:15 PM', 'Monday', '228', '466'),
(2280, '169', '07:15 PM', '07:30 PM', 'Monday', '231', '466'),
(2281, '169', '07:30 PM', '07:45 PM', 'Monday', '234', '466'),
(2282, '169', '07:45 PM', '08:00 PM', 'Monday', '237', '466'),
(2283, '169', '08:00 PM', '08:15 PM', 'Monday', '240', '466'),
(2284, '169', '08:15 PM', '08:30 PM', 'Monday', '243', '466'),
(2285, '169', '08:30 PM', '08:45 PM', 'Monday', '246', '466'),
(2286, '169', '08:45 PM', '09:00 PM', 'Monday', '249', '466'),
(2287, '169', '09:00 PM', '09:15 PM', 'Monday', '252', '466'),
(2288, '169', '09:15 PM', '09:30 PM', 'Monday', '255', '466'),
(2289, '169', '05:00 PM', '05:15 PM', 'Monday', '204', '466'),
(2290, '169', '05:15 PM', '05:30 PM', 'Monday', '207', '466'),
(2291, '169', '05:30 PM', '05:45 PM', 'Monday', '210', '466'),
(2292, '169', '05:45 PM', '06:00 PM', 'Monday', '213', '466'),
(2293, '169', '06:00 PM', '06:15 PM', 'Monday', '216', '466'),
(2294, '169', '06:15 PM', '06:30 PM', 'Monday', '219', '466'),
(2295, '169', '06:30 PM', '06:45 PM', 'Monday', '222', '466'),
(2296, '169', '06:45 PM', '07:00 PM', 'Monday', '225', '466'),
(2297, '169', '07:00 PM', '07:15 PM', 'Monday', '228', '466'),
(2298, '169', '07:15 PM', '07:30 PM', 'Monday', '231', '466'),
(2299, '169', '07:30 PM', '07:45 PM', 'Monday', '234', '466'),
(2300, '169', '07:45 PM', '08:00 PM', 'Monday', '237', '466'),
(2301, '169', '08:00 PM', '08:15 PM', 'Monday', '240', '466'),
(2302, '169', '08:15 PM', '08:30 PM', 'Monday', '243', '466'),
(2303, '169', '08:30 PM', '08:45 PM', 'Monday', '246', '466'),
(2304, '169', '08:45 PM', '09:00 PM', 'Monday', '249', '466'),
(2305, '169', '09:00 PM', '09:15 PM', 'Monday', '252', '466'),
(2306, '169', '09:15 PM', '09:30 PM', 'Monday', '255', '466'),
(2307, '169', '09:30 PM', '09:45 PM', 'Monday', '258', '466'),
(2308, '169', '09:45 PM', '10:00 PM', 'Monday', '261', '466'),
(2309, '162', '05:15 PM', '05:30 PM', 'Monday', '207', '466'),
(2310, '162', '05:30 PM', '05:45 PM', 'Monday', '210', '466'),
(2311, '162', '05:45 PM', '06:00 PM', 'Monday', '213', '466'),
(2312, '162', '06:00 PM', '06:15 PM', 'Monday', '216', '466'),
(2313, '162', '06:15 PM', '06:30 PM', 'Monday', '219', '466'),
(2314, '162', '06:30 PM', '06:45 PM', 'Monday', '222', '466'),
(2315, '162', '06:45 PM', '07:00 PM', 'Monday', '225', '466'),
(2316, '162', '07:00 PM', '07:15 PM', 'Monday', '228', '466'),
(2317, '162', '05:15 PM', '05:30 PM', 'Tuesday', '207', '466'),
(2318, '162', '05:30 PM', '05:45 PM', 'Tuesday', '210', '466'),
(2319, '162', '05:45 PM', '06:00 PM', 'Tuesday', '213', '466'),
(2320, '162', '06:00 PM', '06:15 PM', 'Tuesday', '216', '466'),
(2321, '162', '06:15 PM', '06:30 PM', 'Tuesday', '219', '466'),
(2322, '162', '06:30 PM', '06:45 PM', 'Tuesday', '222', '466'),
(2323, '162', '06:45 PM', '07:00 PM', 'Tuesday', '225', '466'),
(2324, '162', '07:00 PM', '07:15 PM', 'Tuesday', '228', '466'),
(2325, '170', '09:45 AM', '10:00 AM', 'Friday', '117', '466'),
(2326, '170', '10:00 AM', '10:15 AM', 'Friday', '120', '466'),
(2327, '170', '10:15 AM', '10:30 AM', 'Friday', '123', '466'),
(2328, '170', '10:30 AM', '10:45 AM', 'Friday', '126', '466'),
(2329, '170', '10:45 AM', '11:00 AM', 'Friday', '129', '466'),
(2330, '170', '11:00 AM', '11:15 AM', 'Friday', '132', '466'),
(2331, '170', '11:15 AM', '11:30 AM', 'Friday', '135', '466'),
(2332, '170', '11:30 AM', '11:45 AM', 'Friday', '138', '466');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `hospital_ion_id` varchar(100) DEFAULT NULL,
  `permissions` varchar(1000) DEFAULT NULL,
  `otp` int(11) NOT NULL,
  `verified` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `hospital_ion_id`, `permissions`, `otp`, `verified`) VALUES
(1, '127.0.0.1', 'superadmin', '$2y$08$h5ZsyLuWM8izwhwWlkfDdeylY8jdXwlqhf8C5Tlj.rIP/AL/7W1oO', '', 'superadmin@allohms.com', '', 'eX0.Bq6nP57EuXX4hJkPHO973e7a4c25f1849d3a', 1511432365, 'zCeJpcj78CKqJ4sVxVbxcO', 1268889823, 1644298717, 1, 'Admin', 'istrator', 'ADMIN', '0', NULL, NULL, 0, 0),
(763, '45.251.231.70', 'admin', '$2y$08$h5ZsyLuWM8izwhwWlkfDdeylY8jdXwlqhf8C5Tlj.rIP/AL/7W1oO', NULL, 'admin@allohms.com', NULL, NULL, NULL, NULL, 1595923316, 1646731509, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(764, '45.251.231.70', 'Mr Patient', '$2y$08$sqcx4QZ.Ci6LKtOsn60.lefH09o.gcZ4/hPMivggzGnLK.6nytfVG', NULL, 'patient@allohms.com', NULL, NULL, NULL, NULL, 1595924679, 1646225564, 1, NULL, NULL, NULL, '9524835677', '763', NULL, 0, 0),
(765, '45.251.231.70', 'Dr. Rose', '$2y$08$s5cBXVCCSk8tROWdIeumseXESZtf5dGZRKjtAly0ZpGh.hcj4hdwW', NULL, 'doctor@allohms.com', NULL, NULL, NULL, NULL, 1595924765, 1646634772, 1, NULL, NULL, NULL, '9791839199', '763', 'Patient,Appointment,Email,Report,Prescription,Lab,Patient Encounter', 0, 0),
(767, '45.251.231.70', 'Mr Pharmacist', '$2y$08$fkdyceYtLWgbAxKvv8BXVexszvjABV/8xPQ3bAokwoF6sW/kdOnlW', NULL, 'pharmacist@allohms.com', NULL, NULL, NULL, NULL, 1595928739, 1632301754, 1, NULL, NULL, NULL, '880123456789', '763', 'Pharmacy,Prescription', 0, 0),
(770, '45.251.231.70', 'Mr Receptionist', '$2y$08$uQ8hjJRTGAEsshOFkS8acue03e.4h3MXQLwH79837vhqu7SH9U3TK', NULL, 'receptionist@allohms.com', NULL, NULL, NULL, NULL, 1595929512, 1646212412, 1, NULL, NULL, NULL, '+919791839199', '763', 'Patient,Appointment,Finance,Email', 0, 0),
(787, '103.231.160.47', 'Mr Accountant', '$2y$08$GVopabH96MmnQFKKqYCYJOjlr0kgUQUg7GOjsqnJ/.tlcQCfwg0cm', NULL, 'accountant@allohms.com', NULL, NULL, NULL, NULL, 1600753981, 1646210521, 1, NULL, NULL, NULL, '9791839199', '763', 'Patient,Finance,Email,Report', 0, 0),
(789, '103.231.160.47', 'Mr Laboratorist', '$2y$08$B2WZyEiQdFCPndWw8//ZpuFXb7pc00nAiIU8g0S7TJAg5NLK3I5sK', NULL, 'laboratorist@allohms.com', NULL, NULL, NULL, NULL, 1600845967, 1630669705, 1, NULL, NULL, NULL, '0123456789', '763', 'Patient,Donor,Email,Report,Lab', 0, 0),
(790, '103.231.160.47', 'Mrs Nurse', '$2y$08$HDm7P5PrQk9ZiQEggq.mPeyJfyxMi0b7Mbiztp/gd8838Ls19JP2e', NULL, 'nurse@allohms.com', NULL, NULL, NULL, NULL, 1600846100, 1646655181, 1, NULL, NULL, NULL, '9791839199', '763', 'Patient,Bed,Appointment,Donor,Email,Report,Patient Encounter', 0, 0),
(791, '157.51.22.243', 'Dr. Priyan', '$2y$08$dhOghKCy9Yh3KekAdG5YYOJciI0BSdPoILzrRcjNRR/C33La1.u/m', NULL, 'doctor@priyan.com', NULL, NULL, NULL, NULL, 1621592071, 1630389505, 1, NULL, NULL, NULL, '8072782765', '763', 'Patient,Appointment,Email,Report,Prescription,Lab', 0, 0),
(792, '157.51.22.243', 'Nurse 1', '$2y$08$SpUTmpLFzFdGxkgbvUQeWubowuGcf7kjvh7sLpvxhYRLDbvPHO7ii', NULL, 'nurse1@priyan.com', NULL, NULL, NULL, NULL, 1621593245, NULL, 1, NULL, NULL, NULL, '1234567890', '763', 'Patient,Bed,Appointment,Donor,Email,Report', 0, 0),
(793, '157.51.22.243', 'Pharma1', '$2y$08$dD4EHS4hNqQg4xoUncX4iePPrb2ElvF4d.imU5Fo6jhQG/3C5ivP.', NULL, 'Pharma1@priyan.com', NULL, NULL, NULL, NULL, 1621593406, 1621593444, 1, NULL, NULL, NULL, '9809809809', '763', 'Pharmacy,Email,Medicine,Prescription', 0, 0),
(794, '157.51.22.243', 'Pharma', '$2y$08$EpZIRsVnWZEstX6qe6aJMefx1XHJuhZDvadI0BS7RtsSZey7nAO5W', NULL, 'pharma2@priyan.com', NULL, NULL, NULL, NULL, 1621593577, 1621593677, 1, NULL, NULL, NULL, NULL, '763', 'Pharmacy', 0, 0),
(795, '103.127.94.114', 'fghkjk', '$2y$08$C.xibdafn26H67Vti1atPemXRtWPsoU0vCO.jtHVo3UP12YYbjwGC', NULL, 'nurse23@allohms.com', NULL, NULL, NULL, NULL, 1621944921, 1625913370, 1, NULL, NULL, NULL, '0435345435', '763', 'Bed,Donor,Email,Report', 0, 0),
(797, '49.205.80.101', 'testpharm', '$2y$08$l.h8NaGXa91XFwuSWbm47.To.TD9DByFBqR9zJnK9n2o/RBB5HULy', NULL, 'testpharm@allohms.com', NULL, NULL, NULL, NULL, 1623829081, 1623829121, 1, NULL, NULL, NULL, '9898989898', '763', 'Pharmacy', 0, 0),
(798, '103.127.94.115', 'xyz n', '$2y$08$z0gYxnHEyx5Jn0TthtHwhOWUKnx6FsS6iPODSoLIDQPCDRcSOIMIW', NULL, 'jioviohealthcare@gmail.com', NULL, NULL, NULL, NULL, 1625913613, 1625913635, 1, NULL, NULL, NULL, '9791839199', '763', 'Patient,Finance,Email,Report', 0, 0),
(799, '49.205.85.111', 'senthilparma', '$2y$08$WM2l6tb9ISIV4x4D37o.uusNEgdqjN3g789yMr8bt7psVG1tf2czW', NULL, 'senthilparma@allohms.com', NULL, NULL, NULL, NULL, 1628312081, NULL, 1, NULL, NULL, NULL, '09791839199', '763', 'Pharmacy,Email,Medicine,Prescription', 0, 0),
(800, '::1', 'Hospital new', '$2y$08$iQa4Ju32iwSY7t5a6wPYfOA/zm81uDRmPZm2o6xcI0YtcCSrV0YdG', NULL, 'multichain@allohms.com', NULL, NULL, NULL, NULL, 1629732884, 1629779829, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(801, '::1', 'Clinic', '$2y$08$KggNwI/q9RH2Sg3RghihHOAim51UAbDjXLhmW18SZWlTox/zlRQWu', NULL, 'clinic@allohms.com', NULL, NULL, NULL, NULL, 1629733295, 1644298801, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(802, '::1', 'Account Sathya', '$2y$08$PQ7ngnNa8ROBDm2SNptONeZPR4j31wq8XLbCM6aWTG/Qsf5kT5nIi', NULL, 'accountsathya@allohms.com', NULL, NULL, NULL, NULL, 1629735388, 1629735406, 1, NULL, NULL, NULL, NULL, '801', 'Patient,Finance,Email,Report,Payroll', 0, 0),
(803, '::1', 'new acc', '$2y$08$CJGw5WB700DoKYf8FkfjI.wOFMRsKsCHwEYmJJPOE86ybGzp9Vgli', NULL, 'acc@allohms.com', NULL, NULL, NULL, NULL, 1629779923, 1629780001, 1, NULL, NULL, NULL, NULL, '800', 'Patient,Finance,Email,Report,Payroll', 0, 0),
(804, '::1', 'HR', '$2y$08$/.ywDN6FQgIwX8V43I/XZuBpRbGATOh19.EdQdAqAOoySTPY/eoC2', NULL, 'hr@allohms.com', NULL, NULL, NULL, NULL, 1630046697, 1630406816, 1, NULL, NULL, NULL, '8976543210', '763', 'Email,Payroll,Human Resource', 0, 0),
(805, '::1', 'Dr. Sathya', '$2y$08$23cYe/nzKkQENEe7lLcYq.6Z6WEqjT3LttxYjotaEPNZoGWCgysma', NULL, 'dr.sathya@allohms.com', NULL, NULL, NULL, NULL, 1630668214, 1634378049, 1, NULL, NULL, NULL, '8095207092', '763', 'Patient,Appointment,Email,Report,Prescription,Lab', 47383, 0),
(809, '::1', 'Sathya', '$2y$08$uirOhcDuo9Jj5e5GFjvcIeIoqfkjniDiTyMU68T.6yS3OCAlKBWSK', NULL, 'sathya.safari@gmail.com', NULL, NULL, NULL, NULL, 1631795775, 1632929592, 1, NULL, NULL, NULL, '9750182115', '763', NULL, 0, 0),
(810, '::1', 'Sathya pharma', '$2y$08$yYTw0PJvOghDkI85eFpbtuKswwE1kohLn7mj/tYTT1ofWd8Gv8.S.', NULL, 'sathya@gmail.com', NULL, NULL, NULL, NULL, 1632756205, NULL, 1, NULL, NULL, NULL, '98766543210', '763', 'Pharmacy,Email,Medicine,Prescription', 0, 0),
(813, '162.158.235.152', 'Test123', '$2y$08$MfvEYXqTzktWX9U3LkPV1ez2BY2XGXJe9Ptr4vtPD5AuZnshr7q3G', NULL, 'test@gmail.com', NULL, NULL, NULL, NULL, 1634745706, 1634745723, 1, NULL, NULL, NULL, '9876543210', NULL, NULL, 0, 0),
(814, '172.70.188.89', 'Test Hospital', '$2y$08$ipDf6Afn9tCr8NY8QbuwQOSfhjIPidJTL9R0at.Ry9F0o5llI1eoe', NULL, 'testhospital@gmail.com', NULL, NULL, NULL, NULL, 1636351757, NULL, 1, NULL, NULL, NULL, '9750182115', NULL, NULL, 0, 0),
(815, '172.70.143.34', 'Test', '$2y$08$G7uM1TP8dKhD7kpGP.6iweBTPVl.KYQJSiACdtr9OZt/FbqgjtYcm', NULL, 'test@allohms.com', NULL, NULL, NULL, NULL, 1636371736, 1636371868, 1, NULL, NULL, NULL, '7667878400', '763', NULL, 0, 0),
(816, '::1', 'Dr. Glory', '$2y$08$cLeG90xNIdux5xRWwkFE6uTGx3Aqzvaw59sA17Eo3//ua4XZM0uIq', NULL, 'dr.glory@allo.com', NULL, NULL, NULL, NULL, 1646111595, NULL, 1, NULL, NULL, NULL, '9524835677', '763', 'Patient,Appointment,Email,Report,Prescription,Lab,Patient Encounter', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(765, 763, 11),
(766, 764, 5),
(767, 765, 4),
(769, 767, 7),
(772, 770, 10),
(789, 787, 3),
(791, 789, 8),
(792, 790, 6),
(793, 791, 4),
(794, 792, 6),
(795, 793, 7),
(796, 794, 7),
(797, 795, 6),
(799, 797, 7),
(800, 798, 3),
(801, 799, 7),
(802, 800, 11),
(803, 801, 11),
(804, 802, 3),
(805, 803, 3),
(806, 804, 12),
(807, 805, 4),
(811, 809, 5),
(812, 810, 7),
(815, 813, 11),
(816, 814, 11),
(817, 815, 5),
(818, 816, 4);

-- --------------------------------------------------------

--
-- Table structure for table `vital_symptoms`
--

CREATE TABLE `vital_symptoms` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `img_url` text NOT NULL,
  `unit` varchar(10) NOT NULL,
  `category` varchar(10) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `input_type` varchar(20) NOT NULL,
  `input_options` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vital_symptoms`
--

INSERT INTO `vital_symptoms` (`id`, `name`, `img_url`, `unit`, `category`, `hospital_id`, `input_type`, `input_options`, `status`, `created_at`) VALUES
(3, 'Pressure', 'uploads/squad.png', 'mmHG', 'vital', 466, 'text', '', 1, '2021-09-17 19:22:52'),
(5, 'Head ache', 'uploads/squad2.png', '', 'symptom', 466, '', '', 1, '2021-09-20 20:53:50'),
(6, 'Sugar', 'uploads/SupernoobsLogo1.png', 'mg/dL', 'vital', 466, 'text', '', 1, '2021-09-27 19:26:13'),
(7, 'Weight', 'uploads/squad3.png', 'kg', 'vital', 466, 'text', '', 1, '2021-09-27 20:37:00'),
(8, 'Neck', 'uploads/SupernoobsLogo2.png', '', 'symptom', 466, '', '', 1, '2021-09-27 20:37:36'),
(13, 'Test', '', 'mgl', 'vital', 466, 'text', '', 1, '2021-11-07 07:53:20'),
(14, 'HIV', '', '', 'symptom', 466, 'radio', 'Yes,No', 1, '2021-11-07 07:54:00'),
(15, 'tag1', '', '', 'symptom', 466, 'tag', '', 1, '2021-11-07 07:56:11'),
(16, 'tag test1', '', '', 'symptom', 466, 'tag', '', 1, '2021-11-07 07:56:20'),
(17, 'test 2', '', '', 'symptom', 466, 'tag', '', 1, '2021-11-07 07:56:28'),
(18, 'sathya', '', '', 'symptom', 0, 'tag', '', 0, '2021-11-07 07:56:57'),
(19, 'radio button', '', '', 'symptom', 466, 'radio', 'radio button1,radio button2', 1, '2021-11-09 07:53:35');

-- --------------------------------------------------------

--
-- Table structure for table `website_settings`
--

CREATE TABLE `website_settings` (
  `id` int(100) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `logo` varchar(1000) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `emergency` varchar(100) DEFAULT NULL,
  `support` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `currency` varchar(100) DEFAULT NULL,
  `block_1_text_under_title` varchar(500) DEFAULT NULL,
  `service_block__text_under_title` varchar(500) DEFAULT NULL,
  `doctor_block__text_under_title` varchar(500) DEFAULT NULL,
  `facebook_id` varchar(100) DEFAULT NULL,
  `twitter_id` varchar(100) DEFAULT NULL,
  `google_id` varchar(100) DEFAULT NULL,
  `youtube_id` varchar(100) DEFAULT NULL,
  `skype_id` varchar(100) DEFAULT NULL,
  `x` varchar(100) DEFAULT NULL,
  `twitter_username` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `website_settings`
--

INSERT INTO `website_settings` (`id`, `title`, `logo`, `address`, `phone`, `emergency`, `support`, `email`, `currency`, `block_1_text_under_title`, `service_block__text_under_title`, `doctor_block__text_under_title`, `facebook_id`, `twitter_id`, `google_id`, `youtube_id`, `skype_id`, `x`, `twitter_username`) VALUES
(1, 'Hospital Management', 'uploads/JioVio_Logo-01.png', 'TPK Road, Madurai-625004', '+0123456789', '+0123456789', '+0123456789', 'admin@demo.com', '$', 'Best Hospital In The City', 'Aenean nibh ante, lacinia non tincidunt nec, lobortis ut tellus. Sed in porta diam.', 'We work with forward thinking clients to create beautiful, honest and amazing things that bring positive results.', 'https://www.facebook.com/jioviohealthcare/', 'https://twitter.com/jio_vio', 'https://www.google.com/jiovio', 'https://www.youtube.com/', 'https://www.skype.com/jiovio', NULL, 'Jiovio Healthcare');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountant`
--
ALTER TABLE `accountant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alloted_bed`
--
ALTER TABLE `alloted_bed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `autoemailshortcode`
--
ALTER TABLE `autoemailshortcode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `autoemailtemplate`
--
ALTER TABLE `autoemailtemplate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `autosmsshortcode`
--
ALTER TABLE `autosmsshortcode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `autosmstemplate`
--
ALTER TABLE `autosmstemplate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bankb`
--
ALTER TABLE `bankb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bed`
--
ALTER TABLE `bed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bed_category`
--
ALTER TABLE `bed_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `camp`
--
ALTER TABLE `camp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checkup`
--
ALTER TABLE `checkup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checkup_datas`
--
ALTER TABLE `checkup_datas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checkup_tags`
--
ALTER TABLE `checkup_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diagnostic_report`
--
ALTER TABLE `diagnostic_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donor`
--
ALTER TABLE `donor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_settings`
--
ALTER TABLE `email_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_category`
--
ALTER TABLE `expense_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `featured`
--
ALTER TABLE `featured`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_templates`
--
ALTER TABLE `form_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `human_resource`
--
ALTER TABLE `human_resource`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `in_patient`
--
ALTER TABLE `in_patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab`
--
ALTER TABLE `lab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laboratorist`
--
ALTER TABLE `laboratorist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_category`
--
ALTER TABLE `lab_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manualemailshortcode`
--
ALTER TABLE `manualemailshortcode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manualsmsshortcode`
--
ALTER TABLE `manualsmsshortcode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manual_email_template`
--
ALTER TABLE `manual_email_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manual_sms_template`
--
ALTER TABLE `manual_sms_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medical_history`
--
ALTER TABLE `medical_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicine_category`
--
ALTER TABLE `medicine_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meeting`
--
ALTER TABLE `meeting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meeting_settings`
--
ALTER TABLE `meeting_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nurse`
--
ALTER TABLE `nurse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ot_payment`
--
ALTER TABLE `ot_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_checkin`
--
ALTER TABLE `patient_checkin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_deposit`
--
ALTER TABLE `patient_deposit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_material`
--
ALTER TABLE `patient_material`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_risk`
--
ALTER TABLE `patient_risk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paymentgateway`
--
ALTER TABLE `paymentgateway`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_category`
--
ALTER TABLE `payment_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_features`
--
ALTER TABLE `permission_features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacist`
--
ALTER TABLE `pharmacist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacy_expense`
--
ALTER TABLE `pharmacy_expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacy_expense_category`
--
ALTER TABLE `pharmacy_expense_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacy_payment`
--
ALTER TABLE `pharmacy_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacy_payment_category`
--
ALTER TABLE `pharmacy_payment_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receptionist`
--
ALTER TABLE `receptionist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `risk_factor_elements`
--
ALTER TABLE `risk_factor_elements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms`
--
ALTER TABLE `sms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_settings`
--
ALTER TABLE `sms_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_fields`
--
ALTER TABLE `template_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_schedule`
--
ALTER TABLE `time_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_slot`
--
ALTER TABLE `time_slot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- Indexes for table `vital_symptoms`
--
ALTER TABLE `vital_symptoms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `website_settings`
--
ALTER TABLE `website_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accountant`
--
ALTER TABLE `accountant`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `alloted_bed`
--
ALTER TABLE `alloted_bed`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `autoemailshortcode`
--
ALTER TABLE `autoemailshortcode`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `autoemailtemplate`
--
ALTER TABLE `autoemailtemplate`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `autosmsshortcode`
--
ALTER TABLE `autosmsshortcode`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `autosmstemplate`
--
ALTER TABLE `autosmstemplate`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `bankb`
--
ALTER TABLE `bankb`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT for table `bed`
--
ALTER TABLE `bed`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `bed_category`
--
ALTER TABLE `bed_category`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `camp`
--
ALTER TABLE `camp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `checkup`
--
ALTER TABLE `checkup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `checkup_datas`
--
ALTER TABLE `checkup_datas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `checkup_tags`
--
ALTER TABLE `checkup_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `diagnostic_report`
--
ALTER TABLE `diagnostic_report`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `donor`
--
ALTER TABLE `donor`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `email_settings`
--
ALTER TABLE `email_settings`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `expense_category`
--
ALTER TABLE `expense_category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `featured`
--
ALTER TABLE `featured`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `form_templates`
--
ALTER TABLE `form_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `hospital`
--
ALTER TABLE `hospital`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=481;

--
-- AUTO_INCREMENT for table `human_resource`
--
ALTER TABLE `human_resource`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `in_patient`
--
ALTER TABLE `in_patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `lab`
--
ALTER TABLE `lab`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1936;

--
-- AUTO_INCREMENT for table `laboratorist`
--
ALTER TABLE `laboratorist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lab_category`
--
ALTER TABLE `lab_category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `manualemailshortcode`
--
ALTER TABLE `manualemailshortcode`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `manualsmsshortcode`
--
ALTER TABLE `manualsmsshortcode`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `manual_email_template`
--
ALTER TABLE `manual_email_template`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `manual_sms_template`
--
ALTER TABLE `manual_sms_template`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `medical_history`
--
ALTER TABLE `medical_history`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2883;

--
-- AUTO_INCREMENT for table `medicine_category`
--
ALTER TABLE `medicine_category`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `meeting`
--
ALTER TABLE `meeting`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=588;

--
-- AUTO_INCREMENT for table `meeting_settings`
--
ALTER TABLE `meeting_settings`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `nurse`
--
ALTER TABLE `nurse`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `ot_payment`
--
ALTER TABLE `ot_payment`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `patient_checkin`
--
ALTER TABLE `patient_checkin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `patient_deposit`
--
ALTER TABLE `patient_deposit`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1661;

--
-- AUTO_INCREMENT for table `patient_material`
--
ALTER TABLE `patient_material`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `patient_risk`
--
ALTER TABLE `patient_risk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2077;

--
-- AUTO_INCREMENT for table `paymentgateway`
--
ALTER TABLE `paymentgateway`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `payment_category`
--
ALTER TABLE `payment_category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permission_features`
--
ALTER TABLE `permission_features`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `pharmacist`
--
ALTER TABLE `pharmacist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pharmacy_expense`
--
ALTER TABLE `pharmacy_expense`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `pharmacy_expense_category`
--
ALTER TABLE `pharmacy_expense_category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `pharmacy_payment`
--
ALTER TABLE `pharmacy_payment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1981;

--
-- AUTO_INCREMENT for table `pharmacy_payment_category`
--
ALTER TABLE `pharmacy_payment_category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `receptionist`
--
ALTER TABLE `receptionist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `risk_factor_elements`
--
ALTER TABLE `risk_factor_elements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `slide`
--
ALTER TABLE `slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sms`
--
ALTER TABLE `sms`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `sms_settings`
--
ALTER TABLE `sms_settings`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `template_fields`
--
ALTER TABLE `template_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `time_schedule`
--
ALTER TABLE `time_schedule`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `time_slot`
--
ALTER TABLE `time_slot`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2333;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=817;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=819;

--
-- AUTO_INCREMENT for table `vital_symptoms`
--
ALTER TABLE `vital_symptoms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `website_settings`
--
ALTER TABLE `website_settings`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
