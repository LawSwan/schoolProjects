// Amber Lawson
// July 11, 2025
// SDC230 Performance Assessment - Calculations & Unique Numbers
// This program collects 10 integers from the user, stores them in an array,
// stores unique values in an ArrayList, and displays count, sum, and average for both.

import java.util.Scanner;
import java.util.ArrayList;


public class app {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        int[] numbers = new int[10];
        ArrayList<Integer> uniqueNumbers = new ArrayList<>();

        System.out.println("Amber Lawson - Week 3 PA Calculations & Unique Numbers");

        for (int i = 0; i < 10; i++) {
            System.out.print(" Enter a number ");
            int input = scanner.nextInt();
            numbers[i] = input;

            if (!uniqueNumbers.contains(input)) {
                uniqueNumbers.add(input);
            }
        }

        System.out.println("\n--- Array Summary ---");
        printSummary(numbers);

        System.out.println("\n--- Unique ArrayList Summary ---");
        printSummary(uniqueNumbers);

        scanner.close(); // Close the scanner to free resources
    }

    public static int sum(int[] arr) {
        int total = 0;
        for (int num : arr) {
            total += num;
        }
        return total;
    }

    public static int sum(ArrayList<Integer> list) {
        int total = 0;
        for (int num : list) {
            total += num;
        }
        return total;
    }

    public static double average(int total, int count) {
        return (count == 0) ? 0 : (double) total / count;
    }

    public static void printSummary(int[] arr) {
        int total = sum(arr);
        System.out.println("Count of elements: " + arr.length);
        System.out.println("Sum of elements: " + total);
        System.out.println("Average of elements: " + average(total, arr.length));
    }

    public static void printSummary(ArrayList<Integer> list) {
        int total = sum(list);
        System.out.println("Count of elements: " + list.size());
        System.out.println("Sum of elements: " + total);
        System.out.println("Average of elements: " + average(total, list.size()));
    }
}

