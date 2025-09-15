package com.lawson.kawaiicalc;

import javafx.collections.FXCollections;
import javafx.collections.ObservableList;

public class MemoryManager {
    private final ObservableList<Double> mem = FXCollections.observableArrayList();

    public void store(double v) { mem.add(v); }
    public double recallLast() throws CalculationException {
        if (mem.isEmpty()) throw new CalculationException("Memory empty");
        return mem.get(mem.size() - 1);
    }
    public void clear() { mem.clear(); }
    public ObservableList<Double> items() { return mem; }
}