/*******************************************************************
 * Name: Amber Lawson
 * Date: 26 November 2025
 * Assignment: SDC330 Week 3 Performance Assessment - Abstraction
 * Description: Main application driver for demonstrating abstraction.
 *******************************************************************/

public class App {

    public static void main(String[] args) {

        System.out.println("Amber Lawson Week 3 Abstraction Performance Assessment");
        System.out.println();

        CardGame cardGame = new CardGame("Royal Rumble Cards", 4, 5);
        DiceGame diceGame = new DiceGame("Mountain Dice Quest", 3, 6);
        SpinnerGame spinnerGame = new SpinnerGame("Color Spinner Challenge", 2, 8);

        System.out.println("Card Game Information");
        System.out.println(cardGame);
        System.out.println(cardGame.startGame());
        System.out.println(cardGame.startTurn());
        System.out.println(cardGame.endTurn());
        System.out.println();

        System.out.println("Dice Game Information");
        System.out.println(diceGame);
        System.out.println(diceGame.startGame());
        System.out.println(diceGame.startTurn());
        System.out.println(diceGame.endTurn());
        System.out.println();

        System.out.println("Spinner Game Information");
        System.out.println(spinnerGame);
        System.out.println(spinnerGame.startGame());
        System.out.println(spinnerGame.startTurn());
        System.out.println(spinnerGame.endTurn());
    }
}