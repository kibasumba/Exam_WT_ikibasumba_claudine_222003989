<?php
include('database_connection.php');
// Check if CustomerID is set
if(isset($_REQUEST['CustomerID'])) {
    $CustomerID = $_REQUEST['CustomerID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM customers WHERE CustomerID=?");
    $stmt->bind_param("i", $CustomerID);
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>echo 
             <a href='customers.php'>OK</a>";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "CustomerID is not set.";
}

$connection->close();
?>
