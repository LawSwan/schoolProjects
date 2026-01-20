/*******************************************************************
 * Name: Amber Lawson
 * Date: December 8, 2025
 * Assignment: SDC330 Week 5 GP – Concurrency
 *
 * Main application class.
 */
import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;
import java.util.concurrent.TimeUnit;

public class App {
    public static void main(String[] args) throws Exception {
        System.out.println("\nAmber Lawson, Week 5 Concurrency GP\n");

        ExecutorService executorService = Executors.newCachedThreadPool();
        BlockingBuffer sharedLocation = new BlockingBuffer();

        executorService.execute(new Producer(sharedLocation));
        executorService.execute(new Consumer(sharedLocation));

        executorService.shutdown();
        executorService.awaitTermination(1, TimeUnit.MINUTES);
    }
}