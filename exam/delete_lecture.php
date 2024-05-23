<?php
include('database_connection.php');
// Check if lecture_id is set
if(isset($_REQUEST['lecture_id'])) {
    $lecture_id = $_REQUEST['lecture_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM lecture WHERE lecture_id=?");
    $stmt->bind_param("i", $lecture_id);
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>echo 
             <a href='lecture.php'>OK</a>";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "lecture_id is not set.";
}

$connection->close();
?>
