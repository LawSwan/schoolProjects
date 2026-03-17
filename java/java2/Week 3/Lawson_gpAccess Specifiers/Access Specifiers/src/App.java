/*******************************************************************
* Name: Amber Lawson
* Date: November 24 2025
* Assignment: SDC330 Week 3 GP – Access Specifiers
*
* Main application class.
*/
public class App {
public static void main(String[] args) throws Exception {
System.out.println("\nAmber Lawson, Week 3 Access Specifiers GP\n");
//Create a Person object
//Note that you cannot create it directly because of the access
//level on the constructor, so you have to create the subclass

Person person = new Student("John Smith", 22, "js@mail.com", 2022);
//print person info using toString...even though Person doesn't
//actually implement toString - polymorphism again - we get the
//Student toString
System.out.println("Person printed using Student's toString");
System.out.println(person);
person.setAge(43.5);
//now print the information using the getters - note the Student
//getters aren't available because this is a Person object
System.out.println("Person printed using Person getters");
System.out.println("Name: " + person.getName());
System.out.println("Age: " + person.getAge());
System.out.println("EMail: " + person.getEmail());
//now let's do the same, only with a Student object direclty
Student student = new Student("Jane Jones", 19, "jj@mail.com", 2023);
//print person info using toString...even though Person doesn't
//actually implement toString - polymorphism again - we get the
//Student toString
System.out.println("\nStudent printed using Student's toString");
System.out.println(student);
//now update the information for the student; note that because
//we are only using one package we could call the setters directly;
//however, this would work if the main was in a different package
//as well
student.updateName("Jane Smith-Jones");
student.updateAge(21.1);
student.updateEmail("jsj@mail.com");
student.setGradYear(2023);
//now print the information using the getters - note the Student
//getters aren't available because this is a Person object
System.out.println("Student printed using Student & Person getters");
System.out.println("Name: " + student.getName());
System.out.println("Age: " + student.getAge());
System.out.println("EMail: " + student.getEmail());
System.out.println("Graduation Year: " + student.getGradYear());
}
}