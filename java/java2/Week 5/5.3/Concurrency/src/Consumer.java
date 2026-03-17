/*******************************************************************
 * Name: Amber Lawson
 * Date: December 8, 2025
 * Assignment: SDC330 Week 5 GP – Concurrency
 *
 * Consumer class used to use (or consume) items that the producer
 * places in the buffer.
 */
import java.security.SecureRandom;

public class Consumer implements Runnable {
    private static final SecureRandom generator = new SecureRandom();
    private final BlockingBuffer sharedLocation;

    public Consumer(BlockingBuffer sharedLocation) {
        this.sharedLocation = sharedLocation;
    }

    @Override
    public void run() {
        int sum = 0;

        for (int count = 1; count <= 10; count++) {
            try {
                Thread.sleep(generator.nextInt(4000));
                sum += sharedLocation.blockingGet();
            } catch (InterruptedException exception) {
                Thread.currentThread().interrupt();
            }
        }

        System.out.printf("%n%s %d%n%s%n",
                "Consumer read values totaling", sum, "Terminating Consumer");
    }
}