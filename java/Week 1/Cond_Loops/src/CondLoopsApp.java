/**
 * Name: Amber Lawson
 * Date: 23 June 2025
 * Assignment: CIS230 Week 2 GP – Conditional Loops
 *
 * Main application (program) class.
 * In this application we will demonstrate the use of condition-based
 * loops by asking the user for input and continuing to ask for input
 * until the user indicates that they want to quit. Upon quitting, the
 * program will display the number of passing and failing grades entered.
 */
import java.util.Scanner;

public class CondLoopsApp {
    public static void main(String[] args) {
        Scanner input = new Scanner(System.in);

        // Header
        System.out.println("Amber Lawson – Week 2 GP – Conditional Loops");
        System.out.println();

        // PART A: while‐loop version
        System.out.println("Looping using a while loop:");
        System.out.print("Enter a grade between 0 and 100 (-1 to stop): ");
        int inVal = input.nextInt();
        int passCount = 0;
        int failCount = 0;

        while (inVal != -1) {
            if (inVal >= 60) {
                passCount++;
            } else {
                failCount++;
            }
            System.out.print("Enter a grade between 0 and 100 (-1 to stop): ");
            inVal = input.nextInt();
        }

        System.out.printf("Count of passing grades: %d%n", passCount);
        System.out.printf("Count of failing grades: %d%n%n", failCount);


        // PART B: do‐while‐loop version
        System.out.println("Looping using a do-while loop:");
        passCount = 0;
        failCount = 0;

        do {
            System.out.print("Enter a grade between 0 and 100 (-1 to stop): ");
            inVal = input.nextInt();
            if (inVal == -1) {
                break;
            }
            if (inVal >= 60) {
                passCount++;
            } else {
                failCount++;
            }
        } while (inVal != -1);

        System.out.printf("Count of passing grades: %d%n", passCount);
        System.out.printf("Count of failing grades: %d%n", failCount);

        input.close();
    }
}