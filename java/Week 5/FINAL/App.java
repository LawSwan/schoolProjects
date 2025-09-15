//AMBER LAWSON
//Final Practical Exam - Unique Numbers
//JULY 24 2025

//This program collects 5 unique integers from the user, checks for range and uniqueness,
//and then provides various statistics about the numbers entered.
//It handles exceptions for invalid input and displays results accordingly.


public class App {
        public static void main(String[] args) {
        System.out.println("Amber Lawson - Final Practical Exam\n");

        Unique u = new Unique();
        u.getNumbers();

        System.out.println("\nUnique Values Entered:");
        u.getAll().forEach(n -> System.out.print(n + " "));
        System.out.println();

        System.out.println("Min Value Entered: "   + u.getMin());
        System.out.println("Max Value Entered: "   + u.getMax());
        System.out.println("Sum of Values: "       + u.getSum());
        System.out.println("Average of Values: "   + (int) u.getAvg());

        try {
            System.out.println("Last ÷ First: " + u.getLastDivFirst());
        } catch (ArithmeticException ex) {
            System.out.println("java.lang.ArithmeticException: / by zero");
        }

        System.out.println("All processing completed!");
    }
}

    

