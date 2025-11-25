/*******************************************************************
 * Name: Amber Lawson
 * Date: 25 November 2025
 * Purpose: BankUser demonstrates composition and proper encapsulation - Week 3
 * A BankUser "has" multiple BankAccount objects (composition relationship)
 * 
 * Constructor Benefits Demonstrated:
 * - Default constructor for quick user creation
 * - Parameterized constructors for complete initialization  
 * - Copy constructor for user duplication
 * 
 * Access Specifiers Benefits:
 * - Private fields protect user data from external access
 * - Public methods provide controlled access to functionality
 * - Proper encapsulation ensures data integrity
 ******************************************************************/

import java.util.ArrayList;
import java.time.LocalDate;

public class BankUser {
    // Private fields - properly encapsulated user data
    private String name;
    private String email;
    private LocalDate accountCreationDate;
    private ArrayList<BankAccount> accounts;
    private static int nextUserId = 1000;
    private String userId;

    /**
     * Default constructor - creates user with minimal information
     * Demonstrates: Default constructor with auto-generated values
     */
    public BankUser() {
        this.name = "New User";
        this.email = "user@bank.com";
        this.accountCreationDate = LocalDate.now();
        this.accounts = new ArrayList<>();
        this.userId = "USER" + (nextUserId++);
    }

    /**
     * Single parameter constructor - backward compatibility
     * Demonstrates: Constructor overloading for different use cases
     */
    public BankUser(String name) {
        this.name = (name != null && !name.trim().isEmpty()) ? name.trim() : "Anonymous User";
        this.email = "user@bank.com";
        this.accountCreationDate = LocalDate.now();
        this.accounts = new ArrayList<>();
        this.userId = "USER" + (nextUserId++);
    }

    /**
     * Full parameterized constructor - complete user initialization
     * Demonstrates: Parameterized constructor with validation
     */
    public BankUser(String name, String email) {
        setName(name);      // Use setter for validation
        setEmail(email);    // Use setter for validation
        this.accountCreationDate = LocalDate.now();
        this.accounts = new ArrayList<>();
        this.userId = "USER" + (nextUserId++);
    }

    /**
     * Copy constructor - creates new user based on existing user
     * Demonstrates: Copy constructor with deep copying for collections
     */
    public BankUser(BankUser other) {
        this.name = other.name;
        this.email = other.email;
        this.accountCreationDate = LocalDate.now(); // New user gets current date
        this.accounts = new ArrayList<>(); // New user starts with no accounts
        this.userId = "USER" + (nextUserId++); // New user gets new ID
        // Note: We don't copy accounts for security reasons
    }

    // Private helper methods for validation - demonstrates private access specifiers
    
    /**
     * Validates and sets user name - private helper method
     */
    private void setName(String name) {
        if (name != null && !name.trim().isEmpty()) {
            this.name = name.trim();
        } else {
            this.name = "Anonymous User";
        }
    }

    /**
     * Validates and sets email - private helper method
     */
    private void setEmail(String email) {
        if (email != null && email.contains("@") && email.contains(".")) {
            this.email = email.trim().toLowerCase();
        } else {
            this.email = "user@bank.com";
        }
    }

    // Public accessor methods - properly controlled access to private fields

    public String getName() {
        return name;
    }

    public String getEmail() {
        return email;
    }

    public LocalDate getAccountCreationDate() {
        return accountCreationDate;
    }

    public String getUserId() {
        return userId;
    }

    /**
     * Get number of accounts - demonstrates encapsulation
     * @return Number of accounts owned by this user
     */
    public int getAccountCount() {
        return accounts.size();
    }

    /**
     * Calculate total balance across all accounts
     * Demonstrates: Method that uses private data to provide useful information
     */
    public double getTotalBalance() {
        double total = 0.0;
        for (BankAccount account : accounts) {
            total += account.getBalance();
        }
        return total;
    }

    /**
     * Add account to user's portfolio
     * Demonstrates: Encapsulated collection management
     */
    public void addAccount(BankAccount account) {
        if (account != null) {
            accounts.add(account);
        }
    }

    /**
     * Remove account from user's portfolio
     * Demonstrates: Safe collection manipulation
     */
    public boolean removeAccount(String accountNumber) {
        return accounts.removeIf(account -> 
            account.getAccountNumber().equals(accountNumber));
    }

    /**
     * Find account by account number
     * Demonstrates: Encapsulated search functionality
     */
    public BankAccount findAccount(String accountNumber) {
        for (BankAccount account : accounts) {
            if (account.getAccountNumber().equals(accountNumber)) {
                return account;
            }
        }
        return null;
    }

    /**
     * Get copy of accounts list for safe external access
     * Demonstrates: Defensive copying to protect internal data
     */
    public ArrayList<BankAccount> getAccounts() {
        return new ArrayList<>(accounts); // Return copy, not original
    }

    /**
     * Get accounts of a specific type
     * Demonstrates: Type filtering using instanceof
     */
    public ArrayList<BankAccount> getAccountsByType(Class<? extends BankAccount> accountType) {
        ArrayList<BankAccount> filteredAccounts = new ArrayList<>();
        for (BankAccount account : accounts) {
            if (accountType.isInstance(account)) {
                filteredAccounts.add(account);
            }
        }
        return filteredAccounts;
    }

    /**
     * Override toString for meaningful string representation
     */
    @Override
    public String toString() {
        return String.format("User: %s (ID: %s, Email: %s, Accounts: %d)", 
                           name, userId, email, accounts.size());
    }
}