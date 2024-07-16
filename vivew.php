<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Details </title>
</head>
<body>
    <h2>View Details of enterd record</h2>

    <form action="vivew.php" method="get">
        <label for="search">Search:</label>
        <input type="text" name="query" id="search" value="<?php echo isset($_GET['query']) ? htmlspecialchars($_GET['query']) : ''; ?>">
        <input type="submit" value="Search">

        <label for="sort">Sort by:</label>
        <select name="sort" id="sort">
            <option value="name" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'name' ? 'selected' : ''; ?>>Name</option>
            <option value="usn" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'usn' ? 'selected' : ''; ?>>USN</option>
            <option value="phone" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'phone' ? 'selected' : ''; ?>>Phone Number</option>
        </select>
        <input type="submit" value="Sort">
    </form>

    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>USN</th>
                <th>Phone Number</th>
                <th>Delete Record</th>
                <th>Update Record</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Database connection
            $conn = new mysqli('localhost', 'root', '', 'php_workshop');
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Search and sort logic
            $search_query = isset($_GET['query']) ? $_GET['query'] : '';
            $sort_by = isset($_GET['sort']) ? $_GET['sort'] : 'name';

            // SQL query to fetch records
            $sql = "SELECT * FROM students WHERE name LIKE '%$search_query%' OR usn LIKE '%$search_query%' OR phone LIKE '%$search_query%' ORDER BY $sort_by";
            $result = $conn->query($sql);

            // Display records
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row["name"]) . "</td>
                            <td>" . htmlspecialchars($row["usn"]) . "</td>
                            <td>" . htmlspecialchars($row["phone"]) . "</td>
                            <td>
                                <form action='delete.php' method='post'>
                                    <input type='hidden' name='id' value='" . htmlspecialchars($row["id"]) . "'>
                                    <input type='submit' value='Delete'>
                                </form>
                            </td>
                            <td>
                                <form action='update.php' method='post'>
                                    <input type='hidden' name='id' value='" . htmlspecialchars($row["id"]) . "'>
                                    <input type='submit' value='Update'>
                                </form>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No records found</td></tr>";
            }

            // Close connection
            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
