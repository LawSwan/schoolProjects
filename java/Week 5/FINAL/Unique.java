//AMBER LAWSON
//SDC230 
//Final Practical Exam - Unique Numbers
//JULY 24 2025
//This program collects 5 unique integers from the user, checks for range and uniqueness,
//and then provides various statistics about the numbers entered.
//It handles exceptions for invalid input and displays results accordingly.

import java.util.ArrayList;
import java.util.InputMismatchException;
import java.util.List;
import java.util.Scanner;

public class Unique {
    private final List<Integer> numbers = new ArrayList<>(5);

    public void getNumbers() {
        Scanner sc = new Scanner(System.in);
        while (numbers.size() < 5) {
            System.out.print("Please enter an integer value: ");
            try {
                int n = sc.nextInt();

                // Range check
                if (n < 0 || n > 100) {
                    throw new IllegalArgumentException(
                        "You must enter a value between 0 and 100, inclusive.");
                }

                // Uniqueness check
                if (!numbers.contains(n)) {
                    numbers.add(n);
                }
            } catch (InputMismatchException ex) {
                System.out.println("That wasn’t an integer – try again.");
                sc.next();                 // clear bad token
            } catch (IllegalArgumentException ex) {
                System.out.println(ex.getMessage());
            }
        }
    }

    // Data-access helpers (simple stream ops keep it readable)
    public List<Integer> getAll()             { return numbers; }
    public int  getMax()                      { return numbers.stream().max(Integer::compare).orElse(0); }
    public int  getMin()                      { return numbers.stream().min(Integer::compare).orElse(0); }
    public int  getSum()                      { return numbers.stream().mapToInt(Integer::intValue).sum(); }
    public double getAvg()                    { return getSum() / (double) numbers.size(); }
    public double getLastDivFirst()           { return numbers.get(numbers.size()-1) / (double) numbers.get(0); }
}