/************************************************************
 * Name: Amber Lawson
 * Date: 21 July 2025
 * Assignment:  Week 5 PA – Inheritance & Overriding
 *
 * Animal superclass:
 * Holds generic data (name, legs) and prints it.
 ************************************************************/
public class Animal {
    // properties
    private String name;
    private int    legs;

    // constructor
    public Animal(String name, int legs) {
        this.name = name;
        this.legs = legs;
    }

    // getters & setters
    public String getName()          { return name; }
    public void   setName(String n)  { name = n;    }

    public int  getLegs()            { return legs; }
    public void setLegs(int l)       { legs = l;    }

    // formatted output
    public void printAnimal() {
        System.out.printf(
            "The Animal's name is %s and it has %d legs.%n",
            name, legs);
    }
}