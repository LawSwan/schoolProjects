# SQL Database Design Portfolio

![Oracle](https://img.shields.io/badge/Oracle-F80000?style=for-the-badge&logo=oracle&logoColor=white)
![SQL](https://img.shields.io/badge/SQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

A complete relational database design for a digital game distribution platform, demonstrating schema design, data manipulation, and complex query writing.

---

## Project Overview: Game Store Database

A fully normalized database system modeling a digital game marketplace similar to Steam or Epic Games Store.

### Entity Relationship Diagram

```
                    ┌─────────────┐
                    │  UserBase   │
                    │─────────────│
                    │ UserID (PK) │
                    │ FirstName   │
                    │ LastName    │
                    │ UserName    │
                    │ Password    │
                    │ Email       │
                    │ Birthday    │
                    │ WalletFunds │
                    └──────┬──────┘
                           │
         ┌─────────────────┼─────────────────┐
         │                 │                 │
         ▼                 ▼                 ▼
┌─────────────┐    ┌─────────────┐    ┌─────────────┐
│ UserLibrary │    │   Reviews   │    │   Orders    │
│─────────────│    │─────────────│    │─────────────│
│ UserID (FK) │    │ UserID (FK) │    │ OrderID(PK) │
│ProductCode  │    │ProductCode  │    │ UserID (FK) │
│ HoursPlayed │    │ Review      │    │ProductCode  │
└──────┬──────┘    │ Rating      │    │ Price       │
       │           └──────┬──────┘    │PurchaseDate │
       │                  │           └──────┬──────┘
       │                  │                  │
       └──────────────────┼──────────────────┘
                          │
                          ▼
                  ┌─────────────┐
                  │ ProductList │
                  │─────────────│
                  │ProductCode  │
                  │ ProductName │
                  │ Publisher   │
                  │ Genre       │
                  │ ReleaseDate │
                  └──────┬──────┘
                         │
                         ▼
                  ┌─────────────┐
                  │ StoreFront  │
                  │─────────────│
                  │ InventoryID │
                  │ProductCode  │
                  │ Price       │
                  │ Description │
                  └─────────────┘
```

---

## Database Tables

| Table | Purpose | Records |
|-------|---------|---------|
| **UserBase** | User accounts with wallet funds | 15 users |
| **ProductList** | Game catalog with publishers and genres | 15 games |
| **UserLibrary** | Games owned by users with playtime | 15 entries |
| **StoreFront** | Current store inventory and pricing | 15 products |
| **Reviews** | User ratings and comments | 15 reviews |
| **Orders** | Purchase transaction history | 15 orders |

---

## Sample Data Highlights

### Game Genres
- Indie, Horror, Simulation, Action-Adventure
- Strategy, RPG, Casual, Puzzle
- Turn-Based, Visual Novel, Adventure

### User Activity
- Playtime ranging from 3 to 1,888 hours
- Wallet funds from $2.45 to $184.35
- Rating distribution: 1-5 stars

---

## Course Structure

### Week 1: Schema Design & Data Population
- `Project Build Script.sql` - Creates all tables and inserts sample data
- `Project Delete Script.sql` - Cleanup script for testing
- `Database State Verification.sql` - Validation queries

### Week 2: Data Manipulation
- SELECT queries with filtering
- Data aggregation and grouping

### Week 3: Referential Integrity
- Foreign key constraints
- Complex JOINs across tables
- View creation

---

## Query Examples

### Users Without Orders
```sql
SELECT UserID, FirstName, LastName
FROM UserBase
WHERE UserID NOT IN (
    SELECT DISTINCT UserID FROM Orders
);
```

### Products Without Reviews
```sql
SELECT ProductCode, ProductName
FROM ProductList
WHERE ProductCode NOT IN (
    SELECT DISTINCT ProductCode FROM Reviews
);
```

### User Age Classification
```sql
SELECT FirstName, LastName, Birthday,
    CASE
        WHEN MONTHS_BETWEEN(SYSDATE, Birthday)/12 < 18 THEN 'Minor'
        WHEN MONTHS_BETWEEN(SYSDATE, Birthday)/12 < 30 THEN 'Young Adult'
        WHEN MONTHS_BETWEEN(SYSDATE, Birthday)/12 < 50 THEN 'Adult'
        ELSE 'Senior'
    END AS AgeGroup
FROM UserBase;
```

### Top Games by Playtime
```sql
SELECT p.ProductName, SUM(ul.HoursPlayed) as TotalHours
FROM UserLibrary ul
JOIN ProductList p ON ul.ProductCode = p.ProductCode
GROUP BY p.ProductName
ORDER BY TotalHours DESC;
```

---

## SQL Concepts Demonstrated

### Data Definition Language (DDL)
- CREATE TABLE with constraints
- PRIMARY KEY definitions
- VARCHAR2, NUMBER, DATE data types

### Data Manipulation Language (DML)
- INSERT with values and date formatting
- UPDATE and DELETE operations
- Transaction control (COMMIT)

### Query Techniques
- JOINs (INNER, LEFT, RIGHT)
- Subqueries (IN, NOT IN)
- Aggregate functions (SUM, COUNT, AVG)
- CASE expressions
- Date calculations (MONTHS_BETWEEN)
- Set operations (UNION, MINUS, INTERSECT)

### Database Objects
- Views for complex query reuse
- Constraints for data integrity

---

## Running the Scripts

### Prerequisites
- Oracle Database or Oracle SQL Developer
- SQL*Plus or compatible SQL client

### Execution Order
```sql
-- 1. Create tables and insert data
@"WEEK 1/Project Build Script.sql"

-- 2. Verify database state
@"WEEK 1/Database State Verification.sql"

-- 3. Add referential integrity
@"WEEK 3/Adding Referential Integrity.sql"

-- 4. Clean up (when needed)
@"WEEK 1/Project Delete Script.sql"
```

---

## Skills Demonstrated

- Relational database design
- Normalization principles
- Complex SQL query writing
- Data integrity constraints
- Transaction management
- View creation and management

---

## Author

**Amber Lawson**
Database Design Coursework
