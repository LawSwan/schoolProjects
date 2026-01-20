/*******************************************************************
* Name: Amber Lawson
* Date: November 24 2025
* Assignment: SDC330 Week 3 GP – Constructors
*
* This class demonstrates using a default constructor as it provides
* no constructor otherwise. Note that if any constructor is provided
* that the default constructor cannot be called. As there are no
* constructors provided to set the class’s properties, class
* properties are given default values. The toString method provides
* a formatted representation of the Date2 properties; the setDate2
* method allows the user to specify a date using a string formatted
* as dd/MM/yyyy - invalid formats will result in an error message.
*/
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;
public class Date2 {
private String DateString = "No date specified";
private Date StoredDate = new Date();
public void setDate2(String dateString) {
//Let's see if it's a real date
try {
StoredDate = new SimpleDateFormat("dd/MM/yyyy").parse(dateString);
DateString = dateString;
} catch (ParseException e) {
DateString = "Invalid date format. Value specified was: " +
dateString;
StoredDate = new Date();
}
}
@Override
public String toString() {
return String.format(
"Date String Value: %s%nStored Date Value: %s%n",
DateString, StoredDate.toString());
}
}