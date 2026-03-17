import java.sql.*;
import java.util.ArrayList;
import java.util.List;

/**
 * Author: Amber Lawson
 * Date: 2025 12 03
 * Assignment: SDC330 Performance Assessment Database
 * Description: Handles all SQLite database operations for the Addresses table.
 */

public class AddressDAO {

    private String dbUrl;

    public AddressDAO(String dbFileName) {
        // Example: "AmberLawson.db"
        this.dbUrl = "jdbc:sqlite:" + dbFileName;
        
        // Explicitly load the SQLite JDBC driver
        try {
            Class.forName("org.sqlite.JDBC");
        } catch (ClassNotFoundException e) {
            System.err.println("SQLite JDBC driver not found: " + e.getMessage());
        }
    }

    private Connection getConnection() throws SQLException {
        return DriverManager.getConnection(dbUrl);
    }

    public void createTableIfNotExists() {
        String sql = """
                CREATE TABLE IF NOT EXISTS addresses (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    street1 TEXT NOT NULL,
                    street2 TEXT,
                    city TEXT NOT NULL,
                    state TEXT NOT NULL,
                    zip TEXT NOT NULL
                );
                """;

        try (Connection conn = getConnection();
             Statement stmt = conn.createStatement()) {

            stmt.execute(sql);
        } catch (SQLException e) {
            System.out.println("Error creating table: " + e.getMessage());
        }
    }

    public Address addAddress(Address address) {
        String sql = "INSERT INTO addresses (street1, street2, city, state, zip) VALUES (?, ?, ?, ?, ?)";

        try (Connection conn = getConnection();
             PreparedStatement pstmt = conn.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) {

            pstmt.setString(1, address.getStreet1());
            pstmt.setString(2, address.getStreet2());
            pstmt.setString(3, address.getCity());
            pstmt.setString(4, address.getState());
            pstmt.setString(5, address.getZip());

            pstmt.executeUpdate();

            try (ResultSet rs = pstmt.getGeneratedKeys()) {
                if (rs.next()) {
                    int id = rs.getInt(1);
                    address.setId(id);
                }
            }

        } catch (SQLException e) {
            System.out.println("Error adding address: " + e.getMessage());
        }

        return address;
    }

    public Address getAddressById(int id) {
        String sql = "SELECT * FROM addresses WHERE id = ?";
        try (Connection conn = getConnection();
             PreparedStatement pstmt = conn.prepareStatement(sql)) {

            pstmt.setInt(1, id);

            try (ResultSet rs = pstmt.executeQuery()) {
                if (rs.next()) {
                    return new Address(
                            rs.getInt("id"),
                            rs.getString("street1"),
                            rs.getString("street2"),
                            rs.getString("city"),
                            rs.getString("state"),
                            rs.getString("zip")
                    );
                }
            }

        } catch (SQLException e) {
            System.out.println("Error reading address: " + e.getMessage());
        }

        return null;
    }

    public List<Address> getAllAddresses() {
        List<Address> addresses = new ArrayList<>();
        String sql = "SELECT * FROM addresses";

        try (Connection conn = getConnection();
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery(sql)) {

            while (rs.next()) {
                Address address = new Address(
                        rs.getInt("id"),
                        rs.getString("street1"),
                        rs.getString("street2"),
                        rs.getString("city"),
                        rs.getString("state"),
                        rs.getString("zip")
                );
                addresses.add(address);
            }

        } catch (SQLException e) {
            System.out.println("Error reading all addresses: " + e.getMessage());
        }

        return addresses;
    }

    public void updateAddress(Address address) {
        String sql = "UPDATE addresses SET street1 = ?, street2 = ?, city = ?, state = ?, zip = ? WHERE id = ?";

        try (Connection conn = getConnection();
             PreparedStatement pstmt = conn.prepareStatement(sql)) {

            pstmt.setString(1, address.getStreet1());
            pstmt.setString(2, address.getStreet2());
            pstmt.setString(3, address.getCity());
            pstmt.setString(4, address.getState());
            pstmt.setString(5, address.getZip());
            pstmt.setInt(6, address.getId());

            pstmt.executeUpdate();

        } catch (SQLException e) {
            System.out.println("Error updating address: " + e.getMessage());
        }
    }

    public void deleteAddress(int id) {
        String sql = "DELETE FROM addresses WHERE id = ?";

        try (Connection conn = getConnection();
             PreparedStatement pstmt = conn.prepareStatement(sql)) {

            pstmt.setInt(1, id);
            pstmt.executeUpdate();

        } catch (SQLException e) {
            System.out.println("Error deleting address: " + e.getMessage());
        }
    }
}
