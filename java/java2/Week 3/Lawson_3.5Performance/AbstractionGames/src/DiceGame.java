
/*******************************************************************
 * Name: Amber Lawson
 * Date: 26 November 2025
 * Assignment: SDC330 Week 3 Performance Assessment - Abstraction
 * Description: Dice-based board game implementation.
 *******************************************************************/

public class DiceGame extends BoardGame {

    public DiceGame(String name, int numPlayers, int maxMove) {
        super(name, numPlayers, maxMove);
    }

    @Override
    public String startGame() {
        return "Rolling to determine starting player.";
    }

    @Override
    public String startTurn() {
        return "Player rolls the dice.";
    }
}
