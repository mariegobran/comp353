SELECT *
FROM users
WHERE userID IN
(
	SELECT ownerID
    FROM ads INNER JOIN Locations ON ads.city = Locations.city
    WHERE (UPPER(title) LIKE UPPER('%winter%men%jacket') OR UPPER(title) LIKE UPPER('%men%winter%jacket'))
		AND province = 'Quebec'
);