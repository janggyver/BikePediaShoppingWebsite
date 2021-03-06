-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2016 at 07:20 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ericjang`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `CustomerID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `EmailAddress` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `TitleName` varchar(255) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `AreaCode` varchar(3) NOT NULL,
  `LocalCode` varchar(4) NOT NULL,
  `LastDigit` varchar(4) NOT NULL,
  `AreaCode2` varchar(3) NOT NULL,
  `LocalCode2` varchar(4) NOT NULL,
  `LastDigit2` varchar(4) NOT NULL,
  `AddressLine1` varchar(255) NOT NULL,
  `AddressLine2` varchar(255) NOT NULL,
  `Province` varchar(255) NOT NULL,
  `CreditCardType` varchar(255) NOT NULL,
  `ExpiryMonth` varchar(255) NOT NULL,
  `CardHolderName` varchar(255) NOT NULL,
  `Language` varchar(255) NOT NULL,
  `ExpiryYear` varchar(4) NOT NULL,
  `CreditCardNumber` varchar(255) NOT NULL,
  PRIMARY KEY (`CustomerID`),
  UNIQUE KEY `CustomerID` (`CustomerID`),
  UNIQUE KEY `EmailAddress` (`EmailAddress`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `EmailAddress`, `Password`, `TitleName`, `FirstName`, `LastName`, `AreaCode`, `LocalCode`, `LastDigit`, `AreaCode2`, `LocalCode2`, `LastDigit2`, `AddressLine1`, `AddressLine2`, `Province`, `CreditCardType`, `ExpiryMonth`, `CardHolderName`, `Language`, `ExpiryYear`, `CreditCardNumber`) VALUES
(63, 'joe@nbcc.ca', '8cb2237d0679ca88db6464eac60da96345513964', 'Mr.', 'Joe', 'Marriott', '444', '444', '4444', '333', '333', '3333', '33 Fairville', 'Saint John, E2K 2B1', 'New Brunswick', 'VISA', 'June', 'Joe Marriott', 'English', '2018', 'd422adc7bff0b975bdc39e2e68139e6ef2963f30'),
(68, 'janggyver@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', 'Mrs.', 'Eric', 'Jang', '506', '634', '1265', '506', '663', '1232', '53 Hill Heights Road', 'Saint John, E2K 2B1', 'New Brunswick', 'VISA', 'June', 'Eric Jang', 'Espanol', '2018', 'd422adc7bff0b975bdc39e2e68139e6ef2963f30');

-- --------------------------------------------------------

--
-- Table structure for table `pagedetails`
--

CREATE TABLE IF NOT EXISTS `pagedetails` (
  `PageID` int(3) NOT NULL,
  `Department` varchar(255) NOT NULL,
  `Category` varchar(255) NOT NULL,
  `MetaDesc` varchar(255) NOT NULL,
  PRIMARY KEY (`PageID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pagedetails`
--

INSERT INTO `pagedetails` (`PageID`, `Department`, `Category`, `MetaDesc`) VALUES
(100, 'Bike', 'Road', 'As fast as you can ride. Bike for a road'),
(101, 'Bike', 'MTB', 'Climbing Mountain is same with life'),
(102, 'Bike', 'City', 'No worry for the traffic jam, Enjoy the speed'),
(200, 'Clothing', 'Jacket', 'Getting Warmer, Getting Faster'),
(201, 'Clothing', 'Pants', 'Avoid the resistance of Wind with sexy pants'),
(202, 'Clothing', 'Cap', 'Cap is the end of bike fashion'),
(300, 'Equipment', 'Helmet', 'Guard your head from the enemy'),
(301, 'Equipment', 'Eyewear', 'Your eye wears a fashion'),
(302, 'Equipment', 'Lights', 'Light lights your way for the future'),
(400, 'Registration', 'SignIn', 'Confirm the registration'),
(401, 'Registration', 'Confirm', 'Confirm the registration'),
(402, 'Registration', 'Success', 'Success for the registration'),
(403, 'Registration', 'SignIn', 'Sign In here please'),
(405, 'Cart', 'MyCart', 'Cart Page');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `ProductCode` varchar(10) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `ProductName` varchar(255) CHARACTER SET latin1 NOT NULL,
  `ProductDescription` mediumtext CHARACTER SET latin1 NOT NULL,
  `Category` varchar(255) CHARACTER SET latin1 NOT NULL,
  `Department` varchar(255) CHARACTER SET latin1 NOT NULL,
  `ThumbnailHeight` int(11) NOT NULL,
  `RegularPrice` double NOT NULL,
  `SalePrice` double NOT NULL,
  `SaleStartDate` date NOT NULL,
  `SaleEndDate` date NOT NULL,
  `Option1Desc` varchar(255) CHARACTER SET latin1 NOT NULL,
  `Option1a` varchar(255) CHARACTER SET latin1 NOT NULL,
  `Option1b` varchar(255) CHARACTER SET latin1 NOT NULL,
  `Option1c` varchar(255) CHARACTER SET latin1 NOT NULL,
  `Option1d` varchar(255) CHARACTER SET latin1 NOT NULL,
  `Stock` int(11) NOT NULL,
  PRIMARY KEY (`ProductCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductCode`, `ProductName`, `ProductDescription`, `Category`, `Department`, `ThumbnailHeight`, `RegularPrice`, `SalePrice`, `SaleStartDate`, `SaleEndDate`, `Option1Desc`, `Option1a`, `Option1b`, `Option1c`, `Option1d`, `Stock`) VALUES
('BIKE101', '2017 Trek Domane SLR 9 eTap', 'Sometimes you get up before dawn to bag a century before lunch, and sometimes the best roads are the least maintained; Trek`s Domane SLR will revolutionize how you experience long days and rough roads, making your favorite rides even more memorable. Developed in close coordination with the cobbles-racing master, Fabian Cancellara, this feather-weight carbon rocket offers a rear IsoSpeed system that allows you to adjust and dial in the compliance based on your terrain, riding style, and personal preference. Taking endurance-oriented comfort even further, Trek adds IsoSpeed to the front end, decoupling the steerer tube from the head tube and increasing compliance by 10%. ', 'Road', 'Bike', 100, 14, 0, '0000-00-00', '0000-00-00', 'WheelSize', '', '', '54cm', '60cm', 5),
('BIKE102', '2016 Trek Speed Concept 9.5', 'Real-world testing gives you real-world results with Trek`s Speed Concept 9.5. To bolster its performance, this aero rocket denies the clock with a US-made carbon frame that uses slippery Kammtail tubing. Those tubes are light, stiff, and amazingly aero, even in cross winds. On this rocket, nothing was overlooked: internal cable routing, hidden quick releases, built-in brakes, computer sensors, even integrated storage and computer mounts, are all designed for aerodynamic speed. And, it`s one of the most adjustable bikes available, so dial in the perfect tuck and push out every watt. Of course, the 9.5 is built for velocity with high-end specs, including 11-speed SRAM Force, carbon TT bars and frictionless Race Lite wheels.', 'Road', 'Bike', 73, 18, 0, '0000-00-00', '0000-00-00', 'Color', 'Red', 'White', '', 'Pink', 2),
('BIKE103', '2018 Trek Domane SL 6 Pro', 'Domane with IsoSpeed has it all: Blistering speed. Incredible race comfort and stability, even on the punishing pav? of Flanders and Roubaix. Don?t endure. Conquer. \nPowering over centuries-old cobbles, charging up dizzying climbs, descending on rails to an epic win. That`s how Fabian Cancellara rides his Domane. How will you ride yours? ', 'Road', 'Bike', 82, 5, 0, '0000-00-00', '0000-00-00', 'Features', 'The smooth advantage \n', 'Front and Rear IsoSpeed decouplers smooth rough roads ', '500 Series OCLV Carbon frame lets you ride stronger, longer ', 'Additional tire clearance for on- and off-road versatility ', 1),
('BIKE201', '2016 Trek 3500', 'Trek`s 3500 is a legit mountain bike ready for every adventure, in the city and the woods. Trek`s aluminum frame is light for nimble handling, easy acceleration, and quick climbing. It`s also built tough so it`s fully capable of handing real XC trail riding. The 3500`s 75mm-travel suspension fork dispatches bumps, rocks, and roots with ease, grace, and confidence. This ripper delivers in the specs department too, with quick-shifting 21-speed Shimano gearing that makes easy work of the hills, and a set of Bontrager wheels with fat, knobby tires.', 'MTB', 'Bike', 61, 499.99, 0, '0000-00-00', '0000-00-00', 'WheelSize', '19.5inch', '', '', '', 0),
('BIKE202', '2016 Liv Tempt 4 - Women`s (Canada)', 'Liv`s Tempt 4 can take you from your first dirt foray to singletrack adventures. It all starts with Liv`s ALUXX aluminum frame that`s light and responsive with confidence-inspiring stand-over room. Then you get a SunTour fork with 100mm of plush suspension and precise steering to guide you through the rough stuff. It`s packed full of Shimano components with 24 speeds for hill-climbing and Tektro disc brakes for great speed control. Giant`s 27.5-inch wheels and Maxxis tires provide sure-footed grip to roll over obstacles in your path.', 'MTB', 'Bike', 60, 699.99, 500.99, '0000-00-00', '0000-00-00', 'Size', 'S', 'M', 'L', 'XL', 10),
('BIKE203', '2015 Radio Griffin 26`` (AM or PRO)', 'The Griffin 26`` by Radio is a dirt jumping bike. This type of bike is designed to (as the name suggests) jump and therefore tends to be lighter to help with takeoff, and sturdier to help with the landing. The 26 inch wheels are a bit larger than most BMX wheels. The larger wheels are normally used by larger riders who feel too cramped on the standard 20`` wheels. ', 'MTB', 'Bike', 67, 1, 0, '0000-00-00', '0000-00-00', 'Specifications', 'Frame: Full CrMo, intg. seat clamp, double gussett ', 'Fork: ROCKSHOX ``Argyle R``, 100mm travel ', 'Headset: SALT ?PRO? int. headset, sealed bearing ', '', 0),
('BIKE301', 'Kona Rove AL', 'Where do you want to wander today? Kona`s Rove AL has you covered whether you`re heading to work on the pavement, hitting the gravel paths with the family, or saddling up for the local cyclocross race. With a full aluminum frame and fork for instant response, and a Shimano/FSA 16-speed drivetrain, you have an adventure-ready machine with a wide gear range so you can push as hard as you want or spin easy up the climbs. To reel it in, Hayes disc brakes give you the modulation to slow down and the reliability to stop in virtually all conditions. What`s more, a sturdy WTB wheelset and premium Schwalbe tires roll on for miles and miles, while a Kona stem, handlebar, seatpost, and saddle give you the reliability you need for everyday commuting or weekend adventuring.', 'City', 'Bike', 60, 999.99, 594.99, '0000-00-00', '0000-00-00', 'WheelSize', '49.5cm', '', '', '', 2),
('BIKE302', '2015/2016 Electra Girl`s Hawaii 1 (16-inch)', 'Electra`s Girl`s Hawaii 1 is a fun and stylish starter bike they`ll love. It sports a fine Electra frame, reliable and easy-rolling wheels, an easy-to-operate coaster-brake drivetrain, removable heavy-duty training wheels for learning to ride, and a nice seat for comfort. They`ll also enjoy the matching fenders and chainguard.', 'City', 'Bike', 65, 349.99, 0, '0000-00-00', '0000-00-00', 'Year', '2015', '2016', '', '', 2),
('BIKE303', '2016 Giant Expressway 2', 'Turn transportation nightmares into smooth rolling fun with Giant`s Expressway 2. Its lightweight, durable aluminum frame folds into a carry bag for easy traveling and storing. A 7-speed Shimano drivetrain allows you to find the perfect gear so you can get the 20-inch Kenda Kwest tires up to speed. Linear-pull brakes modulate your speed as you navigate to your destination, Giant`s Comfort saddle provides an enjoyable ride, and the Expressway`s kickstand means you can park it anywhere.', 'City', 'Bike', 67, 589.99, 0, '0000-00-00', '0000-00-00', '', '', 'BOGO', '', '', 7),
('CLOT101', 'Gore Bike Wear Element Windstopper Soft Shell Lady Jacket', 'Gore`s Element Windstopper Soft Shell Lady jacket is the perfect choice for any cycling tour in cold conditions. Maximum breathability and warming windproofness give you a comfortable feeling inside, for unrestricted fun outside. ', 'Jacket', 'Clothing', 100, 199, 0, '0000-00-00', '0000-00-00', 'Color', 'Red', 'White', 'Black', 'Pink', 2),
('CLOT102', 'Gore Bike Wear Path Jacket', 'Bring along reliable weather protection with Gore`s Path Jacket. Gore`s lightweight shell provides plenty of weather protection for even the soggiest rides. To enhance your cycling comfort, this great jacket features an on-the-bike cut with pre-curved elbows. Additional details for complete coverage include velcro fasteners for a hood (sold separately) and an adjustable collar and hem with easy one-handed draw-cords. The front zip with draft flap lets you dial in your temperature just right. And, there`s a zip chest pocket, a zip back pocket and reflective accents for enhanced visibility.', 'Jacket', 'Clothing', 97, 249.99, 125, '0000-00-00', '0000-00-00', 'Color', 'Red', 'Black', '', '', 12),
('CLOT103', 'Bontrager Rhythm Windshell Jacket', 'Repel the elements on those blustery days with the Bontrager Rhythm Windshell Jacket. This lightweight jacket is wind-resistant, repels water, and keeps you seen with integrated reflective details. Mesh inserts in back and underarms provide much-needed ventilation when the pace quickens. ', 'Jacket', 'Clothing', 100, 109.99, 0, '0000-00-00', '0000-00-00', 'Size', 'S', 'M', 'L', 'XL', 100),
('CLOT201', 'Sugoi RPM Shorts', 'Sugoi`s RPM Shorts are excellent for everyday riding. Constructed from 8 panels of Sugoi`s soft, quick-drying P3 fabric these shorts will keep you dry and comfortable. Plus, their luxurious S.100 chamois uses seamless molded construction with a soft, brushed surface while the flat elastic waist, flatlock seams and wide leg bands enhance all-around comfort. ', 'Pants', 'Clothing', 141, 60, 0, '0000-00-00', '0000-00-00', 'Size', 'Small', '', '', '', 5),
('CLOT202', 'Club Ride Transit Pant - Women`s', 'Club Ride?s stylish Transit Pants are relaxed through the hips and thighs for riding comfort. The StretchRide9 fabric is lightweight, quick-drying, and breathable. Plus, a mid-rise waistband and NoCrackBack panel keep you covered during your commutes. Traveling at night? Well-placed reflective accents highlight the Transit`s side zip pocket, belt loop, and the inside pant cuff for enhanced visibility.', 'Pants', 'Clothing', 288, 129, 0, '0000-00-00', '0000-00-00', 'Size', 'Small', '', '', '', 3),
('CLOT203', 'Bontrager Solstice Tights', 'Bontrager`s Solstice Tights are made from quick-drying compression fabric that breathes well and supports your muscles while riding. The ergonomic cut and easy-fit waistband ensure a comfortable fit and wonderful mobility. Silicone grippers keep them in place and ankle zips make them easy to get on and off. Reflective accents keep you visible during those low-light, shoulder-season rides.', 'Pants', 'Clothing', 100, 94.99, 0, '0000-00-00', '0000-00-00', 'Size', 'S', 'M', 'L', 'XL', 6),
('CLOT301', 'Bontrager Turnback Beanie', 'Bontrager Turnback Beanie is the most fantastic bike in the world.', 'Cap', 'Clothing', 101, 36.99, 0, '0000-00-00', '0000-00-00', 'Color', 'Orange', 'Blue', '', '', 30),
('CLOT302', 'Bontrager Classique Thermal Cycling Cap', 'Bontrager Classique Thermal Cycling Cap', 'Cap', 'Clothing', 100, 59.99, 0, '0000-00-00', '0000-00-00', 'Color', 'Blue', 'Black', 'Green', '', 15),
('CLOT303', 'Bontrager Pom Pom Beanie', 'Bontrager Pom Pom Beanie', 'Cap', 'Clothing', 137, 39.99, 0, '0000-00-00', '0000-00-00', 'Color', 'Gray', 'Pink', 'Red', '', 11),
('EQUI101', 'Bontrager Solstice Youth', 'Bontrager`s Solstice offers the protection kids need and the comfort they demand in a lightweight, stylish package. It features tough, in-mold construction for safety and durability, along with a bunch of large vents for cooling ventilation. Bontrager`s LockDown side straps and Micro-Manager Fit System gives them a custom fit that is tailor-made just for them. Plus, it sports a removable, snap-on visor, too. ', 'Helmet', 'Equipment', 72, 51.99, 0, '0000-00-00', '0000-00-00', 'Color', 'Yellow', 'Pink', 'Blue', 'Black', 4),
('EQUI102', 'Bell Segment Jr. - Kids', 'Blending the style of a classic skate helmet with head-hugging comfort and advanced fit technologies, Bell`s Segment Jr. gives action sport groms everything they need. The secret to its comfort is Bell FormFit, which makes the helmet fit more like a comfortable cap than a hard-shell helmet. The eight internal segments are connected by a reinforcing skeleton. Segment Jr. meets both skate and BMX safety standards, making it the perfect everyday helmet for active mini-shredders.', 'Helmet', 'Equipment', 74, 69.99, 0, '0000-00-00', '0000-00-00', 'Size', 'Small', '', '', '', 3),
('EQUI103', 'Giro Dime MIPS', 'The Dime is a kid-sized version of Giro`s rugged Quarter adult helmet so it has all of the same great features ? an EPS liner for impact management, a tough outer shell, riveted webbing anchors and plush, sweat absorbent pads that are easy to swap for dialing in the fit. Another standout feature ? the polyurethane coating helps to protect the EPS liner from daily wear and tear.', 'Helmet', 'Equipment', 100, 99.99, 0, '0000-00-00', '0000-00-00', 'Size', 'S', 'M', 'L', 'XL', 8),
('EQUI104', 'Good Helmet', 'Another standout feature ? the polyurethane coating helps to protect the EPS liner from daily wear and tear.', 'Helmet', 'Equipment', 58, 9.99, 0, '0000-00-00', '0000-00-00', 'Thorn', '1S', '2S', '3S', '', 8),
('EQUI105', 'Nice Helmet Stuff', 'We can communicate each other with this helmet.\r\n\r\nTry to enjoy chat during biking.', 'Helmet', 'Equipment', 67, 1000, 0, '0000-00-00', '0000-00-00', 'Color', 'Green', 'Black', 'White', 'Yellow', 8),
('EQUI201', 'Lezyne Micro Drive Rear', 'Make your presence known with Lezyne`s Micro Drive Rear light. This USB rechargeable light outputs four different flash modes and two steady modes; including a constant, ultra-bright 30 lumen red LED light or an incredibly bright 70 lumen daytime flash. The light easily attaches to a wide range of round seatposts via a snap-fit mount with a multi-position, silicon rubber strap for tool-less installation.', 'Lights', 'Equipment', 56, 69.99, 0, '0000-00-00', '0000-00-00', 'Color', 'Blue', 'Red', 'Green', '', 3),
('EQUI202', 'Bontrager Ember USB Taillight', 'Trek?s Ember USB Taillight is a convenient way to be more visible at night! This super-compact light has a single red LED that can be run in steady or flashing mode and can bee seen from 2,000 feet! Easily rechargeable with a micro USB port, the Ember quickly attaches to just about any part of your bike or helmet and is sure to keep you safe with its 8 lumen of rear brightness.', 'Lights', 'Equipment', 119, 39.99, 0, '0000-00-00', '0000-00-00', 'Specifcation', '1000 Lumen', '2000 Lumen', '10000 Lumen', '', 15),
('EQUI203', 'Topeak HeadLux', 'Topeak`s HeadLux helmet light is the Siamese twin of bike lights. This one light does double duty with two super-bright LEDs facing forward and two red LEDs facing the rear. Its 3 modes and wrap around lenses ensure you`ll be seen. A nice supplement to your regular light set, the HeadLux is a convenient way to add extra safety to your commute. Plus, batteries are included.', 'Lights', 'Equipment', 66, 24.99, 0, '0000-00-00', '0000-00-00', 'Weight', '100 g', '', '', '', 13),
('EQUI301', 'Ryders Eyewear Trapper Polarized', 'Treat your eyes with Ryders Eyewear`s Trapper Polarized glasses. The big polarized lenses cut down on glare so you see clearly, and they offer total UV protection, a hydrophobic coating, and shatterproof construction. TR90 frames give you just the right amount of flex for a comfortable fit, while the hydrophilic nose pads and temple tips hold strong even when wet. And for even more comfort, the Trappers have wide temples so the fit is just right. Don`t be surprised when you forget these stellar glasses are even on your face: they weigh a feathery 32 grams, after all. ', 'Eyewear', 'Equipment', 37, 79.99, 0, '0000-00-00', '0000-00-00', 'LensColor', 'Black', 'Brown', '', '', 10),
('EQUI302', 'Ryders Eyewear Strider', 'Ryders Eyewear`s Striders will keep you looking cool, no matter how hot the day gets. They have hydrophilic temple tips and adjustable nose pads so they stay in place and are exceptionally comfortable. You`ll also love that they have scratch-resistant, shatterproof polycarbonate lenses that are optically correct for perfect vision. They also offer 100% UV protection, deflect moisture and are fog-free.', 'Eyewear', 'Equipment', 34, 49.99, 0, '0000-00-00', '0000-00-00', 'LensColor', 'Black', 'Brown', '', '', 9),
('EQUI303', 'Ryders Eyewear Face Photochromic', 'Ryders Eyewear calls this model The Face because they`re so comfortable you`ll think they`re part of your face. The TR90 frames certainly lend truth to that notion with extreme flexibility for stellar comfort, not to mention hydrophilic nose pads and temple tips that keep everything in place, even when wet. The lenses feature photochromic technology that adjusts the tint of the lenses to suit ever-changing light levels. They`re shatterproof and scratch-resistant, too. More importantly, they`re optically correct, which means you get a clear, true view in any direction. Throw in UV protection for even more protection.', 'Eyewear', 'Equipment', 37, 79.99, 0, '0000-00-00', '0000-00-00', 'LensColor', 'Black', 'Brown', '', '', 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
