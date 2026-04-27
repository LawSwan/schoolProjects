<?php
session_start();
require_once(__DIR__ . '/../util/Security.php');
require_once(__DIR__ . '/../util/ImageFile.php');

use Util\Security;
use Util\ImageFile;

// Check if user is admin
Security::checkAdmin();

// Handle logout
if (isset($_POST['action']) && $_POST['action'] === 'logout') {
    Security::logout();
}

// Initialize ImageFile handler
$imageHandler = new ImageFile(__DIR__ . '/../images');

$message = '';
$selectedImage = '';
$showImages = false;

// Handle image upload
if (isset($_POST['action']) && $_POST['action'] === 'upload' && isset($_FILES['image'])) {
    $result = $imageHandler->uploadImage($_FILES['image']);
    $message = $result['message'];
    if ($result['success']) {
        $selectedImage = $result['filename'];
        $showImages = true;
    }
}

// Handle view images
if (isset($_POST['action']) && $_POST['action'] === 'view' && isset($_POST['selectedImage'])) {
    $selectedImage = $_POST['selectedImage'];
    $showImages = true;
}

// Handle delete
if (isset($_POST['action']) && $_POST['action'] === 'delete' && isset($_POST['selectedImage'])) {
    $imageToDelete = $_POST['selectedImage'];
    if ($imageHandler->deleteImage($imageToDelete)) {
        $message = 'Image deleted successfully.';
        $selectedImage = '';
        $showImages = false;
    } else {
        $message = 'Failed to delete image.';
    }
}

// Get list of images
$images = $imageHandler->getImageList();

// Set default selected image if none selected
if (empty($selectedImage) && !empty($images)) {
    $selectedImage = $images[0];
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
        .section { margin: 20px 0; }
        label { font-weight: bold; }
        select { padding: 5px; }
        input[type="submit"], input[type="button"] { padding: 5px 15px; margin-right: 5px; }
        .message { color: green; margin: 10px 0; }
        .error { color: red; margin: 10px 0; }
        .image-display { margin-top: 20px; }
        .image-display img { max-width: 100%; display: block; margin: 10px 0; }
        .nav-links { margin-top: 20px; }
        .nav-links a { margin-right: 15px; color: #800000; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Amber Lawson Final Practical</h1>
    <h2>Image File Management</h2>

    <?php if (!empty($message)): ?>
        <p class="message"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <div class="section">
        <form method="POST">
            <label for="selectedImage">Image Files:</label>
            <select name="selectedImage" id="selectedImage">
                <?php foreach ($images as $img): ?>
                    <option value="<?php echo htmlspecialchars($img); ?>" <?php echo ($selectedImage === $img) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($img); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <input type="hidden" name="action" value="view">
            <input type="submit" value="View Images">
        </form>

        <form method="POST" style="display: inline;">
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="selectedImage" value="<?php echo htmlspecialchars($selectedImage); ?>">
            <input type="submit" value="Delete Image" onclick="return confirm('Are you sure you want to delete this image?');">
        </form>
    </div>

    <div class="section">
        <form method="POST" enctype="multipart/form-data">
            <label>Upload Image File:</label>
            <input type="file" name="image" accept="image/jpeg,image/png,image/gif">
            <input type="hidden" name="action" value="upload">
            <input type="submit" value="Upload">
        </form>
    </div>

    <?php if ($showImages && !empty($selectedImage) && $imageHandler->imageExists($selectedImage)): ?>
        <div class="image-display">
            <p><strong>Original Image:</strong></p>
            <img src="../images/<?php echo htmlspecialchars($selectedImage); ?>" alt="Original">

            <p><strong>200px Max Image:</strong></p>
            <img src="../images/200/<?php echo htmlspecialchars($selectedImage); ?>" alt="Resized">
        </div>
    <?php endif; ?>

    <div class="nav-links">
        <a href="admin.php">Home</a>
    </div>

    <form method="POST">
        <input type="hidden" name="action" value="logout">
        <input type="submit" value="Logout">
    </form>
</body>
</html>
