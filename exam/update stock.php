<?php
// Assuming you already have a database connection established

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['stock_id']; // Assuming you have an 'id' field in your form
    $newData = $_POST['stock_id']; // Assuming you have a field named 'new_data' in your form
    
    // Update data in the database
    $sql = "UPDATE into stock set = brand? WHERE brandid = 20000?";
    if ($stmt = $mysqli->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("si", $newData, $id);
        
        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            echo "Record updated successfully.";
        } else {
            echo "Error updating record: " . $stmt->error;
        }
        
        // Close statement
        $stmt->close();
    }
    
    // Close connection
    $mysqli->close();
}
?>
