import java.util.Scanner;

/**
 * Name: Amber Lawson
 * Date: 06/26/2025
 * Assignment: SDC230 Performance Assessment - Smallest Number
 * Description: This program finds the smallest number entered by the user.
 */

public class App {
    public static void main(String[] args)  throws Exception {
        Scanner input = new Scanner(System.in);

        System.out.println("Amber Lawson - Week 2 PA Smallest Number");
        System.out.println();
        System.out.println("Finding the Smallest Value:");
        System.out.print("How many numbers would you like to enter (1 to 10): ");
        int numOfInputs = input.nextInt();

        int smallest;

        System.out.print("Enter a number for the first value: ");
        smallest = input.nextInt(); // First value assigned to smallest

        for (int i = 2; i <= numOfInputs; i++) {
            System.out.print("Enter another value " + i + ": ");
            int value = input.nextInt();

            if (value < smallest) {
                smallest = value;
            }
        }

        System.out.printf("Smallest value is: %d%n", smallest);
        input.close();
    }
}