CREATE TABLE AdCategories
(
  Parent VARCHAR(50) NOT NULL,
  category VARCHAR(100) NOT NULL,
  PRIMARY KEY (category)
);

CREATE TABLE Plans
(
  name VARCHAR(50) NOT NULL,
  numberOfDays INT NOT NULL,
  Price FLOAT NOT NULL,
  PRIMARY KEY (numberOfDays)
);

CREATE TABLE PhysicalStore
(
  SLnum INT NOT NULL,
  cph INT NOT NULL,
  weekendCharge INT NOT NULL,
  PRIMARY KEY (SLnum)
);

CREATE TABLE Cards
(
  type VARCHAR(50) NOT NULL,
  cardHolder VARCHAR(50) NOT NULL,
  cvs INT NOT NULL,
  address VARCHAR(200) NOT NULL,
  expiration DATE NOT NULL,
  cardNumber INT NOT NULL,
  PRIMARY KEY (cardNumber)
);

CREATE TABLE Promotion
(
  name VARCHAR(100) NOT NULL,
  price FLOAT NOT NULL,
  numOfDays INT NOT NULL,
  PRIMARY KEY (numOfDays)
);

CREATE TABLE users
(
  userID INT NOT NULL,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(50) NOT NULL,
  usertype VARCHAR(50) NOT NULL,
  email VARCHAR(200) NOT NULL,
  firstName VARCHAR(50) NOT NULL,
  lastName VARCHAR(50) NOT NULL,
  plan INT NOT NULL,
  card INT NOT NULL,
  PRIMARY KEY (userID),
  FOREIGN KEY (plan) REFERENCES Plans(numberOfDays),
  FOREIGN KEY (card) REFERENCES Cards(cardNumber)
);

CREATE TABLE ads
(
  AdID INT NOT NULL,
  title VARCHAR(50) NOT NULL,
  description VARCHAR(1000) NOT NULL,
  price FLOAT NOT NULL,
  adType VARCHAR(50) NOT NULL,
  address VARCHAR(200) NOT NULL,
  phone INT NOT NULL,
  email VARCHAR(200) NOT NULL,
  forSaleBy VARCHAR(50) NOT NULL,
  image VARCHAR(200) NOT NULL,
  datePosted DATE NOT NULL,
  city VARCHAR(50) NOT NULL,
  province VARCHAR(50) NOT NULL,
  promotion INT NOT NULL,
  ownerID INT NOT NULL,
  category VARCHAR(100) NOT NULL,
  PRIMARY KEY (AdID),
  FOREIGN KEY (promotion) REFERENCES Promotion(numOfDays),
  FOREIGN KEY (ownerID) REFERENCES users(userID),
  FOREIGN KEY (category) REFERENCES AdCategories(category)
);

CREATE TABLE storeAds
(
  deliveryAvailable CHAR(1) NOT NULL,
  AdID INT NOT NULL,
  SLnum INT NOT NULL,
  PRIMARY KEY (AdID),
  FOREIGN KEY (AdID) REFERENCES ads(AdID),
  FOREIGN KEY (SLnum) REFERENCES PhysicalStore(SLnum)
);

CREATE TABLE Transactions
(
  TID INT NOT NULL,
  purchaseType VARCHAR(50) NOT NULL,
  date DATE NOT NULL,
  bill FLOAT NOT NULL,
  item_service VARCHAR(50) NOT NULL,
  buyerID INT NOT NULL,
  sellerID INT NOT NULL,
  card INT NOT NULL,
  PRIMARY KEY (TID),
  FOREIGN KEY (buyerID) REFERENCES users(userID),
  FOREIGN KEY (sellerID) REFERENCES users(userID),
  FOREIGN KEY (card) REFERENCES Cards(cardNumber)
);

CREATE TABLE soldItems
(
  description VARCHAR(100) NOT NULL,
  AdID INT NOT NULL,
  TID INT NOT NULL,
  PRIMARY KEY (TID),
  FOREIGN KEY (AdID) REFERENCES ads(AdID),
  FOREIGN KEY (TID) REFERENCES Transactions(TID)
);