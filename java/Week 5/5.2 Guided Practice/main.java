/*******************************************************
 * Name: Amber Lawson
 * Date: jULY 21, 2025 
 * Assignment: CIS218 Week 5 GP – First Inheritance
 *
 * Demonstrates inheritance by creating Shape and
 * Rectangle objects and using superclass methods.
 ********************************************************/
public class main {

    public static void main(String[] args) throws Exception {

        // Header
        System.out.println("Amber Lawson – Week 5 GP – First Inheritance\n");

        // Instantiate objects
        Shape     s = new Shape("Blue");
        Rectangle r = new Rectangle("Orange", 5, 10);

        // Show initial state
        s.printShape();       // superclass instance
        r.printRectangle();   // subclass instance
        r.printShape();       // call superclass method on subclass object

        // Update state
        s.setColor("Green");
        r.setColor("Red");    // inherited setter
        r.setLength(2);
        r.setWidth(4);

        // Show updated state
        s.printShape();
        r.printRectangle();
    }
}