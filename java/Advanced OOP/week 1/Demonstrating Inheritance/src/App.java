/*
 * Author: Amber Laawson
 * Date: 11/13/2025
 * Assignment: SDC330 Performance Assessment - Inheritance
 * Description: Main application to test all classes.
 */

// I understand: this defines the main application class
public class App {

    // I understand: this is the main entry point of the Java program
    public static void main(String[] args) {
        // this prints the required header line for the assignment
        System.out.println("Your Name - Week 1 Inheritance Performance Assessment\n");

        // reates a Vehicle instance similar to the first sample block
        Vehicle vehicle = new Vehicle(3, "Red", false, 2);

        // creates a Bicycle similar to the second sample block
        Bicycle bicycle = new Bicycle(2, "Blue", true, 1,
                                      12, 30.0, 18.0);

        // creates a Motorized vehicle similar to the third sample block
        Motorized motorized = new Motorized(4, "Orange", false, 2,
                                            "3.6L V6", true);

        // this creates a Car similar to the fourth sample block
        Car car = new Car(4, "Maroon", false, 5,
                          "2.4L 4-CYL", false,
                          true, "None");

        // I understand: this creates a Truck similar to the fifth sample block
        Truck truck = new Truck(6, "Black", true, 6,
                                "V8 Hemi", false,
                                "longbed, large capacity", true);

        // prints the Vehicle details using its toString
        System.out.println(vehicle);
        System.out.println();

        // this prints the Bicycle details using its toString
        System.out.println(bicycle);
        System.out.println();

        // prints the Motorized details using its toString
        System.out.println(motorized);
        System.out.println();

        //  prints the Car details using its toString
        System.out.println(car);
        System.out.println();

        // prints the Truck details using its toString
        System.out.println(truck);
        System.out.println();

        //  prints a final section with individual Car details
        System.out.println("Color: " + car.getColor());
        System.out.println("# of Seats: " + car.getSeats());
        System.out.println("Engine Size: " + car.getEngine());
        System.out.println("Automatic Transmission? " + car.isAutomatic());
        System.out.println("Has Sunroof? " + car.hasSunRoof());
        System.out.println("Storage: " + car.getStorage());
    }
}