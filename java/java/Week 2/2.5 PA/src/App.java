//Name: Amber Lawson
 //* Date: 06/25/2025
// Week 2 PA Loops & Calculations


import java.util.Scanner;

public class App {
    public static void main(String[] args) throws Exception {
        Scanner input = new Scanner(System.in);
        System.out.println("Your Name - Week 2 PA Loops & Calculations\n");

        // Counter-controlled loop: Sum 1 to 10
        System.out.println("Calculating the sum of integers 1 - 10:");
        int sum = 0;
        for (int i = 1; i <= 10; i++) {
            sum += i;
            System.out.printf("Total so far: %d%n", sum);
        }
        System.out.printf("Final total: %d%n%n", sum);

        // Condition-based loop: User input
        System.out.println("Adding integers entered:");
        int total = 0, count = 0, value;

        System.out.print("Enter an integer between 0 and 100 (-1 to stop): ");
        value = input.nextInt();

        while (value != -1) {
            total += value;
            count++;
            System.out.printf("Total so far: %d%n", total);
            System.out.print("Enter a grade between 0 and 100 (-1 to stop): ");
            value = input.nextInt();
        }

        System.out.printf("Final total: %d%n", total);
        System.out.printf("Count of values entered: %d%n", count);
        input.close();
    }
}