/***************************************************************
 * Name: Amber Lawson
 * Date: july 14,2025
 * Assignment CIS230 Week 4 GP – System Generated Exceptions
 
 * In this application we will demonstrate the use of exception handling
 * to properly process and handle a system-generated exception, allowing
 * the program to continue operating after an exception is thrown by the
 * system.
 */
import java.util.InputMismatchException;
import java.util.Scanner;

public class app {

    // Method to manually throw exception if denominator is zero
    public static int quotient(int numerator, int denominator) throws Exception {
        if (denominator == 0) {
            // User-generated exception with a custom message
            throw new Exception("Division by zero is not allowed!");
        }
        // If no exception, perform the division
        return numerator / denominator;
    }

    public static void main(String[] args) throws Exception {
        // Print assignment header
        System.out.println("Your Name - Week 4 GP - User Generated Exceptions");
        System.out.println();

        Scanner scanner = new Scanner(System.in);
        boolean cont = true;

        do {
            try {
                // Get user input
                System.out.print("Please enter an integer numerator: ");
                int numerator = scanner.nextInt();

                System.out.print("Please enter an integer denominator: ");
                int denominator = scanner.nextInt();

                // Attempt to divide
                int res = quotient(numerator, denominator);
                System.out.printf("%nResult: %d / %d = %d%n", numerator, denominator, res);
                cont = false; // exit loop if no error

            } catch (InputMismatchException e) {
                // Handle invalid (non-integer) input
                System.err.printf("%nException: %s%n", e);
                scanner.nextLine(); // discard bad input
                System.out.println("You must enter integers. Please try again.");

            } catch (Exception e) {
                // Handle custom user-generated exception (like division by zero)
                System.err.printf("%nUser-Generated Exception: %s%n", e);
                scanner.nextLine(); // discard input
                System.out.printf("%s Please try again.%n", e);
            }

        } while (cont);
    }
}
    
