/*******************************************************************
* Name: Your Name
* Date:
* Assignment: SDC330 Week 1 GP – Inheritance
*
* This class represents an UndergraduateStudent object, which extends
* the CollegeStudent class by adding the student's year. Getters and
* setters are provided as is a constructor to set all class and super
* class properties. The toString is overridden and calls the
* getStudentInformation method to provide the formatted properties.
* The getStudentInformation method is also overridden and does not
* call the super class’s method; rather it calls the getter methods
* for the super class directly to provide a different format.
*/
public class UndergraduateStudent extends CollegeStudent {
private String Year;
public UndergraduateStudent(String name, String school, String major,
String year) {
//call the super/parent (CollegeStudent) class constructor
super(name, school, major);
Year = year;
}
//getters and setters
public String getYear() {
return Year;
}
public void setYear(String year) {
Year = year;
}
//Yet another technique...don't use the super class
//implementation at all - make our own functionality
//using the super class’s get functions (and, in this
//case, the super class’s parent as well)
@Override
public String getStudentInformation() {
return String.format("%s%s%n%s%s%n%s%s%n%s%s",
"Student Name: ", getName(), //from the Student class
"College Name: ", getSchoolName(), //from the Student class
"Student Year: ", Year, //this class’s property
"Student Major: ", getMajor()); //from the CollegeStudent class
}
@Override
public String toString() {
return getStudentInformation();
}
}