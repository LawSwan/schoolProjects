/*******************************************************************
* Name: Amber Lawson
* Date: December 2, 2025
* Assignment: SDC330 Week 4 GP – Text Files
*
* Main application class.
*/
import java.io.File;
import java.io.FileNotFoundException;
import java.io.PrintWriter;
import java.util.Scanner;
public class App {
private static final String FILE_NAME = "AmberLawson.txt";
public static void main(String[] args) throws Exception {
System.out.println("\nAmber Lawson, Week 4 Text Files GP\n");
System.out.println(writeToFile());
System.out.println(readFromFile());
}
// Write to a file - if successful, return a message indicating
// success; if an error occurs, return a message stating an error
// occurred
private static String writeToFile() {
try {
PrintWriter myWriter = new PrintWriter(FILE_NAME);
myWriter.println("Hello Amber Lawson!");
myWriter.println("You just wrote 2 lines of text to a file!");
myWriter.close();
return "Successfully wrote to the file.";
} catch (FileNotFoundException e) {
return "An error occurred.";
}
}
// Read from a file - if successful, return a message indicating
// the file contents were printed; if an error occurs, return a
// message stating an error occurred
private static String readFromFile() {
try {
File myObj = new File(FILE_NAME);
Scanner myReader = new Scanner(myObj);
while (myReader.hasNextLine()) {
String data = myReader.nextLine();
System.out.println(data);
}
myReader.close();
return "All lines from file printed!";
} catch (FileNotFoundException e) {
return "An error occurred.";
}
}
}