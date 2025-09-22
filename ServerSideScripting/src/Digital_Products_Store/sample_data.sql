-- Sample data for Digital Products Store
-- Insert categories
INSERT IGNORE INTO categories (CategoryName, CategoryDescription) VALUES
('Icon Packs', 'Beautiful icon collections for customizing your device'),
('Wallpapers', 'High-quality wallpapers for desktop and mobile'),
('UI Kits', 'Complete user interface design kits'),
('Fonts', 'Custom typography and font collections'),
('Graphics', 'Digital graphics and design elements');

-- Insert sample products based on your existing data
INSERT IGNORE INTO digital_products (ProductCode, ProductName, ProductDescription, CategoryID, Price, FileSize) VALUES
('IP01', 'Minimal Pastel', 'Soft pastel icons for a clean home screen. Perfect for minimalist aesthetics.', 1, 9.99, '15MB'),
('IP02', 'Dark Academia', 'Elegant, moody icons with a vintage feel. Inspired by classic literature and scholarly vibes.', 1, 12.99, '18MB'),
('IP03', 'Kawaii Konvert', 'Cute pink and earthy icons inspired by kawaii style. Adorable and functional.', 1, 8.99, '12MB'),
('IP04', 'Cottagecore Magic', 'Nature-inspired icons with cozy, cottage vibes. Brings the outdoors to your screen.', 1, 11.99, '16MB'),
('IP05', 'Neon Tech', 'Bright, glowing icons for a futuristic look. Perfect for tech enthusiasts.', 1, 13.99, '20MB'),
('WP01', 'Abstract Landscapes', 'Stunning abstract landscape wallpapers in 4K resolution.', 2, 5.99, '25MB'),
('WP02', 'Minimalist Gradients', 'Clean gradient wallpapers for a modern look.', 2, 4.99, '8MB'),
('UK01', 'Modern Dashboard UI', 'Complete dashboard interface kit with components.', 3, 29.99, '45MB'),
('FT01', 'Handwritten Script Collection', 'Beautiful handwritten fonts for personal and commercial use.', 4, 15.99, '5MB'),
('GR01', 'Social Media Templates', 'Instagram and social media design templates.', 5, 19.99, '35MB');

-- Insert sample users (separate from class assignment users)
INSERT IGNORE INTO store_users (Username, Email, FirstName, LastName, Password) VALUES
('amber_designer', 'amber@digitalstore.com', 'Amber', 'Lawson', '$2y$10$example_hashed_password_1'),
('creative_john', 'john.creative@email.com', 'John', 'Smith', '$2y$10$example_hashed_password_2'),
('maria_graphics', 'maria.graphics@email.com', 'Maria', 'Rodriguez', '$2y$10$example_hashed_password_3'),
('kevin_ui', 'kevin.ui@email.com', 'Kevin', 'Chen', '$2y$10$example_hashed_password_4'),
('rachel_design', 'rachel.design@email.com', 'Rachel', 'Williams', '$2y$10$example_hashed_password_5')
