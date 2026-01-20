/*******************************************************************
* Name: Amber Lawson
* Date: December 1, 2025
* Assignment: SDC330 Week 4 GP – Database Interactions
*
* Class that represents an individual person record from the Persons
* table in the database. Note that the properties are public in this
* case as this class is purely used to hold data from the Persons
* table.
*/
public class Person {
public int ID;
public String FirstName;
public String LastName;
public int Age;
public Person(int iD, String firstName, String lastName, int age) {
ID = iD;
FirstName = firstName;
LastName = lastName;
Age = age;
}
public Person(String firstName, String lastName, int age) {
FirstName = firstName;
LastName = lastName;
Age = age;
}
public Person() {
}
}
