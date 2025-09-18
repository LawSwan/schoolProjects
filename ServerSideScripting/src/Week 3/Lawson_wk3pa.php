<!DOCTYPE html>
<html>
<head>
    <title>Amber Lawson Wk 3 Performance Assessment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #6c4a5dff;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            text-align: center;
        }
        .form-section {
            background-color: #f9f9f9;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: inline-block;
            width: 200px;
            font-weight: bold;
        }
        input[type="text"], input[type="date"] {
            width: 250px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"], button {
            background-color: #7b5f91ff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 5px;
        }
        input[type="submit"]:hover, button:hover {
            background-color: #6e2da0ff;
        }
        .delete-btn {
            background-color: #dc3545;
        }
        .delete-btn:hover {
            background-color: #c82333;
        }
        .edit-btn {
            background-color: #28a745;
        }
        .edit-btn:hover {
            background-color: #218838;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #d581e5ff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .message {
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Amber Lawson Wk 3 Performance Assessment</h1>
        
        <?php
        // Database connection for sdc310_wk3pa
        $hostname = "db";
        $username = "Amblaw";
        $password = "password";
        $dbname = "sdc310_wk3pa";

        // Create connection
        $conn = mysqli_connect($hostname, $username, $password, $dbname);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Initialize variables
        $message = "";
        $edit_id = 0;
        $edit_data = array();

        // Handle form submissions
        if ($_POST) {
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $date_of_birth = mysqli_real_escape_string($conn, $_POST['date_of_birth']);
            $favorite_color = mysqli_real_escape_string($conn, $_POST['favorite_color']);
            $favorite_place = mysqli_real_escape_string($conn, $_POST['favorite_place']);
            $nickname = mysqli_real_escape_string($conn, $_POST['nickname']);

            if (isset($_POST['add'])) {
                // Add new record
                $sql = "INSERT INTO personal_info (name, date_of_birth, favorite_color, favorite_place, nickname) 
                        VALUES ('$name', '$date_of_birth', '$favorite_color', '$favorite_place', '$nickname')";
                
                if (mysqli_query($conn, $sql)) {
                    $message = "<div class='message success'>New record added successfully!</div>";
                } else {
                    $message = "<div class='message error'>Error: " . mysqli_error($conn) . "</div>";
                }
            }

            if (isset($_POST['update'])) {
                // Update existing record
                $id = $_POST['id'];
                $sql = "UPDATE personal_info SET 
                        name='$name', 
                        date_of_birth='$date_of_birth', 
                        favorite_color='$favorite_color', 
                        favorite_place='$favorite_place', 
                        nickname='$nickname' 
                        WHERE id=$id";
                
                if (mysqli_query($conn, $sql)) {
                    $message = "<div class='message success'>Record updated successfully!</div>";
                } else {
                    $message = "<div class='message error'>Error: " . mysqli_error($conn) . "</div>";
                }
            }
        }

        // Handle delete
        if (isset($_GET['delete'])) {
            $id = $_GET['delete'];
            $sql = "DELETE FROM personal_info WHERE id=$id";
            
            if (mysqli_query($conn, $sql)) {
                $message = "<div class='message success'>Record deleted successfully!</div>";
            } else {
                $message = "<div class='message error'>Error: " . mysqli_error($conn) . "</div>";
            }
        }

        // Handle edit
        if (isset($_GET['edit'])) {
            $edit_id = $_GET['edit'];
            $sql = "SELECT * FROM personal_info WHERE id=$edit_id";
            $result = mysqli_query($conn, $sql);
            $edit_data = mysqli_fetch_assoc($result);
        }

        echo $message;
        ?>

        <!-- Form Section -->
        <div class="form-section">
            <h2><?php echo ($edit_id > 0) ? "Update Personal Information" : "Add New Personal Information"; ?></h2>
            <form method="POST" action="">
                <?php if ($edit_id > 0): ?>
                    <input type="hidden" name="id" value="<?php echo $edit_id; ?>">
                <?php endif; ?>

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" 
                           value="<?php echo isset($edit_data['name']) ? $edit_data['name'] : ''; ?>" required>
                </div>

                <div class="form-group">
                    <label for="date_of_birth">Date of Birth:</label>
                    <input type="date" id="date_of_birth" name="date_of_birth" 
                           value="<?php echo isset($edit_data['date_of_birth']) ? $edit_data['date_of_birth'] : ''; ?>" required>
                </div>

                <div class="form-group">
                    <label for="favorite_color">Favorite Color:</label>
                    <input type="text" id="favorite_color" name="favorite_color" 
                           value="<?php echo isset($edit_data['favorite_color']) ? $edit_data['favorite_color'] : ''; ?>" required>
                </div>

                <div class="form-group">
                    <label for="favorite_place">Favorite Place To Visit:</label>
                    <input type="text" id="favorite_place" name="favorite_place" 
                           value="<?php echo isset($edit_data['favorite_place']) ? $edit_data['favorite_place'] : ''; ?>" required>
                </div>

                <div class="form-group">
                    <label for="nickname">Nickname:</label>
                    <input type="text" id="nickname" name="nickname" 
                           value="<?php echo isset($edit_data['nickname']) ? $edit_data['nickname'] : ''; ?>" required>
                </div>

                <div class="form-group">
                    <?php if ($edit_id > 0): ?>
                        <input type="submit" name="update" value="Update Information">
                        <a href="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <button type="button">Cancel Edit</button>
                        </a>
                    <?php else: ?>
                        <input type="submit" name="add" value="Add Information">
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <!-- Display Records -->
        <div class="form-section">
            <h2>Personal Information Database Contents</h2>
            
            <?php
            $sql = "SELECT * FROM personal_info ORDER BY id DESC";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Date of Birth</th>
                        <th>Favorite Color</th>
                        <th>Favorite Place</th>
                        <th>Nickname</th>
                        <th>Actions</th>
                      </tr>";

                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['date_of_birth'] . "</td>";
                    echo "<td>" . $row['favorite_color'] . "</td>";
                    echo "<td>" . $row['favorite_place'] . "</td>";
                    echo "<td>" . $row['nickname'] . "</td>";
                    echo "<td>
                            <a href='?edit=" . $row['id'] . "'>
                                <button class='edit-btn'>Edit</button>
                            </a>
                            <a href='?delete=" . $row['id'] . "' 
                               onclick='return confirm(\"Are you sure you want to delete this record?\")'>
                                <button class='delete-btn'>Delete</button>
                            </a>
                          </td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No records found in the database.</p>";
            }

            mysqli_close($conn);
            ?>
        </div>
    </div>
</body>
</html>
