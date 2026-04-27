<?php
namespace Util;

class TextFile {
    private $directory;

    public function __construct($directory = null) {
        if ($directory === null) {
            $directory = __DIR__ . '/../incidents';
        }
        $this->directory = rtrim($directory, '/\\') . DIRECTORY_SEPARATOR;

        // Create directory if it doesn't exist
        if (!is_dir($this->directory)) {
            mkdir($this->directory, 0755, true);
        }
    }

    // Get list of all text files in the directory
    public function getFileList() {
        $files = array();

        if (is_dir($this->directory)) {
            $items = scandir($this->directory);
            foreach ($items as $item) {
                if ($item !== '.' && $item !== '..' && pathinfo($item, PATHINFO_EXTENSION) === 'txt') {
                    $files[] = $item;
                }
            }
        }

        return $files;
    }

    // Read contents of a text file
    public function readFile($filename) {
        $filepath = $this->directory . basename($filename);

        if (file_exists($filepath) && is_readable($filepath)) {
            return file_get_contents($filepath);
        }

        return false;
    }

    // Create a new text file with content
    public function createFile($filename, $content = '') {
        // Ensure .txt extension
        if (pathinfo($filename, PATHINFO_EXTENSION) !== 'txt') {
            $filename .= '.txt';
        }

        $filepath = $this->directory . basename($filename);

        // Don't overwrite existing files
        if (file_exists($filepath)) {
            return array('success' => false, 'message' => 'File already exists.');
        }

        if (file_put_contents($filepath, $content) !== false) {
            return array('success' => true, 'message' => 'File created successfully.', 'filename' => basename($filename));
        }

        return array('success' => false, 'message' => 'Failed to create file.');
    }

    // Update an existing text file
    public function updateFile($filename, $content) {
        $filepath = $this->directory . basename($filename);

        if (file_exists($filepath) && is_writable($filepath)) {
            if (file_put_contents($filepath, $content) !== false) {
                return array('success' => true, 'message' => 'File updated successfully.');
            }
        }

        return array('success' => false, 'message' => 'Failed to update file.');
    }

    // Delete a text file
    public function deleteFile($filename) {
        $filepath = $this->directory . basename($filename);

        if (file_exists($filepath)) {
            if (unlink($filepath)) {
                return array('success' => true, 'message' => 'File deleted successfully.');
            }
        }

        return array('success' => false, 'message' => 'Failed to delete file.');
    }

    // Check if a file exists
    public function fileExists($filename) {
        $filepath = $this->directory . basename($filename);
        return file_exists($filepath);
    }
}
