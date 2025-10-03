<?php
require_once 'BaseModel.php';

/**
 * Product Model
 * Manages product data and operations
 */
class ProductModel extends BaseModel {
    
    public function __construct() {
        $this->loadProducts();
    }
    
    /**
     * Load products data
     */
    private function loadProducts() {
        $this->data = [
            [
                'id' => 1,
                'code' => 'IP01',
                'name' => 'Minimal Pastel',
                'description' => 'Soft pastel icons for a clean home screen. Perfect for minimalist aesthetics.',
                'category_id' => 1,
                'price' => 9.99,
                'image_url' => 'PC-pixs/macaroons.png',
                'file_size' => '15MB',
                'category_name' => 'Icon Packs'
            ],
            [
                'id' => 2,
                'code' => 'IP02',
                'name' => 'Dark Academia',
                'description' => 'Elegant, moody icons with a vintage feel. Inspired by classic literature and scholarly vibes. Features mystical celestial motifs with deep purple and golden accents.',
                'category_id' => 1,
                'price' => 12.99,
                'image_url' => 'DAPIC.png',
                'file_size' => '18MB',
                'category_name' => 'Icon Packs'
            ],
            [
                'id' => 3,
                'code' => 'IP03',
                'name' => 'Kawaii',
                'description' => 'Cute pink and earthy icons inspired by kawaii style. Adorable and functional.',
                'category_id' => 1,
                'price' => 8.99,
                'image_url' => 'PC-pixs/CuteSailorMoon.png',
                'file_size' => '12MB',
                'category_name' => 'Icon Packs'
            ],
            [
                'id' => 4,
                'code' => 'IP04',
                'name' => 'Cottagecore Magic',
                'description' => 'Nature-inspired icons with cozy, cottage vibes. Brings the outdoors to your screen.',
                'category_id' => 1,
                'price' => 11.99,
                'image_url' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=400&h=300&fit=crop',
                'file_size' => '16MB',
                'category_name' => 'Icon Packs'
            ],
            [
                'id' => 5,
                'code' => 'IP05',
                'name' => 'Neon Tech',
                'description' => 'Bright, glowing icons for a futuristic look. Perfect for tech enthusiasts.',
                'category_id' => 1,
                'price' => 13.99,
                'image_url' => 'PC-pixs/NeonTech.png',
                'file_size' => '20MB',
                'category_name' => 'Icon Packs'
            ],
            [
                'id' => 6,
                'code' => 'WP01',
                'name' => 'Abstract Landscapes',
                'description' => 'Stunning abstract landscape wallpapers in 4K resolution.',
                'category_id' => 2,
                'price' => 5.99,
                'image_url' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400&h=300&fit=crop',
                'file_size' => '25MB',
                'category_name' => 'Wallpapers'
            ],
            [
                'id' => 7,
                'code' => 'WP02',
                'name' => 'Minimalist Gradients',
                'description' => 'Clean gradient wallpapers for a modern look.',
                'category_id' => 2,
                'price' => 4.99,
                'image_url' => 'https://images.unsplash.com/photo-1557683316-973673baf926?w=400&h=300&fit=crop',
                'file_size' => '8MB',
                'category_name' => 'Wallpapers'
            ],
            [
                'id' => 8,
                'code' => 'UK01',
                'name' => 'Modern Dashboard UI',
                'description' => 'Complete dashboard interface kit with components.',
                'category_id' => 3,
                'price' => 29.99,
                'image_url' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=400&h=300&fit=crop',
                'file_size' => '45MB',
                'category_name' => 'UI Kits'
            ],
            [
                'id' => 9,
                'code' => 'FT01',
                'name' => 'Handwritten Script Collection',
                'description' => 'Beautiful handwritten fonts for personal and commercial use.',
                'category_id' => 4,
                'price' => 15.99,
                'image_url' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=400&h=300&fit=crop',
                'file_size' => '5MB',
                'category_name' => 'Fonts'
            ],
            [
                'id' => 10,
                'code' => 'GR01',
                'name' => 'Social Media Templates',
                'description' => 'Instagram and social media design templates.',
                'category_id' => 5,
                'price' => 19.99,
                'image_url' => 'PC-pixs/SMedia.png',
                'file_size' => '35MB',
                'category_name' => 'Graphics'
            ]
        ];
    }
    
    /**
     * Get products by category
     */
    public function getByCategory($categoryId) {
        return $this->getByField('category_id', $categoryId);
    }
    
    /**
     * Get featured products (first 6)
     */
    public function getFeatured() {
        return array_slice($this->data, 0, 6);
    }
}

