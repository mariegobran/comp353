-- store manager report (ex: manager with userID = 15)
/* The report finds how many people rented the store manager's store last month and how much they earned from that*/
SELECT sellerID, count(bill) as earned , count(TID) as transactions FROM Transactions 
WHERE purchaseType = 'StoreRent' 
AND date>= (NOW() - INTERVAL 1 MONTH)
AND AdID IN (SELECT AdID FROM storeAds WHERE SLnum IN 
                        (SELECT SLnum FROM physicalStore WHERE storeManager = 15))
GROUP BY sellerID;


-- Admin report
/*The report shows how many users with premium plan and 30 day promotion who have sold items in the last month*/

SELECT * FROM users 
WHERE plan = 30 AND promotion =30
AND userID IN (SELECT sellerID FROM Transactions 
                WHERE date>=(NOW() - INTERVAL 1 MONTH));


-- regular user report
-- buyer report (ex: user with userID=89)
/*The report finds all the ads posted by the user where the user is a buyer */
SELECT * FROM ads WHERE userID =89 AND isBuying='y';

-- seller report (ex: user with userID=67)
/* The report show the seller how much they spent to sell their items*/
(SELECT buyerID AS sellerID, count(bill) AS spent FROM Transactions AS buys
WHERE buyerID =67 AND purchaseType= 'storeRent' AND purchaseType= 'promotion'
GROUP BY buyerID)
JOIN
(SELECT sellerID , count(bill) AS earned FROM Transactions As sells
WHERE sellerID = 67 AND purchaseType='onlinePurchase')
ON buys.sellerID = sells.sellerID;

