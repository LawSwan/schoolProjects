/*******************************************************************
 * Name: Amber Lawson
 * Date: 20 November 2025
 * Purpose: CheckingAccount class extends BankAccount.
 * Demonstrates: inheritance and polymorphic behavior.
 ******************************************************************/

public class CheckingAccount extends BankAccount {

    private static final double MONTHLY_FEE = 5.00;

    public CheckingAccount(String accountNumber, double balance) {
        super(accountNumber, balance);
    }

    @Override
    public void processMonthlyUpdate() {
        // Example: simple flat monthly fee
        balance -= MONTHLY_FEE;
    }

    @Override
    public String getSummary() {
        // Polymorphism: different label from SavingsAccount
        return "Checking Account\n" + super.getSummary();
    }
}