/*******************************************************************
 * Name: Amber Lawson
 * Date: 20 November 2025
 * Assignment: SDC330 Performance Assessment – Polymorphism
 * Description: Base Building class with common building attributes.
 ******************************************************************/

public class Building {

    private String streetAddress;
    private int numFloors;
    private String exteriorMaterial;

    public Building(String streetAddress, int numFloors, String exteriorMaterial) {
        this.streetAddress = streetAddress;
        this.numFloors = numFloors;
        this.exteriorMaterial = exteriorMaterial;
    }

    // Getters and setters
    public String getStreetAddress() {
        return streetAddress;
    }

    public void setStreetAddress(String streetAddress) {
        this.streetAddress = streetAddress;
    }

    public int getNumFloors() {
        return numFloors;
    }

    public void setNumFloors(int numFloors) {
        this.numFloors = numFloors;
    }

    public String getExteriorMaterial() {
        return exteriorMaterial;
    }

    public void setExteriorMaterial(String exteriorMaterial) {
        this.exteriorMaterial = exteriorMaterial;
    }

    @Override
    public String toString() {
        return "Building\n"
             + "Address: " + streetAddress + "\n"
             + "Floors: " + numFloors + "\n"
             + "Exterior: " + exteriorMaterial;
    }
}