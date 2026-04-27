<?php
/**
 * ImageFile Class
 * Handles image file upload, resize, and manipulation operations
 */
class ImageFile {
    private $imageDirectory;
    private $sizes = array(100, 250, 500);
    private $allowedTypes = array('image/jpeg', 'image/png');
    private $allowedExtensions = array('jpg', 'jpeg', 'png');

    /**
     * Constructor - sets the directory for images
     * @param string $directory Path to images directory
     */
    public function __construct($directory = "images") {
        $this->imageDirectory = rtrim($directory, '/') . '/';

        // Create directories if they don't exist
        if (!is_dir($this->imageDirectory)) {
            mkdir($this->imageDirectory, 0755, true);
        }

        // Create size subdirectories
        foreach ($this->sizes as $size) {
            $sizeDir = $this->imageDirectory . $size . '/';
            if (!is_dir($sizeDir)) {
                mkdir($sizeDir, 0755, true);
            }
        }
    }

    /**
     * Get list of all images in the directory
     * @return array List of image file names
     */
    public function getImageList() {
        $images = array();

        if (is_dir($this->imageDirectory)) {
            $items = scandir($this->imageDirectory);
            foreach ($items as $item) {
                if ($item !== '.' && $item !== '..') {
                    $ext = strtolower(pathinfo($item, PATHINFO_EXTENSION));
                    if (in_array($ext, $this->allowedExtensions)) {
                        $images[] = $item;
                    }
                }
            }
        }

        return $images;
    }

    /**
     * Upload an image file and create resized versions
     * @param array $file The $_FILES array element for the uploaded file
     * @return array Result with success status and message
     */
    public function uploadImage($file) {
        // Check for upload errors
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return array('success' => false, 'message' => 'Upload error: ' . $file['error']);
        }

        // Validate file type using finfo object
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($file['tmp_name']);

        if (!in_array($mimeType, $this->allowedTypes)) {
            return array('success' => false, 'message' => 'Invalid file type. Only JPG and PNG allowed.');
        }

        // Validate extension
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($extension, $this->allowedExtensions)) {
            return array('success' => false, 'message' => 'Invalid file extension.');
        }

        // Generate safe filename
        $filename = basename($file['name']);
        $filepath = $this->imageDirectory . $filename;

        // Move uploaded file
        if (!move_uploaded_file($file['tmp_name'], $filepath)) {
            return array('success' => false, 'message' => 'Failed to move uploaded file.');
        }

        // Create resized versions
        $resizeResult = $this->createResizedImages($filename);

        if (!$resizeResult['success']) {
            return $resizeResult;
        }

        return array('success' => true, 'message' => 'Image uploaded and resized successfully.', 'filename' => $filename);
    }

    /**
     * Create resized versions of an image
     * @param string $filename Name of the image file
     * @return array Result with success status and message
     */
    private function createResizedImages($filename) {
        $filepath = $this->imageDirectory . $filename;
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // Get original image dimensions
        list($origWidth, $origHeight) = getimagesize($filepath);

        // Load original image
        if ($extension === 'png') {
            $sourceImage = imagecreatefrompng($filepath);
        } else {
            $sourceImage = imagecreatefromjpeg($filepath);
        }

        if (!$sourceImage) {
            return array('success' => false, 'message' => 'Failed to load image.');
        }

        // Create resized versions for each size
        foreach ($this->sizes as $maxSize) {
            // Calculate new dimensions maintaining aspect ratio
            if ($origWidth > $origHeight) {
                $newWidth = $maxSize;
                $newHeight = intval($origHeight * ($maxSize / $origWidth));
            } else {
                $newHeight = $maxSize;
                $newWidth = intval($origWidth * ($maxSize / $origHeight));
            }

            // Create new image
            $resizedImage = imagecreatetruecolor($newWidth, $newHeight);

            // Preserve transparency for PNG
            if ($extension === 'png') {
                imagealphablending($resizedImage, false);
                imagesavealpha($resizedImage, true);
                $transparent = imagecolorallocatealpha($resizedImage, 0, 0, 0, 127);
                imagefilledrectangle($resizedImage, 0, 0, $newWidth, $newHeight, $transparent);
            }

            // Resize
            imagecopyresampled(
                $resizedImage, $sourceImage,
                0, 0, 0, 0,
                $newWidth, $newHeight,
                $origWidth, $origHeight
            );

            // Save resized image
            $resizedPath = $this->imageDirectory . $maxSize . '/' . $filename;

            if ($extension === 'png') {
                imagepng($resizedImage, $resizedPath);
            } else {
                imagejpeg($resizedImage, $resizedPath, 90);
            }

            // Note: imagedestroy() removed - deprecated in PHP 8.5, GD resources freed automatically
        }

        // Note: imagedestroy() removed - deprecated in PHP 8.5, GD resources freed automatically

        return array('success' => true, 'message' => 'Images resized successfully.');
    }

    /**
     * Delete an image and all its resized versions
     * @param string $filename Name of the image file to delete
     * @return bool True on success, false on failure
     */
    public function deleteImage($filename) {
        $filename = basename($filename);
        $deleted = false;

        // Delete original
        $filepath = $this->imageDirectory . $filename;
        if (file_exists($filepath)) {
            unlink($filepath);
            $deleted = true;
        }

        // Delete resized versions
        foreach ($this->sizes as $size) {
            $resizedPath = $this->imageDirectory . $size . '/' . $filename;
            if (file_exists($resizedPath)) {
                unlink($resizedPath);
            }
        }

        return $deleted;
    }

    /**
     * Get path to an image
     * @param string $filename Name of the image file
     * @param int|null $size Size version (100, 250, 500) or null for original
     * @return string|false Path to the image or false if not found
     */
    public function getImagePath($filename, $size = null) {
        $filename = basename($filename);

        if ($size === null) {
            $path = $this->imageDirectory . $filename;
        } else {
            $path = $this->imageDirectory . $size . '/' . $filename;
        }

        if (file_exists($path)) {
            return $path;
        }

        return false;
    }

    /**
     * Check if an image exists
     * @param string $filename Name of the image file
     * @return bool True if image exists, false otherwise
     */
    public function imageExists($filename) {
        $filepath = $this->imageDirectory . basename($filename);
        return file_exists($filepath);
    }
}
?>
