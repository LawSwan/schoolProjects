<?php
/**
 * Base Model Class
 * Provides common functionality for all models
 */
abstract class BaseModel {
    protected $data = [];
    
    /**
     * Get all data
     */
    public function getAll() {
        return $this->data;
    }
    
    /**
     * Get item by ID
     */
    public function getById($id) {
        foreach ($this->data as $item) {
            if (isset($item['id']) && $item['id'] == $id) {
                return $item;
            }
        }
        return null;
    }
    
    /**
     * Get items by field
     */
    public function getByField($field, $value) {
        $results = [];
        foreach ($this->data as $item) {
            if (isset($item[$field]) && $item[$field] == $value) {
                $results[] = $item;
            }
        }
        return $results;
    }
    
    /**
     * Count total items
     */
    public function count() {
        return count($this->data);
    }
}
