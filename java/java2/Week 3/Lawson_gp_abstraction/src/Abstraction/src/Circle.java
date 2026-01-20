/*******************************************************************
* Name: Amber Lawson
* Date: November 24, 2025
* Assignment: SDC330 Week 3 GP – Abstraction
*
* This class extends the Shape class and provides concrete
* implementations of the areaFormula and area methods.
*/
public class Circle extends Shape {
private double Radius;
public Circle(String fillColor, String lineColor, double radius) {
super(fillColor, lineColor);
Radius = radius;
}
public String areaFormula() {
return "Pi times the radius squared (π × r2)";
}
public double area() {
return Math.PI * (Radius * Radius);
}
}