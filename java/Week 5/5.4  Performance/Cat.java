/************************************************************
 * Name:  Amber Lawson
 * Date:  21 July 2025
 * Assignment:  Week 5 PA – Inheritance & Overriding
 *
 * Cat subclass:
 * Adds the “sound” property and overrides printAnimal().
 ************************************************************/
public class Cat extends Animal {
    // subclass-specific property
    private String sound;

    // constructor – delegates name & legs to Animal
    public Cat(String name, int legs, String sound) {
        super(name, legs);
        this.sound = sound;
    }

    // getter & setter
    public String getSound()              { return sound; }
    public void   setSound(String s)      { sound = s;    }

    // override superclass method
    @Override
    public void printAnimal() {
        System.out.printf(
            "The Cat's name is %s, it has %d legs and is making a %s sound.%n",
            getName(), getLegs(), sound);
    }
}