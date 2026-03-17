/*******************************************************************
 * Name: Amber Lawson
 * Date: 20 November 2025
 * Assignment: SDC330 Performance Assessment – Polymorphism
 * Description: SplitLevel house that always has two floors and an
 *              entry level living space flag.
 ******************************************************************/

public class SplitLevel extends House {

    private boolean entryLevelLivingSpace;

    // NumFloors is always 2 for a split level
    public SplitLevel(String streetAddress, String exteriorMaterial,
                      String color, int numRooms, boolean entryLevelLivingSpace) {
        super(streetAddress, 2, exteriorMaterial, color, numRooms);
        this.entryLevelLivingSpace = entryLevelLivingSpace;
    }

    // Getter and setter
    public boolean hasEntryLevelLivingSpace() {
        return entryLevelLivingSpace;
    }

    public void setEntryLevelLivingSpace(boolean entryLevelLivingSpace) {
        this.entryLevelLivingSpace = entryLevelLivingSpace;
    }

    @Override
    public String toString() {
        return "Split Level House\n"
             + "Address: " + getStreetAddress() + "\n"
             + "Floors: " + getNumFloors() + "\n"
             + "Exterior: " + getExteriorMaterial() + "\n"
             + "Color: " + getColor() + "\n"
             + "Rooms: " + getNumRooms() + "\n"
             + "Entry Level Living Space: " + entryLevelLivingSpace;
    }
}