/*******************************************************************
 * Name: Amber Lawson
 * Date: 26 November 2025
 * Assignment: Car Inheritance and Composition Example
 * Description: Superclass representing a generic car.
 *******************************************************************/

public class Car {

    private String fuel;
    private String engine;

    protected Car(String fuel, String engine) {
        this.fuel = fuel;
        this.engine = engine;
    }

    public String getFuel() {
        return fuel;
    }

    protected void setFuel(String fuel) {
        this.fuel = fuel;
    }

    public String getEngine() {
        return engine;
    }

    protected void setEngine(String engine) {
        this.engine = engine;
    }

    @Override
    public String toString() {
        return "Fuel Type: " + fuel + "\nEngine Type: " + engine;
    }
}