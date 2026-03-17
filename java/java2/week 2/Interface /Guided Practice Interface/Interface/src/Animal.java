/*******************************************************************
* Name: Amber Lawson
* Date: 19 November 2025
* Assignment: SDC330 Week 2 GP – Interface
*
* Interface class Animal - defines all methods that classes that
* implement this interface must implement.
*/
public interface Animal {
public String getName();
public String makeSound();
public String move();
public void move(String start, String end);
}