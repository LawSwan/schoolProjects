# Week 3 Project – Enhanced Bank Account Application

**Author:** Amber Lawson  
**Date:** November 25, 2025  
**Purpose:** Demonstrate abstraction, constructors, and proper access specifiers in Java

## Project Overview

This enhanced banking system demonstrates advanced object-oriented programming concepts including:

- **Abstraction** through abstract classes and methods
- **Multiple constructor types** for flexible object creation
- **Proper access specifiers** for data encapsulation and security
- **Inheritance hierarchy** with specialized account behaviors

## Key Features Demonstrated

### 1. Abstraction Benefits

The abstract `BankAccount` class provides:
- Common functionality shared by all account types
- Abstract methods that force consistent implementation across subclasses
- Protected access to fields for safe inheritance
- Template for account behavior while allowing type-specific customization

**How inheriting classes benefit:**
- Code reuse through inherited methods (`deposit`, `withdraw`, `getSummary`)
- Consistent interface through abstract method contracts
- Access to protected fields without breaking encapsulation
- Ability to override behavior while maintaining base functionality

**Application-wide benefits:**
- Reduced code duplication across account types
- Enforced consistency in account behavior
- Easy addition of new account types
- Polymorphic behavior through common interface

### 2. Constructor Types Implemented

#### Default Constructors
- Create objects with sensible default values
- Enable quick object instantiation
- Auto-generate IDs and account numbers

#### Parameterized Constructors
- Allow specific initialization of object state
- Most commonly used in real applications
- Include validation and error checking

#### Copy Constructors
- Create new objects based on existing ones
- Useful for object duplication and backup
- Implement deep copying for complex objects

#### Overloaded Constructors
- Provide flexibility in object creation
- Support different initialization scenarios
- Enable optional parameters and features

### 3. Access Specifiers Usage

#### Private Access
- **Fields**: Protect internal data from external modification
- **Methods**: Hide implementation details and helper functions
- **Benefits**: Strong encapsulation, data integrity, controlled access

#### Protected Access
- **Fields**: Allow inheritance while restricting general access
- **Methods**: Enable subclass functionality without public exposure
- **Benefits**: Safe inheritance, code reuse, maintained encapsulation

#### Public Access
- **Methods**: Provide controlled interfaces to class functionality
- **Constructors**: Enable object creation with proper initialization
- **Benefits**: Controlled access, clean API design, functionality exposure

## Class Structure

### Abstract Base Class
- `BankAccount`: Abstract base class implementing `IAccountActions`
  - Provides common fields and methods
  - Defines abstract methods for specialized behavior
  - Uses protected access for inheritance support

### Concrete Account Types
- `CheckingAccount`: Implements overdraft protection and monthly fees
- `SavingsAccount`: Implements interest calculation and withdrawal limits  
- `PremiumAccount`: Implements credit lines and premium features

### User Management
- `BankUser`: Demonstrates composition (HAS-A relationship)
  - Multiple constructors for flexible user creation
  - Encapsulated account management
  - Defensive copying for data protection

### Interface
- `IAccountActions`: Defines contract for all account operations

## Running the Application

### Compilation
```bash
javac -d bin src/*.java
```

### Execution
```bash
java -cp bin App
```

## Technical Highlights

### Abstraction Implementation
```java
// Abstract method forces implementation in subclasses
public abstract void processMonthlyUpdate();

// Each account type provides specific behavior
@Override
public void processMonthlyUpdate() {
    // Account-specific monthly processing
}
```

### Constructor Overloading
```java
// Multiple ways to create accounts
CheckingAccount account1 = new CheckingAccount(); // Default
CheckingAccount account2 = new CheckingAccount("CHK001", 1000.00); // Parameterized
CheckingAccount account3 = new CheckingAccount("CHK002", 1500.00, 100.00); // With overdraft
```

### Access Specifier Strategy
```java
private double balance;        // Protected from external access
protected String accountNumber; // Available to subclasses only  
public double getBalance();    // Controlled public access
```

## Code Documentation

Each class file includes:
- Header documentation with author, date, and purpose
- Inline comments explaining abstraction benefits
- Constructor documentation with usage examples
- Access specifier rationale and benefits
- Method documentation with parameter and return details

## Learning Objectives Achieved

✅ **Abstraction Usage**: Abstract classes reduce code duplication and enforce consistent behavior  
✅ **Constructor Variety**: Multiple constructor types provide flexible object creation options  
✅ **Access Control**: Proper access specifiers ensure data protection and controlled functionality  
✅ **Code Organization**: Clear separation of concerns and responsibilities  
✅ **Documentation**: Comprehensive code documentation explaining design decisions
