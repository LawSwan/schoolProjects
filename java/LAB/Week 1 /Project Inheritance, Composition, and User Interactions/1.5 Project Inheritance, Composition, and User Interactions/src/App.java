/*******************************************************************
 * Name: Amber Lawson
 * Date: 20 November 2025
 * Purpose: Week 2 Project – Bank Account App (Demo)
 * Demonstrates: interface usage and polymorphism with bank accounts.
 ******************************************************************/

import java.util.ArrayList;

public class App {

    public static void main(String[] args) {
        System.out.println("====================================");
        System.out.println(" Week 2 Project – Bank Account App");
        System.out.println(" Author: Amber Lawson");
        System.out.println("====================================\n");

        System.out.println("Welcome!");
        System.out.println("This demo shows:");
        System.out.println("Use of an interface (IAccountActions)");
        System.out.println("Polymorphism with different account types\n");

        // Composition: BankUser HAS accounts
        BankUser user = new BankUser("Amber Lawson");

        // Interface polymorphism: same IAccountActions type, different objects
        IAccountActions checking = new CheckingAccount("CHK1001", 1200.00);
        IAccountActions savings  = new SavingsAccount("SAV2001", 3000.00);

        // Add to user (BankUser stores BankAccount references)
        user.addAccount((BankAccount) checking);
        user.addAccount((BankAccount) savings);

        // Do some actions using the interface
        checking.deposit(300.00);
        savings.deposit(200.00);
        checking.withdraw(50.00);

        // Put all interface references in a list to show polymorphism
        ArrayList<IAccountActions> actionList = new ArrayList<>();
        actionList.add(checking);
        actionList.add(savings);

        System.out.println("\n--- Account Summaries (Polymorphism) ---");
        for (IAccountActions account : actionList) {
            // Polymorphism: calls the overridden version for each type
            System.out.println(account.getSummary());
            System.out.println("---------------------------------------");
        }

        System.out.println("\n--- Monthly Updates (More Polymorphism) ---");
        for (IAccountActions account : actionList) {
            account.processMonthlyUpdate();   // runtime behavior depends on account type
            System.out.println(account.getSummary());
            System.out.println("---------------------------------------");
        }

        System.out.println("\nThank you for using the Week 2 demo!");
    }
}