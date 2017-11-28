SELECT date, count(*) AS num_payments, sum(bill) AS total_revenue 
FROM Transactions
WHERE DATEDIFF(CURDATE(), Transactions.date) <= 15 AND sellerID = GIVEN_ID AND purchaseType = 'Rent'
GROUP BY date;