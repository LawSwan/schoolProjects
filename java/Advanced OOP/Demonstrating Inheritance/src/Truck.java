/*
 * Author: Your Name
 * Date: 11/13/2025
 * Assignment: SDC330 Performance Assessment - Inheritance
 * Description: Represents a truck with load capacity and towing ability.
 */

public class Truck extends Motorized {
    private String load;
    private boolean towing;

    public Truck(int wheels, String color, boolean moving, int seats,
                 String engine, boolean automatic,
                 String load, boolean towing) {
        super(wheels, color, moving, seats, engine, automatic);
        this.load = load;
        this.towing = towing;
    }

    public String getLoad() { return load; }
    public void setLoad(String load) { this.load = load; }

    public boolean isTowingEnabled() { return towing; }
    public void setTowingEnabled(boolean towing) { this.towing = towing; }

    @Override
    public String toString() {
        return "Truck [Wheels=" + getWheels() +
               ", Color=" + getColor() +
               ", Moving=" + isMoving() +
               ", Seats=" + getSeats() +
               ", Engine=" + getEngine() +
               ", Automatic=" + isAutomatic() +
               ", Load=" + load +
               ", Towing=" + towing + "]";
    }
}