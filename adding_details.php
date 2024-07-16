<!DOCTYPE html>
<html>
<head>
    <title>home page</title>
</head>
<body>
    <h2>Add Details</h2>
    <form action="" method="post">
        <div>
            <label>Name:</label>
            <input type="text" name="name" required>
        </div>
        <div>
            <label>USN:</label>
            <input type="text" name="usn" required>
        </div>
        <div>
            <label>Phone Number:</label>
            <input type="text" name="phone" required>
        </div>
        <div>
            <input type="submit" name="submit" value="Submit">
        </div>
    </form>

    <form action="vivew.php" method="get">
        <input type="submit" value="View Records">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $name = $_POST['name'];
        $usn = $_POST['usn'];
        $phone = $_POST['phone'];

        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'php_workshop');

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Insert data
        $sql = "INSERT INTO students (name, usn, phone) VALUES ('$name', '$usn', '$phone')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>
</body>
</html>
