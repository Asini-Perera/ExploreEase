-- Create the ExploreEase Database
Create Database ExploreEase;

Use ExploreEase;

-- Create the Traveler table
CREATE TABLE Traveler (
    TravelerID VARCHAR(8) PRIMARY KEY,
    FirstName VARCHAR(50),
    LastName VARCHAR(50),
    Email VARCHAR(100) UNIQUE,
    Password VARCHAR(255),
    Gender ENUM('Male', 'Female', 'Other'),
    DOB DATE,
    ContactNo VARCHAR(15),
    Location VARCHAR(100),
    SMLink VARCHAR(255),
    Description TEXT,
    Expertise TEXT,
    IsContentCreator BOOLEAN
);

-- Trigger to auto-generate TravelerID in the format 'T000001'
DELIMITER / / CREATE TRIGGER trg_TravelerID BEFORE
INSERT
    ON Traveler FOR EACH ROW BEGIN DECLARE maxID INT;

DECLARE newID VARCHAR(8);

SELECT
    MAX(CAST(SUBSTRING(TravelerID, 2) AS UNSIGNED)) INTO maxID
FROM
    Traveler;

SET
    newID = CONCAT('T', LPAD(IFNULL(maxID, 0) + 1, 6, '0'));

SET
    NEW.TravelerID = newID;

END;

/ / DELIMITER;

-- Create the TravelerImages table
CREATE TABLE TravelerImages (
    TravelerID VARCHAR(8),
    ImgPath VARCHAR(255),
    FOREIGN KEY (TravelerID) REFERENCES Traveler(TravelerID)
);

-- Create the TravelerContents table
CREATE TABLE TravelerContents (
    TravelerID VARCHAR(8),
    ContentLink VARCHAR(255),
    FOREIGN KEY (TravelerID) REFERENCES Traveler(TravelerID)
);

-- Create the Admin table
CREATE TABLE Admin (
    AdminID VARCHAR(8) PRIMARY KEY,
    FirstName VARCHAR(50),
    LastName VARCHAR(50),
    Email VARCHAR(100) UNIQUE,
    Password VARCHAR(255),
    ContactNo VARCHAR(15),
    ImgPath VARCHAR(255)
);

-- Trigger to auto-generate AdminID in the format 'A0001'
DELIMITER / / CREATE TRIGGER trg_AdminID BEFORE
INSERT
    ON Admin FOR EACH ROW BEGIN DECLARE maxID INT;

DECLARE newID VARCHAR(6);

SELECT
    MAX(CAST(SUBSTRING(AdminID, 2) AS UNSIGNED)) INTO maxID
FROM
    Admin;

SET
    newID = CONCAT('A', LPAD(IFNULL(maxID, 0) + 1, 4, '0'));

SET
    NEW.AdminID = newID;

END;

/ / DELIMITER;

-- Create the Hotel table
CREATE TABLE Hotel (
    HotelID VARCHAR(8) PRIMARY KEY,
    Name VARCHAR(100),
    Location VARCHAR(100),
    ContactNo VARCHAR(15),
    Email VARCHAR(100) UNIQUE,
    Description TEXT,
    Website VARCHAR(255),
    Password VARCHAR(255),
    SMLink VARCHAR(255),
    AdminID VARCHAR(8),
    FOREIGN KEY (AdminID) REFERENCES Admin(AdminID)
);

-- Trigger to auto-generate HotelID in the format 'H0001'
DELIMITER / / CREATE TRIGGER trg_HotelID BEFORE
INSERT
    ON Hotel FOR EACH ROW BEGIN DECLARE maxID INT;

DECLARE newID VARCHAR(6);

SELECT
    MAX(CAST(SUBSTRING(HotelID, 2) AS UNSIGNED)) INTO maxID
FROM
    Hotel;

SET
    newID = CONCAT('H', LPAD(IFNULL(maxID, 0) + 1, 4, '0'));

SET
    NEW.HotelID = newID;

END;

/ / DELIMITER;

-- Create the HotelImages table
CREATE TABLE HotelImages (
    HotelID VARCHAR(8),
    ImgPath VARCHAR(255),
    FOREIGN KEY (HotelID) REFERENCES Hotel(HotelID)
);

-- Create the HotelFeedback table
CREATE TABLE HotelFeedback (
    FeedbackID INT AUTO_INCREMENT PRIMARY KEY,
    Date DATE,
    Rating FLOAT,
    Comment TEXT,
    Response TEXT,
    HotelID VARCHAR(8),
    TravelerID VARCHAR(8),
    FOREIGN KEY (HotelID) REFERENCES Hotel(HotelID),
    FOREIGN KEY (TravelerID) REFERENCES Traveler(TravelerID)
);

-- Create the Room table
CREATE TABLE Room (
    RoomID INT AUTO_INCREMENT PRIMARY KEY,
    Type VARCHAR(50),
    Price DECIMAL(10, 2),
    MaxOccupancy INT,
    Description TEXT,
    HotelID VARCHAR(8),
    FOREIGN KEY (HotelID) REFERENCES Hotel(HotelID)
);

-- Create the RoomImages table
CREATE TABLE RoomImages (
    RoomID INT,
    ImgPath VARCHAR(255),
    FOREIGN KEY (RoomID) REFERENCES Room(RoomID)
);

-- Create the RoomBooking table
CREATE TABLE RoomBooking (
    BookingID INT AUTO_INCREMENT PRIMARY KEY,
    CheckIn DATE,
    CheckOut DATE,
    Date DATE,
    Status ENUM('Pending', 'Confirmed', 'Cancelled'),
    RoomID INT,
    TravelerID VARCHAR(8),
    FOREIGN KEY (RoomID) REFERENCES Room(RoomID),
    FOREIGN KEY (TravelerID) REFERENCES Traveler(TravelerID)
);

-- Create the RoomPayment table
CREATE TABLE RoomPayment (
    PaymentID INT AUTO_INCREMENT PRIMARY KEY,
    Date DATE,
    Amount DECIMAL(10, 2),
    Status ENUM('Pending', 'Paid'),
    BookingID INT,
    FOREIGN KEY (BookingID) REFERENCES RoomBooking(BookingID)
);

-- Create the CulturalEventOrganizer table
CREATE TABLE CulturalEventOrganizer (
    OrganizerID VARCHAR(8) PRIMARY KEY,
    Name VARCHAR(100),
    ContactNo VARCHAR(15),
    Email VARCHAR(100) UNIQUE,
    Description TEXT,
    Password VARCHAR(255),
    SMLink VARCHAR(255),
    ImgPath VARCHAR(255),
    AdminID VARCHAR(8),
    FOREIGN KEY (AdminID) REFERENCES Admin(AdminID)
);

-- Trigger to auto-generate OrganizerID in the format 'O0001'
DELIMITER / / CREATE TRIGGER trg_OrganizerID BEFORE
INSERT
    ON CulturalEventOrganizer FOR EACH ROW BEGIN DECLARE maxID INT;

DECLARE newID VARCHAR(6);

SELECT
    MAX(CAST(SUBSTRING(OrganizerID, 2) AS UNSIGNED)) INTO maxID
FROM
    CulturalEventOrganizer;

SET
    newID = CONCAT('O', LPAD(IFNULL(maxID, 0) + 1, 4, '0'));

SET
    NEW.OrganizerID = newID;

END;

/ / DELIMITER;

-- Create the CulturalEventOrganizerFeedback table
CREATE TABLE CulturalEventOrganizerFeedback (
    FeedbackID INT AUTO_INCREMENT PRIMARY KEY,
    Date DATE,
    Rating FLOAT,
    Comment TEXT,
    Response TEXT,
    OrganizerID VARCHAR(8),
    TravelerID VARCHAR(8),
    FOREIGN KEY (OrganizerID) REFERENCES CulturalEventOrganizer(OrganizerID),
    FOREIGN KEY (TravelerID) REFERENCES Traveler(TravelerID)
);

-- Create the CulturalEvent table
CREATE TABLE CulturalEvent (
    EventID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(100),
    Location VARCHAR(100),
    Date DATE,
    Time TIME,
    Description TEXT,
    Capacity INT,
    TicketPrice DECIMAL(10, 2),
    Status ENUM('Upcoming', 'Ongoing', 'Completed'),
    OrganizerID VARCHAR(8),
    FOREIGN KEY (OrganizerID) REFERENCES CulturalEventOrganizer(OrganizerID)
);

-- Create the CulturalEventImages table
CREATE TABLE CulturalEventImages (
    EventID INT,
    ImgPath VARCHAR(255),
    FOREIGN KEY (EventID) REFERENCES CulturalEvent(EventID)
);

-- Create the CulturalEventBooking table
CREATE TABLE CulturalEventBooking (
    BookingID INT AUTO_INCREMENT PRIMARY KEY,
    Date DATE,
    Quantity INT,
    Status ENUM('Pending', 'Confirmed', 'Cancelled'),
    EventID INT,
    TravelerID VARCHAR(8),
    FOREIGN KEY (EventID) REFERENCES CulturalEvent(EventID),
    FOREIGN KEY (TravelerID) REFERENCES Traveler(TravelerID)
);

-- Create the CulturalEventPayment table
CREATE TABLE CulturalEventPayment (
    PaymentID INT AUTO_INCREMENT PRIMARY KEY,
    Date DATE,
    Amount DECIMAL(10, 2),
    Status ENUM('Pending', 'Paid'),
    BookingID INT,
    FOREIGN KEY (BookingID) REFERENCES CulturalEventBooking(BookingID)
);

-- Create the HeritageMarket table
CREATE TABLE HeritageMarket (
    ShopID VARCHAR(8) PRIMARY KEY,
    Name VARCHAR(100),
    Location VARCHAR(100),
    ContactNo VARCHAR(15),
    Email VARCHAR(100) UNIQUE,
    Description TEXT,
    Website VARCHAR(255),
    Password VARCHAR(255),
    SMLink VARCHAR(255),
    OpenHours VARCHAR(100),
    AdminID VARCHAR(8),
    FOREIGN KEY (AdminID) REFERENCES Admin(AdminID)
);

-- Trigger to auto-generate ShopID in the format 'S0001'
DELIMITER / / CREATE TRIGGER trg_ShopID BEFORE
INSERT
    ON HeritageMarket FOR EACH ROW BEGIN DECLARE maxID INT;

DECLARE newID VARCHAR(6);

SELECT
    MAX(CAST(SUBSTRING(ShopID, 2) AS UNSIGNED)) INTO maxID
FROM
    HeritageMarket;

SET
    newID = CONCAT('S', LPAD(IFNULL(maxID, 0) + 1, 4, '0'));

SET
    NEW.ShopID = newID;

END;

/ / DELIMITER;

-- Create the HeritageMarketImages table
CREATE TABLE HeritageMarketImages (
    ShopID VARCHAR(8),
    ImgPath VARCHAR(255),
    FOREIGN KEY (ShopID) REFERENCES HeritageMarket(ShopID)
);

-- Create the HeritageMarketFeedback table
CREATE TABLE HeritageMarketFeedback (
    FeedbackID INT AUTO_INCREMENT PRIMARY KEY,
    Date DATE,
    Rating FLOAT,
    Comment TEXT,
    Response TEXT,
    ShopID VARCHAR(8),
    TravelerID VARCHAR(8),
    FOREIGN KEY (ShopID) REFERENCES HeritageMarket(ShopID),
    FOREIGN KEY (TravelerID) REFERENCES Traveler(TravelerID)
);

-- Create the Product table
CREATE TABLE Product (
    ProductID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(100),
    Price DECIMAL(10, 2),
    Description TEXT,
    ShopID VARCHAR(8),
    FOREIGN KEY (ShopID) REFERENCES HeritageMarket(ShopID)
);

-- Create the ProductImages table
CREATE TABLE ProductImages (
    ProductID INT,
    ImgPath VARCHAR(255),
    FOREIGN KEY (ProductID) REFERENCES Product(ProductID)
);

-- Create the Restaurant table
CREATE TABLE Restaurant (
    RestaurantID VARCHAR(8) PRIMARY KEY,
    Name VARCHAR(100),
    Location VARCHAR(100),
    ContactNo VARCHAR(15),
    Email VARCHAR(100) UNIQUE,
    Description TEXT,
    Website VARCHAR(255),
    Password VARCHAR(255),
    OpenHours VARCHAR(100),
    CuisineType VARCHAR(100),
    AdminID VARCHAR(8),
    FOREIGN KEY (AdminID) REFERENCES Admin(AdminID)
);

-- Trigger to auto-generate RestaurantID in the format 'R0001'
DELIMITER / / CREATE TRIGGER trg_RestaurantID BEFORE
INSERT
    ON Restaurant FOR EACH ROW BEGIN DECLARE maxID INT;

DECLARE newID VARCHAR(6);

SELECT
    MAX(CAST(SUBSTRING(RestaurantID, 2) AS UNSIGNED)) INTO maxID
FROM
    Restaurant;

SET
    newID = CONCAT('R', LPAD(IFNULL(maxID, 0) + 1, 4, '0'));

SET
    NEW.RestaurantID = newID;

END;

/ / DELIMITER;

-- Create the RestaurantImages table
CREATE TABLE RestaurantImages (
    RestaurantID VARCHAR(8),
    ImgPath VARCHAR(255),
    FOREIGN KEY (RestaurantID) REFERENCES Restaurant(RestaurantID)
);

-- Create the RestaurantFeedback table
CREATE TABLE RestaurantFeedback (
    FeedbackID INT AUTO_INCREMENT PRIMARY KEY,
    Date DATE,
    Rating FLOAT,
    Comment TEXT,
    Response TEXT,
    RestaurantID VARCHAR(8),
    TravelerID VARCHAR(8),
    FOREIGN KEY (RestaurantID) REFERENCES Restaurant(RestaurantID),
    FOREIGN KEY (TravelerID) REFERENCES Traveler(TravelerID)
);

-- Create the Menu table
CREATE TABLE Menu (
    MenuID INT AUTO_INCREMENT PRIMARY KEY,
    FoodName VARCHAR(100),
    Price DECIMAL(10, 2),
    FoodCategory VARCHAR(50),
    RestaurantID VARCHAR(8),
    FOREIGN KEY (RestaurantID) REFERENCES Restaurant(RestaurantID)
);

-- Create the MenuImages table
CREATE TABLE MenuImages (
    MenuID INT,
    ImgPath VARCHAR(255),
    FOREIGN KEY (MenuID) REFERENCES Menu(MenuID)
);

-- Create the Category table
CREATE TABLE Category (
    CategoryID INT AUTO_INCREMENT PRIMARY KEY,
    CategoryName VARCHAR(50)
);

-- Create the Keyword table
CREATE TABLE Keyword (
    KeywordID INT AUTO_INCREMENT PRIMARY KEY,
    KName VARCHAR(50),
    CategoryID INT,
    FOREIGN KEY (CategoryID) REFERENCES Category(CategoryID)
);

-- Create the TravelerKeyword table
CREATE TABLE TravelerKeyword (
    TravelerID VARCHAR(8),
    KeywordID INT,
    FOREIGN KEY (TravelerID) REFERENCES Traveler(TravelerID),
    FOREIGN KEY (KeywordID) REFERENCES Keyword(KeywordID)
);

-- Create the HotelKeyword table
CREATE TABLE HotelKeyword (
    HotelID VARCHAR(8),
    KeywordID INT,
    FOREIGN KEY (HotelID) REFERENCES Hotel(HotelID),
    FOREIGN KEY (KeywordID) REFERENCES Keyword(KeywordID)
);

-- Create the CulturalEventOrganizerKeyword table
CREATE TABLE CulturalEventOrganizerKeyword (
    OrganizerID VARCHAR(8),
    KeywordID INT,
    FOREIGN KEY (OrganizerID) REFERENCES CulturalEventOrganizer(OrganizerID),
    FOREIGN KEY (KeywordID) REFERENCES Keyword(KeywordID)
);

-- Create the RestaurantKeyword table
CREATE TABLE RestaurantKeyword (
    RestaurantID VARCHAR(8),
    KeywordID INT,
    FOREIGN KEY (RestaurantID) REFERENCES Restaurant(RestaurantID),
    FOREIGN KEY (KeywordID) REFERENCES Keyword(KeywordID)
);

-- Create the HeritageMarketKeyword table
CREATE TABLE HeritageMarketKeyword (
    ShopID VARCHAR(8),
    KeywordID INT,
    FOREIGN KEY (ShopID) REFERENCES HeritageMarket(ShopID),
    FOREIGN KEY (KeywordID) REFERENCES Keyword(KeywordID)
);

-- Add IsVerified column to Admin table
ALTER TABLE
    Admin
ADD
    COLUMN IsVerified TINYINT(1) DEFAULT 0;

-- Create the PasswordReset table
CREATE TABLE PasswordReset (
    Email VARCHAR(100) PRIMARY KEY,
    Token VARCHAR(255) NOT NULL,
    Expiry TIMESTAMP NOT NULL,
    UserType ENUM(
        'admin',
        'traveler',
        'hotel',
        'restaurant',
        'heritagemarket',
        'culturaleventorganizer'
    ) NOT NULL
);

-- Delete token after expiry
DELIMITER / / CREATE EVENT IF NOT EXISTS delete_expired_tokens ON SCHEDULE EVERY 1 DAY DO BEGIN
DELETE FROM
    PasswordReset
WHERE
    Expiry < NOW();

END;

/ / DELIMITER;

-- Enable the event scheduler
SET
    GLOBAL event_scheduler = ON;