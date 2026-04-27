<?php
namespace Util;

class ImageFile {
    private $imageDirectory;
    private $resizedDirectory;
    private $maxSize = 200;
    private $allowedTypes = array('image/jpeg', 'image/png', 'image/gif');
    private $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');

    public function __construct($directory = null) {
        if ($directory === null) {
            $directory = __DIR__ . '/../images';
        }
        $this->imageDirectory = rtrim($directory, '/\\') . DIRECTORY_SEPARATOR;
        $this->resizedDirectory = $this->imageDirectory . '200' . DIRECTORY_SEPARATOR;

        // Create directories if they don't exist
        if (!is_dir($this->imageDirectory)) {
            mkdir($this->imageDirectory, 0755, true);
        }
        if (!is_dir($this->resizedDirectory)) {
            mkdir($this->resizedDirectory, 0755, true);
        }
    }

    // Get list of all images in the directory
    public function getImageList() {
        $images = array();

        if (is_dir($this->imageDirectory)) {
            $items = scandir($this->imageDirectory);
            foreach ($items as $item) {
                if ($item !== '.' && $item !== '..' && $item !== '200') {
                    $ext = strtolower(pathinfo($item, PATHINFO_EXTENSION));
                    if (in_array($ext, $this->allowedExtensions)) {
                        $images[] = $item;
                    }
                }
            }
        }

        return $images;
    }

    // Upload an image file and create resized version
    public function uploadImage($file) {
        // Check for upload errors
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return array('success' => false, 'message' => 'Upload error: ' . $file['error']);
        }

        // Validate file type using finfo
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($file['tmp_name']);

        if (!in_array($mimeType, $this->allowedTypes)) {
            return array('success' => false, 'message' => 'Invalid file type. Only JPG, PNG, and GIF allowed.');
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

        // Create resized version (200x200 max)
        $resizeResult = $this->createResizedImage($filename);

        if (!$resizeResult['success']) {
            return $resizeResult;
        }

        return array('success' => true, 'message' => 'Image uploaded and resized successfully.', 'filename' => $filename);
    }

    // Create resized version of an image (max 200x200)
    private function createResizedImage($filename) {
        $filepath = $this->imageDirectory . $filename;
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // Get original image dimensions
        list($origWidth, $origHeight) = getimagesize($filepath);

        // Load original image
        switch ($extension) {
            case 'png':
                $sourceImage = imagecreatefrompng($filepath);
                break;
            case 'gif':
                $sourceImage = imagecreatefromgif($filepath);
                break;
            default:
                $sourceImage = imagecreatefromjpeg($filepath);
        }

        if (!$sourceImage) {
            return array('success' => false, 'message' => 'Failed to load image.');
        }

        // Calculate new dimensions maintaining aspect ratio
        if ($origWidth > $origHeight) {
            if ($origWidth > $this->maxSize) {
                $newWidth = $this->maxSize;
                $newHeight = intval($origHeight * ($this->maxSize / $origWidth));
            } else {
                $newWidth = $origWidth;
                $newHeight = $origHeight;
            }
        } else {
            if ($origHeight > $this->maxSize) {
                $newHeight = $this->maxSize;
                $newWidth = intval($origWidth * ($this->maxSize / $origHeight));
            } else {
                $newWidth = $origWidth;
                $newHeight = $origHeight;
            }
        }

        // Create new image
        $resizedImage = imagecreatetruecolor($newWidth, $newHeight);

        // Preserve transparency for PNG and GIF
        if ($extension === 'png' || $extension === 'gif') {
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
        $resizedPath = $this->resizedDirectory . $filename;

        switch ($extension) {
            case 'png':
                imagepng($resizedImage, $resizedPath);
                break;
            case 'gif':
                imagegif($resizedImage, $resizedPath);
                break;
            default:
                imagejpeg($resizedImage, $resizedPath, 90);
        }

        return array('success' => true, 'message' => 'Image resized successfully.');
    }

    // Delete an image and its resized version
    public function deleteImage($filename) {
        $filename = basename($filename);
        $deleted = false;

        // Delete original
        $filepath = $this->imageDirectory . $filename;
        if (file_exists($filepath)) {
            unlink($filepath);
            $deleted = true;
        }

        // Delete resized version
        $resizedPath = $this->resizedDirectory . $filename;
        if (file_exists($resizedPath)) {
            unlink($resizedPath);
        }

        return $deleted;
    }

    // Get path to original image
    public function getOriginalPath($filename) {
        return $this->imageDirectory . basename($filename);
    }

    // Get path to resized image
    public function getResizedPath($filename) {
        return $this->resizedDirectory . basename($filename);
    }

    // Get web-relative path to original image
    public function getOriginalWebPath($filename) {
        return 'images/' . basename($filename);
    }

    // Get web-relative path to resized image
    public function getResizedWebPath($filename) {
        return 'images/200/' . basename($filename);
    }

    // Check if an image exists
    public function imageExists($filename) {
        $filepath = $this->imageDirectory . basename($filename);
        return file_exists($filepath);
    }
}
