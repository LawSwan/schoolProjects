/*******************************************************************
 * Name: Amber Lawson
 * Date: 20 November 2025
 * Assignment: SDC330 Performance Assessment – Interface
 * Description: Main application demonstrating interface implementation
 *              and polymorphism using Vehicle, Car, and CargoTruck.
 ******************************************************************/

import java.util.ArrayList;

public class App {

    public static void main(String[] args) {

        System.out.println("Amber Lawson - Week 2 Interface Performance Assessment\n");

        // Create instances
        Car car1 = new Car("Honda", "Civic", 2020, 4);
        Car car2 = new Car("Ford", "Mustang", 2023, 2);

        CargoTruck truck1 = new CargoTruck("Volvo", "HaulerX", 2019, 18000);
        CargoTruck truck2 = new CargoTruck("Mercedes", "Actros", 2022, 25000);

        // Start all vehicles
        car1.start();
        car2.start();
        truck1.start();
        truck2.start();

        // Stop ONE vehicle
        car2.stop();

        // Drive all 4 with different destinations
        car1.drive("New York");
        car2.drive("Los Angeles");
        truck1.drive("Houston");
        truck2.drive("Chicago");

        // ArrayList<Vehicle>
        ArrayList<Vehicle> vehicles = new ArrayList<>();
        vehicles.add(car1);
        vehicles.add(car2);
        vehicles.add(truck1);
        vehicles.add(truck2);

        // Print list
        System.out.println("\n===== Vehicle List (ArrayList<Vehicle>) =====");
        for (Vehicle v : vehicles) {
            printVehicle(v); // polymorphism
            System.out.println();
        }

        // Print individually
        System.out.println("===== Car 1 Details =====");
        printVehicle(car1);
        System.out.println();

        System.out.println("===== Car 2 Details =====");
        printVehicle(car2);
        System.out.println();

        System.out.println("===== Cargo Truck 1 Details =====");
        printVehicle(truck1);
        System.out.println();

        System.out.println("===== Cargo Truck 2 Details =====");
        printVehicle(truck2);
        System.out.println();
    }

    // Required private print method
    private static void printVehicle(Vehicle vehicle) {
        System.out.println(vehicle.toString());
    }
}