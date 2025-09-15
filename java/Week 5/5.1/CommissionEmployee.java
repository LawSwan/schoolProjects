// Name: Steven Olsen
// Date: July 21, 2025
// Assignment: BasePlusCommissionEmployee Constructor Simulation
// Description: Demonstrates constructor chaining, validation,
// and full object initialization using Java class syntax.

public class CommissionEmployee {
    private String firstName;
    private String lastName;
    private String ssn;
    private double grossSales;
    private double commissionRate;

    public CommissionEmployee(String firstName, String lastName, String ssn, double grossSales, double commissionRate) {
        this.firstName = firstName;
        this.lastName = lastName;
        this.ssn = ssn;
        setGrossSales(grossSales);
        setCommissionRate(commissionRate);
    }

    public void setGrossSales(double sales) {
        if (sales < 0) throw new IllegalArgumentException("Gross sales must be >= 0.0");
        this.grossSales = sales;
    }

    public void setCommissionRate(double rate) {
        if (rate <= 0 || rate >= 1) throw new IllegalArgumentException("Commission rate must be > 0.0 and < 1.0");
        this.commissionRate = rate;
    }

    public String getFirstName() { return firstName; }
    public String getLastName() { return lastName; }
    public String getSsn() { return ssn; }
    public double getGrossSales() { return grossSales; }
    public double getCommissionRate() { return commissionRate; }
}

class BasePlusCommissionEmployee extends CommissionEmployee {
    private double baseSalary;

    public BasePlusCommissionEmployee(String firstName, String lastName, String ssn, double grossSales, double commissionRate, double baseSalary) {
        super(firstName, lastName, ssn, grossSales, commissionRate);
        if (baseSalary < 0) throw new IllegalArgumentException("Base salary must be >= 0.0");
        this.baseSalary = baseSalary;
    }

    public void printDetails() {
        System.out.println("Name: " + getFirstName() + " " + getLastName());
        System.out.println("SSN: " + getSsn());
        System.out.println("Gross Sales: " + getGrossSales());
        System.out.println("Commission Rate: " + getCommissionRate());
        System.out.println("Base Salary: " + baseSalary);
    }
}

class TestEmployee {
    public static void main(String[] args) {
        try {
            BasePlusCommissionEmployee employee = new BasePlusCommissionEmployee("Steven", "Olsen", "123-45-6789", 5000, 0.1, 1000);
            employee.printDetails();
        } catch (Exception err) {
            System.err.println("Initialization error: " + err.getMessage());
        }
    }
}
