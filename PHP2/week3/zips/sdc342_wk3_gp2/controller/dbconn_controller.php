<?php
// Controller: handles logic and passes data to view
require_once(__DIR__ . '/../model/database.php');

// Set error reporting to errors only
error_reporting(E_ERROR);

// Create an instance of the Database class
$db = new Database();

// Get data from the model to pass to the view
$dbError = $db->getDbError();
$dbName = $db->getDbName();
$dbHost = $db->getDbHost();
$dbUser = $db->getDbUser();
$dbUserPw = $db->getDbUserPw();

// Load the view
require_once(__DIR__ . '/../view/dbconn_status.php');
