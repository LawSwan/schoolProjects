
    /**************************************************************
* Name: Amber Lawson
* Course: CIS230
* Date: 07/10/2025
* Assignment CIS218 Week 3 GP - Passing Arrays and ArrayLists
**************************************************************/

/*
 * Main application (program) class.
 * In this application we will demonstrate passing arrays and ArrayLists
 * as method parameters and returning arrays and ArrayLists as method return
 * values, which allows us to process the contents of the collection in a
 * method and encapsulate the looping process outside of the main application.
 */
import java.util.ArrayList;
import java.util.Scanner;

public class App {
    public static void main(String[] args) throws Exception {
        // Print a header line
        System.out.println(
            "Your Name - Week 3 GP - Passing Arrays & ArrayLists");
        System.out.println();

        // Declare a scanner to get user input
        Scanner input = new Scanner(System.in);

        // Ask the user for a count of grades to be entered
        System.out.println("Processing grades using an array:");
        System.out.print("How many grades will you enter? ");
        int gradeCount = input.nextInt();

        // Get an array of grades using our getGrades method
        int[] gradesArr = getGrades(gradeCount);

        // Calculate the average of the grades using our averageGrades method and display it
        int avg = averageGrades(gradesArr);
        System.out.printf("The average of the grades you entered is: %d%n", avg);

        // Get an array of grades using our getGrades method - note we're
        // using the overload that doesn't need the user to enter a count of
        // grades - an advantage of using an ArrayList - we don't need to
        // know how many items in advance
        System.out.println();
        System.out.println("Processing grades using an ArrayList:");
        ArrayList<Integer> gradesList = getGrades();

        // Calculate the average of the grades using our averageGrades method and display it
        avg = averageGrades(gradesList);
        System.out.printf("The average of the grades you entered is: %d%n", avg);
    }

    // Function to get grades from the user and return an array
    public static int[] getGrades(int count) {
        // Declare a scanner to get user input
        Scanner input = new Scanner(System.in);

        // Create (declare) an array to hold the number of grades the user specified
        int[] grades = new int[count];

        // Loop for the specified count and get values from the user
        for (int i = 0; i < count; i++) {
            System.out.print("Please enter a grade: ");
            grades[i] = input.nextInt();
        }

        return grades;
    }

    // Overloaded function to get grades from the user and return an ArrayList
    public static ArrayList<Integer> getGrades() {
        // Declare a scanner to get user input
        Scanner input = new Scanner(System.in);

        // Create (declare) an ArrayList to hold grades
        ArrayList<Integer> grades = new ArrayList<Integer>();

        // Loop to get values from the user, storing them in an ArrayList
        int grade = -1;
        do {
            System.out.print("Please enter a grade (-1 to quit): ");
            grade = input.nextInt();

            if (grade > 0) {
                grades.add(grade);
            }
        } while (grade > 0);

        return grades;
    }

    // Function to get the average of the grades in an array
    public static int averageGrades(int[] grades) {
        int total = 0;

        for (int grade : grades) {
            total += grade;
        }

        return total / grades.length;
    }

    // Overloaded function to get the average of the grades in an ArrayList
    public static int averageGrades(ArrayList<Integer> grades) {
        int total = 0;

        for (int grade : grades) {
            total += grade;
        }

        return total / grades.size();
    }
}

