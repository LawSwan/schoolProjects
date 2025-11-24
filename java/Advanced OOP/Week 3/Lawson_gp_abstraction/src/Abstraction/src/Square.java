/*******************************************************************
* Name: Amber Lawson
* Date: November 24, 2025
* Assignment: SDC330 Week 3 GP – Abstraction
*
* This class extends the Quadrilateral class and provides a concrete
* implementation of the areaFormula method. Note that as a Square
* only needs one length only one length is required in the
* constructor and is passed as both lengths to the super constructor.
*/
public class Square extends Quadrilateral {
public Square(String fillColor, String lineColor, double length) {
super(fillColor, lineColor, length, length);
}
public String areaFormula() {
return "Length squared (l2).";
}
}