import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
import java.util.ArrayList;
import java.util.List;
import java.util.Set;


public class CalculatorGUI extends JFrame {
    private final String passcode;
    private JTextField display;
    private JTextArea memoryArea;
    private double firstNum = 0;
    private String operator = "";
    private boolean startNewNumber = true;
    private double memory = 0.0;
    private final List<String> history = new ArrayList<>();
    private final List<Integer> memoryList = new ArrayList<>();

    public CalculatorGUI(String passcode) {
        this.passcode = passcode;

        // ✅ Show Welcome + Info
        JOptionPane.showMessageDialog(null,
            "📘 Week 3 - KawaiiCalc Assignment\nCreated by Amber Lawson\n\n" +
            "Instructions:\n- Use buttons to calculate\n- Press '=' to see result\n- Use M+, MR, MC for memory\n- Right panel shows memory features",
            "Welcome!", JOptionPane.INFORMATION_MESSAGE);

        setTitle("🐰 KawaiiCalc");
        setDefaultCloseOperation(EXIT_ON_CLOSE);
        setSize(700, 600); // Wider for memory panel
        setLayout(new BorderLayout(10, 10));

        // === Display Area ===
        display = new JTextField("0");
        display.setEditable(false);
        display.setFont(new Font("Arial", Font.BOLD, 28));
        display.setBackground(new Color(255, 192, 203)); // pink
        display.setHorizontalAlignment(JTextField.RIGHT);
        display.setBorder(BorderFactory.createEmptyBorder(10, 10, 10, 10));
        add(display, BorderLayout.NORTH);

        // === Buttons ===
        JPanel buttonPanel = new JPanel(new GridLayout(5, 4, 5, 5));
        String[] buttons = {
            "MC", "MR", "M+", "C",
            "7", "8", "9", "/",
            "4", "5", "6", "*",
            "1", "2", "3", "-",
            "0", ".", "=", "+"
        };

        Set<String> memoryButtons = Set.of("MC", "MR", "M+", "C");

        for (String text : buttons) {
            JButton btn = new JButton(text);
            btn.setFont(new Font("Arial", Font.BOLD, 20));
            btn.setOpaque(true);
            btn.setBorderPainted(false);
            btn.setFocusPainted(false);

            if (memoryButtons.contains(text)) {
                btn.setBackground(new Color(152, 255, 152)); // green
            } else {
                btn.setBackground(new Color(255, 182, 193)); // pink
            }

            btn.addActionListener(new ButtonClickListener());
            buttonPanel.add(btn);
        }

        // === Memory Info Panel ===
        memoryArea = new JTextArea();
        memoryArea.setEditable(false);
        memoryArea.setFont(new Font("Monospaced", Font.PLAIN, 12));
        memoryArea.setPreferredSize(new Dimension(250, 0));
        JScrollPane scrollPane = new JScrollPane(memoryArea);

        // === Memory Buttons for Collection ===
        JPanel memControls = new JPanel(new GridLayout(3, 2, 5, 5));

        JButton addMem = new JButton("Add to Collection");
        JButton removeMem = new JButton("Remove from Collection");
        JButton clearList = new JButton("Clear Collection");

        addMem.addActionListener(e -> {
            try {
                if (memoryList.size() >= 10) {
                    JOptionPane.showMessageDialog(this, "❌ Max 10 values allowed");
                    return;
                }
                int val = Integer.parseInt(display.getText());
                memoryList.add(val);
                updateMemoryPanel();
            } catch (NumberFormatException ex) {
                JOptionPane.showMessageDialog(this, "Enter valid integer to add");
            }
        });

        removeMem.addActionListener(e -> {
            try {
                int val = Integer.parseInt(display.getText());
                if (memoryList.remove((Integer) val)) {
                    JOptionPane.showMessageDialog(this, "✔️ Removed: " + val);
                } else {
                    JOptionPane.showMessageDialog(this, "❌ Value not found");
                }
                updateMemoryPanel();
            } catch (NumberFormatException ex) {
                JOptionPane.showMessageDialog(this, "Enter valid integer to remove");
            }
        });

        clearList.addActionListener(e -> {
            memoryList.clear();
            updateMemoryPanel();
        });

        memControls.add(addMem);
        memControls.add(removeMem);
        memControls.add(clearList);

        // === Right Side Panel ===
        JPanel rightPanel = new JPanel(new BorderLayout());
        rightPanel.add(scrollPane, BorderLayout.CENTER);
        rightPanel.add(memControls, BorderLayout.SOUTH);

        // === Center Layout ===
        JPanel centerPanel = new JPanel(new BorderLayout());
        centerPanel.add(buttonPanel, BorderLayout.CENTER);
        centerPanel.add(rightPanel, BorderLayout.EAST);

        add(centerPanel, BorderLayout.CENTER);

        // === Closing Event ===
        addWindowListener(new WindowAdapter() {
            public void windowClosing(WindowEvent e) {
                JOptionPane.showMessageDialog(null, "🙏 Thank you for using KawaiiCalc! Goodbye 🌸");
            }
        });

        updateMemoryPanel();
        setVisible(true); // FINAL STEP
    }

    private void updateMemoryPanel() {
        StringBuilder sb = new StringBuilder();
        sb.append("Single Memory: ").append(CalculatorLogic.trimZeros(memory)).append("\n\n");

        sb.append("📦 Collection Memory (").append(memoryList.size()).append(" values):\n");
        sb.append(memoryList).append("\n");

        if (!memoryList.isEmpty()) {
            int sum = memoryList.stream().mapToInt(i -> i).sum();
            double avg = memoryList.stream().mapToInt(i -> i).average().orElse(0.0);
            int diff = memoryList.get(0) - memoryList.get(memoryList.size() - 1);
            sb.append("Sum: ").append(sum).append("\n");
            sb.append("Average: ").append(String.format("%.2f", avg)).append("\n");
            sb.append("Diff (1st - last): ").append(diff).append("\n");
        }

        sb.append("\n🧾 History:\n");
        for (String line : history) {
            sb.append(line).append("\n");
        }
        memoryArea.setText(sb.toString());
    }

    private class ButtonClickListener implements ActionListener {
        public void actionPerformed(ActionEvent e) {
            String cmd = ((JButton) e.getSource()).getText();

            if ("0123456789.".contains(cmd)) {
                if (startNewNumber) {
                    display.setText(cmd.equals(".") ? "0." : cmd);
                    startNewNumber = false;
                } else {
                    display.setText(display.getText() + cmd);
                }
            } else if ("+-*/".contains(cmd)) {
                try {
                    firstNum = Double.parseDouble(display.getText());
                    operator = cmd;
                    startNewNumber = true;
                } catch (NumberFormatException ex) {
                    display.setText("Error");
                }
            } else if (cmd.equals("C")) {
                display.setText("0");
                firstNum = 0;
                operator = "";
                startNewNumber = true;
            } else if (cmd.equals("M+")) {
                try {
                    memory = Double.parseDouble(display.getText());
                    updateMemoryPanel();
                } catch (NumberFormatException ex) {
                    display.setText("Error");
                }
            } else if (cmd.equals("MR")) {
                display.setText(CalculatorLogic.trimZeros(memory));
                startNewNumber = true;
            } else if (cmd.equals("MC")) {
                memory = 0.0;
                updateMemoryPanel();
            } else if (cmd.equals("=")) {
                String current = display.getText();
                if (current.equals(passcode)) {
                    JOptionPane.showMessageDialog(null, "🐰 Secret chat not implemented yet!");
                    display.setText("0");
                    startNewNumber = true;
                    return;
                }

                try {
                    double secondNum = Double.parseDouble(current);
                    double result = CalculatorLogic.calculate(firstNum, secondNum, operator);
                    String line = CalculatorLogic.trimZeros(firstNum) + " " + operator + " " +
                                  CalculatorLogic.trimZeros(secondNum) + " = " +
                                  CalculatorLogic.trimZeros(result);
                    history.add(0, line); // Top
                    display.setText(CalculatorLogic.trimZeros(result));
                    updateMemoryPanel();
                    firstNum = result;
                } catch (ArithmeticException | IllegalArgumentException ex) {
                    display.setText("Error");
                }
                startNewNumber = true;
            }
        }
    }
}