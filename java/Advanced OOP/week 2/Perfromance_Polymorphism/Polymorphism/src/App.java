/*******************************************************************
 * Name: Amber Lawson
 * Date: 20 November 2025
 * Assignment: SDC330 Performance Assessment – Polymorphism
 * Description: Main application class for the Building hierarchy.
 *              Demonstrates polymorphism using Building references.
 ******************************************************************/

import java.util.ArrayList;

public class App {

    public static void main(String[] args) {

        System.out.println("Amber Lawson - Week 2 Polymorphism Performance Assessment\n");

        // Create instances with sample data
        Building b1 = new Building("123 Main St", 3, "Brick");
        Condominium c1 = new Condominium("200 Ocean Blvd", 12, "Concrete", 48);
        House h1 = new House("45 Oak Lane", 2, "Vinyl", "Blue", 7);
        SplitLevel s1 = new SplitLevel("10 Maple Court", "Stone", "Gray", 6, true);
        SplitLevel s2 = new SplitLevel("88 Cedar Way", "Brick", "White", 5, false);

        // Create ArrayList of type Building and add all instances
        ArrayList<Building> allBuildings = new ArrayList<>();
        allBuildings.add(b1);
        allBuildings.add(c1);
        allBuildings.add(h1);
        allBuildings.add(s1);
        allBuildings.add(s2);

        // Create ArrayList of type House and add only House and SplitLevel
        ArrayList<House> houses = new ArrayList<>();
        houses.add(h1);
        houses.add(s1);
        houses.add(s2);

        System.out.println("===== All Buildings (ArrayList<Building>) =====");
        for (Building b : allBuildings) {
            printBuilding(b);              // polymorphism: calls correct toString
            System.out.println();
        }

        System.out.println("===== Houses and Split Levels (ArrayList<House>) =====");
        for (House h : houses) {
            printBuilding(h);              // polymorphism again
            System.out.println();
        }
    }

    // Private helper method required by the assignment
    private static void printBuilding(Building building) {
        System.out.println(building.toString());
    }
}