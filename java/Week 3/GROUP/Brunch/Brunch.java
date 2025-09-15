//Amber Lawson
// Date: 07/09/2025
// Description: A simple Java Swing application that randomly selects a brunch spot from a predefined list and


package Brunch;
import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
import java.util.Random;

public class Brunch extends JFrame {
  String[][] brunchSpots = {
    {"Hash & Sass 💁🏼‍♀️", "10:30 AM", "11:30 AM"},
    {"The Stubburn Mule", "11:00 AM", "12:00 PM"},
    {"Toast Me Up", "9:45 AM", "10:45 AM"},
    {"Bay Local", "12:00 PM", "1:00 PM"},
    {"Holy Crepe", "11:45 AM", "12:45 PM"}
};

    JLabel resultLabel;
    Random rand = new Random(); // Move this to a class field

    public Brunch() {
        setTitle("Brunch: Where should we get toasted?");
        setSize(400, 250); // Increased size
        setDefaultCloseOperation(EXIT_ON_CLOSE);
        setLayout(new FlowLayout());

        JButton spinButton = new JButton("🎡 Spin the Wheel!");
        resultLabel = new JLabel("Pick a brunch spot!");

        spinButton.addActionListener(e -> spinWheel());

        add(spinButton);
        add(resultLabel);

        setVisible(true);
    }

    private void spinWheel() {
        int index = rand.nextInt(brunchSpots.length);
        String spot = brunchSpots[index][0];
        String timeStart = brunchSpots[index][1];
        String timeEnd = brunchSpots[index][2];
        resultLabel.setText("<html>🍽️ " + spot + "<br>⏰ Busiest: " + timeStart + " – " + timeEnd + "</html>");
    }

    public static void main(String[] args) {
        new Brunch();
    }
}