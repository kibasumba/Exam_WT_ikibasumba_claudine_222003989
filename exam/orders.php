<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Order Page</title>
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
    }

    form label {
      display: block;
      margin-bottom: 5px;
    }

    form input[type="number"],
    form input[type="text"] {
      width: 400px;
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
      padding: 2px;
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
  <!-- Order Form -->
  <h1>Order Form</h1>

  <form id="employees Form" method="post">
    <label for="OrderID">OrderID:</label>
    <input type="number" id="OrderID" name="OrderID"><br><br>

    <label for="CustomerID">CustomerID:</label>
    <input type="text" id="CustomerID" name="CustomerID" required><br><br>

    <label for="BikeID">BikeID:</label>
    <input type="text" id="BikeID" name="BikeID" required><br><br>

    <label for="Quantity">Quantity:</label>
    <input type="text" id="Quantity" name="Quantity" required><br><br>

    <label for="TotalPrice"> TotalPrice:</label>
    <input type="TotalPrice" id="TotalPrice" name="TotalPrice" required><br><br>

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
      $stmt = $connection->prepare("INSERT INTO orders (OrderID, CustomerID, BikeID, Quantity, TotalPrice) VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param("issss", $OrderID, $CustomerID, $BikeID, $Quantity, $TotalPrice);

      // Set parameters from POST data with validation (optional)
      $OrderID = intval($_POST['OrderID']); // Ensure integer for OrderID
      $CustomerID = htmlspecialchars($_POST['CustomerID']); // Prevent XSS
      $BikeID = htmlspecialchars($_POST['BikeID']); // Prevent XSS
      $Quantity = filter_var($_POST['Quantity'], FILTER_SANITIZE_EMAIL); // Validate Quantity
      $TotalPrice = filter_var($_POST['TotalPrice'], FILTER_SANITIZE_NUMBER_INT); // Sanitize TotalPrice 

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
  <h2>Table of Order</h2>
  <table border="1">
    <tr>
      <th>OrderID</th>
      <th>CustomerID</th>
      <th>BikeID</th>
      <th>Quantity</th>
      <th>TotalPrice</th>
      <th>Delete</th>
      <th>Update</th>
    </tr>
    <?php
    include('database_connection.php');

    // SQL query to fetch data from bikes table
    $sql = "SELECT * FROM orders";
    $result = $connection->query($sql);

    // Check if there are any bikes records
    if ($result->num_rows > 0) {
        // Output data for each row
        while ($row = $result->fetch_assoc()) {
            $OrderID = $row['OrderID']; // Fetch the OrderID
            echo "<tr>
                    <td>" . $row['OrderID'] . "</td>
                    <td>" . $row['CustomerID'] . "</td>
                    <td>" . $row['BikeID'] . "</td>
                    <td>" . $row['Quantity'] . "</td>
                    <td>" . $row['TotalPrice'] . "</td>
                    <td><a style='padding:4px' href='delete_orders.php?OrderID=$OrderID'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_orders.php?OrderID=$OrderID'>Update</a></td> 
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
</footer>
<p>&copy; KIBASUMBA C. All rights reserved.</p>
</body>
</html>
