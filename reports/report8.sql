SELECT DISTINCT PhysicalStore.SLnum, ads.category
FROM PhysicalStore NATURAL JOIN storeAds NATURAL JOIN ads NATURAL JOIN Locations NATURAL JOIN AdCategories
WHERE province = 'GIVEN_PROVINCE' AND Parent = 'Buy And Sell';