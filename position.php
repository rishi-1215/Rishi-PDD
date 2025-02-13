<?php
          // Database connection
          $conn = new mysqli("localhost", "username", "password", "database_name");

          // Check connection
          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }

          // Query to fetch positions from the 'position' table
          $sql = "SELECT id, position_name FROM position";
          $result = $conn->query($sql);

          // Loop through the results and create an <option> for each position
          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  echo "<option value='" . $row["id"] . "'>" . $row["position_name"] . "</option>";
              }
          } else {
              echo "<option value='' disabled>No positions available</option>";
          }

          // Close connection
          $conn->close();
        ?>