/* 
 * Name: Amber Lawson
 * Date: July 11, 2025
 * Assignment: SDC230 Midterm Practical Exam
 * Description: This program collects 10 integers from the user,
 *              stores them in an array, and determines the
 *              smallest and largest values entered.
 */

import java.util.Scanner;

public class app {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        int[] numbers = new int[10];

        // Collect 10 numbers from user
        for (int i = 0; i < numbers.length; i++) {
            System.out.print("Enter number " + (i + 1) + ": ");
            numbers[i] = scanner.nextInt();
        }

        // Display numbers with indexes
        System.out.println("\nIndex\tValue");
        for (int i = 0; i < numbers.length; i++) {
            System.out.println(i + "\t" + numbers[i]);
        }

        int smallest = findSmallest(numbers);
        int largest = findLargest(numbers);

        // Display results
        System.out.println("\nSmallest number: " + smallest);
        System.out.println("Largest number: " + largest);

        scanner.close();
    }

    // The Method to find smallest number 
    public static int findSmallest(int[] arr) {
        int min = arr[0];
        for (int num : arr) {
            if (num < min) {
                min = num;
            }
        }
        return min;
    }

    // Method to find largest number
    public static int findLargest(int[] arr) {
        int max = arr[0];
        for (int num : arr) {
            if (num > max) {
                max = num;
            }
        }
        return max;
    }
}