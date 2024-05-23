<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>bikes Page</title>
  <style>
    /* CSS styles */
    body {
      font-family: Arial, sans-serif;
      background-color: whitesmoke;
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
      max-width: 400px; /* Set max width for the form */
      margin: auto; /* Center the form horizontally */
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
<body style="background-image: url('./Images/LECTA.jpg');background-repeat: no-repeat;background-size:cover;">

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
  <!-- bikes Form -->
  <h1 style="text-align: center;">bikes Form</h1>

  <form id="lectureForm" method="post" style="margin: auto;">
    <label for="BikeID">BikeID:</label>
    <input type="number" id="BikeID" name="BikeID"><br><br>

    <label for="Brand">Brand:</label>
    <input type="text" id="Brand" name="Brand" required><br><br>

    <label for="Model">Model:</label>
    <input type="text" id="Model" name="Model" required><br><br>

    <label for="Type">Type:</label>
    <input type="text" id="Type" name="Type" required><br><br>

    <label for="Price"> Price:</label>
    <input type="Price" id="Price" name="Price" required><br><br>

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
      $stmt = $connection->prepare("INSERT INTO bikes (BikeID, Brand, Model, Type, Price) VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param("issss", $BikeID, $Brand, $Model, $Type, $Price);

      // Set parameters from POST data with validation (optional)
      $BikeID = intval($_POST['BikeID']); // Ensure integer for BikeID
      $Brand = htmlspecialchars($_POST['Brand']); // Prevent XSS
      $Model = htmlspecialchars($_POST['Model']); // Prevent XSS
      $Type = filter_var($_POST['Type'], FILTER_SANITIZE_EMAIL); // Validate Type
      $Price = filter_var($_POST['Price'], FILTER_SANITIZE_NUMBER_INT); // Sanitize Price 

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
  <h2>Table of bikes</h2>
  <table border="1">
    <tr>
      <th>BikeID</th>
      <th>Brand</th>
      <th>Model</th>
      <th>Type</th>
      <th>Price</th>
      <th>Delete</th>
      <th>Update</th>
    </tr>
    <?php
    include('database_connection.php');

    // SQL query to fetch data from bikes table
    $sql = "SELECT * FROM bikes";
    $result = $connection->query($sql);

    // Check if there are any bikes records
    if ($result->num_rows > 0) {
        // Output data for each row
        while ($row = $result->fetch_assoc()) {
            $BikeID = $row['BikeID']; // Fetch the BikeID
            echo "<tr>
                    <td>" . $row['BikeID'] . "</td>
                    <td>" . $row['Brand'] . "</td>
                    <td>" . $row['Model'] . "</td>
                    <td>" . $row['Type'] . "</td>
                    <td>" . $row['Price'] . "</td>
                    <td><a style='padding:4px' href='delete_bikes.php?BikeID=$BikeID'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_bikes.php?BikeID=$BikeID'>Update</a></td> 
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
 <header>
        <h1>Bike Showcase</h1>
    </header>
    <main>
        <section class="bike-type">
          <ul>
            <li>mountain bike </li>
            <li> touring bike</li>
            <li> side by side bike</li>
             <li>  accessories </li>
        </ul>
            <h2>Road Bikes</h2>
            <p>  here is the Description of road bikes.</p>
            <p> road bikes are  one of the best bike we have and they are easly afforadable </p>
            <p> we decidede to reduce price because we are at the end of year </p>
        </section>
            <h3>touring bike</h3>
            <p>  here is the Description of touring  bikes.</p>
            <p> this touring  bikes are  also in the best bike we have and they are afforadable </p>
            <p>  you can use the by travelling  </p>
            <p>doing sport and ,taking walk</p>
        
    </main>
    <footer>
        <p>&copy; 2024 Bike Showcase</p>
    </footer>
</body>
</html>
<footer>
  <p>&copy; KIBASUMBA C. All rights reserved.</p>
</footer>

</body>
</html>
