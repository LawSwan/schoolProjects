# Java Programming Portfolio

![Java](https://img.shields.io/badge/Java-ED8B00?style=for-the-badge&logo=openjdk&logoColor=white)

A comprehensive collection of Java projects demonstrating object-oriented programming mastery, from foundational concepts to advanced design patterns.

---

## Featured Project

### [Bank Account System](LAB/Project%20/README.md)
**The flagship project of this coursework**

A complete banking simulation demonstrating:
- Abstract classes and interface implementation
- Multiple constructor types (default, parameterized, copy)
- Proper access specifiers (private, protected, public)
- Inheritance hierarchy with CheckingAccount, SavingsAccount, and PremiumAccount
- Polymorphism through IAccountActions interface
- User management with composition patterns

```
IAccountActions (Interface)
       ↑
BankAccount (Abstract)
    ├── CheckingAccount (overdraft, monthly fees)
    ├── SavingsAccount (interest calculation)
    └── PremiumAccount (credit lines, rewards)
```

---

## Course Structure

### Advanced OOP Topics

| Week | Topic | Projects |
|------|-------|----------|
| Week 1 | Composition | Demonstrating HAS-A relationships |
| Week 2 | Interfaces & Polymorphism | Vehicle interfaces, polymorphic behavior |
| Week 3 | Abstraction, Constructors, Access Specifiers | Bank Account System (featured) |

### Lab Projects
- **Bank Account System** - Full-featured banking application
- Weekly programming assignments

### Scrum Week 5
- Team collaboration project using Agile methodology

---

## OOP Concepts Covered

### Inheritance
- Extending base classes
- Method overriding with `@Override`
- Constructor chaining with `super()`

### Abstraction
- Abstract classes with shared implementation
- Abstract methods enforcing contracts
- Template method pattern

### Polymorphism
- Interface-based programming
- Runtime method resolution
- Collections of mixed types

### Encapsulation
- Private fields with public accessors
- Protected inheritance chains
- Defensive copying

### Composition
- HAS-A relationships
- Object delegation
- Flexible object construction

---

## Running the Projects

```bash
# Navigate to any project with src/ folder
cd java/LAB/Project\ /

# Compile all source files
javac -d bin src/*.java

# Run the application
java -cp bin App
```

---

## Technologies

- Java SE (Standard Edition)
- Object-Oriented Design Patterns
- Interface-based Architecture

---

## Author

**Amber Lawson**
Java Programming Coursework
