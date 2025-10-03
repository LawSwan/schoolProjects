<?php
require_once 'BaseModel.php';

/**
 * Category Model
 * Manages category data and operations
 */
class CategoryModel extends BaseModel {
    
    public function __construct() {
        $this->loadCategories();
    }
    
    /**
     * Load categories data
     */
    private function loadCategories() {
        $this->data = [
            [
                'id' => 1,
                'name' => 'Icon Packs',
                'description' => 'Beautiful icon collections for customizing your device'
            ],
            [
                'id' => 2,
                'name' => 'Wallpapers',
                'description' => 'High-quality wallpapers for desktop and mobile'
            ],
            [
                'id' => 3,
                'name' => 'UI Kits',
                'description' => 'Complete user interface design kits'
            ],
            [
                'id' => 4,
                'name' => 'Fonts',
                'description' => 'Custom typography and font collections'
            ],
            [
                'id' => 5,
                'name' => 'Graphics',
                'description' => 'Digital graphics and design elements'
            ]
        ];
    }
    
    /**
     * Get category by name
     */
    public function getByName($name) {
        return $this->getByField('name', $name);
    }
}

