/************************************************************
 * Name: Amber Lawson
 * Date: 21 July 2025
 * Assignment: CIS230 Week 5 GP – Inheritance & Overriding
 *
 * Main application (program) class.
 * In this application we will demonstrate the concept of inheritance
 * by instantiating Shape and Rectangle objects and demonstrating the
 * use of superclass methods in a subclass instantiated object.
 ************************************************************/
public class App {
    public static void main(String[] args) throws Exception {
        // Print a header line
        System.out.println("Amber Lawson – Week 5 GP – Inheritance & Overriding");
        System.out.println();

        // Instantiate Shape and Rectangle objects
        Shape     s = new Shape("Blue");
        Rectangle r = new Rectangle("Orange", 5, 10);
        Circle    c = new Circle("Yellow", 2);

        // Print each object's properties
        s.printShape();
        r.printShape();
        c.printShape();

        // Update the objects' properties
        s.setColor("Green");

        r.setColor("Red"); // Superclass method
        r.setLength(2);
        r.setWidth(4);

        c.setColor("Purple");
        c.setRadius(12);

        // Print each object's properties
        s.printShape();
        r.printShape();
        c.printShape();
    }
}