/*
 * Author: Amber Laawson
 * Date: 11/13/2025
 * Assignment: SDC330 Performance Assessment - Inheritance
 * Description: Motorized vehicles with engine and transmission attributes.
 */

public class Motorized extends Vehicle {
    private String engine;
    private boolean automatic;

    public Motorized(int wheels, String color, boolean moving, int seats,
                     String engine, boolean automatic) {
        super(wheels, color, moving, seats);
        this.engine = engine;
        this.automatic = automatic;
    }

    public String getEngine() { return engine; }
    public void setEngine(String engine) { this.engine = engine; }

    public boolean isAutomatic() { return automatic; }
    public void setAutomatic(boolean automatic) { this.automatic = automatic; }

    @Override
    public String toString() {
        // Using superclass getters instead of super.toString()
        return "Color: " + getColor() + "\n"
             + "Wheel Count: " + getWheels() + "\n"
             + "Seat Count: " + getSeats() + "\n"
             + "Currently Moving: " + isMoving() + "\n"
             + "Engine: " + engine + "\n"
             + "Automatic Transmission? " + automatic;
    }
}