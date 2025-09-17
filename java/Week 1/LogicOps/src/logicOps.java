package logicOps;
import java.util.Scanner;
/**
 * Name: Amber Lawson
 * Date: 23 June 2025
 * Assignment: CIS230 Week 2 GP – Conditional Loops
 *
 * Main application (program) class.
 * In this application we will demonstrate how logical operators function
 * by printing "truth" tables to show the results of various logical and
 * conditional operators. We will also explore decision making through
 * the use of both an if-else statement and a switch statement.
 */
public class logicOps {
    

    public static void main(String[] args)throws Exception {
        // Print a header line
        System.out.println(
            "Amber - Week 2 GP - Decisions & Logical Operators");
        System.out.println();

        // Display a truth table for conditional AND (&&) operator
        System.out.printf(
            "Conditional AND (&&):%n%s: %b%n%s: %b%n%s: %b%n%s: %b%n",
            "false && false", false && false,
            "false && true",  false && true,
            "true && false",  true  && false,
            "true && true",   true  && true);

        // Display a truth table for conditional OR (||) operator
        System.out.printf(
            "Conditional OR (||):%n%s: %b%n%s: %b%n%s: %b%n%s: %b%n",
            "false || false", false || false,
            "false || true",  false || true,
            "true || false",  true  || false,
            "true || true",   true  || true);

        // Display a truth table for Logical AND (&) operator
        System.out.printf(
            "Logical AND (&):%n%s: %b%n%s: %b%n%s: %b%n%s: %b%n",
            "false & false",  false & false,
            "false & true",   false & true,
            "true & false",   true  & false,
            "true & true",    true  & true);

        // Display a truth table for Logical inclusive OR (|) operator
        System.out.printf(
            "Logical inclusive OR (|):%n%s: %b%n%s: %b%n%s: %b%n%s: %b%n",
            "false | false",  false | false,
            "false | true",   false | true,
            "true | false",   true  | false,
            "true | true",    true  | true);

        // Display a truth table for Logical exclusive OR (^) operator
        System.out.printf(
            "Logical exclusive OR (^):%n%s: %b%n%s: %b%n%s: %b%n%s: %b%n",
            "false ^ false",  false ^ false,
            "false ^ true",   false ^ true,
            "true ^ false",   true  ^ false,
            "true ^ true",    true  ^ true);

        // Display a truth table for logical negation (!) operator
        System.out.printf(
            "Logical negation (!):%n%s: %b%n%s: %b%n",
            "!false", !false,
            "!true",  !true);

        // Create a scanner to get input from the user
        Scanner input = new Scanner(System.in);

        System.out.println();
        System.out.print("Enter an integer grade in range 0 - 100: ");
        int grade = input.nextInt();

        // Determine the letter grade using an if-else structure
        System.out.println("Determining grade using if-else:");
        if (grade >= 90) {
            System.out.println("The grade entered is an A.");
        } else if (grade >= 80) {
            System.out.println("The grade entered is a B.");
        } else if (grade >= 70) {
            System.out.println("The grade entered is a C.");
        } else if (grade >= 60) {
            System.out.println("The grade entered is a D.");
        } else {
            System.out.println("The grade entered is an F.");
        }

        // Determine the letter grade using a switch structure
        System.out.println("Determining grade using switch:");
        switch (grade / 10) {
            case 10:
            case 9:
                System.out.println("The grade entered is an A.");
                break;
            case 8:
                System.out.println("The grade entered is a B.");
                break;
            case 7:
                System.out.println("The grade entered is a C.");
                break;
            case 6:
                System.out.println("The grade entered is a D.");
                break;
            default:
                System.out.println("The grade entered is an F.");
                break;
        }

        input.close();
    }
}


    