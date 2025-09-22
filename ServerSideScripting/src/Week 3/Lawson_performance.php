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
            width: 150px;
            font-weight: bold;
        }
        input[type="text"], input[type="email"], input[type="date"] {
            width: 250px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"], button {
            background-color: #baaac6ff;
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
        // Include database connection!!! do it only once
        require_once 'db_connection.php';
        
        // Initialize variables
        $message = "";
        $edit_id = 0;
        $edit_data = array();
        
        // Handle form submissions
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['action'])) {
                switch ($_POST['action']) {
                    case 'add':
                        // Add new record
                        $name = mysqli_real_escape_string($conn, $_POST['name']);
                        $dob = mysqli_real_escape_string($conn, $_POST['dob']);
                        $color = mysqli_real_escape_string($conn, $_POST['color']);
                        $place = mysqli_real_escape_string($conn, $_POST['place']);
                        $nickname = mysqli_real_escape_string($conn, $_POST['nickname']);
                        
                        $sql = "INSERT INTO personal_info (name, date_of_birth, favorite_color, favorite_place, nickname) 
                                VALUES ('$name', '$dob', '$color', '$place', '$nickname')";
                        
                        if (mysqli_query($conn, $sql)) {
                            $message = "<div class='message success'>New record added successfully!</div>";
                        } else {
                            $message = "<div class='message error'>Error: " . mysqli_error($conn) . "</div>";
                        }
                        break;
                        
                    case 'update':
                        // Update existing record
                        $id = $_POST['id'];
                        $name = mysqli_real_escape_string($conn, $_POST['name']);
                        $dob = mysqli_real_escape_string($conn, $_POST['dob']);
                        $color = mysqli_real_escape_string($conn, $_POST['color']);
                        $place = mysqli_real_escape_string($conn, $_POST['place']);
                        $nickname = mysqli_real_escape_string($conn, $_POST['nickname']);
                        
                        $sql = "UPDATE personal_info SET 
                                name='$name', 
                                date_of_birth='$dob', 
                                favorite_color='$color', 
                                favorite_place='$place', 
                                nickname='$nickname' 
                                WHERE id=$id";
                        
                        if (mysqli_query($conn, $sql)) {
                            $message = "<div class='message success'>Record updated successfully!</div>";
                        } else {
                            $message = "<div class='message error'>Error: " . mysqli_error($conn) . "</div>";
                        }
                        break;
                        
                    case 'delete':
                        // Delete record
                        $id = $_POST['id'];
                        $sql = "DELETE FROM personal_info WHERE id=$id";
                        
                        if (mysqli_query($conn, $sql)) {
                            $message = "<div class='message success'>Record deleted successfully!</div>";
                        } else {
                            $message = "<div class='message error'>Error: " . mysqli_error($conn) . "</div>";
                        }
                        break;
                }
            }
        }
        
        // Handle edit request
        if (isset($_GET['edit'])) {
            $edit_id = $_GET['edit'];
            $edit_query = "SELECT * FROM personal_info WHERE id = $edit_id";
            $edit_result = mysqli_query($conn, $edit_query);
            if ($edit_result && mysqli_num_rows($edit_result) > 0) {
                $edit_data = mysqli_fetch_assoc($edit_result);
            }
        }
        
        // Display message
        echo $message;
        ?>
        
        <!-- Add/Edit Form -->
        <div class="form-section">
            <h2><?php echo $edit_id > 0 ? 'Edit Personal Information' : 'Add New Personal Information'; ?></h2>
            <form method="POST">
                <input type="hidden" name="action" value="<?php echo $edit_id > 0 ? 'update' : 'add'; ?>">
                <?php if ($edit_id > 0): ?>
                    <input type="hidden" name="id" value="<?php echo $edit_id; ?>">
                <?php endif; ?>
                
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo isset($edit_data['name']) ? $edit_data['name'] : ''; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="dob">Date of Birth:</label>
                    <input type="date" id="dob" name="dob" value="<?php echo isset($edit_data['date_of_birth']) ? $edit_data['date_of_birth'] : ''; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="color">Favorite Color:</label>
                    <input type="text" id="color" name="color" value="<?php echo isset($edit_data['favorite_color']) ? $edit_data['favorite_color'] : ''; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="place">Favorite Place To Visit:</label>
                    <input type="text" id="place" name="place" value="<?php echo isset($edit_data['favorite_place']) ? $edit_data['favorite_place'] : ''; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="nickname">Nickname:</label>
                    <input type="text" id="nickname" name="nickname" value="<?php echo isset($edit_data['nickname']) ? $edit_data['nickname'] : ''; ?>" required>
                </div>
                
                <input type="submit" value="<?php echo $edit_id > 0 ? 'Update Information' : 'Add Information'; ?>">
                <?php if ($edit_id > 0): ?>
                    <button type="button" onclick="window.location.href='Lawson_performance.php'">Cancel Edit</button>
                <?php endif; ?>
            </form>
        </div>
        
        <!-- Display Records -->
        <h2>Stored Personal Information</h2>
        <?php
        $query = "SELECT * FROM personal_info ORDER BY id DESC";
        $result = mysqli_query($conn, $query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Name</th>";
            echo "<th>Date of Birth</th>";
            echo "<th>Favorite Color</th>";
            echo "<th>Favorite Place</th>";
            echo "<th>Nickname</th>";
            echo "<th>Actions</th>";
            echo "</tr>";
            
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['date_of_birth'] . "</td>";
                echo "<td>" . $row['favorite_color'] . "</td>";
                echo "<td>" . $row['favorite_place'] . "</td>";
                echo "<td>" . $row['nickname'] . "</td>";
                echo "<td>";
                echo "<a href='?edit=" . $row['id'] . "'><button class='edit-btn'>Edit</button></a>";
                echo "<form method='POST' style='display:inline;' onsubmit='return confirm(\"Are you sure you want to delete this record?\");'>";
                echo "<input type='hidden' name='action' value='delete'>";
                echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                echo "<input type='submit' value='Delete' class='delete-btn'>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No records found. Add some personal information above!</p>";
        }
        
        mysqli_close($conn);
        ?>
    </div>
</body>
</html>
