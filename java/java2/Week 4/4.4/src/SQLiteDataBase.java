/*******************************************************************
* Name: Amber Lawson
* Date: December 1, 2025
* Assignment: SDC330 Week 4 GP – Database Interactions
*
* Class to handle database interactions with a SQLite database. The
* connect method will either connect to an existing database or
* create the database if the database doesn't exist.
*/
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
public class SQLiteDataBase {
public static Connection connect(String database) {
String url = "jdbc:sqlite:" + database;
Connection conn = null;
try {
// Explicitly load the SQLite JDBC driver
Class.forName("org.sqlite.JDBC");
conn = DriverManager.getConnection(url);
} catch (SQLException e) {
System.out.println("SQL Error: " + e.getMessage());
} catch (ClassNotFoundException e) {
System.out.println("SQLite JDBC driver not found: " + e.getMessage());
}
return conn;
}
}
