/*******************************************************************
 * Name: Amber Lawson
 * Date: 26 November 2025
 * Assignment: SDC330 Week 3 Performance Assessment - Abstraction
 * Description: Spinner-based board game implementation.
 *******************************************************************/

public class SpinnerGame extends BoardGame {

    public SpinnerGame(String name, int numPlayers, int maxMove) {
        super(name, numPlayers, maxMove);
    }

    @Override
    public String startGame() {
        return "Spinning to choose starting player.";
    }

    @Override
    public String startTurn() {
        return "Player spins to begin their turn.";
    }
}