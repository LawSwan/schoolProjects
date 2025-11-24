/*******************************************************************
* Name: Amber Lawson
* Date: November 24, 2025
* Assignment: SDC330 Week 3 GP – Abstraction
*
* This class is the ultimate super class in this example and provides
* abstract methods for getting a shape's area and area formula. The
* class also provides a constructor for use by child classes and
* provides an override of toString() for formatted shape information.
*/

public abstract class Shape {
private String FillColor;
private String LineColor;
public Shape(String fillColor, String lineColor) {
FillColor = fillColor;
LineColor = lineColor;
}
public abstract String areaFormula();
public abstract double area();
@Override
public String toString() {
return
"Shape's Properties:\n" +
" Type: " + getClass().getName() + "\n" +
" Area Formula: " + areaFormula() + "\n" +
" Area: " + String.format("%.3f", area()) + "\n" +
" Fill Color: " + FillColor + "\n" +
" Line Color: " + LineColor + "\n";
}
}