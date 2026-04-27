<?php
/**
 * TextFile Class
 * Handles text file manipulation operations: create, read, update, list
 */
class TextFile {
    private $directory;

    /**
     * Constructor - sets the directory for text files
     * @param string $directory Path to text files directory
     */
    public function __construct($directory = "text_files") {
        $this->directory = rtrim($directory, '/') . '/';

        // Create directory if it doesn't exist
        if (!is_dir($this->directory)) {
            mkdir($this->directory, 0755, true);
        }
    }

    /**
     * Get list of all text files in the directory
     * @return array List of text file names
     */
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

    /**
     * Read contents of a text file
     * @param string $filename Name of the file to read
     * @return string|false File contents or false on failure
     */
    public function readFile($filename) {
        $filepath = $this->directory . basename($filename);

        if (file_exists($filepath) && is_readable($filepath)) {
            return file_get_contents($filepath);
        }

        return false;
    }

    /**
     * Create a new text file with content
     * @param string $filename Name of the file to create
     * @param string $content Content to write to the file
     * @return bool True on success, false on failure
     */
    public function createFile($filename, $content) {
        // Ensure .txt extension
        if (pathinfo($filename, PATHINFO_EXTENSION) !== 'txt') {
            $filename .= '.txt';
        }

        $filepath = $this->directory . basename($filename);

        // Don't overwrite existing files
        if (file_exists($filepath)) {
            return false;
        }

        return file_put_contents($filepath, $content) !== false;
    }

    /**
     * Update an existing text file
     * @param string $filename Name of the file to update
     * @param string $content New content for the file
     * @return bool True on success, false on failure
     */
    public function updateFile($filename, $content) {
        $filepath = $this->directory . basename($filename);

        if (file_exists($filepath) && is_writable($filepath)) {
            return file_put_contents($filepath, $content) !== false;
        }

        return false;
    }

    /**
     * Delete a text file
     * @param string $filename Name of the file to delete
     * @return bool True on success, false on failure
     */
    public function deleteFile($filename) {
        $filepath = $this->directory . basename($filename);

        if (file_exists($filepath)) {
            return unlink($filepath);
        }

        return false;
    }

    /**
     * Check if a file exists
     * @param string $filename Name of the file to check
     * @return bool True if file exists, false otherwise
     */
    public function fileExists($filename) {
        $filepath = $this->directory . basename($filename);
        return file_exists($filepath);
    }
}
?>
