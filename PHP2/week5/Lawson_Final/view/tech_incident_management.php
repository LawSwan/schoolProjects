<?php
session_start();
require_once(__DIR__ . '/../util/Security.php');
require_once(__DIR__ . '/../util/TextFile.php');

use Util\Security;
use Util\TextFile;

// Check if user is technician
Security::checkTech();

// Handle logout
if (isset($_POST['action']) && $_POST['action'] === 'logout') {
    Security::logout();
}

// Initialize TextFile handler
$textHandler = new TextFile(__DIR__ . '/../incidents');

$message = '';
$selectedFile = '';
$fileContent = '';
$editMode = false;

// Get list of files
$files = $textHandler->getFileList();

// Set default selected file if none selected
if (!empty($files)) {
    $selectedFile = $files[0];
}

// Handle view file
if (isset($_POST['action']) && $_POST['action'] === 'view' && isset($_POST['selectedFile'])) {
    $selectedFile = $_POST['selectedFile'];
    $fileContent = $textHandler->readFile($selectedFile);
    if ($fileContent === false) {
        $fileContent = '';
        $message = 'Failed to read file.';
    }
}

// Handle edit file
if (isset($_POST['action']) && $_POST['action'] === 'edit' && isset($_POST['selectedFile'])) {
    $selectedFile = $_POST['selectedFile'];
    $fileContent = $textHandler->readFile($selectedFile);
    $editMode = true;
    if ($fileContent === false) {
        $fileContent = '';
        $message = 'Failed to read file.';
    }
}

// Handle save edits
if (isset($_POST['action']) && $_POST['action'] === 'save' && isset($_POST['selectedFile'])) {
    $selectedFile = $_POST['selectedFile'];
    $newContent = $_POST['fileContent'] ?? '';
    $result = $textHandler->updateFile($selectedFile, $newContent);
    if ($result['success']) {
        $message = 'File saved successfully.';
        $fileContent = $newContent;
    } else {
        $message = $result['message'];
        $fileContent = $newContent;
    }
}

// Handle create file
if (isset($_POST['action']) && $_POST['action'] === 'create' && isset($_POST['newFileName'])) {
    $newFileName = trim($_POST['newFileName']);
    if (!empty($newFileName)) {
        $result = $textHandler->createFile($newFileName);
        if ($result['success']) {
            $message = 'File created successfully.';
            $selectedFile = $result['filename'];
            // Refresh file list
            $files = $textHandler->getFileList();
        } else {
            $message = $result['message'];
        }
    } else {
        $message = 'Please enter a file name.';
    }
}

// If selected file changed, load its content
if (!empty($selectedFile) && empty($fileContent) && !$editMode) {
    $fileContent = $textHandler->readFile($selectedFile);
    if ($fileContent === false) {
        $fileContent = '';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amber Lawson Final Practical</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { color: #333; }
        h2 { color: #555; }
        .section { margin: 15px 0; }
        label { font-weight: bold; }
        select, input[type="text"] { padding: 5px; }
        input[type="submit"], input[type="button"] { padding: 5px 15px; margin-right: 5px; }
        textarea { width: 400px; height: 200px; margin-top: 10px; display: block; }
        .message { color: green; margin: 10px 0; }
        .error { color: red; margin: 10px 0; }
        .nav-links { margin-top: 20px; }
        .nav-links a { margin-right: 15px; color: #800000; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Amber Lawson Final Practical</h1>
    <h2>Manage Incident Text Files</h2>

    <?php if (!empty($message)): ?>
        <p class="message"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <div class="section">
        <form method="POST" style="display: inline;">
            <label for="selectedFile">View Text File:</label>
            <select name="selectedFile" id="selectedFile">
                <?php foreach ($files as $file): ?>
                    <option value="<?php echo htmlspecialchars($file); ?>" <?php echo ($selectedFile === $file) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($file); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <input type="hidden" name="action" value="view">
            <input type="submit" value="View File">
        </form>

        <form method="POST" style="display: inline;">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="selectedFile" value="<?php echo htmlspecialchars($selectedFile); ?>">
            <input type="submit" value="Edit File">
        </form>

        <?php if ($editMode): ?>
        <form method="POST" style="display: inline;">
            <input type="hidden" name="action" value="save">
            <input type="hidden" name="selectedFile" value="<?php echo htmlspecialchars($selectedFile); ?>">
            <input type="hidden" name="fileContent" value="" id="hiddenContent">
            <input type="submit" value="Save Edits" onclick="document.getElementById('hiddenContent').value = document.getElementById('contentArea').value;">
        </form>
        <?php endif; ?>
    </div>

    <div class="section">
        <form method="POST">
            <input type="text" name="newFileName" placeholder="incident001">
            <input type="hidden" name="action" value="create">
            <input type="submit" value="Create File">
        </form>
    </div>

    <?php if (!empty($selectedFile)): ?>
        <div class="section">
            <?php if ($editMode): ?>
                <textarea id="contentArea" name="fileContent"><?php echo htmlspecialchars($fileContent); ?></textarea>
            <?php else: ?>
                <textarea readonly><?php echo htmlspecialchars($fileContent); ?></textarea>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <input type="hidden" name="action" value="logout">
        <input type="submit" value="Logout">
    </form>

    <div class="nav-links">
        <a href="tech.php">Home</a>
    </div>
</body>
</html>
