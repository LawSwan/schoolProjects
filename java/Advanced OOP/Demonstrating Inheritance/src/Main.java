/*
 * Author: Your Name
 * Date: 11/13/2025
 * Assignment: SDC330 Performance Assessment - Inheritance
 * Description: Main application to test all classes.
 */

public class Main {
    public static void main(String[] args) {

        System.out.println("Your Name - Week 1 Inheritance Performance Assessment\n");

        Bicycle bicycle = new Bicycle(2, "Blue", false, 1,
                                      6, 28.5, 19.0);

        Car car = new Car(4, "Red", false, 5,
                          "2.5L V6", true,
                          true, "Small Trunk");

        Truck truck = new Truck(4, "Black", false, 2,
                                "5.0L V8", false,
                                "2 ton", true);

        System.out.println(bicycle);
        System.out.println(car);
        System.out.println(truck);

        // Required car details in specific order
        System.out.println("\nCar Details Individually:");
        System.out.println("Color: " + car.getColor());
        System.out.println("Number of Seats: " + car.getSeats());
        System.out.println("Engine Size: " + car.getEngine());
        System.out.println("Automatic: " + car.isAutomatic());
        System.out.println("Sun Roof: " + car.hasSunRoof());
        System.out.println("Storage: " + car.getStorage());
    }
}