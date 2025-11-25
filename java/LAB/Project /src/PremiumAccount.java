/*******************************************************************
 * Name: Amber Lawson
 * Date: 25 November 2025
 * Purpose: PremiumAccount class - demonstrates advanced abstraction benefits
 * 
 * This class shows how abstraction enables:
 * - Code reuse from the abstract BankAccount base class
 * - Consistent interface through inherited methods
 * - Specialized behavior through method overriding
 * - Type-specific functionality while maintaining polymorphism
 ******************************************************************/

public class PremiumAccount extends BankAccount {

    // Private fields - encapsulated premium account features
    private static final double PREMIUM_INTEREST_RATE = 0.02; // 2% monthly
    private static final double MINIMUM_BALANCE = 10000.00;
    private static final double NO_FEE_THRESHOLD = 50000.00;
    
    private double creditLimit;
    private boolean hasPersonalBanker;
    private int priorityTransactions;

    /**
     * Default constructor - creates premium account with basic features
     */
    public PremiumAccount() {
        super();
        initializePremiumFeatures(25000.00); // Default credit limit
    }

    /**
     * Parameterized constructor - most common premium account creation
     */
    public PremiumAccount(String accountNumber, double balance, double creditLimit) {
        super(accountNumber, balance);
        initializePremiumFeatures(creditLimit);
    }

    /**
     * Copy constructor for premium accounts
     */
    public PremiumAccount(PremiumAccount other) {
        super(other);
        this.creditLimit = other.creditLimit;
        this.hasPersonalBanker = other.hasPersonalBanker;
        this.priorityTransactions = 0; // New account starts fresh
    }

    /**
     * Private helper method to initialize premium features
     * Demonstrates private method for internal logic
     */
    private void initializePremiumFeatures(double creditLimit) {
        this.creditLimit = Math.max(0.0, creditLimit);
        this.hasPersonalBanker = true;
        this.priorityTransactions = 0;
    }

    /**
     * Private method to check if account qualifies for premium benefits
     */
    private boolean qualifiesForPremiumBenefits() {
        return balance >= MINIMUM_BALANCE;
    }

    // Public accessor methods
    public double getCreditLimit() {
        return creditLimit;
    }

    public boolean hasPersonalBanker() {
        return hasPersonalBanker && qualifiesForPremiumBenefits();
    }

    public int getPriorityTransactions() {
        return priorityTransactions;
    }

    // Override methods for premium-specific behavior

    /**
     * Enhanced withdraw with credit line access
     * Demonstrates method overriding with extended functionality
     */
    @Override
    public boolean withdraw(double amount) {
        if (amount <= 0) {
            return false;
        }

        // Check if withdrawal is possible with available balance + credit
        double availableFunds = balance + (qualifiesForPremiumBenefits() ? creditLimit : 0);
        
        if (amount <= availableFunds) {
            balance -= amount;
            priorityTransactions++;
            return true;
        }
        return false;
    }

    @Override
    public void processMonthlyUpdate() {
        // Premium accounts earn higher interest
        if (qualifiesForPremiumBenefits()) {
            double interest = balance * PREMIUM_INTEREST_RATE;
            balance += interest;
        }

        // No monthly fees for high-balance accounts
        if (balance < NO_FEE_THRESHOLD && balance >= MINIMUM_BALANCE) {
            balance -= 15.00; // Premium account maintenance fee
        }

        // Reset monthly counters
        priorityTransactions = 0;
    }

    @Override
    public String getAccountType() {
        return "Premium Account";
    }

    @Override
    public String getSummary() {
        String summary = getAccountType() + "\n" + super.getSummary();
        summary += "\nCredit Limit: $" + String.format("%.2f", creditLimit);
        summary += "\nPersonal Banker: " + (hasPersonalBanker() ? "Yes" : "No");
        summary += "\nPriority Transactions: " + priorityTransactions;
        
        if (qualifiesForPremiumBenefits()) {
            double totalAvailable = balance + creditLimit;
            summary += "\nTotal Available Funds: $" + String.format("%.2f", totalAvailable);
        }
        
        return summary;
    }
}
