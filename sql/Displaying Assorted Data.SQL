-- DisplayAssortedData.sql

-- Question 1: Display the USERID of any users who have not made an order.
SELECT USERID
FROM USERBASE
MINUS
SELECT USERID
FROM ORDERS;

-- Question 2: Display the PRODUCTCODE of any products that have no reviews.
SELECT PRODUCTCODE
FROM PRODUCTLIST
MINUS
SELECT PRODUCTCODE
FROM REVIEWS;

-- Question 3: Display all data in USERBASE, plus “Adult” or “Minor” based on age.
SELECT u.*,
       CASE
         WHEN FLOOR(MONTHS_BETWEEN(SYSDATE, u.BIRTHDAY) / 12) >= 18 THEN 'Adult'
         ELSE 'Minor'
       END AS AGE_STATUS
FROM USERBASE u;

-- Question 4: Display all data in PRODUCTLIST, plus “On Sale” or “Base Price” based on price.
SELECT p.*,
       CASE
         WHEN p.PRICE <= 20 THEN 'On Sale'
         ELSE 'Base Price'
       END AS PRICE_STATUS
FROM PRODUCTLIST p;

-- Question 5: Display the USERID of users who played GAME6 and have a profile image.
SELECT DISTINCT l.USERID
FROM USERLIBRARY l
JOIN USERPROFILE p ON l.USERID = p.USERID
WHERE l.PRODUCTCODE = 'GAME6'
  AND U.IMAGEFILE IS NOT NULL;

-- Question 6: Display PRODUCTCODE from the intersect of WISHLIST and REVIEWS where position 1 or 2 and rating ≥ 3.
SELECT PRODUCTCODE
FROM WISHLIST
WHERE POSITION IN (1, 2)
INTERSECT
SELECT PRODUCTCODE
FROM REVIEWS
WHERE RATING >= 3;

-- Question 7: Display USERNAME and BIRTHDAY for users who share the same birthday.
SELECT USERNAME, BIRTHDAY
FROM USERBASE
WHERE BIRTHDAY IN (
  SELECT BIRTHDAY
  FROM USERBASE
  GROUP BY BIRTHDAY
  HAVING COUNT(*) > 1
);

-- Question 8: Display the Cartesian product of USERLIBRARY cross-joined with WISHLIST.
SELECT *
FROM USERLIBRARY
CROSS JOIN WISHLIST;

-- Question 9: Union all USERBASE and PRODUCTLIST into a common item feed
SELECT 
  TO_CHAR(USERID)    AS ITEM_ID,
  'User'             AS ITEM_TYPE
FROM USERBASE
UNION ALL
SELECT 
  PRODUCTCODE        AS ITEM_ID,
  'Product'          AS ITEM_TYPE
FROM PRODUCTLIST;


-- Question 10: union all CHATLOG + USERPROFILE as user activity
SELECT 
  SENDERID           AS USERID,
  CONTENT            AS ACTIVITY,
  DATESENT           AS ACTIVITY_DATE
FROM CHATLOG
UNION ALL
SELECT 
  USERID,
  DESCRIPTION        AS ACTIVITY,
  CAST(NULL AS DATE) AS ACTIVITY_DATE
FROM USERPROFILE;

-- Question 11: Display USERNAME of all users who have not received an infraction.
SELECT USERNAME
FROM USERBASE
MINUS
SELECT u.USERNAME
FROM USERBASE u
JOIN INFRACTIONS i ON u.USERID = i.USERID;

-- Question 12: Display TITLE and DESCRIPTION of COMMUNITYRULES that have not been broken.
SELECT TITLE, DESCRIPTION
FROM COMMUNITYRULES
MINUS
SELECT cr.TITLE, cr.DESCRIPTION
FROM COMMUNITYRULES cr
JOIN INFRACTIONS i ON cr.RULE_ID = i.RULE_ID;

-- Question 13: Display USERNAME and EMAIL of users who have received a penalty.
SELECT DISTINCT u.USERNAME, u.EMAIL
FROM USERBASE u
JOIN INFRACTIONS i ON u.USERID = i.USERID
WHERE i.PENALTY_VALUE IS NOT NULL;

-- Question 14: Display the dates where an infraction was assigned and a support ticket submitted on the same day.
SELECT TRUNC(DATEASSIGNED) AS EVENT_DATE
FROM   INFRACTIONS
INTERSECT
SELECT TRUNC(DATESUBMITTED) AS EVENT_DATE
FROM   USERSUPPORT;

-- Question 15: Display every COMMUNITYRULES TITLE and PENALTY.
SELECT 
  TITLE,
  SEVERITYPOINT AS PENALTY
FROM COMMUNITYRULES;

-- Question 16: Display all data in COMMUNITYRULES plus “Bannable” or “Appealable” based on severity.
SELECT cr.*,
       CASE
         WHEN cr.SEVERITYPOINT >= 10 THEN 'Bannable'
         ELSE 'Appealable'
       END AS RULE_STATUS
FROM COMMUNITYRULES cr;

-- Question 17: Display all data in USERSUPPORT plus “High Priority” for tickets not closed and not updated in the past week.
SELECT s.*,
       CASE
         WHEN s.STATUS <> 'CLOSED' AND s.DATEUPDATED < SYSDATE - 7 THEN 'High Priority'
         ELSE 'Normal Priority'
       END AS PRIORITY_STATUS
FROM USERSUPPORT s;

-- Question 18: Display the Cartesian product of USERSUPPORT cross-joined with INFRACTIONS.
SELECT *
FROM USERSUPPORT
CROSS JOIN INFRACTIONS;

-- Question 19: Display TICKETID and DATEUPDATED for tickets closed and updated on the same day they were submitted.
SELECT TICKETID, DATEUPDATED
FROM USERSUPPORT
WHERE STATUS = 'CLOSED'
  AND TRUNC(SUBMISSION_DATE) = TRUNC(DATEUPDATED);

-- Question 20: Union all on USERBASE and INFRACTIONS to list sign-ups and infractions as user activity
SELECT 
  USERID,
  'Sign Up'      AS ACTIVITY,
  NULL           AS ACTIVITY_DATE
FROM USERBASE
UNION ALL
SELECT 
  USERID,
  'Infraction'   AS ACTIVITY,
  DATEASSIGNED   AS ACTIVITY_DATE
FROM INFRACTIONS;