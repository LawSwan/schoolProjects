//*******************************************************
//   Name: Amber Lawson
//  Date: jULY 21, 2025 
//  Assignment: CIS218 Week 5 GP – First Inheritance
 
public class Rectangle extends Shape {

    // rectangle-specific properties
    private int length;
    private int width;

    // Call superclass constructor first, then set unique fields
    public Rectangle(String color, int length, int width) {
        super(color);       // passes color to Shape
        this.length = length;
        this.width  = width;
    }

    // getters & setters for subclass fields
    public int  getLength()          { return length; }
    public void setLength(int length){ this.length = length; }

    public int  getWidth()           { return width; }
    public void setWidth(int width)  { this.width = width; }

    // print full rectangle info (uses Shape.getColor(), not re-implemented here)
    public void printRectangle() {
        System.out.printf(
            "This is a Rectangle.%n Color : %s%n Length: %d%n Width : %d%n",
            getColor(), length, width
        );
    }
}