-- sql code taken from SQL Pro DBMS

-- Create syntax for TABLE 'AdCategories'
CREATE TABLE `AdCategories` (
  `Parent` varchar(50) NOT NULL,
  `category` varchar(100) NOT NULL,
  PRIMARY KEY (`category`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Create syntax for TABLE 'ads'
CREATE TABLE `ads` (
  `AdID` int(11) NOT NULL,
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

-- Create syntax for TABLE 'Cards'
CREATE TABLE `Cards` (
  `type` varchar(50) NOT NULL,
  `cardHolder` varchar(50) NOT NULL,
  `cvs` int(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `expiration` date NOT NULL,
  `cardNumber` int(11) NOT NULL,
  PRIMARY KEY (`cardNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Create syntax for TABLE 'PhysicalStore'
CREATE TABLE `PhysicalStore` (
  `SLnum` int(11) NOT NULL,
  `cph` int(11) NOT NULL,
  `weekendCharge` int(11) NOT NULL,
  PRIMARY KEY (`SLnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Create syntax for TABLE 'Plans'
CREATE TABLE `Plans` (
  `name` varchar(50) NOT NULL,
  `numberOfDays` int(11) NOT NULL,
  `Price` float NOT NULL,
  PRIMARY KEY (`numberOfDays`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Create syntax for TABLE 'Promotion'
CREATE TABLE `Promotion` (
  `name` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `numOfDays` int(11) NOT NULL,
  PRIMARY KEY (`numOfDays`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Create syntax for TABLE 'soldItems'
CREATE TABLE `soldItems` (
  `description` varchar(100) NOT NULL,
  `AdID` int(11) NOT NULL,
  `TID` int(11) NOT NULL,
  PRIMARY KEY (`TID`),
  KEY `AdID` (`AdID`),
  CONSTRAINT `soldItems_ibfk_1` FOREIGN KEY (`AdID`) REFERENCES `ads` (`AdID`),
  CONSTRAINT `soldItems_ibfk_2` FOREIGN KEY (`TID`) REFERENCES `Transactions` (`TID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Create syntax for TABLE 'storeAds'
CREATE TABLE `storeAds` (
  `deliveryAvailable` char(1) NOT NULL,
  `AdID` int(11) NOT NULL,
  `SLnum` int(11) NOT NULL,
  PRIMARY KEY (`AdID`),
  KEY `SLnum` (`SLnum`),
  CONSTRAINT `storeAds_ibfk_1` FOREIGN KEY (`AdID`) REFERENCES `ads` (`AdID`),
  CONSTRAINT `storeAds_ibfk_2` FOREIGN KEY (`SLnum`) REFERENCES `PhysicalStore` (`SLnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Create syntax for TABLE 'Transactions'
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

-- Create syntax for TABLE 'users'
CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `usertype` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `plan` int(11) NOT NULL,
  `card` int(11) NOT NULL,
  PRIMARY KEY (`userID`),
  KEY `plan` (`plan`),
  KEY `card` (`card`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`plan`) REFERENCES `Plans` (`numberOfDays`),
  CONSTRAINT `users_ibfk_2` FOREIGN KEY (`card`) REFERENCES `Cards` (`cardNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;