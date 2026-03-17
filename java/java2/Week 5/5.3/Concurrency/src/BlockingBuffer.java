/*******************************************************************
 * Name: Amber Lawson
 * Date: December 8, 2025
 * Assignment: SDC330 Week 5 GP – Concurrency
 *
 * BlockingBuffer class that acts as the warehouse where the producer
 * stores items produced and the consumer retrieves (or reads) items
 * to consume.
 */
import java.util.concurrent.ArrayBlockingQueue;

public class BlockingBuffer {
    private final ArrayBlockingQueue<Integer> buffer;

    public BlockingBuffer() {
        buffer = new ArrayBlockingQueue<>(10);
    }

    public void blockingPut(int value) throws InterruptedException {
        buffer.put(value);
        System.out.printf("%s%2d\t%s%d%n",
                "Producer writes ", value,
                "Buffer cells occupied: ", buffer.size());
    }

    public int blockingGet() throws InterruptedException {
        int readValue = buffer.take();
        System.out.printf("%s %2d\t%s%d%n",
                "Consumer reads ", readValue,
                "Buffer cells occupied: ", buffer.size());
        return readValue;
    }
}