UPDATE users
SET FName = 'Amber J.'
WHERE UserNo = 1;

UPDATE products
SET ProductName = 'Neon Tech v2',
    ProductDescription = 'Updated name, same futuristic glow.'
WHERE ProductNo = 5;

DELETE FROM users
WHERE UserNo = 2;

DELETE FROM products
WHERE ProductNo = 2;
