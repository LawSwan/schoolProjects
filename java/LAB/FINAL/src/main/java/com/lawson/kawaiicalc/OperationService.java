package com.lawson.kawaiicalc;

public class OperationService {
    public double add(double a, double b) { return a + b; }
    public double sub(double a, double b) { return a - b; }
    public double mul(double a, double b) { return a * b; }
    public double div(double a, double b) throws CalculationException {
        if (b == 0) throw new CalculationException("Divide-by-zero");
        return a / b;
    }
}