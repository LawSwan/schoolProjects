/************************************************************
 * Name: Amber Lawson
 * Date: July 08, 2025
 * Assignment CIS230 Week 3 GP – Arrays and ArrayLists
 *
 * Main application (program) class.
 * In this application we will demonstrate the use of Arrays and
 * ArrayLists for holding lists of items. The special for loop is also
 * introduced as a looping mechanism useful when working with arrays
 * and ArrayLists; commonly called a "for-each" loop. Note that for-each
 * loops are only used with collections of things, like arrays and
 * ArrayLists.
 ************************************************************/






import java.util.ArrayList;

public class App {
    public static void main(String[] args) {
        // Print a header line
        System.out.println("Amber Lawson - Week 3 GP - Arrays & ArrayLists");
        System.out.println();

        // Create (declare) an array to hold 10 integers
        int[] intArr = new int[10]; // allocates memory for 10 integers

        // Print a header for the columns of information
        System.out.printf("%s%8s%n", "Index", "Value");

        // Print the initial values in the array
        for (int i = 0; i < intArr.length; i++) {
            System.out.printf("%5d%8d%n", i, intArr[i]);
        }

        // Declare an ArrayList object
        ArrayList<Integer> intList = new ArrayList<Integer>();

        // Print the length of the ArrayList
        System.out.printf("%nLength of ArrayList: %d%n", intList.size());

        // Create an array with values
        String[] animalsArr = { "Dog", "Cat", "Goldfish", "Parrot", "Sloth" };

        // Print array length
        System.out.printf("%nArray Length: %d%n", animalsArr.length);

        // Use a for-each loop to print array elements
        for (String s : animalsArr) {
            System.out.println(s);
        }

        // Create an ArrayList of Strings and initialize it
        ArrayList<String> animalsList = new ArrayList<String>() {
            {
                add("Dog");
                add("Cat");
                add("Goldfish");
                add("Parrot");
                add("Sloth");
            }
        };

        // Print ArrayList length
        System.out.printf("%nArrayList Length: %d%n", animalsList.size());

        // Add elements to ArrayList
        animalsList.add("Elephant");
        animalsList.add("Lion");

        System.out.printf("%nArrayList Length after adding elements: %d%n", animalsList.size());

        // Print ArrayList elements
        for (String s : animalsList) {
            System.out.println(s);
        }
    }
}

