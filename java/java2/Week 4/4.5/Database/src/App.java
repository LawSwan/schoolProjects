import java.util.List;

/**
 * Author: Amber Lawson
 * Date: 2025 12 03
 * Assignment: SDC330 Performance Assessment Database
 * Description: Main application that connects to SQLite and demonstrates CRUD operations.
 */

public class App {

    public static void main(String[] args) {
        System.out.println("Amber Lawson Week 4 Database PA");

        // Use your name for the file as required
        String dbFileName = "AmberLawson.db";

        AddressDAO dao = new AddressDAO(dbFileName);

        // Create database table
        dao.createTableIfNotExists();

        // Add four address records
        Address a1 = dao.addAddress(new Address("123 Main Street", "Apt 2B", "Virginia Beach", "VA", "23462"));
        Address a2 = dao.addAddress(new Address("456 Ocean View Blvd", "", "Norfolk", "VA", "23510"));
        Address a3 = dao.addAddress(new Address("789 Pine Road", "Suite 101", "Chesapeake", "VA", "23320"));
        Address a4 = dao.addAddress(new Address("101 Maple Lane", "", "Newport News", "VA", "23601"));

        // Print all addresses
        System.out.println();
        System.out.println("All addresses currently in the database:");
        printAllAddresses(dao);

        // Try to retrieve an address using an invalid ID
        System.out.println();
        System.out.println("Trying to retrieve an address using an invalid ID:");
        int invalidId = 9999;
        Address invalidAddress = dao.getAddressById(invalidId);
        if (invalidAddress == null) {
            System.out.println("No address found with ID " + invalidId);
        } else {
            printSingleAddress(invalidAddress);
        }

        // Update an address and print it
        System.out.println();
        System.out.println("Updating an address and printing the updated record:");
        Address addressToUpdate = dao.getAddressById(a1.getId());
        if (addressToUpdate != null) {
            addressToUpdate.setCity("Updated City");
            addressToUpdate.setStreet2("Updated Apt 999");
            dao.updateAddress(addressToUpdate);

            Address updated = dao.getAddressById(addressToUpdate.getId());
            if (updated != null) {
                printSingleAddress(updated);
            }
        }

        // Delete an address and print all records again
        System.out.println();
        System.out.println("Deleting an address and printing all remaining records:");
        dao.deleteAddress(a2.getId());
        printAllAddresses(dao);
    }

    private static void printAllAddresses(AddressDAO dao) {
        List<Address> addresses = dao.getAllAddresses();
        for (Address address : addresses) {
            printSingleAddress(address);
        }
    }

    private static void printSingleAddress(Address address) {
        System.out.println("Address " + address.getId() + ":");
        System.out.println(address.getStreet1());
        if (address.getStreet2() != null && !address.getStreet2().isBlank()) {
            System.out.println(address.getStreet2());
        }
        System.out.println(address.getCity() + ", " + address.getState() + " " + address.getZip());
        System.out.println();
    }
}