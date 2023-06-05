-- Created by Vertabelo (http://vertabelo.com)
-- Last modification date: 2023-05-31 08:38:51.881

-- tables
-- Table: Address
CREATE TABLE Address (
    addressID int  NOT NULL,
    usersID int  NOT NULL,
    city varchar(30)  NOT NULL,
    zipCode varchar(30)  NOT NULL,
    street varchar(30)  NOT NULL,
    homeNumber varchar(30)  NOT NULL,
    phoneNumber varchar(30)  NOT NULL,
    CONSTRAINT Address_pk PRIMARY KEY (addressID)
);

-- Table: Cart
CREATE TABLE Cart (
    cartID int  NOT NULL AUTO_INCREMENT,
    itemID int  NOT NULL,
    quantity int  NOT NULL,
    total float  NOT NULL,
    userID int  NOT NULL,
    CONSTRAINT Cart_pk PRIMARY KEY (cartID)
);

-- Table: Category
CREATE TABLE Category (
    categoryID int  NOT NULL AUTO_INCREMENT,
    name varchar(30)  NOT NULL,
    imageName varchar(30)  NOT NULL,
    statusCategory bool  NOT NULL,
    CONSTRAINT Category_pk PRIMARY KEY (categoryID)
);

-- Table: Dish
CREATE TABLE Dish (
    dishID int  NOT NULL,
    meatID int  NOT NULL,
    saladsID int  NOT NULL,
    extrasID int  NOT NULL,
    price float NOT NULL,
    CONSTRAINT Dish_pk PRIMARY KEY (dishID)
);

-- Table: Extras
CREATE TABLE Extras (
    extrasID int  NOT NULL AUTO_INCREMENT,
    name varchar(30)  NOT NULL,
    price float  NOT NULL,
    CONSTRAINT Extras_pk PRIMARY KEY (extrasID)
);

-- Table: Item
CREATE TABLE Item (
    itemID int  NOT NULL AUTO_INCREMENT,
    categoryID int  NOT NULL,
    name varchar(30)  NOT NULL,
    price float  NOT NULL,
    status bool  NOT NULL,
    description varchar(80)  NOT NULL,
    CONSTRAINT Item_pk PRIMARY KEY (itemID)
);

-- Table: Meat
CREATE TABLE Meat (
    meatID int  NOT NULL AUTO_INCREMENT,
    name varchar(30)  NOT NULL,
    price float  NOT NULL,
    CONSTRAINT Meat_pk PRIMARY KEY (meatID)
);

-- Table: Order
CREATE TABLE `Order` (
    orderID int  NOT NULL AUTO_INCREMENT,
    usersID int  NOT NULL,
    deliver varchar(30)  NOT NULL,
    payment varchar(10)  NOT NULL,
    dateOrder varchar(30)  NOT NULL,
    totalPrice float  NOT NULL,
    tableNumber int  NOT NULL,
    deliverDate varchar(30)  NOT NULL,
    CONSTRAINT Order_pk PRIMARY KEY (orderID)
);

-- Table: Order_position
CREATE TABLE Order_position (
    order_positionID int  NOT NULL AUTO_INCREMENT,
    orderID int  NOT NULL,
    itemID int  NOT NULL,
    quantity int  NOT NULL,
    total float  NOT NULL,
    CONSTRAINT Order_position_pk PRIMARY KEY (order_positionID)
);

-- Table: Order_position_dish
CREATE TABLE Order_position_dish (
    order_position_dishID int  NOT NULL,
    orderID int  NOT NULL,
    dishID int  NOT NULL,
    quantity int  NOT NULL,
    price float  NOT NULL,
    CONSTRAINT Order_position_dish_pk PRIMARY KEY (order_position_dishID)
);

-- Table: Rola
CREATE TABLE Rola (
    rolaID int  NOT NULL AUTO_INCREMENT,
    name varchar(30)  NOT NULL,
    CONSTRAINT Rola_pk PRIMARY KEY (rolaID)
);

-- Table: Salads
CREATE TABLE Salads (
    saladsID int  NOT NULL AUTO_INCREMENT,
    name varchar(30)  NOT NULL,
    price float  NOT NULL,
    CONSTRAINT Salads_pk PRIMARY KEY (saladsID)
);

-- Table: Users
CREATE TABLE Users (
    usersID int  NOT NULL AUTO_INCREMENT,
    rolaID int  NOT NULL,
    firstName varchar(30)  NOT NULL,
    lastName varchar(30)  NOT NULL,
    email varchar(30)  NOT NULL,
    password varchar(40)  NOT NULL,
    CONSTRAINT Users_pk PRIMARY KEY (usersID)
);

-- foreign keys
-- Reference: Cart_Item (table: Cart)
ALTER TABLE Cart ADD CONSTRAINT Cart_Item FOREIGN KEY Cart_Item (itemID)
    REFERENCES Item (itemID);

-- Reference: Cart_Users (table: Cart)
ALTER TABLE Cart ADD CONSTRAINT Cart_Users FOREIGN KEY Cart_Users (userID)
    REFERENCES Users (usersID);

-- Reference: Copy_of_order_position_Dish (table: Order_position_dish)
ALTER TABLE Order_position_dish ADD CONSTRAINT Copy_of_order_position_Dish FOREIGN KEY Copy_of_order_position_Dish (dishID)
    REFERENCES Dish (dishID);

-- Reference: Copy_of_order_position_Order (table: Order_position_dish)
ALTER TABLE Order_position_dish ADD CONSTRAINT Copy_of_order_position_Order FOREIGN KEY Copy_of_order_position_Order (orderID)
    REFERENCES `Order` (orderID);

-- Reference: Dish_Extras (table: Dish)
ALTER TABLE Dish ADD CONSTRAINT Dish_Extras FOREIGN KEY Dish_Extras (extrasID)
    REFERENCES Extras (extrasID);

-- Reference: Dish_Meat (table: Dish)
ALTER TABLE Dish ADD CONSTRAINT Dish_Meat FOREIGN KEY Dish_Meat (meatID)
    REFERENCES Meat (meatID);

-- Reference: Dish_Salads (table: Dish)
ALTER TABLE Dish ADD CONSTRAINT Dish_Salads FOREIGN KEY Dish_Salads (saladsID)
    REFERENCES Salads (saladsID);

-- Reference: Item_Category (table: Item)
ALTER TABLE Item ADD CONSTRAINT Item_Category FOREIGN KEY Item_Category (categoryID)
    REFERENCES Category (categoryID);

-- Reference: Order_Users (table: Order)
ALTER TABLE `Order` ADD CONSTRAINT Order_Users FOREIGN KEY Order_Users (usersID)
    REFERENCES Users (usersID);

-- Reference: Order_order_position (table: Order_position)
ALTER TABLE Order_position ADD CONSTRAINT Order_order_position FOREIGN KEY Order_order_position (orderID)
    REFERENCES `Order` (orderID);

-- Reference: Users_Address (table: Address)
ALTER TABLE Address ADD CONSTRAINT Users_Address FOREIGN KEY Users_Address (usersID)
    REFERENCES Users (usersID);

-- Reference: Users_Rola (table: Users)
ALTER TABLE Users ADD CONSTRAINT Users_Rola FOREIGN KEY Users_Rola (rolaID)
    REFERENCES Rola (rolaID);

-- Reference: order_item_Item (table: Order_position)
ALTER TABLE Order_position ADD CONSTRAINT order_item_Item FOREIGN KEY order_item_Item (itemID)
    REFERENCES Item (itemID);

-- End of file.

