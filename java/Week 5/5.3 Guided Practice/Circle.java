/************************************************************
 * Name: Amber Lawson       
 * Date: 21 July 2025
 * Assignment: CIS230 Week 5 GP – Inheritance & Overriding
 *
 * Circle class.
 * This is a subclass (or derived class) that provides the specific
 * information for a circle. In this case, the specific information
 * we care about is the circle's radius. Unlike the previous guided
 * practice, in this guided practice we don't provide a separate
 * function to print the information – we simply override the
 * superclass's information.
 ************************************************************/
public class Circle extends Shape {
    private int Radius;

    public Circle(String color, int radius) {
        super(color);
        Radius = radius;
    }

    public int getRadius() {
        return Radius;
    }

    public void setRadius(int radius) {
        Radius = radius;
    }

    // Function to print the Circle's information, overriding the
    // superclass's "printShape" function
    @Override
    public void printShape() {
        // Print the Circle's information – use the superclass function
        // "getColor" to print the inherited color information
        System.out.printf(
            "This is a Circle.%n Color: %s%n Radius: %d%n",
            getColor(), Radius);
    }
}