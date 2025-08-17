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
  `user_type` ENUM('user', 'tehsildar', 'admin') NOT NULL DEFAULT 'user',
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_username` (`Username`),
  UNIQUE KEY `uniq_email` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert sample admin user (password: admin123)
INSERT INTO `account_details` (`Fullname`, `Username`, `Email`, `Password`, `phone_number`, `State`, `City`, `Region`, `user_type`) VALUES
('System Administrator', 'admin', 'admin@landreg.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1234567890', 'Maharashtra', 'Mumbai', 'Mumbai', 'admin');

-- Insert sample tehsildar user (password: tehsildar123)
INSERT INTO `account_details` (`Fullname`, `Username`, `Email`, `Password`, `phone_number`, `State`, `City`, `Region`, `user_type`) VALUES
('Tehsildar Officer', 'tehsildar', 'tehsildar@landreg.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '9876543210', 'Maharashtra', 'Pune', 'Pune', 'tehsildar');


