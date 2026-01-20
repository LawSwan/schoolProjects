/*******************************************************************
 * Name: Amber Lawson
 * Date: 11 December 2025
 * Assignment: SDC330 Final Practical Exam
 * Description: Base abstract Building class.
 * Concepts: Abstract Classes, Use of Constructors, Use of Access Specifiers
 ******************************************************************/

public abstract class Building {

    // Access Specifier and Encapsulation: private field
    private String buildingType;

    // Constructor and Access Specifier: protected so only subclasses can call it
    protected Building(String type) {
        this.buildingType = type;
    }

    public String getBuildingType() {
        return buildingType;
    }

    // This method is abstract so subclasses must supply the room count
    // Abstract Classes and Polymorphism are demonstrated here
    public abstract int getRooms();

    @Override
    public String toString() {
        // Polymorphism: calls getRooms implemented in subclasses
        return "This is a " + getRooms() + " room " + buildingType + ".";
    }
}