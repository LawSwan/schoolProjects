/*
 * Author: Amber Lawson
 * Date: 11/14/2025
 * Assignment: SDC330 Performance Assessment - Composition
 * Description: Represents engine information for an automobile.
 */

public class Engine {
    private int cylinders;
    private String gasType;
    private boolean fuelInjected;

    public Engine(int cylinders, String gasType, boolean fuelInjected) {
        this.cylinders = cylinders;
        this.gasType = gasType;
        this.fuelInjected = fuelInjected;
    }

    public int getCylinders() {
        return cylinders;
    }

    public void setCylinders(int cylinders) {
        this.cylinders = cylinders;
    }

    public String getGasType() {
        return gasType;
    }

    public void setGasType(String gasType) {
        this.gasType = gasType;
    }

    public boolean isFuelInjected() {
        return fuelInjected;
    }

    public void setFuelInjected(boolean fuelInjected) {
        this.fuelInjected = fuelInjected;
    }

    @Override
    public String toString() {
        return "Cylinders: " + cylinders + "\n"
             + "Approved Gas Type: " + gasType + "\n"
             + "Fuel Injected? " + fuelInjected;
    }
}