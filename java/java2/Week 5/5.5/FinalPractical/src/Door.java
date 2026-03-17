/*******************************************************************
 * Name: Amber Lawson
 * Date: 11 December 2025
 * Assignment: SDC330 Final Practical Exam
 * Description: Door class.
 * Concepts: Use of Constructors, Encapsulation, Access Specifiers
 ******************************************************************/

public class Door {

    // Private fields show encapsulation
    private int width;
    private String color;

    // Constructor
    public Door(int width, String color) {
        this.width = width;
        this.color = color;
    }

    public int getWidth() {
        return width;
    }

    public String getColor() {
        return color;
    }

    @Override
    public String toString() {
        return width + " inches wide and is " + color + " in color";
    }
}