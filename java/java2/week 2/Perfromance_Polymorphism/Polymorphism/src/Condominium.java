/*******************************************************************
 * Name: Amber Lawson
 * Date: 20 November 2025
 * Assignment: SDC330 Performance Assessment – Polymorphism
 * Description: Condominium class that extends Building and adds
 *              unit count.
 ******************************************************************/

public class Condominium extends Building {

    private int numUnits;

    public Condominium(String streetAddress, int numFloors, String exteriorMaterial,
                       int numUnits) {
        super(streetAddress, numFloors, exteriorMaterial);
        this.numUnits = numUnits;
    }

    // Getters and setters
    public int getNumUnits() {
        return numUnits;
    }

    public void setNumUnits(int numUnits) {
        this.numUnits = numUnits;
    }

    @Override
    public String toString() {
        return "Condominium\n"
             + "Address: " + getStreetAddress() + "\n"
             + "Floors: " + getNumFloors() + "\n"
             + "Exterior: " + getExteriorMaterial() + "\n"
             + "Units: " + numUnits;
    }
}