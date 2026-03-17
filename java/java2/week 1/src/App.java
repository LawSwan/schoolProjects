/*******************************************************************
* Name: Your Name
* Date:
* Assignment: SDC330 Week 1 GP – Inheritance
*
* Main application class.
*/
public class App {
public static void main(String[] args) throws Exception {
//Replace "Your Name" with your first and last name
System.out.println(); //just add a blank line
System.out.println("Your Name – SDC330 1.3 Guided Practice");
System.out.println("
--------------------------------------
");
//Create a student object & print the contents to the console
Student s = new Student("John Smith", "Any School");
System.out.println("***** Student class using toString *****");
System.out.println(s); //uses the toString method implicitly
System.out.println("***** Student class using GetStudentInformation *****");
System.out.println(s.getStudentInformation());
System.out.println(); //just add a blank line
//Create a primary school student object & print the contents to the console
PrimarySchoolStudent pss = new PrimarySchoolStudent("Jane Doe",
"Some Elementary School", "Pre-K");
System.out.println("***** PrimarySchoolStudent class using toString *****");
System.out.println(pss); //uses the toString method implicitly
System.out.println(
"***** PrimarySchoolStudent class using GetStudentInformation *****");
System.out.println(pss.getStudentInformation());
System.out.println(); //just add a blank line
//Create a High school student object & print the contents to the console
HighSchoolStudent hss = new HighSchoolStudent("Fred Smythe",
"Some High School", 10, "Sohpmore", true);
System.out.println("***** HighSchoolStudent class using toString *****");
System.out.println(hss); //uses the toString method implicitly
System.out.println(
"***** HighSchoolStudent class using GetStudentInformation *****");
//Note that the following only prints the student name and school name -
//that's because we didn't override the class with our own implementation,
//so we're getting the base/super class functionality
System.out.println(hss.getStudentInformation());
System.out.println(); //just add a blank line
//Create a college student object & print the contents to the console
CollegeStudent cs = new CollegeStudent("Your Name", "ECPI University",
"Computer Science");
System.out.println("***** CollegeStudent class using toString *****");
System.out.println(cs); //uses the toString method implicitly
System.out.println(
"***** CollegeStudent class using GetStudentInformation *****");
System.out.println(cs.getStudentInformation());
System.out.println(); //just add a blank line
//Create an undergraduate student object & print the contents to the console
UndergraduateStudent us = new UndergraduateStudent("Your Name",
"ECPI University", "Computer Science", "Junior");
System.out.println("***** UndergraduateStudent class using toString *****");
System.out.println(us); //uses the toString method implicitly
System.out.println(
"***** UndergraduateStudent class using GetStudentInformation *****");
System.out.println(us.getStudentInformation());
System.out.println(); //just add a blank line
//Create a Graduate student object & print the contents to the console
GraduateStudent gs = new GraduateStudent("Dean Jones", "Tulane",
"Psychology", true);
System.out.println("***** GraduateStudent class using toString *****");
System.out.println(gs); //uses the toString method implicitly
System.out.println(
"***** GraduateStudent class using GetStudentInformation *****");
System.out.println(gs.getStudentInformation());
System.out.println(); //just add a blank line
}
}