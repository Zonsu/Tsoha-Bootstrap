CREATE TABLE Employee(
id SERIAL PRIMARY KEY,
name varchar(30) NOT NULL,
startingDate DATE,
special varchar(120),
introduction varchar(500)
);

CREATE TABLE Service(
id SERIAL PRIMARY KEY,
name varchar(30) NOT NULL,
price INTEGER NOT NULL,
description varchar(500)
);

CREATE TABLE Offered_Services(
serviceID integer REFERENCES Service,
employeeID integer REFERENCES Employee,
PRIMARY KEY (serviceID, employeeID)
); 

