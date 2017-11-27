SELECT AVERAGES.category, ownerID AS userID, avg_rating
FROM
(
	SELECT category, ownerID, AVG(rating) AS avg_rating
	FROM (ads INNER JOIN soldItems ON ads.AdID = soldItems.AdID) NATURAL JOIN Transactions
	WHERE city = 'GIVEN_CITY' AND isBuying = 'n'
	GROUP BY category, ownerID
) AVERAGES
JOIN
(
	SELECT category, MAX(avg_rating) AS max_avg
	FROM
    (
		SELECT category, ownerID, AVG(rating) AS avg_rating
		FROM (ads INNER JOIN soldItems ON ads.AdID = soldItems.AdID) NATURAL JOIN Transactions
		WHERE city = 'GIVEN_CITY' AND isBuying = 'n'
		GROUP BY category, ownerID
	) AVERAGES2
	GROUP BY category
) MAXIMUMS
ON AVERAGES.category = MAXIMUMS.category
WHERE avg_rating = max_avg;