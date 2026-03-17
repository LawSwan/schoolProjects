/*******************************************************************
* Name: Amber Lawson
* Date: November 24, 2025
* Assignment: SDC330 Week 3 GP – Abstraction
*
* This class extends the Quadrilateral class and provides a concrete
* implementation of the areaFormula method and an override of the
* area method. The area method is overridden as the area of a
* rhombus is (diag1 * diag2)/2. The suer area method is called and
* divided by 2 to achieve this.
*/
public class Rhombus extends Quadrilateral {
public Rhombus(String fillColor, String lineColor, double d1,
double d2) {
super(fillColor, lineColor, d1, d2);
}
public String areaFormula() {
return "One-half Diagonal 1 times Diagonal 2 (d1 × d2)/2.";
}
@Override
public double area() {
return super.area()/2;
}
}