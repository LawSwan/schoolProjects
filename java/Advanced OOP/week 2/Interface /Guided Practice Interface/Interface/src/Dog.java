/*******************************************************************
* Name: Amber Lawson
* Date: 19 November 2025
* Assignment: SDC330 Week 2 GP – Interface
*
* Dog class implements the Animal interface, providing the required
* overrides of all of Animal's methods. Class properties are
* included to support the interface methods and a class property
* with getters and setters is provided for functionality beyond what
* the interface requires.
*/
public class Dog implements Animal {
private String Name;
private String FavoriteActivity;
public Dog(String name, String favoriteActivity) {
    Name = name;
    FavoriteActivity = favoriteActivity;
}
public String getFavoriteActivity() {
return FavoriteActivity;
}
public void setFavoriteActivity(String favoriteActivity) {
FavoriteActivity = favoriteActivity;
}
@Override
public String getName() {
return Name;
}
@Override
public String makeSound() {
return "Bow Wow Wow Woof Woof";
}
@Override
public String move() {
return "Running around";
}
@Override
public void move(String start, String end) {
System.out.println("Bounding from " + start + " to " + end);
}
@Override
public String toString() {
return String.format(
"Dog Information:%nName: %s%nFavorite Activity: %s%n",
Name, FavoriteActivity);
}
}