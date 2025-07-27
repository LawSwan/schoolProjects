// File: AppLauncher.java
// Launches KawaiiCalc after passcode input
// Amber Lawson

import javax.swing.*;

public class AppLauncher {
    public static void main(String[] args) {
        // Welcome message
        String welcome = "🐰✨ Welcome to KawaiiCalc! ✨🐰\n"
                       + "Click OK to begin your calculations.";
        JOptionPane.showMessageDialog(null, welcome,
                "Welcome to KawaiiCalc", JOptionPane.INFORMATION_MESSAGE);

        // Ask for passcode
        String userPasscode = JOptionPane.showInputDialog(null,
                "Set your secret passcode for the calculator.\n"
              + "(Used for bonus mode, optional)",
                "Set Passcode", JOptionPane.QUESTION_MESSAGE);

        if (userPasscode == null || userPasscode.trim().isEmpty()) {
            userPasscode = "1337"; // fallback default
        }

        final String finalPasscode = userPasscode;

        // Launch the GUI
        SwingUtilities.invokeLater(() -> {
            new CalculatorGUI(finalPasscode);
        });
    }
}