<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>employees Page</title>
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
      font-weight: bold;
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
      padding: 10px;
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
  <!-- employees Form -->
  <h1>employees Form</h1>

  <form id="employeesForm" method="post">
    <label for="EmployeeID">EmployeeID:</label>
    <input type="number" id="EmployeeID" name="EmployeeID"><br>

    <label for="FirstName">FirstName:</label>
    <input type="text" id="FirstName" name="FirstName" required><br>

    <label for="LastName">LastName:</label>
    <input type="text" id="LastName" name="LastName" required><br>

    <label for="Position">Position:</label>
    <input type="text" id="Position" name="Position" required><br>

    <label for="Salary"> Salary:</label>
    <input type="number" id="Salary" name="Salary" required><br>

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
      $stmt = $connection->prepare("INSERT INTO employees (EmployeeID, FirstName, LastName, Position, Salary) VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param("isssi", $EmployeeID, $FirstName, $LastName, $Position, $Salary);

      // Set parameters from POST data with validation (optional)
      $EmployeeID = intval($_POST['EmployeeID']); // Ensure integer for EmployeeID
      $FirstName = htmlspecialchars($_POST['FirstName']); // Prevent XSS
      $LastName = htmlspecialchars($_POST['LastName']); // Prevent XSS
      $Position = htmlspecialchars($_POST['Position']); // Prevent XSS
      $Salary = intval($_POST['Salary']); // Ensure integer for Salary

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
  <h2>Table of Employees</h2>
  <table border="1">
    <tr>
      <th>EmployeeID</th>
      <th>FirstName</th>
      <th>LastName</th>
      <th>Position</th>
      <th>Salary</th>
      <th>Delete</th>
      <th>Update</th>
    </tr>
    <?php
    include('database_connection.php');

    // SQL query to fetch data from employees table
    $sql = "SELECT * FROM employees";
    $result = $connection->query($sql);

    // Check if there are any employees records
    if ($result->num_rows > 0) {
        // Output data for each row
        while ($row = $result->fetch_assoc()) {
            $EmployeeID = $row['EmployeeID']; // Fetch the EmployeeID
            echo "<tr>
                    <td>" . $row['EmployeeID'] . "</td>
                    <td>" . $row['FirstName'] . "</td>
                    <td>" . $row['LastName'] . "</td>
                    <td>" . $row['Position'] . "</td>
                    <td>" . $row['Salary'] . "</td>
                    <td><a style='padding:4px' href='delete_employees.php?EmployeeID=$EmployeeID'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_employees.php?EmployeeID=$EmployeeID'>Update</a></td> 
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
        <h2>OUR STAFF MEMBER</h2>
        <div class="dashboard-section">
            <div class="CEO">
                <img src="ceo.jpg" alt="ceo">
                <div class="ceo-details">
                    <h3>our boss the CEO of bike company</h3>
                    <p>salary:1M</p>
                </div>
            </div>
            <div class="MD">
                <img src="MD.jpg" alt="MD">
                <div class="MD-details">
                    <h3>OUR MD!</h3>
                    <p>salary: 800$</p>
                </div>
            </div>
            <div class="product">
              <img src="manager.jpg" alt="manager">
                <div class="manager-details">
                    <h3>our HR</h3>
                    <p>salary:500$</p>
                </div>
    
  </main>
<footer>
  <p>&copy; KIBASUMBA C. All rights reserved.</p>
</footer>

</body>
</html>
