/*******************************************************************
* Name: Amber Lawson
* Date: December 2,2025
* Assignment: SDC330 Week 4 GP – Binary Files
*
* Main application class.
*/
import java.io.DataInputStream;
import java.io.DataOutputStream;
import java.io.FileInputStream;
import java.io.FileOutputStream;
import java.io.IOException;
public class App {
private static final String FILE_NAME = "AmberLawson.dat";
public static void main(String[] args) throws Exception {
System.out.println("\nAmber Lawson, Week 4 Text Files GP\n");
System.out.println(writeToFile());
System.out.println(readFromFile());
}
// Write to a file - if successful, return a message indicating
// success; if an error occurs, return a message stating an error
// occurred
public static String writeToFile() throws IOException {
try {
FileOutputStream outStream = new FileOutputStream(FILE_NAME);
DataOutputStream outputFile = new DataOutputStream(outStream);
System.out.println("Starting to write to file");
outputFile.writeInt(5);
outputFile.writeDouble(9.95);
System.out.println("Finished writing to file\n");
outputFile.close();
return "Write completed successfully";
} catch (IOException e) {
return "An error occurred";
}
}
// Read from a file - if successful, return a message indicating
// the file contents were printed; if an error occurs, return a
// message stating an error occurred
public static String readFromFile() throws IOException {
try {
FileInputStream inStream = new FileInputStream(FILE_NAME);
DataInputStream inputFile = new DataInputStream(inStream);
int fileInt = 0;
double fileDbl = 0.0;
System.out.println("Starting to read file");
fileInt = inputFile.readInt();
System.out.print(fileInt + " ");
fileDbl = inputFile.readDouble();
System.out.println(fileDbl);
inputFile.close();
System.out.println("Finished reading from file");
return "Reading completed successfully";
} catch (IOException e) {
return "An error occurred";
}
}
}