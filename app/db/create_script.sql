-- Step: 01
-- Goal: Create a new database Jaminmagazijn
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            1-8-2024      Amine Azzamouri           New
-- **********************************************************************************/

-- Check if the database exists
DROP DATABASE IF EXISTS `Jaminmagazijn`;

-- Create a new Database
CREATE DATABASE IF NOT EXISTS `Jaminmagazijn`;

-- Use database Jaminmagazijn
USE `Jaminmagazijn`;


-- Step: 02
-- Goal: Create a new table Magazijn
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            1-8-2024      Amine Azzamouri           New
-- **********************************************************************************/

-- Drop table Magazijn
DROP TABLE IF EXISTS Magazijn;

CREATE TABLE IF NOT EXISTS Magazijn (
    Id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    ProductId VARCHAR(50) NOT NULL,
    VerpakkingsEenheid VARCHAR(50) NOT NULL,
    AantalAanwezig INT NULL,
    PRIMARY KEY (Id)
) ENGINE=InnoDB;


-- Step: 03
-- Goal: Fill table Magazijn with data
-- **********************************************************************************

-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            1-8-2024      Amine Azzamouri           New
-- **********************************************************************************/

INSERT INTO Magazijn (ProductId, VerpakkingsEenheid, AantalAanwezig)
VALUES
    ('1', '5', 453),
    ('2', '2,5', 400),
    ('3', '5', 1),
    ('4', '1', 800),
    ('5', '3', 234),
    ('6', '2', 345),
    ('7', '1', 795),
    ('8', '10', 233),
    ('9', '2,5', 123),
    ('10', '3', NULL),
    ('11', '2', 367),
    ('12', '1', 467),
    ('13', '5', 20);


-- Step: 04
-- Goal: Create a new table Product
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            1-8-2024      Amine Azzamouri           New
-- **********************************************************************************/

-- Drop table Product
DROP TABLE IF EXISTS Product;

CREATE TABLE IF NOT EXISTS Product (
    Id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    Naam VARCHAR(20) NOT NULL,
    Barcode VARCHAR(20) NOT NULL,
    PRIMARY KEY (Id)
) ENGINE=InnoDB;


-- Step: 05
-- Goal: Fill table Product with data
-- **********************************************************************************

-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            1-8-2024      Amine Azzamouri           New
-- **********************************************************************************/

INSERT INTO Product (Naam, Barcode)
VALUES
    ('Mintnopjes', '8719587231278'),
    ('Schoolkrijt', '8719587326713'),
    ('Honingdrop', '8719587327836'),
    ('Zure Beren', '8719587321441'),
    ('Cola Flesjes', '8719587321237'),
    ('Turtles', '8719587322245'),
    ('Witte Muizen', '8719587328256'),
    ('Reuzen Slangen', '8719587325641'),
    ('Zoute Rijen', '8719587322739'),
    ('Winegums', '8719587327527'),
    ('Drop Munten', '8719587322345'),
    ('Kruis Drop', '8719587322265'),
    ('Zoute Ruitjes', '8719587323256');


-- Drop table Allergeen
DROP TABLE IF EXISTS Allergeen;

CREATE TABLE IF NOT EXISTS Allergeen (
    Id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    Naam VARCHAR(20) NOT NULL,
    Omschrijving VARCHAR(100) NOT NULL,
    PRIMARY KEY (Id)
) ENGINE=InnoDB;


-- Step: 09
-- Goal: Fill table Allergeen with data
-- **********************************************************************************

-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            1-8-2024      Amine Azzamouri           New
-- **********************************************************************************/

INSERT INTO Allergeen (Naam, Omschrijving)
VALUES
    ('Gluten', 'Dit product bevat gluten.'),
    ('Gelatine', 'Dit product bevat gelatine.'),
    ('AZO-Kleurstof', 'Dit product bevat AZO-kleurstoffen.'),
    ('Lactose', 'Dit product bevat lactose.'),
    ('Soja', 'Dit product bevat soja.');


-- Step: 12
-- Goal: Create a new table Leverancier
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            1-8-2024      Amine Azzamouri           New
-- **********************************************************************************/

-- Drop table Leverancier
DROP TABLE IF EXISTS Leverancier;

CREATE TABLE IF NOT EXISTS Leverancier (
    Id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    Naam VARCHAR(50) NOT NULL,
    ContactPersoon VARCHAR(50) NOT NULL,
    LeverancierNummer VARCHAR(20) NOT NULL,
    Mobiel VARCHAR(20) NOT NULL,
    PRIMARY KEY (Id)
) ENGINE=InnoDB;


-- Step: 13
-- Goal: Fill table Leverancier with data
-- **********************************************************************************

-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            1-8-2024      Amine Azzamouri           New
-- **********************************************************************************/

INSERT INTO Leverancier (Naam, ContactPersoon, LeverancierNummer, Mobiel)
VALUES
    ('Venco', 'Bert van Linge', 'L1029384719', '06-28493827'),
    ('Astra Sweets', 'Jasper del Monte', 'L1029284315', '06-39398734'),
    ('Haribo', 'Sven Stalman', 'L1029324748', '06-24383291'),
    ('Basset', 'Joyce Stelterberg', 'L1023845773', '06-48293823'),
    ('De Bron', 'Remco Veenstra', 'L1023857736', '06-34291234'),
    ('Quality Street', 'Johan Nooij', 'L1029234586', '06-23458456');



-- Step: 06
-- Goal: Create a new table ProductPerAllergeen
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            1-8-2024      Amine Azzamouri           New
-- **********************************************************************************/

-- Drop table ProductPerAllergeen
DROP TABLE IF EXISTS ProductPerAllergeen;

CREATE TABLE IF NOT EXISTS ProductPerAllergeen (
    Id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    ProductId TINYINT UNSIGNED NOT NULL,
    AllergeenId TINYINT UNSIGNED NOT NULL,
    PRIMARY KEY (Id),
    FOREIGN KEY (ProductId) REFERENCES Product(Id),
    FOREIGN KEY (AllergeenId) REFERENCES Allergeen(Id)
) ENGINE=InnoDB;

-- Step: 07
-- Goal: Fill table ProductPerAllergeen with data
-- **********************************************************************************

-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            1-8-2024      Amine Azzamouri           New
-- **********************************************************************************/

INSERT INTO ProductPerAllergeen (ProductId, AllergeenId)
VALUES
    (1, 2),
    (1, 1),
    (1, 3),
    (3, 4),
    (6, 5),
    (9, 2),
    (9, 5),
    (10, 2),
    (12, 4),
    (13, 1),
    (13, 4),
    (13, 5);


-- Step: 08
-- Goal: Create a new table Allergeen
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            1-8-2024      Amine Azzamouri           New
-- **********************************************************************************/


-- Step: 10
-- Goal: Create a new table ProductPerLeverancier
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            1-8-2024      Amine Azzamouri           New
-- **********************************************************************************/

-- Drop table ProductPerLeverancier
DROP TABLE IF EXISTS ProductPerLeverancier;

CREATE TABLE IF NOT EXISTS ProductPerLeverancier (
    Id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    LeverancierId TINYINT UNSIGNED NOT NULL,
    ProductId TINYINT UNSIGNED NOT NULL,
    DatumLevering DATE NOT NULL,
    Aantal TINYINT UNSIGNED NOT NULL,
    DatumEerstVolgendeLevering DATE NULL,
    PRIMARY KEY (Id),
    FOREIGN KEY (LeverancierId) REFERENCES Leverancier(Id),
    FOREIGN KEY (ProductId) REFERENCES Product(Id)
) ENGINE=InnoDB;


-- Step: 11
-- Goal: Fill table ProductPerLeverancier with data
-- **********************************************************************************

-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            1-8-2024      Amine Azzamouri           New
-- **********************************************************************************/

INSERT INTO ProductPerLeverancier (LeverancierId, ProductId, DatumLevering, Aantal, DatumEerstVolgendeLevering)
VALUES
    (1, 1, '2023-04-09', 23, '2023-04-16'),
    (1, 1, '2023-04-18', 21, '2023-04-25'),
    (1, 2, '2023-04-09', 12, '2023-04-16'),
    (1, 3, '2023-04-10', 11, '2023-04-17'),
    (2, 4, '2023-04-14', 16, '2023-04-21'),
    (2, 4, '2023-04-21', 23, '2023-04-28'),
    (2, 5, '2023-04-14', 45, '2023-04-21'),
    (2, 6, '2023-04-14', 30, '2023-04-21'),
    (3, 7, '2023-04-12', 12, '2023-04-19'),
    (3, 7, '2023-04-19', 23, '2023-04-26'),
    (3, 8, '2023-04-10', 12, '2023-04-17'),
    (3, 9, '2023-04-11', 1, '2023-04-18'),
    (4, 10, '2023-04-16', 24, '2023-04-30'),
    (5, 11, '2023-04-10', 47, '2023-04-17'),
    (5, 11, '2023-04-19', 60, '2023-04-26'),
    (5, 12, '2023-04-11', 45, NULL), 
    (5, 13, '2023-04-12', 23, NULL); 

