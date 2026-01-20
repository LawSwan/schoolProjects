/*******************************************************************
 * Name: Amber Lawson
 * Date: 11 December 2025
 * Assignment: SDC330 Final Practical Exam
 * Description: House class that extends Building and has a Door and Kitchen.
 * Concepts: Inheritance, Composition, Polymorphism, Constructors
 ******************************************************************/

// Inheritance: House extends the abstract Building class
public class House extends Building {

    // Encapsulation with private fields
    private int numRooms;
    private Door frontDoor;      // Composition: House has a Door
    private Kitchen mainKitchen; // Composition: House has a Kitchen

    // Note: House constructor does not take a type parameter
    // "House" is passed directly to the super class constructor
    public House(int numRooms, Door frontDoor, Kitchen mainKitchen) {
        super("House"); // Inheritance and Constructors
        this.numRooms = numRooms;
        this.frontDoor = frontDoor;
        this.mainKitchen = mainKitchen;
    }

    public Door getFrontDoor() {
        return frontDoor;
    }

    public Kitchen getMainKitchen() {
        return mainKitchen;
    }

    @Override
    public int getRooms() {
        return numRooms;
    }

    @Override
    public String toString() {
        // Polymorphism: this overrides Building.toString
        StringBuilder sb = new StringBuilder();
        sb.append("This is a ").append(getRooms())
          .append(" room ").append(getBuildingType()).append(".\n");
        sb.append("The door is ").append(frontDoor.toString()).append(".\n");
        sb.append("The kitchen is a ").append(mainKitchen.toString());
        return sb.toString();
    }
}