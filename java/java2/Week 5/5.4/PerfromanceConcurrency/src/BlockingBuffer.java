import java.util.concurrent.ArrayBlockingQueue;

/**
 * Amber Lawson
 * December 10, 2025
 * SDC330 Performance Assessment - Concurrency - Multiple Producers & Consumers
 * Implementation of a blocking buffer using an ArrayBlockingQueue.
 */
public class BlockingBuffer implements Buffer {

    private final ArrayBlockingQueue<Integer> buffer;

    // Constructor now takes a size parameter
    public BlockingBuffer(int size) {
        buffer = new ArrayBlockingQueue<>(size);
    }

    // Put with producer or consumer name for output
    @Override
    public void blockingPut(int value, String name) throws InterruptedException {
        buffer.put(value);
        System.out.printf("%s puts %2d | Buffer size: %d%n",
                name, value, buffer.size());
    }

    // Get with consumer name for output
    @Override
    public int blockingGet(String name) throws InterruptedException {
        int value = buffer.take();
        System.out.printf("%s gets %2d | Buffer size: %d%n",
                name, value, buffer.size());
        return value;
    }
}