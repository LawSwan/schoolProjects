/*****************************************************
 * Name: Your Name
 * Date: 07/16/2025
 * Assignment: SDC230 Performance Assessment - Account Balance Calculations
 * Description: This program performs basic account balance updates
 * with user input and handles invalid and overdraft entries.
 *****************************************************/

import java.util.InputMismatchException;
import java.util.Scanner;

// Custom Exception Class
class OverdraftException extends Exception {
    public OverdraftException(String message) {
        super(message);
    }
}

public class app {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        double balance = 0.0;

        System.out.println("Your Name - Week 4 PA Account Balance Calculations\n");

        try {
            System.out.print("Enter starting balance: ");
            balance = scanner.nextDouble();
        } catch (InputMismatchException e) {
            System.out.println("\nInvalid input. Please restart and enter a valid number.");
            return;
        }

        while (true) {
            try {
                System.out.print("\nEnter credit (+) or debit (-), or 0 to quit: ");
                double amount = scanner.nextDouble();

                if (amount == 0) break;

                if (balance + amount < 0) {
                    throw new OverdraftException("Transaction declined. Debit would cause balance to go negative.");
                }

                balance += amount;
                System.out.println("Updated balance: $" + balance);

            } catch (InputMismatchException e) {
                System.out.println("\njava.util.InputMismatchException");
                System.out.println("Invalid input. Please enter a number.");
                scanner.nextLine(); // clear invalid input
            } catch (OverdraftException e) {
                System.out.println("\n" + e.getMessage());
            }
        }

        System.out.println("\nFinal account balance: $" + balance);
        scanner.close();
    }
}