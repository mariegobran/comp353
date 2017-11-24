SELECT category, ownerID, max(num_ads)
FROM
(
	SELECT *, count(*) AS num_ads
	FROM ads
	GROUP BY category, ownerID
) t
GROUP BY category;