/*******************************************************************
 * Name: Amber Lawson
 * Date: 26 November 2025
 * Assignment: SDC330 Week 3 Performance Assessment - Abstraction
 * Description: Abstract base class for all game types.
 *******************************************************************/

public abstract class Game {

    private String name;
    private int numPlayers;

    public Game(String name, int numPlayers) {
        this.name = name;
        this.numPlayers = numPlayers;
    }

    public String getName() {
        return name;
    }

    public int getNumPlayers() {
        return numPlayers;
    }

    public abstract String startGame();
    public abstract String startTurn();
    public abstract String endTurn();

    @Override
    public String toString() {
        return "Game Name: " + name + "\n"
             + "Number of Players: " + numPlayers;
    }
}
    

