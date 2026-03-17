/*******************************************************************
* Name: Amber Lawson
* Date: December 1, 2025
* Assignment: SDC330 Week 4 GP – Database Interactions
*
* Main application class.
*/
import java.sql.Connection;
import java.util.ArrayList;
public class App {
public static void main(String[] args) throws Exception {
final String dbName = "AmberLawson.db";
System.out.println("\nAmber Lawson, Week 4 Database Interactions GP\n");
Connection conn = SQLiteDataBase.connect(dbName);
if (conn != null) {
if (PersonDB.createTable(conn)) {
// Clear any existing data for fresh run
PersonDB.clearTable(conn);
//Create
PersonDB.addPerson(conn, new Person("Amber", "Lawson", 31));
PersonDB.addPerson(conn, new Person("John", "Smith", 45));
PersonDB.addPerson(conn, new Person("Jane", "Jones", 24));
PersonDB.addPerson(conn, new Person("Joe", "Diffy", 61));
//Read
System.out.println("\nAll People in the Database");
printPeople(PersonDB.getAllPeople(conn));
System.out.println("\nGet a Person Using an Invalid ID");
printPerson(PersonDB.getPerson(conn,
-5));
//Update
Person personToUpdate = new Person(2, "James", "Smith", 37);
PersonDB.updatePerson(conn, personToUpdate);
Person updatedPerson = PersonDB.getPerson(conn,
personToUpdate.ID);
System.out.println("\nUpdated Person");
printPerson(updatedPerson);
//Delete
PersonDB.deletePerson(conn, personToUpdate.ID);
System.out.println("\nAll People in the Database");
printPeople(PersonDB.getAllPeople(conn));
}
}
}
private static void printPeople(ArrayList<Person> people) {
for (Person p : people) {
printPerson(p);
}
}
private static void printPerson(Person p) {
System.out.print("Person " + p.ID + ": ");
System.out.print(p.FirstName + " " + p.LastName + " is "
+ p.Age + " years old\n");
}
}