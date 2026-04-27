-- Database: 'sdc342_wk3final'
DROP DATABASE IF EXISTS sdc342_wk5final;
CREATE DATABASE sdc342_wk5final DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE sdc342_wk5final;

-- Table structure for table 'users'
DROP TABLE IF EXISTS users;
CREATE TABLE users (
  UserNo int(11) AUTO_INCREMENT PRIMARY KEY,
  UserId varchar(12) NOT NULL,
  Password varchar(20) NOT NULL,
  FirstName varchar(50) NOT NULL,
  LastName varchar(50) NOT NULL,
  HireDate date NOT NULL,
  EMail varchar(50) NOT NULL,
  Extension int(5) NOT NULL,
  UserLevelNo int(1)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data for table 'users'
INSERT INTO users (UserId, Password, FirstName, LastName, HireDate, EMail, Extension, UserLevelNo) VALUES
('LS11775', 'Pw1$', 'Sybil', 'Ludington', '1761-04-05', 'rode2@revere.com', '11775', 2),
('LR01010', 'Pw1$', 'Rasmus', 'Lerdorf', '1968-11-22', 'creator@php.com', '01010', 1),
('JP28426', 'Pw1$', 'Percy', 'Julian', '1899-04-11', 'pj@nas.org', '28426', 2),
('BR21212', 'Pw1$', 'Roy G.', 'Biv', '1899-04-11', 'rainbow@colors.org', '21212', 2),
('WE11919', 'Pw1$', 'Edith', 'Wilson', '1872-10-15', 'temp_pres@whitehouse.gov', '11919', 1);

-- Table structure for table 'user_levels'
DROP TABLE IF EXISTS user_levels;
CREATE TABLE user_levels (
  UserLevelNo int(1) AUTO_INCREMENT PRIMARY KEY,
  LevelName varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data for table 'user_levels'
INSERT INTO user_levels (LevelName) VALUES
('Administrator'),
('Technician');