/*******************************************************************
 * Name: Amber Lawson
 * Date: 20 November 2025
 * Assignment: SDC330 Performance Assessment – Interface
 * Description: Car class implementing Vehicle interface and 
 *              representing standard passenger vehicles.
 ******************************************************************/

public class Car implements Vehicle {

    private String make;
    private String model;
    private int year;
    private int numDoors;
    private String lastDestination = "None";

    public Car(String make, String model, int year, int numDoors) {
        this.make = make;
        this.model = model;
        this.year = year;
        this.numDoors = numDoors;
    }

    @Override
    public void start() {
        System.out.println(make + " " + model + " started.");
    }

    @Override
    public void stop() {
        System.out.println(make + " " + model + " stopped.");
    }

    @Override
    public void drive(String destination) {
        this.lastDestination = destination;
        System.out.println(make + " " + model + " driving to " + destination + ".");
    }

    @Override
    public String toString() {
        return "Car\n"
             + "Make: " + make + "\n"
             + "Model: " + model + "\n"
             + "Year: " + year + "\n"
             + "Doors: " + numDoors + "\n"
             + "Last Destination: " + lastDestination;
    }
}
