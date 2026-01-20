/**
 * Amber Lawson
 * December 10, 2025
 * SDC330 Performance Assessment - Concurrency - Multiple Producers & Consumers
 * Interface that defines the operations for a shared buffer.
 */
public interface Buffer {
    void blockingPut(int value, String name) throws InterruptedException;
    int blockingGet(String name) throws InterruptedException;
}