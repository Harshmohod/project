-- Database and table setup for XAMPP/phpMyAdmin

-- Create database (safe if it already exists)
CREATE DATABASE IF NOT EXISTS `land_registration_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `land_registration_db`;

-- Create table for user accounts
CREATE TABLE IF NOT EXISTS `account_details` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Fullname` VARCHAR(255) NOT NULL,
  `Username` VARCHAR(100) NOT NULL,
  `Email` VARCHAR(255) NOT NULL,
  `Password` VARCHAR(255) NOT NULL,
  `phone_number` VARCHAR(20) NOT NULL,
  `State` VARCHAR(100) NOT NULL,
  `City` VARCHAR(100) NOT NULL,
  `Region` VARCHAR(100) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_username` (`Username`),
  UNIQUE KEY `uniq_email` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sample admin/tehsildar rows can be added later if roles are introduced


