<?php
include('database_connection.php');
// Check if BikeID is set
if(isset($_REQUEST['BikeID'])) {
    $BikeID = $_REQUEST['BikeID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM bikes WHERE BikeID=?");
    $stmt->bind_param("i", $BikeID);
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>echo 
             <a href='bikes.php'>OK</a>";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "BikeID is not set.";
}

$connection->close();
?>
