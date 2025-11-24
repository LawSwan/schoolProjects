/*******************************************************************
 * Name: Amber Lawson
 * Date: 20 November 2025
 * Purpose: Base class for bank accounts.
 * Demonstrates: inheritance base class and implements interface.
 ******************************************************************/

public abstract class BankAccount implements IAccountActions {

    protected String accountNumber;
    protected double balance;

    public BankAccount(String accountNumber, double balance) {
        this.accountNumber = accountNumber;
        this.balance = balance;
    }

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

    // Abstract so each child defines its own behavior
    @Override
    public abstract void processMonthlyUpdate();
}