-- Create the ExploreEase Database
Create Database ExploreEase;

Use ExploreEase;

-- Create the Traveler table
CREATE TABLE Traveler (
    TravelerID INT AUTO_INCREMENT PRIMARY KEY,
    Email VARCHAR(100) UNIQUE NOT NULL,
    FirstName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    Password VARCHAR(255) NOT NULL,
    Gender ENUM('Male', 'Female', 'Other'),
    DOB DATE,
    ContactNo VARCHAR(15),
    Longitude DECIMAL(10, 8),
    Latitude DECIMAL(11, 8),
    SMLink VARCHAR(255),
    Description TEXT,
    Expertise TEXT,
    IsContentCreator TINYINT(1) DEFAULT 0
);

-- Create the TravelerImages table
CREATE TABLE TravelerImages (
    TravelerID INT NOT NULL,
    ImgPath VARCHAR(255) NOT NULL,
    FOREIGN KEY (TravelerID) REFERENCES Traveler(TravelerID)
);

-- Create the TravelerContents table
CREATE TABLE TravelerContents (
    TravelerID INT NOT NULL,
    ContentLink VARCHAR(255) NOT NULL,
    FOREIGN KEY (TravelerID) REFERENCES Traveler(TravelerID)
);

-- Create the Admin table
CREATE TABLE Admin (
    AdminID INT AUTO_INCREMENT PRIMARY KEY,
    Email VARCHAR(100) UNIQUE NOT NULL,
    FirstName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    Password VARCHAR(255) NOT NULL,
    ContactNo VARCHAR(15),
    ImgPath VARCHAR(255) NOT NULL,
    IsVerified TINYINT(1) DEFAULT 0
);

-- Create the Hotel table
CREATE TABLE Hotel (
    HotelID INT AUTO_INCREMENT PRIMARY KEY,
    Email VARCHAR(100) UNIQUE NOT NULL,
    Name VARCHAR(100) NOT NULL,
    Address VARCHAR(100) NOT NULL,
    Longitude DECIMAL(10, 8),
    Latitude DECIMAL(11, 8),
    ContactNo VARCHAR(15),
    Description TEXT,
    Website VARCHAR(255),
    Password VARCHAR(255) NOT NULL,
    SMLink VARCHAR(255),
    IsVerified TINYINT(1) DEFAULT 0
);

-- Create the HotelImages table
CREATE TABLE HotelImages (
    HotelID INT NOT NULL,
    ImgPath VARCHAR(255) NOT NULL,
    FOREIGN KEY (HotelID) REFERENCES Hotel(HotelID)
);

-- Create the HotelFeedback table
CREATE TABLE HotelFeedback (
    FeedbackID INT AUTO_INCREMENT PRIMARY KEY,
    Date DATE NOT NULL,
    Rating FLOAT NOT NULL,
    Comment TEXT,
    Response TEXT,
    HotelID INT NOT NULL,
    TravelerID INT,
    FOREIGN KEY (HotelID) REFERENCES Hotel(HotelID),
    FOREIGN KEY (TravelerID) REFERENCES Traveler(TravelerID)
);

-- Create the Room table
CREATE TABLE Room (
    RoomID INT AUTO_INCREMENT PRIMARY KEY,
    Type VARCHAR(50) NOT NULL,
    Price DECIMAL(10, 2) NOT NULL,
    MaxOccupancy INT NOT NULL,
    Description TEXT,
    HotelID INT NOT NULL,
    FOREIGN KEY (HotelID) REFERENCES Hotel(HotelID)
);

-- Create the RoomImages table
CREATE TABLE RoomImages (
    RoomID INT NOT NULL,
    ImgPath VARCHAR(255) NOT NULL,
    FOREIGN KEY (RoomID) REFERENCES Room(RoomID)
);

-- Create the RoomBooking table
CREATE TABLE RoomBooking (
    BookingID INT AUTO_INCREMENT PRIMARY KEY,
    CheckInDate DATE NOT NULL,
    CheckOutDate DATE NOT NULL,
    Date DATE NOT NULL,
    Status ENUM('Pending', 'Confirmed', 'Cancelled') DEFAULT 'Pending',
    RoomID INT NOT NULL,
    TravelerID INT NOT NULL,
    FOREIGN KEY (RoomID) REFERENCES Room(RoomID),
    FOREIGN KEY (TravelerID) REFERENCES Traveler(TravelerID)
);

-- Create the RoomPayment table
CREATE TABLE RoomPayment (
    PaymentID INT AUTO_INCREMENT PRIMARY KEY,
    Date DATE NOT NULL,
    Amount DECIMAL(10, 2) NOT NULL,
    Status ENUM('Pending', 'Paid') DEFAULT 'Pending',
    BookingID INT NOT NULL,
    FOREIGN KEY (BookingID) REFERENCES RoomBooking(BookingID)
);

-- Create the CulturalEventOrganizer table
CREATE TABLE CulturalEventOrganizer (
    OrganizerID INT AUTO_INCREMENT PRIMARY KEY,
    Email VARCHAR(100) UNIQUE NOT NULL,
    Name VARCHAR(100) NOT NULL,
    ContactNo VARCHAR(15),
    Description TEXT,
    Password VARCHAR(255) NOT NULL,
    SMLink VARCHAR(255),
    ImgPath VARCHAR(255),
    IsVerified TINYINT(1) DEFAULT 0
);

-- Create the CulturalEventOrganizerFeedback table
CREATE TABLE CulturalEventOrganizerFeedback (
    FeedbackID INT AUTO_INCREMENT PRIMARY KEY,
    Date DATE NOT NULL,
    Rating FLOAT NOT NULL,
    Comment TEXT,
    Response TEXT,
    OrganizerID INT NOT NULL,
    TravelerID INT,
    FOREIGN KEY (OrganizerID) REFERENCES CulturalEventOrganizer(OrganizerID),
    FOREIGN KEY (TravelerID) REFERENCES Traveler(TravelerID)
);

-- Create the CulturalEvent table
CREATE TABLE CulturalEvent (
    EventID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(100) NOT NULL,
    Address VARCHAR(100) NOT NULL,
    Longitude DECIMAL(10, 8),
    Latitude DECIMAL(11, 8),
    Date DATE NOT NULL,
    StartTime TIME NOT NULL,
    EndTime TIME,
    Description TEXT,
    Capacity INT,
    TicketPrice DECIMAL(10, 2),
    Status ENUM('Upcoming', 'Ongoing', 'Completed'),
    OrganizerID INT NOT NULL,
    FOREIGN KEY (OrganizerID) REFERENCES CulturalEventOrganizer(OrganizerID)
);

-- Create the CulturalEventImages table
CREATE TABLE CulturalEventImages (
    EventID INT NOT NULL,
    ImgPath VARCHAR(255) NOT NULL,
    FOREIGN KEY (EventID) REFERENCES CulturalEvent(EventID)
);

-- Create the CulturalEventBooking table
CREATE TABLE CulturalEventBooking (
    BookingID INT AUTO_INCREMENT PRIMARY KEY,
    Date DATE NOT NULL,
    Quantity INT NOT NULL,
    Status ENUM('Pending', 'Confirmed', 'Cancelled'),
    EventID INT NOT NULL,
    TravelerID INT NOT NULL,
    FOREIGN KEY (EventID) REFERENCES CulturalEvent(EventID),
    FOREIGN KEY (TravelerID) REFERENCES Traveler(TravelerID)
);

-- Create the CulturalEventPayment table
CREATE TABLE CulturalEventPayment (
    PaymentID INT AUTO_INCREMENT PRIMARY KEY,
    Date DATE NOT NULL,
    Amount DECIMAL(10, 2) NOT NULL,
    Status ENUM('Pending', 'Paid') DEFAULT 'Pending',
    BookingID INT NOT NULL,
    FOREIGN KEY (BookingID) REFERENCES CulturalEventBooking(BookingID)
);

-- Create the HeritageMarket table
CREATE TABLE HeritageMarket (
    ShopID INT AUTO_INCREMENT PRIMARY KEY,
    Email VARCHAR(100) UNIQUE NOT NULL,
    Name VARCHAR(100) NOT NULL,
    Address VARCHAR(100) NOT NULL,
    Longitude DECIMAL(10, 8),
    Latitude DECIMAL(11, 8),
    ContactNo VARCHAR(15),
    Description TEXT,
    Website VARCHAR(255),
    Password VARCHAR(255) NOT NULL,
    SMLink VARCHAR(255),
    OpenHours VARCHAR(100) NOT NULL,
    IsVerified TINYINT(1) DEFAULT 0
);

-- Create the HeritageMarketImages table
CREATE TABLE HeritageMarketImages (
    ShopID INT NOT NULL,
    ImgPath VARCHAR(255) NOT NULL,
    FOREIGN KEY (ShopID) REFERENCES HeritageMarket(ShopID)
);

-- Create the HeritageMarketFeedback table
CREATE TABLE HeritageMarketFeedback (
    FeedbackID INT AUTO_INCREMENT PRIMARY KEY,
    Date DATE NOT NULL,
    Rating FLOAT NOT NULL,
    Comment TEXT,
    Response TEXT,
    ShopID INT NOT NULL,
    TravelerID INT,
    FOREIGN KEY (ShopID) REFERENCES HeritageMarket(ShopID),
    FOREIGN KEY (TravelerID) REFERENCES Traveler(TravelerID)
);

-- Create the Product table
CREATE TABLE Product (
    ProductID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(100) NOT NULL,
    Price DECIMAL(10, 2) NOT NULL,
    Description TEXT,
    ImgPath VARCHAR(255) NOT NULL,
    ShopID INT NOT NULL,
    FOREIGN KEY (ShopID) REFERENCES HeritageMarket(ShopID)
);

-- Create the Restaurant table
CREATE TABLE Restaurant (
    RestaurantID INT AUTO_INCREMENT PRIMARY KEY,
    Email VARCHAR(100) UNIQUE NOT NULL,
    Name VARCHAR(100) NOT NULL,
    Address VARCHAR(100) NOT NULL,
    Longitude DECIMAL(10, 8),
    Latitude DECIMAL(11, 8),
    ContactNo VARCHAR(15),
    Description TEXT,
    Website VARCHAR(255),
    Password VARCHAR(255) NOT NULL,
    OpenHours VARCHAR(100) NOT NULL,
    CuisineType VARCHAR(100),
    SMLink VARCHAR(255),
    MenuPDF VARCHAR(255),
    IsVerified TINYINT(1) DEFAULT 0
);

-- Create the RestaurantImages table
CREATE TABLE RestaurantImages (
    RestaurantID INT NOT NULL,
    ImgPath VARCHAR(255) NOT NULL,
    FOREIGN KEY (RestaurantID) REFERENCES Restaurant(RestaurantID)
);

-- Create the RestaurantFeedback table
CREATE TABLE RestaurantFeedback (
    FeedbackID INT AUTO_INCREMENT PRIMARY KEY,
    Date DATE NOT NULL,
    Rating FLOAT NOT NULL,
    Comment TEXT,
    Response TEXT,
    RestaurantID INT NOT NULL,
    TravelerID INT,
    FOREIGN KEY (RestaurantID) REFERENCES Restaurant(RestaurantID),
    FOREIGN KEY (TravelerID) REFERENCES Traveler(TravelerID)
);

-- Create the Menu table
CREATE TABLE Menu (
    MenuID INT AUTO_INCREMENT PRIMARY KEY,
    FoodName VARCHAR(100) NOT NULL,
    Price DECIMAL(10, 2) NOT NULL,
    FoodCategory VARCHAR(50),
    ImgPath VARCHAR(255) NOT NULL,
    RestaurantID INT NOT NULL,
    FOREIGN KEY (RestaurantID) REFERENCES Restaurant(RestaurantID)
);

-- Create the Category table
CREATE TABLE Category (
    CategoryID INT AUTO_INCREMENT PRIMARY KEY,
    CategoryName VARCHAR(50) NOT NULL
);

-- Create the Keyword table
CREATE TABLE Keyword (
    KeywordID INT AUTO_INCREMENT PRIMARY KEY,
    KName VARCHAR(50) NOT NULL,
    CategoryID INT NOT NULL,
    FOREIGN KEY (CategoryID) REFERENCES Category(CategoryID)
);

-- Create the TravelerKeyword table
CREATE TABLE TravelerKeyword (
    TravelerID INT NOT NULL,
    KeywordID INT NOT NULL,
    FOREIGN KEY (TravelerID) REFERENCES Traveler(TravelerID),
    FOREIGN KEY (KeywordID) REFERENCES Keyword(KeywordID)
);

-- Create the HotelKeyword table
CREATE TABLE HotelKeyword (
    HotelID INT NOT NULL,
    KeywordID INT NOT NULL,
    FOREIGN KEY (HotelID) REFERENCES Hotel(HotelID),
    FOREIGN KEY (KeywordID) REFERENCES Keyword(KeywordID)
);

-- Create the CulturalEventOrganizerKeyword table
CREATE TABLE CulturalEventOrganizerKeyword (
    OrganizerID INT NOT NULL,
    KeywordID INT NOT NULL,
    FOREIGN KEY (OrganizerID) REFERENCES CulturalEventOrganizer(OrganizerID),
    FOREIGN KEY (KeywordID) REFERENCES Keyword(KeywordID)
);

-- Create the RestaurantKeyword table
CREATE TABLE RestaurantKeyword (
    RestaurantID INT NOT NULL,
    KeywordID INT NOT NULL,
    FOREIGN KEY (RestaurantID) REFERENCES Restaurant(RestaurantID),
    FOREIGN KEY (KeywordID) REFERENCES Keyword(KeywordID)
);

-- Create the HeritageMarketKeyword table
CREATE TABLE HeritageMarketKeyword (
    ShopID INT NOT NULL,
    KeywordID INT NOT NULL,
    FOREIGN KEY (ShopID) REFERENCES HeritageMarket(ShopID),
    FOREIGN KEY (KeywordID) REFERENCES Keyword(KeywordID)
);

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
DELIMITER //
CREATE EVENT IF NOT EXISTS delete_expired_tokens
ON SCHEDULE EVERY 1 DAY
DO
BEGIN
    DELETE FROM PasswordReset WHERE Expiry < NOW();
END;
//
DELIMITER ;

-- Enable the event scheduler
SET GLOBAL event_scheduler = ON;

-- Insert into the Category table
INSERT INTO Category (CategoryName) VALUES
    ('Location'),
    ('Customer Experience'),
    ('Accesibility'),
    ('Price Range'),
    ('Features & Highlights');

-- Insert into the Keyword table
INSERT INTO Keyword (KName, CategoryID) VALUES
    ('Beachside', 1),
    ('City Center', 1),
    ('Mountain View', 1),
    ('Rural Area', 1),
    ('Near Public Transport', 1),
    ('Family-Friendly', 2),
    ('Pet-Friendly', 2),
    ('Eco-Friendly', 2),
    ('Kid-Friendly', 2),
    ('Romantic', 2),
    ('Budget-Friendly', 2),
    ('Luxury Experience', 2),
    ('Wheelchair Accessible', 3),
    ('Sinhala Language Support', 3),
    ('Tamil Language Support', 3),
    ('English Language Support', 3),
    ('Parking Available', 3),
    ('Walking Distance from Landmarks', 3),
    ('Easy Access from Major Cities', 3),
    ('Hiking Trails Nearby', 3),
    ('Free WiFi', 3),
    ('Budget', 4),
    ('Mid-Range', 4),
    ('Luxury', 4),
    ('Wildlife Experience', 5),
    ('Historical Sites', 5),
    ('Cultural Experience', 5),
    ('Adventure Activities', 5);
    
-- Add ImgPath column to Traveler table
ALTER TABLE Traveler ADD ImgPath VARCHAR(255);