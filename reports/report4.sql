SELECT *
FROM ads
WHERE category IN
(
	SELECT category
    FROM AdCategories
    WHERE Parent = 'Rent'
);