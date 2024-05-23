<?php
include('database_connection.php');
// Check if StockID is set
if(isset($_REQUEST['StockID'])) {
    $StockID = $_REQUEST['StockID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM stock WHERE StockID=?");
    $stmt->bind_param("i", $StockID);
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>echo 
             <a href='stock.php'>OK</a>";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "StockID is not set.";
}

$connection->close();
?>
