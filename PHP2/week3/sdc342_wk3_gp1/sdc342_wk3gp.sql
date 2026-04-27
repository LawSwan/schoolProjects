-- Database: 'sdc342_wk3gp'
DROP DATABASE IF EXISTS sdc342_wk3gp;
CREATE DATABASE sdc342_wk3gp DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE sdc342_wk3gp;

-- Table structure for table 'people'
DROP TABLE IF EXISTS people;
CREATE TABLE people (
  PersonNo int(11) AUTO_INCREMENT PRIMARY KEY,
  PersonFirstName varchar(50) NOT NULL,
  PersonLastName varchar(50) NOT NULL,
  PersonStartDate date NOT NULL,
  RoleNo int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data for table 'people'
INSERT INTO people (PersonFirstName, PersonLastName, PersonStartDate, RoleNo) VALUES
('YourFirst', 'YourLast', '2021-01-25', 1),
('Sybil', 'Ludington', '1775-04-18', 2),
('Rasmus', 'Lerdorf', '1995-06-01', 3),
('Percy', 'Julian', '1973-07-01', 1),
('Edith', 'Wilson', '1919-10-01', 2);

-- Table structure for table 'roles'
DROP TABLE IF EXISTS roles;
CREATE TABLE roles (
  RoleNo int(11) AUTO_INCREMENT PRIMARY KEY,
  RoleName varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data for table 'roles'
INSERT INTO roles (RoleName) VALUES
('Student'),
('Staff'),
('Faculty');