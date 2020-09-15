-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2020 at 04:45 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hdpl_finm`
--

-- --------------------------------------------------------

--
-- Table structure for table `admintable`
--

CREATE TABLE `admintable` (
  `uname` varchar(25) NOT NULL,
  `pwd` varchar(25) NOT NULL,
  `control` varchar(25) NOT NULL,
  `ipaddress` longtext NOT NULL,
  `lastdatetimelogin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admintable`
--

INSERT INTO `admintable` (`uname`, `pwd`, `control`, `ipaddress`, `lastdatetimelogin`) VALUES
('aakash', 'aakash123', 'developer', '', '0000-00-00 00:00:00'),
('ankit', 'ankit123', 'developer', '103.251.59.175', '2020-05-01 10:26:43'),
('jushika', 'jushika123', 'marketing', '', '0000-00-00 00:00:00'),
('MyAdmin', 'hello1', 'admin', '::1', '2020-07-16 14:45:24'),
('parth', 'parth123', 'developer', '', '0000-00-00 00:00:00'),
('T1', 'T1', 'admin', '150.107.232.233', '2020-05-18 11:43:18'),
('vishnu', 'vishnu123', 'developer', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendant`
--

CREATE TABLE `tbl_attendant` (
  `attendant_id` int(11) NOT NULL,
  `attendant_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_attendant`
--

INSERT INTO `tbl_attendant` (`attendant_id`, `attendant_name`) VALUES
(2, 'NIRAL SHAH'),
(3, 'Jusika'),
(4, 'DIpal'),
(5, 'BNI');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

CREATE TABLE `tbl_booking` (
  `booking_id` int(11) NOT NULL,
  `booking_date` date DEFAULT NULL,
  `shipper_code` varchar(1000) DEFAULT NULL,
  `invoice_no` varchar(2000) DEFAULT NULL,
  `rate` varchar(20) DEFAULT NULL,
  `charge` varchar(20) DEFAULT NULL,
  `total_amount` varchar(20) DEFAULT NULL,
  `gst_charge` varchar(20) DEFAULT NULL,
  `net_amount` varchar(20) DEFAULT NULL,
  `received` varchar(20) DEFAULT NULL,
  `credit` varchar(20) DEFAULT NULL,
  `website_link` varchar(10000) DEFAULT NULL,
  `entrypersonname` varchar(20) DEFAULT NULL,
  `attendant_id` int(11) DEFAULT NULL,
  `proforma_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_booking`
--

INSERT INTO `tbl_booking` (`booking_id`, `booking_date`, `shipper_code`, `invoice_no`, `rate`, `charge`, `total_amount`, `gst_charge`, `net_amount`, `received`, `credit`, `website_link`, `entrypersonname`, `attendant_id`, `proforma_id`) VALUES
(142, '2020-05-04', '2', NULL, '7000', '0', '7000', '1260', '8260', '0', '0', '', 'MyAdmin', 2, 0),
(143, '2020-05-07', '2', NULL, '7000', '0', '7000', '1260', '8260', '0', '0', '', 'MyAdmin', 2, 11);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cash`
--

CREATE TABLE `tbl_cash` (
  `cash_id` int(11) NOT NULL,
  `service_confirmation_id` int(11) NOT NULL,
  `entry_person_id` int(11) NOT NULL,
  `entry_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cash`
--

INSERT INTO `tbl_cash` (`cash_id`, `service_confirmation_id`, `entry_person_id`, `entry_date`) VALUES
(10, 5, 2, '2020-08-24'),
(11, 9, 2, '2020-08-25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_company`
--

CREATE TABLE `tbl_company` (
  `companyId` int(11) NOT NULL,
  `CompanyName` varchar(200) NOT NULL,
  `CompanyAddress` longtext NOT NULL,
  `CompanyGstNo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_company`
--

INSERT INTO `tbl_company` (`companyId`, `CompanyName`, `CompanyAddress`, `CompanyGstNo`) VALUES
(1, 'ICED INFOTECH', '402, Shubham Complex, Nanpura<br>\r\nSurat - 395001<br>\r\nPhone +91 9898574094<br>\r\ninfo@icedinfotech.com | www.icedinfotech.com<br><br>\r\n<b>Account No :</b> 1115102000008013<br><br>\r\n<b>IFSC : </b>IBKL0001115', '24AWXPS5820K1ZS'),
(2, 'ICED INFOTECH', '402, Shubham Complex, Nanpura<br>\r\nSurat - 395001<br>\r\nPhone +91 9898574094<br>\r\ninfo@icedinfotech.com | www.icedinfotech.com<br><br>\r\n<b>Account No :</b> 1115102000008013<br><br>\r\n<b>IFSC : </b>IBKL0001115', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(50) DEFAULT NULL,
  `customer_address` varchar(200) DEFAULT NULL,
  `customer_pincode` varchar(20) DEFAULT NULL,
  `customer_city` varchar(50) DEFAULT NULL,
  `customer_phone1` varchar(15) DEFAULT NULL,
  `customer_phone2` varchar(15) DEFAULT NULL,
  `customer_email` varchar(50) DEFAULT NULL,
  `payment_type` varchar(50) DEFAULT NULL,
  `gst_type` varchar(50) DEFAULT NULL,
  `gst_no` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`customer_id`, `customer_name`, `customer_address`, `customer_pincode`, `customer_city`, `customer_phone1`, `customer_phone2`, `customer_email`, `payment_type`, `gst_type`, `gst_no`) VALUES
(2, 'Pearl Fashions Pvt. Ltd.', '5032, 5th Floor, Golden Plaza Market, Nr. Kinnary Cinema', '395002', 'Surat', '0261-2340342', '', 'pearlindy@yahoo.co.in', 'cheque', 'UTGST', '24AACCP1800E1Z5'),
(3, 'Mistry and Associates Building Services Ltd', '20 Hollyfield\r\nHatfield\r\n', 'AL10 8LW', 'UK', '', '07891256468', 'info@maabsd.com', 'cheque', 'CGST/SGST', ''),
(4, 'Karma Trendz Private Limited', '2046-49, Second Floor, Adarsh Market-2, Ring Road,', '395002', 'Surat', '261 391 5000', '9099042000', 'info@karmatrendz.in', 'cheque', 'CGST/SGST', '24AAFCK0997G1ZF'),
(5, 'Navratna Trading Company', 'Navratna House, 8/1604, Gopipura Main Road, Hanuman Char Raasta, Gopipura, Gopipura Main Road', '395001', 'Surat', '', '7874130888', 'navratnatrade@gmail.com', 'cheque', 'CGST/SGST', '24AAIFN7548N1ZN'),
(6, 'OM TOURS & TRAVELERS', 'Plot No -20, Tirupati Nagar Society, L.H. Road, Varachha Road', '395006', 'Surat', '', '8758343332', 'omtourstravelers@gmail.com', 'cheque', 'CGST/SGST', '24BJYPP5216K1ZL'),
(7, 'Univastra Fashion', 'G-3335-36, 1st Floor Millenium Textile Market, Ring Road', '395002', 'Surat', '', '+91 93772 33226', 'sales@univastra.com', 'cheque', 'CGST/SGST', '24AACFU8347E1Z6'),
(8, 'R.K. Events', 'Unit No-16, G.I.D.C. Khatodra, B/H J.K. Tower, Ring Road', '395002', 'Surat', '', '9099922260', 'info@rkevents.co', 'cheque', 'CGST/SGST', '24BLFPS0534N1ZW'),
(9, 'Nipun Uttambhai Prajapati', 'Ground floor, Shop No - 9, Mrugshirsh building - A, Nani Bahuchraji, Ved Road', '395004', 'Surat', '', '9979240042', 'nipunconsultant@gmail.com', 'cheque', 'CGST/SGST', '24ABBPP2401N2ZU'),
(10, 'SHRI SHAKTI CONSIGNMENTS SERVICES PRIVATE LIMITED', 'JG-4, Japan Market, Opp. Lineor Bus Stop,  Delhi Gate , Ring Road', '395002', 'Surat', '', '9725002229', 'sscspl14@gmail.com', 'cheque', 'CGST/SGST', '24AAUCS1112L1Z8'),
(11, 'Shailesh Patel Corporation', 'L-46 Nandanvan Shopping Center,\r\nOpp.Nagina Wadi,Sumul Dairy Rd', '395004', 'Surat', '+91-261-2486646', '+91 9825166486', 'shaileshpatelcorporation@gmail', 'cheque', 'CGST/SGST', '24AKLPP7319N1ZJ'),
(12, 'DECCAN IRRIGATION PRIVATE LIMITED', '112,Srusti Complex, NH8', '394185', 'Kamrej', '9825044419', '', 'deccanipl@yahoo.in', 'cheque', 'CGST/SGST', '24AADCD5404D1ZA'),
(13, 'R T Vankawala', 'Bhagatalao Main Road, Gopipura', '395003', 'Surat', '', '9824160701', '', 'cheque', 'CGST/SGST', '24AAEFR9467L1ZL'),
(14, 'Mayank Vashi', '2-Navsari High School Complex,\r\nDudhia Talao,', '396445', 'Navsari', '', '9998012800', '', 'cheque', 'CGST/SGST', '24ABOPV8978K1ZG'),
(15, 'HDPL Diamond Tools Trading Co.', 'A6 Shyamal Bldg,\r\nKohinoor Road,\r\nMini Bazaar,\r\nVarachha', '395006', 'Surat', '0261-2560600', '', 'info@hdpltools.com', 'cheque', 'CGST/SGST', '24AADFH4187Q1ZV'),
(16, 'High Seas Worldwide Private Limited', '6th Floor, 601/A, Center Point', '395001', 'Surat', '', '9374582726', 'inquiry@hswindio.com', 'cheque', 'CGST/SGST', '24AADCH1798N2Z3'),
(17, 'D R PAINTS', '6 Jai Shree Jalaram Industrial society, Near Navjivan Circle Udhna Magdalla Road', '395017', 'Surat', '', '9913935351', 'zubinch28@gmail.com', 'cheque', 'CGST/SGST', '24AOKPC7487D1ZX'),
(18, 'Pratik Silk Mills Pvt. Ltd.', 'Plot No : B 102 - 105, Central Park,', '394221', 'Surat', '', '', '', 'cheque', 'CGST/SGST', '24AACCP9509Q1ZU'),
(19, 'EPROMPT ENTERPRISE', '5, Mahalaxmi Industrial Society-2, Near Bamroli Bridge, 120 Feet,, Bamroli Rd, Pandesara, Udhna,', '394210', 'Surat', '', '09825118183', '', 'cheque', 'CGST/SGST', '24AJXPS4400J1ZU'),
(20, 'Precious Enterprises  ', 'S-8, Bejanwala Complex, Tadwadi, Rander Road ', '395009', 'Surat', '9998819325', '9998819325', 'meghalpandya19@gmail.com', 'cheque', 'CGST/SGST', '24AXNPP3849G1Z3'),
(21, 'White Pearl Developers', '202, Amarkruti Apartment, Nanpura', '395001', 'Surat', '', '', '', 'cheque', 'CGST/SGST', '24AABFW6215G2ZD'),
(22, 'Wall Space Architects', '202, Amarkruti Apartment, Nanpura', '395001', 'Surat', '', '9825728888', '', 'cheque', 'CGST/SGST', ''),
(23, 'Deep Breath Architecture', '908, Icon Business Center, Opp. Central Mall, Dumas Road', '395007', 'Surat', '', '9825045687', '', 'cheque', 'CGST/SGST', '24APPPP5427GIZN'),
(24, 'Vishwa Prints', '2nd Floor, Ranchhod Ratna Building,\r\nOpp Maniyara Sheri, Mahidharpura', '395003', 'Surat', '9825149664', '', '', 'cheque', 'CGST/SGST', '24ABYPK6561H1Z5'),
(25, 'Maruti Enterprise', 'A-20,Tas wadi industrial estate, b/h Umiya Dham Circle,\r\nA.K.road', '395008', 'surat', '', '09825138236', 'info@diatech.co.in', 'cheque', 'CGST/SGST', '24AFXPP7591P1Z4'),
(26, 'Bee Dee & Co.', '6, Gajjar Building, Opp. T&TV High School, Nanpura', '395001', 'Surat', '', '9824311884', 'parthbhavsarbd@gmail.com', 'cheque', 'CGST/SGST', '24AAUPB6414F1ZW'),
(27, 'Vinay Coldrinks', 'Opp. Ramji Temple, Mota Bazaar', '396001', 'Valsad', '', '9408787600', '', 'cheque', 'CGST/SGST', '24AARPD9300R1Z9'),
(28, 'The Proxperts ', '101, \r\nRegent Square\r\nBehind Dmart\r\nAdajan', '395009', 'Surat', '', '9022068253', '', 'cheque', 'CGST/SGST', '24AANFT2565J1ZT'),
(29, 'Bharatkumar Amrutlal Lakdawala', '1-2186/B, 1st Floor, \"Shyam Sadan\" Building, \r\nNear Makkai Pool, \r\nNanpura Main Road,', '395001', 'Surat', '', '9925599499', '', 'cheque', 'CGST/SGST', '24ACMPL 6639C1ZL'),
(30, 'Vedansh Life Style', 'A-13, 3rd Floor, Central Park, Pandesara', '394221', 'Surat', '', '9462808000', 'vedanshilpa@gmail.com', 'cheque', 'CGST/SGST', '24AEEPA5397J2ZF'),
(31, 'Kingsman Solution Pvt. Ltd.', '711, Brigade Towers, Brigade road, Shanthala Nagar,', '560025', 'Bangalore', '', '7204011779', '', 'cheque', 'IGST', '29AAFCK8378K1ZP'),
(32, 'Kaagaz Press LLP', 'B-1/2, Gate No -1, Hojiwala Industrial Estate, Road No-8, Sachin Palsana Road, Vanz', '394210', 'Surat', '', '9892049103', '', 'cheque', 'CGST/SGST', '24AASFK6786B1ZZ'),
(33, 'Shethna Care', 'Mahidharpura,', '395003', 'Surat', '', '9898473347', '', 'cheque', 'CGST/SGST', '24CRAPS4151B1Z8'),
(34, 'Hotel Akash', ' Opp. Ayurvedic Hospital, Near Railway Station Road, Lal Darwaja Station Rd', '395003', '', '', '93747 00283', 'hotelakash_surat@yahoo.co.in', 'cheque', 'CGST/SGST', '24AAIFH0247E1ZU'),
(35, 'Silverstone Technologies India Pvt. Ltd.', 'C-16/17 City industrial estate\r\nbehind swaminarayan mandir, city industrial estate, udhna', '394210', 'SURAT', '9727777854', '', '', 'cheque', 'CGST/SGST', '24AAMCS2062D1ZM'),
(36, '<p>vishnu</p>\r\n', '<p>Sdsdsdsjn&nbsp; ddsvdcx</p>\r\n', '', '', '', '77777777', 'bcxjkvx', '', '', ''),
(37, 'Vatsalya Holidays', '110, Sai Square Complex, Honey Park Road, Near Sareeta Dairy, Adajan, ', '395009', 'Surat', '', '093747 11141', '', 'cheque', 'CGST/SGST', '24AEYPT5010M1ZX'),
(38, 'NORTHERN STAR ENGINEERING', '601,Western BusinessPark, Beside J.h Ambani School, Vesu,Cross Road,', '395007', 'Surat', '', '9687266688', '', 'cheque', 'CGST/SGST', '24ALQPD0899P1ZD'),
(39, 'Arihant Digi Prints', 'Shed No.1, Italia Compound, ittbhathi, Goregaon ( East )', '400063', 'Mumbai', '', '9998965485', '', 'cheque', 'IGST', 'GST 27AAJFA8412H1ZH'),
(40, 'Vansia Consultancy', '325, SNS Business Hub, Vesu', '395007', 'Surat', '', '9374777727', '', 'cheque', 'CGST/SGST', '24adlpv2559f1z9'),
(41, 'SHRUTI FASHIONS PVT.LTD.', 'Plot no 328, \r\nRoad no 3. \r\nSachin GIDC', '', 'Surat', '', '9825127753', '', 'cheque', 'CGST/SGST', '24AAHCS9273K1ZT'),
(42, 'Crystal Inks and Coatings', 'J-103/3, Engineering Zone, GIDC,Sarigam', '396155', 'Valsad', '', '9924985395', 'crystalinksoffice@gmail.com', 'cheque', 'CGST/SGST', '24AAlFC3943J1ZF'),
(43, 'HP WEALTH CREATOR', 'B-209, DIAMOND WORLD, MINI BAZAR, VARACHHA ROAD\r\n', '395006', 'Surat', '', '9825285955', 'hpwealth87@gmail.com', 'cheque', 'CGST/SGST', '24ANYPP3189Q1ZQ'),
(44, 'goldeneyeshot.com', '608, 6th Floor, Vishwakarma Arcade, Majura Gate, Ring Road', '395002', 'Surat', '', '9978929168', '', 'cheque', 'CGST/SGST', ''),
(45, 'Good Luck Break Down Service', 'Shop no.1,2,3 Bhagwati Complex,National Highway 8, Opposite CNG Pump,', '394327', 'Kadodara', '', '98241 88786', '', 'cheque', 'CGST/SGST', '24AUVPP0429K'),
(46, 'Anant Vyas & Co.', '1/833, Nanpura', '395001', 'Surat', '', '9824147659', 'anantvyasandco1@gmail.com', 'cheque', 'CGST/SGST', '24ABBPV0661J2ZM'),
(47, 'Mook Badhir Vikas Trust', 'Ambikaniketan, Athwalines', '395007', 'Surat', '02612259448', '', 'mookbadhir@gmail.com', 'cheque', 'CGST/SGST', ''),
(48, 'Surya Mattresses Pvt. Ltd.', 'Plot No : I-45, Road No : 6-IB, New G.E.B. Road, Sachin', '394230', 'Surat', '', '937799110', '', 'cheque', 'CGST/SGST', '24AAWCS2395H1ZS'),
(49, 'Satyog Trading Co.', 'A10/7 Paikee, Rd No 3, Beside Dharti Namkeen, Udhna Udhyog Nagar', '394210', 'Surat', '0261 227 7421', '', '', 'cheque', 'CGST/SGST', '24AAPFS2679J1ZL'),
(50, 'Shreeji Electricals', 'Plot No : 55, Vinay Nagar, Madhi ni Khamni Road, Opp. Guru Dwara, Udhna main Road', '394210', 'Surat', '', '9825406272', '', 'cheque', 'CGST/SGST', '24AAUFS2363Q1ZD'),
(51, 'Hitech Design Consultancy', '202, Amar Shilp Apt, Timaliyawad, Nanpura', '395009', 'Surat', '02612472368', '', 'hitechdesign_1@yahoo.co.in', 'cheque', 'CGST/SGST', '24AABFH4434Q1Z7'),
(52, 'Shreeji Marketing', '23, Hari Om Industry, Nr. Shantinath Mill, Navjivan Circle, Udhna Magdalla Road', '395017', 'Surat', '', '9428629314', '', 'cheque', 'CGST/SGST', '24APYPP6999N1ZC'),
(53, 'Dreamz India', '1054, Universal, Textile Market Ring Rd, New Textile Market', '395002', 'Surat', '', '', '', 'cash', 'CGST/SGST', '24AAKFD3452B1ZX'),
(54, 'Inoventive Filaments Pvt Ltd', 'Plot no 143 near pandesara Police Station pandesara GIDC', '394221', 'Surat', '', '9173773270', '', 'cheque', 'CGST/SGST', '24AADCN0213C1ZD'),
(55, 'The Compu Seconds', 'G- 7/8 Ascon plaza\r\nB/h. BHULKA BHAVAN SCHOOL\r\nAnand Mahal road\r\nAdajan ', '395009', 'Surat', '0261-2731040', '9898543092', 'sales@compu2nd.in', 'cheque', 'CGST/SGST', '24AEDPS0796J1Z6'),
(56, 'AMAAN TOURS', 'GROUND FLOOR, G 6, DECENT COMPLEX, TAROTA\r\nBAZAR', '396445', 'Navsari', '', '9227860000', 'info@amaantours.in', 'cheque', 'CGST/SGST', '24ABXPR3789H1ZR'),
(57, 'Pramukh Opticals', '6-B, Kakadia Complex,\r\nOpp Citi Bank\r\nGhod dod Road', '395007', 'Surat', '0261 225 6425', '9909926434', 'info@pramukhoptical.com', 'cheque', 'CGST/SGST', '24AATFP9329C1ZY'),
(58, 'Shree Rangkala Glass Design Pvt. Ltd.', '203,204 Nathubhai Towers, Opp. Dhru Motors, Udhna Main Road, Udhna', '394210', 'Surat', '', '09374276246', '', 'cheque', 'CGST/SGST', '24AAYCS7630K1ZN'),
(59, 'Shree Gurudev Supreme Insulation', ' \"Atash\" Building Opp. Jogani Mata Temple,\r\nBeside Surat Peoples Bank,\r\nTimaliyawad Nanpura.', '395001', 'Surat', '', '', '', 'cheque', 'CGST/SGST', '24AAVPV3295M1ZN'),
(60, 'Amrut Agro & Food Processing', 'Bhojapara,', '', 'Gondal', '', '9974400999', '', 'cheque', 'CGST/SGST', '24AAPFA6346Q1ZT'),
(61, 'KEJRIWAL JEWELLERS', '1ST FLOOR, OFFICE NO 106, JIN SHANTI, MAHIDHARPURA,HIRA\r\nBAZAR', '395003', 'Surat', '', '9016334429', '', 'cheque', 'CGST/SGST', '24ANRPK9829K1Z7'),
(62, 'Suraj Tyre Care Pvt. Ltd.', 'Plot no : 306, Bhatpore GIDC,\r\nOpp. ONGC Company,\r\nIchhapore', '394270', 'Surat', '9879164468', '', '', 'cheque', 'CGST/SGST', '24AATCS6991G1ZN'),
(63, 'M/S Rubtech Reclaim Pvt. Ltd.', 'Plot no : 104/9/2,\r\nPalej, GIDC, Palej', '', 'Bharuch', '9978937073', '', '', 'cheque', 'CGST/SGST', '24AAHCR1414R1Z5'),
(64, 'Raavee Exeem', 'Office No : 712, Empire State Building, Ring Road', '395002', 'Surat', '', '', '', 'cheque', 'CGST/SGST', '24AAYFR3440F1Z1'),
(65, 'Vinay Cold Drink House', ' Opp. Ramji Temple, M.G. Road.', '396001', 'Valsad', '', '8866441307', '', 'cheque', 'CGST/SGST', '24AARPD9300R1Z9'),
(66, 'Thread Bucket Studio LLP', 'South Side, Ground Floor, First Floor, Plot No : A/15/4, Udhna Sangh, Udhna Udhyog Naga, Udhna', '394210', 'Surat', '', '', '', 'cheque', 'CGST/SGST', '24AAKFT0982E1Z6'),
(67, 'JUWEL ENGINEERING SERVICES', 'INFINITY BUSINESS HUB, 401, PALANPUR CANAL ROAD,\r\nPALANPOR', '395007', 'Surat', '', '', '', 'cheque', 'CGST/SGST', '24ANFPA7697B1Z6'),
(68, 'Amrut Agro & Food Processing', 'Bhojapara', '', '', '', '9974400999', '', 'cheque', 'CGST/SGST', '24AAPFA6346Q1ZT'),
(69, 'Shreeji Energy Solution', 'Plot No : 55, Ground Floor, Vinay Nagar, Opp Guru Dwara, Madhi Ni Khamni Road, Udhna', '394210', 'Surat', '', '', '', 'cheque', 'CGST/SGST', '24ACXFS5496F1ZD'),
(70, 'AIMS COMMUNICATIONS AND SECURITY SYSTEMS', 'Abrama Village A-23, Pramukh Sannidhya', '396002', 'Valsad', '', '9979436496', '', 'cheque', 'CGST/SGST', '24AAUFA9882A1Z6'),
(71, 'Swagat Management', 'Gopi Vatika, Nr. Manibhadra Heights, B/H L.P. Savani School, Canal Road, Vesu', '395007', 'Surat', '', '', '', 'cheque', 'CGST/SGST', '24ACIFS4885R1Z4'),
(72, 'RajGreen Infralink LLP', 'Venilla Sky, Opp. C B Patel Health Club, B/S Maniba Party Plot, VIP Road, Vesu', '395007', 'Surat', '0261 2796400', '', '', 'cheque', 'CGST/SGST', '24AAVFR8064N1Z9'),
(73, 'INFINITI EVENT AND TRAVEL MANAGEMENT', '3007 TO 3011, SHANKAR PLAZA, NANPURA', '395001', 'Surat', '', '', 'acc.infinitieventandtravel@gma', 'cheque', 'CGST/SGST', '24ADPPS0221F1ZT'),
(74, 'GREEN SS WATER TANK LLP', 'PLOT NO-70/1, PAREKH ESTATE, NR.SHANTINATH MILL,\r\nALTHAN', '395017', 'Surat', '', '', 'greensswatertank@gmail.com', 'cheque', 'CGST/SGST', '24AAQFG3675B1ZF'),
(75, 'Hotel Akash', 'Lal Darwaja main Road', '395003', 'Surat', '0261-2490316', '', 'hotelakash_surat@yahoo.co.in', 'cheque', 'CGST/SGST', '24AAIFH0247E1ZU'),
(76, 'Clean Sheen Cleaning Services Pvt. Ltd.', 'A-402, Surya Flats, Anand Mahal Road, Adajan', '395009', 'Surat', '', '', 'info.cleansheencleaning@gmail.', 'cheque', 'CGST/SGST', '24AAHCC5124H1ZY'),
(77, 'INOCI Marketing', '181, VISHAL NAGAR,NR BHATAR TENAMENT,\r\nBHATAR', '395017', 'Surat', '', '', '', 'cheque', 'CGST/SGST', '24BBZPJ0212Q1Z9'),
(78, 'Sangam Creation', 'G-15, Narayan Nagar Ind. Estate, Parvat Gam', '395010', 'Surat', '', '9825465476', '', 'cheque', 'CGST/SGST', '24ABNPS6868A1ZC'),
(79, 'Abhinandan Glow', 'Factory No 1, TATA Carewell & Infrastructure, Gundlav X Road, ', '396001', 'Valsad', '', '', 'abhinandanglow@gmail.com', 'cheque', 'CGST/SGST', '24ABNFA7650C1ZL'),
(80, 'Sumtinath Holidays', 'Gopipura', '395001', 'Surat', '', '9978950049', '', 'cheque', 'CGST/SGST', '24AEEPJ6832M1ZB'),
(81, 'Smart Alkaline & Acidic Water Ionizer', 'Nanpura', '395001', 'Surat', '', '', '', 'cheque', 'NOGST', ''),
(82, 'R B Hotels Private Limited', 'Lal Darwaja Main Road', '395003', 'Surat', '', '9825120360', '', 'cheque', 'CGST/SGST', '24AABCR1164L1ZG'),
(83, 'CHIPS INTERNATIONAL', '316 Classic Complex,\r\n Opp A.V.Sons\r\n Nr Parle Point,Ghod Dod Road', '395007', 'Surat', '', '9998145149', '', 'credit', 'CGST/SGST', '24BXIPP5841E1ZF'),
(84, 'IESHA JEWELS PRIVATE LIMITED', 'NO.2,201 MARUTI CHAMBERS, PIPLASHERI, MAHIDHARPURA, ', '395003', 'Surat', '', '9825882168', '', 'cheque', 'CGST/SGST', '24AADCI2192K1ZJ'),
(85, 'ARIHANT CORPORATION', 'UNIT-||, P-37,38, SAYAN TEXTILE PARK, ICHHAPORE', '', 'SURAT', '', '9998968382', '', 'cheque', 'CGST/SGST', '24AINPJ7086N1ZJ'),
(86, 'MOOK BADHIR VIKAS TRUST', 'PARLE POINT', '', 'SURAT', '', '', '', 'Select Type', 'NOGST', ''),
(87, 'Metas of Seventh-day Adventist', 'Athwalines', '395001', 'Surat', '', '', '', 'cheque', 'NOGST', ''),
(88, 'FIRSTCHOICE ADVERTISING', 'NANPURA', '395001', 'SURAT', '', '9512010152', '', 'cheque', 'CGST/SGST', '24BTFPS5626H1Z1'),
(89, 'CARE CONSULTANT', 'UG-5, FOUNTAIN PLAZA, Nr. LAXMI CINEMA, Fuwara St', '396445', 'Navsari', '', '', '', 'cheque', 'CGST/SGST', '24ASGPP7024F1ZV'),
(90, 'Alok Suit', 'C-3144 ,Radha Krishna Textile market, Ring Road', '395002', 'Surat', '', '9825118427', 'alok@gmail.com', 'cash', 'NOGST', ''),
(91, 'ThinkLoud Interactive & Animation', ' Shop no. 2, 7/3605, Shree Ram Apt., Rampura Main road', '395003', 'Surat', '7405505961', '7405505961', 'contact@thinkloudinteractive.com', 'cheque', 'CGST/SGST', '24APDPJ4316E1ZF'),
(97, '', '', '', '', '', '', '', 'cash', 'NOGST', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_expense`
--

CREATE TABLE `tbl_expense` (
  `expense_id` int(11) NOT NULL,
  `expense_name` varchar(100) NOT NULL,
  `expense_gst` float DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_expense`
--

INSERT INTO `tbl_expense` (`expense_id`, `expense_name`, `expense_gst`) VALUES
(1, 'Domain', 18),
(2, 'Hosting', 18),
(3, 'Salary', 0),
(4, 'AC', 28),
(5, 'Laptop', 18),
(6, 'Computer Service', 18),
(7, 'SMS', 18),
(8, 'SSL', 18);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inquiry`
--

CREATE TABLE `tbl_inquiry` (
  `inquiry_id` int(11) NOT NULL,
  `attendant_id` int(11) NOT NULL,
  `shipper_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_inquiry`
--

INSERT INTO `tbl_inquiry` (`inquiry_id`, `attendant_id`, `shipper_id`) VALUES
(2, 2, 93),
(5, 2, 90);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inquiry_detail`
--

CREATE TABLE `tbl_inquiry_detail` (
  `inquiry_detail_id` int(11) NOT NULL,
  `inquiry_id` int(11) NOT NULL,
  `title` text,
  `description` longtext NOT NULL,
  `meeting_document` longtext NOT NULL,
  `inquiry_stime` varchar(50) NOT NULL,
  `inquiry_etime` varchar(50) NOT NULL,
  `inquiry_color` varchar(15) NOT NULL,
  `entry_date` date NOT NULL,
  `entry_person_id` int(11) NOT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_inquiry_detail`
--

INSERT INTO `tbl_inquiry_detail` (`inquiry_detail_id`, `inquiry_id`, `title`, `description`, `meeting_document`, `inquiry_stime`, `inquiry_etime`, `inquiry_color`, `entry_date`, `entry_person_id`, `status`) VALUES
(2, 2, NULL, 'Dynamic Website', '65e678412ab16a41b62e46e20e8009c7.pdf,f161a19331dde68bcdf8de6a2966d991.pdf,6095eb0d18e076de2247a7a471aa41ab.pdf,', '2020-08-30 10:30:00', '2020-08-30 11:30:00', 'success', '2020-08-29', 2, 'Commplete'),
(3, 2, NULL, 'Discussion for pages in website', '4505cbf7c8a1b3972dab049b82e8c631.pdf,', '2020-08-31 12:00:00', '2020-08-31 13:00:00', 'primary', '2020-08-29', 2, 'Pending'),
(6, 2, NULL, '', '', '2020-09-01 10:00:00', '2020-09-01 10:15:00', 'success', '2020-08-29', 2, 'Pending'),
(7, 5, NULL, 'Social Media Post', '', '2020-09-02 16:00:00', '2020-09-02 16:15:00', 'success', '2020-08-29', 2, 'Pending'),
(19, 2, NULL, 'Social Media Post', '', '2020-09-03 00:00:00', '2020-09-03 01:00:00', 'success', '2020-09-01', 2, 'Pending'),
(20, 2, NULL, 'Social Media Post', '', '2020-09-04 09:00:00', '2020-09-04 09:15:00', 'success', '2020-09-02', 2, 'Pending'),
(21, 2, NULL, 'test event', '', '2020-09-04 04:00:00', '2020-09-04 04:15:00', 'danger', '2020-09-02', 2, 'Pending'),
(22, 2, NULL, '', '', '2020-09-04 00:00:00', '2020-09-05 00:00:00', 'info', '2020-09-02', 2, 'Pending'),
(23, 2, NULL, 'Test Event', '', '2020-09-03 08:03:00', '2020-09-03 08:18:00', 'info', '2020-09-02', 2, 'Pending'),
(27, 2, 'Website Designing', 'Description Goes Here', '', '2020-09-04 02:00:00', '2020-09-04 02:15:00', 'success', '2020-09-02', 2, 'Pending'),
(29, 2, 'Website Designing', 'test', '', '2020-09-04 01:15:00', '2020-09-04 01:30:00', 'success', '2020-09-02', 2, 'Pending'),
(30, 2, 'Website Designing', 'test', '', '2020-09-04 01:30:00', '2020-09-04 01:45:00', 'success', '2020-09-02', 2, 'Pending'),
(55, 2, 'Website Designing', 'test', '', '2020-09-05 00:00:00', '2020-09-06 00:00:00', 'success', '2020-09-04', 2, 'Pending'),
(56, 2, 'Website Designing', 'test', '', '2020-09-05 00:00:00', '2020-09-06 00:00:00', 'success', '2020-09-04', 2, 'Pending'),
(57, 2, 'Website Designing', 'test', '', '2020-09-05 10:30:00', '2020-09-05 10:45:00', 'success', '2020-09-05', 2, 'Pending'),
(58, 2, 'Website Designing', 'test', '', '2020-09-07 00:00:00', '2020-09-08 00:00:00', 'success', '2020-09-05', 2, 'Pending'),
(59, 2, 'Website Designing', 'test', '', '2020-09-07 01:00:00', '2020-09-07 01:15:00', 'success', '2020-09-05', 2, 'Pending'),
(67, 2, 'new project', 'test', '', '2020-09-08 00:00:00', '2020-09-09 00:00:00', 'success', '2020-09-07', 2, 'Pending'),
(68, 2, 'new project', 'test', '', '2020-09-08 00:00:00', '2020-09-09 00:00:00', 'success', '2020-09-07', 2, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice`
--

CREATE TABLE `tbl_invoice` (
  `invoice_id` int(11) NOT NULL,
  `service_confirmation_id` int(11) NOT NULL,
  `entry_person_id` int(11) NOT NULL,
  `entry_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_invoice`
--

INSERT INTO `tbl_invoice` (`invoice_id`, `service_confirmation_id`, `entry_person_id`, `entry_date`) VALUES
(4, 3, 2, '2020-08-08'),
(5, 6, 2, '2020-08-08'),
(6, 7, 2, '2020-08-13'),
(7, 9, 2, '2020-08-25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logo`
--

CREATE TABLE `tbl_logo` (
  `logo_id` int(11) NOT NULL,
  `image_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_logo`
--

INSERT INTO `tbl_logo` (`logo_id`, `image_name`) VALUES
(1, 'b480c74b682318c4622e68324e91ab1a.jpeg'),
(2, 'ae1d4905e687f42cd32054ed917ab5ff.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_history`
--

CREATE TABLE `tbl_payment_history` (
  `payment_id` int(11) NOT NULL,
  `service_confirmation_id` int(11) NOT NULL,
  `entry_person_id` int(11) NOT NULL,
  `paid_amount` float NOT NULL,
  `payment_date_time` datetime NOT NULL,
  `payment_mode` varchar(50) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_payment_history`
--

INSERT INTO `tbl_payment_history` (`payment_id`, `service_confirmation_id`, `entry_person_id`, `paid_amount`, `payment_date_time`, `payment_mode`, `description`) VALUES
(1, 38, 2, 1000, '2020-07-28 06:49:26', 'CASH', NULL),
(2, 38, 2, 1000, '2020-07-28 06:59:24', 'CHEQUE', NULL),
(3, 38, 2, 2012, '2020-07-28 07:04:22', 'OTHER', 'Deposited in XYZ Bank'),
(4, 39, 2, 700, '2020-07-29 06:23:38', 'CASH', ''),
(5, 40, 2, 2000, '2020-07-29 07:32:14', 'CASH', 'Advance'),
(6, 1, 2, 1000, '2020-08-01 04:47:45', 'CASH', 'Paytm'),
(7, 4, 2, 2596, '2020-08-05 06:36:33', 'CHEQUE', 'Deposited in XYZ Bank'),
(8, 2, 2, 11000, '2020-08-13 04:55:06', 'CHEQUE', ''),
(9, 7, 2, 1298, '2020-08-13 05:38:11', 'CHEQUE', ''),
(10, 8, 2, 2832, '2020-08-13 06:22:50', 'CASH', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL,
  `name` varchar(5000) NOT NULL,
  `desc` varchar(1000) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `is_renew` varchar(3) NOT NULL,
  `gst_rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `name`, `desc`, `code`, `is_renew`, `gst_rate`) VALUES
(1, 'Static Website', '', '998314', 'yes', 18),
(2, 'Dynamic Website', '', '998314', 'yes', 18),
(3, 'Hosting Renewal', '', '998315', 'yes', 18),
(4, 'Domain Renewal', '', '998315', 'yes', 18),
(5, 'Domain', '', '998315', 'yes', 18),
(6, 'Hosting', '', '998315', 'yes', 18),
(7, 'Social Media Marketing', '', '998319', 'no', 18),
(8, 'Graphic Designing', '', '998391', 'no', 18),
(9, 'E-Commerce Web Development', '', '998315', 'yes', 18),
(10, 'Unlimited Hosting', 'Unlimited Hosting', '', 'no', 18),
(11, 'Paid Social Media Ads', '', '998319', 'no', 18),
(12, 'Local S.E.O.', 'Search Engine optimization', '998313', 'no', 18),
(13, 'Digital Card', '', '998313', 'yes', 18),
(14, 'Support', '', '998313', 'no', 18),
(15, 'Social Media Post', '', '998319', 'no', 18),
(16, 'Android App Development', '', '998314', 'no', 18),
(17, 'Web Application Development', '', '998314', 'no', 18),
(18, 'Paid Google Ad', '', '998319', 'no', 18),
(19, 'Ad Campaign Management', '', '998319', 'no', 18),
(20, 'G Suit Integration', '', '998319', 'no', 18),
(21, 'SSL Certificate', '', '998315', 'no', 18),
(22, 'Dynamic Website with SSL', '', '998314', 'no', 18);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_proforma`
--

CREATE TABLE `tbl_proforma` (
  `proforma_id` int(11) NOT NULL,
  `service_confirmation_id` int(11) NOT NULL,
  `entry_person_id` int(11) NOT NULL,
  `entry_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_proforma`
--

INSERT INTO `tbl_proforma` (`proforma_id`, `service_confirmation_id`, `entry_person_id`, `entry_date`) VALUES
(1, 4, 2, '2020-08-05'),
(2, 4, 2, '2020-08-07'),
(4, 6, 2, '2020-08-08'),
(5, 9, 2, '2020-08-25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_project`
--

CREATE TABLE `tbl_project` (
  `project_id` int(11) NOT NULL,
  `project_name` varchar(50) NOT NULL,
  `person_name` varchar(50) NOT NULL,
  `phone_name` varchar(50) NOT NULL,
  `email_id` int(11) NOT NULL,
  `status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_project_achknow`
--

CREATE TABLE `tbl_project_achknow` (
  `achknow_id` int(11) NOT NULL,
  `shipper_id` int(11) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `description` longtext NOT NULL,
  `work_date` date NOT NULL,
  `work_stime` varchar(15) NOT NULL,
  `work_etime` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_project_allocate`
--

CREATE TABLE `tbl_project_allocate` (
  `proAll_id` int(11) NOT NULL,
  `shipper_id` int(11) NOT NULL,
  `uname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_project_allocate`
--

INSERT INTO `tbl_project_allocate` (`proAll_id`, `shipper_id`, `uname`) VALUES
(3, 91, 'ankit');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_proservicelist`
--

CREATE TABLE `tbl_proservicelist` (
  `proservicelist_id` int(11) NOT NULL,
  `proforma_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `duration` varchar(10) DEFAULT NULL,
  `yorm` varchar(20) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `rate` int(11) DEFAULT NULL,
  `price` varchar(20) DEFAULT NULL,
  `remarks` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_proservicelist`
--

INSERT INTO `tbl_proservicelist` (`proservicelist_id`, `proforma_id`, `product_id`, `duration`, `yorm`, `qty`, `rate`, `price`, `remarks`) VALUES
(54, 11, 1, '12', 'Month', 1, 7000, '7000', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase`
--

CREATE TABLE `tbl_purchase` (
  `purchase_id` int(11) NOT NULL,
  `entry_person_id` int(11) NOT NULL,
  `expense_id` int(11) NOT NULL,
  `isGST` tinyint(4) DEFAULT '0',
  `amount` float NOT NULL,
  `gst_rate` float DEFAULT '0',
  `receipt_img` varchar(100) DEFAULT NULL,
  `description` text,
  `entry_date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_purchase`
--

INSERT INTO `tbl_purchase` (`purchase_id`, `entry_person_id`, `expense_id`, `isGST`, `amount`, `gst_rate`, `receipt_img`, `description`, `entry_date_time`) VALUES
(1, 2, 3, 0, 4000, 0, '', 'Vishnu', '2020-08-06 08:00:14'),
(2, 2, 2, 1, 3500, 18, '', 'Hosting Renew of Sanjivin for 3 Years', '2020-08-06 08:11:02'),
(3, 2, 4, 1, 30000, 28, '', 'AC for Office', '2020-08-06 08:18:58'),
(4, 2, 5, 1, 25000, 18, '', 'Laptop for Vasu', '2020-08-06 08:20:34'),
(5, 2, 5, 1, 25000, 18, '', 'Laptop for Vasu', '2020-08-06 08:21:17'),
(6, 2, 8, 1, 1400, 18, 'Screenshot (3).png', 'For Alok Suite', '2020-08-06 08:21:40');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_renewal`
--

CREATE TABLE `tbl_renewal` (
  `renewal_id` int(11) NOT NULL,
  `domain_name` varchar(50) NOT NULL,
  `server_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `renewal_date` date NOT NULL,
  `person_name` varchar(50) NOT NULL,
  `sms_no` varchar(20) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `renewal_amt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE `tbl_role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(2, 'Employee');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_server`
--

CREATE TABLE `tbl_server` (
  `server_id` int(11) NOT NULL,
  `server_name` varchar(50) NOT NULL,
  `server_username` varchar(50) DEFAULT NULL,
  `server_password` varchar(50) DEFAULT NULL,
  `server_link` text,
  `server_nameserver` text,
  `server_status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_server`
--

INSERT INTO `tbl_server` (`server_id`, `server_name`, `server_username`, `server_password`, `server_link`, `server_nameserver`, `server_status`) VALUES
(3, 'Iced', NULL, NULL, NULL, NULL, '1'),
(4, 'Laaveget', NULL, NULL, NULL, NULL, '1'),
(5, 'Zicasura', NULL, NULL, NULL, NULL, '1'),
(7, 'Abounder', NULL, NULL, NULL, NULL, '1'),
(8, 'sanjivin', NULL, NULL, NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_servicelist`
--

CREATE TABLE `tbl_servicelist` (
  `servicelist_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `duration` varchar(10) DEFAULT NULL,
  `yorm` varchar(20) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `rate` int(11) DEFAULT NULL,
  `price` varchar(20) DEFAULT NULL,
  `remarks` varchar(200) DEFAULT NULL,
  `renew_amt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_servicelist`
--

INSERT INTO `tbl_servicelist` (`servicelist_id`, `booking_id`, `product_id`, `duration`, `yorm`, `qty`, `rate`, `price`, `remarks`, `renew_amt`) VALUES
(42, 142, 1, '12', 'Month', 1, 7000, '7000', '', 2000),
(43, 143, 1, '12', 'Month', 1, 7000, '7000', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service_confirmation`
--

CREATE TABLE `tbl_service_confirmation` (
  `service_confirmation_id` int(11) NOT NULL,
  `shipper_id` int(11) NOT NULL,
  `entry_person_id` int(11) NOT NULL,
  `attendant_id` int(11) DEFAULT NULL,
  `entry_date` datetime NOT NULL,
  `confirmation_date` date DEFAULT NULL,
  `net_amount` float DEFAULT '0',
  `gst_charge` float DEFAULT '0',
  `total_amount` float DEFAULT '0',
  `credit_amount` float DEFAULT '0',
  `received_amount` float DEFAULT '0',
  `currency` varchar(100) DEFAULT 'INR'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_service_confirmation`
--

INSERT INTO `tbl_service_confirmation` (`service_confirmation_id`, `shipper_id`, `entry_person_id`, `attendant_id`, `entry_date`, `confirmation_date`, `net_amount`, `gst_charge`, `total_amount`, `credit_amount`, `received_amount`, `currency`) VALUES
(1, 90, 2, 2, '2020-08-01 16:13:45', '2020-08-01', 1000, 0, 2000, 1000, 1000, 'INR'),
(2, 2, 2, 2, '2020-08-01 16:14:43', '2020-08-01', 15000, 2700, 17700, 6700, 11000, 'INR'),
(3, 91, 2, 2, '2020-08-01 16:42:47', '2020-08-01', 2400, 432, 2832, 2832, 0, 'INR'),
(4, 89, 2, 2, '2020-08-05 18:30:02', '2020-08-05', 10600, 1908, 12508, 9912, 2596, 'INR'),
(5, 90, 2, 2, '2020-08-08 17:51:58', '2020-08-08', 1600, 0, 2700, 2700, 0, 'INR'),
(6, 21, 2, 2, '2020-08-08 18:10:02', '2020-08-08', 2420, 435.6, 2855.6, 2879.2, 0, 'INR'),
(7, 92, 2, 2, '2020-08-13 17:19:20', '2020-08-13', 1100, 198, 1298, 0, 1298, 'USD'),
(8, 19, 2, 2, '2020-08-13 18:21:56', '2020-08-13', 2400, 432, 2832, 0, 2832, 'INR'),
(9, 42, 2, 2, '2020-08-25 20:20:07', '2020-08-25', 5000, 900, 5900, 5900, 0, 'INR');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service_inclusion`
--

CREATE TABLE `tbl_service_inclusion` (
  `service_inclusion_id` int(11) NOT NULL,
  `service_confirmation_id` int(11) NOT NULL,
  `entry_person_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `invoice_id` int(11) DEFAULT '0',
  `proforma_id` int(11) DEFAULT '0',
  `cash_id` int(11) DEFAULT '0',
  `short_desc` text,
  `description` text,
  `duration` int(11) DEFAULT NULL,
  `yorm` varchar(10) DEFAULT NULL,
  `quantity` int(11) DEFAULT '0',
  `service_rate` float DEFAULT '0',
  `gst` float DEFAULT '0',
  `gst_charge` float DEFAULT '0',
  `net_amount` float DEFAULT '0',
  `total_amount` float DEFAULT '0',
  `entry_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_service_inclusion`
--

INSERT INTO `tbl_service_inclusion` (`service_inclusion_id`, `service_confirmation_id`, `entry_person_id`, `product_id`, `invoice_id`, `proforma_id`, `cash_id`, `short_desc`, `description`, `duration`, `yorm`, `quantity`, `service_rate`, `gst`, `gst_charge`, `net_amount`, `total_amount`, `entry_date`) VALUES
(1, 1, 2, 13, 0, 0, 0, NULL, '', 1, 'Year', 2, 1000, 0, 0, 2000, 2000, '2020-08-01 16:13:57'),
(2, 2, 2, 2, 0, 0, 0, NULL, '', 1, 'Year', 1, 10000, 18, 1800, 10000, 11800, '2020-08-01 16:15:05'),
(3, 3, 2, 8, 4, 0, 0, NULL, '', 1, 'Year', 12, 2400, 18, 432, 2400, 2832, '2020-08-01 16:43:01'),
(4, 4, 2, 13, 0, 1, 0, NULL, '', 1, 'Year', 1, 1000, 18, 180, 1000, 1180, '2020-08-05 18:30:18'),
(5, 4, 2, 5, 0, 1, 0, NULL, '', 1, 'Year', 1, 1200, 18, 216, 1200, 1416, '2020-08-05 18:31:11'),
(6, 4, 2, 15, 0, 1, 0, NULL, '', 1, 'Year', 12, 2400, 18, 432, 2400, 2832, '2020-08-07 19:42:31'),
(7, 4, 2, 1, 0, 2, 0, NULL, '', 2, 'Year', 1, 5000, 18, 900, 5000, 5900, '2020-08-07 20:54:30'),
(8, 4, 2, 12, 0, 2, 0, NULL, '', 1, 'Year', 1, 1000, 18, 180, 1000, 1180, '2020-08-07 20:54:48'),
(9, 5, 2, 8, 0, 0, 10, NULL, '', 1, 'Year', 12, 100, 0, 0, 1200, 1200, '2020-08-08 17:52:16'),
(10, 5, 2, 5, 0, 0, 10, NULL, '', 1, 'Year', 1, 1500, 0, 0, 1500, 1500, '2020-08-08 17:53:00'),
(11, 6, 2, 3, 5, 4, 0, '', '', 1, 'Year', 1, 1300, 18, 234, 1300, 1534, '2020-08-08 18:10:14'),
(12, 6, 2, 7, 0, 0, 0, NULL, '', 1, 'Year', 1, 120, 18, 21.6, 120, 141.6, '2020-08-08 18:37:48'),
(13, 2, 2, 1, 0, 0, 0, NULL, '', 1, 'Year', 1, 5000, 18, 900, 5000, 5900, '2020-08-13 17:03:38'),
(14, 7, 2, 13, 6, 0, 0, NULL, '', 1, 'Year', 1, 1100, 18, 198, 1100, 1298, '2020-08-13 17:19:33'),
(15, 8, 2, 8, 0, 0, 0, NULL, '', 1, 'Year', 12, 200, 18, 432, 2400, 2832, '2020-08-13 18:22:10'),
(16, 6, 2, 4, 0, 0, 0, 'test desc', '', 1, 'Year', 1, 1000, 18, 180, 1000, 1180, '2020-08-25 20:16:31'),
(17, 9, 2, 1, 7, 5, 11, '', '', 1, 'Year', 1, 5000, 18, 900, 5000, 5900, '2020-08-25 20:20:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shipper`
--

CREATE TABLE `tbl_shipper` (
  `shipper_id` int(11) NOT NULL,
  `shipper_name` varchar(50) DEFAULT NULL,
  `shipper_address` varchar(200) DEFAULT NULL,
  `shipper_pincode` varchar(20) DEFAULT NULL,
  `shipper_city` varchar(50) DEFAULT NULL,
  `shipper_phone1` varchar(15) DEFAULT NULL,
  `shipper_mobile` varchar(15) DEFAULT NULL,
  `shipper_email` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `gst_type` varchar(50) DEFAULT NULL,
  `gst_no` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_shipper`
--

INSERT INTO `tbl_shipper` (`shipper_id`, `shipper_name`, `shipper_address`, `shipper_pincode`, `shipper_city`, `shipper_phone1`, `shipper_mobile`, `shipper_email`, `type`, `gst_type`, `gst_no`) VALUES
(2, 'Pearl Fashions Pvt. Ltd.', '  5032, 5th Floor, Golden Plaza Market, Nr. Kinnary Cinema', '395002', 'Surat', '0261-2340342', '', 'pearlindy@yahoo.co.in', 'cheque', 'UTGST', '24AACCP1800E1Z5'),
(3, 'Mistry and Associates Building Services Ltd', '20 Hollyfield\r\nHatfield\r\n', 'AL10 8LW', 'UK', NULL, '07891256468', 'info@maabsd.com', 'cheque', 'CGST/SGST', ''),
(4, 'Karma Trendz Private Limited', '2046-49, Second Floor, Adarsh Market-2, Ring Road,', '395002', 'Surat', '261 391 5000', '9099042000', 'info@karmatrendz.in', 'cheque', 'CGST/SGST', '24AAFCK0997G1ZF'),
(5, 'Navratna Trading Company', 'Navratna House, 8/1604, Gopipura Main Road, Hanuman Char Raasta, Gopipura, Gopipura Main Road', '395001', 'Surat', '', '7874130888', 'navratnatrade@gmail.com', 'cheque', 'CGST/SGST', '24AAIFN7548N1ZN'),
(6, 'OM TOURS & TRAVELERS', 'Plot No -20, Tirupati Nagar Society, L.H. Road, Varachha Road', '395006', 'Surat', '', '8758343332', 'omtourstravelers@gmail.com', 'cheque', 'CGST/SGST', '24BJYPP5216K1ZL'),
(7, 'Univastra Fashion', 'G-3335-36, 1st Floor Millenium Textile Market, Ring Road', '395002', 'Surat', '', '+91 93772 33226', 'sales@univastra.com', 'cheque', 'CGST/SGST', '24AACFU8347E1Z6'),
(8, 'R.K. Events', 'Unit No-16, G.I.D.C. Khatodra, B/H J.K. Tower, Ring Road', '395002', 'Surat', '', '9099922260', 'info@rkevents.co', 'cheque', 'CGST/SGST', '24BLFPS0534N1ZW'),
(9, 'Nipun Uttambhai Prajapati', 'Ground floor, Shop No - 9, Mrugshirsh building - A, Nani Bahuchraji, Ved Road', '395004', 'Surat', '', '9979240042', 'nipunconsultant@gmail.com', 'cheque', 'CGST/SGST', '24ABBPP2401N2ZU'),
(10, 'SHRI SHAKTI CONSIGNMENTS SERVICES PRIVATE LIMITED', 'JG-4, Japan Market, Opp. Lineor Bus Stop,  Delhi Gate , Ring Road', '395002', 'Surat', '', '9725002229', 'sscspl14@gmail.com', 'cheque', 'CGST/SGST', '24AAUCS1112L1Z8'),
(11, 'Shailesh Patel Corporation', 'L-46 Nandanvan Shopping Center,\r\nOpp.Nagina Wadi,Sumul Dairy Rd', '395004', 'Surat', '+91-261-2486646', '+91 9825166486', 'shaileshpatelcorporation@gmail', 'cheque', 'CGST/SGST', '24AKLPP7319N1ZJ'),
(12, 'DECCAN IRRIGATION PRIVATE LIMITED', '112,Srusti Complex, NH8', '394185', 'Kamrej', '9825044419', '', 'deccanipl@yahoo.in', 'cheque', 'CGST/SGST', '24AADCD5404D1ZA'),
(13, 'R T Vankawala', 'Bhagatalao Main Road, Gopipura', '395003', 'Surat', '', '9824160701', '', 'cheque', 'CGST/SGST', '24AAEFR9467L1ZL'),
(14, 'Mayank Vashi', '2-Navsari High School Complex,\r\nDudhia Talao,', '396445', 'Navsari', '', '9998012800', '', 'cheque', 'CGST/SGST', '24ABOPV8978K1ZG'),
(15, 'HDPL Diamond Tools Trading Co.', 'A6 Shyamal Bldg,\r\nKohinoor Road,\r\nMini Bazaar,\r\nVarachha', '395006', 'Surat', '0261-2560600', '', 'info@hdpltools.com', 'cheque', 'CGST/SGST', '24AADFH4187Q1ZV'),
(16, 'High Seas Worldwide Private Limited', '6th Floor, 601/A, Center Point', '395001', 'Surat', '', '9374582726', 'inquiry@hswindio.com', 'cheque', 'CGST/SGST', '24AADCH1798N2Z3'),
(17, 'D R PAINTS', '6 Jai Shree Jalaram Industrial society, Near Navjivan Circle Udhna Magdalla Road', '395017', 'Surat', '', '9913935351', 'zubinch28@gmail.com', 'cheque', 'CGST/SGST', '24AOKPC7487D1ZX'),
(18, 'Pratik Silk Mills Pvt. Ltd.', 'Plot No : B 102 - 105, Central Park,', '394221', 'Surat', '', '', '', 'cheque', 'CGST/SGST', '24AACCP9509Q1ZU'),
(19, 'EPROMPT ENTERPRISE', '5, Mahalaxmi Industrial Society-2, Near Bamroli Bridge, 120 Feet,, Bamroli Rd, Pandesara, Udhna,', '394210', 'Surat', '', '9825118183', '', 'cheque', 'CGST/SGST', '24AJXPS4400J1ZU'),
(20, 'Precious Enterprises  ', 'S-8, Bejanwala Complex, Tadwadi, Rander Road ', '395009', 'Surat', '9998819325', '9998819325', 'meghalpandya19@gmail.com', 'cheque', 'CGST/SGST', '24AXNPP3849G1Z3'),
(21, 'White Pearl Developers', '202, Amarkruti Apartment, Nanpura', '395001', 'Surat', '', '', '', 'cheque', 'CGST/SGST', '24AABFW6215G2ZD'),
(22, 'Wall Space Architects', '202, Amarkruti Apartment, Nanpura', '395001', 'Surat', '', '9825728888', '', 'cheque', 'CGST/SGST', ''),
(23, 'Deep Breath Architecture', '908, Icon Business Center, Opp. Central Mall, Dumas Road', '395007', 'Surat', '', '9825045687', '', 'cheque', 'CGST/SGST', '24APPPP5427GIZN'),
(24, 'Vishwa Prints', '2nd Floor, Ranchhod Ratna Building,\r\nOpp Maniyara Sheri, Mahidharpura', '395003', 'Surat', '9825149664', '', '', 'cheque', 'CGST/SGST', '24ABYPK6561H1Z5'),
(25, 'Maruti Enterprise', 'A-20,Tas wadi industrial estate, b/h Umiya Dham Circle,\r\nA.K.road', '395008', 'surat', '', '09825138236', 'info@diatech.co.in', 'cheque', 'CGST/SGST', '24AFXPP7591P1Z4'),
(26, 'Bee Dee & Co.', '6, Gajjar Building, Opp. T&TV High School, Nanpura', '395001', 'Surat', '', '9824311884', 'parthbhavsarbd@gmail.com', 'cheque', 'CGST/SGST', '24AAUPB6414F1ZW'),
(27, 'Vinay Coldrinks', 'Opp. Ramji Temple, Mota Bazaar', '396001', 'Valsad', '', '9408787600', '', 'cheque', 'CGST/SGST', '24AARPD9300R1Z9'),
(28, 'The Proxperts ', '101, \r\nRegent Square\r\nBehind Dmart\r\nAdajan', '395009', 'Surat', '', '9022068253', '', 'cheque', 'CGST/SGST', '24AANFT2565J1ZT'),
(29, 'Bharatkumar Amrutlal Lakdawala', '1-2186/B, 1st Floor, \"Shyam Sadan\" Building, \r\nNear Makkai Pool, \r\nNanpura Main Road,', '395001', 'Surat', '', '9925599499', '', 'cheque', 'CGST/SGST', '24ACMPL 6639C1ZL'),
(30, 'Vedansh Life Style', 'A-13, 3rd Floor, Central Park, Pandesara', '394221', 'Surat', '', '9462808000', 'vedanshilpa@gmail.com', 'cheque', 'CGST/SGST', '24AEEPA5397J2ZF'),
(31, 'Kingsman Solution Pvt. Ltd.', '711, Brigade Towers, Brigade road, Shanthala Nagar,', '560025', 'Bangalore', '', '7204011779', '', 'cheque', 'IGST', '29AAFCK8378K1ZP'),
(32, 'Kaagaz Press LLP', 'B-1/2, Gate No -1, Hojiwala Industrial Estate, Road No-8, Sachin Palsana Road, Vanz', '394210', 'Surat', '', '9892049103', '', 'cheque', 'CGST/SGST', '24AASFK6786B1ZZ'),
(33, 'Shethna Care', 'Mahidharpura,', '395003', 'Surat', '', '9898473347', '', 'cheque', 'CGST/SGST', '24CRAPS4151B1Z8'),
(34, 'Hotel Akash', ' Opp. Ayurvedic Hospital, Near Railway Station Road, Lal Darwaja Station Rd', '395003', '', '', '93747 00283', 'hotelakash_surat@yahoo.co.in', 'cheque', 'CGST/SGST', '24AAIFH0247E1ZU'),
(35, 'Silverstone Technologies India Pvt. Ltd.', 'C-16/17 City industrial estate\r\nbehind swaminarayan mandir, city industrial estate, udhna', '394210', 'SURAT', '9727777854', '', '', 'cheque', 'CGST/SGST', '24AAMCS2062D1ZM'),
(36, '<p>vishnu</p>\r\n', '<p>Sdsdsdsjn&nbsp; ddsvdcx</p>\r\n', '', '', '', '77777777', 'bcxjkvx', '', '', ''),
(37, 'Vatsalya Holidays', '110, Sai Square Complex, Honey Park Road, Near Sareeta Dairy, Adajan, ', '395009', 'Surat', '', '093747 11141', '', 'cheque', 'CGST/SGST', '24AEYPT5010M1ZX'),
(38, 'NORTHERN STAR ENGINEERING', '601,Western BusinessPark, Beside J.h Ambani School, Vesu,Cross Road,', '395007', 'Surat', '', '9687266688', '', 'cheque', 'CGST/SGST', '24ALQPD0899P1ZD'),
(39, 'Arihant Digi Prints', 'Shed No.1, Italia Compound, ittbhathi, Goregaon ( East )', '400063', 'Mumbai', '', '9998965485', '', 'cheque', 'IGST', 'GST 27AAJFA8412H1ZH'),
(40, 'Vansia Consultancy', '325, SNS Business Hub, Vesu', '395007', 'Surat', '', '9374777727', '', 'cheque', 'CGST/SGST', '24adlpv2559f1z9'),
(41, 'SHRUTI FASHIONS PVT.LTD.', 'Plot no 328, \r\nRoad no 3. \r\nSachin GIDC', '', 'Surat', '', '9825127753', '', 'cheque', 'CGST/SGST', '24AAHCS9273K1ZT'),
(42, 'Crystal Inks and Coatings', 'J-103/3, Engineering Zone, GIDC,Sarigam', '396155', 'Valsad', '', '9924985395', 'crystalinksoffice@gmail.com', 'cheque', 'CGST/SGST', '24AAlFC3943J1ZF'),
(43, 'HP WEALTH CREATOR', 'B-209, DIAMOND WORLD, MINI BAZAR, VARACHHA ROAD\r\n', '395006', 'Surat', '', '9825285955', 'hpwealth87@gmail.com', 'cheque', 'CGST/SGST', '24ANYPP3189Q1ZQ'),
(44, 'goldeneyeshot.com', '608, 6th Floor, Vishwakarma Arcade, Majura Gate, Ring Road', '395002', 'Surat', '', '9978929168', '', 'cheque', 'CGST/SGST', ''),
(45, 'Good Luck Break Down Service', 'Shop no.1,2,3 Bhagwati Complex,National Highway 8, Opposite CNG Pump,', '394327', 'Kadodara', '', '98241 88786', '', 'cheque', 'CGST/SGST', '24AUVPP0429K'),
(46, 'Anant Vyas & Co.', '1/833, Nanpura', '395001', 'Surat', '', '9824147659', 'anantvyasandco1@gmail.com', 'cheque', 'CGST/SGST', '24ABBPV0661J2ZM'),
(47, 'Mook Badhir Vikas Trust', 'Ambikaniketan, Athwalines', '395007', 'Surat', '02612259448', '', 'mookbadhir@gmail.com', 'cheque', 'CGST/SGST', ''),
(48, 'Surya Mattresses Pvt. Ltd.', 'Plot No : I-45, Road No : 6-IB, New G.E.B. Road, Sachin', '394230', 'Surat', '', '937799110', '', 'cheque', 'CGST/SGST', '24AAWCS2395H1ZS'),
(49, 'Satyog Trading Co.', 'A10/7 Paikee, Rd No 3, Beside Dharti Namkeen, Udhna Udhyog Nagar', '394210', 'Surat', '0261 227 7421', '', '', 'cheque', 'CGST/SGST', '24AAPFS2679J1ZL'),
(50, 'Shreeji Electricals', 'Plot No : 55, Vinay Nagar, Madhi ni Khamni Road, Opp. Guru Dwara, Udhna main Road', '394210', 'Surat', '', '9825406272', '', 'cheque', 'CGST/SGST', '24AAUFS2363Q1ZD'),
(51, 'Hitech Design Consultancy', '202, Amar Shilp Apt, Timaliyawad, Nanpura', '395009', 'Surat', '02612472368', '', 'hitechdesign_1@yahoo.co.in', 'cheque', 'CGST/SGST', '24AABFH4434Q1Z7'),
(52, 'Shreeji Marketing', '23, Hari Om Industry, Nr. Shantinath Mill, Navjivan Circle, Udhna Magdalla Road', '395017', 'Surat', '', '9428629314', '', 'cheque', 'CGST/SGST', '24APYPP6999N1ZC'),
(53, 'Dreamz India', '1054, Universal, Textile Market Ring Rd, New Textile Market', '395002', 'Surat', '', '', '', 'cash', 'CGST/SGST', '24AAKFD3452B1ZX'),
(54, 'Inoventive Filaments Pvt Ltd', 'Plot no 143 near pandesara Police Station pandesara GIDC', '394221', 'Surat', '', '9173773270', '', 'cheque', 'CGST/SGST', '24AADCN0213C1ZD'),
(55, 'The Compu Seconds', 'G- 7/8 Ascon plaza\r\nB/h. BHULKA BHAVAN SCHOOL\r\nAnand Mahal road\r\nAdajan ', '395009', 'Surat', '0261-2731040', '9898543092', 'sales@compu2nd.in', 'cheque', 'CGST/SGST', '24AEDPS0796J1Z6'),
(56, 'AMAAN TOURS', 'GROUND FLOOR, G 6, DECENT COMPLEX, TAROTA\r\nBAZAR', '396445', 'Navsari', '', '9227860000', 'info@amaantours.in', 'cheque', 'CGST/SGST', '24ABXPR3789H1ZR'),
(57, 'Pramukh Opticals', '6-B, Kakadia Complex,\r\nOpp Citi Bank\r\nGhod dod Road', '395007', 'Surat', '0261 225 6425', '9909926434', 'info@pramukhoptical.com', 'cheque', 'CGST/SGST', '24AATFP9329C1ZY'),
(58, 'Shree Rangkala Glass Design Pvt. Ltd.', '203,204 Nathubhai Towers, Opp. Dhru Motors, Udhna Main Road, Udhna', '394210', 'Surat', '', '09374276246', '', 'cheque', 'CGST/SGST', '24AAYCS7630K1ZN'),
(59, 'Shree Gurudev Supreme Insulation', ' \"Atash\" Building Opp. Jogani Mata Temple,\r\nBeside Surat Peoples Bank,\r\nTimaliyawad Nanpura.', '395001', 'Surat', '', '', '', 'cheque', 'CGST/SGST', '24AAVPV3295M1ZN'),
(60, 'Amrut Agro & Food Processing', 'Bhojapara,', '', 'Gondal', '', '9974400999', '', 'cheque', 'CGST/SGST', '24AAPFA6346Q1ZT'),
(61, 'KEJRIWAL JEWELLERS', '1ST FLOOR, OFFICE NO 106, JIN SHANTI, MAHIDHARPURA,HIRA\r\nBAZAR', '395003', 'Surat', '', '9016334429', '', 'cheque', 'CGST/SGST', '24ANRPK9829K1Z7'),
(62, 'Suraj Tyre Care Pvt. Ltd.', 'Plot no : 306, Bhatpore GIDC,\r\nOpp. ONGC Company,\r\nIchhapore', '394270', 'Surat', '9879164468', '', '', 'cheque', 'CGST/SGST', '24AATCS6991G1ZN'),
(63, 'M/S Rubtech Reclaim Pvt. Ltd.', 'Plot no : 104/9/2,\r\nPalej, GIDC, Palej', '', 'Bharuch', '9978937073', '', '', 'cheque', 'CGST/SGST', '24AAHCR1414R1Z5'),
(64, 'Raavee Exeem', 'Office No : 712, Empire State Building, Ring Road', '395002', 'Surat', '', '', '', 'cheque', 'CGST/SGST', '24AAYFR3440F1Z1'),
(65, 'Vinay Cold Drink House', ' Opp. Ramji Temple, M.G. Road.', '396001', 'Valsad', '', '8866441307', '', 'cheque', 'CGST/SGST', '24AARPD9300R1Z9'),
(66, 'Thread Bucket Studio LLP', 'South Side, Ground Floor, First Floor, Plot No : A/15/4, Udhna Sangh, Udhna Udhyog Naga, Udhna', '394210', 'Surat', '', '', '', 'cheque', 'CGST/SGST', '24AAKFT0982E1Z6'),
(67, 'JUWEL ENGINEERING SERVICES', 'INFINITY BUSINESS HUB, 401, PALANPUR CANAL ROAD,\r\nPALANPOR', '395007', 'Surat', '', '', '', 'cheque', 'CGST/SGST', '24ANFPA7697B1Z6'),
(68, 'Amrut Agro & Food Processing', 'Bhojapara', '', '', '', '9974400999', '', 'cheque', 'CGST/SGST', '24AAPFA6346Q1ZT'),
(69, 'Shreeji Energy Solution', 'Plot No : 55, Ground Floor, Vinay Nagar, Opp Guru Dwara, Madhi Ni Khamni Road, Udhna', '394210', 'Surat', '', '', '', 'cheque', 'CGST/SGST', '24ACXFS5496F1ZD'),
(70, 'AIMS COMMUNICATIONS AND SECURITY SYSTEMS', 'Abrama Village A-23, Pramukh Sannidhya', '396002', 'Valsad', '', '9979436496', '', 'cheque', 'CGST/SGST', '24AAUFA9882A1Z6'),
(71, 'Swagat Management', 'Gopi Vatika, Nr. Manibhadra Heights, B/H L.P. Savani School, Canal Road, Vesu', '395007', 'Surat', '', '', '', 'cheque', 'CGST/SGST', '24ACIFS4885R1Z4'),
(72, 'RajGreen Infralink LLP', 'Venilla Sky, Opp. C B Patel Health Club, B/S Maniba Party Plot, VIP Road, Vesu', '395007', 'Surat', '0261 2796400', '', '', 'cheque', 'CGST/SGST', '24AAVFR8064N1Z9'),
(73, 'INFINITI EVENT AND TRAVEL MANAGEMENT', '3007 TO 3011, SHANKAR PLAZA, NANPURA', '395001', 'Surat', '', '', 'acc.infinitieventandtravel@gma', 'cheque', 'CGST/SGST', '24ADPPS0221F1ZT'),
(74, 'GREEN SS WATER TANK LLP', 'PLOT NO-70/1, PAREKH ESTATE, NR.SHANTINATH MILL,\r\nALTHAN', '395017', 'Surat', '', '', 'greensswatertank@gmail.com', 'cheque', 'CGST/SGST', '24AAQFG3675B1ZF'),
(75, 'Hotel Akash', 'Lal Darwaja main Road', '395003', 'Surat', '0261-2490316', '', 'hotelakash_surat@yahoo.co.in', 'cheque', 'CGST/SGST', '24AAIFH0247E1ZU'),
(76, 'Clean Sheen Cleaning Services Pvt. Ltd.', 'A-402, Surya Flats, Anand Mahal Road, Adajan', '395009', 'Surat', '', '', 'info.cleansheencleaning@gmail.', 'cheque', 'CGST/SGST', '24AAHCC5124H1ZY'),
(77, 'INOCI Marketing', '181, VISHAL NAGAR,NR BHATAR TENAMENT,\r\nBHATAR', '395017', 'Surat', '', '', '', 'cheque', 'CGST/SGST', '24BBZPJ0212Q1Z9'),
(78, 'Sangam Creation', 'G-15, Narayan Nagar Ind. Estate, Parvat Gam', '395010', 'Surat', '', '9825465476', '', 'cheque', 'CGST/SGST', '24ABNPS6868A1ZC'),
(79, 'Abhinandan Glow', 'Factory No 1, TATA Carewell & Infrastructure, Gundlav X Road, ', '396001', 'Valsad', '', '', 'abhinandanglow@gmail.com', 'cheque', 'CGST/SGST', '24ABNFA7650C1ZL'),
(80, 'Sumtinath Holidays', 'Gopipura', '395001', 'Surat', '', '9978950049', '', 'cheque', 'CGST/SGST', '24AEEPJ6832M1ZB'),
(81, 'Smart Alkaline & Acidic Water Ionizer', 'Nanpura', '395001', 'Surat', '', '', '', 'cheque', 'NOGST', ''),
(82, 'R B Hotels Private Limited', 'Lal Darwaja Main Road', '395003', 'Surat', '', '9825120360', '', 'cheque', 'CGST/SGST', '24AABCR1164L1ZG'),
(83, 'CHIPS INTERNATIONAL', '316 Classic Complex,\r\n Opp A.V.Sons\r\n Nr Parle Point,Ghod Dod Road', '395007', 'Surat', '', '9998145149', '', 'credit', 'CGST/SGST', '24BXIPP5841E1ZF'),
(84, 'IESHA JEWELS PRIVATE LIMITED', 'NO.2,201 MARUTI CHAMBERS, PIPLASHERI, MAHIDHARPURA, ', '395003', 'Surat', '', '9825882168', '', 'cheque', 'CGST/SGST', '24AADCI2192K1ZJ'),
(85, 'ARIHANT CORPORATION', 'UNIT-||, P-37,38, SAYAN TEXTILE PARK, ICHHAPORE', '', 'SURAT', '', '9998968382', '', 'cheque', 'CGST/SGST', '24AINPJ7086N1ZJ'),
(86, 'MOOK BADHIR VIKAS TRUST', 'PARLE POINT', '', 'SURAT', '', '', '', 'Select Type', 'NOGST', ''),
(87, 'Metas of Seventh-day Adventist', 'Athwalines', '395001', 'Surat', '', '', '', 'cheque', 'NOGST', ''),
(88, 'FIRSTCHOICE ADVERTISING', 'NANPURA', '395001', 'SURAT', '', '9512010152', '', 'cheque', 'CGST/SGST', '24BTFPS5626H1Z1'),
(89, 'CARE CONSULTANT', 'UG-5, FOUNTAIN PLAZA, Nr. LAXMI CINEMA, Fuwara St', '396445', 'Navsari', '', '', '', 'cheque', 'CGST/SGST', '24ASGPP7024F1ZV'),
(90, 'Alok Suit', 'C-3144 ,Radha Krishna Textile market, Ring Road', '395002', 'Surat', '', '9825118427', '', 'cash', 'NOGST', ''),
(91, 'ThinkLoud Interactive & Animation', ' Shop no. 2, 7/3605, Shree Ram Apt., Rampura Main road', '395003', 'Surat', '7405505961', '7405505961', 'contact@thinkloudinteractive.com', 'cheque', 'CGST/SGST', '24APDPJ4316E1ZF'),
(92, 'The Proxperts', '101, \r\nRegent Square\r\nBehind Dmart\r\nAdajan', '395009', 'Surat', '', '9022068253', '', 'cheque', 'CGST/SGST', '24AANFT2565J1ZT'),
(93, 'PREM PATEL', 'Bhathena', NULL, NULL, '8320572602', NULL, 'prem.269739@gmail.com', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shipper_info`
--

CREATE TABLE `tbl_shipper_info` (
  `si_id` int(11) NOT NULL,
  `shipper_id` int(11) NOT NULL,
  `person_name` varchar(50) NOT NULL,
  `mobile_no` varchar(15) NOT NULL,
  `email_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_shipper_info`
--

INSERT INTO `tbl_shipper_info` (`si_id`, `shipper_id`, `person_name`, `mobile_no`, `email_id`) VALUES
(1, 91, 'Abhi Jariwala', '7405505961', 'contact@thinkloudinteractive.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task`
--

CREATE TABLE `tbl_task` (
  `task_id` int(11) NOT NULL,
  `shipper_id` int(11) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `task_type` varchar(10) NOT NULL,
  `task_desc` longtext NOT NULL,
  `task_files` longtext NOT NULL,
  `task_status` varchar(10) NOT NULL,
  `task_cdate` varchar(30) NOT NULL,
  `task_edate` varchar(30) NOT NULL,
  `task_other` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task_emp`
--

CREATE TABLE `tbl_task_emp` (
  `task_emp_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `task_emp_quantity` int(11) NOT NULL,
  `task_emp_quantity_done` int(11) NOT NULL,
  `task_emp_repetition_duration` varchar(50) NOT NULL,
  `task_emp_description` longtext NOT NULL,
  `date_assign` datetime NOT NULL,
  `date_accept` datetime NOT NULL,
  `date_session_start` datetime NOT NULL,
  `date_session_end` datetime NOT NULL,
  `date_submit` datetime NOT NULL,
  `task_emp_duration` int(20) NOT NULL,
  `task_emp_status` int(11) NOT NULL,
  `task_emp_running_status` int(11) NOT NULL,
  `task_emp_expected_time` varchar(200) NOT NULL,
  `recordListingID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task_emp_log`
--

CREATE TABLE `tbl_task_emp_log` (
  `task_emp_log_id` int(11) NOT NULL,
  `task_emp_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `task_emp_log_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task_emp_qty`
--

CREATE TABLE `tbl_task_emp_qty` (
  `task_emp_qty` int(11) NOT NULL,
  `task_emp_id` int(11) NOT NULL,
  `task_emp_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tc`
--

CREATE TABLE `tbl_tc` (
  `tc_id` int(11) NOT NULL,
  `tc_desc` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_tc`
--

INSERT INTO `tbl_tc` (`tc_id`, `tc_desc`) VALUES
(1, '<p><strong>Terms of Sale</strong></p>\r\n\r\n<ol>\r\n	<li><strong>Interest at the rate of 18% p.a. will be charged on bills not paid as per the terms.</strong></li>\r\n	<li><strong>Cheque return charge Rs. 500.</strong></li>\r\n	<li><strong>E &amp; O E</strong></li>\r\n	<li><strong>This is Computer Generated Invoice.</strong></li>\r\n	<li><strong>Subject to SURAT Jurisdiction.</strong></li>\r\n</ol>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_password` text NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_mobile` varchar(20) DEFAULT NULL,
  `user_designation` varchar(50) NOT NULL,
  `user_last_login_date_time` datetime DEFAULT NULL,
  `user_entry_date` datetime NOT NULL,
  `user_modification_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `role_id`, `user_name`, `user_password`, `user_email`, `user_mobile`, `user_designation`, `user_last_login_date_time`, `user_entry_date`, `user_modification_date`) VALUES
(1, 2, 'Prem Patel', 'cHJlbTEyMw==', 'prem.269739@gmail.com', '9033391629', 'Developer', NULL, '2020-07-16 07:26:18', '2020-07-16 07:53:50'),
(2, 1, 'Niral Shah', 'bmlyYWwxMjM=', 'niralshah.251@gmail.com', '9874563210', 'Director', '2020-09-05 16:50:30', '2020-07-16 07:54:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_login`
--

CREATE TABLE `tbl_user_login` (
  `user_login_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_login_date` datetime NOT NULL,
  `user_login_total_time` int(11) NOT NULL,
  `user_login_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_login_log`
--

CREATE TABLE `tbl_user_login_log` (
  `user_login_log_id` int(11) NOT NULL,
  `user_login_id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `user_login_log_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admintable`
--
ALTER TABLE `admintable`
  ADD PRIMARY KEY (`uname`);

--
-- Indexes for table `tbl_attendant`
--
ALTER TABLE `tbl_attendant`
  ADD PRIMARY KEY (`attendant_id`);

--
-- Indexes for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `invoice_no` (`invoice_no`(767));

--
-- Indexes for table `tbl_cash`
--
ALTER TABLE `tbl_cash`
  ADD PRIMARY KEY (`cash_id`),
  ADD KEY `service_confirmation_id` (`service_confirmation_id`);

--
-- Indexes for table `tbl_company`
--
ALTER TABLE `tbl_company`
  ADD PRIMARY KEY (`companyId`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `tbl_expense`
--
ALTER TABLE `tbl_expense`
  ADD PRIMARY KEY (`expense_id`);

--
-- Indexes for table `tbl_inquiry`
--
ALTER TABLE `tbl_inquiry`
  ADD PRIMARY KEY (`inquiry_id`);

--
-- Indexes for table `tbl_inquiry_detail`
--
ALTER TABLE `tbl_inquiry_detail`
  ADD PRIMARY KEY (`inquiry_detail_id`);

--
-- Indexes for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `service_confirmation_id` (`service_confirmation_id`);

--
-- Indexes for table `tbl_logo`
--
ALTER TABLE `tbl_logo`
  ADD PRIMARY KEY (`logo_id`);

--
-- Indexes for table `tbl_payment_history`
--
ALTER TABLE `tbl_payment_history`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbl_proforma`
--
ALTER TABLE `tbl_proforma`
  ADD PRIMARY KEY (`proforma_id`),
  ADD KEY `service_confirmation_id` (`service_confirmation_id`);

--
-- Indexes for table `tbl_project`
--
ALTER TABLE `tbl_project`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `tbl_project_achknow`
--
ALTER TABLE `tbl_project_achknow`
  ADD PRIMARY KEY (`achknow_id`);

--
-- Indexes for table `tbl_project_allocate`
--
ALTER TABLE `tbl_project_allocate`
  ADD PRIMARY KEY (`proAll_id`);

--
-- Indexes for table `tbl_proservicelist`
--
ALTER TABLE `tbl_proservicelist`
  ADD PRIMARY KEY (`proservicelist_id`);

--
-- Indexes for table `tbl_purchase`
--
ALTER TABLE `tbl_purchase`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `tbl_renewal`
--
ALTER TABLE `tbl_renewal`
  ADD PRIMARY KEY (`renewal_id`);

--
-- Indexes for table `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tbl_server`
--
ALTER TABLE `tbl_server`
  ADD PRIMARY KEY (`server_id`);

--
-- Indexes for table `tbl_servicelist`
--
ALTER TABLE `tbl_servicelist`
  ADD PRIMARY KEY (`servicelist_id`);

--
-- Indexes for table `tbl_service_confirmation`
--
ALTER TABLE `tbl_service_confirmation`
  ADD PRIMARY KEY (`service_confirmation_id`),
  ADD KEY `shipper_id` (`shipper_id`);

--
-- Indexes for table `tbl_service_inclusion`
--
ALTER TABLE `tbl_service_inclusion`
  ADD PRIMARY KEY (`service_inclusion_id`),
  ADD KEY `service_confirmation_id` (`service_confirmation_id`);

--
-- Indexes for table `tbl_shipper`
--
ALTER TABLE `tbl_shipper`
  ADD PRIMARY KEY (`shipper_id`);

--
-- Indexes for table `tbl_shipper_info`
--
ALTER TABLE `tbl_shipper_info`
  ADD PRIMARY KEY (`si_id`);

--
-- Indexes for table `tbl_task`
--
ALTER TABLE `tbl_task`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `tbl_task_emp`
--
ALTER TABLE `tbl_task_emp`
  ADD PRIMARY KEY (`task_emp_id`),
  ADD KEY `tbl_task_emp_ibfk_1` (`task_id`);

--
-- Indexes for table `tbl_task_emp_log`
--
ALTER TABLE `tbl_task_emp_log`
  ADD PRIMARY KEY (`task_emp_log_id`),
  ADD KEY `tbl_task_emp_log_ibfk_1` (`task_emp_id`);

--
-- Indexes for table `tbl_task_emp_qty`
--
ALTER TABLE `tbl_task_emp_qty`
  ADD PRIMARY KEY (`task_emp_qty`),
  ADD KEY `tbl_task_emp_qty_ibfk_1` (`task_emp_id`);

--
-- Indexes for table `tbl_tc`
--
ALTER TABLE `tbl_tc`
  ADD PRIMARY KEY (`tc_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_user_login`
--
ALTER TABLE `tbl_user_login`
  ADD PRIMARY KEY (`user_login_id`);

--
-- Indexes for table `tbl_user_login_log`
--
ALTER TABLE `tbl_user_login_log`
  ADD PRIMARY KEY (`user_login_log_id`),
  ADD KEY `user_login_id` (`user_login_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_attendant`
--
ALTER TABLE `tbl_attendant`
  MODIFY `attendant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `tbl_cash`
--
ALTER TABLE `tbl_cash`
  MODIFY `cash_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_company`
--
ALTER TABLE `tbl_company`
  MODIFY `companyId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `tbl_expense`
--
ALTER TABLE `tbl_expense`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_inquiry`
--
ALTER TABLE `tbl_inquiry`
  MODIFY `inquiry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_inquiry_detail`
--
ALTER TABLE `tbl_inquiry_detail`
  MODIFY `inquiry_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_logo`
--
ALTER TABLE `tbl_logo`
  MODIFY `logo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_payment_history`
--
ALTER TABLE `tbl_payment_history`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_proforma`
--
ALTER TABLE `tbl_proforma`
  MODIFY `proforma_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_project`
--
ALTER TABLE `tbl_project`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_project_achknow`
--
ALTER TABLE `tbl_project_achknow`
  MODIFY `achknow_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_project_allocate`
--
ALTER TABLE `tbl_project_allocate`
  MODIFY `proAll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_proservicelist`
--
ALTER TABLE `tbl_proservicelist`
  MODIFY `proservicelist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `tbl_purchase`
--
ALTER TABLE `tbl_purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_renewal`
--
ALTER TABLE `tbl_renewal`
  MODIFY `renewal_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_server`
--
ALTER TABLE `tbl_server`
  MODIFY `server_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_servicelist`
--
ALTER TABLE `tbl_servicelist`
  MODIFY `servicelist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tbl_service_confirmation`
--
ALTER TABLE `tbl_service_confirmation`
  MODIFY `service_confirmation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_service_inclusion`
--
ALTER TABLE `tbl_service_inclusion`
  MODIFY `service_inclusion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_shipper`
--
ALTER TABLE `tbl_shipper`
  MODIFY `shipper_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `tbl_shipper_info`
--
ALTER TABLE `tbl_shipper_info`
  MODIFY `si_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_task`
--
ALTER TABLE `tbl_task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_task_emp`
--
ALTER TABLE `tbl_task_emp`
  MODIFY `task_emp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_task_emp_log`
--
ALTER TABLE `tbl_task_emp_log`
  MODIFY `task_emp_log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_task_emp_qty`
--
ALTER TABLE `tbl_task_emp_qty`
  MODIFY `task_emp_qty` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_tc`
--
ALTER TABLE `tbl_tc`
  MODIFY `tc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_user_login`
--
ALTER TABLE `tbl_user_login`
  MODIFY `user_login_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user_login_log`
--
ALTER TABLE `tbl_user_login_log`
  MODIFY `user_login_log_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
