import java.io.*;
import java.util.Scanner;

public class main {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        int choice;
        
        // loop until user picks “Exit”
        do {
            choice = menu(scanner);
            mainLoop(choice, scanner);
        } while (choice != 5);
        
        System.out.println("Good-bye!");
        scanner.close();
    }

    /** 
     * 1. menu(): shows 5 options, clears screen, returns user’s choice 
     */
    public static int menu(Scanner scanner) {
        // ANSI escape for “clear screen” (works in most terminals)
        System.out.print("\033[H\033[2J");
        System.out.flush();

        System.out.println("=== Main Menu ===");
        System.out.println("1. Addition");
        System.out.println("2. Multiplication");
        System.out.println("3. Write to file");
        System.out.println("4. Read from file");
        System.out.println("5. Exit");
        System.out.print("Choose (1–5): ");

        while (!scanner.hasNextInt()) {
            scanner.next(); 
            System.out.print("Please enter 1-5: ");
        }
        return scanner.nextInt();
    }

    /** 
     * 2. mainLoop(): dispatches to each feature based on choice 
     */
    public static void mainLoop(int option, Scanner scanner) {
        switch (option) {
            case 1:
                System.out.print("Enter two ints for addition: ");
                int a1 = scanner.nextInt(), b1 = scanner.nextInt();
                firstCalculation(a1, b1);
                break;

            case 2:
                System.out.print("Enter two ints for multiplication: ");
                int a2 = scanner.nextInt(), b2 = scanner.nextInt();
                secondCalculation(a2, b2);
                break;

            case 3:
                writeFile();
                break;

            case 4:
                readFile();
                break;

            case 5:
                // exit – nothing to do
                break;

            default:
                System.out.println("Invalid choice.");
        }

        // pause before returning
        System.out.println("\n-- press Enter to continue --");
        scanner.nextLine(); // consume leftover
        scanner.nextLine();
    }

    /** 
     * 5. firstCalculation(): addition 
     */
    public static void firstCalculation(int a, int b) {
        int sum = a + b;
        System.out.println("Result of addition: " + sum);
    }

    /** 
     * 6. secondCalculation(): multiplication 
     */
    public static void secondCalculation(int a, int b) {
        int product = a * b;
        System.out.println("Result of multiplication: " + product);
    }

    /** 
     * 3. writeFile(): writes sample data to “output.txt” 
     */
    public static void writeFile() {
        String file = "output.txt";
        try (BufferedWriter out = new BufferedWriter(new FileWriter(file))) {
            out.write("Hello from writeFile()!\n");
            System.out.println("Data written to " + file);
        } catch (IOException e) {
            System.out.println("Error writing file: " + e.getMessage());
        }
    }

    /** 
     * 4. readFile(): reads “output.txt” char by char until EOF 
     */
    public static void readFile() {
        String file = "output.txt";
        try (FileReader in = new FileReader(file)) {
            int ch;
            while ((ch = in.read()) != -1) {
                System.out.print((char) ch);
            }
            System.out.println();
        } catch (IOException e) {
            System.out.println("Error reading file: " + e.getMessage());
        }
    }
}