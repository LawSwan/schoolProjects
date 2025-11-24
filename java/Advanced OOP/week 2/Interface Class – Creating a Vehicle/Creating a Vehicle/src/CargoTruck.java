/*******************************************************************
 * Name: Amber Lawson
 * Date: 20 November 2025
 * Assignment: SDC330 Performance Assessment – Interface
 * Description: CargoTruck class implementing Vehicle interface and 
 *              representing heavy transport vehicles.
 ******************************************************************/

public class CargoTruck implements Vehicle {

    private String make;
    private String model;
    private int year;
    private int cargoCapacity; // in pounds
    private String lastDestination = "None";

    public CargoTruck(String make, String model, int year, int cargoCapacity) {
        this.make = make;
        this.model = model;
        this.year = year;
        this.cargoCapacity = cargoCapacity;
    }

    @Override
    public void start() {
        System.out.println(make + " " + model + " (Truck) started.");
    }

    @Override
    public void stop() {
        System.out.println(make + " " + model + " (Truck) stopped.");
    }

    @Override
    public void drive(String destination) {
        this.lastDestination = destination;
        System.out.println(make + " " + model + " hauling cargo to " + destination + ".");
    }

    @Override
    public String toString() {
        return "Cargo Truck\n"
             + "Make: " + make + "\n"
             + "Model: " + model + "\n"
             + "Year: " + year + "\n"
             + "Cargo Capacity: " + cargoCapacity + " lbs\n"
             + "Last Destination: " + lastDestination;
    }
}