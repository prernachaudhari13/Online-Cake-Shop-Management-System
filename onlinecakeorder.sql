-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2022 at 06:36 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `onlinecakeorder`
--

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE IF NOT EXISTS `billing` (
  `bill_id` int(10) NOT NULL AUTO_INCREMENT,
  `bill_type` varchar(10) NOT NULL,
  `cust_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `bill_no` int(10) NOT NULL,
  `bill_date` date NOT NULL,
  `delivery_date` date NOT NULL,
  `delivery_time` time NOT NULL,
  `tax_id` int(10) NOT NULL,
  `tax_amt` float(10,2) NOT NULL,
  `promocode` varchar(20) NOT NULL,
  `promocode_type` varchar(25) NOT NULL,
  `discount` float(10,2) NOT NULL,
  `message` text NOT NULL,
  `note` text NOT NULL,
  `payment_type` text NOT NULL,
  `pay_type` varchar(10) NOT NULL,
  `card_number` varchar(20) NOT NULL,
  `deliv_address` text NOT NULL,
  `particulars` text NOT NULL,
  `name` varchar(50) NOT NULL,
  `pin_code` varchar(10) NOT NULL,
  `mob_no` varchar(15) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`bill_id`),
  KEY `cust_id` (`cust_id`),
  KEY `user_id` (`user_id`),
  KEY `tax_id` (`tax_id`),
  KEY `promocode_id` (`promocode`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`bill_id`, `bill_type`, `cust_id`, `user_id`, `bill_no`, `bill_date`, `delivery_date`, `delivery_time`, `tax_id`, `tax_amt`, `promocode`, `promocode_type`, `discount`, `message`, `note`, `payment_type`, `pay_type`, `card_number`, `deliv_address`, `particulars`, `name`, `pin_code`, `mob_no`, `status`) VALUES
(34, '', 23, 0, 1, '2022-03-07', '2022-03-08', '18:05:00', 1, 0.00, '', '', 0.00, 'Kamal', 'Please Add Knife ', 'VISA', '', '1234567891234567', 'Flat No. 302 Datta Colony, Deopur  Dhule', 'Account holder: Sayali jain | Expriry date:  2022-03', 'Sayali Jain', '424001', '9876543221', 'Active'),
(35, '', 24, 0, 2, '2022-03-07', '2022-03-07', '19:27:00', 1, 0.00, '', '', 0.00, 'Mom', 'Thank you', 'VISA', '', '1234567899876543', 'Swaminaraya Road', 'Account holder: Kritika Chaudhari | Expriry date:  2022-04', 'Kritika Chuadhari', '575001', '9876543211', 'Active'),
(36, '', 25, 3, 3, '2022-03-11', '2022-03-12', '19:00:00', 1, 0.00, '', '', 0.00, 'Happy Birthday Ashwini', '', 'Cash on Delivery', '', '', 'Deopur Dhule', 'Account holder:  | Expriry date:  ', 'Khushi', '575001', '9876543212', 'Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `billing_records`
--

CREATE TABLE IF NOT EXISTS `billing_records` (
  `billing_record_id` int(10) NOT NULL AUTO_INCREMENT,
  `bill_id` int(10) NOT NULL,
  `cust_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `item_cost` float(10,2) NOT NULL,
  `qty` int(10) NOT NULL,
  `cakeshape` varchar(100) NOT NULL,
  `weight` double NOT NULL,
  `cost_per_kg` double NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`billing_record_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=97 ;

--
-- Dumping data for table `billing_records`
--

INSERT INTO `billing_records` (`billing_record_id`, `bill_id`, `cust_id`, `item_id`, `item_cost`, `qty`, `cakeshape`, `weight`, `cost_per_kg`, `status`) VALUES
(93, 34, 0, 33, 550.00, 1, 'Round', 1, 400, 'Active'),
(94, 35, 24, 48, 970.00, 1, 'Round', 1, 600, 'Active'),
(95, 36, 0, 46, 820.00, 1, 'Round', 1.5, 600, 'Active'),
(96, 0, 26, 31, 800.00, 1, 'Round', 1, 600, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(10) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL,
  `img` varchar(100) NOT NULL,
  `category_note` text NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `img`, `category_note`, `status`) VALUES
(11, 'Signature Cakes ', '23308SignatureCake.jpg', '', 'Active'),
(12, 'Birthday Cake', '13332BirthdayCake.jpg', '', 'Active'),
(13, 'Barbie cakes', '14705054.png', '', 'Active'),
(14, 'Wedding Cakes', '20150WeddingCakes.jpg', '', 'Active'),
(15, 'Photo Cakes', '16248photo_cake_1.jpg', '', 'Active'),
(16, 'Anniversary Cakes', '15390AnniversaryCakes.jpg', '', 'Active'),
(17, 'test', '77437.jpg', 'klfdslkdsfkldslfk', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `cust_id` int(10) NOT NULL AUTO_INCREMENT,
  `cust_name` varchar(25) NOT NULL,
  `cust_addr` text NOT NULL,
  `cust_contactno` varchar(15) NOT NULL,
  `email_id` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`cust_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_id`, `cust_name`, `cust_addr`, `cust_contactno`, `email_id`, `password`, `status`) VALUES
(23, 'Sayali Jain', 'flat no.302 Datta Colony Deopur Dhule', '9876543221', 'sayali@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Active'),
(24, 'Kritika Chuadhari', 'flat no 5 Dreams house Wadibhokar Road ', '9876543211', 'kritika@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Active'),
(25, 'Ashwini patil', 'Lokamanya tilak nagar Deopur Dhule', '7775042431', 'ashwini@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Active'),
(26, 'Sunita', 'Dhule', '9876541233', 'sunita@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `img_id` int(10) NOT NULL AUTO_INCREMENT,
  `img_type` varchar(20) NOT NULL,
  `item_id` int(10) NOT NULL,
  `item_img` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`img_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=96 ;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`img_id`, `img_type`, `item_id`, `item_img`, `status`) VALUES
(5, '', 3, '1238good-woman.jpg', 'Active'),
(6, '', 3, '3434image1.JPG', 'Active'),
(7, '', 3, '31697image2.JPG', 'Inactive'),
(8, '', 3, '6455image4.JPG', 'Active'),
(9, '', 5, '24514image7.JPG', 'Active'),
(10, 'Default', 5, '4368img1.png', 'Active'),
(11, '', 4, '2940Untitled.png', 'Active'),
(12, '', 4, '25690ew.gif', 'Active'),
(13, '', 4, '898image2.JPG', 'Active'),
(14, '', 4, '5571image5.JPG', 'Active'),
(15, 'Default', 4, '2891026.jpg', 'Active'),
(16, 'Default', 3, '20954031.jpg', 'Active'),
(17, 'Default', 6, '27762021.jpg', 'Active'),
(18, '', 6, '953666c0ed6ccd2b7f8c4702d93b0e0de91e.jpg', 'Active'),
(19, '', 16, '5119make-up-her-mood-today.jpg', 'Active'),
(20, '', 16, '12309roses-n-lilies_1.jpg', 'Active'),
(21, 'Default', 16, '26642940Untitled.png', 'Active'),
(22, 'Default', 17, '11734Yellow_van_transportation_transport.png', 'Active'),
(23, '', 17, '11570img1.png', 'Active'),
(24, 'Default', 7, '31374WhatsApp Image 2017-02-15 at 6.18.41 PM.jpeg', 'Active'),
(25, '', 7, '18108WhatsApp Image 2017-02-15 at 6.18.37 PM.jpeg', 'Active'),
(27, '', 7, '23026WhatsApp Image 2017-02-15 at 6.18.39 PM.jpeg', 'Active'),
(28, '', 7, '3776WhatsApp Image 2017-02-15 at 6.18.30 PM.jpeg', 'Inactive'),
(29, '', 8, '9263460.jpg', 'Active'),
(30, 'Customized', 22, '13136460.jpg', 'Active'),
(31, 'Customized', 22, '26953ch1.jpg', 'Active'),
(32, 'Customized', 23, '7573460.jpg', 'Active'),
(33, 'Customized', 23, '11946ch1.jpg', 'Active'),
(34, 'Customized', 24, '29276460.jpg', 'Active'),
(35, 'Customized', 24, '269811.jpg', 'Active'),
(36, 'Customized', 25, '13436sin-foto.jpg', 'Active'),
(37, 'Customized', 25, '20741newlogo.png', 'Active'),
(38, 'Customized', 26, '174042940Untitled.png', 'Active'),
(39, 'Customized', 26, '27269logo1.png', 'Active'),
(40, '', 27, '24781.JPG', 'Active'),
(41, '', 27, '184052..png', 'Active'),
(42, 'Default', 28, '18656023.jpg', 'Active'),
(43, 'Default', 29, '18070gallery-img5.jpg', 'Active'),
(44, '', 29, '1983664fdd7400aafdd01e32680e7fce9432d.jpg', 'Active'),
(45, 'Default', 27, '19173best-cakes-and-pastries-in-Gurgaon.jpg', 'Active'),
(46, 'Default', 30, '18503blackforestkirsch.jpg', 'Active'),
(47, 'Default', 31, '8982kit-kat-cake-1kg_1.jpg', 'Active'),
(50, 'Default', 34, '32494vanilla-photo-cake1kg_1.jpg', 'Active'),
(51, 'Customized', 35, '146389.jpg', 'Active'),
(52, 'Default', 36, '13916personalized-craving-for-more-1kg_1.jpg', 'Active'),
(53, 'Default', 37, '18059heart-shape-chocolate-photo-cake-1kg_1.jpg', 'Active'),
(54, 'Default', 38, '6821personalized-cake-fantasy-1kg_1.jpg', 'Active'),
(55, 'Default', 39, '17270butterscotch-delight-photo-cake-1kg-eggless_1.jpg', 'Active'),
(56, 'Default', 40, '10469Oreo-Cake-1-1.jpg', 'Active'),
(57, '', 40, '23059Oreo-Cake-2-1.jpg', 'Active'),
(58, '', 40, '30397Oreo-Cake-3-1.jpg', 'Active'),
(59, '', 40, '26496Oreo-Cake-4-1.jpg', 'Active'),
(60, 'Default', 41, '1135German-Chocolate-Cake-1-1.jpg', 'Active'),
(61, '', 41, '11781German-Chocolate-Cake-2-1.jpg', 'Active'),
(62, '', 41, '6663German-Chocolate-Cake-3-1.jpg', 'Active'),
(63, '', 41, '31069German-Chocolate-Cake-4-1.jpg', 'Active'),
(64, 'Default', 33, '22162057a7d37e4990e74635cd99ca1e2f099.jpg', 'Active'),
(65, 'Default', 42, '20057Car-Boys-Birthday-Cake-Ideas.jpg', 'Active'),
(66, '', 42, '189104.jpg', 'Active'),
(67, 'Default', 43, '27093A-Half-of-Ball-Football-Cake-Ideas.jpg', 'Active'),
(68, 'Default', 44, '14006mobile-iphone-android-cakes-cupcakes-mumbai-4.jpeg', 'Active'),
(70, 'Default', 45, '6779img_3579.jpg', 'Active'),
(71, 'Default', 46, '292537306350916_0a533cbaab_b.jpg', 'Active'),
(72, 'Default', 47, '18530Make_Up_cake__21422.1370342845.500.659.jpg', 'Active'),
(73, 'Default', 48, '20066birthday-cakes-for-girls-london-53.JPG', 'Active'),
(74, 'Customized', 49, '2857best-cakes-and-pastries-in-Gurgaon.jpg', 'Active'),
(75, 'Customized', 50, '209569.jpg', 'Active'),
(77, 'Default', 51, '10723RoundedStripesCake.jpg', 'Active'),
(78, 'Default', 52, '1042732b799d824af5b75341137c3d13ff737.jpg', 'Active'),
(79, 'Default', 53, '12370IMG-20170306-WA0025.jpg', 'Active'),
(80, 'Default', 54, '32327112736-800x600-Red_Heart_Fondant.jpg', 'Active'),
(81, 'Default', 55, '1828516.jpg', 'Active'),
(82, 'Default', 32, '26023Strawberry-Fresh-Fruit-Cake.jpg', 'Active'),
(83, 'Default', 56, '2747barbie-Cake-Designs.jpg', 'Active'),
(85, 'Customized', 58, '433374248what-is-a-web-developer.jpg', 'Active'),
(86, 'Customized', 58, '382237736what-is-a-web-developer.jpg', 'Active'),
(87, 'Customized', 59, '787817861a-small-girl-and-grandmother-with-tablet-at-home-PTDQHPB.jpg', 'Active'),
(88, 'Customized', 59, '1613436805images.jpg', 'Active'),
(89, 'Customized', 60, '1400697664a-small-girl-and-grandmother-with-tablet-at-home-PTDQHPB.jpg', 'Active'),
(90, 'Customized', 60, '1445991319images.jpg', 'Active'),
(91, 'Customized', 61, '1317115632a-small-girl-and-grandmother-with-tablet-at-home-PTDQHPB.jpg', 'Active'),
(92, 'Customized', 61, '1945767661images.jpg', 'Active'),
(93, 'Default', 62, '18406ChocoEspresso.jpg', 'Active'),
(94, 'Default', 63, '19863013.jpg', 'Active'),
(95, '', 63, '288135..png', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `item_id` int(10) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(50) NOT NULL,
  `item_type` varchar(10) NOT NULL,
  `item_description` text NOT NULL,
  `category_id` int(10) NOT NULL,
  `item_cost` float(10,2) NOT NULL,
  `cost_per_kg` double NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`item_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `item_name`, `item_type`, `item_description`, `category_id`, `item_cost`, `cost_per_kg`, `status`) VALUES
(30, 'Black Forest Cake', 'Ready', 'Black Forest Cake - An absolute favourite - Layers of rich chocolate cake with whipped cream and delicious cherries. Note the images, shape, size, design of the cake are only indicative in nature.', 11, 500.00, 500, 'Active'),
(31, 'Kitkat Cake', 'Ready', 'Get a visual treat that not only tingles your taste bud but also makes your mouth water. The cake begins with a Chocolate Cake surrounded by Kitkat bars, wrapped with a ribbon and topped with gems.Note the images, shape, size, design of the cake are only indicative in nature.', 11, 800.00, 600, 'Active'),
(32, 'Strawberry Fresh Fruit Cake', 'Ready', 'This is delicious strawberry cake topped with some fresh strawberries and wafers.Note the images, shape, size, design of the cake are only indicative in nature.', 11, 700.00, 500, 'Active'),
(33, 'Spiderman Cake', 'Ready', 'We grow up idolizing our super heroes and adoring our favourite cartoon characters. Spiderman Theme Cake to Celebrate Your Special Day. Note the images, shape, size, design of the cake are only indicative in nature.', 12, 550.00, 400, 'Active'),
(34, 'Vanilla Photo Cake', 'Ready', 'Surprise your loved ones with a personalized cake. Get your picture printed on cake.The cake available in a variety of basic flavours such as pineapple, vanilla, butterscotch and chocolate. Note the images, shape, size, design of the cake are only indicative in nature.', 15, 900.00, 700, 'Active'),
(36, 'Chocolate Photo Cake', 'Ready', ' Surprise your loved ones with a personalized cake. Get your picture printed on cake.The cake available in a variety of basic flavours such as pineapple, vanilla, butterscotch and chocolate. Note the images, shape, size, design of the cake are only indicative in nature.', 15, 900.00, 600, 'Active'),
(37, 'Heart Shape Chocolate Photo Cake', 'Ready', 'Surprise your loved ones with a personalized cake. Get your picture printed on cake.The cake available in a variety of basic flavours such as pineapple, vanilla, butterscotch and chocolate. Note the images, shape, size, design of the cake are only indicative in nature.', 15, 1000.00, 800, 'Active'),
(38, 'Pineapple Photo Cake', 'Ready', 'Surprise your loved ones with a personalized cake. Get your picture printed on cake.The cake available in a variety of basic flavours such as pineapple, vanilla, butterscotch and chocolate. Note the images, shape, size, design of the cake are only indicative in nature.', 15, 800.00, 600, 'Active'),
(39, 'Butterscotch Photo Cake', 'Ready', 'Surprise your loved ones with a personalized cake. Get your picture printed on cake.The cake available in a variety of basic flavours such as pineapple, vanilla, butterscotch and chocolate. Note the images, shape, size, design of the cake are only indicative in nature.', 15, 900.00, 700, 'Active'),
(40, 'Oreo Cake', 'Ready', 'Oreo Cake - Chocolate sponge layered with oreo mousse and chocolate ganache and oreo biscuits; garnished with whole oreo cookies at the top.', 16, 600.00, 500, 'Active'),
(41, 'German Chocolate Cake', 'Ready', 'Dark chocolate sponge layered with condensed milk and desiccated coconut at the base and layered with chocolate cream and walnut at the top. ', 11, 750.00, 400, 'Active'),
(42, 'McQueen Cake', 'Ready', 'Choose from IPOD to NIKON to McQueen to Planes and celebrate your special moment and create memories with our cakes.Note the images, shape, size, design of the cake are only indicative in nature.', 12, 1200.00, 1000, 'Active'),
(43, 'Football Cake', 'Ready', 'Any football lover, young or old, supporter of any team would appreciate this cake - perfect for a boys birthday.Note the images, shape, size, design of the cake are only indicative in nature.', 12, 1050.00, 900, 'Active'),
(44, 'iPod Cake', 'Ready', ' Choose from IPOD to NIKON to McQueen to Planes and celebrate your special moment and create memories with our cakes.Note the images, shape, size, design of the cake are only indicative in nature.', 12, 750.00, 600, 'Active'),
(45, 'Bat and Ball Cake', 'Ready', 'Choose from IPOD to NIKON to McQueen to Planes and celebrate your special moment and create memories with our cakes.Note the images, shape, size, design of the cake are only indicative in nature.', 12, 650.00, 500, 'Active'),
(46, 'Mickey Cake', 'Ready', 'We grow up idolizing our super heroes and adoring our favourite cartoon characters. Mickey Theme Cake to Celebrate Your Special Day. Note the images, shape, size, design of the cake are only indicative in nature.', 13, 820.00, 600, 'Active'),
(47, 'Mac Makeup Cake', 'Ready', 'Base chocolate cake with hand crafted M.A.C make up.The cake available in a variety of basic flavours such as pineapple, vanilla, butterscotch and chocolate. Note the images, shape, size, design of the cake are only indicative in nature.', 13, 1300.00, 1100, 'Active'),
(48, 'Mermaid Cake', 'Ready', 'Delight your little angel by sending this beautiful and yummy Fondant Cake to her on her birthday or on some other special occasion.The cake available in a variety of basic flavours such as pineapple, vanilla, butterscotch and chocolate.Note the images, shape, size, design of the cake are only indicative in nature.', 13, 970.00, 600, 'Active'),
(51, 'Rounded Stripes Vanilla Cake', 'Ready', 'Every occasion is made more memorable with the cake. This cake tastes so yum and delectable that everyone will be left licking their fingers and asking for more. This delicious cake is an impeccable bet for any occasion. The cake available in a variety of basic flavours such as pineapple, vanilla, butterscotch and chocolate. Note the images, shape, size, design of the cake are only indicative in nature.', 14, 890.00, 700, 'Active'),
(52, 'White Wedding Cake', 'Ready', 'Choose from multi tier to multi floral cake. Allow us to make the most glamourous cake moment for you..The cake available in a variety of basic flavours such as pineapple, vanilla, butterscotch and chocolate. Note the images, shape, size, design of the cake are only indicative in nature.', 14, 1700.00, 1500, 'Active'),
(53, 'Eid Cake', 'Ready', 'Make your eid feast a bit more delicious with this cake.The cake available in a variety of basic flavours such as pineapple, vanilla, butterscotch and chocolate. Note the images, shape, size, design of the cake are only indicative in nature.', 14, 800.00, 600, 'Active'),
(54, 'Divine Heart Cake', 'Ready', 'This is a perfect treat for the eyes and for your taste buds.This is fondant cake in a heart shape, which is artistically decorated with white coloured flowers. Surprise the love of your life by gifting this marvellous cake to them. This cake is available in five flavours - Chocolate, Chocolate Truffle, Vanilla, Butterscotch and Pineapple. Note the images, shape, size, design of the cake are only indicative in nature.', 14, 550.00, 500, 'Active'),
(55, 'Butter Scotch Cake', 'Ready', 'Butter Scotch, Crunchy caramelized cashewnuts in vanilla sponge ,rich cream layers and with strawberry toppings. Note the images, shape, size, design of the cake are only indicative in nature.', 11, 570.00, 500, 'Active'),
(56, 'Barbie Cake', 'Ready', 'Delight your princess with a magical barbie cake for her birthday party that is simply perfect for her. The default flavour is chocolate truffle.The cake available in a variety of basic flavours such as pineapple, vanilla, butterscotch and chocolate. Note the images, shape, size, design of the cake are only indicative in nature.', 13, 1500.00, 1200, 'Active'),
(58, 'Foreign cake', 'Customized', 'Foreign cake for today', 20, 0.00, 0, ''),
(59, 'aaa', 'Customized', 'ccccccc', 20, 0.00, 0, ''),
(60, 'aaa', 'Customized', 'ccccccc', 20, 0.00, 0, ''),
(61, 'aaa', 'customized', 'ccccccc', 0, 1000.00, 1000, ''),
(63, 'Choco Espresso', 'Ready', 'dsfksfjsdjkfdsjkfjkds', 17, 500.00, 400, 'Active'),
(64, 'monako', 'Ready', '$mem_no', 12, 400.00, 350, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `message_id` int(10) NOT NULL AUTO_INCREMENT,
  `chatid` int(10) NOT NULL,
  `cust_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `date_time` datetime NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `cust_id` (`cust_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `message_reply`
--

CREATE TABLE IF NOT EXISTS `message_reply` (
  `message_reply_id` int(10) NOT NULL AUTO_INCREMENT,
  `message_id` int(10) NOT NULL,
  `cust_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `message_reply_text` text NOT NULL,
  `date_time` datetime NOT NULL,
  `msg_type` varchar(10) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`message_reply_id`),
  KEY `message_id` (`message_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=172 ;

--
-- Dumping data for table `message_reply`
--

INSERT INTO `message_reply` (`message_reply_id`, `message_id`, `cust_id`, `user_id`, `message_reply_text`, `date_time`, `msg_type`, `item_id`) VALUES
(132, 146, 0, 0, 'hello', '2017-03-04 03:27:58', 'Customer', 0),
(133, 146, 0, 0, 'Are you there', '2017-03-04 03:28:16', 'Customer', 0),
(134, 146, 0, 1, 'Yes very well here. How can I help you?', '2017-03-04 03:28:50', 'Staff', 0),
(135, 146, 0, 1, 'Hello', '2017-03-04 03:29:11', 'Staff', 0),
(136, 146, 0, 0, 'Does anyone ordered customized cake', '2017-03-04 03:29:28', 'Customer', 0),
(137, 146, 0, 1, 'Hello', '2017-03-04 03:42:40', 'Staff', 0),
(138, 146, 0, 1, 'hi', '2017-03-04 03:53:36', 'Staff', 0),
(139, 146, 0, 1, 'Dishes', '2017-03-04 03:53:53', 'Staff', 0),
(140, 146, 0, 1, 'Plates', '2017-03-04 03:54:04', 'Staff', 0),
(141, 146, 0, 1, 'youtube', '2017-03-04 03:57:06', 'Staff', 0),
(142, 146, 0, 1, 'youtube', '2017-03-04 03:59:20', 'Staff', 0),
(143, 146, 0, 1, 'corona', '2017-03-04 03:59:32', 'Staff', 0),
(144, 146, 0, 1, 'msgpack', '2017-03-04 04:03:47', 'Staff', 0),
(145, 146, 0, 1, 'how i look', '2017-03-04 04:04:12', 'Staff', 0),
(146, 146, 0, 1, 'hi', '2017-03-04 04:10:43', 'Staff', 0),
(147, 146, 0, 1, 'carrom', '2017-03-04 04:13:20', 'Staff', 0),
(148, 146, 0, 0, 'Raj kumar', '2017-03-04 04:14:01', 'Customer', 0),
(149, 146, 0, 1, 'hello', '2017-03-04 04:15:05', 'Staff', 0),
(150, 146, 0, 0, 'hi', '2017-03-04 04:15:14', 'Customer', 0),
(151, 146, 0, 1, 'james', '2017-03-04 04:15:57', 'Staff', 0),
(152, 146, 0, 1, 'youtube', '2017-03-04 04:16:39', 'Staff', 0),
(153, 146, 2, 0, 'Hello', '2017-03-04 09:30:22', 'Customer', 0),
(154, 146, 0, 1, 'testing', '2017-03-04 09:30:53', 'Staff', 0),
(155, 146, 2, 0, 'How are you admin?', '2017-03-04 09:34:30', 'Customer', 0),
(156, 146, 0, 1, 'Hello', '2017-03-04 09:40:56', 'Staff', 0),
(157, 145, 0, 1, 'sdfsf', '2017-03-04 09:42:21', 'Staff', 0),
(158, 146, 0, 1, 'hi', '2017-03-04 09:44:28', 'Staff', 0),
(159, 147, 2, 0, 'Hello', '2017-03-04 09:49:56', 'Customer', 0),
(160, 147, 0, 1, 'Hello', '2017-03-04 09:50:19', 'Staff', 0),
(161, 147, 0, 1, 'test message', '2017-03-04 09:50:46', 'Staff', 0),
(162, 147, 2, 0, 'hello', '2017-03-04 10:03:50', 'Customer', 0),
(163, 148, 8, 0, 'Hello', '2017-03-04 06:38:42', 'Customer', 0),
(164, 148, 0, 1, 'Hello', '2017-03-04 06:38:54', 'Staff', 0),
(165, 149, 2, 0, 'hello', '2017-03-06 03:48:44', 'Customer', 0),
(166, 150, 14, 0, 'Hiii', '2017-03-06 07:35:21', 'Customer', 0),
(167, 151, 0, 0, 'Ji', '2020-07-18 05:37:31', 'Customer', 0),
(168, 152, 20, 0, 'Hello', '2020-07-20 12:03:04', 'Customer', 0),
(169, 152, 0, 3, 'How can I help you?', '2020-07-20 12:03:58', 'Staff', 0),
(170, 152, 20, 0, 'Item title: aaa <br> Description: ccccccc <br><img src=''upload/1317115632a-small-girl-and-grandmother-with-tablet-at-home-PTDQHPB.jpg'' width=''250px'' height=''250px''>', '2020-07-20 03:45:57', 'Customer', 61),
(171, 152, 20, 3, '\r\n					<strong>Item name: aaa</strong><br>Cost for this cake is : ? 1000 <br>Additional cost/kg : ? 1000<br>Click here to purchase item : <a onClick=''window.open(`cakemenuinfo.php?itemid=61`,`name`,`height=750,width=950`);'' style=''cursor:pointer''><strong>Click here to Place Order</strong></a>', '2020-07-20 03:48:08', 'Staff', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pincode`
--

CREATE TABLE IF NOT EXISTS `pincode` (
  `pincodeid` int(11) NOT NULL AUTO_INCREMENT,
  `pincode` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`pincodeid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pincode`
--

INSERT INTO `pincode` (`pincodeid`, `pincode`, `status`) VALUES
(1, '424001', 'Active'),
(2, '575001', 'Active'),
(3, '575003', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `promocode`
--

CREATE TABLE IF NOT EXISTS `promocode` (
  `promocode_id` int(10) NOT NULL AUTO_INCREMENT,
  `promocode` varchar(25) NOT NULL,
  `promocode_type` varchar(25) NOT NULL,
  `disc_perc` float(10,2) NOT NULL,
  `disc_amt` float(10,2) NOT NULL,
  `expiry_date` date NOT NULL,
  `no_of_qty` int(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`promocode_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `promocode`
--

INSERT INTO `promocode` (`promocode_id`, `promocode`, `promocode_type`, `disc_perc`, `disc_amt`, `expiry_date`, `no_of_qty`, `status`) VALUES
(2, '123456789', 'Percentage discount', 10.00, 0.00, '2017-03-05', 2017, 'Active'),
(3, '234234', 'Flat discount', 0.00, 20.00, '2017-03-31', 2017, 'Active'),
(4, '234234', 'Flat discount', 0.00, 20.00, '2017-03-31', 2017, 'Active'),
(5, '11111', 'Flat discount', 0.00, 100.00, '2020-07-24', 2, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE IF NOT EXISTS `tax` (
  `tax_id` int(10) NOT NULL AUTO_INCREMENT,
  `tax_percentage` float(10,2) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`tax_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tax`
--

INSERT INTO `tax` (`tax_id`, `tax_percentage`, `status`) VALUES
(1, 0.00, '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(25) NOT NULL,
  `login_id` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(25) NOT NULL,
  `mob_no` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_type`, `login_id`, `password`, `name`, `mob_no`, `address`, `status`) VALUES
(3, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Sayali jain', '9812345678', 'Flat.No.302\r\nDatta mandir\r\nDeopur\r\ndhule', 'Active');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
