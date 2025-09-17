/************************************************************
 * Name: Amber Lawson
 * Date: 21 july 2025
 * Assignment:  Week 5 PA – Inheritance & Overriding
 *
 * Main application: demonstrates inheritance and overriding.
 ************************************************************/
public class App {
    public static void main(String[] args) {

        System.out.println("Amber Lawson – Week 5 PA Inheritance and Overriding\n");

        // create instances
        Animal a1 = new Animal("Roo",     2);
        Cat    c1 = new Cat   ("Fluffy",  4, "meow");
        Animal a2 = new Animal("Flipper", 0);
        Cat    c2 = new Cat   ("Garfield",4, "I'm HUNGRY");

        // first printout
        a1.printAnimal();
        c1.printAnimal();
        a2.printAnimal();
        c2.printAnimal();

        // update properties
        a1.setName("Skippy");     a1.setLegs(6);          // imaginary insect Roo
        c1.setSound("purr");
        a2.setName("Nemo");       a2.setLegs(0);          // still leg-less
        c2.setSound("zzz…");

        System.out.println();     // blank line for clarity

        // second printout
        a1.printAnimal();
        c1.printAnimal();
        a2.printAnimal();
        c2.printAnimal();
    }
}