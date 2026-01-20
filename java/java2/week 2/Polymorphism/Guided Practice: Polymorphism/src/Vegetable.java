/*******************************************************************
* Name: Amber Lawson
* Date:
* Assignment: SDC330 Week 2 GP – Polymorphism
*
* Extends the Food class and is the super class for Corn. Override
* of toString() provided for formatted output of class information.
* All properties are private - getters and setters are provided for
* all properties. Constructor sets all properties to provided
* values.
*/
public class Vegetable extends Food {
private String PlantingSeason;
private String HarvestSeason;
public Vegetable(String name, String servingSize,
String plantingSeason, String harvestSeason) {
super(name, servingSize);
PlantingSeason = plantingSeason;
HarvestSeason = harvestSeason;
}
public String getPlantingSeason() {
return PlantingSeason;
}
public void setPlantingSeason(String plantingSeason) {
PlantingSeason = plantingSeason;
}
public String getHarvestSeason() {
return HarvestSeason;
}
public void setHarvestSeason(String harvestSeason) {
HarvestSeason = harvestSeason;
}
@Override

public String toString() {
return String.format(
"%sPlanting Time: %s%nHarvest Time: %s%n",
super.toString(), PlantingSeason, HarvestSeason);
}
}   

