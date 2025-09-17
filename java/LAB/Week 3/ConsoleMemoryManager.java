import java.util.*;

public class ConsoleMemoryManager {
    private static double singleMemory = 0.0;
    private static final List<Integer> memoryList = new ArrayList<>();

    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);

        // ✨ Informative Header
        System.out.println("📘 Week 3 - KawaiiCalc Memory Assignment - Amber Lawson");
        System.out.println("Welcome! This is a memory manager for your calculator.");
        System.out.println("You can store a single value or up to 10 values in a list.\n");

        boolean running = true;

        while (running) {
            System.out.println("\n=== MEMORY MENU ===");
            System.out.println("1. Store single value");
            System.out.println("2. Retrieve single value");
            System.out.println("3. Clear single value");
            System.out.println("4. Replace single value");
            System.out.println("5. Add value to memory list (max 10)");
            System.out.println("6. View memory list");
            System.out.println("7. Count memory values");
            System.out.println("8. Remove value from memory list");
            System.out.println("9. Sum of values");
            System.out.println("10. Average of values");
            System.out.println("11. Difference (first - last)");
            System.out.println("12. Quit");

            System.out.print("Select an option: ");
            int choice = scanner.nextInt();

            switch (choice) {
                case 1 -> {
                    System.out.print("Enter value to store: ");
                    singleMemory = scanner.nextDouble();
                    System.out.println("✔️ Stored!");
                }
                case 2 -> System.out.println("Stored single value: " + singleMemory);
                case 3 -> {
                    singleMemory = 0.0;
                    System.out.println("Memory cleared.");
                }
                case 4 -> {
                    System.out.print("Enter new value to replace memory: ");
                    singleMemory = scanner.nextDouble();
                    System.out.println("Memory updated.");
                }
                case 5 -> {
                    if (memoryList.size() >= 10) {
                        System.out.println("❌ Memory full (10 values max)");
                    } else {
                        System.out.print("Enter integer to add: ");
                        int val = scanner.nextInt();
                        memoryList.add(val);
                        System.out.println("✔️ Added.");
                    }
                }
                case 6 -> System.out.println("Memory List: " + memoryList);
                case 7 -> System.out.println("Stored count: " + memoryList.size());
                case 8 -> {
                    System.out.print("Enter value to remove: ");
                    int val = scanner.nextInt();
                    if (memoryList.remove((Integer) val)) {
                        System.out.println("✔️ Removed.");
                    } else {
                        System.out.println("❌ Value not found.");
                    }
                }
                case 9 -> {
                    int sum = memoryList.stream().mapToInt(Integer::intValue).sum();
                    System.out.println("Sum of memory: " + sum);
                }
                case 10 -> {
                    if (!memoryList.isEmpty()) {
                        double avg = memoryList.stream().mapToInt(Integer::intValue).average().orElse(0.0);
                        System.out.printf("Average: %.2f%n", avg);
                    } else {
                        System.out.println("No values to average.");
                    }
                }
                case 11 -> {
                    if (memoryList.size() >= 2) {
                        int diff = memoryList.get(0) - memoryList.get(memoryList.size() - 1);
                        System.out.println("Difference (first - last): " + diff);
                    } else {
                        System.out.println("Need at least 2 values.");
                    }
                }
                case 12 -> {
                    running = false;
                    System.out.println("\n🙏 Thank you for using KawaiiCalc Memory Console!");
                }
                default -> System.out.println("Invalid choice. Try again.");
            }
        }

        scanner.close();
    }
}