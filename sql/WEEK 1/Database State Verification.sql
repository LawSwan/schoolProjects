-- VerifyDBState.sql

-- 1. Which users have access?
SELECT USER_ID,
       USERNAME,
       CREATED,
       PASSWORD_CHANGE_DATE
  FROM USER_USERS;

-- 2. What tables are present?
SELECT *
  FROM USER_TABLES;

--3.Examine the design of each table by running the DESCRIBE command 
   DESCRIBE ORDERS; 

--4Display all data currently present in the database: 
SELECT * 
FROM ORDERS,PRODUCTLIST,REVIEWS,STOREFRONT, USERBASE, USERLIBRARY; 

--5Check what constraints are present in the database by displaying the TABLE_NAME, CONSTRAINT_NAME, CONSTRAINT_TYPE, and STATUS from the USER_CONSTRAINTS table 

--Check what views are present in the database by displaying the VIEW_NAME and TEXT columns in the USER_VIEWS table.
--NOTE: no data found is an acceptable answer! This means the query ran without error, but there were no records found (no data present in the table matching the selected 

 	

--7Display every USERNAME in alphabetical order.
SELECT username
from userbase
order by username;



-- Display the FIRSTNAME, LASTNAME, USERNAME, PASSWORD, and EMAIL of any user who has a yahoo email address. 

SELECT FIRSTNAME, LASTNAME, USERNAME, PASSWORD, EMAIL
FROM userbase
WHERE EMAIL LIKE '%yahoo%' 
ORDER BY EMAIL;

--Display the USERNAME, BIRTHDAY, and WALLETFUNDS of any user who has less than $25 in funds. 
SELECT username, birthday, walletfunds
from userbase 
where walletfunds < 25;

--Display the USERID and PRODUCTCODE of any user who has more than 100 HOURSPLAYED. 
SELECT USERID, PRODUCTCODE 
FROM USERLIBRARY
WHERE HOURSPLAYED  > 100;


--11Display the PRODUCTCODE of any game that has less than 10 HOURSPLAYED. 
SELECT  productcode, hoursplayed
from userlibrary
where hoursplayed < 10;

--12 
SELECT  distinct publisher
from productlist;
 
--13
select PRODUCTNAME, RELEASEDATE, PUBLISHER,  GENRE 
from productlist
order by GENRE;

--14
select PRODUCTCODE, PUBLISHER 
from productlist 
where GENRE = 'Strategy';

--15 
select PRODUCTCODE,DESCRIPTION, PRICE
FROM STOREFRONT 
WHERE PRICE > 25
order by price desc; 

--16
SELECT INVENTORYID, PRICE 
FROM STOREFRONT
order by PRICE;

--17
SELECT PRODUCTCODE, REVIEW
FROM REVIEWS 
WHERE RATING = '1';

--18
SELECT PRODUCTCODE, REVIEW 
FROM REVIEWS
WHERE RATING >= 4;

--19
select distinct USERID 
from orders;

--20
select * 
from orders
order by PURCHASEDATE;