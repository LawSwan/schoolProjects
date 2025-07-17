/***************************************************************
 * Name: Amber Lawson
 * Date: July, 14 2025
 * Assignment CIS230 Week 4 GP – User Generated Exceptions
 *
 * Main application (program) class.
 */

/*
 * In this application we will demonstrate the use of exception handling
 * to generate and properly handle both a user-generated and a system-
 * generated exception, allowing the program to continue operating after
 * an exception is thrown.
 */
import java.util.InputMismatchException;
import java.util.Scanner;

public class app {

    // Method to divide two numbers, may throw ArithmeticException
    public static int quotient(int numerator, int denominator) throws ArithmeticException {
        return numerator / denominator; // division, might throw exception if denominator is 0
    }

    public static void main(String[] args) throws Exception {
        // Display assignment header
        System.out.println("Your Name - Week 4 GP - System Generated Exceptions");
        System.out.println();

        Scanner scanner = new Scanner(System.in);
        boolean cont = true; // loop control

        do {
            try {
                // Prompt user for numerator and denominator
                System.out.print("Please enter an integer numerator: ");
                int numerator = scanner.nextInt();

                System.out.print("Please enter an integer denominator: ");
                int denominator = scanner.nextInt();

                // Try to divide
                int res = quotient(numerator, denominator);
                System.out.printf("%nResult: %d / %d = %d%n", numerator, denominator, res);

                cont = false; // exit loop if successful

            } catch (InputMismatchException e) {
                // Handle non-integer input
                System.err.printf("%nException: %s%n", e);
                scanner.nextLine(); // clear buffer
                System.out.println("You must enter integers. Please try again.");

            } catch (ArithmeticException e) {
                // Handle divide-by-zero
                System.err.printf("%nException: %s%n", e);
                scanner.nextLine(); // clear buffer
                System.out.println("Zero is an invalid denominator. Please try again.");
            }

        } while (cont);

        // Show what would happen with no exception handling
        System.out.println("Here's what would have happened with no Exception Handling:");
        System.out.println();

        System.out.print("Please enter an integer numerator: ");
        int numerator = scanner.nextInt();

        System.out.print("Please enter an integer denominator: ");
        int denominator = scanner.nextInt();

        int res = quotient(numerator, denominator);

        // This line may not execute if there's an exception
        System.out.printf("%nResult: %d / %d = %d%n", numerator, denominator, res);
    }
}