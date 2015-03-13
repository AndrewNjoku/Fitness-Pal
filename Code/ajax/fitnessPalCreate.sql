
DROP TABLE IF EXISTS customer;
CREATE TABLE customer(
	customerNo INTEGER(4) NOT NULL AUTO_INCREMENT,
	fName varchar(10),
	lName VARCHAR(10),
	gender VARCHAR(6),
	email VARCHAR(40),
	registeredDate VARCHAR(20),
	PRIMARY KEY(customerNo)

);
DROP TABLE IF EXISTS gym;
CREATE TABLE gym
(
	id INTEGER(4) NOT NULL,
	name VARCHAR(30),
	opened VARCHAR(15),
	primary key(id)

);
DROP TABLE IF EXISTS gymContact; 
CREATE TABLE gymContact
(
	
	id INTEGER(4),
	telephone VARCHAR(15),
	email VARCHAR(20),
	website VARCHAR(40),
	PRIMARY KEY(id,telephone),
	FOREIGN KEY(id) REFERENCES gym(id)
);

DROP TABLE IF EXISTS gymLocation;
CREATE TABLE gymLocation
(
	address VARCHAR(40),
	postCode VARCHAR(10),
	borough VARCHAR(10),
	city VARCHAR(10),
	id INTEGER(4),
	customerNo INTEGER(4),
	PRIMARY KEY(postCode),
	FOREIGN KEY(id) REFERENCES gym(id),
	FOREIGN KEY(customerNo) REFERENCES customer(customerNo)
);
DROP TABLE IF EXISTS logIn;
CREATE TABLE logIn
(
	logId INTEGER(4)NOT NULL AUTO_INCREMENT,
	userName VARCHAR(20),
	password VARCHAR(20),
	PRIMARY KEY(logId),
	FOREIGN KEY(logId)REFERENCES customer(customerNo)
	

);






