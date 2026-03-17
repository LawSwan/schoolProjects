/*******************************************************************
 * Name: Amber Lawson
 * Date: 20 November 2025
 * Assignment: SDC330 Performance Assessment – Polymorphism
 * Description: House class that extends Building and adds details
 *              specific to a house.
 ******************************************************************/

public class House extends Building {

    private String color;
    private int numRooms;

    public House(String streetAddress, int numFloors, String exteriorMaterial,
                 String color, int numRooms) {
        super(streetAddress, numFloors, exteriorMaterial);
        this.color = color;
        this.numRooms = numRooms;
    }

    // Getters and setters
    public String getColor() {
        return color;
    }

    public void setColor(String color) {
        this.color = color;
    }

    public int getNumRooms() {
        return numRooms;
    }

    public void setNumRooms(int numRooms) {
        this.numRooms = numRooms;
    }

    @Override
    public String toString() {
        return "House\n"
             + "Address: " + getStreetAddress() + "\n"
             + "Floors: " + getNumFloors() + "\n"
             + "Exterior: " + getExteriorMaterial() + "\n"
             + "Color: " + color + "\n"
             + "Rooms: " + numRooms;
    }
}