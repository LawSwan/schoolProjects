<?php
// Include database connection
require_once 'midterm_db_connection.php';

// Handle form submissions
$message = "";
$action = isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : '');

// Handle Add/Update operations
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($action == 'add') {
        $first = mysqli_real_escape_string($conn, $_POST['first']);
        $last = mysqli_real_escape_string($conn, $_POST['last']);
        $street = mysqli_real_escape_string($conn, $_POST['street']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);
        $state = mysqli_real_escape_string($conn, $_POST['state']);
        $zip = mysqli_real_escape_string($conn, $_POST['zip']);
        
        $sql = "INSERT INTO addresses (First, Last, Street, City, State, Zip) 
                VALUES ('$first', '$last', '$street', '$city', '$state', '$zip')";
        
        if (mysqli_query($conn, $sql)) {
            $message = "<div class='alert alert-success'>Address added successfully!</div>";
        } else {
            $message = "<div class='alert alert-danger'>Error adding address: " . mysqli_error($conn) . "</div>";
        }
    }
    
    if ($action == 'update') {
        $addressNo = $_POST['addressNo'];
        $first = mysqli_real_escape_string($conn, $_POST['first']);
        $last = mysqli_real_escape_string($conn, $_POST['last']);
        $street = mysqli_real_escape_string($conn, $_POST['street']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);
        $state = mysqli_real_escape_string($conn, $_POST['state']);
        $zip = mysqli_real_escape_string($conn, $_POST['zip']);
        
        $sql = "UPDATE addresses SET 
                First='$first', Last='$last', Street='$street', 
                City='$city', State='$state', Zip='$zip' 
                WHERE AddressNo=$addressNo";
        
        if (mysqli_query($conn, $sql)) {
            $message = "<div class='alert alert-success'>Address updated successfully!</div>";
        } else {
            $message = "<div class='alert alert-danger'>Error updating address: " . mysqli_error($conn) . "</div>";
        }
    }
}

// Handle Delete operation
if ($action == 'delete' && isset($_GET['id'])) {
    $addressNo = $_GET['id'];
    $sql = "DELETE FROM addresses WHERE AddressNo=$addressNo";
    
    if (mysqli_query($conn, $sql)) {
        $message = "<div class='alert alert-success'>Address deleted successfully!</div>";
    } else {
        $message = "<div class='alert alert-danger'>Error deleting address: " . mysqli_error($conn) . "</div>";
    }
}

// Get record for editing
$editRecord = null;
if ($action == 'edit' && isset($_GET['id'])) {
    $addressNo = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM addresses WHERE AddressNo=$addressNo");
    $editRecord = mysqli_fetch_assoc($result);
}

// Query for all addresses
$query = "SELECT * FROM addresses ORDER BY Last, First";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Address Management System - Midterm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        h1 {
            color: #333;
            text-align: center;
            border-bottom: 3px solid #007bff;
            padding-bottom: 10px;
        }
        
        h2 {
            color: #555;
            border-left: 4px solid #007bff;
            padding-left: 10px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        
        th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }
        
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        tr:hover {
            background-color: #e3f2fd;
        }
        
        .form-container {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border: 1px solid #dee2e6;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        
        input[type="text"] {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }
        
        input[type="text"]:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0,123,255,0.3);
        }
        
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 2px;
            transition: background-color 0.3s;
        }
        
        .btn-primary {
            background-color: #007bff;
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #0056b3;
        }
        
        .btn-success {
            background-color: #28a745;
            color: white;
        }
        
        .btn-success:hover {
            background-color: #1e7e34;
        }
        
        .btn-warning {
            background-color: #ffc107;
            color: black;
        }
        
        .btn-warning:hover {
            background-color: #e0a800;
        }
        
        .btn-danger {
            background-color: #dc3545;
            color: white;
        }
        
        .btn-danger:hover {
            background-color: #c82333;
        }
        
        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }
        
        .btn-secondary:hover {
            background-color: #545b62;
        }
        
        .alert {
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        
        .alert-success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }
        
        .form-row {
            display: flex;
            gap: 15px;
        }
        
        .form-row .form-group {
            flex: 1;
        }
        
        .actions {
            white-space: nowrap;
        }
        
        .toggle-form {
            margin: 20px 0;
        }
        
        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
            }
            
            table {
                font-size: 12px;
            }
            
            th, td {
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Address Management System</h1>
        <p style="text-align: center; color: #666;">SDC310 Midterm Project - Lawson</p>
        
        <?php echo $message; ?>
        
        <!-- Toggle Add Form Button -->
        <div class="toggle-form">
            <?php if (!$editRecord): ?>
                <button onclick="toggleAddForm()" class="btn btn-success">
                    <span id="toggle-text">+ Add New Address</span>
                </button>
            <?php endif; ?>
        </div>
        
        <!-- Add/Edit Form -->
        <div id="address-form" class="form-container" style="<?php echo (!$editRecord) ? 'display: none;' : ''; ?>">
            <h2><?php echo $editRecord ? 'Edit Address' : 'Add New Address'; ?></h2>
            <form method="POST" action="">
                <input type="hidden" name="action" value="<?php echo $editRecord ? 'update' : 'add'; ?>">
                <?php if ($editRecord): ?>
                    <input type="hidden" name="addressNo" value="<?php echo $editRecord['AddressNo']; ?>">
                <?php endif; ?>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="first">First Name:</label>
                        <input type="text" id="first" name="first" maxlength="25" 
                               value="<?php echo $editRecord ? htmlspecialchars($editRecord['First']) : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="last">Last Name:</label>
                        <input type="text" id="last" name="last" maxlength="30" 
                               value="<?php echo $editRecord ? htmlspecialchars($editRecord['Last']) : ''; ?>" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="street">Street Address:</label>
                    <input type="text" id="street" name="street" maxlength="100" 
                           value="<?php echo $editRecord ? htmlspecialchars($editRecord['Street']) : ''; ?>" required>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="city">City:</label>
                        <input type="text" id="city" name="city" maxlength="25" 
                               value="<?php echo $editRecord ? htmlspecialchars($editRecord['City']) : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="state">State (2 letters):</label>
                        <input type="text" id="state" name="state" maxlength="2" 
                               value="<?php echo $editRecord ? htmlspecialchars($editRecord['State']) : ''; ?>" 
                               style="text-transform: uppercase;" required>
                    </div>
                    <div class="form-group">
                        <label for="zip">ZIP Code:</label>
                        <input type="text" id="zip" name="zip" maxlength="10" 
                               value="<?php echo $editRecord ? htmlspecialchars($editRecord['Zip']) : ''; ?>" required>
                    </div>
                </div>
                
                <div style="margin-top: 20px;">
                    <button type="submit" class="btn btn-primary">
                        <?php echo $editRecord ? 'Update Address' : 'Add Address'; ?>
                    </button>
                    <?php if ($editRecord): ?>
                        <a href="?" class="btn btn-secondary">Cancel</a>
                    <?php else: ?>
                        <button type="button" onclick="toggleAddForm()" class="btn btn-secondary">Cancel</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
        
        <!-- Address Table -->
        <h2>All Addresses</h2>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Street</th>
                        <th>City</th>
                        <th>State</th>
                        <th>ZIP</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $row['AddressNo']; ?></td>
                            <td><?php echo htmlspecialchars($row['First']); ?></td>
                            <td><?php echo htmlspecialchars($row['Last']); ?></td>
                            <td><?php echo htmlspecialchars($row['Street']); ?></td>
                            <td><?php echo htmlspecialchars($row['City']); ?></td>
                            <td><?php echo htmlspecialchars($row['State']); ?></td>
                            <td><?php echo htmlspecialchars($row['Zip']); ?></td>
                            <td class="actions">
                                <a href="?action=edit&id=<?php echo $row['AddressNo']; ?>" class="btn btn-warning">Edit</a>
                                <a href="?action=delete&id=<?php echo $row['AddressNo']; ?>" 
                                   class="btn btn-danger" 
                                   onclick="return confirm('Are you sure you want to delete this address?')">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No addresses found in the database.</p>
        <?php endif; ?>
        
        <div style="margin-top: 30px; text-align: center; color: #666; border-top: 1px solid #ddd; padding-top: 20px;">
            <p>Address Management System | SDC310 Midterm | Lawson</p>
        </div>
    </div>
    
    <script>
        function toggleAddForm() {
            const form = document.getElementById('address-form');
            const toggleText = document.getElementById('toggle-text');
            
            if (form.style.display === 'none') {
                form.style.display = 'block';
                toggleText.textContent = '- Cancel';
            } else {
                form.style.display = 'none';
                toggleText.textContent = '+ Add New Address';
                // Clear form
                form.querySelector('form').reset();
            }
        }
        
        // Auto-uppercase state field
        document.getElementById('state').addEventListener('input', function(e) {
            e.target.value = e.target.value.toUpperCase();
        });
    </script>
</body>
</html>

<?php
mysqli_close($conn);
?>