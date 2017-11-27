SELECT COUNTS.category, ownerID AS userID, num_ads
FROM
(
	SELECT *, count(*) AS num_ads
	FROM ads
	GROUP BY category, ownerID
) COUNTS
JOIN
(
	SELECT category, MAX(num_ads) AS max_num
	FROM
    (
		SELECT *, count(*) AS num_ads
		FROM ads
		GROUP BY category, ownerID
	) COUNTS2
	GROUP BY category
) MAXIMUMS
ON COUNTS.category = MAXIMUMS.category
WHERE num_ads = max_num;