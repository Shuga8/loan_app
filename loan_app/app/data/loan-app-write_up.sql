--- DEVELOPER LOTO CHARLES ---
--- VERSION 1.0 ---
--- CREATE DATABASE ---
--- NOTE THIS IS JUST FOR TESTING NOT ORIGINAL DATABASE---

CREATE DATABASE `loan-app`;

--- CREATE TABLES BELOW THIS POINT ---

--- CREATE TABLE FOR CUSTOMER INFO ---

CREATE TABLE`customers`(
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `customer_id` INT(100) NOT NULL,
    `customer_firstname` VARCHAR(255) NOT NULL,
    `customer_middlename` VARCHAR(255) NOT NULL,
    `custmer_lastname` VARCHAR(255) NOT NULL,
    `customer_email` VARCHAR(255) NOT NULL,
    `customer_phone_number` VARCHAR(255) NOT NULL, 
    `customer_address_state` VARCHAR(255) NOT NULL,
    `customer_address_city` VARCHAR(255) NOT NULL,
    `customer_address_street` VARCHAR(255) NOT NULL,
    `customer_password` VARCHAR(255) NOT NULL,
    `customer_registration_date` VARCHAR(255) NOT NULL DEFAULT CURRENT_TIMESTAMP
);




--- CREATE TABLE FOR LOAN APP ---

CREATE TABLE `loans`(
	`loan_id` INT(100) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `loan_by` VARCHAR(255) NOT NULL,
    `loan_for` VARCHAR(255) NOT NULL,
    `loan_amount` VARCHAR(255) NOT NULL,
    `loan_collection_date` VARCHAR(255) NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `loan_repay_date` VARCHAR(255) NOT NULL,
    `loan_interest_rate` INT(100) NOT NULL,
    `loan_status` VARCHAR(255) NOT NULL
);







--- THINGS I DID ALONG THE WAY IN MY DATABASE ---
    -- I added a new column in my customers table called customer_status after the customer_registration_date
ALTER TABLE customers ADD customer_status VARCHAR(255) NOT NULL AFTER customer_registration_date;