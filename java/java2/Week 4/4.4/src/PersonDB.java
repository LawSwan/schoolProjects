/*******************************************************************
* Name: Amber Lawson
* Date: December 1, 2025
* Assignment: SDC330 Week 4 GP – Database Interactions
*
* Class to handle all interactions with the Persons table in the
* database, including creating the table if it doesn't exist and all
* CRUD (Create, Read Update, Delete) operations on the Persons table.
* Note that the interactions are all done using standard SQL syntax
* that is then executed by the SQLite JDBC library.
*/
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
public class PersonDB {
public static boolean createTable(Connection conn) {
// SQL statement for creating a new table
String sql =
"CREATE TABLE IF NOT EXISTS People (\n"
+ " ID integer PRIMARY KEY\n"
+ " ,FirstName varchar(20)\n"
+ " ,LastName varchar(40)\n"
+ " ,Age integer);";
System.out.println(sql);
try {
Statement stmt = conn.createStatement();
stmt.execute(sql);
return true;
} catch (SQLException e) {
System.out.println(e.getMessage());
return false;
}
}
public static void clearTable(Connection conn) {
String sql = "DELETE FROM People";
try {
Statement stmt = conn.createStatement();
stmt.execute(sql);
System.out.println("Cleared all existing records from People table.");
} catch (SQLException e) {
System.out.println("Error clearing table: " + e.getMessage());
}
}
public static void addPerson(Connection conn, Person p) {
String sql =
"INSERT INTO People(FirstName, LastName, Age) VALUES(?,?,?)";
try {
PreparedStatement pst = conn.prepareStatement(sql);
pst.setString(1, p.FirstName);
pst.setString(2, p.LastName);
pst.setInt(3, p.Age);
pst.executeUpdate();
} catch(SQLException e) {
System.out.println(e.getMessage());
}
}
public static void updatePerson(Connection conn, Person p) {
String sql =
"UPDATE People SET FirstName=?, LastName=?, Age=? WHERE id=?";
try {
PreparedStatement pst = conn.prepareStatement(sql);
pst.setString(1, p.FirstName);
pst.setString(2, p.LastName);
pst.setInt(3, p.Age);
pst.setInt(4, p.ID);
pst.executeUpdate();
} catch(SQLException e) {
System.out.println(e.getMessage());
}
}
public static void deletePerson(Connection conn, int id) {
String sql = "DELETE from People WHERE ID=?";
try {
PreparedStatement pst = conn.prepareStatement(sql);
pst.setInt(1, id);
pst.executeUpdate();
} catch (SQLException e) {
System.out.println(e.getMessage());
}
}
public static ArrayList<Person> getAllPeople(Connection conn) {
ArrayList<Person> people = new ArrayList<Person>();
String sql = "SELECT * FROM People";
try {
Statement stmt = conn.createStatement();
ResultSet rs = stmt.executeQuery(sql);
while (rs.next()) {
Person p = new Person(rs.getInt("ID"), rs.getString("FirstName"),
rs.getString("LastName"), rs.getInt("Age"));
people.add(p);
}
} catch (SQLException e) {
System.out.println(e.getMessage());
}
return people;
}
public static Person getPerson(Connection conn, int id) {
Person p = new Person();
String sql = "SELECT * FROM People WHERE ID=?";
try {
PreparedStatement pst = conn.prepareStatement(sql);
pst.setInt(1, id);
ResultSet rs = pst.executeQuery();
if (rs.next()) {
p.ID = rs.getInt("ID");
p.FirstName = rs.getString("FirstName");
p.LastName = rs.getString("LastName");
p.Age = rs.getInt("Age");
} else {
p.ID = id;
p.FirstName = "Not";
p.LastName = "Found";
p.Age = 999;
}
} catch (SQLException e) {
System.out.println(e.getMessage());
}
return p;
}
}