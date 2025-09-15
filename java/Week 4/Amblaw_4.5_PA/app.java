/*****************************************************
 * Name: Amber Lawson
 * Date: 07/16/2025
 * Assignment: SDC230 Performance Assessment - User Entry of Age
 * Description: This program asks the user to enter their age
 * and handles exceptions for invalid input using exception handling.
 *****************************************************/

import java.util.InputMismatchException;
import java.util.Scanner;

public class app {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        int age = 0;
        boolean valid = false;

        System.out.println("Amber Lawson - Week 4 PA User Entry of Age\n");

        while (!valid) {
            try {
                System.out.print("Please enter your age: ");
                age = scanner.nextInt();

                if (age < 1 || age > 100) {
                    throw new InputMismatchException("\nPlease enter an integer in range 1 - 100.\n");
                }

                valid = true;
                System.out.println("\nThe age entered is: " + age);

            } catch (InputMismatchException e) {
                System.out.println("\njava.util.InputMismatchException");
                System.out.println("Please enter an integer in range 1 - 100.\n");
                scanner.nextLine(); // clear invalid input
            }
        }

        scanner.close();
    }
}