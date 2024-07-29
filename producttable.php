<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "weblab@1";
$dbname = "products";

// Create connection using mysqli
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['insert'])) {
    $item_code = $_POST['code'];
    $item_name = $_POST['name'];
    $price = $_POST['unitprice'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO items(item_code, item_name, unit_price) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $item_code, $item_name, $price);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Fetch data
$result = $conn->query("SELECT * FROM items");

if ($result->num_rows > 0) {
    echo "<table border=1>";
    echo "<tr><th>Item Code</th><th>Item Name</th><th>Unit Price</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['item_code'] . "</td>";
        echo "<td>" . $row['item_name'] . "</td>";
        echo "<td>" . $row['unit_price'] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>