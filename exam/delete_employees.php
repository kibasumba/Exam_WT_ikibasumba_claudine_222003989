<?php
include('database_connection.php');
// Check if EmployeeID is set
if(isset($_REQUEST['EmployeeID'])) {
    $EmployeeID = $_REQUEST['EmployeeID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM employees WHERE EmployeeID=?");
    $stmt->bind_param("i", $EmployeeID);
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>echo 
             <a href='employees.php'>OK</a>";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "EmployeeID is not set.";
}

$connection->close();
?>
