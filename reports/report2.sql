SELECT *
FROM ads
WHERE
	DATEDIFF(CURDATE(), datePosted) <= 10 AND
    category IN
	(
		SELECT category
		FROM AdCategories
		WHERE parent = 'Buy And Sell'
	);