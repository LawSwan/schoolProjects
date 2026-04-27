<?php
/**
 * Image File Operations Page
 * Provides ability to upload, view, and delete images with resizing
 */

require_once 'classes/ImageFile.php';

$imageFile = new ImageFile('images');
$message = '';
$selectedImage = '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Upload Image
    if (isset($_POST['upload_image']) && isset($_FILES['image_file'])) {
        if ($_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
            $result = $imageFile->uploadImage($_FILES['image_file']);
            $message = $result['message'];
            if ($result['success']) {
                $selectedImage = $result['filename'];
            }
        } else if ($_FILES['image_file']['error'] !== UPLOAD_ERR_NO_FILE) {
            $message = 'Error uploading file.';
        }
    }

    // View Images
    if (isset($_POST['view_images']) && !empty($_POST['selected_image'])) {
        $selectedImage = $_POST['selected_image'];
    }

    // Delete Image
    if (isset($_POST['delete_image']) && !empty($_POST['selected_image'])) {
        $imageToDelete = $_POST['selected_image'];
        if ($imageFile->deleteImage($imageToDelete)) {
            $message = 'Image deleted successfully.';
            $selectedImage = '';
        } else {
            $message = 'Error: Could not delete image.';
        }
    }
}

// Get list of images
$imageList = $imageFile->getImageList();
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
        h3 {
            color: #666;
            margin-top: 25px;
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
        .controls select {
            padding: 5px 10px;
            margin-right: 10px;
        }
        .controls input[type="submit"] {
            padding: 5px 15px;
            cursor: pointer;
        }
        .upload-section {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #ddd;
        }
        .upload-section label {
            display: block;
            margin-bottom: 5px;
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
        .message.success {
            background: #d1e7dd;
            border-color: #badbcc;
            color: #0f5132;
        }
        .image-panel {
            margin: 15px 0;
            padding: 10px;
            border: 1px solid #ddd;
            background: #fafafa;
        }
        .image-panel img {
            max-width: 100%;
            height: auto;
            display: block;
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

    <h2>Image File Operations</h2>

    <?php if ($message): ?>
        <div class="message <?php echo strpos($message, 'Error') !== false ? 'error' : 'success'; ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data" class="controls">
        <!-- View/Delete existing images -->
        <div>
            <label for="selected_image">Image Files:</label>
            <select name="selected_image" id="selected_image">
                <option value="">-- Select an image --</option>
                <?php foreach ($imageList as $image): ?>
                    <option value="<?php echo htmlspecialchars($image); ?>"
                        <?php echo ($selectedImage === $image) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($image); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <input type="submit" name="view_images" value="View Images">
            <input type="submit" name="delete_image" value="Delete Image">
        </div>

        <!-- Upload new image -->
        <div class="upload-section">
            <label for="image_file">Upload Image File:</label>
            <input type="file" name="image_file" id="image_file" accept=".jpg,.jpeg,.png">
            <input type="submit" name="upload_image" value="Upload">
        </div>
    </form>

    <!-- Image Display Panels -->
    <?php if ($selectedImage && $imageFile->imageExists($selectedImage)): ?>

        <h3>Original Image:</h3>
        <div class="image-panel">
            <img src="images/<?php echo htmlspecialchars($selectedImage); ?>" alt="Original">
        </div>

        <h3>100px Max Image:</h3>
        <div class="image-panel">
            <?php if ($imageFile->getImagePath($selectedImage, 100)): ?>
                <img src="images/100/<?php echo htmlspecialchars($selectedImage); ?>" alt="100px version">
            <?php else: ?>
                <p>Not available</p>
            <?php endif; ?>
        </div>

        <h3>250px Max Image:</h3>
        <div class="image-panel">
            <?php if ($imageFile->getImagePath($selectedImage, 250)): ?>
                <img src="images/250/<?php echo htmlspecialchars($selectedImage); ?>" alt="250px version">
            <?php else: ?>
                <p>Not available</p>
            <?php endif; ?>
        </div>

        <h3>500px Max Image:</h3>
        <div class="image-panel">
            <?php if ($imageFile->getImagePath($selectedImage, 500)): ?>
                <img src="images/500/<?php echo htmlspecialchars($selectedImage); ?>" alt="500px version">
            <?php else: ?>
                <p>Not available</p>
            <?php endif; ?>
        </div>

    <?php else: ?>

        <h3>Original Image:</h3>
        <div class="image-panel"><p>No image selected</p></div>

        <h3>100px Max Image:</h3>
        <div class="image-panel"><p>No image selected</p></div>

        <h3>250px Max Image:</h3>
        <div class="image-panel"><p>No image selected</p></div>

        <h3>500px Max Image:</h3>
        <div class="image-panel"><p>No image selected</p></div>

    <?php endif; ?>

    <a href="index.php" class="home-link">Home</a>
</body>
</html>
