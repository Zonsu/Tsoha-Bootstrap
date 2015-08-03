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

ALTER TABLE Employee ADD serviceID INTEGER REFERENCES Service(id);
ALTER TABLE Service ADD employeeID INTEGER REFERENCES Employee(id); 

