<?php
include('database_connection.php');
// Check if OrderID is set
if(isset($_REQUEST['OrderID'])) {
    $OrderID = $_REQUEST['OrderID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM Orders WHERE OrderID=?");
    $stmt->bind_param("i", $OrderID);
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>echo 
             <a href='Order.php'>OK</a>";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "OrderID is not set.";
}

$connection->close();
?>
