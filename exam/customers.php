<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>customers Page</title>
  <style>
    /* CSS styles */
    body {
      font-family: Arial, sans-serif; /* Example font family */
      margin: 0; /* Remove default margin */
      padding: 0; /* Remove default padding */
      background-image: url('./Images/LECTA.jpg');
      background-repeat: no-repeat;
      background-size: cover;
    }

    header {
      background-color: #333; /* Example header background color */
      color: #fff; /* Example header text color */
      padding: 10px; /* Add some padding to the header */
    }

    /* Style the navigation links */
    header ul {
      margin: 0;
      padding: 0;
      list-style-type: none;
    }

    header ul li {
      display: inline;
      margin-right: 10px;
    }

    header ul li a {
      color: #fff;
      text-decoration: none;
    }

    /* Style the form */
    form {
      margin-top: 20px;
      padding: 20px;
      background-color: #f9f9f9;
      border-radius: 5px;
      width: 50%; /* Adjust form width as needed */
      margin: auto; /* Center the form horizontally */
    }

    form label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    form input[type="number"],
    form input[type="text"] {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    form input[type="submit"] {
      background-color: #333;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    /* Style the table */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    table th, table td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    table th {
      background-color: #333;
      color: #fff;
    }

    table tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    /* Style footer */
    footer {
      background-color: #333;
      color: #fff;
      text-align: center;
      padding: 1px;
      position: fixed;
      bottom: 0;
      width: 100%;
    }
  </style>
</head>

<body>

<header>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
      <img src="./A.jpg" width="90" height="60" alt="Logo">
    </li>

    <li style="display: inline; margin-right: 10px;"><a href="./home.html">Home</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./stock.php">stock</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./bikes.php">bikes </a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./orders.php">orders</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./employees.php">employees</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./customers.php">customers</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact us.html">contact us</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./About Us.html">About Us</a></li>
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color:darkgreen; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Change Acount</a>
        <a href="logout.php">Logout</a>
      </div>
    </li>
    <br><br>
  </ul>
</header>

<section>
  <!-- customers Form -->
  <h1>customers Form</h1>

  <form id="customerForm" method="post">
    <label for="CustomerID">CustomerID:</label>
    <input type="number" id="CustomerID" name="CustomerID"><br>

    <label for="FirstName">FirstName:</label>
    <input type="text" id="FirstName" name="FirstName" required><br>

    <label for="LastName">LastName:</label>
    <input type="text" id="LastName" name="LastName" required><br>

    <label for="Email">Email:</label>
    <input type="text" id="Email" name="Email" required><br>

    <label for="Phone"> Phone:</label>
    <input type="Phone" id="Phone" name="Phone" required><br>

    <input type="submit" name="add" value="Insert" onclick="return confirmInsertion();">
  </form>

  <!-- JavaScript code for form submission confirmation -->
  <script>
    function confirmInsertion() {
      return confirm("Are you sure you want to insert this record?");
    }
  </script>

  <!-- PHP code for form submission and displaying records -->
  <?php
  // PHP code for form submission and displaying records
  include('database_connection.php');

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Prepare and bind parameters with appropriate data types
      $stmt = $connection->prepare("INSERT INTO customers (CustomerID, FirstName, LastName, Email, Phone) VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param("issss", $CustomerID, $FirstName, $LastName, $Email, $Phone);

      // Set parameters from POST data with validation (optional)
      $CustomerID = intval($_POST['CustomerID']); // Ensure integer for CustomerID
      $FirstName = htmlspecialchars($_POST['FirstName']); // Prevent XSS
      $LastName = htmlspecialchars($_POST['LastName']); // Prevent XSS
      $Email = filter_var($_POST['Email'], FILTER_SANITIZE_EMAIL); // Validate Email
      $Phone = filter_var($_POST['Phone'], FILTER_SANITIZE_NUMBER_INT); // Sanitize Phone 

      // Execute prepared statement with error handling
      if ($stmt->execute()) {
          echo "New record has been added successfully!";
      } else {
          echo "Error: " . $stmt->error;
      }

      $stmt->close();
  }

  $connection->close();
  ?>

  <!-- Table to display lecture records -->
  <h2>Table of customers</h2>
  <table border="1">
    <tr>
      <th>CustomerID</th>
      <th>FirstName</th>
      <th>LastName</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Delete</th>
      <th>Update</th>
    </tr>
    <?php
    include('database_connection.php');

    // SQL query to fetch data from bikes table
    $sql = "SELECT * FROM customers";
    $result = $connection->query($sql);

    // Check if there are any bikes records
    if ($result->num_rows > 0) {
        // Output data for each row
        while ($row = $result->fetch_assoc()) {
            $CustomerID = $row['CustomerID']; // Fetch the CustomerID
            echo "<tr>
                    <td>" . $row['CustomerID'] . "</td>
                    <td>" . $row['FirstName'] . "</td>
                    <td>" . $row['LastName'] . "</td>
                    <td>" . $row['Email'] . "</td>
                    <td>" . $row['Phone'] . "</td>
                    <td><a style='padding:4px' href='delete_customers.php?CustomerID=$CustomerID'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_customers.php?CustomerID=$CustomerID'>Update</a></td> 
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No data found</td></tr>";
    }
    // Close the database connection
    $connection->close();
    ?>
  </table>
</section>

<footer>
  <p>&copy; KIBASUMBA C. All rights reserved.</p>
</footer>

</body>
</html>
