package com.lawson.kawaiicalc;

import javafx.fxml.FXML;
import javafx.scene.control.*;

public class CalculatorController {

    @FXML private TextField display;
    @FXML private ListView<Double> memoryList;
    @FXML private Label status;

    private final OperationService ops = new OperationService();
    private final MemoryManager mem = new MemoryManager();

    private double first = 0.0;
    private String pendingOp = null;
    private boolean resetDisplay = false;

    @FXML
    public void initialize() {
        memoryList.setItems(mem.items());
    }

    /* --- Digit / dot buttons --- */
    @FXML private void onDigit(javafx.event.ActionEvent e) { push(((Button) e.getSource()).getText()); }
    @FXML private void onDot() { if (!display.getText().contains(".")) push("."); }

    /* --- Operation buttons --- */
    @FXML private void onOp(javafx.event.ActionEvent e) {
        first = safeParse(display.getText());
        pendingOp = ((Button) e.getSource()).getText();
        resetDisplay = true;
        status.setText("");
    }

    @FXML
    private void onEquals() {
        if (pendingOp == null) return;
        try {
            double second = safeParse(display.getText());
            double result = switch (pendingOp) {
                case "+" -> ops.add(first, second);
                case "-" -> ops.sub(first, second);
                case "*" -> ops.mul(first, second);
                case "/" -> ops.div(first, second);
                default   -> throw new CalculationException("Unknown op");
            };
            display.setText(doubleToStr(result));
            resetDisplay = true;
            pendingOp = null;
            status.setText("");
        } catch (CalculationException ex) {
            status.setText(ex.getMessage());
        }
    }

    /* --- Clear & memory --- */
    @FXML private void onClear() { display.setText("0"); pendingOp = null; status.setText(""); }
    @FXML private void onMemStore() { mem.store(safeParse(display.getText())); }
    @FXML private void onMemRecall() {
        try {
            display.setText(doubleToStr(mem.recallLast()));
            resetDisplay = true;
            status.setText("");
        } catch (CalculationException ex) { status.setText(ex.getMessage()); }
    }
    @FXML private void onMemClear() { mem.clear(); }

    /* --- helpers --- */
    private void push(String s) {
        if (resetDisplay || "0".equals(display.getText())) {
            display.setText(s);
            resetDisplay = false;
        } else {
            display.setText(display.getText() + s);
        }
    }
    private double safeParse(String t) {
        try { return Double.parseDouble(t); }
        catch (NumberFormatException ex) { status.setText("Invalid number"); return 0; }
    }
    private String doubleToStr(double d) { return (d % 1 == 0) ? String.valueOf((long) d) : String.valueOf(d); }
    /* back-space */
@FXML private void onBack() {
    if (resetDisplay) return;
    String t = display.getText();
    display.setText(t.length() > 1 ? t.substring(0, t.length() - 1) : "0");
}

/* toggle sign */
@FXML private void onToggleSign() {
    if (display.getText().equals("0")) return;
    if (display.getText().startsWith("-"))
        display.setText(display.getText().substring(1));
    else
        display.setText("-" + display.getText());
}
}