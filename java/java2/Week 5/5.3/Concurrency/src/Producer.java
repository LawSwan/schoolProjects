/*******************************************************************
 * Name: Amber Lawson
 * Date: December 8, 2025
 * Assignment: SDC330 Week 5 GP – Concurrency
 *
 * Producer class used to produce items and place them in the buffer.
 */
import java.security.SecureRandom;

public class Producer implements Runnable {
    private static final SecureRandom generator = new SecureRandom();
    private final BlockingBuffer sharedLocation;

    public Producer(BlockingBuffer sharedLocation) {
        this.sharedLocation = sharedLocation;
    }

    @Override
    public void run() {
        for (int count = 1; count <= 10; count++) {
            try {
                Thread.sleep(generator.nextInt(1000));
                sharedLocation.blockingPut(count);
            } catch (InterruptedException exception) {
                Thread.currentThread().interrupt();
            }
        }

        System.out.printf("Producer done producing%nTerminating Producer%n");
    }
}