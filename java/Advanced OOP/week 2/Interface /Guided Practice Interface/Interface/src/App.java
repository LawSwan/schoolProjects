/******************************************************************
* Name: Amber Lawson
* Date: 19 November 2025
* Assignment: SDC330 Week 2 GP – Interface
*
* Main application class.
*/

import java.util.ArrayList;
import java.util.Arrays;

public class App {
    public static void main(String[] args) throws Exception {
        System.out.println("\nAmber Lawson, Week 2 Interface GP\n");
        //Animal animal = new Animal(); //error - cannot instantiate
        Dog dog1 = new Dog("Fido", "Chasing squirrels");
        Dog dog2 = new Dog("Rex", "Sleeping in the sun");
        Cat cat1 = new Cat("Felix");
        Cat cat2 = new Cat("Garfield");
        ArrayList<Animal> animals = new ArrayList<Animal>();
        animals.add(dog1);
        animals.add(dog2);
        animals.add(cat1);
        animals.add(cat2);
        System.out.println("Animals printed from ArrayList");
        for (Animal animal : animals) {
            printAnimal(animal);
            System.out.println();
        }
        System.out.println("Animals printed directly");
        printAnimal(dog1);
        dog1.move("porch", "yard");
        System.out.println();
        printAnimal(dog2);
        dog2.move("floor", "bed");
        System.out.println();
        printAnimal(cat1);
        cat1.move("window sill", "kitchen counter");
        System.out.println();
        printAnimal(cat2);
        cat2.move("back of the sofa", "laundry basket");
        System.out.println();
    }
    
    private static void printAnimal(Animal animal) {
        System.out.print(animal);
        System.out.print("Says: " + animal.makeSound() + "\n");
    }
}