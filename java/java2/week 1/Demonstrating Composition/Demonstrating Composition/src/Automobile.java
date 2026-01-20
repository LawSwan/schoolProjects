/*
 * Author: Amber Lawson
 * Date: 11/14/2025
 * Assignment: SDC330 Performance Assessment - Composition
 * Description: Represents an automobile composed of an engine and tires.
 */

import java.util.ArrayList;
import java.util.List;

public class Automobile {
    private String make;
    private String model;
    private String color;
    private String bodyStyle;
    private Engine engineInfo;
    private List<Tire> tires;

    public Automobile(String make, String model, String color,
                      String bodyStyle, Engine engineInfo) {
        this.make = make;
        this.model = model;
        this.color = color;
        this.bodyStyle = bodyStyle;
        this.engineInfo = engineInfo;
        this.tires = new ArrayList<>();   // composition: collection of Tire
    }

    public String getMake() {
        return make;
    }

    public void setMake(String make) {
        this.make = make;
    }

    public String getModel() {
        return model;
    }

    public void setModel(String model) {
        this.model = model;
    }

    public String getColor() {
        return color;
    }

    public void setColor(String color) {
        this.color = color;
    }

    public String getBodyStyle() {
        return bodyStyle;
    }

    public void setBodyStyle(String bodyStyle) {
        this.bodyStyle = bodyStyle;
    }

    public Engine getEngineInfo() {
        return engineInfo;
    }

    public void setEngineInfo(Engine engineInfo) {
        this.engineInfo = engineInfo;
    }

    public List<Tire> getTires() {
        return tires;
    }

    // addTire(Tire) - adds an existing Tire object
    public void addTire(Tire tire) {
        tires.add(tire);
    }

    // addTire(String, String, int, int, String) - creates and adds a Tire
    public void addTire(String manufacturer, String size,
                        int maxPressure, int minPressure, String type) {
        Tire tire = new Tire(manufacturer, size, maxPressure, minPressure, type);
        tires.add(tire);
    }

    // getBasicInfo() - summary info required by the assignment
    public String getBasicInfo() {
        return "Make: " + make + "\n"
             + "Model: " + model + "\n"
             + "Color: " + color + "\n"
             + "Engine Cylinder Count: " + engineInfo.getCylinders() + "\n"
             + "Fuel Injected? " + engineInfo.isFuelInjected() + "\n"
             + "Number of Tires: " + tires.size();
    }

    @Override
    public String toString() {
        StringBuilder sb = new StringBuilder();

        sb.append("Make: ").append(make).append("\n");
        sb.append("Model: ").append(model).append("\n");
        sb.append("Color: ").append(color).append("\n");
        sb.append("Body Style: ").append(bodyStyle).append("\n\n");

        sb.append("Engine Information:\n");
        sb.append(engineInfo.toString()).append("\n\n");

        sb.append("Tire Information (").append(tires.size()).append(" tires):\n");
        for (int i = 0; i < tires.size(); i++) {
            sb.append("Tire #").append(i + 1).append(":\n");
            sb.append(tires.get(i).toString()).append("\n\n");
        }

        return sb.toString();
    }
}