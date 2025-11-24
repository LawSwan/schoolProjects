/*******************************************************************
* Name: Amber Lawson
* Date: November 24 2025
* Assignment: SDC330 Week 3 GP – Constructors
*
* This class demonstrates constructor overloading by providing 3
* parameterized constructors and one no-arg constructor. Note that
* the parameterized constructor that takes 3 parameters is really
* the only constructor that "does" anything. The other constructors
* simply call the main constructor, ensuring that valid values are
* passed along with whatever their parameter(s).
*
* The DateString is used to either display the date information from
* the class or to provide an error message. Getters are provided in
* the event the class user wants to access only specific parts of
* the Date1 object.
*/
import java.util.Arrays;
import java.util.Collections;
import java.util.List;
public class Date1 {
private int Day;
private String DayName;
private int Month;
private String DateString;
private static final List<String> ValidDays =
Collections.unmodifiableList(Arrays.asList("Sunday", "Monday",
"Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"));
public Date1(int day, String dayName, int month) {
//Do some basic validation...nothing complex
if (day < 1 || day > 31) {
DateString = "Invalid Day specified - must be in range 1 - 31\n";
} else if (!ValidDays.contains(dayName)) {
DateString = "Invalid Day Name specified\n";
} else if (month < 1 || month > 12) {
DateString = "Invalid Month specified - must be in range 1 - 12\n";
} else {
Day = day;
DayName = dayName;
Month = month;
generateDateString();
}
}
public Date1() {
//Call our full constructor, giving it valid information
this(1, "Sunday", 1);
}
public Date1(int day, String dayName) {
//Call our full constructor with the values we have, valid information
//for what we don't
this(day, dayName, 1);
}
public Date1(int month) {
//Call our full constructor with the values we have, valid information
//for what we don't
this(1, "Sunday", month);
}
private void generateDateString() {
DateString = String.format(
"Date String Created:%n%s%d%n%s%s%n%s%d%n",
" Day: ", Day,
" Day Name: ", DayName,
" Month: ", Month);
}
//Provide getters so if the user only cares about one aspect of the Date1
//object they can get just that
public int getDay() {
return Day;
}
public String getDayName() {
return DayName;
}
public int getMonth() {
return Month;
}
@Override
public String toString() {
return DateString;
}
}