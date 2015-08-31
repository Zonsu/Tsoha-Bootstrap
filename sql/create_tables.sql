
CREATE TABLE Employee(
id SERIAL PRIMARY KEY,
name varchar(30) NOT NULL,
special varchar(120),
introduction varchar(500),
management boolean DEFAULT FALSE,
username varchar(20),
password varchar(50)

);

CREATE TABLE Service(
id SERIAL PRIMARY KEY,
name varchar(30) NOT NULL,
price INTEGER NOT NULL,
description varchar(500)
);

CREATE TABLE Offered_Services(
serviceID integer REFERENCES Service ON DELETE CASCADE,
employeeID integer REFERENCES Employee ON DELETE CASCADE,
PRIMARY KEY (serviceID, employeeID)
);

CREATE TABLE Client(
ID SERIAL PRIMARY KEY,
firstName varchar(30) NOT NULL,
lastName varchar(30) NOT NULL,
username varchar(20),
password varchar(50)
);



