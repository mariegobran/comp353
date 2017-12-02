# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: pvc353_2.encs.concordia.ca (MySQL 5.6.37)
# Database: pvc353_2
# Generation Time: 2017-11-21 21:45:19 +0000
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
  `selling` int(1) NOT NULL,
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

INSERT INTO `ads` (`AdID`, `title`, `description`, `price`, `isBuying`, `address`, `phone`, `email`, `isBusiness`, `image`, `datePosted`, `city`, `promotion`, `ownerID`, `category`, `selling`)
VALUES
	(2,'Winter Jacket 2017','Selling my Winter Jacket barely worn',450,'n','12 Av.McDougal',51412345,'MichaelJackson@gmail.com','n','image01.png','2017-11-09','Montreal',7,58,'Clothing',1),
	(3,'Summer Jacket 2016','Looking to sell a summer jacket, a bit worn out',50,'n','Fairview Pointe-Claire',51482308,'privateselling@gmail.com','n','image02.png','2016-07-01','Montreal',7,1,'Clothing',0),
	(5,'Catcher in the Rye','Looking to buy used book, most conditions acceptable',10,'y','Fairview Pointe-Claire',51482299,'nickb@gmail.com','n','image03.png','2017-11-02','Montreal',7,1,'Books',0),
	(6,'Flowers for Algernon','Looking to sell this book, slightly used',5,'n','12 Av.McDougal',51412346,'MichealJackson2@gmail.com','n','image04.png','2017-11-08','Montreal',7,2,'Books',0);

/*!40000 ALTER TABLE `ads` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
