/*******************************************************************
 * Name: Amber Lawson
 * Date: 25 November 2025
 * Purpose: SavingsAccount class extends BankAccount - Week 3 Enhanced
 * Demonstrates: inheritance, multiple constructors, and method overriding
 * 
 * Access Specifiers Benefits:
 * - Private fields protect interest rate from external modification
 * - Protected methods from parent allow safe inheritance
 * - Public interface provides controlled access to functionality
 ******************************************************************/

public class SavingsAccount extends BankAccount {

    // Private constants and fields - encapsulated implementation details
    private static final double DEFAULT_INTEREST_RATE = 0.01; // 1%
    private static final double MINIMUM_BALANCE_FOR_INTEREST = 100.00;

    private double interestRate;
    private int withdrawalsThisMonth; // Track withdrawals for monthly limit
    private static final int MAX_MONTHLY_WITHDRAWALS = 6;

    /**
     * Default constructor - creates savings account with default interest rate
     * Demonstrates: Default constructor with field initialization
     */
    public SavingsAccount() {
        super(); // Call parent default constructor
        this.interestRate = DEFAULT_INTEREST_RATE;
        this.withdrawalsThisMonth = 0;
    }

    /**
     * Parameterized constructor - standard savings account creation
     * Demonstrates: Parameterized constructor with parent call
     */
    public SavingsAccount(String accountNumber, double balance) {
        super(accountNumber, balance);
        this.interestRate = DEFAULT_INTEREST_RATE;
        this.withdrawalsThisMonth = 0;
    }

    /**
     * Enhanced constructor with custom interest rate
     * Demonstrates: Constructor overloading for specialized creation
     */
    public SavingsAccount(String accountNumber, double balance, double interestRate) {
        super(accountNumber, balance);
        setInterestRate(interestRate); // Use setter for validation
        this.withdrawalsThisMonth = 0;
    }

    /**
     * Copy constructor for savings accounts
     * Demonstrates: Copy constructor with type-specific copying
     */
    public SavingsAccount(SavingsAccount other) {
        super(other);
        this.interestRate = other.interestRate;
        this.withdrawalsThisMonth = 0; // New account starts fresh
    }

    // Private helper methods - internal implementation details
    
    /**
     * Calculates monthly interest based on balance
     * Private method demonstrates encapsulation of calculation logic
     */
    private double calculateInterest() {
        if (balance >= MINIMUM_BALANCE_FOR_INTEREST) {
            return balance * interestRate;
        }
        return 0.0;
    }

    /**
     * Validates interest rate input
     * Private method for internal validation
     */
    private void setInterestRate(double rate) {
        // Ensure reasonable interest rate (0% to 10%)
        if (rate >= 0.0 && rate <= 0.10) {
            this.interestRate = rate;
        } else {
            this.interestRate = DEFAULT_INTEREST_RATE;
        }
    }

    // Public accessor methods
    public double getInterestRate() {
        return interestRate;
    }

    public int getWithdrawalsThisMonth() {
        return withdrawalsThisMonth;
    }

    public int getRemainingWithdrawals() {
        return Math.max(0, MAX_MONTHLY_WITHDRAWALS - withdrawalsThisMonth);
    }

    // Override parent methods for savings-specific behavior

    /**
     * Enhanced withdraw with monthly limit enforcement
     * Demonstrates method overriding with additional business logic
     */
    @Override
    public boolean withdraw(double amount) {
        if (withdrawalsThisMonth >= MAX_MONTHLY_WITHDRAWALS) {
            System.out.println("Monthly withdrawal limit exceeded. Transaction denied.");
            return false;
        }
        
        if (super.withdraw(amount)) { // Call parent withdraw method
            withdrawalsThisMonth++;
            return true;
        }
        return false;
    }

    @Override
    public void processMonthlyUpdate() {
        // Add interest - demonstrates abstract method implementation
        double interest = calculateInterest();
        balance += interest;
        
        // Reset monthly withdrawal counter
        withdrawalsThisMonth = 0;
        
        // Small maintenance fee if balance is low
        if (balance < MINIMUM_BALANCE_FOR_INTEREST) {
            balance -= 2.00; // Low balance fee
            balance = Math.max(0.0, balance); // Prevent negative balance
        }
    }

    @Override
    public String getAccountType() {
        return "Savings Account";
    }

    @Override
    public String getSummary() {
        String summary = getAccountType() + "\n" + super.getSummary();
        summary += "\nInterest Rate: " + String.format("%.2f%%", interestRate * 100);
        summary += "\nWithdrawals This Month: " + withdrawalsThisMonth + "/" + MAX_MONTHLY_WITHDRAWALS;
        return summary;
    }
}