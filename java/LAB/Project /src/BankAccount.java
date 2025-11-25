/*******************************************************************
 * Name: Amber Lawson
 * Date: 25 November 2025
 * Purpose: Abstract base class for all bank accounts - Week 3 Enhanced
 * Demonstrates: abstraction, protected access specifiers, and constructors
 * 
 * Abstraction Benefits:
 * - Provides common functionality for all account types
 * - Forces inheriting classes to implement account-specific behavior
 * - Reduces code duplication across account types
 * - Creates a contract that all accounts must follow
 ******************************************************************/

public abstract class BankAccount implements IAccountActions {

    // Protected access: visible to subclasses but not to external classes
    // This demonstrates proper encapsulation while allowing inheritance
    protected String accountNumber;
    protected double balance;
    protected static int nextAccountNumber = 1000; // For generating default account numbers

    /**
     * Default constructor - creates an account with auto-generated number and zero balance
     * Demonstrates: Default constructor usage and static field access
     */
    public BankAccount() {
        this.accountNumber = generateAccountNumber();
        this.balance = 0.0;
    }

    /**
     * Parameterized constructor - most commonly used constructor
     * Demonstrates: Parameterized constructor with validation
     */
    public BankAccount(String accountNumber, double balance) {
        setAccountNumber(accountNumber);  // Use setter for validation
        setBalance(balance);              // Use setter for validation
    }

    /**
     * Copy constructor - creates a new account based on an existing one
     * Demonstrates: Copy constructor pattern
     */
    public BankAccount(BankAccount other) {
        this.accountNumber = generateAccountNumber(); // New account gets new number
        this.balance = other.balance;
    }

    // Protected methods - available to subclasses only
    // This demonstrates protected access specifier usage
    
    /**
     * Generates a unique account number - protected so subclasses can use it
     * @return Generated account number string
     */
    protected String generateAccountNumber() {
        return "AUTO" + (nextAccountNumber++);
    }

    /**
     * Validates and sets account number - protected for subclass access
     */
    protected void setAccountNumber(String accountNumber) {
        if (accountNumber != null && !accountNumber.trim().isEmpty()) {
            this.accountNumber = accountNumber.trim();
        } else {
            this.accountNumber = generateAccountNumber();
        }
    }

    /**
     * Validates and sets balance - protected for subclass access  
     */
    protected void setBalance(double balance) {
        this.balance = Math.max(0.0, balance); // Ensure non-negative balance
    }

    // Public accessor methods - properly encapsulated access to private fields
    public String getAccountNumber() {
        return accountNumber;
    }

    public double getBalance() {
        return balance;
    }

    // Interface implementation - public methods as required by IAccountActions

    @Override
    public void deposit(double amount) {
        if (amount > 0) {
            balance += amount;
        }
    }

    @Override
    public boolean withdraw(double amount) {
        if (amount > 0 && amount <= balance) {
            balance -= amount;
            return true;
        }
        return false;
    }

    @Override
    public String getSummary() {
        return "Account Number: " + accountNumber +
               "\nBalance: $" + String.format("%.2f", balance);
    }

    /**
     * Abstract method - each account type must provide its own implementation
     * This demonstrates the key benefit of abstraction: forcing consistent
     * behavior while allowing type-specific implementation
     */
    @Override
    public abstract void processMonthlyUpdate();

    /**
     * Abstract method for getting account type name
     * Forces each account type to identify itself
     */
    public abstract String getAccountType();
}