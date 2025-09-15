/**************************************************
 * Name: Amber Lawson
 * Date: 06/18/2025
 * Assignment: CIS230 Week 1 GP – Account Class
 *
 * Account class.
 * This class represents an account, such as a bank account, with an
 * individual’s name and the balance associated with the account. A
 * getter and setter are provided for the name property; a getter is
 * provided for the balance along with a deposit method to add an
 * amount to the balance.
 *
 * Note that error checking is done on the initial balance and the
 * deposit amounts to ensure they are greater than 0, and that the
 * balance cannot be set other than via the constructor – the only
 * way to modify the balance is via a deposit.
 *
 * Class properties (instance variables) are private to prevent
 * access outside of the class itself.
 **************************************************/

public class Account {
    private String name;
    private double balance;
    
    public Account(String name, double initBalance) {
        this.name = name;
        if (initBalance > 0.0) balance = initBalance;
    }
    public String getName()    { return name; }
    public double getBalance() { return balance; }
    public void deposit(double amt) {
        if (amt > 0.0) balance += amt;
    }
}