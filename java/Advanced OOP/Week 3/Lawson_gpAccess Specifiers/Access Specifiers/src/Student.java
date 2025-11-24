/*******************************************************************
* Name: Your Name
* Date:
* Assignment: SDC330 Week 3 GP – Access Specifiers
*
* This class demonstrates using public and private access specifiers.
* The member variables are not accessible outside of this class as
* they are private.
*/
public class Student extends Person {
private int GradYear;
public Student(String name, double age, String email, int gradYear) {
super(name, age, email);
GradYear = gradYear;
}
//getters and setters
public int getGradYear() {
return GradYear;
}
public void setGradYear(int gradYear) {
GradYear = gradYear;
}
//methods to update super class info
public void updateName(String name) {
setName(name);
}
public void updateAge(double age) {
setAge(age);
}
public void updateEmail(String email) {
setEmail(email);
}
@Override
public String toString() {
return
"Student Information for " + getName() + "\n" +
" Age: " + getAge() + "\n" +
" EMail: " + getEmail() + "\n" +
" Graduation Year: " + GradYear + "\n";
}
}