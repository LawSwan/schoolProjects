/*******************************************************************
* Name: Amber Lawson
* Date: November 24 2025
* Assignment: SDC330 Week 3 GP – Access Specifiers
*
* This class demonstrates using public, private, and protected access
* specifiers. Of note, the protected constructor means that this
* class cannot be instantiated directly - only a subclass can call
* this class' constructor. The member variables are not accessible
* outside of this class. The protected methods are available to
* subclasses and other classes within the same package as this class.
*/
public class Person {
public String Name;
public static double Age;
public static void main(String[] args) {
    
} String Email;
//protected constructor
public Person(String name, double age, String email) {
Name = name;
Age = age;
Email = email;
}
//public getters; protected setters
public String getName() {
return Name;
}
protected void setName(String name) {
Name = name;
}
public double getAge() {
return Age;
}
protected void setAge(double d) {
Age = d;
}
public String getEmail() {
return Email;
}
protected void setEmail(String email) {
Email = email;
}
}