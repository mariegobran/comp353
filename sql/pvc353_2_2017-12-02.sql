# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: pvc353_2.encs.concordia.ca (MySQL 5.6.37)
# Database: pvc353_2
# Generation Time: 2017-12-02 21:15:14 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table ads
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ads`;

CREATE TABLE `ads` (
  `AdID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `price` float NOT NULL,
  `isBuying` char(1) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `isBusiness` char(1) NOT NULL,
  `image` varchar(200) NOT NULL,
  `datePosted` date NOT NULL,
  `city` varchar(50) NOT NULL,
  `promotion` int(11) NOT NULL,
  `ownerID` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `deleted` varchar(10) DEFAULT '',
  `rating` float DEFAULT NULL,
  PRIMARY KEY (`AdID`),
  KEY `promotion` (`promotion`),
  KEY `ownerID` (`ownerID`),
  KEY `category` (`category`),
  KEY `city` (`city`),
  CONSTRAINT `ads_ibfk_1` FOREIGN KEY (`promotion`) REFERENCES `Promotion` (`numOfDays`),
  CONSTRAINT `ads_ibfk_2` FOREIGN KEY (`ownerID`) REFERENCES `users` (`userID`),
  CONSTRAINT `ads_ibfk_3` FOREIGN KEY (`category`) REFERENCES `AdCategories` (`category`),
  CONSTRAINT `ads_ibfk_4` FOREIGN KEY (`city`) REFERENCES `Locations` (`city`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `ads` WRITE;
/*!40000 ALTER TABLE `ads` DISABLE KEYS */;

INSERT INTO `ads` (`AdID`, `title`, `description`, `price`, `isBuying`, `address`, `phone`, `email`, `isBusiness`, `image`, `datePosted`, `city`, `promotion`, `ownerID`, `category`, `deleted`, `rating`)
VALUES
	(2,'Winter Jacket 2017','Selling my Winter Jacket barely worn',450,'n','12 Av.McDougal',51412345,'MichaelJackson@gmail.com','n','image01.png','2017-11-18','Montreal',7,58,'Clothing',NULL,3.15385),
	(3,'Summer Jacket 2016','Looking to sell a summer jacket, a bit worn out',50,'n','Fairview Pointe-Claire',51482308,'privateselling@gmail.com','n','image02.png','2016-07-01','Montreal',7,1,'Clothing',NULL,2.42857),
	(5,'Winter men\'s jacket','Looking to buy cheap jacket',10,'y','Fairview Pointe-Claire',51482299,'nickb@gmail.com','n','image03.png','2017-11-17','Montreal',7,1,'Clothing',NULL,4.6875),
	(6,'Flowers for Algernon','Looking to sell this book, slightly used',5,'n','12 Av.McDougal',51412346,'MichealJackson2@gmail.com','n','image04.png','2017-11-16','Montreal',7,2,'Books',NULL,NULL),
	(7,'Catcher in the Rye','Looking for this book. Help!',25,'y','15 Av.McDougal',51412387,'newuser@gmail.com','n','image05.png','2016-05-06','Toronto',7,59,'Books',NULL,NULL),
	(8,'Used Mazda 2005','Decent condition, low mileage',2500,'n','17 Av.McDougal',45012455,'newuser2@gmail.com','n','image06.png','2017-11-20','Montreal',7,58,'Car',NULL,NULL),
	(9,'Used computer','Cheap parts, low price',150,'n','17 Av.McDougal',51488912,'new123@gmail.com','n','image07.png','2017-11-15','Montreal',7,71,'Electronics',NULL,NULL),
	(10,'Used phone','Selling phone in good condition ,cheap price',60,'n','20 Av.McRoy',45010203,'stores@gmail.com','y','image07.png','2017-12-13','Ottawa',30,76,'Electronics','',NULL),
	(15,'Customer Service Operator','Looking for a job in customer service ',50,'n','22Av.McRoy',34502939,'eglen@live.com','n','image08.png','2017-11-25','Edmenton',0,77,'Customer Service','',NULL),
	(16,'Mathematics private teaching','Math private tutoring',0,'y','24Av.McRoy',45023293,'SofiaPl2@gmail.com','n','image09.png','2017-12-30','Calgary',60,69,'Tutors','',NULL),
	(17,'Renting appartment','Renting my appartment 6.5',1500,'n','43.Av.Ferol',51402599,'JuanR@gmail.com','n','image10.png','2017-01-21','Laval',30,66,'Appartment','',NULL),
	(18,'Wedding dress rentals','Many types of wedding dress to rent',400,'n','54.Av.Lardi',51429040,'JBrown12@gmail.com','y','image11.png','2016-03-14','Vancouver',60,72,'Wedding Dresses','',NULL),
	(19,'Guitar Accoustic','Looking for an accoustic guitar',200,'y','45Av.What',51429039,'LionelR@gmail.com','n','image12.png','2017-03-15','Kelowna',7,70,'Musical Instruments','',NULL),
	(20,'Party Planners','Plan your party - Low price',450,'n','34.Av.Free',51429493,'AlHay@gmail.com','y','image13.png','2017-02-12','Victoria',60,61,'Event Planners','',NULL),
	(21,'Personal gym trainer','Offer service of personal training , cheap price',25,'n','45.Av.Kol',45019320,'RMcPhee@gmail.com','n','image14.png','2017-03-22','Hamilton',0,74,'Personal Trainers','',NULL),
	(22,'Management job','Lookign for job in management',0,'n','99.Av.Hunor',45019103,'AlfoncePet@gmail.com','n','image15.png','2017-04-30','LethBridge',30,1,'Management','',NULL);

/*!40000 ALTER TABLE `ads` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
