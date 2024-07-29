<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "weblab@1";
$dbname = "account";

// Create connection using mysqli
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['submit'])) {
    $account_no = $_POST['accountnum'];
    $account_name = $_POST['accname'];
    $bank = $_POST['bank'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO details (account_no,account_name,bank) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $account_no, $account_name, $bank);

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
$result = $conn->query("SELECT * FROM details");

if ($result->num_rows > 0) {
    echo "<table border=1>";
    echo "<tr><th>Account number</th><th>Account name</th><th>Bank</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['account_no'] . "</td>";
        echo "<td>" . $row['account_name'] . "</td>";
        echo "<td>" . $row['bank'] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>