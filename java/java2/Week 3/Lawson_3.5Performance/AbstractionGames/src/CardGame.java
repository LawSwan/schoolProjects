/*******************************************************************
 * Name: Amber Lawson
 * Date: 26 November 2025
 * Assignment: SDC330 Week 3 Performance Assessment - Abstraction
 * Description: Concrete card game class extending Game.
 *******************************************************************/

public class CardGame extends Game {

    private int numCards;

    public CardGame(String name, int numPlayers, int numCards) {
        super(name, numPlayers);
        this.numCards = numCards;
    }

    @Override
    public String startGame() {
        return "Shuffling the deck and dealing cards.";
    }

    @Override
    public String startTurn() {
        return "Player draws a card to begin their turn.";
    }

    @Override
    public String endTurn() {
        return "Player discards and ends their turn.";
    }

    @Override
    public String toString() {
        return super.toString() + "\nCards per Player: " + numCards;
    }
}