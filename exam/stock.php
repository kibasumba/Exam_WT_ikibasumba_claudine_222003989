<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>stock Page</title>
  <style>
    /* CSS styles */
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f0f0;
      margin: 0;
      padding: 0;
    }
    header {
      background-color: #333;
      color: #fff;
      padding: 10px 0;
      text-align: center;
    }
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
    section {
      padding: 20px;
    }
    form {
      margin-bottom: 20px;
      max-width: 400px; /* Set max width for the form */
      margin: auto; /* Center the form horizontally */
    }
    form label {
      display: block;
      margin-bottom: 5px;
    }
    form input[type="number"],
    form input[type="text"],
    form input[type="date"] {
      width: calc(100% - 20px); /* Calculate width to accommodate padding */
      padding: 8px;
      margin-bottom: 10px;
      box-sizing: border-box;
    }
    input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background-color: #45a049;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    table, th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }
    th {
      background-color: #333;
      color: #fff;
    }
    td a {
      color: blue;
      text-decoration: none;
    }
  </style>
</head>

<body style="background-image: url('./image7.jp');background-repeat: no-repeat;background-size:cover;">
<style>
    img {
        width: 300px;
        height: 200px;
    }
</style>
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
        <a href="login.html">Logout</a>
      </div>
    </li>
    <br><br>
  </ul>
</header>

<section>
  <!-- stock Form -->
  <h1>stock Form</h1>

  <form id="stockForm" method="post">
    <label for="StockID">StockID:</label>
    <input type="number" id="StockID" name="StockID"><br><br>

    <label for="BikeID">BikeID:</label>
    <input type="text" id="BikeID" name="BikeID" required><br><br>

    <label for="Quantity">Quantity:</label>
    <input type="text" id="Quantity" name="Quantity" required><br><br>

    <label for="Supplier">Supplier:</label>
    <input type="text" id="Supplier" name="Supplier" required><br><br>

    <label for="PurchaseDate">Purchase Date:</label>
    <input type="date" id="PurchaseDate" name="PurchaseDate" required><br><br>

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
      $stmt = $connection->prepare("INSERT INTO stock (StockID, BikeID, Quantity,Supplier,PurchaseDate) VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param("issss", $StockID, $BikeID, $BikeID, $Quantity, $PurchaseDate);

      // Set parameters from POST data with validation (optional)
      $StockID = intval($_POST['StockID']); // Ensure integer for StockID
      $BikeID = htmlspecialchars($_POST['BikeID']); // Prevent XSS
      $Quantity = htmlspecialchars($_POST['Quantity']); // Prevent XSS
      $Supplier = filter_var($_POST['Supplier'], FILTER_SANITIZE_EMAIL); // Validate Supplier
      $PurchaseDate = filter_var($_POST['PurchaseDate'], FILTER_SANITIZE_NUMBER_INT); // Sanitize PurchaseDate 

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
  <h2>Table of stock</h2>
  <table border="1">
    <tr>
      <th>StockID</th>
      <th>BikeID</th>
      <th>Quantity</th>
      <th>Supplier</th>
      <th>PurchaseDate</th>
      <th>Delete</th>
      <th>Update</th>
    </tr>
    <?php
    include('database_connection.php');

    // SQL query to fetch data from stock table
    $sql = "SELECT * FROM stock";
    $result = $connection->query($sql);

    // Check if there are any stock records
    if ($result->num_rows > 0) {
        // Output data for each row
        while ($row = $result->fetch_assoc()) {
            $StockID = $row['StockID']; // Fetch the StockID
            echo "<tr>
                    <td>" . $row['StockID'] . "</td>
                    <td>" . $row['BikeID'] . "</td>
                    <td>" . $row['Quantity'] . "</td>
                    <td>" . $row['Supplier'] . "</td>
                    <td>" . $row['PurchaseDate'] . "</td>
                    <td><a style='padding:4px' href='delete_stock.php?StockID=$StockID'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_stock.php?StockID=$StockID'>Update</a></td> 
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
<main>
        <h2>Stock Management</h2>
        <div class="dashboard-section">
            <div class="product">
                <img src="product1.jpg" alt="Product 1">
                <div class="product-details">
                    <h3>Mountain Bike</h3>
                    <p>Quantity: 20</p>
                    <p>Price: $500</p>
                </div>
            </div>
            <div class="product">
                <img src="product2.jpg" alt="Product 2">
                <div class="product-details">
                    <h3>Road Bike</h3>
                    <p>Quantity: 15</p>
                    <p>Price: $700</p>
                </div>
            </div>
            <div class="product">
              <img src="product3.jpg" alt="Product 3">
                <div class="product-details">
                    <h3>mountain bike</h3>
                    <p>Quantity: 15</p>
                    <p>Price: $1000</p>
                </div>
                <div class="product">
              <img src="product4.jpg" alt="Product 4">
                <div class="product-details">
                    <h3>mountain hat</h3>
                    <p>Quantity: 5</p>
                    <p>Price: $1500</p>
                </div>
          
        </div>
        <!-- Add controls for adding/editing/removing products -->
    </main>
<footer>
  <p>&copy; KIBASUMBA C. All rights reserved.</p>
</footer>

</body>
</html>
