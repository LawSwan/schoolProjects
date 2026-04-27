-- Create database
CREATE DATABASE IF NOT EXISTS sdc342_wk3_gp3;
USE sdc342_wk3_gp3;

-- Create roles table
CREATE TABLE IF NOT EXISTS roles (
    RoleNo INT PRIMARY KEY AUTO_INCREMENT,
    RoleName VARCHAR(50) NOT NULL
);

-- Create people table
CREATE TABLE IF NOT EXISTS people (
    PersonNo INT PRIMARY KEY AUTO_INCREMENT,
    PersonFirstName VARCHAR(50) NOT NULL,
    PersonLastName VARCHAR(50) NOT NULL,
    PersonStartDate DATE NOT NULL,
    RoleNo INT NOT NULL,
    FOREIGN KEY (RoleNo) REFERENCES roles(RoleNo)
);

-- Insert sample roles
INSERT INTO roles (RoleName) VALUES 
('Manager'),
('Developer'), 
('Designer'),
('Tester'),
('Analyst') 
ON DUPLICATE KEY UPDATE RoleName = VALUES(RoleName);

-- Insert sample people
INSERT INTO people (PersonFirstName, PersonLastName, PersonStartDate, RoleNo) VALUES 
('John', 'Doe', '2023-01-15', 1),
('Jane', 'Smith', '2023-02-01', 2),
('Bob', 'Johnson', '2023-03-10', 3),
('Alice', 'Brown', '2023-04-05', 2),
('Charlie', 'Wilson', '2023-05-20', 4)
ON DUPLICATE KEY UPDATE 
PersonFirstName = VALUES(PersonFirstName),
PersonLastName = VALUES(PersonLastName),
PersonStartDate = VALUES(PersonStartDate),
RoleNo = VALUES(RoleNo);
