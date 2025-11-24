/*******************************************************************
 * Name: Amber Lawson
 * Date: 20 November 2025
 * Purpose: SavingsAccount class extends BankAccount.
 * Demonstrates: inheritance and different polymorphic behavior.
 ******************************************************************/

public class SavingsAccount extends BankAccount {

    private static final double MONTHLY_INTEREST_RATE = 0.01; // 1 percent

    public SavingsAccount(String accountNumber, double balance) {
        super(accountNumber, balance);
    }

    @Override
    public void processMonthlyUpdate() {
        // Example: add interest
        balance += balance * MONTHLY_INTEREST_RATE;
    }

    @Override
    public String getSummary() {
        return "Savings Account\n" + super.getSummary();
    }
}