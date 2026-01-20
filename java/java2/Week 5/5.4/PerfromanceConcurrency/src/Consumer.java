/**
 * Amber Lawson
 * December 10, 2025
 * SDC330 Performance Assessment - Concurrency - Multiple Producers & Consumers
 * Consumer class that retrieves integer values from the buffer.
 */
public class Consumer implements Runnable {

    private final String name;
    private final Buffer sharedBuffer;
    private final int sleepTime;        // in seconds
    private final int startProducing;
    private final int stopProducing;

    public Consumer(String name, Buffer sharedBuffer,
                    int sleepTime, int startProducing, int stopProducing) {
        this.name = name;
        this.sharedBuffer = sharedBuffer;
        this.sleepTime = sleepTime;
        this.startProducing = startProducing;
        this.stopProducing = stopProducing;
    }

    @Override
    public void run() {
        try {
            for (int i = startProducing; i <= stopProducing; i++) {
                Thread.sleep(sleepTime * 1000L);
                sharedBuffer.blockingGet(name);
            }
            System.out.printf("%s finished consuming.%n", name);
        } catch (InterruptedException e) {
            System.out.printf("%s interrupted.%n", name);
            Thread.currentThread().interrupt();
        }
    }
}
