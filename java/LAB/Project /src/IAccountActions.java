/*******************************************************************
 * Name: Amber Lawson
 * Date: 20 November 2025
 * Purpose: Interface for common account actions.
 * Demonstrates: creation and use of an interface.
 ******************************************************************/

public interface IAccountActions {

    void deposit(double amount);

    boolean withdraw(double amount);

    String getSummary();

    // Used to demonstrate polymorphism for different account types
    void processMonthlyUpdate();
}