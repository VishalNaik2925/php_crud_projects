<!DOCTYPE html>
<html>
<head>
    <title>Delete Records</title>
</head>
<body>
    <h2>Delete Records from the Database as well as local record</h2>

    <?php
    // Check if the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];

        // Create database connection
        $conn = new mysqli('localhost', 'root', '', 'php_workshop');

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare SQL statement to delete record
        $sql = "DELETE FROM students WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $conn->error;
        }

        // Close connection
        $conn->close();

        // Redirect after 2 seconds
        header("refresh:2; url=vivew.php");
    }
    ?>

</body>
</html>
