package Cond_Loops.src;

/**
 * Name: Amber J Lawson
 * Date: 22 JUNE 2025
 * Assignment: SDC230 Performance Assessment - IO & Operators
 * Description: Demonstrates input, output, and operators with integers and floating point numbers.
 */

import java.util.Scanner;

public class App {
    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);

        // Print header
        System.out.println("AMBER J. LAWSON - Week 1 PA IO & Operators");

        // Integer-based operations
        System.out.print("Enter first integer: ");
        int int1 = sc.nextInt();
        System.out.print("Enter second integer: ");
        int int2 = sc.nextInt();

        int intSum = int1 + int2;
        System.out.println("Sum: " + intSum);

        // Integer comparisons
        System.out.println("Equality: " + (int1 == int2 ? "Equal" : "Not Equal"));
        System.out.println("Size: " + (int1 > int2 ? "First is greater" : (int1 < int2 ? "First is less" : "Equal")));
        System.out.println("Size with equality: " +
                (int1 >= int2 ? "First is greater than or equal to second" : "First is less than or equal to second"));

        // Floating point-based operations
        System.out.print("Enter first floating point value: ");
        double double1 = sc.nextDouble();
        System.out.print("Enter second floating point value: ");
        double double2 = sc.nextDouble();

        double doubleSum = double1 + double2;
        System.out.printf("Sum: %.4f\n", doubleSum);

        // Floating point comparisons
        System.out.println("Equality: " + (double1 == double2 ? "Equal" : "Not Equal"));
        System.out.println("Size: " + (double1 > double2 ? "First is greater" : (double1 < double2 ? "First is less" : "Equal")));
        System.out.println("Size with equality: " +
                (double1 >= double2 ? "First is greater than or equal to second" : "First is less than or equal to second"));

        // Display floating point values to 4 decimal places
        System.out.printf("First value: %.4f\n", double1);
        System.out.printf("Second value: %.4f\n", double2);

        sc.close();
    }
}