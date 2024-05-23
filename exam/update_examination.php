<?php
include('database_connection.php');

if(isset($_REQUEST['examination_id'])) {
    $examination_id = $_REQUEST['examination_id'];
    
    $stmt = $connection->prepare("SELECT * FROM examination WHERE examination_id=?");
    $stmt->bind_param("i", $examination_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $examination_name = $row['examination_name'];
        $examination_date = $row['examination_date'];
        $subject = $row['subject'];
    } else {
        echo "examination not found.";
    }
}
?>

<html>
<body>
    <form method="POST" onsubmit="return confirmUpdate()">
        <label for="examination_name">examination_name:</label>
        <input type="text" name="examination_name" value="<?php echo isset($examination_name) ? $examination_name : ''; ?>">
        <br><br>

        <label for="examination_date">examination_date:</label>
        <input type="date" name="examination_date" value="<?php echo isset($examination_date) ? $examination_date : ''; ?>">
        <br><br>

        <label for="subject">subject:</label>
        <input type="text" name="subject" value="<?php echo isset($subject) ? $subject : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
    </form>

    <script>
    function confirmUpdate() {
        return confirm("Are you sure you want to update this examination?");
    }
    </script>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $examination_name = $_POST['examination_name'];
    $examination_date = $_POST['examination_date'];
    $subject = $_POST['subject'];
    $examination_id = $_REQUEST['examination_id'];
    
    // Update the examination in the database
    $stmt = $connection->prepare("UPDATE examination SET examination_name=?, examination_date=?, subject=? WHERE examination_id=?");
    $stmt->bind_param("sssi", $examination_name, $examination_date, $subject, $examination_id);
    $stmt->execute();
    
    // Redirect to examination.php
    header('Location: examination.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
