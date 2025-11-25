/*******************************************************************
 * Name: Amber Lawson
 * Date: 25 November 2025
 * Purpose: CheckingAccount class extends BankAccount - Week 3 Enhanced
 * Demonstrates: inheritance, multiple constructors, and access specifiers
 * 
 * Constructor Benefits:
 * - Default constructor for quick account creation
 * - Parameterized constructors for specific initialization
 * - Overdraft protection as an optional feature
 ******************************************************************/

public class CheckingAccount extends BankAccount {

    // Private constants - only used within this class
    private static final double DEFAULT_MONTHLY_FEE = 5.00;
    private static final double DEFAULT_OVERDRAFT_LIMIT = 0.00;

    // Private instance fields - encapsulated data
    private double monthlyFee;
    private double overdraftLimit; // Negative balance allowed

    /**
     * Default constructor - creates basic checking account
     * Demonstrates: Default constructor calling parent default constructor
     */
    public CheckingAccount() {
        super(); // Call parent default constructor
        this.monthlyFee = DEFAULT_MONTHLY_FEE;
        this.overdraftLimit = DEFAULT_OVERDRAFT_LIMIT;
    }

    /**
     * Parameterized constructor - standard account creation
     * Demonstrates: Parameterized constructor with parent constructor call
     */
    public CheckingAccount(String accountNumber, double balance) {
        super(accountNumber, balance); // Call parent parameterized constructor
        this.monthlyFee = DEFAULT_MONTHLY_FEE;
        this.overdraftLimit = DEFAULT_OVERDRAFT_LIMIT;
    }

    /**
     * Enhanced constructor with overdraft protection
     * Demonstrates: Constructor overloading with additional parameters
     */
    public CheckingAccount(String accountNumber, double balance, double overdraftLimit) {
        super(accountNumber, balance);
        this.monthlyFee = DEFAULT_MONTHLY_FEE;
        this.overdraftLimit = Math.max(0.0, overdraftLimit); // Ensure non-negative
    }

    /**
     * Copy constructor - creates checking account based on another
     * Demonstrates: Copy constructor with type-specific copying
     */
    public CheckingAccount(CheckingAccount other) {
        super(other); // Call parent copy constructor
        this.monthlyFee = other.monthlyFee;
        this.overdraftLimit = other.overdraftLimit;
    }

    // Private helper methods - only used within this class
    // Demonstrates private access specifier for internal operations
    
    /**
     * Checks if withdrawal amount is within overdraft limits
     * Private method - internal validation logic
     */
    private boolean isWithdrawalAllowed(double amount) {
        double resultingBalance = balance - amount;
        return resultingBalance >= -overdraftLimit;
    }

    // Public accessor methods for encapsulated fields
    public double getMonthlyFee() {
        return monthlyFee;
    }

    public double getOverdraftLimit() {
        return overdraftLimit;
    }

    public void setMonthlyFee(double monthlyFee) {
        if (monthlyFee >= 0) {
            this.monthlyFee = monthlyFee;
        }
    }

    // Override parent methods to provide checking-specific behavior

    /**
     * Enhanced withdraw method with overdraft protection
     * Demonstrates method overriding with additional functionality
     */
    @Override
    public boolean withdraw(double amount) {
        if (amount > 0 && isWithdrawalAllowed(amount)) {
            balance -= amount;
            return true;
        }
        return false;
    }

    @Override
    public void processMonthlyUpdate() {
        // Deduct monthly fee - demonstrates abstract method implementation
        balance -= monthlyFee;
        
        // If balance goes negative beyond overdraft limit, apply penalty
        if (balance < -overdraftLimit) {
            balance -= 25.00; // Overdraft penalty
        }
    }

    @Override
    public String getAccountType() {
        return "Checking Account";
    }

    @Override
    public String getSummary() {
        // Polymorphism: enhanced summary for checking accounts
        String summary = getAccountType() + "\n" + super.getSummary();
        summary += "\nMonthly Fee: $" + String.format("%.2f", monthlyFee);
        summary += "\nOverdraft Limit: $" + String.format("%.2f", overdraftLimit);
        return summary;
    }
}