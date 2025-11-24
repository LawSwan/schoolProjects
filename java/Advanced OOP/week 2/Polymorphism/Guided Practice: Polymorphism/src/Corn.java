/*******************************************************************
 * Name: Amber Lawson
 * Date: 17 November 2025
 * Assignment: SDC330 Week 2 GP – Polymorphism
 * Extends the Vegetable class. Override of toString() provided for
 * formatted output of class information. All properties are private
 * - getters and setters are provided for all properties. Constructor
 * sets all properties to provided values.
 */
// Corn.java

public class Corn extends Vegetable {

    private String variety;
    private String earsPerTray;

    public Corn(String servingSize,
                String plantingSeason,
                String harvestSeason,
                String variety,
                String earsPerTray) {

        // name is always "Corn"
        super("Corn", servingSize, plantingSeason, harvestSeason);

        this.variety = variety;
        this.earsPerTray = earsPerTray;
    }

    @Override
    public String toString() {
        return super.toString()
                + "\nVariety: " + variety
                + "\nEars per tray: " + earsPerTray;
    }
}