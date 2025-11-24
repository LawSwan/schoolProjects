/*******************************************************************
* Name: Amber Lawson
* Date: 17 November 2025    
* Assignment: SDC330 Week 2 GP – Polymorphism
*
* Extends the Food class. Override of toString() provided for
* formatted output of class information. All properties are private
* - getters and setters are provided for all properties. Constructor
* sets all properties to provided values.
*/
public class Meat extends Food {
private String Source;
public Meat(String name, String servingSize, String source) {
super(name, servingSize);
Source = source;
}
public String getSource() {
return Source;
}
public void setSource(String source) {
Source = source;
}
@Override
public String toString() {
return String.format(
"%sSource description: %s%n",
super.toString(), Source);
} 
}

