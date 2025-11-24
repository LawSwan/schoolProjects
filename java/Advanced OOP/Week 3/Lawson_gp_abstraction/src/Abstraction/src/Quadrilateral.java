/*******************************************************************
* Name: Amber Lawson
* Date: November 24, 2025
* Assignment: SDC330 Week 3 GP – Abstraction
*
* This class extends the Shape class and is also an abstract super
* class for specific types of Quadrilaterals. The areaFormula methods
* is left abstract because this class will not be able to provide
* that specific information. The class also provides an
* implementation of the area method as many quadrilaterals calculate
* area as a simple multiplication of two provided measurements (e.g.
* square, rectangle, parallellogram). Other classes can override
* the area method to provide their own functionality.
*/
public abstract class Quadrilateral extends Shape {
private double Length1;
private double Length2;
public Quadrilateral(String fillColor, String lineColor,
double length1, double length2) {
super(fillColor, lineColor);
Length1 = length1;
Length2 = length2;
}
public abstract String areaFormula();
public double area() {
return Length1 * Length2;
}
}