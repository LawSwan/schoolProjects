-- Database: 'sdc342_wk3midterm'
DROP DATABASE IF EXISTS sdc342_wk3midterm;
CREATE DATABASE sdc342_wk3midterm DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE sdc342_wk3midterm;

-- Table structure for table 'contacts'
DROP TABLE IF EXISTS contacts;
CREATE TABLE contacts (
  ContactNo int(11) AUTO_INCREMENT PRIMARY KEY,
  ContactFirstName varchar(50) NOT NULL,
  ContactLastName varchar(50) NOT NULL,
  ContactAddressLine1 varchar(100) NOT NULL,
  ContactAddressLine2 varchar(50) NOT NULL,
  ContactCity varchar(50) NOT NULL,
  ContactState varchar(2) NOT NULL,
  ContactZip varchar(10) NOT NULL,
  ContactBirthdate date NOT NULL,
  ContactEMail varchar(50) NOT NULL,
  ContactPhone varchar(15) NOT NULL,
  ContactNotes varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data for table 'contacts'
INSERT INTO contacts (ContactFirstName, ContactLastName, ContactAddressLine1, ContactAddressLine2,
	ContactCity, ContactState, ContactZip, ContactBirthdate, ContactEMail, ContactPhone, ContactNotes) VALUES
('Sybil', 'Ludington', '101 Midnight Ride Road', '', 'Concord', 'MA', '92817', '1761-04-05', 'rode2@revere.com', '(004)018-1775', ''),
('Rasmus', 'Lerdorf', '357 PHP Way', '', 'Webapp', 'CT', '85214', '1968-11-22', 'creator@php.com', '(101)010-1010', 'Wrote the language'),
('Percy', 'Julian', '123 Chemistry Lane', 'Suite 100', 'Synthesize', 'GA', '01210', '1899-04-11', 'pj@nas.org', '(915)753-8426', 'National Academy of Sciences'),
('Roy G.', 'Biv', '100 Rainbow Way', '', 'Skye', 'MT', '12120', '1899-04-11', 'rainbow@colors.org', '(123)123-1212', 'Likes all the colors of the rainbow.'),
('Edith', 'Wilson', '1600 Pennsylvania Ave', '', 'Washington', 'DC', '20010', '1872-10-15', 'temp_pres@whitehouse.gov', '(001)010-1919', 'Woodrows Wife');
