


/*******************************************************************************
 * Amber Lawson
 * December 10, 2025
 * SDC330 Performance Assessment - Concurrency - Multiple Producers & Consumers
 * Implementation of a blocking buffer using an ArrayBlockingQueue.
 */


public class App {
    public static void main(String[] args) {

        Buffer sharedBuffer = new BlockingBuffer(5);

        Thread tP1 = new Thread(new Producer("P1", sharedBuffer, 2, 10, 16));
        Thread tP2 = new Thread(new Producer("P2", sharedBuffer, 3, 25, 29));
        Thread tP3 = new Thread(new Producer("P3", sharedBuffer, 1, 30, 39));

        Thread tC1 = new Thread(new Consumer("C1", sharedBuffer, 3, 1, 9));
        Thread tC2 = new Thread(new Consumer("C2", sharedBuffer, 2, 1, 13));

        tP1.start();
        tP2.start();
        tP3.start();
        tC1.start();
        tC2.start();

        try {
            tP1.join();
            tP2.join();
            tP3.join();
            tC1.join();
            tC2.join();
        } catch (InterruptedException e) {
            e.printStackTrace();
        }

        System.out.println("All producers and consumers have finished.");
    }
}