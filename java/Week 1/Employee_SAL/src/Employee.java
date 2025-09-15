package Employee_SAL;

/**
 * Name: Amber Lawon    
 * Date: 22 June 2025
 * Assignment: SDC230 Performance Assessment - Classes
 * Description: Employee class with private fields, constructor, getters, and setters.
 */
public class Employee {
    private String firstName;
    private String lastName;
    private double monthlySalary;

    // Constructor
    public Employee(String firstName, String lastName, double monthlySalary) {
        this.firstName = firstName;
        this.lastName = lastName;
        setMonthlySalary(monthlySalary);
    }

    // Getters
    public String getFirstName() {
        return firstName;
    }
    public String getLastName() {
        return lastName;
    }
    public double getMonthlySalary() {
        return monthlySalary;
    }

    // Setters
    public void setFirstName(String firstName) {
        this.firstName = firstName;
    }
    public void setLastName(String lastName) {
        this.lastName = lastName;
    }
    public void setMonthlySalary(double monthlySalary) {
        if (monthlySalary >= 1000) {
            this.monthlySalary = monthlySalary;
        }
        // If invalid, do not change the salary
    }
}
