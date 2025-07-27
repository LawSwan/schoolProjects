public class CalculatorLogic {
    public static double calculate(double a, double b, String operator) {
        return switch (operator) {
            case "+" -> a + b;
            case "-" -> a - b;
            case "*" -> a * b;
            case "/" -> {
                if (b == 0) throw new ArithmeticException("Divide by zero");
                yield a / b;
            }
            default -> throw new IllegalArgumentException("Invalid operator: " + operator);
        };
    }

    public static String trimZeros(double val) {
        if (val == (long) val)
            return String.format("%d", (long) val);
        return String.valueOf(val);
    }
}