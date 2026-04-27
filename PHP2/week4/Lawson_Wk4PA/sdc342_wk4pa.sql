-- Database: 'sdc342_wk4pa'
DROP DATABASE IF EXISTS sdc342_wk4pa;
CREATE DATABASE sdc342_wk4pa DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE sdc342_wk4pa;

-- Table structure for table 'users'
DROP TABLE IF EXISTS users;
CREATE TABLE users (
  UserId int(11) AUTO_INCREMENT PRIMARY KEY,
  FirstName varchar(50) NOT NULL,
  LastName varchar(50) NOT NULL,
  EMail varchar(50) NOT NULL,
  Password varchar(60) NOT NULL,
  RegistrationDate date NOT NULL,
  UserLevel int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data for table 'users'
INSERT INTO users (FirstName, LastName, EMail, Password, RegistrationDate, UserLevel) VALUES
('YourFirst', 'YourLast', 'you@you.com', 'Pa$$word1', '2021-01-31', 1),
('Sybil', 'Ludington', 'SLudington@you.com', 'Pa$$word1', '1775-04-18', 3),
('Rasmus', 'Lerdorf', 'RLerdorf@you.com', 'Pa$$word1', '1995-06-01', 1),
('Percy', 'Julian', 'PJulian@you.com', 'Pa$$word1', '1973-07-01', 2),
('Edith', 'Wilson', 'EWilson@you.com', 'Pa$$word1', '1919-10-01', 2),
('Andi', 'Gutmans', 'AGutmans@you.com', 'Pa$$word1', '1998-11-01', 3),
('Zeev', 'Suraski', 'ZSuraski@you.com', 'Pa$$word1', '1998-11-01', 3);