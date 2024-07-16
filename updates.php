<!DOCTYPE html>
<html>
<head>
    <title>Update Details</title>
</head>
<body>
    <h2>Update Details in Database as well as local record</h2>

    <?php
    // Check if ID is provided
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'php_workshop');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch record from database
        $sql = "SELECT * FROM students WHERE id='$id'";
        $result = $conn->query($sql);

        // Check if record exists
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>

            <form action="update.php" method="post">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <label>Name:</label>
                <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br>
                <label>USN:</label>
                <input type="text" name="usn" value="<?php echo $row['usn']; ?>" required><br>
                <label>Phone Number:</label>
                <input type="text" name="phone" value="<?php echo $row['phone']; ?>" required><br>
                <input type="submit" name="submit" value="Update">
            </form>

            <?php
        } else {
            echo "<div>No record found</div>";
        }
        
        $conn->close();
    }

    // Process the update request
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $usn = $_POST['usn'];
        $phone = $_POST['phone'];

        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'php_workshop');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Update record in database
        $sql = "UPDATE students SET name='$name', usn='$usn', phone='$phone' WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }

        $conn->close();

        // Redirect after 2 seconds
        header("refresh:2; url=vivew.php");
        exit();
    }
    ?>
</body>
</html>
