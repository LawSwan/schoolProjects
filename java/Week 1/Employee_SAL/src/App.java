
/**
 * Name: Amber Lawson 
 * Date: 22 June 2025
 * Assignment: SDC230 Performance Assessment - Classes
 * Description: Main application class to demonstrate Employee class usage.
 */
public class App {
    public static void main(String[] args) {
        System.out.println("Amber Lawson - Week 1 PA Classes");

        // Create 2 Employee objects, one with invalid salary
        Employee emp1 = new Employee("Alice", "Smith", 2500);
        Employee emp2 = new Employee("Bob", "Jones", 900); // Invalid salary

        // Print initial info
        System.out.println("\nInitial Employee Information:");
        printEmployee(emp1);
        printEmployee(emp2);

        // Update employee info
        emp1.setLastName("Johnson");
        emp2.setFirstName("Robert");
        emp1.setMonthlySalary(3000);
        emp2.setMonthlySalary(1200);

        // Print updated info
        System.out.println("\nUpdated Employee Information:");
        printEmployee(emp1);
        printEmployee(emp2);
    }

    // Helper method to print employee info
    private static void printEmployee(Employee emp) {
        System.out.printf("Name: %s %s | Monthly Salary: $%.2f\n",
                emp.getFirstName(), emp.getLastName(), emp.getMonthlySalary());
    }
}
