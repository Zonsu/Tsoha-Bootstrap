INSERT INTO Employee (name, special, introduction, username, password, management) VALUES ('Jack Bauer', 'Parturipalvelut', 'Ei koskaan anna periksi', 'munkki', 'pulla', 'true');
INSERT INTO Employee (name, special, introduction, username, password) VALUES ('Elmo', 'Värjäys', 'Pehmo', 'munkki1', 'pulla1');
INSERT INTO Employee (name, special, introduction, username, password) VALUES ('Jossu', 'Opiskelijatyöt', 'Noobi', 'munkki2', 'pulla2');
INSERT INTO Employee (name, special, introduction, management, username, password) VALUES ('Dude', 'Värjäys', 'Pehmo', 'true', 'munkki3', 'pulla3');


INSERT INTO Service (name, price, description) VALUES ('Hiustenleikkuu - Lyhyet', '15', 'Lyhyiden hiusten leikkuu ja mallin palautus');
INSERT INTO Service (name, price, description) VALUES ('Hiustenleikkuu - Keskipitkät', '30', 'Keskipitkien hiusten leikkuu ja mallin palautus');
INSERT INTO Service (name, price, description) VALUES ('Hiustenleikkuu - Lyhyet', '40', 'Pitkien hiusten leikkuu ja mallin palautus');
INSERT INTO Service (name, price, description) VALUES ('Ajo/Otsatukan tasaus', '10', 'Pään ajo koneella tai otsatukan tasaus.');

INSERT INTO Offered_Services (employeeID, serviceID) VALUES ('1', '1');
INSERT INTO Offered_Services (employeeID, serviceID) VALUES ('1', '2');
INSERT INTO Offered_Services (employeeID, serviceID) VALUES ('1', '3');
INSERT INTO Offered_Services (employeeID, serviceID) VALUES ('1', '4');
INSERT INTO Offered_Services (employeeID, serviceID) VALUES ('2', '1');
INSERT INTO Offered_Services (employeeID, serviceID) VALUES ('2', '2');
INSERT INTO Offered_Services (employeeID, serviceID) VALUES ('4', '4');

DELETE FROM Employee WHERE id = 2;

INSERT INTO Client (firstName, lastName, username, password) VALUES ('pöllö', 'pöllönen', 'pulla', 'munkki');





