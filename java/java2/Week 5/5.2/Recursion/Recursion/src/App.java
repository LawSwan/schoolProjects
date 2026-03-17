/*******************************************************************
 * Name: Amber Lawson
 * Date: DECEMBER 8, 2025
 * Assignment: SDC330 Week 5 GP – Recursion & Iteration
 *
 * Main application class.
 */
public class App {
    public static void main(String[] args) throws Exception {
        System.out.println("\nAmber Lawson, Week 5 Recursion & Iteration GP\n");

        System.out.println("Iterative Countdown from 10:");
        iterativeCountdown(10);

        System.out.println("\n\nRecursive Countdown from 10:");
        recursiveCountdown(10);

        System.out.println("\n\nIterative Name Reverse:");
        System.out.println(iterativeNameReverse("Your Name"));

        System.out.println("\nRecursive Name Reverse:");
        System.out.println(recursiveNameReverse("Your Name"));
    }

    private static void iterativeCountdown(int startNum) {
        for (int i = startNum; i > 0; i--) {
            System.out.print(i + ", ");
        }
        System.out.print("Blastoff!");
    }

    private static void recursiveCountdown(int startNum) {
        if (startNum == 0) {
            System.out.print("Blastoff!");
        } else {
            System.out.print(startNum + ", ");
            recursiveCountdown(startNum - 1);
        }
    }

    private static String iterativeNameReverse(String name) {
        StringBuilder reverseName = new StringBuilder();
        char[] strChars = name.toCharArray();

        for (int i = name.length() - 1; i >= 0; i--) {
            reverseName.append(strChars[i]);
        }

        return reverseName.toString();
    }

    private static String recursiveNameReverse(String name) {
        if (name.length() == 0) {
            return "";
        } else {
            return recursiveNameReverse(name.substring(1)) + name.charAt(0);
        }
    }
}