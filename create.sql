DROP TABLE IF EXISTS customer;
CREATE TABLE customer(
	customerNo INTEGER(4) NOT NULL AUTO_INCREMENT,
	fName varchar(10),
	lName VARCHAR(10),
	gender VARCHAR(6),
	email VARCHAR(40),
	userName VARCHAR(20),
	password VARCHAR(50),
	registeredDate VARCHAR(20),
	PRIMARY KEY(customerNo)
);
