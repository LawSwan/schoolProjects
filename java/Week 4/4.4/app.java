/*****************************************************
 * Name: Amber Lawson
 * Date: CIS230
 * Assignment: CIS218 Week 4 GP – The Finally Block
 *
 * Main application (program) class.
 * In this application we will demonstrate the use of exception handling
 * with a finally block.
 *****************************************************/
public class app {
    public static void main(String[] args) throws Exception {
        // Print a header line
        System.out.println("Amber Lawson - Week 4 GP - The Finally Block");
        System.out.println();

        try {
            throwException();
        } catch (Exception e) {
            // caught the exception thrown by throwException
            System.out.println("Exception handled in main");
        }

        doesNotThrowException();
    }

    // demonstrate try...catch...finally
    public static void throwException() throws Exception {
        // throw an exception and immediately catch it
        try {
            System.out.println("Method throwException");
            throw new Exception();
        } catch (Exception e) {
            System.err.println("Exception handled in method throwException");
            // re-throw the exception for further processing
            throw e;
        } finally {
            // executes regardless of what happens in try...catch
            System.err.println("Finally executed in throwException");
        }

        // any code placed here would not be reached and would generate
        // compilation errors because of the throw in the try block - the error
        // generated is an "unreachable code" error, which will happen any time
        // a block of code can never be executed; if you uncomment the line of
        // code below, you’ll see this demonstrated
        // System.out.println("Program won't run with this uncommented.");
    }

    // demonstrate finally with no exception thrown
    public static void doesNotThrowException() {
        // don't throw an exception
        try {
            System.out.println("Method doesNotThrowException");
        } catch (Exception e) {
            System.err.println(e);
        } finally {
            // executes regardless of what happens in try...catch
            System.err.println("Finally executed in doesNotThrowException");
        }

        System.out.println("End of method doesNotThrowException");
    }
}