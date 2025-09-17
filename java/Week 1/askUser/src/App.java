import java.util.Scanner;

public class App {
  public static void main(String[] args) throws Exception  {
        Scanner scanner = new Scanner(System.in);

        // Ask for user's name
        System.out.print("Enter your name: ");
        String name = scanner.nextLine();

        // Ask for annual salary
        System.out.print("Enter your annual salary: ");
        double annualSalary = scanner.nextDouble();

        // Calculate weekly pay
        double weeklyPay = annualSalary / 52;

        // Display result
        System.out.printf("Hello, %s! Your weekly pay is $%.2f\n", name, weeklyPay);

        scanner.close();
    }
}