/*
 * Author: Amber Lawson
 * Date: 11/13/2025
 * Assignment: SDC330 Performance Assessment - Inheritance
 * Description: Main application to test all classes.
 */

// I understand: this imports the classes in the same package (if needed)
// (If not using packages, this line is unnecessary.)

public class App {

    // I understand: this is the main entry point of the program
    public static void main(String[] args) {

        // I understand: this prints the required first line of output
        System.out.println("Your Name - Week 1 Inheritance Performance Assessment\n");

        // This is creating a Bicycle object with wheels, color, moving, seats, gears, seatHeight, tireSize
        Bicycle bicycle = new Bicycle(2, "Blue", false, 1,
                                      6, 28.5, 19.0);

        // This is creating a Car object with wheels, color, moving, seats, engine, automatic, sunroof, storage
        Car car = new Car(4, "Red", false, 5,
                          "2.5L V6", true,
                          true, "Small Trunk");

        // This is creating a Truck object with wheels, color, moving, seats, engine, automatic, load, towing
        Truck truck = new Truck(4, "Black", false, 2,
                                "5.0L V8", false,
                                "2 ton", true);

        // I understand: printing the Bicycle object's formatted details
        System.out.println(bicycle);

        // This is printing the Car object's formatted details
        System.out.println(car);

        // This is printing the Truck object's formatted details
        System.out.println(truck);

        // This is printing a section header for individual car details
        System.out.println("\nCar Details Individually:");

        // This is printing just the car's color
        System.out.println("Color: " + car.getColor());

        // This is printing just the car's number of seats
        System.out.println("Number of Seats: " + car.getSeats());

        // This is printing just the engine size
        System.out.println("Engine Size: " + car.getEngine());

        // This is printing whether the car is automatic
        System.out.println("Automatic: " + car.isAutomatic());

        // This is printing whether the car has a sunroof
        System.out.println("Sun Roof: " + car.hasSunRoof());

        // This is printing the car's storage capacity
        System.out.println("Storage: " + car.getStorage());
    }
}