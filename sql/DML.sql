# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.12)
# Database: eglen_new
# Generation Time: 2017-11-15 21:54:11 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table AdCategories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `AdCategories`;

CREATE TABLE `AdCategories` (
  `Parent` varchar(50) NOT NULL,
  `category` varchar(100) NOT NULL,
  PRIMARY KEY (`category`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `AdCategories` WRITE;
/*!40000 ALTER TABLE `AdCategories` DISABLE KEYS */;

INSERT INTO `AdCategories` (`Parent`, `category`)
VALUES
	('Rent','Appartment'),
	('Buy And Sell','Books'),
	('Rent','Car'),
	('Buy And Sell','Clothing'),
	('Buy And Sell','Electronics'),
	('Rent','Electronics rental'),
	('Services','Event Planners'),
	('Pets','Food'),
	('Buy And Sell','Musical Instruments'),
	('Services','Personal Trainers'),
	('Pets','Pet'),
	('Services','Photographers'),
	('Pets','Services'),
	('Pets','Toys'),
	('Services','Tutors'),
	('Rent','Wedding Dresses');

/*!40000 ALTER TABLE `AdCategories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ads
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ads`;

CREATE TABLE `ads` (
  `AdID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `price` float NOT NULL,
  `adType` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `forSaleBy` varchar(50) NOT NULL,
  `image` varchar(200) NOT NULL,
  `datePosted` date NOT NULL,
  `city` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `promotion` int(11) NOT NULL,
  `ownerID` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  PRIMARY KEY (`AdID`),
  KEY `promotion` (`promotion`),
  KEY `ownerID` (`ownerID`),
  KEY `category` (`category`),
  CONSTRAINT `ads_ibfk_1` FOREIGN KEY (`promotion`) REFERENCES `Promotion` (`numOfDays`),
  CONSTRAINT `ads_ibfk_2` FOREIGN KEY (`ownerID`) REFERENCES `users` (`userID`),
  CONSTRAINT `ads_ibfk_3` FOREIGN KEY (`category`) REFERENCES `AdCategories` (`category`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `ads` WRITE;
/*!40000 ALTER TABLE `ads` DISABLE KEYS */;

INSERT INTO `ads` (`AdID`, `title`, `description`, `price`, `adType`, `address`, `phone`, `email`, `forSaleBy`, `image`, `datePosted`, `city`, `province`, `promotion`, `ownerID`, `category`)
VALUES
	(2,'Winter Jacket 2017','Selling my Winter Jacket barely worn',450,'Online','12 Av.McDougal',51412345,'MichaelJackson@gmail.com','Michael Jackson ','image01.png','2017-11-09','Montreal','Quebec',7,58,'Clothing');

/*!40000 ALTER TABLE `ads` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Cards
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Cards`;

CREATE TABLE `Cards` (
  `type` varchar(50) NOT NULL,
  `cardHolder` varchar(50) NOT NULL,
  `cvs` int(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `expiration` date NOT NULL,
  `cardNumber` int(11) NOT NULL,
  PRIMARY KEY (`cardNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `Cards` WRITE;
/*!40000 ALTER TABLE `Cards` DISABLE KEYS */;

INSERT INTO `Cards` (`type`, `cardHolder`, `cvs`, `address`, `expiration`, `cardNumber`)
VALUES
	('Credit','Al Hayman',467,'649 Av.Zoo','2019-09-16',10492048),
	('Credit','Mark Twayn',342,'145 Av.St Cathy','2021-11-15',14356703),
	('Credit','Angela Merkel',492,'572 Av.Maccay','2020-10-27',14958295),
	('Credit','Edwin LePerce',444,'123 Av.VanHorn','2020-12-01',45019034),
	('Debit','Lionel Ritchie',990,'649 Av.Scranton','2021-11-26',47382949),
	('Credit','Len Faki',538,'663 Av.Maisonneuve','2020-06-15',48292948),
	('Credit','Michael Jackson',991,'993 Av.DeLorimier','2018-05-21',48592093),
	('Credit','Nikita Strodozovski',420,'649 Av.Mont-Royal','2019-03-04',49284929),
	('Credit','Juan Rodriguez',285,'649 Av.Perk','2022-03-13',53920458),
	('Credit','Joseph Riquelme',457,'649 Av.Lewhat','2023-12-23',57482929),
	('Credit','Alfonce Petil',114,'649 Av.Central','2024-04-25',58392810),
	('Debit','Mathieu Heubert',193,'999 Av.Jean-Talon','2023-03-03',67489294),
	('Debit','Jack McDonald',325,'649 Av.Fifth','2020-07-12',68920203),
	('Credit','Sofia Laplume',113,'345 Av.St-Denis','2022-12-29',72492859),
	('Credit','Rachel McPhee',221,'635 Av.St-Laurent','2021-12-30',83275389),
	('Credit','James Brown',683,'432 Av.McRoberts','2019-09-19',90873452),
	('Credit','Natacha Hepart',520,'154 Av.St-Urbain','2019-11-13',99432588);

/*!40000 ALTER TABLE `Cards` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table PhysicalStore
# ------------------------------------------------------------

DROP TABLE IF EXISTS `PhysicalStore`;

CREATE TABLE `PhysicalStore` (
  `SLnum` int(11) NOT NULL,
  `cph` int(11) NOT NULL,
  `weekendCharge` int(11) NOT NULL,
  PRIMARY KEY (`SLnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table Plans
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Plans`;

CREATE TABLE `Plans` (
  `name` varchar(50) NOT NULL,
  `numberOfDays` int(11) NOT NULL,
  `Price` float NOT NULL,
  PRIMARY KEY (`numberOfDays`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `Plans` WRITE;
/*!40000 ALTER TABLE `Plans` DISABLE KEYS */;

INSERT INTO `Plans` (`name`, `numberOfDays`, `Price`)
VALUES
	('Normal',7,10),
	('Silver',14,18),
	('Premium',30,25);

/*!40000 ALTER TABLE `Plans` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Promotion
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Promotion`;

CREATE TABLE `Promotion` (
  `name` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `numOfDays` int(11) NOT NULL,
  PRIMARY KEY (`numOfDays`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `Promotion` WRITE;
/*!40000 ALTER TABLE `Promotion` DISABLE KEYS */;

INSERT INTO `Promotion` (`name`, `price`, `numOfDays`)
VALUES
	('7 Day Promotion',10,7),
	('30 Day Promotion',50,30),
	('60 Day Promotion',90,60);

/*!40000 ALTER TABLE `Promotion` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table soldItems
# ------------------------------------------------------------

DROP TABLE IF EXISTS `soldItems`;

CREATE TABLE `soldItems` (
  `description` varchar(100) NOT NULL,
  `AdID` int(11) NOT NULL,
  `TID` int(11) NOT NULL,
  PRIMARY KEY (`TID`),
  KEY `AdID` (`AdID`),
  CONSTRAINT `soldItems_ibfk_1` FOREIGN KEY (`AdID`) REFERENCES `ads` (`AdID`),
  CONSTRAINT `soldItems_ibfk_2` FOREIGN KEY (`TID`) REFERENCES `Transactions` (`TID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table storeAds
# ------------------------------------------------------------

DROP TABLE IF EXISTS `storeAds`;

CREATE TABLE `storeAds` (
  `deliveryAvailable` char(1) NOT NULL,
  `AdID` int(11) NOT NULL,
  `SLnum` int(11) NOT NULL,
  PRIMARY KEY (`AdID`),
  KEY `SLnum` (`SLnum`),
  CONSTRAINT `storeAds_ibfk_1` FOREIGN KEY (`AdID`) REFERENCES `ads` (`AdID`),
  CONSTRAINT `storeAds_ibfk_2` FOREIGN KEY (`SLnum`) REFERENCES `PhysicalStore` (`SLnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table Transactions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Transactions`;

CREATE TABLE `Transactions` (
  `TID` int(11) NOT NULL,
  `purchaseType` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `bill` float NOT NULL,
  `item_service` varchar(50) NOT NULL,
  `buyerID` int(11) NOT NULL,
  `sellerID` int(11) NOT NULL,
  `card` int(11) NOT NULL,
  PRIMARY KEY (`TID`),
  KEY `buyerID` (`buyerID`),
  KEY `sellerID` (`sellerID`),
  KEY `card` (`card`),
  CONSTRAINT `Transactions_ibfk_1` FOREIGN KEY (`buyerID`) REFERENCES `users` (`userID`),
  CONSTRAINT `Transactions_ibfk_2` FOREIGN KEY (`sellerID`) REFERENCES `users` (`userID`),
  CONSTRAINT `Transactions_ibfk_3` FOREIGN KEY (`card`) REFERENCES `Cards` (`cardNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `usertype` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `plan` int(11) NOT NULL,
  `card` int(11) NOT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `plan` (`plan`),
  KEY `card` (`card`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`plan`) REFERENCES `Plans` (`numberOfDays`),
  CONSTRAINT `users_ibfk_2` FOREIGN KEY (`card`) REFERENCES `Cards` (`cardNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`userID`, `username`, `password`, `usertype`, `email`, `firstName`, `lastName`, `plan`, `card`)
VALUES
	(1,'AlfonceP','mdl4kfl','Regular','AlfoncePet@gmail.com','Aflonce','Petil',7,58392810),
	(2,'RamonJ1','dmsakc','Regular','RamonJ@gmail.com','Ramon','Jackson',30,48592093),
	(58,'Natacha36','vg24lo','Regular','NatchaH12@gmail.com','Natacha','Hepart',7,99432588),
	(59,'Mkael4a','fmskcm','Regular','MichaelJackson@gmail.com','Michael','Jackson',30,48592093),
	(60,'Mark901','facmae','Regular','Mark901@gmail.com','Mark','Twayn',14,14356703),
	(61,'AlHay','cms3fg','Regular','AlHay@gmail.com','Al','Hayman',30,10492048),
	(62,'JosephR','cmsr4l','Regular','JosephR7@gmail.com','Joseph','Riquelme',14,57482929),
	(63,'Edwin13','xemblf','Regular','Edwin@gmail.com','Edwin','LePerce',7,45019034),
	(64,'LenFaki21','cmslf1','Regular','LenFaki@gmail.com','Len','Faki',7,48292948),
	(65,'JackM3','smsal2','Regular','Jack246@gmail.com','Jack','McDonald',14,68920203),
	(66,'JuanR','mlel4l','Regular','JuanR@gmail.com','Juan','Rodriguez',14,45019034),
	(67,'RonFaki3','sdfmsF','Regular','RonaldF@gmail.com','Ronald','Faki',14,48292948),
	(68,'Mathieu32','dklvms','Admin','MatheuHT@gmail.com','Mathieu','Heubert',7,67489294),
	(69,'SofiaL','fmkw2l','Regular','SofiaPl2@gmail.com','Sofia','Laplume',14,72492859),
	(70,'LionelR','CMmfl4','Regular','LionelR@gmail.com','Lionel','Ritchie',7,47382949),
	(71,'AngelaML','smvs23','Regular','AngelMerkel@gmail.com','Angela','Merkel',14,14958295),
	(72,'JBrown12a','fkvml3','Regular','JBrown12@gmail.com','James','Brown',7,90873452),
	(73,'NikitaSz','dmsla23','Regular','NikitaSz@gmail.com','Nikita','Strodozovski',7,49284929),
	(74,'Rachel43','mcl4k','Regular','RMcPhee@gmail.com','Rachel','Mcphee',30,83275389),
	(75,'comp','353','Admin','comp@353.com','Computer','Databases',30,83275389);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
