/*******************************************************************
* Name: Amber Lawson
* Date: November 24, 2025
* Assignment: SDC330 Week 3 GP – Abstraction
*
* This class extends the Quadrilateral class and provides a concrete
* implementation of the areaFormula method.
*/
public class Rectangle extends Quadrilateral {
public Rectangle(String fillColor, String lineColor,
double length1, double length2) {
super(fillColor, lineColor, length1, length2);
}
public String areaFormula() {
return "Length times Width (l × w).";
}
}