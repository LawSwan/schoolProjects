/**************************************************
 * Name: Amber Lawson
 * Date: 06/18/2025
 * Assignment: CIS230 Week 1 GP – Account Class
 *
 * Main application (program) class.
 * In this application we will create (instantiate) objects of type
 * Account, use the Account object methods to modify the initial
 * Account data, and print the data to the console.
 **************************************************/
import java.util.Scanner;

public class App {
    public static void main(String[] args) throws Exception {
        System.out.println();
        System.out.println("Amber Lawson - Week 1 GP Account Class");

        // Create 2 instances of the Account class
        Account acct1 = new Account("Janelle Green", 50.00);
        Account acct2 = new Account("John Blue", -7.53);

        // Display the initial balances of each account
        System.out.printf("%n%s balance: $%.2f%n",
                          acct1.getName(), acct1.getBalance());
        System.out.printf("%s balance: $%.2f%n",
                          acct2.getName(), acct2.getBalance());

        // Create a Scanner to get input from the user
        Scanner input = new Scanner(System.in);

        // Get a deposit amount for Jane's account
        System.out.println();
        System.out.print("Enter deposit amount for Jane's account: $");
        double deposit = input.nextDouble();
        System.out.printf("%nAdding $%.2f to Jane's account%n%n", deposit);
        acct1.deposit(deposit);

        // Get a deposit amount for John's account
        System.out.print("Enter deposit amount for John's account: $");
        deposit = input.nextDouble();
        System.out.printf("%nAdding $%.2f to John's account%n%n", deposit);
        acct2.deposit(deposit);

        // Display the balances of each account after deposits
        System.out.printf("%s balance: $%.2f%n",
                          acct1.getName(), acct1.getBalance());
        System.out.printf("%s balance: $%.2f%n",
                          acct2.getName(), acct2.getBalance());

        input.close();
    }
}