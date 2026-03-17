/*******************************************************************
* Name: Amber Lawson
* Date: November 24, 2025
* Assignment: SDC330 Week 3 GP – Abstraction
*
* Main application class.
*/
public class App {
public static void main(String[] args) throws Exception {
System.out.println("\nYour Name, Week 3 Abstraction GP\n");
//Can't instantiate abstract classes - uncommenting the line
//below will demonstrate that
//Shape shape = new Shape(); //ERROR - can't instantiate Shape
//However, we can declare an object of type Shape and
//instantiate it as any of the concrete types...don't
//forget about polymorphism...let's do this for each
//concrete type
Shape shape = new Square("Orange", "Red", 5.0);
System.out.println(shape);
shape = new Rectangle("Green", "Black", 5.5, 2.5);
System.out.println(shape);
shape = new Rhombus("Purple", "Red", 1.7, 3);
System.out.println(shape);
shape = new Circle("Blue", "Red", 3.4);
System.out.println(shape);
//Now lets create the objects directly - recall that only
//the Shape class imlements toString, but it's accessible
//to the derived classes
Square square = new Square("Chartreuse", "Forest Green", 11.2);
System.out.println(square);
Rectangle rect = new Rectangle("Grey", "Gray", 3.2, 5.5);
System.out.println(rect);
Rhombus para = new Rhombus("Yellow", "Orange", 2.9, 4.7);
System.out.println(para);
Circle circle = new Circle("Cyan", "Brown", 1.234);
System.out.println(circle);
}
}