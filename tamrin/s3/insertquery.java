import java.sql.*;

public class Main {
    public static void main(String[] args) {
        // Define the connection parameters
        String url = "jdbc:mysql://localhost:3306/unidatabase";
        String username = "hackpin04";
        String password = "somepass";

        // Create a connection
        try (Connection conn = DriverManager.getConnection(url, username, password)) {
            System.out.println("Connected to the database.");

            // Define the SQL queries
            String sql1 = "INSERT INTO usr_tbl (id, usrname, msg_id, email) VALUES (1, 'hackpin', 7, 'elonmusk@elonmail.com')";
            String sql2 = "INSERT INTO msg_tbl (id, msg_usr, create_t, update_t) VALUES (7, 'hi i gotta problem', '2023-11-10', '2023-12-10')";

            // Execute the SQL queries
            try (Statement stmt = conn.createStatement()) {
                stmt.executeUpdate(sql1);
                stmt.executeUpdate(sql2);
                System.out.println("Data inserted successfully.");
            } catch (SQLException e) {
                System.out.println("Error executing SQL queries: " + e.getMessage());
            }
        } catch (SQLException e) {
            System.out.println("Connection failed: " + e.getMessage());
        }
    }
}
