INSERT INTO Employee (name, startingDate, special, introduction) VALUES ('Jack Bauer', '2013-04-01', 'cool dude', 'Ei koskaan anna periksi');
INSERT INTO Employee (name, startingDate, special, introduction) VALUES ('Elmo', '2011-06-22', 'Värjäys', 'Pehmo');

INSERT INTO Service (name, price, description) VALUES ('Hiustenleikkuu - Lyhyet', '20', 'Lyhyiden hiusten leikkuu ja mallin palautus');

INSERT INTO Offered_Services (employeeID, serviceID) VALUES ('1', '1');
INSERT INTO Offered_Services (employeeID, serviceID) VALUES ('2', '1');

DELETE FROM Employee WHERE id = 2;


