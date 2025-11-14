/*
 * Author: Your Name
 * Date: 11/13/2025
 * Assignment: SDC330 Performance Assessment - Inheritance
 * Description: Represents a bicycle with gear and size details.
 */

public class Bicycle extends Vehicle {
    private int gears;
    private double seatHeight;
    private double tireSize;

    public Bicycle(int wheels, String color, boolean moving, int seats,
                   int gears, double seatHeight, double tireSize) {
        super(wheels, color, moving, seats);
        this.gears = gears;
        this.seatHeight = seatHeight;
        this.tireSize = tireSize;
    }

    public int getGears() { return gears; }
    public void setGears(int gears) { this.gears = gears; }

    public double getSeatHeight() { return seatHeight; }
    public void setSeatHeight(double seatHeight) { this.seatHeight = seatHeight; }

    public double getTireSize() { return tireSize; }
    public void setTireSize(double tireSize) { this.tireSize = tireSize; }

    @Override
    public String toString() {
        return "Bicycle [Wheels=" + getWheels() +
               ", Color=" + getColor() +
               ", Moving=" + isMoving() +
               ", Seats=" + getSeats() +
               ", Gears=" + gears +
               ", SeatHeight=" + seatHeight +
               ", TireSize=" + tireSize + "]";
    }
}