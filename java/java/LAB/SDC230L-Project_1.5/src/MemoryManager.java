import java.util.ArrayList;
import java.util.List;

public class MemoryManager {
    private final List<Integer> memory = new ArrayList<>();

    public void add(int val) {
        if (memory.size() < 10) {
            memory.add(val);
        }
    }

    public void clear() {
        memory.clear();
    }

    public void remove(int val) {
        memory.remove((Integer) val);
    }

    public int count() {
        return memory.size();
    }

    public int sum() {
        return memory.stream().mapToInt(i -> i).sum();
    }

    public double average() {
        return memory.stream().mapToInt(i -> i).average().orElse(0.0);
    }

    public int diffFirstLast() {
        if (memory.size() < 2) return 0;
        return memory.get(0) - memory.get(memory.size() - 1);
    }

    public List<Integer> getMemory() {
        return new ArrayList<>(memory);
    }

    public boolean isFull() {
        return memory.size() >= 10;
    }
}