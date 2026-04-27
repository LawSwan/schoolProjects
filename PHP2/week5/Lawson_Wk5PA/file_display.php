<?php
/**
 * Text File Operations Page
 * Provides ability to view, edit, and create text files
 */

require_once 'classes/TextFile.php';

$textFile = new TextFile('text_files');
$message = '';
$fileContent = '';
$selectedFile = '';
$isEditing = false;

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // View File
    if (isset($_POST['view_file']) && !empty($_POST['selected_file'])) {
        $selectedFile = $_POST['selected_file'];
        $content = $textFile->readFile($selectedFile);
        if ($content !== false) {
            $fileContent = $content;
        } else {
            $message = 'Error: Could not read file.';
        }
    }

    // Edit File (enable editing mode)
    if (isset($_POST['edit_file']) && !empty($_POST['selected_file'])) {
        $selectedFile = $_POST['selected_file'];
        $content = $textFile->readFile($selectedFile);
        if ($content !== false) {
            $fileContent = $content;
            $isEditing = true;
        } else {
            $message = 'Error: Could not read file.';
        }
    }

    // Save Edits
    if (isset($_POST['save_edits']) && !empty($_POST['selected_file'])) {
        $selectedFile = $_POST['selected_file'];
        $newContent = $_POST['file_content'] ?? '';

        if ($textFile->updateFile($selectedFile, $newContent)) {
            $message = 'File saved successfully.';
            $fileContent = $newContent;
        } else {
            $message = 'Error: Could not save file.';
            $fileContent = $newContent;
            $isEditing = true;
        }
    }

    // Create File
    if (isset($_POST['create_file']) && !empty($_POST['new_filename'])) {
        $newFilename = $_POST['new_filename'];
        $newContent = $_POST['file_content'] ?? '';

        // Ensure .txt extension
        if (pathinfo($newFilename, PATHINFO_EXTENSION) !== 'txt') {
            $newFilename .= '.txt';
        }

        if ($textFile->createFile($newFilename, $newContent)) {
            $message = 'File created successfully.';
            $selectedFile = $newFilename;
            $fileContent = $newContent;
        } else {
            $message = 'Error: Could not create file. File may already exist.';
            $fileContent = $newContent;
        }
    }
}

// Get list of text files
$fileList = $textFile->getFileList();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amber Lawson Wk 5 Performance Assessment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
        }
        h1 {
            color: #333;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        h2 {
            color: #555;
        }
        .controls {
            margin: 20px 0;
            padding: 15px;
            background: #f5f5f5;
            border-radius: 5px;
        }
        .controls label {
            font-weight: bold;
            margin-right: 10px;
        }
        .controls select, .controls input[type="text"] {
            padding: 5px 10px;
            margin-right: 10px;
        }
        .controls input[type="submit"] {
            padding: 5px 15px;
            cursor: pointer;
        }
        .create-section {
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
        }
        textarea {
            width: 100%;
            height: 300px;
            font-family: monospace;
            font-size: 14px;
            padding: 10px;
            border: 1px solid #ccc;
            resize: vertical;
        }
        textarea[readonly] {
            background-color: #f9f9f9;
        }
        .message {
            padding: 10px;
            margin: 10px 0;
            background: #e7f3fe;
            border: 1px solid #b6d4fe;
            border-radius: 5px;
            color: #084298;
        }
        .message.error {
            background: #f8d7da;
            border-color: #f5c2c7;
            color: #842029;
        }
        a {
            color: #0066cc;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        .home-link {
            margin-top: 30px;
            display: block;
        }
    </style>
</head>
<body>
    <h1>Amber Lawson Wk 5 Performance Assessment</h1>

    <h2>Text File Operations</h2>

    <?php if ($message): ?>
        <div class="message <?php echo strpos($message, 'Error') !== false ? 'error' : ''; ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <form method="post" class="controls">
        <!-- View/Edit existing file -->
        <div>
            <label for="selected_file">View Text File:</label>
            <select name="selected_file" id="selected_file">
                <option value="">-- Select a file --</option>
                <?php foreach ($fileList as $file): ?>
                    <option value="<?php echo htmlspecialchars($file); ?>"
                        <?php echo ($selectedFile === $file) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($file); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <input type="submit" name="view_file" value="View File">
            <input type="submit" name="edit_file" value="Edit File">
            <input type="submit" name="save_edits" value="Save Edits">
        </div>

        <!-- Create new file -->
        <div class="create-section">
            <input type="text" name="new_filename" placeholder="Enter new filename">
            <input type="submit" name="create_file" value="Create File">
        </div>

        <!-- Text area for content -->
        <div style="margin-top: 15px;">
            <textarea name="file_content" <?php echo (!$isEditing && $fileContent) ? 'readonly' : ''; ?>><?php echo htmlspecialchars($fileContent); ?></textarea>
        </div>
    </form>

    <a href="index.php" class="home-link">Home</a>
</body>
</html>
