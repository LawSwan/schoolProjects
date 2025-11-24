/*******************************************************************
* Name: Amber Lawson
* Date: November 24 2025
* Assignment: SDC330 Week 3 GP – Constructors
*
* Main application class.
*/
public class App {
public static void main(String[] args) throws Exception {
System.out.println("\nAmber Lawson, Week 3 Constructors GP\n");
// Create Date1 objects using all their possible combinations
// of valid data, invalid data, and the various constructors
Date1 date1 = new Date1(11, "Monday", 9);
System.out.println("Date 1 created with valid information:\n" + date1);
date1 = new Date1(42, "Monday", 9);
System.out.println("Date 1 created with invalid day:\n" + date1);
date1 = new Date1(12,
"Friday", 9);
System.out.println("Date 1 created with invalid day name:\n" + date1);
date1 = new Date1(12, "Monday", 13);
System.out.println("Date 1 created with invalid month:\n" + date1);
date1 = new Date1();
System.out.println("Date 1 created with no-arg constructor:\n" + date1);
date1 = new Date1(13, "Friday");
System.out.println("Date 1 created with 2-param constructor:\n" + date1);
date1 = new Date1(6);
System.out.println("Date 1 created with 1-param constructor:\n" + date1);
// Create Date2 with the default constructor, then set both a valid
//and an invalid date
Date2 date2 = new Date2();
System.out.println("Date 2 created with default constructor:\n" + date2);
date2.setDate2("07/04/1776");
System.out.println("Date 2 updated with a valid date:\n" + date2);
date2.setDate2("Independence Day");
System.out.println("Date 2 updated with an invalid date:\n" + date2);
}
}