<?php
// Include the Person class
require_once 'person.php';

// Create 5 person objects with sample data (2 without address line 2)
$persons = array(
    new Person("John", "Smith", "123 Main Street", "Apt 4B", "Richmond", "VA", "23230"),
    new Person("Sarah", "Johnson", "456 Oak Avenue", "", "Norfolk", "VA", "23510"),
    new Person("Michael", "Brown", "789 Pine Road", "Suite 200", "Virginia Beach", "VA", "23451"),
    new Person("Emma", "Davis", "321 Elm Street", "", "Chesapeake", "VA", "23320"),
    new Person("David", "Wilson", "654 Maple Lane", "Unit 15", "Newport News", "VA", "23601")
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Amber Lawson Wk 2 Performance Assessment</title>
    <style>
        body {
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            background: linear-gradient(45deg, #2E86AB, #A23B72, #F18F01, #C73E1D);
            background-size: 400% 400%;
            animation: gradientShift 8s ease-in-out infinite;
            color: white;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            25% { background-position: 100% 50%; }
            50% { background-position: 100% 100%; }
            75% { background-position: 0% 100%; }
            100% { background-position: 0% 50%; }
        }
        
        .container {
            max-width: 1200px;
            width: 90%;
            padding: 30px;
            background: rgba(255,255,255,0.1);
            border-radius: 20px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
            text-align: center;
        }
        
        h1 {
            font-size: 2.5em;
            text-align: center;
            margin-bottom: 30px;
            color: white;
            text-shadow: 3px 3px 6px rgba(0,0,0,0.7);
        }
        
        h2 {
            font-size: 2em;
            text-align: center;
            margin-bottom: 30px;
            color: white;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }
        
        table {
            width: 100%;
            max-width: 900px;
            border-collapse: collapse;
            margin: 20px auto;
            background: rgba(255,255,255,0.1);
            border-radius: 15px;
            overflow: hidden;
            backdrop-filter: blur(5px);
        }
        
        th, td {
            border: 1px solid rgba(255,255,255,0.3);
            padding: 15px;
            text-align: left;
            color: white;
        }
        
        th {
            background: rgba(255,255,255,0.2);
            font-weight: bold;
            font-size: 1.1em;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
            text-align: center;
        }
        
        tr:nth-child(even) {
            background: rgba(255,255,255,0.05);
        }
        
        tr:hover {
            background: rgba(255,255,255,0.15);
            transform: scale(1.02);
            transition: all 0.3s ease;
        }
        
        td {
            font-size: 1em;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Amber Lawson - Week 2 Performance Assessment</h1>
        
        <h2><?php echo Person::getNameAndAddressLabel(); ?></h2>
        
        <table>
            <thead>
                <tr>
                    <th><?php echo Person::getFullNameLabel(); ?></th>
                    <th><?php echo Person::getAddressLabel(); ?></th>
                    <th><?php echo Person::getCityStateZipLabel(); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($persons as $person): ?>
                <tr>
                    <td><?php echo $person->getFormattedName(); ?></td>
                    <td><?php echo $person->getFormattedAddress(); ?></td>
                    <td><?php echo $person->getFormattedAddressLocation(); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
