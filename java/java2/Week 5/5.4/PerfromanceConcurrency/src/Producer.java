/**
 * Amber Lawson
 * December 10, 2025
 * SDC330 Performance Assessment - Concurrency - Multiple Producers & Consumers
 * Producer class that generates integer values and places them in the buffer.
 */
public class Producer implements Runnable {

    private final String name;
    private final Buffer sharedBuffer;
    private final int sleepTime;        // in seconds
    private final int startProducing;
    private final int stopProducing;

    public Producer(String name, Buffer sharedBuffer,
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
            for (int value = startProducing; value <= stopProducing; value++) {
                Thread.sleep(sleepTime * 1000L);
                sharedBuffer.blockingPut(value, name);
            }
            System.out.printf("%s finished producing.%n", name);
        } catch (InterruptedException e) {
            System.out.printf("%s interrupted.%n", name);
            Thread.currentThread().interrupt();
        }
    }
}