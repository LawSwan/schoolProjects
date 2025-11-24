/*******************************************************************
* Name: Amber J. Lawson
* Date: 17 November 2025
* Assignment: SDC330 Week 2 GP – Polymorphism
*
* The ultimate super class in this example. Override of toString()
* provided for formatted output of class information. All properties
* are private - getters and setters are provided for all properties.
* Constructor sets all properties to provided values.
*/
public class Food {
private String Name;
private String ServingSize;
public Food(String name, String servingSize) {
Name = name;
ServingSize = servingSize;
}
public String getName() {
return Name;
}

public void setName(String name) {
Name = name;
}
public String getServingSize() {
return ServingSize;
}
public void setServingSize(String servingSize) {
ServingSize = servingSize;
}
@Override
public String toString() {
return String.format(
"Class Name (Object Type): %s%nFood Name: %s%nServing Size: %s%n",
this.getClass().getName(), Name, ServingSize);
}
}