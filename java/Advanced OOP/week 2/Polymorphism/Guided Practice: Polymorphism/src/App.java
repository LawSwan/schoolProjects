

import java.util.ArrayList;
public class App {
public static void main(String[] args) throws Exception {
System.out.println("\nAmber Lawson, Week 2 Polymorphism GP\n");
Food food = new Food("Food Class", "Undefined");
Vegetable veg = new Vegetable("Romaine Lettuce", "3 cups",
"Spring", "Summer");
 Corn corn = new Corn("One Ear", "Spring", "Summer/Fall",
                     "Silver Queen Sweet", "4 ears per tray");
Meat meat = new Meat("Angus Beef", "6 oz",
"Free Range Grass Fed");
//Note how the Arraylist type is "Food", but Polymorphism
//allows us to add objects of any class that extends food
ArrayList<Food> foods = new ArrayList<Food>();
foods.add(food);
foods.add(veg);
foods.add(corn);
foods.add(meat);
//print the food list using our printFoodInfo function
System.out.println("Items in foods ArrayList:\n");
for (Food f : foods) {
printFoodInfo(f);
}
//Similar to above example; note that you cannot add an
//object of type Food to the list even though Vegetable
//extends Food and you cannot add an item of type Meat
//even though Vegetable and Meat both extend Food - only
//objects of type Vegetable and classes that extend Vegetable
//(in this case, Corn) can be in the list
ArrayList<Vegetable> veggies = new ArrayList<>();
veggies.add(veg);
veggies.add(corn);
//veggies.add(food); //compiler error
//veggies.add(meat); //compiler error
//print the vegetable list using our printFoodInfo function
System.out.println("Items in veggies ArrayList:\n");
for (Vegetable v : veggies) {
printFoodInfo(v);
}
}
private static void printFoodInfo(Food food) {
System.out.println(food.toString());
}
}