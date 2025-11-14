/*
 * Author: Your Name
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
        // using superclass get methods instead of super.toString()
        return "Motorized [Wheels=" + getWheels() +
               ", Color=" + getColor() +
               ", Moving=" + isMoving() +
               ", Seats=" + getSeats() +
               ", Engine=" + engine +
               ", Automatic=" + automatic + "]";
    }
}