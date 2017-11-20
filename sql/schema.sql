AdCategories(parent, category)
	category → parent

Plans(name, numberOfDays, price)
	name → numberOfDays, numberOfDays → price

PhysicalStore(SLnum, cph, weekendCharge, storeManager)
	SLnum → cph, SLnum → weekendCharge, SLnum → storeManager

Cards(type, cardholder, cvs, address, expiration,  cardNumber)
	cardNumber → {everything}

Promotion(name, price, numOfDays)
	name → numberOfDays, numberOfDays → price

users(userID, username, password, usertype, email, firstName, lastName, plan, card)
	userID → username, userID → password, userID → usertype, userID → email, userID → firstName, userID → lastName, userID → plan, userID → card

ads(adID, title, description, price, adType, address, phone, forSaleBy, image, datePosted, city, promotion, ownerID, category)
	adID → {everything}

location(city, province)
	city → province

storeAds(deliveryAvailable, adID, SLnum)
	adID → {everything}

Transactions(TID, purchaseType, date, bill, item_service,  buyerID, sellerID, card)
	TID → {everything}

soldItems(description, adID, TID)
	TID → {everything}
