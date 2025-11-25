/*******************************************************************
 * Name: Amber Lawson
 * Date: 25 November 2025
 * Purpose: Week 3 Project – Enhanced Bank Account App
 * Demonstrates: abstraction, constructors, and proper access specifiers
 * 
 * This enhanced version demonstrates:
 * - Abstract classes and methods for shared behavior and enforced implementation
 * - Multiple constructor types (default, parameterized, copy constructors)
 * - Proper access specifiers (private, protected, public)
 * - Enhanced inheritance hierarchy with abstract base classes
 ******************************************************************/

import java.util.ArrayList;

public class App {

    public static void main(String[] args) {
        System.out.println("==========================================");
        System.out.println("   Week 3 Project – Bank Account App");
        System.out.println("   Enhanced Banking System");
        System.out.println("   Author: Amber Lawson");
        System.out.println("==========================================\n");

        System.out.println("Welcome to my Enhanced Banking System!");
        System.out.println("This demonstration showcases:");
        System.out.println("• Abstract classes and methods for code reuse");
        System.out.println("• Multiple constructor types for flexible object creation");
        System.out.println("• Proper access specifiers for data encapsulation");
        System.out.println("• Inheritance hierarchy with specialized account types\n");

        // ===== DEMONSTRATING CONSTRUCTORS =====
        System.out.println("=== Constructor Demonstrations ===");
        
        // Default constructor usage
        BankUser user1 = new BankUser(); // Default constructor
        System.out.println("Created user with default constructor: " + user1.getName());
        
        // Parameterized constructor
        BankUser user2 = new BankUser("Amber Lawson", "amblaw9047@students.ecpi.edu"); 
        System.out.println("Created user with parameterized constructor: " + user2.getName());
        
        // Copy constructor
        BankUser user3 = new BankUser(user2); // Copy constructor
        System.out.println("Created user with copy constructor: " + user3.getName());
        
        System.out.println("\n=== Account Creation with Different Constructors ===");
        
        // Different ways to create accounts (demonstrating multiple constructors)
        CheckingAccount checking1 = new CheckingAccount(); // Default constructor
        CheckingAccount checking2 = new CheckingAccount("CHK1001", 1500.00); // Parameterized
        CheckingAccount checking3 = new CheckingAccount("CHK1002", 2000.00, 10.00); // With overdraft
        
        SavingsAccount savings1 = new SavingsAccount(); // Default constructor  
        SavingsAccount savings2 = new SavingsAccount("SAV2001", 5000.00); // Parameterized
        SavingsAccount savings3 = new SavingsAccount("SAV2002", 3000.00, 0.025); // With custom interest
        
        // Create a premium account (new account type)
        PremiumAccount premium = new PremiumAccount("PREM3001", 10000.00, 50000.00);
        
        System.out.println("Created various account types using different constructors\n");

        // ===== DEMONSTRATING ABSTRACTION =====
        System.out.println("=== Abstraction Demonstrations ===");
        System.out.println("Abstract BankAccount class provides:");
        System.out.println("• Common fields and methods for all account types");
        System.out.println("• Abstract methods that each account type must implement");
        System.out.println("• Protected access to allow inheritance while maintaining encapsulation\n");

        // Add accounts to user (composition)
        user2.addAccount(checking2);
        user2.addAccount(savings2);
        user2.addAccount(premium);

        // Interface polymorphism: same IAccountActions type, different objects
        IAccountActions checking = checking2;
        IAccountActions savings = savings2;
        IAccountActions premiumAcct = premium;

        // Do some actions using the interface
        checking.deposit(300.00);
        savings.deposit(200.00);
        premiumAcct.deposit(1000.00);
        checking.withdraw(50.00);

        // Put all interface references in a list to show polymorphism
        ArrayList<IAccountActions> actionList = new ArrayList<>();
        actionList.add(checking);
        actionList.add(savings);
        actionList.add(premiumAcct);

        System.out.println("=== Account Summaries (Polymorphism) ===");
        for (IAccountActions account : actionList) {
            // Polymorphism: calls the overridden version for each type
            System.out.println(account.getSummary());
            System.out.println("---------------------------------------");
        }

        System.out.println("\n=== Monthly Updates (Abstract Method Implementation) ===");
        for (IAccountActions account : actionList) {
            account.processMonthlyUpdate();   // Abstract method - different implementation per type
            System.out.println(account.getSummary());
            System.out.println("---------------------------------------");
        }
        
        System.out.println("\n=== Access Specifier Benefits ===");
        System.out.println("• Private fields protect internal data from external modification");
        System.out.println("• Protected methods allow inheritance while restricting general access");
        System.out.println("• Public interfaces provide controlled access to functionality");
        
        // Demonstrate user account management
        System.out.println("\n=== User Account Management ===");
        System.out.println("User: " + user2.getName() + " (" + user2.getEmail() + ")");
        System.out.println("Customer since: " + user2.getAccountCreationDate());
        System.out.println("Total accounts: " + user2.getAccountCount());
        System.out.printf("Total balance across all accounts: $%.2f%n", user2.getTotalBalance());

        System.out.println("\nThank you for exploring the Week 3 Enhanced Banking System!");
        System.out.println("This demonstration shows how abstraction, constructors, and access");
        System.out.println("specifiers work together to create robust, maintainable code.");
    }
}