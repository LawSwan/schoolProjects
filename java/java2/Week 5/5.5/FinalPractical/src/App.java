/*******************************************************************
 * Name: Amber Lawson
 * Date: 11 December 2025
 * Assignment: SDC330 Final Practical Exam
 * Description: Main application. Creates House objects, prints them
 * iteratively and recursively, and writes and reads a log file.
 * Concepts: Polymorphism, Text File Data Storage/Retrieval, Iteration,
 *           Recursion, Use of Access Specifiers
 ******************************************************************/

import java.io.BufferedReader;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;
import java.util.List;

public class App {

    private static final String LOG_FILE_NAME = "AmberLawson_log.txt";

    public static void main(String[] args) {

        System.out.println("Amber Lawson, Week 5 Final Practical Exam");
        System.out.println();

        // Text File Data Storage: open log file for writing
        try (PrintWriter logWriter = new PrintWriter(new FileWriter(LOG_FILE_NAME))) {

            logStatus(logWriter, "Application started.");
            List<Building> buildings = new ArrayList<>(); // Polymorphism: list of Building

            // Create 5 House objects using different parameter values
            Door d1 = new Door(50, "dark brown");
            Kitchen k1 = new Kitchen("Modern", "Whirlpool");
            House h1 = new House(5, d1, k1);

            Door d2 = new Door(52, "green");
            Kitchen k2 = new Kitchen("Country", "Whirlpool");
            House h2 = new House(5, d2, k2);

            Door d3 = new Door(50, "dark brown");
            Kitchen k3 = new Kitchen("Modern", "Bosch");
            House h3 = new House(5, d3, k3);

            Door d4 = new Door(48, "red");
            Kitchen k4 = new Kitchen("Farmhouse", "Whirlpool");
            House h4 = new House(5, d4, k4);

            Door d5 = new Door(50, "white");
            Kitchen k5 = new Kitchen("Minimalist", "Kenmore");
            House h5 = new House(5, d5, k5);

            // Add these House objects to the ArrayList of Building
            buildings.add(h1);
            buildings.add(h2);
            buildings.add(h3);
            buildings.add(h4);
            buildings.add(h5);

            logStatus(logWriter, "Five houses created and added to the list.");

            // Iterative printing
            System.out.println("Iterative Printing of Buildings");
            printBuildingsIterative(buildings, logWriter);
            System.out.println();

            // Recursive printing
            System.out.println("Recursive Printing of Buildings");
            printBuildingsRecursive(buildings, 0, logWriter);
            System.out.println();

            logStatus(logWriter, "Finished printing buildings iteratively and recursively.");
            logStatus(logWriter, "Application processing complete.");

        } catch (IOException e) {
            System.out.println("Error writing to log file: " + e.getMessage());
            return;
        }

        // Text File Data Retrieval: read log file and print to console
        System.out.println("Contents of the log file");
        System.out.println("-------------------------");

        try (BufferedReader reader = new BufferedReader(new FileReader(LOG_FILE_NAME))) {
            String line;
            while ((line = reader.readLine()) != null) {
                System.out.println(line);
            }
            System.out.println("Log file print complete.");
        } catch (IOException e) {
            System.out.println("Error reading log file: " + e.getMessage());
        }
    }

    // Helper function for status messages written to the log file
    // Demonstrates text file storage and simple reuse of code
    private static void logStatus(PrintWriter logWriter, String message) {
        logWriter.println(message);
    }

    // Iterative function to print the list of buildings
    private static void printBuildingsIterative(List<Building> buildings, PrintWriter logWriter) {
        for (Building b : buildings) {
            // Polymorphism: calls the correct toString implementation at runtime
            String info = b.toString();
            System.out.println(info);
            System.out.println();
            logWriter.println(info);
            logWriter.println();
        }
    }

    // Recursive function to print the list of buildings
    private static void printBuildingsRecursive(List<Building> buildings, int index, PrintWriter logWriter) {
        if (index >= buildings.size()) {
            logWriter.println("Recursive print complete.");
            return;
        }

        Building b = buildings.get(index);
        String info = b.toString();
        System.out.println(info);
        System.out.println();
        logWriter.println(info);
        logWriter.println();

        // Recursion: method calls itself with the next index
        printBuildingsRecursive(buildings, index + 1, logWriter);
    }
}