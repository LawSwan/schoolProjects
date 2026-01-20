/*******************************************************************
 * Name: Amber Lawson
 * Date: 26 November 2025
 * Assignment: SDC330 Week 3 Performance Assessment - Abstraction
 * Description: Abstract board game class extending Game.
 *******************************************************************/

public abstract class BoardGame extends Game {

    private int maxMove;

    public BoardGame(String name, int numPlayers, int maxMove) {
        super(name, numPlayers);
        this.maxMove = maxMove;
    }

    public int getMaxMove() {
        return maxMove;
    }

    @Override
    public String endTurn() {
        return "Turn complete. Next player prepares to move.";
    }

    public abstract String startGame();
    public abstract String startTurn();

    @Override
    public String toString() {
        return super.toString() + "\nMax Move: " + maxMove;
    }
}