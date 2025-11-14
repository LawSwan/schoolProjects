/*
 * Author: Your Name
 * Date: 11/13/2025
 * Assignment: SDC330 Performance Assessment - Inheritance
 * Description: Main application to test all classes.
 */

// I understand: this defines the main application class
public class App {

    // I understand: this is the main entry point of the Java program
    public static void main(String[] args) {

        // I understand: this prints the required header line for the assignment
        System.out.println("Your Name - Week 1 Inheritance Performance Assessment\n");

        // I understand: this creates a Bicycle with 2 wheels, blue color, not moving, 1 seat, 6 gears, seat height 28.5, tire size 19.0
        Bicycle bicycle = new Bicycle(2, "Blue", false, 1,
                                      6, 28.5, 19.0);

        // I understand: this creates a Car with 4 wheels, red color, not moving, 5 seats, engine 2.5L V6, automatic, sunroof, small trunk storage
        Car car = new Car(4, "Red", false, 5,
                          "2.5L V6", true,
                          true, "Small Trunk");

        // I understand: this creates a Truck with 4 wheels, black color, not moving, 2 seats, engine 5.0L V8, not automatic, load 2 ton, towing enabled
        Truck truck = new Truck(4, "Black", false, 2,
                                "5.0L V8", false,
                                "2 ton", true);

        // I understand: this prints the Bicycle object's string representation
        System.out.println(bicycle);

        // I understand: this prints the Car object's string representation
        System.out.println(car);

        // I understand: this prints the Truck object's string representation
        System.out.println(truck);

        // I understand: this prints a header for the detailed car info section
        System.out.println("\nCar Details Individually:");

        // I understand: this prints the car's color using the getter
        System.out.println("Color: " + car.getColor());

        // I understand: this prints the car's number of seats using the getter
        System.out.println("Number of Seats: " + car.getSeats());

        // I understand: this prints the car's engine size using the getter
        System.out.println("Engine Size: " + car.getEngine());

        // I understand: this prints whether the car is automatic using the getter
        System.out.println("Automatic: " + car.isAutomatic());

        // I understand: this prints whether the car has a sunroof using the hasSunRoof method
        System.out.println("Sun Roof: " + car.hasSunRoof());

        // I understand: this prints the car's storage capacity using the getter
        System.out.println("Storage: " + car.getStorage());
    }
}