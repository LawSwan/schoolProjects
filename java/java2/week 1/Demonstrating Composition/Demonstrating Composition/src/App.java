/*
 * Author: Amber Lawson
 * Date: 11/14/2025
 * Assignment: SDC330 Performance Assessment - Composition
 * Description: Main application to test the Automobile composition classes.
 */

public class App {
    public static void main(String[] args) {

        System.out.println("Your Name - Week 1 Composition Performance Assessment\n");

        // Create engine objects
        Engine engine1 = new Engine(6, "Unleaded 87", true);
        Engine engine2 = new Engine(4, "Premium 93", false);

        // Create two Automobile instances
        Automobile car1 = new Automobile("Ford", "Explorer", "Blue",
                                         "SUV", engine1);

        Automobile car2 = new Automobile("Toyota", "Supra", "Red",
                                         "Coupe", engine2);

        // Add tires to car1 (mix of object + parameter overload)
        car1.addTire(new Tire("Goodyear", "235/60R18", 44, 30, "All Season"));
        car1.addTire(new Tire("Goodyear", "235/60R18", 44, 30, "All Season"));
        car1.addTire("Goodyear", "235/60R18", 44, 30, "All Season");
        car1.addTire("Goodyear", "235/60R18", 44, 30, "All Season");

        // Add tires to car2
        car2.addTire(new Tire("Pirelli", "255/35R19", 51, 32, "Performance Summer"));
        car2.addTire(new Tire("Pirelli", "255/35R19", 51, 32, "Performance Summer"));
        car2.addTire("Pirelli", "255/35R19", 51, 32, "Performance Summer");
        car2.addTire("Pirelli", "255/35R19", 51, 32, "Performance Summer");

        // Print one instance's properties using toString()
        System.out.println("=== Full Automobile Info (car1) ===");
        System.out.println(car1.toString());

        // Print one instance's properties using getBasicInfo()
        System.out.println("=== Basic Automobile Info (car2) ===");
        System.out.println(car2.getBasicInfo());
        System.out.println();

        // Print detailed info for one instance (car2) using getters
        System.out.println("=== Detailed Info for car2 Using Get Methods ===");
        System.out.println("Make: " + car2.getMake());
        System.out.println("Model: " + car2.getModel());
        System.out.println("Color: " + car2.getColor());
        System.out.println("Body Style: " + car2.getBodyStyle());
        System.out.println();

        System.out.println("Engine Information:");
        System.out.println("Number of Cylinders: " + car2.getEngineInfo().getCylinders());
        System.out.println("Approved Gas Type: " + car2.getEngineInfo().getGasType());
        System.out.println("Fuel Injected? " + car2.getEngineInfo().isFuelInjected());
        System.out.println();

        System.out.println("Tire Information:");
        int tireIndex = 1;
        for (Tire t : car2.getTires()) {
            System.out.println("Tire #" + tireIndex + ":");
            System.out.println("  Manufacturer: " + t.getManufacturer());
            System.out.println("  Tire Size: " + t.getSize());
            System.out.println("  Max Pressure: " + t.getMaxPressure());
            System.out.println("  Min Pressure: " + t.getMinPressure());
            System.out.println("  Type: " + t.getType());
            System.out.println();
            tireIndex++;
        }
    }
}