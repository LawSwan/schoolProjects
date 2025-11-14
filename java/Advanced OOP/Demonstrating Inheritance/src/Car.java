/*
 * Author: Your Name
 * Date: 11/13/2025
 * Assignment: SDC330 Performance Assessment - Inheritance
 * Description: Represents a car with sunroof and storage.
 */

public class Car extends Motorized {
    private boolean sunRoof;
    private String storage;

    // I understand: this constructor calls Motorized's constructor and initializes Car-specific fields
    public Car(int wheels, String color, boolean moving, int seats,
               String engine, boolean automatic,
               boolean sunRoof, String storage) {
        super(wheels, color, moving, seats, engine, automatic);
        this.sunRoof = sunRoof;
        this.storage = storage;
    }

    public boolean hasSunRoof() { return sunRoof; }
    public void setSunRoof(boolean sunRoof) { this.sunRoof = sunRoof; }

    public String getStorage() { return storage; }

    // I understand: this setter updates the car's storage capacity value
    public void setStorage(String storage) { this.storage = storage; }

    @Override
    public String toString() {
        return "Car [Wheels=" + getWheels() +
               ", Color=" + getColor() +
               ", Moving=" + isMoving() +
               ", Seats=" + getSeats() +
               ", Engine=" + getEngine() +
               ", Automatic=" + isAutomatic() +
               ", SunRoof=" + sunRoof +
               ", Storage=" + storage + "]";
    }
}