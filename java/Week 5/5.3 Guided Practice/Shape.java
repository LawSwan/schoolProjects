/************************************************************
 * Name: Your Name
 * Date:
 * Assignment: CIS218 Week 5 GP – Inheritance & Overriding
 *
 * Shape class.
 * This is the superclass (or base class) that provides the generic
 * information that can be shared by all classes that inherit from it.
 * In this case, the generic information is the shape's color – generic
 * because in our example, all shapes will have a color.
 ************************************************************/
public class Shape {
    // Class property
    private String Color;

    // Constructor; sets the class's color property
    public Shape(String color) {
        Color = color;
    }

    // Public get and set methods to provide access to the class's private
    // properties
    public String getColor() {
        return Color;
    }

    public void setColor(String color) {
        Color = color;
    }

    // Function to print the Shape's information
    public void printShape() {
        System.out.printf("The Shape's color is %s.%n", Color);
    }
}