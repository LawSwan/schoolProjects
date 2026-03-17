/*
 * Author: Amber Lawson
 * Date: 11/14/2025
 * Assignment: SDC330 Performance Assessment - Composition
 * Description: Represents a tire used on an automobile.
 */

public class Tire {
    private String manufacturer;
    private String size;
    private int maxPressure;
    private int minPressure;
    private String type;

    public Tire(String manufacturer, String size,
                int maxPressure, int minPressure, String type) {
        this.manufacturer = manufacturer;
        this.size = size;
        this.maxPressure = maxPressure;
        this.minPressure = minPressure;
        this.type = type;
    }

    public String getManufacturer() {
        return manufacturer;
    }

    public void setManufacturer(String manufacturer) {
        this.manufacturer = manufacturer;
    }

    public String getSize() {
        return size;
    }

    public void setSize(String size) {
        this.size = size;
    }

    public int getMaxPressure() {
        return maxPressure;
    }

    public void setMaxPressure(int maxPressure) {
        this.maxPressure = maxPressure;
    }

    public int getMinPressure() {
        return minPressure;
    }

    public void setMinPressure(int minPressure) {
        this.minPressure = minPressure;
    }

    public String getType() {
        return type;
    }

    public void setType(String type) {
        this.type = type;
    }

    @Override
    public String toString() {
        return "Manufacturer: " + manufacturer + "\n"
             + "Tire Size: " + size + "\n"
             + "Max Pressure: " + maxPressure + "\n"
             + "Min Pressure: " + minPressure + "\n"
             + "Type: " + type;
    }
}