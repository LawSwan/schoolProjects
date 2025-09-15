package counter_controlled;

/***********************************************************
 * Name: Amber Lawson
 * Date:25 june 2025
 * Assignment CIS230 Week 2 GP - Counter Controlled Loops
 *
 * Main application (program) class.
 * In this application we will demonstrate the use of counter-controlled
 * loops and increment/decrement operators by showing several examples
 * of counted operations.
 */
public class App {

    public static void main(String[] args) throws Exception {
        // Print a header line
        System.out.println("Your Name - Week 2 GP - Counter Controlled Loops");
        System.out.println();

        // Prefix increment & decrement operators
        int c = 5;
        System.out.printf("Value of c before prefix increment: %d%n", c);
        System.out.printf("Value of c with prefix increment (++c): %d%n", ++c);
        System.out.printf("Value of c after prefix increment: %d%n%n", c);

        c = 5;
        System.out.printf("Value of c before prefix decrement: %d%n", c);
        System.out.printf("Value of c with prefix decrement (--c): %d%n", --c);
        System.out.printf("Value of c after prefix decrement: %d%n%n", c);

        // Suffix increment (postincrement) & decrement operators
        c = 5;
        System.out.printf("Value of c before suffix increment: %d%n", c);
        System.out.printf("Value of c with suffix increment (c++): %d%n", c++);
        System.out.printf("Value of c after suffix increment: %d%n%n", c);

        c = 5;
        System.out.printf("Value of c before suffix decrement: %d%n", c);
        System.out.printf("Value of c with suffix decrement (c--): %d%n", c--);
        System.out.printf("Value of c after suffix decrement: %d%n%n", c);

        // counter-controlled while loop
        System.out.println("Counter-Controlled while Loop demonstration");
        int wcnt1 = 1;

        while (wcnt1 <= 10) {
            System.out.printf("%d ", wcnt1);
            wcnt1++;
        }

        // same thing, with a for loop
        System.out.printf("%n%n");
        System.out.println("for Loop demonstration");
        for (int cnt = 1; cnt <= 10; cnt++) {
            System.out.printf("%d ", cnt);
        }

        // now the countdown...
        System.out.printf("%n%n");
        System.out.println("while loop countdown");
        int wcnt2 = 10;

        while (wcnt2 >= 0) {
                 wcnt2--;
        }

        // same thing, with a for loop
        System.out.printf("%n%n");
        System.out.println("for loop countdown");
        for (int cnt = 10; cnt >= 0; cnt--) {
            System.out.printf("%d ", cnt);
        }
    }
}